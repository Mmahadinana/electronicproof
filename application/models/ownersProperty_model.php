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
		$owners_id=	$search['owners_id'] ?? FALSE;
		$property_id=	$search['property_id'] ?? FALSE;
		$town=	$search['town'] ?? FALSE;
		$municipality=	$search['municipality'] ?? FALSE;
		$district=	$search['district'] ?? FALSE;
		$province=	$search['province'] ?? FALSE;


		if($user_addinfor)
		{
			$this->db->where('owners.user_id',$user_addinfor);
		}
		//check all properties where is no owner
		/*if($owners_id)
		{
			$this->db->where('property.user_id',$user_addinfor);
		}*/

		
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
		->select("
			property.id as property,property.address_id,
			address.id as addressid, address.door_number, address.street_name, address.suburb_id,
			suburb.id as suburb,suburb.name as suburbname,suburb.town_id,
			town.name as town,town.zip_code,
			manucipality.name as manucipality,
			district.name as district,
			province.name as province ")
		->from("owners_property")		
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
	public function availablePropertiesquery($search )
	{
		//search the search filter for all the properties
		$data=$search['hide_owner_search'] ?? false;

		$property_id=	$search['property_id'] ?? FALSE;


		if($property_id)
		{
			$this->db->where('property.id',$property_id);
		}
		if($data)
		{
			$where='(property.id LIKE "%'.$data.'%" OR address.street_name LIKE "%'.$data.'%" OR town.name LIKE "%'.$data.'%")';
			$this->db->where($where);
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
		->join("address"," address.id= property.address_id")
		->join("suburb"," suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id = manucipality.district_id")
		->join("province","province.id = district.province_id")
		
		->group_by("property.id")	
		->order_by("property.id");	

	}public function filterAllProperties($search =array())
	{
		//search the search filter for all the properties
		$data=$search['hide_owner_search'] ?? false;
		if ($data) {
					$where='(address.street_name LIKE "%'.$data.'%")';
			$this->db->where($where);		
						}				
				
	$results=$this->db->select("property.id as property,property.address_id,
			address.id as addressid, address.door_number, address.street_name, address.suburb_id,
			suburb.id as suburb,suburb.name as suburbname,suburb.town_id,
			town.name as town,town.zip_code,
			manucipality.name as manucipality,
			district.name as district,
			province.name as province ")
		->from("property")		
		->join("address"," address.id= property.address_id")
		->join("suburb"," suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id = manucipality.district_id")
		->join("province","province.id = district.province_id")
		
		->group_by("property.id")	
		->order_by("property.id");
		 return $this->db->get()->result() ;
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
	
	/**
	 * [countProperties description]
	 * @param  array  $search [count the properties that are verified]
	 * @return [true]         [count all the properties assigned and stored on the database]
	 */
	public function countProperties(array $search=array())
	{
		$this->propertyquery($search);

		return $this->db->count_all_results();
	}

	public function countAvailableProperties(array $search=array())
	{
		$this->availablePropertiesquery($search);

		return $this->db->count_all_results();
	}


/**
 * [addAddress description]
 * @param [true] $data [retrieves the data stored on each property address]
 */

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
	/**
	 * [availableProperties get all the properties in a property table]
	 * @param  array  $search [description]
	 * @return [type]         [description]
	 */
	public function availableProperties($search=array(),int $limit = ITEMS_PER_PAGE ){

		$offset = $search['page']??0;
		$this->availablePropertiesquery($search);
		$this->db->limit($limit,$offset);
		return $this->db->get()->result();

		//return $this->db->get()->result() ;
	}
	/**
	 * [PropertiesWithOwner get all the properties that has owners]
	 * @param array $search [description]
	 */
	public function PropertiesWithOwner($search=array(),int $limit = ITEMS_PER_PAGE ){

		//$offset = $search['page']??0;
		$this->addressquery($search);
		//$this->db->limit($limit,$offset);
		return $this->db->get()->result();

		//return $this->db->get()->result() ;
	}
/**
 * [getAvailableProperties this functions compares the owners_property with the property table for the available properties]
 * @param  array  $search [description]
 * @return [type]  array       [array of all the avaible properties]
 */
	public function getAvailableProperties($search=array(),int $limit = ITEMS_PER_PAGE){

		//this array stores the properties where the is no owner
		$result=array();
		//array stores the property_id that will be searched in owner_property table
		$mysearch=array();
		
		
	// this increment the count for the $results array
	$i=0;
		
			//get all the property_id´s in the property table
			foreach ($this->availableProperties() as $matchProperty) {
				//store the property_id in a search array
				$mysearch['property_id']=$matchProperty->property;

				if (empty($this->PropertiesWithOwner($mysearch))) {
					//store all the property if the property_id is not found
					foreach ($this->availableProperties($mysearch) as $value) {
						$result[$i]=$value;
					}
					

				}
				
				$i +=1;
				
				
			}
			
			return $result;
			
		
		//array_intersect($array1, $array2);$this->getProperty());
		//return $this->db->get()->result() ;
	}

}
?>