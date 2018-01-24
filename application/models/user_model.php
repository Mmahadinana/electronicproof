<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_MODEL
{


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * [userQuery description]
	 * @param  [type] $searchterm [description]
	 * @return [true]             [retrieves owner's manucipality]
	 */
	public function userQuery($searchterm)
	{
		

		$user_id = $searchterm['user_id'] ?? FALSE;
		//var_dump($user_id);
		if('$user_id')
		{
			$this->db->where('user.id',$user_id);

		}
		
		return $this->db
		->select("user.id as userid,user.name,user.email,user.identityNumber,user.phone,user.dateOfBirth,user.gender_id,user.date_registration,
			owners.id as ownersid,owners.title_deed,owners.registration_number,owners.purchase_price,owners.purchase_date,owners.house_type,
			lives_on.user_id,
			property.id,property.address_id,
			address.id as addressid,address.street_name,address.door_number,address.suburb_id,
			suburb.name as suburb,suburb.town_id,
			town.id as townid,
			town.name as town,town.zip_code,town.manucipality_id,manucipality.id as manucipalityid,
			manucipality.name as manucipality,manucipality.district_id,
			district.name as district,district.id as districtid,district.province_id,
			province.name as province,province.id as provinceid ")
		->from("user")
		->join("owners","owners.user_id = user.id")
		->join("gender","gender.id = user.gender_id")
		->join("lives_on","lives_on.user_id = user.id")		
		->join("property"," property.id= lives_on.property_id")
		->join("address","address.id = property.address_id")
		->join("suburb","suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id= manucipality.district_id")
		->join("province","province.id = district.province_id")

		->group_by('user.id')
		->order_by('user.id');
	}
/**
 * pagination of the get user page
 */
	public function getUser(array $searchterm = array(),int $limit = ITEMS_PER_PAGE)
	{
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
	
/**
 * [addUser description]
 * @param [type] $data [add the verified and assigned user and store the data of each on the database]
 */
public function addUser($data)
{


	$add = array(
		     'name'=>$data['name'],
		     'email'=>$data['email'],
			//'address'=>$data['address'],
		    'identitynumber'=>$data['identitynumber'],
		    'phone'=>$data['phone'],
			'dateOfBirth'=>$data['dateofbirth'],//'2017-11-11',
			'gender_id'=>$data['gender'],
			'date_registration'=>$data['date_registration'],//'2017-11-11',
			//'title_deed'=>$data['title_deed'],
			//'purchase_price'=>$data['purchase_price'],
			//'registration_number'=>$data['registration_number'],
			//'purchase_date'=>$data['purchase_date'],
			//'house_type'=>$data['house_type'],

		     		//'minetype'=>$minetype
			);

	$this->db->trans_start();
//var_dump($add);
	$this->db->insert("user",$add);

	$user_id = $this->db->insert_id();
	$this->insertPassword($data, $user_id);
	$this->addUserAddress($data, $user_id);


	return $this->db->trans_complete();


}
	/**
	 * [updateUser description]
	 * @param  [true] $data [update the user that is verified]
	 * @return [true]       [stores the data of the user]
	 */
	public function updateUser($data)
	{
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
			//var_dump($data['date_registration']),

		    		//'minetype'=>$minetype
			);
		$this->db->trans_start();
		$this->db->where('user.id',$data['iduser'])
		->update('user',$user);
		         //update 
		return $this->db->trans_complete();
	}
	/**
	 * [updateUser_models description]
	 * @param  [type] $user_id [update the user that is verified]
	 * @param  array  $users   [description]
	 * @return [type]          [description]
	 */
	public function updateUser_models($user_id,$users=array())
	{
		
		$batch = array();
		foreach ($users as $users_id) 
		{
			$batch[] = array(
				'user_id'=>$user_id,
				'name'=>$name);

		}
		//remove the previous relation
		$this->removeFromUser($user_id);
		//insert the new relations
		return	$this->db->insert_batch('user_model',$batch);
	}
/**
 * [countUser description]
 * @param  array  $search [count the user of each property]
 * @return [type]         [description]
 */
public function countUser(array $search=array())
{
	$this->userQuery($search);
	return $this->db->count_all_results();
}
	/**
	 * [deleteUser description]
	 * @param  int    $user_id [delete the user that is not approved on the list]
	 * @return [type]          [description]
	 */
	public function deleteUser(int $user_id)
	{
		
		   //begin the transaction
		$this->db->trans_start();
		    //delete the relations
		$this->removeFromUser($user_id);
			//delete the book
		$this->db->delete("user",array("id"=>$user_id));
			//close the transaction
		return $this->db->trans_complete();
	}
	/**
	 * [removeFromUser description]
	 * @param  int    $user_id [remove the user that is not approved on the list]
	 * @return [type]          [description]
	 */
	public function removeFromUser(int $user_id)
	{
		$this->db->delete("user",array("id"=>$user_id));
	}
/**
 * [callback_checkPhone description]
 * @param  [type] $phone [verify the phone stored on the database]
 * @return [type]        [description]
 */
public function callback_checkPhone($phone)
{
	$user_id = $this->input->post('phone');
        //var_dump($phone);
	$this->db->select("user.phone")
	->from("user")
	->where("id",$user_id);
		//var_dump($this->db->get()->row());
	$testphone=$this->db->get()->row();
	//var_dump($testphone);
	if ($testphone->phone != $phone) 
	{
		return false;
	}
	else
	{
		return true;

	} 

}
/**
 * [checkPassword description]
 * @param  [type] $password [verify and store the password of each user]
 * @return [type]           [description]
 */
public function checkPassword($password)
{
		//insert the username and password
	$username = $this->input->post('username');
	$rememberme = $this->input->post('rememberme');

	if (empty($username) || empty($password)) 
	{
			//no values go out
		return true;
	}
//will retrieve the password from the user
	$hash =$this->getPasswordHashFromUser($username);


//lets you varify the password
	if(!empty($hash) && password_verify($password,$hash))
	{
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
 * @param  [type] $username [stores the password assigned]
 * @return [true]           [correct password that appear in the database]
 */

public function insertPassword($data=array(), $user_id)
{	
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
/**
 * [insertAddress description]
 * @param  array  $data    [insert the address on the database]
 * @param  [type] $user_id [description]
 * @return [true]          [retrieves correct information while insertAddress]
 */
public function insertAddress($data=array(), $user_id)
{	
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

	/*public function callback_checkIdnumber($identitynumber)
	{
	//var_dump($this->input->post('user_id'));
		//$user_id = $this->input->post('user_id');
		$this->db->select("user.identitynumber,user.phone")
		->from("user")
		->where("user.id",$user_id);
		     	     //var_dump($this->db->get()->row() );
		$identity=$this->db->get()->row();
		//var_dump($identity);
		//foreach ($identity as $value) {
		if ($identity->identitynumber != $identitynumber) 
		{
			return false;
		}
		else
		{
			return true;
		}


	}*/

	/**
	 * [updateUserAddress description]
	 * @param  [type] $addifor [updates the user address assigned]
	 * @return [type]          [description]
	 */
	public function updateUserAddress($addifor){

		//Get the address id of the address to be inserted
		$userProperty=0;
		$userAddress=0;
		
		$this->db->select('address.id')
		->where('address.suburb_id',$addifor['suburb'])
		->where('address.street_name',$addifor['street_name'])
		->where('address.door_number',$addifor['door_number'])
		->from('address');
		$address=$this->db->get()->result();
		foreach ($address as $value) {
			$userAddress=$value->id;
		}

		//get the property id for the address
		
		$property=$this->getProperty($userAddress);
		//if no property that does not have that address_id insert a new property
		if(empty($property)){
			$this->db->insert('property',array('address_id'=>$userAddress,));
			//get the last inserted id			
			$property=$this->getProperty($userAddress);
		}
		//get the id of the property
		foreach ($property as $value) {
			$userProperty=$value->id;
		}
		
		//storing the data that will be inserted into lives_on table for user
		$address=array(
			'user_id'=> $user_id,
			'property_id'=>$userProperty,
			);
		//check if the address already exist
		$hasAddress=$this->isUserLivingInProperty($address);
		//check if the address has owner
		$hasOwner=$this->isThereOwnerInProperty($address);
		if(empty($hasOwner)){
			return 0;
		}
		if (!empty($hasAddress) && !empty($hasOwner)) {
			
			return 0;
		}else {
			//insert the address for the user
			$this->db->trans_start();
			
			$this->db->insert('lives_on',$address);
			return $this->db->trans_complete();
		}

	}
	/**
	 * [getProperty search the property table for the addrress_id]
	 * @param  [type] $userAddress [address id search]
	 * @return [type]              [array of the property where there is address id]
	 */
	public function getProperty($userAddress){
		$this->db->select('property.id')
		->where('property.address_id',$userAddress)			
		->from('property');

		return $this->db->get()->result();
	}
/**
 * [isUserLivingInProperty description]
 * @param  array   $search [confirms the data lf user on that particular property assigned]
 * @return boolean         [description]
 */
	public function isUserLivingInProperty($search=array()){
		
		$this->db->select('lives_on.id,lives_on.user_id')
		->where('lives_on.user_id',$search['user_id'])			
		->where('lives_on.property_id',$search['property_id'])			
		->from('lives_on');
		return $this->db->get()->result();
	}
	/**
	 * [isThereOwnerInProperty description]
	 * @param  array   $search [verifies the owner in that particular property assigned]
	 * @return boolean         [description]
	 */
	public function isThereOwnerInProperty($search=array()){
		
		$this->db->select('owners_property.id,owners_property.owners_id')				
		->where('owners_property.property_id',$search['property_id'])			
		->from('owners_property');
		return $this->db->get()->result();
	}
}

?>