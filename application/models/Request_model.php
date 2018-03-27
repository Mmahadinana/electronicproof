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
	 * @param  [false] $search [variables used for the where clause]
	 * @return [true]         [its retrieved the request information from the database]
	 */
	public function requestquery($search )
	{
		
		$property_id = isset($search['property_id'])? $search['property_id'] : FALSE;
		$primary_add = isset($search['primary_add'])? $search['primary_add'] : FALSE;

		$user_id = isset($search['user_id'])? $search['user_id'] : FALSE;
		$userid = isset($search['userid'])? $search['userid'] : FALSE;
		//from askdelete view
		if($property_id && $userid){
			$this->db->where('lives_on.property_id',$property_id)
			->where('user.id',$userid);
		}
		//from request view
		if($property_id && $user_id)
		{
			$this->db->where('lives_on.property_id',$property_id)
			->where('user.id',$user_id); 
		}//from user_id
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
	
	/**
	 * [ownerquery get owner or list of owners]
	 * @param  [false] $search [used for the where clause]
	 * @return [true]         [once the owner conform the information from the database is true]
	 */
	public function ownerquery($search )
	{

		$property_id = isset($search['property_id'])? $search['property_id'] : FALSE;
		$user_id = isset($search['user_id'])? $search['user_id'] : FALSE;
		$owner_id = isset($search['owner_id'])? $search['owner_id'] : FALSE;
		$owner = isset($search['owner'])? $search['owner'] : FALSE;
		//$userid = $search['userid'] ?? FALSE;

		//check for the requestPreview control
		if($property_id)
		{
			$this->db->where('owners_property.property_id',$property_id); 
		}
		//check from getOwnerOfProperty control
		if($user_id)
		{
			$this->db->where('owners.user_id',$user_id); 
		}
		if($owner_id)
		{
			$this->db->where('owners.id',$owner_id)
					->where('owners_property.property_id',$property_id); 
		}
		if($owner)
		{	$where='(user.email LIKE "%'.$owner.'%")';
				$this->db->where($where);
			 
		}
			/*if($userid){
				$this->db->where('owners_property.owners_id',$userid); 
			}*/ 

			//Data of the user of that specified property which will be stored on the database for the administrator to access.
			return $this->db
			->select("user.id,user.name,user.identitynumber,user.email,
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

		$user_idprofile = isset($search['user_idprofile'])? $search['user_idprofile']: FALSE;		

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
	
	/**
	 * [getListToComfirmQuery list all the residents who needs to be approved]
	 * @param  [type] $search [description]
	 * @return [type]         [description]

	 */
	public function getListToComfirmQuery($search )
	{					
		$owner_confirmation_states = isset($search['owner_confirmation_states'])? $search['owner_confirmation_states'] : FALSE;
		$user_id = isset($search['user_id'])? $search['user_id'] : FALSE;
		$request_id = isset($search['request_id'])? $search['request_id'] : FALSE;
		$property =isset($search['property'])?  $search['property'] : FALSE;
		$property_id = isset($search['property_id'])? $search['property_id'] : FALSE;		

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
			request_docs.administrator_confirmation_date,			
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
	 * @param  [false] $search [retrieved the correct information which is confirm from the database ]
	 * @return [true]         [once the information is correct]
	 */
	public function getListToComfirmRequestQuery($search )
	{
		$owner_confirmation_states = isset($search['owner_confirmation_states'])? $search['owner_confirmation_states'] : FALSE;
		$user_id = isset($search['user_id'])? $search['user_id'] : FALSE;
		$owner = isset($search['owner'])? $search['owner'] : FALSE;		
		$property_id = isset($search['property_id'])? $search['property_id'] : FALSE;		

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
			request_docs.id as request_docs_id,request_docs.b_deleted,
			request_docs.user_id,request_docs.property_id,request_docs.date_request,			
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
	public function getListToApproveQuery($search=array() )
	{			
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
		//get only requests that has been approved
		->where('request_docs.b_deleted',0) 
		->where('request_docs.owner_confirmation_states',1)


		->group_by('user.id')
		->order_by('user.id');

	}
	/**
	 * [getAttachmentQuery used to get files from attachement]
	 * @param  array  $search [varialble used for the where clause]
	 * @return [type]         [data]
	 */
	public function getAttachmentQuery($search=array() )
	{


		$request_id = isset($search['request_id'])? $search['request_id'] : FALSE;
		$user_id = isset($search['user_id'])? $search['user_id'] : FALSE;
		$property_id = isset($search['property_id'])? $search['property_id'] : FALSE;
		
		$idUpload = isset($search['idUpload'])? $search['idUpload'] : FALSE;
		$fileToUpload = isset($search['fileToUpload'])? $search['fileToUpload'] : FALSE;
		//check expiry date for approved proof of resident 
		$approved = isset($search['approved'])? $search['approved'] : FALSE;
		$property = isset($search['property'])? $search['property'] : FALSE;
		//get files identity
		if($idUpload && $user_id){

			$this->db->where('attachments.minetype',$idUpload)
			->where('proof_of_res_doc.user_id',$user_id)
			->where('proof_of_res_doc.property_id',$property_id); 
		}
		//get file property
		if($fileToUpload && $user_id){

			$this->db->where('attachments.minetype',$fileToUpload)
			->where('proof_of_res_doc.user_id',$user_id)
			->where('proof_of_res_doc.property_id',$property_id); 
		}
		if($request_id){


			$this->db->where('request_docs.id',$request_id); 
		}
		//check expiry date for approved proof of resident 
		if($approved){

			$this->db->where('proof_of_res_doc.property_id',$property)
					->where('proof_of_res_doc.user_id',$user_id)
					->where('proof_of_res_doc.approved',$approved); 
		}

		return	$this->db->select("user.name,
			proof_of_res_doc.id,proof_of_res_doc.user_id,proof_of_res_doc.expiry_date,proof_of_res_doc.approved,
			proof_of_res_doc.property_id,proof_of_res_doc.attachment_id,
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

	/**
	 * get the list of property or the address of the user
	 */
	public function getAddress($search = array(),$limit = ITEMS_PER_PAGE)
	{

		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
		//call the query to bring the residence
		$this->requestquery($search)
		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
				//get data from bd
		return $this->db->get()->result();
	}

	/**
	 * get the list of attachments of the user
	 */
	public function getAttachment($search = array(),$limit = ITEMS_PER_PAGE)
	{

		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
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
	public function getUser($search = array(),$limit = ITEMS_PER_PAGE)
	{

	//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
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
	public function getUserRequest($search = array(),$limit = ITEMS_PER_PAGE)
	{
		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
		//call the query to bring the residence
		$this->getListToComfirmRequestQuery($search)

		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result();
	}	

	/**
	 * *********************function get the owner of the residents from the database*************************
	 */
	public function getOwner( $search = array(),$limit = ITEMS_PER_PAGE)
	{
	
		//public function getAddress(){
		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
		//call the query to bring the residence
		$this->ownerquery($search)

		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result();
	}
	
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
		// check if user has file and it has not expired
		
		$check_record=$this->check_record($proofOfRecData);
		
		if($check_record == true){
			$this->db->insert("attachments",$requests);
			$attachments_id = $this->db->insert_id();

			$this->insertInProodOfResDoc($proofOfRecData,$attachments_id);
			return $attachments_id;
			
		}else {
			return false;
		}
		//$this->db->trans_start();
	}

	/**
	 * [check_if_request_made description]
	 * @param  array  $search [description]
	 * @return [type]         [description]
	 */
	public function check_if_request_made($search=array()){
		$searchuser['user_id']=$search['user_id'];

		$check_user_request=$this->getListToComfirm($searchuser);
		
		if(!empty($check_user_request)){
			foreach ($check_user_request as $value) {
				//var_dump($value->administrator_confirmation_date);
				if(!is_null($value->administrator_confirmation_date) ){
					return true;
				}
			}return false;
		}
		return true;
	}

	/**
	 * [check_record description]
	 * @param  [false] $records [check all the information recorded is correct from the database]
	 * @return [true]          [once the information is true]
	 */
	public function check_record($records){
		
		$approved=0;
		$records['approved']=1;
		$check_record=$this->getAttachment($records);
					
		if(!empty($check_record)){
			
			foreach ($check_record as $value) {
				// check if the time has expired
				if($this->check_date($value->expiry_date) ==false){
										
					return true;
				}
			}
			return false;
		}
		else {
			return true;
		}
	}

	/**
	 * [cancelRequest ]
	 * @param  integer $request_id [will be compared and update the deleted to 1 after the user if approve or request is canceled]
	 * @return [type]              [description]
	 */
	public function cancelRequest($request_id=0)
	{

		$request=array(
			'b_deleted'=>'1'
		);
		$this->db->trans_start();
		$this->db->where('id',$request_id) 
		->update("request_docs",$request);

		return $this->db->trans_complete();
	}

	/**
	 * [deleteRequest for confirmResidents view of the empty user data]
	 * @param  integer $request_id [retrieve the information from the database]
	 * @return [type]              [description]
	 */
	public function deleteRequest($request_id=0)
	{
	/*
		$request=array(
			'b_deleted'=>'1'
		);*/
		$this->db->trans_start();
		/*$this->db->where('id',$request_id) 
		->update("request_docs",$request);*/
		$this->db->delete('request_docs',array('id'=>$request_id));
		return $this->db->trans_complete();
	}

	/**
	 * [insert In ProodOfResDoc table]
	 * @param  [type] $proofOfRecData [it retrieved the correct information from the database which where occared form prooof of residencial]
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
 
	/**
	  * [insertMultipleFileData insert the multiple files into data]
	  * @param  array  $data [retrieved the correct information of MultipleFileData from database]
	  * @return [true]       [once it is correct]
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
		     	}

	/*if(!$status){

		 return $status;
		}*/
				
	//return $status;
	}

	/**
	 * [cancelRequestAtta attachment Identity Document when new one is inserted of the same user]
	 * @param  integer $file_id [cancels the request attachemnt ]
	 * @return [true]           [if the attachement is approved]
	 */
	public function cancelRequestAtta($file_id=0){
		return $this->db->delete('attachments',array('attachments.id'=>$file_id));

	}

	/**
	 * [deleteAttachment description]
	 * @param  array   $attachments    [description]
	 * @param  integer $attachments_id [description]
	 * @return [type]                  [description]
	 */
	public function deleteAttachment($attachments=array(),$attachments_id=0){
		/*var_dump($attachments_id,$attachments);
		$this->db->delete('proof_of_res_doc',array($attachments_id));
		$this->db->delete('attachments',array($attachments_id));*/
	}

	/**
	 * [cancel the Request that the user made before owner approves is]
	 * @param  integer $file_id [verify and assigns the request  ]
	 * @return [type]           [if the request has been approved]
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
		$date_request='';
		$requestdata = array(
			'property_id'=>$property_id,
			'user_id'=>$user_id,
			'date_request'=>date('Y-m-d H:i:s'),		     		
		);
		$search['user_id']=$requestdata['user_id'];
		$result=$this->getListToComfirm($search);

		foreach ($result as $value) {			
			$date_request=$value->date_request;
		}
		
		if (empty($result) && $this->check_date($date_request) != false) {
			//return ($this->check_date($date_request));
			return FALSE;
		}
		else {
			
			$this->db->insert("request_docs",$requestdata);
			return true;
		}		
	}


	/**
	 * getListToComfirmRequest, get the list of all the request owner has to confirm  
	 **/

	public function getListToComfirm($search = array(),$limit = ITEMS_PER_PAGE)
	{

		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
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
	public function getListToComfirmRequest($search = array(),$limit = ITEMS_PER_PAGE)
	{
		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
		//call the query to bring the residence
		$this->getListToComfirmRequestQuery($search)

		//establish the limit and start to bring a request to be confirmed by owner
		->limit($limit,$offset);
		
		//get data from bd
		return $this->db->get()->result();
	}
	public function getListToComfirmRequestCount($search = array(),$limit = ITEMS_PER_PAGE)
	{
		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
		//call the query to bring the residence
		$this->getListToComfirmRequestQuery($search);
		return $this->db->count_all_results();	
	}

	/**
	 *get the list of the users that made requests and confimed by the onwer but approved
	 */
	public function listOfApproval($search = array(),$limit = ITEMS_PER_PAGE){

		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 1;
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
		if ($status==2) {

		//delete the user if declined by owner
			$this->cancelRequest($request_id);
	 	//remove the user from lives on table on that particula address
			//$this->removeUserAddress($search);

		}
		return $this->db->trans_complete();
	}

	/**
	 * [approve_status adminitrator declines or approve user request]
	 * @param  integer $status [verify the status of the request]
	 * @param  [type]  $search [description]
	 * @return [boolean]       [true or false]
	 */
	public function approve_status($status=0,$search){
		
		//$request_id=$search['request_id'];
		$request_status=array(
			'administrator_confirmation_states'=>$status,
			'administrator_confirmation_date'=>date('Y-m-d H:i:s')
		);
		//updates proof_of_res_doc table 
		$proof_of_res_doc['approved']=1;
		//setting the value for the expiry date for proof of residence
		$proof_of_res_doc['expiry_date']=date("Y-m-d H:i:s",strtotime("+3 month",strtotime(date("Y-m-d 08:00:00",strtotime("now") ) )));
		
		$this->db->trans_start();
		//update the request_docs table
		$this->db->where('id',$search['request_id'])
		->update('request_docs',$request_status);
		//updates proof_of_res_doc table 
		$this->db->where('user_id',$search['user_id'])
		->where('property_id',$search['property_id'])
		->update('proof_of_res_doc',$proof_of_res_doc);
		if ($status) {
		//delete the user if declined by administrator
			$this->cancelRequest($search['request_id']);
	 	//remove the user from lives on table on that particula address
			//$this->removeUserAddress($search);

		}
		return $this->db->trans_complete();
	}

	/**
	 * the funtion get all the confirmed request by owner 
	 */
	public function getListToApprove($search = array(),$limit = ITEMS_PER_PAGE){

		//where to start bringing the rows for the pagination
		$offset = isset($search['page'])? $search['page'] : 0;
		//call the query to bring the residence
		$this->getListToApproveQuery($search)			


			//establish the limit and start to bring the owner address
		->limit($limit,$offset);
				//get data from bd
		return $this->db->get()->result();
	}
	/**
	 * getListToApproveCount
	 */
	public function getListToApproveCount( $search = array(),$limit = ITEMS_PER_PAGE){

		//where to start bringing the rows for the pagination

		//call the query to bring the residence
		$this->getListToApproveQuery($search);
		return $this->db->count_all_results();
	}

	/**
	 * This checks and verify the date.
	 */
	public function check_date($date){

		
		$date1=strtotime($date);
		$expiry_date=(date($date1 + 3*30*24*3600));
		$currentdate=strtotime(date('Y-m-d H:i:s'));
		//
		$ex_datetime =new DateTime($date);
		$cur_datetime =new DateTime(date('Y-m-d H:i:s'));
		$int=$ex_datetime->diff($cur_datetime);
		$days_left=$int->format('%a days');

		if ($expiry_date <=$currentdate ) {		

			return false;
		}else{
			
			return $days_left;
		}
	}
}

?>
