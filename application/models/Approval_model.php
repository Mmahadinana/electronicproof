<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Approval_model extends CI_MODEL{


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}
	
	/**
	 * Function for the approval which shows the details of that user
	 * @param  [type] $search [description]
	 * @return [type]         [description]
	 */
	public function approvalquery($search )
	{

	$property_id = isset($search['property_id'])? $search['property_id'] : FALSE;
	$user_id = isset($search['user_id'])? $search['user_id'] : FALSE;

	if($property_id)
	{
			$this->db->where('property.id',$property_id)
						->where('lives_on.user_id',$user_id);
		}
		//this returns the data onto the database.
	return $this->db
	->select("user.id,user.name,user.identitynumber,user.date_registration,		
			property.id as property,property.address_id,
			address.id as addressid, address.door_number, address.street_name, address.suburb_id,
			suburb.id as suburb,suburb.name as suburbname,suburb.town_id,
			town.name as town,town.zip_code,
			manucipality.name as manucipality,
			district.name as district,
			province.name as province ")
		->from("user")
		->join("lives_on","lives_on.user_id = user.id")			
		->join("property"," property.id= lives_on.property_id")
		->join("address"," address.id= property.address_id")
		->join("suburb"," suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id = manucipality.district_id")
		->join("province","province.id = district.province_id")
		
		->group_by('user.id')
		->order_by('user.id');

	}
	
	/**
	 * retrieves address of the user
	 */
	public function getAddress($search = array(),$limit = ITEMS_PER_PAGE)
	{
	//public function getAddress(){
		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
	//call the query to bring the residence
		$this->approvalquery($search)
		//$this->requestquery();
			//establish the limit and start to bring the owner address
		->limit($limit,$offset);
				//get data from bd
		return $this->db->get()->result();
	}
}