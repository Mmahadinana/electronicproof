<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_MODEL
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('cookie');
	}
/**
 * [query description]
 * @param  [type] $search [description]
 * @return [type]         [description]
 */
	public function query($search){

		;

		$username = $search['username'] ?? FALSE;

		if('$username')
		{
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
	/**
	 * get all the users from the user table in the database
	 */
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
	/**
	 * check the password from the the input in the login, changepassword pages to validate it in login table 
	 */

	public function checkPassword($password) 
	{
		//insert the username and password
		$username = $this->input->post('username');
		$rememberme = 'rememberme';
		

		if (empty($username) || empty($password))
		 {
			//no values go out
			return false;
		}
//will retrieve the password from the user
		$hash =$this->getPasswordHashFromUser($username);


//lets you varify the password
		if(!empty($hash) && password_verify($password,$hash))
		{
	//valid

			$this->startUserSession($username);
			//$this->remember_cookie($rememberme);
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
public function getPasswordHashFromUser($username)
{


	//bring the data from the user to the database
	$hash = $this->db->select("user.id,user.email,login.id,login.password")
	->from("user")
	->join("login","login.user_id = user.id")
	->where('user.email',$username)
	->where('delete',0)
	->where('deceased',0)
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
public function startUserSession($username)
{
	

	//build the session temporary cache by the username 
	$session_data = (array)$this->get_user($username);

	$session_data['owner']=$this->getOwner($session_data['id']);
	if ($session_data['owner'] && $session_data['role']!='admin') {
		$session_data['role']='owner';
	}
	
	if(!empty($session_data)){	

		$expireDate= strtotime($session_data['expireTime']);
		$compare_Date= strtotime(date('Y-m-d H:i:s'));

		if($expireDate-($compare_Date) < 0)
		{

			$backpass=$this->input->post('password');

			redirect('login/changepass/');

		}
		else {
			$session_data['is_logged_in'] = true;

			$this->session->set_userdata($session_data);
		}
	}
}
public function getOwner($user_id){

	$this->db->select("owners.id,owners.user_id")
	->from("owners")
	->where("owners.user_id",$user_id);
		   	 
	if ($this->db->get()->row() != null) {
		return true;
	}else {
		return false;
	}

}
/**
 * [get_user description]
 * @param  [type] $username [description]
 * @return [user data]           [description]
 */
public function get_user($username)
{	

	//return the username
	$user_data = $this->db->select("user.name,user.id,user.email,user.phone,user.identitynumber,
		login.id as loginid,login.password,login.expireTime,
		role.id as roleid, role.role")
	->from("user")
	->join("login","login.user_id = user.id")		
	->join("role","role.id = login.role_id")		
	->where('email',$username)
	->where('delete',0)
	->where('deceased',0)
	->get()->row();

	return $user_data ?? null; 
}//end get_user

/**
 * [generate Token ]
 * @return [string] token [description]
 */

public function generateToken(){
	return bin2hex(random_bytes($length=32));

}

/**
 * [callback_checkEmail from request page for that session user]
 * @param  [type] $email [description]
 * @return [type]        [description]
 */
public function callback_checkEmail($email){
	
	$user_id = $_SESSION['id'];

	$this->db->select("user.email")
	->from("user")
	->where("id",$user_id);
	$testemail=$this->db->get()->row();
	if ($testemail != null){
		if ($testemail->email != $email) {
			return false;
		}else{
			return true;
		}
	} 

}
/**
 * [callback_checkUsername for username in login, reset pages for valid email in user table]
 * @param  [type] $email [description]
 * @return [type]        [description]
 */
public function callback_checkUsername($email){	

	$this->db->select("user.email")
	->from("user")
	->where("email",$email);
	$testemail=$this->db->get()->row();
	if ($testemail != null){
		if ($testemail->email != $email) {
			return false;
		}else{
			return true;

		} 
	}
}
/**
 * [callback_checkPhone for phone in user table from request table if it is valid]
 * @param  [type] $phone [description]
 * @return [type]        [description]
 */
public function callback_checkPhone($phone){

	$user_id = $_SESSION['id'];
	$this->db->select("user.phone,")
	->from("user")
	->where("id",$user_id);
	$testphone=$this->db->get()->row();
	if ($testphone !=null) {	

		if ($testphone->phone != $phone) {
			return false;
		}else{
			return true;
		}
	} 

}
/**
 * [callback_checkIdnumber for identity number in user table from request table if it is valid]
 * @param  [type] true [if identitynumber is correct]
 * @return [type] false [if identitynumber is correct]
 */
public function callback_checkIdnumber($identitynumber){
	
	$user_id = $_SESSION['id'];
	$this->db->select("user.identitynumber,user.phone")
	->from("user")
	->where("user.id",$user_id);
		     	 
	$identity=$this->db->get()->row();
	
	if ($identity !=null) {
		if ($identity->identitynumber != $identitynumber) {
				
			return false;
		}
		else{
			return true;

		} 


	}

}
/**
 * [inserEmailToken insert temporary token in that will match with the one from user email when user reset password]
 * @param  [type] $id    [description]
 * @param  [type] $token [description]
 * @return [type]        [description]
 */
public function inserEmailToken($id,$token){
	$this->deleteEmailtoken($id);
	$expireTime = 1*24*3600;
		//expire date to be sent to the db
	$expireDate = date('Y-m-d H:i:s',time()+$expireTime);
	$tokendata =array(
		'user_id'=>$id,
		'emailtoken'=>$token,
		'expiretime'=>$expireDate ,
	);
	$this->db->trans_start();
	$this->db->insert("emailtoken",$tokendata);    	
	return $this->db->trans_complete();

}
/**
 * [get_mailToken description]
 * @param  [type] $mailtoken [description]
 * @param  [type] $user_id   [description]
 * @return [type]            [description]
 */
public function get_mailToken($mailtoken,$user_id){

	$this->db->select("*")
	->from("emailtoken")
	->where("emailtoken.user_id",$user_id)
	->where("emailtoken.emailtoken",$mailtoken);
		     	    
	return $this->db->get()->row();

}
/**
 * [deleteEmailtoken description]
 * @param  int    $user_id [description]
 * @return [type]          [description]
 */
public function deleteEmailtoken(int $user_id){
	
		//begin the transaction
	$this->db->trans_start();		
		//delete the email token
	$this->db->delete("emailtoken",array('user_id'=>$user_id));
		//return $this->db->affected_rows();
	return $this->db->trans_complete();

}
/**
 * [updatePassword update the password after change password]
 * @param  array  $data    [description]
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
public function updatePassword($data=array(), $user_id){
	$password=password_hash($data['newpassword'], PASSWORD_BCRYPT)	;
	$passwordData = array(
		'password' => $password,

	);
	$this->db->trans_start();
	$this->db->where('user_id', $user_id);
	$this->db->update('login', $passwordData);
	return $this->db->trans_complete();
}


}
?>