<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OwnersProperty_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function propertyquery($search ){

$user_id = $search['user_id'] ?? FALSE;

if('$user_id'){
		$this->db->where('user.id','100');
	}
return $this->db
->select("user.id,user.name,role.role as role,
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