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
->select("user.id,user.name,user.identitynumber,
		owners.user_id,property.id as property,property.address,property.suburb,
		town.name as town,town.zip_code,
		manucipality.name as manucipality,
		district.name as district,
		province.name as province ")
	->from("user")
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
public function propertyquery($search ){
//var_dump($search);
		$user_idprofile = $search['user_idprofile'] ?? FALSE; 
		$user_id = $search['user_id'] ?? FALSE; 
		$mysearch = $search['mysearch'] ?? FALSE; 

		if($user_idprofile){
			$this->db->where('lives_on.user_id',$user_idprofile); 
		}
		if($user_id){
			$this->db->where('lives_on.user_id',$user_id); 
		}
		if($mysearch && $user_id){
			$this->db->where('lives_on.user_id',$user_id)
					->where('address.door_number',$mysearch); 
		}
		return $this->db
		->select("user.id,user.name,user.identitynumber,
			role.role,role.id as roleid,
			login.id as login id,		
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
		->join("lives_on","lives_on.user_id = user.id")		
		->join("property"," property.id= lives_on.property_id")
		->join("address"," address.id= property.address_id")
		->join("suburb"," suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id = manucipality.district_id")
		->join("province","province.id = district.province_id");

		

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
public function getProperty(array $search = array(),int $limit = ITEMS_PER_PAGE){
//public function getAddress(){
	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->propertyquery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result() ;
}
}