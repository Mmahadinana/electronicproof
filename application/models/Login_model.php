<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('cookie');
	}

	public function query($search){
//var_dump($search);
		$username = $search['username'] ?? FALSE;

		if('$username'){
			$this->db->where('user.email','$username');
		}	
		return $this->db->select("user.name,user.id,user.email,user.phone,user.identitynumber,role.id as roleid,role.role,login.id as loginid,login.password,
			GROUP_CONCAT(user.name) as user")
		->from("user")
		->join("login","login.user_id = user.id")
		->join("login","login.role_id = role.id")
		->join("tokens","tokens.login_id =login.id")	

		->group_by('user.id')
		->order_by('user.id');

	}
	public function getUser(array $search = array(),int $limit = ITEMS_PER_PAGE){
//public function getAddress(){
	//where to start bringing the rows for the pagination 
		$offset = $search['page'] ?? 0;
//call the query to bring the residence
		$this->Query($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result() ;
	}

	public function checkPassword($password)
	{
		//insert the username and password
		$username = $this->input->post('username');
		$rememberme = $this->input->post('rememberme');

		if (empty($username) || empty($password)) {
			//no values go out
			return false;
		}
//will retrieve the password from the user
		$hash =$this->getPasswordHashFromUser($username);
	

//lets you varify the password
		if(!empty($hash) && password_verify($password,$hash)){
	//valid
			$this->startUserSession($username);
			$this->remember_cookie($rememberme);
	//checks if valid
			return true;
		}
//return false if password is not correct
		return false;

	}
/**
 * [getPasswordHashFromUser description]
 * @param  [type] $username [description]
 * @return [type]           [description]
 */
public function getPasswordHashFromUser($username){


	//bring the data from the user to the database
	$hash = $this->db->select("user.id,user.email,login.id,login.password")
	->from("user")
	->join("login","login.user_id = user.id")
	->where('user.email',$username)
	->where('delete',0)

	->get()->row();
            //return the hash
	return $hash->password ?? null;
}

/**
 * [startUserSession description]
 * @param  [type] $username [description]
 * @return [type]           [description]
 */
//checks if the hash exists and if the hash matches with the password using the function password_varify
public function startUserSession($username){
	

	//build the session temporary cache by the username 
	$session_data = (array)$this->get_user($username);
	$session_data['is_logged_in'] = true;
	//var_dump($session_data);
	$this->session->set_userdata($session_data);
}
/**
 * [get_user description]
 * @param  [type] $username [description]
 * @return [user data]           [description]
 */
public function get_user($username){	
	
	//return the username
	$user_data = $this->db->select("user.name,user.id,user.email,user.phone,user.identitynumber,login.id as loginid,login.password")
		->from("user")
		->join("login","login.user_id = user.id")		
	->where('email',$username)
	->where('delete',0)
	->get()->row();
//var_dump($user_data);
	return $user_data ?? null; 
}//end get_user
/**
 * [remember_cookie saves the user session and sets the cookie]
 * @param  [type] $rememberme [description]
 * @return [type]             [description]
 */
public function remember_cookie($rememberme , $method = 'login'){
	if($rememberme){
		if ($method == 'login') {
			$this->deleteCookieByToken();
		}
		//3days
		$expireTime = 3*24*3600;
		//expire date to be sent to the db
		$expireDate = date('Y-m-d H:i:s',time()+$expireTime);
		//new token generated randomly
		$token = $this->generateToken();
		//data of the cookie to be writen on the database 
		$newCookieData = array(
			'login_id'=>$_SESSION['id'],
			'token'=>$token,
			'expireDate'=>$expireDate);
		if ($method == 'login') {
			//insert the data on the database
			$this->db->insert('tokens',$newCookieData);
		}

		if ($method == 'cookie') {
		//by cookie update the data on the database
			$tokenOld = $_COOKIE[COOKIE_TOKEN] ?? '';

			$this->db->where('tokens',$tokenOld)
			->update("tokens",$newCookieData);
		}
		
		//create the cookie
		set_cookie(COOKIE_TOKEN,$token,$expireTime);
	}
}//end remember_cookie
public function deleteCookieByToken(){
	//checks if the cookie exists and take token value
	$token = $_COOKIE[COOKIE_TOKEN] ?? '';
	//check if we have a token
	if (!empty($token)) {
	//cookie exist
		$this->db->delete("tokens",array('token' => $token ));
	}
}//end deleteCookieByToken
/**
 * [generateToken description]
 * @return [type] [description]
 */

public function generateToken(){
	return bin2hex(random_bytes($length=32));

}
/**
 * [CheckLoginWithCookieif cookie exists check the data and try to enable the login]
 */
public function CheckLoginWithCookie(){
	//checks if the cookie exists and take token value
	$token = $_COOKIE[COOKIE_TOKEN] ?? '';
//check if we have a token
	if (!empty($token)) {

	//cookie exist
		$username =$this->getUserFromCookie($token);
		$this->startUserSession($username);
		$this->remember_cookie(true,'cookie');
		return true;
	}
	return false;
}//end CheckLoginWithCookie
public function getUserFromCookie($token){

	$username = (array)$this->db->select('user.username')
	->from('user')
	->join('tokens','user.id = tokens.userid')
	->where('token',$token)
	->get()->row();
	if (isset($username['username'])) {
		return $username['username'];                
	}	 
	return '';                           
}//end getUserFromCookie
/**
 * [validateCookie description]
 * @param  [type] $token [description]
 * @return [type]        [description]
 */
public function validateCookie($token){
	$this->deleteExpiredToken();
	$resultDb = (array)$this->db->select('tokens.token')
	->from('tokens')
	->where('token',$token)
	->get()->row();
//check if i recieved the token from the database
//and is equal to the one provided from the cookie	                     
	if (isset($resultDb['token']) && $resultDb['token'] == $token) {
		return true;        
	}	
	return false;                     
}// end validateCookie
public function deleteExpiredToken(){
	$today = date('Y-m-d H:i:s');
	$this->db->where('date <', $today)
	->delete("tokens");

}//end deleteExpiredToken

public function callback_checkEmail($email){
	$user_id = $this->input->post('user_id');
	$this->db->select("user.email")
	->from("user")
	->where("id",$user_id);
	$testemail=$this->db->get()->row();
	if ($testemail->email != $email) {
		return false;
	}else{
		return true;

	} 

}public function callback_checkPhone($phone){
	$user_id = $this->input->post('user_id');
	$this->db->select("user.phone,")
	->from("user")
	->where("id",$user_id);
	$testphone=$this->db->get()->row();
	if ($testphone->phone != $phone) {
		return false;
	}else{
		return true;

	} 

}public function callback_checkIdnumber($identitynumber){
	//var_dump($this->input->post('user_id'));
	$user_id = $this->input->post('user_id');
	$this->db->select("user.identitynumber,user.phone")
	->from("user")
	->where("user.id",$user_id);
		     	     //var_dump($this->db->get()->row() );
	$identity=$this->db->get()->row();
		//var_dump($identity);
		//foreach ($identity as $value) {
	if ($identity->identitynumber != $identitynumber) {
				//var_dump($value->identitynumber );
		return false;
	}
	else{
		return true;

			//} 


	}

}
}
?>