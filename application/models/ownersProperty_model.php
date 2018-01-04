<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OwnersProperty_model extends CI_MODEL
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/**
	 * [propertyquery description]
	 * @param  [true] $search [when the information is correct]
	 * @return [false]         [This query hold the data for the propert]
	 */
	public function propertyquery($search )
	{

		$user_addinfor = $search['user_idprofile'] ?? FALSE;
		$name=	$search['name'] ?? FALSE;
		$property_id=	$search['property_id'] ?? FALSE;
		$town=	$search['town'] ?? FALSE;
		$municipality=	$search['municipality'] ?? FALSE;
		$district=	$search['district'] ?? FALSE;
		$province=	$search['province'] ?? FALSE;


		if($user_addinfor)
		{
			$this->db->where('owners.user_id',$user_addinfor);
		}

		
		if ($name)  
		{
			$where='(user.name LIKE "%'.$name.'%")';
			$this->db->where($where);

		}
		if($property_id)
		{
			$this->db->where('property.id',$property_id);
		}	
		if ($town) 
		 {
			$where='(town.name LIKE "%'.$town.'%")';
			$this->db->where($where);

		}

		if ($municipality)  
		{
			$where='(manucipality.name LIKE "%'.$municipality.'%")';
			$this->db->where($where);

		}
		if ($district)  
		{
			$where='(district.name LIKE "%'.$district.'%")';
			$this->db->where($where);

		}
		if ($province)  
		{
			$where='(province.name LIKE "%'.$province.'%")';
			$this->db->where($where);

		}
		//Data for the user's details
		return $this->db
		->select("user.id,user.name,user.identitynumber,
			role.role,role.id as roleid,
			login.id as login id,
			owners.id as owner,owners.user_id,owners.house_type,
			property.id as property,property.address_id,
			address.id as addressid, address.door_number, address.street_name, address.suburb_id,
			suburb.id as suburb,suburb.name as suburbname,suburb.town_id,
			town.name as town,town.zip_code,
			manucipality.name as manucipality,
			district.name as district,
			province.name as province ")
		->from("user")
		->join("gender","gender.id = user.gender_id")
		->join("login"," login.user_id = user.id ")
		->join("role"," role.id = login.role_id ")
		->join("owners","owners.user_id = user.id")	
		->join("owners_property","owners_property.owners_id = owners.id")
		->join("property"," property.id= owners_property.property_id")
		->join("address"," address.id= property.address_id")
		->join("suburb"," suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id = manucipality.district_id")
		->join("province","province.id = district.province_id")
		->group_by("property.id")	
		->order_by("property.id");	

	}
	//
	/**
	 * [addressquery description]
	 * @param  [type] $search [description]
	 * @return [true]         [This query holds the address data.]
	 */
	public function addressquery($search )
	{

		$property_id=	$search['property_id'] ?? FALSE;
	
		


		if($property_id)
		{
			$this->db->where('property.id',$property_id);
		}	
		
		return $this->db
		->select("property.id as property,property.address_id,
			address.id as addressid, address.door_number, address.street_name, address.suburb_id,
			suburb.id as suburb,suburb.name as suburbname,suburb.town_id,
			town.name as town,town.zip_code,
			manucipality.name as manucipality,
			district.name as district,
			province.name as province ")
		->from("property")		
		->join("property"," property.id= owners_property.property_id")
		->join("address"," address.id= property.address_id")
		->join("suburb"," suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id = manucipality.district_id")
		->join("province","province.id = district.province_id")
		->group_by("property.id")	
		->order_by("property.id");	

	}

/**
 * this function is hold the information for property of the owners
 */

	public function getProperty(array $search = array(),int $limit = ITEMS_PER_PAGE)
	{
//public function getAddress(){
	//where to start bringing the rows for the pagination
		$offset = $search['page']??0;

//call the query to bring the residence
		$this->propertyquery($search)

		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
			
		return $this->db->get()->result() ;
	}
	/**
	 * this function is for the property address that owner has
	 */
	public function getProperty_Address(array $search = array(),int $limit = ITEMS_PER_PAGE)
	{
//public function getAddress(){
	//where to start bringing the rows for the pagination
		$offset = $search['page']??0;

//call the query to bring the residence
		$this->propertyquery($search)

		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result() ;
	}
	
	
	public function countProperties(array $search=array())
	{
		$this->propertyquery($search);

		return $this->db->count_all_results();
	}

	public function addAddress($data)
	{
	//var_dump($minetype);
		$address = array(
			'owners_id'=>$data['owners_id'],
			'property_id'=>$data['property_id']

		);
		$this->db->trans_start();
		$this->db->insert("owners_property",$address);
		$attachments_id = $this->db->insert_id();
		return $this->db->trans_complete();


	}


/**
 * [addUser description]
 * @param [type] $data [is the onwer add the residents]
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

		     		//'minetype'=>$minetype
		);
		
		$this->db->trans_start();
//var_dump($add);
		$this->db->insert("user",$add);

		$user_id = $this->db->insert_id();
		$this->insertPassword($data, $user_id);

		return $this->db->trans_complete();
		
		
	}
}
?>