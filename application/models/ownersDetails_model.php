<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OwnersDetails_model extends CI_MODEL
{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * [userQuery description]
	 * @param  [type] $searchterm [description]
	 * @return [true]             [this query is holds and retrieve the data for the user.]
	 */
	public function userQuery($searchterm)
	{
		
		$property_id = isset($searchterm['property'] )? $searchterm['property'] : FALSE;
		$user_id = isset($searchterm['user_id'])? $searchterm['user_id'] : FALSE;

		if($property_id)
		{
			$this->db->where('owners_property.property_id',$property_id);
		}

		if($user_id)
		{
			$this->db->where('town.manucipality_id',$user_id);

		}

		return $this->db
		->select("user.id as userid,user.name,user.email,user.identityNumber,user.phone,user.dateOfBirth,user.gender_id,user.date_registration,
			owners.user_id,owners.id as ownerid,
			property.id,property.address_id,
			address.id as addressid,address.street_name,address.door_number,address.suburb_id,
			suburb.id as suburbid,suburb.town_id,
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

	/**
	 * this retrieves the information of getUser is correct or not
	 */
	public function getUser($searchterm = array(),$limit = ITEMS_PER_PAGE)
	{
		//public function getAddress(){
		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
		//call the query to bring the residence
		$this->userQuery($searchterm)
	
		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
		//get data from bd
		return $this->db->get()->result() ;
	}

	/**
	 * [addUser description]
	 * @param [type] $data [description]
	 * This function enables the owner and adminstrator to add the new user
	 */
	public function addUser($data)
	{
		

		$add = array(
			'name'=>$data['name'],
			'email'=>$data['email'],			
			'identitynumber'=>$data['identitynumber'],
			'phone'=>$data['phone'],
			'dateOfBirth'=>$data['dateofbirth'],
			'gender_id'=>$data['gender'],
			'date_registration'=>$data['date_registration'],// date  user registered on these app	     		
			);
		
		$this->db->trans_start();
		$this->db->insert("user",$add);
		$user_id = $this->db->insert_id();
		return $this->db->trans_complete();	
	}

	/**
	 * This part will be shown of the next turn of pagination
	 */
	public function getAddressTwo( $search = array(),$limit = ITEMS_PER_PAGE){


	//where to start bringing the rows for the pagination
	$offset = isset($search['page'])? $search['page'] : 0;
	//call the query to bring the residence
	$this->userQuery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result();
}
}


?>