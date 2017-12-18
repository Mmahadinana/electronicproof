<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends CI_MODEL{
	var $file_uploadpath;
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('file','form','url'));

		$this->file_uploadpath=realpath(APPPATH . './id_upload');
		
	}
	/**************This query get user address through the lives_on table***************/
	public function requestquery($search ){

		$property_id = $search['property_id'] ?? FALSE;
		$user_id = $search['user_id'] ?? FALSE;

		/*if($user_id){
			$this->db->where('user.id',$user_id); 
		}*/

		if($property_id && $user_id){
			$this->db->where('lives_on.property_id',$property_id)
			->where('user.id',$user_id); 
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
		->join("province","province.id = district.province_id")

		->group_by('user.id')
		->order_by('user.id');

	}
	/**************This query get user address through the owners table to get the owner***************/
	public function ownerquery($search ){
//var_dump($search['user_id']);
		$property_id = $search['property_id'] ?? FALSE;
		$user_id = $search['user_id'] ?? FALSE;
		//$userid = $search['userid'] ?? FALSE;
		

		if($property_id){
			$this->db->where('property.id',$property_id); 
		}
		if($user_id){
			$this->db->where('owners.user_id',$user_id); 
		}
		/*if($userid){
			$this->db->where('owners_property.owners_id',$userid); 
		}*/


		
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
		->join("province","province.id = district.province_id")

		->group_by('owners_property.id')
		->order_by('owners_property.id');

	}
	public function userquery($search ){

		$user_idprofile = $search['user_idprofile'] ?? FALSE;
		

		if($user_idprofile){
			$this->db->where('user.id',$user_idprofile); 
		}


		
		return $this->db
		->select("user.id as userid,user.name,user.email,user.identityNumber,user.phone,user.dateOfBirth,user.gender_id,user.date_registration,
			gender.gender, ")
		->from("user")
		->join("gender","gender.id = user.gender_id")
		

		->group_by('user.id')
		->order_by('user.id');

	}
	/********this function returs the query that will list all the residents who needs to be approved*********/
	public function getListToComfirmQuery($search ){

		$owner_confirmation_states = $search['owner_confirmation_states'] ?? FALSE;
		$user_id = $search['user_id'] ?? FALSE;
		$request_id = $search['request_id'] ?? FALSE;
		$property = $search['property'] ?? FALSE;
		$property_id = $search['property_id'] ?? FALSE;
			
		

		if($user_id){
			$this->db->where('request_docs.user_id',$user_id); 
		}
		if($property){
			$this->db->where('request_docs.property_id',$property); 
		}
		if($property_id){
			$this->db->where('request_docs.property_id',$property_id); 
		}
		if($request_id){
			$this->db->where('request_docs.id',$request_id); 
		}

		if($owner_confirmation_states){
			$this->db->where('request_docs.owner_confirmation_states',$owner_confirmation_states); 
		}
		return	$this->db->select("user.name,
			request_docs.id,request_docs.user_id,request_docs.property_id,request_docs.date_request,			
			address.id as addressid, address.door_number, address.street_name, address.suburb_id,
			suburb.name as suburbname,suburb.town_id,
			town.name as town,town.zip_code,
			manucipality.name as manucipality,
			district.name as district,
			province.name as province ")
		->from("user")	
		->join("request_docs","request_docs.user_id = user.id")	
		->join("property","property.id =request_docs.property_id ")	
		->join("address"," address.id= property.address_id")
		->join("suburb"," suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id = manucipality.district_id")
		->join("province","province.id = district.province_id")

		->group_by('request_docs.id')
		->order_by('user.id');

	}

	/***********************function get the address of the residents from the database**************************/

	public function getAddress(array $search = array(),int $limit = ITEMS_PER_PAGE){
//public function getAddress(){
	//where to start bringing the rows for the pagination
		$offset = $search['page'] ?? 0;
//call the query to bring the residence
		$this->requestquery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result();
	}
	public function getUser(array $search = array(),int $limit = ITEMS_PER_PAGE){
//public function getAddress(){
	//where to start bringing the rows for the pagination
		$offset = $search['page'] ?? 0;
//call the query to bring the residence
		$this->userquery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result();
	}

	/***********************function to insert the files into data**************************/

	/***********************function get the onwner of the residents from the database**************************/

	public function getOwner(array $search = array(),int $limit = ITEMS_PER_PAGE){
//public function getAddress(){
	//where to start bringing the rows for the pagination
		$offset = $search['page'] ?? 0;
//call the query to bring the residence
		$this->ownerquery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result();
	}

	/***********************function to insert the files into data**************************/
	public function insertFileData($data =array(),$minetype=''){

		$requests = array(
			'original_name'=>$data['file_name'],
			'file_path'=>$data['full_path'],
			'original_name'=>$data['client_name'],
			'url'=>$data['file_path'],
			'newname'=>$data['raw_name'],
			'minetype'=>$minetype,
		);
		$this->db->trans_start();
		$this->db->insert("attachments",$requests);
		     	//$attachments_id = $this->db->insert_id();
		     	//$this->insertInProodOfResDoc($proofOfRecData,$attachments_id);
		return $this->db->trans_complete();


	}
	/***********************function to insert the files into data**************************/
	public function cancelRequest($request_id=0){
		$this->db->trans_start();
				$this->db->delete("request_docs",array('id'=>$request_id));

			return $this->db->trans_complete();
	}

	/***********************function to insert the data into proof_of_res_doc table**************************/
	/*public function insertInProodOfResDoc($proofOfRecData,$attachments_id){

		$tabledata = array(
			'property_id'=>$proofOfRecData['property'],
			'user_id'=>$proofOfRecData['user_id'],
			'attachment_id'=>$attachments_id,		     		
		);
		$this->db->trans_start();
		$this->db->insert("proof_of_res_doc",$tabledata);
		     	/*$attachments_id = $this->db->insert_id();
		     	$this->insertInProodOfResDoc($proofOfRecData,$attachments_id);*/
		     	/*$this->insertInRequest_docs($proofOfRecData,$attachments_id);

		     	return $this->db->trans_complete();
		     	


		     }*/
		     /***********************function to insert the multiple files into data**************************/
		     public function insertMultipleFileData($data=array()){

		     	foreach ($data as $value) {
		     		foreach ($value as $file) {

		     		}
		     		$minetype='PD';
	//$status = $this->addIdUpload($file);
		     		$this->insertFileData($file,$minetype);

	/*if(!$status){

		 return $status;
		}*/
	}
//return $status;


}
public function insertRequest($user_id=0,$owner_id=0,$property_id=0){
	$requestdata = array(
		'property_id'=>$property_id,
		'user_id'=>$user_id,
		'date_request'=>date('Y-m-d H:i:s'),		     		
	);

	$this->db->insert("request_docs",$requestdata);
	//var_dump($this->db->insert_id());
	
}

/***********************function get the address of the residents from the database**************************/

public function getListToComfirm(array $search = array(),int $limit = ITEMS_PER_PAGE){

	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->getListToComfirmQuery($search)			

	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result();
}
public function listOfApproval(array $search = array(),int $limit = ITEMS_PER_PAGE){

	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->getListToComfirmQuery($search)			

	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result();
}


}




?>
