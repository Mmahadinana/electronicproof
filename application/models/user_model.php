<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_MODEL{


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}


	public function userQuery($searchterm){
		

		$user_id = $searchterm['user_id'] ?? FALSE;
//var_dump($user_id);
		if('$user_id')
		{
			$this->db->where('user.id',$user_id);

		}
		
		return $this->db
		->select("user.id as userid,user.name,user.email,user.identityNumber,user.phone,user.dateOfBirth,user.gender_id,user.date_registration,
			owners.user_id,owners.id as ownerid,
			property.id,property.address_id,
			address.id as addressid,address.street_name,address.door_number,address.suburb_id,
			suburb.name as suburb,suburb.town_id,
			owners_property.property_id,owners_property.owners_id,town.id as townid,
			town.name as town,town.zip_code,town.manucipality_id,,manucipality.id as manucipalityid,
			manucipality.name as manucipality,manucipality.district_id,
			district.name as district,district.id as districtid,district.province_id,
			province.name as province,province.id as provinceid ")
		->from("user")
		->join("gender","gender.id = user.gender_id")
		->join("owners","owners.user_id = user.id")
		->join("owners_property","owners_property.owners_id =owners.id ")
		->join("property","property.id= owners_property.property_id")
		->join("address","address.id = property.address_id")
		->join("suburb","suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id= manucipality.district_id")
		->join("province","province.id = district.province_id")

		->group_by('user.id')
		->order_by('user.id');
	}

	public function getUser(array $searchterm = array(),int $limit = ITEMS_PER_PAGE){
//public function getAddress(){
	//where to start bringing the rows for the pagination
		$offset = $searchterm['page'] ?? 0;
//call the query to bring the residence
		$this->userQuery($searchterm)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result() ;
	}
	

	public function addUser($data){
		

		$add = array(
			'name'=>$data['name'],
			'email'=>$data['email'],
			//'address'=>$data['address'],
			'identitynumber'=>$data['identitynumber'],
			'phone'=>$data['phone'],
			'dateOfBirth'=>$data['dateofbirth'],//'2017-11-11',
			'gender_id'=>$data['gender'],
			'date_registration'=>$data['date_registration'],//'2017-11-11',

		     		//'minetype'=>$minetype
			);
		
		$this->db->trans_start();
//var_dump($add);
		$this->db->insert("user",$add);

		$user_id = $this->db->insert_id();
		$this->insertPassword($data, $user_id);

		return $this->db->trans_complete();
		
		
	}
		public function updateUser($data){
		//prepare the data to insert
		$user = array(

		     'name'=>$data['name'],
			'email'=>$data['email'],
			//'address'=>$data['address'],
			'identitynumber'=>$data['identitynumber'],
			'phone'=>$data['phone'],
			'dateOfBirth'=>$data['dateofbirth'],//'2017-11-11',
			'gender_id'=>$data['gender'],
			'date_registration'=>$data['date_registration'],//'2017-11-11',

		    		//'minetype'=>$minetype
			);
		$this->db->trans_start();
		$this->db->where('user.id',$data['iduser'])
		         ->update('user',$user);
		         //update 
		         return $this->db->trans_complete();
	}
   public function updateUser_models($user_id,$users=array()){
		
		$batch = array();
		foreach ($users as $users_id) {
			$batch[] = array(
						'user_id'=>$user_id,
						'name'=>$name);
		
		}
		//remove the previous relation
		$this->removeFromUser($user_id);
		//insert the new relations
      return	$this->db->insert_batch('user_model',$batch);
	}

	public function countUser(array $search=array())
	{
				$this->userQuery($search);
		         return $this->db->count_all_results();
	}
	public function deleteUser(int $user_id){
		
		   //begin the transaction
		    $this->db->trans_start();
		    //delete the relations
			$this->removeFromUser($user_id);
			//delete the book
			$this->db->delete("user",array("id"=>$user_id));
			//close the transaction
			return $this->db->trans_complete();
	}
	public function removeFromUser(int $user_id){
		$this->db->delete("user",array("id"=>$user_id));
	}
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
		$user_id = $this->input->post('phone');
        //var_dump($phone);
		$this->db->select("user.phone")
		->from("user")
		->where("id",$user_id);
		//var_dump($this->db->get()->row());
		$testphone=$this->db->get()->row();
		var_dump($testphone);
		if ($testphone->phone != $phone) {
			return false;
		}else{
			return true;

		} 

	}public function callback_checkIdnumber($identitynumber){
	//var_dump($this->input->post('user_id'));
		//$user_id = $this->input->post('user_id');
		$this->db->select("user.identitynumber,user.phone")
		->from("user")
		->where("user.id",$user_id);
		     	     //var_dump($this->db->get()->row() );
		$identity=$this->db->get()->row();
		//var_dump($identity);
		//foreach ($identity as $value) {
		if ($identity->identitynumber != $identitynumber) {
			return false;
		}
		else{
			return true;
		}


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

public function insertPassword($data=array(), $user_id){	
		//var_dump($data);
	
	$password=password_hash($data['password'], PASSWORD_BCRYPT);
	$expireTime = 30*24*3600;
	$role_id = 2;
		//expire date to be sent to the db
	$expireDate = date('Y-m-d H:i:s',time()+$expireTime);
	//return the username
	$loginadd = array(
		'password'=>$password,
		'user_id'=>$user_id,
		'expireTime'=>$expireDate,
		'role_id'=>$role_id,
		
		);
		//var_dump($loginadd);
		//$this->db->trans_start();
	
	$this->db->insert("login",$loginadd);	
}
public function insertAddress($data=array(), $user_id){	
		//var_dump($data);
	
	$door_number=password_hash($data['door_number'], PASSWORD_BCRYPT);
	$street_name = 30*24*3600;
	$suburb_id = 2;
		//expire date to be sent to the db
	
	//return the username
	$addressAdd = array(
		'door_number'=>$door_number,
		'street_name'=>$street_name,
		'suburb_id'=>$suburb_id,
		
		);
		//var_dump($addressAdd);
		//$this->db->trans_start();
	
	$this->db->insert("login",$addressAdd);	
}
}
?>