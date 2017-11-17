<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_MODEL{


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}


	public function userQuery($searchterm){
		

		$user_id = $searchterm['user_id'] ?? FALSE;
//var_dump($user_id);
		if('$user_id')
		{
			$this->db->where('town.manucipality_id',$user_id);

		}


		return $this->db
		->select("user.id as userid,user.name,user.email,user.identityNumber,user.phone,user.dateOfBirth,user.gender_id,user.date_registration,
			owners.user_id,owners.id as ownerid,
			property.id,property.address,property.suburb,property.town_id,
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

	public function addUser($data){
	var_dump($data);
		$add = array(
			'name'=>$data['name'],
			'email'=>$data['email'],
			'identitynumber'=>$data['identitynumber'],
			'phone'=>$data['phone'],
			//'dateOfBirth'=>$data['dateOfBirth'],
			'gender'=>$data['gender'],
			//'date_registration'=>$data['date_registration'],

		     		//'minetype'=>$minetype
			);
		
		$this->db->trans_start();
		$this->db->insert("user",$add);
		$user_id = $this->db->insert_id();
		return $this->db->trans_complete();
		
		
	}


}

?>