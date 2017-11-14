<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_MODEL{


	public function __construct(){
		parent::__construct();

		$this->load->database();
	}


	public function userQuery($searchterm){
		

		$user_id = $searchterm['user_id'] ?? FALSE;
//var_dump($user_id);
		if('$user_id'){
			$this->db->where('town.manucipality_id',$user_id);

		}


		return $this->db
		->select("user.id,user.name,
			owners.user_id,
			property.id,property.address,property.suburb,property.town_id,
			owners_property.property_id,owners_property.owners_id,
			town.name as town,town.zip_code,town.manucipality_id,
			manucipality.name as manucipality,manucipality.district_id,manucipality.id as manucipalityid,
			district.name as district,district.id as districtid,district.province_id,
			province.name as province,province.id as provinceid ")
		->from("user")
		->join("owners","owners.user_id = user.id")
		->join("owners_property","owners_property.owners_id =owners.id ")
		->join("property","property.id= owners_property.property_id")
		->join("town","town.id = property.town_id")

		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id= manucipality.district_id")
		->join("province","province.id = district.province_id")

		->group_by('user.id')
		->order_by('user.id');
	}

	public function getUser(array $searchterm = array(),int $limit = ITEMS_PER_PAGE){
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


}

?>