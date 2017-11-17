<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Owners_property_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		
		
	}
public function requestquery($search ){

$pOwner = $search['$pOwner'] ?? FALSE;

if('$pOwner'){
		$this->db->where('owners_property.property_id',$pOwner );
	}
return $this->db
->select("user.id,user.name,user.identitynumber,role.role as role,
		owners.user_id,property.id as property,property.address,property.suburb,
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
	->join("town","town.id = property.town_id")
	->join("manucipality","manucipality.id = town.manucipality_id")
	->join("district","district.id = manucipality.district_id")
	->join("province","province.id = district.province_id")
	
	->group_by('user.id')
	->order_by('user.id');

}
public function getOwner(array $search = array(),int $limit = ITEMS_PER_PAGE){
//public function getAddress(){
	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->requestquery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result() ;
}
}