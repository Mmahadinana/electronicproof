<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ListOfRes_model extends CI_MODEL
{


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

/**
 * [listquery Function retrieves the details via the property]
 * @param  [type] $search [description]
 * @return [true]         [Function retrieves the details via the property]
 */
public function listquery($search ){

$user_id = $search['property_id'] ?? FALSE;

if($user_id){
		$this->db->where('property.id',$user_id);
	}
return $this->db
->select("user.id,user.name,user.identitynumber,
		owners.id as owner,owners.user_id,owners.house_type,
		property.id as property,property.address_id,
		address.id as addressid, address.door_number, address.street_name, address.suburb_id,
		suburb.id as suburb,suburb.name as suburbname,suburb.town_id,
		town.name as town,town.zip_code,
		manucipality.name as manucipality,
		district.name as district,
		province.name as province ")
	->from("user")
	->join("owners","owners.user_id = user.id")	
	->join("owners_property","owners_property.owners_id = owners.id")	
	->join("property"," property.id= owners_property.property_id")
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
 * [addressquery This query retrieves the address details]
 * @param  [type] $search [description]
 * @return [true]         [This query retrieves the address details]
 */
public function addressquery($search )
{



		$property_id=	$search['property_id1'] ?? FALSE;
	
		


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
		
		->join("address"," address.id= property.address_id")
		->join("suburb"," suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id = manucipality.district_id")
		->join("province","province.id = district.province_id")
		->group_by("property.id")	
		->order_by("property.id");	

	}

public function getAddress(array $search = array(),int $limit = ITEMS_PER_PAGE)
{
//public function getAddress(){
	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->listquery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result();
}
public function getAddressTwo(array $search = array(),int $limit = ITEMS_PER_PAGE)
{
//public function getAddress(){
	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->addressquery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result();
}
}