<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OwnersProperty_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function propertyquery($search ){

		$user_addinfor = $search['user_idprofile'] ?? FALSE;
		


		if('$user_addinfor'){
			$this->db->where('owners.user_id',$user_addinfor);
		}
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
		->join("province","province.id = district.province_id");
		

	}



	public function getProperty(array $search = array(),int $limit = ITEMS_PER_PAGE){
//public function getAddress(){
	//where to start bringing the rows for the pagination
		$offset = $search['page'] ?? 0;

//call the query to bring the residence
		$this->propertyquery($search)
	
		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result() ;
	}
	public function countProperties(array $search=array()){
		$this->propertyquery($search);

		return $this->db->count_all_results();
	}

	public function addAddress($data){
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



	public function addUser($data){
		

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