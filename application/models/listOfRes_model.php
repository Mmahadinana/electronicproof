<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListOfRes_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function requestquery($search ){

		$user_id = $search['user_id'] ?? FALSE;

		if('$user_id'){
			$this->db->where('user.id','100');
		}
		return $this->db->select("user.id,user.name,role.role as role,
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

/*}
	return $this->db->select("*")
	->from("owners_property");
	->join("gender","gender.gender= user.gender_id")
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
	->order_by('user.id');*/

}
}
?>