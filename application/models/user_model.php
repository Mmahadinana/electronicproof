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
		//var_dump($data);
		$this->db->trans_start();
		$this->db->insert("user",$add);
		$user_id = $this->db->insert_id();
		return $this->db->trans_complete();
		
		
	}
	public function callback_checkEmail($email){
		$user_id = $this->input->post('user_id');
		$this->db->select("user.email")
		->from("user")
		->where("id",$user_id);
		$testemail=$this->db->get()->row();
		if ($testemail->email != $email) {
			return false;
		}else{
			return true;

		} 

	}/*public function callback_checkPhone($phone){
		
		$user_id = $this->input->post('phone');
        //var_dump($phone);
		$this->db->select("user.phone")
		->from("user")
		->where("id",$user_id);
		//var_dump($this->db->get()->row());
		$testphone=$this->db->get()->row();
		var_dump($testphone);
		if ($testphone->phone != $phone) {
			return false;
		}else{
			return true;

		} 

	}*/public function callback_checkIdnumber($identitynumber){
	//var_dump($this->input->post('user_id'));
		$user_id = $this->input->post('user_id');
		$this->db->select("user.identitynumber,user.phone")
		->from("user")
		->where("user.id",$user_id);
		     	     //var_dump($this->db->get()->row() );
		$identity=$this->db->get()->row();
		//var_dump($identity);
		//foreach ($identity as $value) {
			if ($identity->identitynumber != $identitynumber) {
				//var_dump($value->identitynumber );
				return false;
			}
			else{
				return true;
		}


}
}

?>