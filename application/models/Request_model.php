<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends CI_MODEL
{
	var $file_uploadpath;
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('file','form','url'));

		$this->file_uploadpath=realpath(APPPATH . './id_upload');
		
	}
	/**************This query get user address through the lives_on table***************/
	/**
	 * [requestquery for getAddress function]
	 * @param  [type] $search [variables used for the where clause]
	 * @return [type]         [description]
	 */
	public function requestquery($search )
	{
		
		$property_id = $search['property_id'] ?? FALSE;
		$primary_add = $search['primary_add'] ?? FALSE;

		$user_id = $search['user_id'] ?? FALSE;

		/*if($user_id){
			$this->db->where('user.id',$user_id); 
		}*/

		if($property_id && $user_id)
		{
			$this->db->where('lives_on.property_id',$property_id)
			->where('user.id',$user_id); 
		}
		if($primary_add && $user_id)
		{
			$this->db->where('lives_on.primary_prop',$primary_add)
			->where('lives_on.user_id',$user_id); 
		}
		return $this->db
		->select("user.id,user.name,user.identitynumber,user.email,user.phone,
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
/**
 * [ownerquery get owner or list of owners]
 * @param  [type] $search [used for the where clause]
 * @return [type]         [description]
 */
public function ownerquery($search )
{


	$property_id = $search['property_id'] ?? FALSE;
	$user_id = $search['user_id'] ?? FALSE;
		//$userid = $search['userid'] ?? FALSE;


	if($property_id)
	{
		$this->db->where('property.id',$property_id); 
	}
	if($user_id)
	{
		$this->db->where('owners.user_id',$user_id); 
	}
		/*if($userid){
			$this->db->where('owners_property.owners_id',$userid); 
		}*/ 


		//Data of the user of that specified property which will be stored on the database for the administrator to access.

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
	/**
	 * [userquery description]
	 * @param  [type] $search [description]
	 * This query is for the userprofile to be accessed by the owner and the administrator.
	 * @return [type]         [description]
	 */
	
	public function userquery($search )
	{

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
	/**
	 * [getListToComfirmQuery description]
	 * @param  [type] $search [description]
	 * @return [type]         [description]

	 */// Check if the user has already made  request
	//var_dump($date_request);

		/*if($date_request < )
		{
			$this->db->where('request_docs.user_id',$user_id)
					->where('request_docs.b_deleted',0); 
				}	*/	
				public function getListToComfirmQuery($search )
				{

					$owner_confirmation_states = $search['owner_confirmation_states'] ?? FALSE;
					$user_id = $search['user_id'] ?? FALSE;
					$request_id = $search['request_id'] ?? FALSE;
					$property = $search['property'] ?? FALSE;
					$property_id = $search['property_id'] ?? FALSE;		

					if($user_id)
					{
						$this->db->where('request_docs.user_id',$user_id)
						->where('request_docs.b_deleted',0); 
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

					if($owner_confirmation_states)
					{
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
				/**
				 * [getListToComfirmRequestQuery description]
				 * @param  [type] $search [description]
				 * @return [type]         [description]
				 */
				public function getListToComfirmRequestQuery($search )
				{
					$owner_confirmation_states = $search['owner_confirmation_states'] ?? FALSE;
					$user_id = $search['user_id'] ?? FALSE;
					$owner = $search['owner'] ?? FALSE;		
					$property_id = $search['property_id'] ?? FALSE;		

					if($user_id)
					{
						$this->db->where('request_docs.user_id',$user_id)
						->where('request_docs.b_deleted',0)
						; 
					}		

					if($property_id){
						$this->db->where('request_docs.property_id',$property_id); 
					}
					if($owner){

						$this->db->where('owners.user_id',$owner); 
					}

					if($owner_confirmation_states)
					{
						$this->db->where('request_docs.owner_confirmation_states',$owner_confirmation_states); 
					}
					return	$this->db->select("user.name,
						request_docs.id as request_docs_id,request_docs.user_id,request_docs.property_id,request_docs.date_request,			
						owners.user_id as owner,
						address.id as addressid, address.door_number, address.street_name, address.suburb_id,
						suburb.name as suburbname,suburb.town_id,
						town.name as town,town.zip_code,
						manucipality.name as manucipality,
						district.name as district,
						province.name as province")
					->from("user")	
					->join("request_docs","request_docs.user_id = user.id")	
					->join("property","property.id =request_docs.property_id ")	
					->join("owners_property"," owners_property.property_id= property.id")
					->join("owners"," owners.id = owners_property.owners_id")
					->join("address"," address.id= property.address_id")
					->join("suburb"," suburb.id = address.suburb_id")
					->join("town","town.id = suburb.town_id")
					->join("manucipality","manucipality.id = town.manucipality_id")
					->join("district","district.id = manucipality.district_id")
					->join("province","province.id = district.province_id")

					->where('request_docs.owner_confirmation_states',0)
					->group_by('request_docs.id')
					->order_by('user.id');

				}


/**
 * [getApproveToComfirmQuery used getApproveToComfirm function]
 * @param  [type] $search [varialble used for the where clause]
 * @return [type]         [data]
 */
				public function getApproveToComfirmQuery($search )
				{

					$owner_confirmation_states = $search['owner_confirmation_states'] ?? FALSE;
					$user_id = $search['user_id'] ?? FALSE;
					$owner = $search['owner'] ?? FALSE;

					$property_id = $search['property_id'] ?? FALSE;		

					if($user_id)
					{
						$this->db->where('request_docs.user_id',$user_id)
						->where('request_docs.b_deleted',0); 
					}



					if($property_id){
						$this->db->where('request_docs.property_id',$property_id); 
					}
					if($owner){

						$this->db->where('owners.user_id',$owner); 
					}

					if($owner_confirmation_states)
					{
						$this->db->where('request_docs.owner_confirmation_states',$owner_confirmation_states); 
					}
					return	$this->db->select("user.name,
						request_docs.id as request_docs_id,request_docs.user_id,request_docs.property_id,request_docs.date_request,			
						owners.user_id as owner,
						address.id as addressid, address.door_number, address.street_name, address.suburb_id,
						suburb.name as suburbname,suburb.town_id,
						town.name as town,town.zip_code,
						manucipality.name as manucipality,
						district.name as district,
						province.name as province")
					->from("user")	
					->join("request_docs","request_docs.user_id = user.id")	
					->join("property","property.id =request_docs.property_id ")	
					->join("owners_property"," owners_property.property_id= property.id")
					->join("owners"," owners.id = owners_property.owners_id")
					->join("address"," address.id= property.address_id")
					->join("suburb"," suburb.id = address.suburb_id")
					->join("town","town.id = suburb.town_id")
					->join("manucipality","manucipality.id = town.manucipality_id")
					->join("district","district.id = manucipality.district_id")
					->join("province","province.id = district.province_id")


					->group_by('request_docs.id')
					->order_by('user.id');

				}
/**
 * [getAttachmentQuery used to get files from attachement]
 * @param  array  $search [varialble used for the where clause]
 * @return [type]         [data]
 */
				public function getAttachmentQuery($search=array() )
				{


					$request_id = $search['request_id'] ?? FALSE;
					$user_id = $search['user_id'] ?? FALSE;
					$property_id = $search['property_id'] ?? FALSE;
					$idUpload = $search['idUpload'] ?? FALSE;
					$fileToUpload = $search['fileToUpload'] ?? FALSE;

					if($idUpload && $user_id){

						$this->db->where('attachments.minetype',$idUpload)
								->where('proof_of_res_doc.user_id',$user_id)
								->where('proof_of_res_doc.property_id',$property_id); 
					}
					if($fileToUpload && $user_id){

						$this->db->where('attachments.minetype',$fileToUpload)
						->where('proof_of_res_doc.user_id',$user_id)
						->where('proof_of_res_doc.property_id',$property_id); 
					}
					if($request_id){


						$this->db->where('request_docs.id',$request_id); 
					}

					return	$this->db->select("user.name,
						proof_of_res_doc.id,proof_of_res_doc.user_id,proof_of_res_doc.property_id,proof_of_res_doc.attachment_id,
						request_docs.date_request,
						attachments.minetype,attachments.original_name,		
						")
					->from("user")	
					->join("proof_of_res_doc","proof_of_res_doc.user_id = user.id")		
					->join("request_docs","request_docs.user_id = user.id")		
					->join("attachments"," attachments.id = proof_of_res_doc.attachment_id")


					->group_by('proof_of_res_doc.id')
					->order_by('user.id');

				}

				/***********************function get the address of the residents from the database**************************/

/**
 * get the list of property or the address of the user
 */
public function getAddress(array $search = array(),int $limit = ITEMS_PER_PAGE)
{

	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->requestquery($search)

	

		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result();
}

/**
 * get the list of attachments of the user
 */public function getAttachment(array $search = array(),int $limit = ITEMS_PER_PAGE)
{

	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->getAttachmentquery($search)

		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result();
}
	/**
	 * get the list of users
	 */
	public function getUser(array $search = array(),int $limit = ITEMS_PER_PAGE)
	{

	//where to start bringing the rows for the pagination
		$offset = $search['page'] ?? 0;
//call the query to bring the residence
		$this->userquery($search)

		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result();
	}

	/**
	 * Get the list request of the user
	 */
	public function getUserRequest(array $search = array(),int $limit = ITEMS_PER_PAGE)
	{

	//where to start bringing the rows for the pagination
		$offset = $search['page'] ?? 0;
//call the query to bring the residence
		$this->getListToComfirmRequestQuery($search)

		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result();
	}

	/***********************function to insert the files into data**************************/

	/***********************function get the owner of the residents from the database**************************/

	public function getOwner(array $search = array(),int $limit = ITEMS_PER_PAGE)
	{
//public function getAddress(){
	//where to start bringing the rows for the pagination
		$offset = $search['page'] ?? 0;
//call the query to bring the residence
		$this->ownerquery($search)
	
		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result();
	}

	/***********************function to insert the files into data**************************/
	/**
	 * [insert File Data into attachment table]
	 * @param  array  $data     [description]
	 * @param  string $minetype [it will for property or identity document]
	 * @return [type]           [description]
	 */
	public function insertFileData($data =array(),$minetype='',$proofOfRecData=0)
	{

		$requests = array(
			'original_name'=>$data['file_name'],
			'file_path'=>$data['full_path'],
			'original_name'=>$data['client_name'],
			'url'=>$data['file_path'],
			'newname'=>$data['raw_name'],
			'minetype'=>$minetype,
		);
		//$this->db->trans_start();
		$this->db->insert("attachments",$requests);
		$attachments_id = $this->db->insert_id();
		$this->insertInProodOfResDoc($proofOfRecData,$attachments_id);
		return $attachments_id;


	}
	/***********************function to insert the files into data**************************/
	/**
	 * [cancelRequest description]
	 * @param  integer $request_id [will be compared and update the deleted to 1 after the user if approve or request is canceled]
	 * @return [type]              [description]
	 */
	public function cancelRequest($request_id=0)
	{
		//var_dump($request_id);
		$request=array(
			'b_deleted'=>'1'
		);
		$this->db->trans_start();
		$this->db->where('id',$request_id) 
		->update("request_docs",$request);

		return $this->db->trans_complete();
	}

	/***********************function to insert the data into proof_of_res_doc table**************************/
	/**
	 * [insert In ProodOfResDoc table]
	 * @param  [type] $proofOfRecData [description]
	 * @param  [type] $attachments_id [description]
	 * @return [type]                 [description]
	 */
	public function insertInProodOfResDoc($proofOfRecData,$attachments_id){

		$tabledata = array(
			'property_id'=>$proofOfRecData['property'],
			'user_id'=>$proofOfRecData['user_id'],
			'attachment_id'=>$attachments_id,		     		
		);
		$this->db->trans_start();
		$this->db->insert("proof_of_res_doc",$tabledata);
		     	/*$attachments_id = $this->db->insert_id();
		     	$this->insertInProodOfResDoc($proofOfRecData,$attachments_id);*/
		     	/*$this->insertInRequest_docs($proofOfRecData,$attachments_id);*/

		     	return $this->db->trans_complete();
		     	


		     }
		     /***********************function to insert the multiple files into data**************************/
		     /**
		      * [insertMultipleFileData description]
		      * @param  array  $data [description]
		      * @return [type]       [description]
		      */
		     public function insertMultipleFileData($data=array(),$proofOfRecData = 0)
		     {

		     	foreach ($data as $value) 
		     	{
		     		foreach ($value as $file) 
		     		{

		     		}
		     		$minetype='PD';
	//$status = $this->addIdUpload($file);
		     		return $this->insertFileData($file,$minetype,$proofOfRecData);

	/*if(!$status){

		 return $status;
		}*/
	}
//return $status;


}


/**
 * [cancelRequestAtta attachment Identity Document when new one is inserted of the same user]
 * @param  integer $file_id [description]
 * @return [type]           [description]
 */
public function cancelRequestAtta($file_id=0){
	return $this->db->delete('attachments',array('attachments.id'=>$file_id));

}
public function deleteAttachment($attachments=array(),$attachments_id=0){
	/*var_dump($attachments_id,$attachments);
	$this->db->delete('proof_of_res_doc',array($attachments_id));
	$this->db->delete('attachments',array($attachments_id));*/
}
/**
 * [cancel the Requess that the user made befor owner approves is]
 * @param  integer $file_id [description]
 * @return [type]           [description]
 */
public function cancelReques($file_id =0){
	$this->db->delete('proof_of_res_doc',array('proof_of_res_doc.id'=>$file_id));
	return $this->cancelRequestAtta($file_id );
}


/**
 * [insert Request into the request_docs after the user has confimed the request]
 * @param  integer $user_id     [session user]
 * @param  integer $owner_id    [owner of the property]
 * @param  integer $property_id [property of where the user is making a request]
 * @return [type]               [description]
 */
public function insertRequest($user_id=0,$owner_id=0,$property_id=0)
{
	$property=0;
	$requestdata = array(
		'property_id'=>$property_id,
		'user_id'=>$user_id,
		'date_request'=>date('Y-m-d H:i:s'),		     		
	);
	$this->getListToComfirmQuery($requestdata);
	$result=$this->db->get()->result();
	foreach ($result as $value) {		
		$property=$value->property_id;
	}
	if ($property == $property_id) {
		return FALSE;
	}else {
		$this->db->insert("request_docs",$requestdata);
		return true;
	}
	
	
	//var_dump($this->db->insert_id());
	
}

/***********************function get the address of the residents from the database**************************/
/**************************************************************************************
 * It should be merged with getListToComfirmRequest************************************
 **************************************************************************************/

public function getListToComfirm(array $search = array(),int $limit = ITEMS_PER_PAGE)
{

	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->getListToComfirmQuery($search)			

	
		//establish the limit and start to bring the list of request to be confirmed by owner
	->limit($limit,$offset);
			//get data from bd
	
	return $this->db->get()->result();
}


/**
 * Get all the list of the requests that has to be confirmed by the owner
 */
public function getListToComfirmRequest(array $search = array(),int $limit = ITEMS_PER_PAGE)
{
	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->getListToComfirmRequestQuery($search)			

	
	//
		//establish the limit and start to bring a request to be confirmed by owner
	->limit($limit,$offset);
			//get data from bd

	return $this->db->get()->result();
}


/**
 *get the list of the users that made requests and confimed by the onwer but approved
 */
public function listOfApproval(array $search = array(),int $limit = ITEMS_PER_PAGE){

	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 1;
	$config['property_id']  = 1;
//call the query to bring the residence
	$this->getListToComfirmQuery($search)			

		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result();
}


/**
 * [confirm_status update the request doc when the owner confirm or decline]
 * @param  [int] $status [indicates whether the request is confirmed or declined]
 * @param  [array] $search [contains the user_id,property_id and the request_id]
 * @return [type]         [description]
 */
public function confirm_status($status,$search){

	$request_id=$search['request_id'];
	$request_status=array(
		'owner_confirmation_states'=>$status,
		'owner_confirmation_date'=>date('Y-m-d H:i:s')
	);
	$this->db->trans_start();
//update the request_docs table
	$this->db->where('id',$request_id)
	->update('request_docs',$request_status);
	if ($status) {
	//delete the user if declined by owner
		$this->cancelRequest($request_id);
 	//remove the user from lives on table on that particula address
		$this->removeUserAddress($search);

	}
	return $this->db->trans_complete();
}


/**
 * [removeUserAddress removes the add of the user]
 * @param  [type] $search [contains user_id and the property_id that will be deleted in lives_on table]
 * @return [type]         [description]
 */
public function removeUserAddress($search){
	$removeUserData=array(
		'user_id' => 'user_id' ,
		'property_id' => 'property_id' 
	);
	$this->db->trans_start();
	$this->db->delete('lives_on',array('user_id'=>$removeUserData['user_id'],'property_id'=>$removeUserData['property_id']));
	return $this->db->trans_complete();
}


/**
 * the funtion get all the confirmed request by owner 
 */
public function getApproveToComfirm(array $search = array(),int $limit = ITEMS_PER_PAGE){

	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->getApproveToComfirmQuery($search)			


		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result();
}




	



}


?>
