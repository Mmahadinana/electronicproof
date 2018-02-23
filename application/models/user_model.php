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
	public function userQuery($searchid)
	{
	

		//search user id
		$user_id = $searchid['user_id'] ?? FALSE;
		$property_id = $searchid['property_id'] ?? FALSE;
		//search username
		$username = $searchid['username'] ?? FALSE;
		
		if($user_id)
		{
			$this->db->where('lives_on.user_id',$user_id)
				->where('lives_on.primary_prop','1')
				->where('lives_on.deleted','0');
		}
		if($property_id)
		{
			$this->db->where('lives_on.property_id',$property_id)				
				->where('lives_on.deleted','0');
		}
		//filter the user by email to add on the address listofresidentview
		if($username)
		{	$where='(user.email LIKE "'.$username.'%")';
				$this->db->where($where);
			 
		}
		
		return $this->db
		->select("user.id as userid,user.name,user.email,user.identityNumber,user.phone,user.dateOfBirth,user.gender_id,user.date_registration,			
			lives_on.user_id,lives_on.primary_prop,
			gender.description,
			property.id as property_id,property.address_id,
			address.id as addressid,address.street_name,address.door_number,address.suburb_id,
			suburb.name as suburb,suburb.town_id,
			town.id as townid,
			town.name as town,town.zip_code,town.manucipality_id,manucipality.id as manucipalityid,
			manucipality.name as manucipality,manucipality.district_id,
			district.name as district,district.id as districtid,district.province_id,
			province.name as province,province.id as provinceid ")
		->from("user")		
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
	 * [addressQuery search all the address wher user lives]
	 * @param  array  $search [description]
	 * @return [type]         [description]
	 */
	public function addressQuery($search=array())
	{
		
		//search user id,address id
		$user_id = $search['user_id'] ?? FALSE;
		$address_id = $search['address_id'] ?? FALSE;
		//when use update the address
		if($user_id && $address_id)
		{
			$this->db->where('lives_on.user_id',$user_id)
				->where('lives_on.deleted',0)
				->where('property.address_id',$address_id );
		}
		//when user add new address
		if($user_id)
		{
			$this->db->where('lives_on.user_id',$user_id)
				->where('lives_on.deleted',0);
		}
		
		return $this->db
		->select("lives_on.user_id,lives_on.primary_prop,lives_on.property_id")
		->from("lives_on")				
		->join("property"," property.id= lives_on.property_id")
		->join("address","address.id = property.address_id")
		//->where("lives_on.user_id"," user.id")		
		->order_by('lives_on.property_id');
	}

	/*public function addressquery($search=array()){
   $suburb=$search['suburb'] ?? FALSE;
   $door_number=$search['door_number'] ?? FALSE;
   $street_name=$search['street_name'] ?? FALSE;
   
   if($suburb || $door_number || $street_name){
 	$this->db->where('address.suburb_id',$suburb)
		->where('address.street_name',$street_name)
		->where('address.door_number',$door_number);
		
   }
    $this->db->select('address.id')
    		->from('address');
		
	 return $this->db->get()->result();

	}*/
	/**
	 * pagination of the get user page
	 */
	public function getUser(array $searchid = array(),int $limit = ITEMS_PER_PAGE)
	{

	//public function getAddress(){
		//where to start bringing the rows for the pagination
		$offset = $searchid['page'] ?? 0;
	//call the query to bring the residence
		$this->userQuery($searchid)
		//$this->requestquery();
			//establish the limit and start to bring the owner address
		->limit($limit,$offset);
				//get data from bd
		return $this->db->get()->result() ;
	}
	/**
	 * get the address of where user lives fron addressQuery
	 */
	public function getAddress(array $search = array(),int $limit = ITEMS_PER_PAGE)
	{

	//public function getAddress(){
		//where to start bringing the rows for the pagination
		$offset = $search['page'] ?? 0;
	//call the query to bring the residence
		$this->addressQuery($search)
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
		
		$primary_ad = $this->input->post('primary_ad');
		
		//get user by user id
		$search['user_id']=$data['userid'];		
		//variable to hold address
		$address=0;
		//variable to hold add former add-NOTE: my door_number comes as an id for address
			//$formeradd=$data['door_number'];
		//get user information 
		$currentuserdata=$this->getUser($search);

		//get address id of new property
		//$isaddress=$this->addressquery($data);;
		
		/*foreach ($isaddress as $add) {
			$formeradd=$add->id;
		}*/

		foreach ($currentuserdata as $value) {
			$data['property_id']=$value->property_id;
			$address=$value->address_id;
		}
		
		$userdata=array(
			'name'=>$data['name'],
			'email'=>$data['email'],
			'identitynumber'=>$data['identitynumber'],
			'phone'=>$data['phone'],
			'dateOfBirth'=>$data['dateofbirth'],
			'gender_id'=>$data['gender'],
			'date_registration'=>$data['date_registration'],
			'id'=>$data['userid']
		);
		$this->db->trans_start();
			//update user information
		$this->db->where('user.id',$userdata['id'])
				->update('user',$userdata);
			//check if address is updated
		/*if ($address != $formeradd) {
				//it new address remove old one from primary address
			$this->db->where('user_id',$data['userid'])
					->where('property_id',$data['property_id'])
						//update lives_on table		
					->update('lives_on',array('primary_prop'=>0));
				//update address		
			$this->addUserAddress($data);

		}*/
		return $this->db->trans_complete();
	}
	
	/**
	 * [checkCheckbox if the check for primary address is ckecked]
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function checkCheckbox($data=array()){
		//check for primary input box or radio 
		$primary_ad = $this->input->post('primary_ad');
		
		if(!is_null($this->input->post('userid'))){
			$search['user_id'] = $this->input->post('userid');
		}else {
			$search['user_id']=$data['user_id'];
		}
		
		$userdata=array('primary_prop'=>'0');
	    $userAddress=$this->getAddress($search);
	  //clean all primary address to 0
	    if ( !is_null($primary_ad)) {
	    	foreach ($userAddress as $val) {
		    	if ($val->primary_prop == '1'){
		    		
		    		$this->db->where('lives_on.user_id',$search['user_id'])
					->update('lives_on',$userdata);
			//check if address is updated
			 
					 
		    	}
		    	
	    	}
	    	return true;
	    }  
	    return false; 

	}

	/**
	 * [updateUserAddress udates user address]
	 * @param  array  $search [description]
	 * @return [type]         [description]
	 */
	public function updateUserAddress($search=array()){
		//clean all primary address to be 0
		$this->checkCheckbox($search);
		//for now while i am stragling to come with the property id
		$property_id=0;
		//get all address of the user
		$property=$this->getAddress($search);
		//for now while i am stragling to come with the property id
		foreach ($property as $value) {
			$property_id=$value->property_id;
		}
		

		$addData=array(
			'property_id'=>$property_id,
			'user_id'=>$search['user_id']
		);
		$this->db->trans_start();
		//make the selected a primary address
		$this->db->where('lives_on.user_id',$search['user_id'])
				->where('lives_on.property_id',$property_id)
				->update('lives_on',array('primary_prop'=>'1'));
		return $this->db->trans_complete();
		//$this->db->
	}

	/**
	 * [removeUserAddress removes the add of the user]
	 * @param  [type] $search [contains user_id and the property_id that will be deleted in lives_on table]
	 * @return [type]         [description]
	 */
	public function removeUserAddress($search){
		
		$this->db->trans_start();
		//delete in lives on table
		if (isset($search['user_id'])) {
			
			$this->db->where('user_id',$search['user_id'])
					->where('property_id',$search['property_id'])		
					->where('primary_prop','0')		
					->update('lives_on',array('deleted'=>1));
		}
		//owner delets user from the address
		if (isset($search['user_id']) && $_SESSION['role']=='owner') {

			$this->db->where('user_id',$search['user_id'])
					->where('property_id',$search['property_id'])		
					//->where('primary_prop','0')		
					->update('lives_on',array('deleted'=>1));
		}
		else{
			//user_id from confirm view to decline user
			$this->db->where('user_id',$search['userid'])
					->where('property_id',$search['property_id'])		
					->where('primary_prop','0')		
					->update('lives_on',array('deleted'=>1));
		}
		
		return $this->db->trans_complete();
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
		$this->db->trans_start();
		$this->db->delete("user",array("id"=>$user_id));
		return $this->db->trans_complete();
	}

	/**
	 * [callback_checkPhone description]
	 * @param  [type] $phone [verify the phone stored on the database]
	 * @return [type]        [description]
	 */
	public function callback_checkPhone($phone)
	{
		$user_id = $this->input->post('phone');

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
		//$rememberme = $this->input->post('rememberme');

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
			//$this->remember_cookie($rememberme);
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
		$expireTime = 3*30*24*3600;
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
	 * [insert Address ]
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

	/**
	 * [callback_checkIdnumber for validation]
	 * @param  [type] $identitynumber [description]
	 * @return [type]                 [description]
	 */

	public function callback_checkIdnumber($identitynumber)
	{
		
		$search['user_id']=$this->input->post('userid');
		//$birthdate = $this->input->post('dateofbirth');		
		if ((is_numeric($search['user_id']) && $search['user_id'] !=0)) {
				// I am on the edit mode
			$user=$this->getUser($search);

			foreach ($user as $value) {
				if ($identitynumber == $value->identityNumber) { 
						// email did not change
					return true;
				}else{
						// email changed
					return $this->idnumberDontExist($identitynumber);
				}
			}	
		}
			//email does not exist and id is on create mode
		return $this->idnumberDontExist($identitynumber);
	}

	/**
	 * [idnumberDontExist, called when adding new user or edit has changed]
	 * @param  [type] $identitynumber [description]
	 * @return [type]                 [description]
	 */
	public function idnumberDontExist($identitynumber){

		$this->db->select("user.identitynumber")
				->from("user")
				->where("user.identitynumber",$identitynumber);
			     	     //var_dump($this->db->get()->row() );
		$identity=$this->db->get()->row();
		if (!empty($identity)) {
			if ($identity->identitynumber == $identitynumber) 
			{
				return false;
			}
		}else
		{
			$validate=$this->compareIdentity_Date_Gender_Citizen($identitynumber);
			if ($validate ==false){
				return false;
			}else {
				return true;
			}
			
		}
	}
	/**
	 * [compareIdentity_Date_Gender_Citizen check valide Identity number for South Africa]
	 * @param  [type] $identitynumber [description]
	 * @return [type]                 [description]
	 */
	function compareIdentity_Date_Gender_Citizen($identitynumber){
		// storing date of birth input
		$birthdate =$this->input->post('dateofbirth');
		// storing gender input
		$gender =$this->input->post('gender');
		//exracting and assembling date of birth to be compared to identity number input
		$birthdate=(explode('-',$birthdate));
		$birthdate=(implode('',$birthdate));		
		//check if the gender numbers is for female or male
		$checkgender=intval(substr($identitynumber, 6, 4)) < 5000 ? 2 : 1;
		//rang for citizenship
		$citizen =array(0,1);
		//checksum for correct Identity number
		$checksum_num=$this->isValidIdetity_checkLuhn($identitynumber);


		if(substr($birthdate, 2,6) != substr($identitynumber, 0, 6) ){
			return false;
		}
		//:date("$year-$month-$day", array('format' => '%y-%m-%d'))
		if (!in_array($identitynumber{11}, array(8))) {
			return false;
		}
		if($checkgender != $gender){
			return false;
		}
		if(!$checksum_num){
			return false;
		}
		if (!in_array($identitynumber{10}, array(0, 1))) {
			return false;
		}else {
			return true;
		}
		
	}
	/**
	 * [isValidIdetity_checkLuhn description]
	 * @param  [type]  $card_number [description]
	 * @return boolean              [description]
	 */
	public function isValidIdetity_checkLuhn ($id_number) {
		$string = '';

		foreach (str_split(strrev((string) $id_number)) as $i => $num) {
			$string .= $i %2 !== 0 ? $num * 2 : $num;
		}

		return array_sum(str_split($string)) % 10 === 0;
	}

	/**
	 * [callback_email for validation]
	 * @param  [type] $email [description]
	 * @return [type]        [description]
	 */
	public function callback_email($email)
	{
		$search['user_id']=$this->input->post('userid');
		//$birthdate = $this->input->post('dateofbirth');
		if ((is_numeric($search['user_id']) && $search['user_id'] !=0)) {
				// I am on the edit mode
			$user=$this->getUser($search);
			foreach ($user as $value) {
				if ($email == $value->email) { 
						// email did not change
					return true;
				}else{
						// email changed
					return $this->emailDontExist($email);
				}
			}	
		}
			//email does not exist and id is on create mode
		return $this->emailDontExist($email);
	}
	/**
	 * [emailDontExist called when adding new email or editemail changed]
	 * @param  [type] $email [description]
	 * @return [type]        [description]
	 */
	public function emailDontExist($email)
	{
		$this->db->select("user.email")
				->from("user")
				->where("user.email",$email);
			     	     //var_dump($this->db->get()->row() );
		$user=$this->db->get()->row();	
		if (!empty($user)) {
			if ($user->email == $email) 
			{
				return false;
			}
		}else
		{
			return true;
		}
	}
	public function callback_alpha($name){
		//checking if there any numbers
		preg_match_all('!\d+!', $name, $matches);
		//preg_match_all('!d+!', $name, $matches);
		
		if (!empty($matches[0])) { 
		//number has been found return false       
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
		/**
	 * [update User Address ]
	 * @param  [type] $addifor [updates the user address assigned]
	 * @return [type]          [description]
	 */
		public function addUserAddress($addifor=array(),$user_id=0){
		//for user in session who has no address
 
		
			if ($user_id==0 && !empty($addifor)) {

				$user_id=$addifor['userid'];
			
			}
			
			
			
			
		//variable to store address id and property id 
			$userProperty=0;
			$userAddress=$addifor['door_number'];
		//get address

		/*$address=$this->addressquery($addifor);
		foreach ($address as $value) {
			$userAddress=$value->id;

		}*/
		//if function is called from update user 
		
		//get the property id for the address
		

		$property=$this->getProperty($userAddress);	
		//$isnewuser=$this->getUser($userAddress);	
		
//to be used to insert new property
		//if no property that does not have that address_id insert a new property
		/*if(empty($property)){
			$this->db->insert('property',array('address_id'=>$userAddress,));
			//get the last inserted id			
			$property=$this->getProperty($userAddress);
		}*/

		//get the id of the property
		foreach ($property as $value) {
			$userProperty=$value->id;
		}

		//default primary address for property
		$primary_prop=1;
		// if user is in session and they add the new address
			if ($this->checkCheckbox()==false && isset($_SESSION['id'])){
				$primary_prop=0;
			}

		//storing the data that will be inserted into lives_on table for user
		$address=array(
			'user_id'=> $user_id,
			'property_id'=>$userProperty,
			'start_date'=>date('Y-m-d'),
			'primary_prop'=>$primary_prop,
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
	/*public function updateUserAddress($addifor=array(),$user_id=0){

	}*/
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
				->where('lives_on.deleted','0')			
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