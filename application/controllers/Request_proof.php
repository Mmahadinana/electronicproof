<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Request_proof extends CI_Controller {


		public function __construct()
	{
		parent::__construct();

		
		//library to access the session
		//$this->load->library("session");
		//$this->load->model("request_model");
		//$this->load->model("approval_model");
		//$this->load->model("ownersProperty_model");
		//$this->load->model("ownersDetails_model");
		//$this->load->model("login_model");
		//$this->load->model("owners_property_model");
		//$this->load->model("listOfRes_model");
		//$this->load->library('pagination');
		logoutByInactiv();
		$is_logged_in = $this->session->userdata('is_logged_in') ?? FALSE;

	}


	

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *Changes
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	

	 
	

/**
	 * [viewRequestMade description]
	 * @return [type] [description]
	 */
	public function viewRequestMade()
	{ 
		$search=array();
		$search['user_id']=$_SESSION['id'];
		
		$data['getListToComfirm']=$this->request_model->getListToComfirm($search);

		$data['pageToLoad']='request/viewRequestMade';
		$data['pageActive']='request';
		$this->load->helper('form');
		// this is for validation 
		
		$this->load->library('form_validation');
		$this->load->view('ini',$data);
		
	}
	//////////****************this function enable the user who has made a request to cancel the request they maderesidence************///////////
	/**
	 * [cancelRequest description]
	 * @return [type] [description]
	 */
	public function cancelRequest()
	{
		
		$search=array();
		$search['request_id']=$this->input->post('request_id');
		$request_id=$search['request_id'];
		//$data['db']=$this->request_model->getListToComfirm($search);
		//var_dump($search['request_id']);

		$data['message']=$this->request_model->cancelRequest($request_id);

		$data['pageToLoad']='request/cancelRequest';
		$data['pageActive']='request';
		$this->load->helper('form');
		// this is for validation 
		
		$this->load->library('form_validation');
		redirect('Request_proof/viewRequestMade');
		
	}

	//////////**************** this function enable the user to make a request for proof of residence************///////////
	/**
	 * [request description]
	 * @return [type] [description]
	 */
public function request()
	{ 

		if(null!=$this->input->get('statusInsert')){
			$data['statusInsert']= $this->input->get('statusInsert');

		}
		if(null!=$this->input->get('days_left')){
			$data['days_left']= $this->input->get('days_left');

		}

		/*Get the property id from the post*/
		$property_id=$this->input->post('property_id');

		if ($property_id == null) {
			//Get the primary address of where the user lives
			$search['primary_add']=1;
			$search['user_id']=$_SESSION['id'];

			$property=$this->request_model->getAddress($search);
			foreach ($property as $value) {
				$property_id=$value->property;				
			}
		}

		$data['property_id']=$property_id;	 
		//get the property id of the selected property
		if ($property_id != null)
		{
			$search=array();

			$search['property_id']= $property_id;
			$search["user_id"]= $_SESSION['id'];


			$data['user_addinfor']= $this->request_model->getAddress($search);

			$data['db']= $this->request_model->getOwner($search);
			//loading the request page 
			$data['pageToLoad']='request/request';
			$data['pageActive']='request';
			/**load thi page title**/
			$data['pageTitle']='Request Form ';
			if(!$this->input->post('usercheck'))

			{

// loading the form and files for file uoload		
				$this->load->helper(array('form','file','url'));

				$this->load->library('form_validation');
// this is for validation 
				$minetypes='';
				$config_validation=array(
					array('field'=>'phone',
						'label'=>'Phone',
						'rules'=>array(
							'required',
							'exact_length[10]',						
							'regex_match[/^[0-9]+$/]',
							array('checkPhone',array($this->Login_model,'callback_checkPhone'))),


						'errors'=>array(
							'required'=>'you should insert a %s ',
							'exact_length'=>'the %s must have at least length of 10 ',						
							'regex_match'=>'the %s must be numbers only',	
							'checkPhone'=>'%s does not exist, please enter the correct email',				
						)	 					
					),		
					array(
						'field'=>'idnumber',
						'label'=>'ID No.',
						'rules'=>array(
							'required',
							'exact_length[13]',
							'numeric',
							array('checkIdnumber',array($this->Login_model,'callback_checkIdnumber'))				
						),
						'errors'=>array(
							'required'=>' %s is required',
							'exact_length'=>'the %s must have 13 numbers',
							'numeric'=>'the %s must have only numbers',
							'checkIdnumber'=>'%s does not exist, please enter the correct email',)

					),

					array('field'=>'email',
						'label'=>'E-mail',
						'rules'=>array(
							'required','valid_email',
							array('checkEmail',array($this->Login_model,'callback_checkEmail'))),
						'errors'=>array(
							'required'=>'%s is required',
							'valid_email'=>'invalid email',
							'checkEmail'=>'%s does not exist, please enter the correct email'

						) 					
					),
					array('field'=>'idUpload',
						'label'=>'idUpload',
				'rules'=>array(//'required',					
					'callback_id_upload'),
					//array('checkFile',array($this->request_model,'callback_checkFile'))
				

				'errors'=>array(
			//'callback_file_upload'=>'%s is required',
			//'checkFile'=>'type for %s exist'


				)
			),
					array('field'=>'fileToUpload',
						'label'=>'fileToUpload',
				'rules'=>array(//'required',					
					'callback_file_upload'),
					//array('checkFile',array($this->request_model,'callback_checkFile'))
				

				'errors'=>array(
			//'callback_do_upload1'=>'%s is required',
			//'checkFile'=>'type for %s exist'


				)
			),

				);		


		//Validating the form
				$this->form_validation->set_rules($config_validation);
				if ($this->form_validation->run()===FALSE) 
				{

					$this->load->view('ini',$data);
				}
				else{

			//send data to the database
					$proofOfRecData=array();
					foreach($data['user_addinfor'] as $property){
						$proofOfRecData['property']= $property->property;
					}

					$proofOfRecData['user_id']=$_SESSION['id'];
					//this will check if the user is on waitin
					$check_proof_hasexpired=$this->request_model->check_record($proofOfRecData);
					$check_if_request_made=$this->request_model->getListToComfirm($proofOfRecData); 
					
					if($_FILES['fileToUpload']['name'][0] != '' && (empty($check_if_request_made)) && $check_proof_hasexpired==true) {

						$fileID=$this->request_model->insertFileData($this->upload_data['file'],'ID',$proofOfRecData);

						
						$multipleFile=$this->request_model->insertMultipleFileData($this->upload_data1,$proofOfRecData);

						$this->requestPreview($data['user_addinfor'],$fileID,$multipleFile);
					}elseif((empty($check_if_request_made)) && $check_proof_hasexpired==true) {
						$fileID=$this->request_model->insertFileData($this->upload_data['file'],'ID',$proofOfRecData);

						$this->requestPreview($data['user_addinfor'],$fileID);
					}else {
						$data['message']='Be patiant, your request in progress';
						$this->load->view('ini',$data);
					}
					

				}

			}
			else{
				$this->load->view('ini',$data);


			}
			
		}
		else {
			//user does not have address they should register their address		
			
			redirect('residents/userprofile');

		}
		

	}
	public function EditRequest()
	{ 
		$search=array();
		//variable will store the attachments id that will be deleted  when user updates
		$attachment_id_id=0;
		$attachment_id_pd=array();

		$property_id=$this->input->post('property_id');
		//data that will bw used in the form
		$data['request_id']=$this->input->post('request_id');
		$data['userid']=$this->input->post('user_id');
		//var_dump($property_id,$data['request_id'],$data['userid']);
		$request_id=$data['request_id'];
		// data that will be used for seach in getAttachment in the model
		
		$search['user_id']=$_SESSION['id'];
		$search['property_id']=$property_id;
		$search['idUpload']='ID';
		// getting the data in attachment for idUpload
		$data['idUpload']=$this->request_model->getAttachment($search);
		if(empty($data['idUpload'])){
			$data['message']=alertMsg(false,'Something went wrong, Make a new request','');
			redirect('Request_proof/request');
		}
		
		foreach($data['idUpload'] as $files){
			$data['idFiles']=$files->original_name;
			//storing identity id
			$attachment_id_id=$files->attachment_id;


		}

		
		$search['idUpload']='';
		$search['fileToUpload']='PD';
		
		// getting the data in attachment for filetoupload
		$data['fileToUpload']=$this->request_model->getAttachment($search);
		//count for attachment id if multiple files inserted in property 
		$i=0;
		foreach($data['fileToUpload'] as $files){
			$data['propFiles']=$files->original_name;	

			if($files->attachment_id != 0){
				//storing id´s
				$attachment_id_pd[$i]=$files->attachment_id;
				$i +=1;
			}

		}
		
		$data['property_id']=$property_id;

		if ($property_id != null) {			

			$search['property_id']= $property_id;
			$search["user_id"]= $_SESSION['id'];

			$data['user_addinfor']= $this->request_model->getAddress($search);
			
			$data['db']= $this->request_model->getOwner($search);			

			$data['pageToLoad']='request/request';
			$data['pageActive']='request';
			/**load thi page title**/
			$data['pageTitle']='Edit Request';
			if(!$this->input->post('usercheck')){

// loading the form and files for file uoload		
				$this->load->helper(array('form','file','url'));

				$this->load->library('form_validation');
// this is for validation 
				$minetypes='';
				$config_validation=array(
					array('field'=>'phone',
						'label'=>'Phone',
						'rules'=>array('required',
							'exact_length[10]',						
							'regex_match[/^[0-9]+$/]',
							array('checkPhone',array($this->Login_model,'callback_checkPhone'))),

						'errors'=>array('required'=>'you should insert a %s ',
							'exact_length'=>'the %s must have at least length of 10 ',						
							'regex_match'=>'the %s must be numbers only',	
							'checkPhone'=>'%s does not exist, please enter the correct email',			
						)	 					
					),		
					array(
						'field'=>'idnumber',
						'label'=>'ID No.',
						'rules'=>array(
							'required',
							'exact_length[13]',
							'numeric',
							array('checkIdnumber',array($this->Login_model,'callback_checkIdnumber'))				
						),
						'errors'=>array(
							'required'=>' %s is required',
							'exact_length'=>'the %s must have 13 numbers',
							'numeric'=>'the %s must have only numbers',
							'checkIdnumber'=>'%s does not exist, please enter the correct email',)

					),

					array('field'=>'email',
						'label'=>'E-mail',
						'rules'=>array('required','valid_email',
							array('checkEmail',array($this->Login_model,'callback_checkEmail'))),
						'errors'=>array(
							'required'=>'%s is required',
							'valid_email'=>'invalid email',
							'checkEmail'=>'%s does not exist, please enter the correct email'

						) 					
					),
					

				);		


		//Validating the form
				$this->form_validation->set_rules($config_validation);
				if ($this->form_validation->run()===FALSE) {

					$this->load->view('ini',$data);
				}else{
			//send data to the database
					$proofOfRecData=array();
					foreach($data['user_addinfor'] as $property){
						$proofOfRecData['property']= $property->property;
					}

					$proofOfRecData['user_id']=$_SESSION['id'];					
					$this->load->view('ini',$data);
				}

			}
			else{
				$this->load->view('ini',$data);


			}
			
		}
		else {
			//user does not have address they should register their address		
			
			redirect('residents/userprofile');
		}
		

	}


	/******UPLOADING A FILE TO THE FLDER***********************/	/******UPLOADING A FILE TO THE FLDER***********************/

	

	/**
	 * [file_upload description]
	 * @return [type] [description]
	 */
	public function file_upload() { 

		$statusFileToUpload ='';
		$pdarray=array();
		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
		$config['upload_path']   ='./file_upload/';
		$config['encrypt_name']   =true;			
		$config['overwrite']     = false;
		$config['max_size']	 = '599120';
		if ($_FILES['fileToUpload']['name'] != '') 
		{


			$minetype='PD';
//upload file

			$number_of_files_uploaded= count($_FILES['fileToUpload']['name']);
			for($i=0; $i<$number_of_files_uploaded; $i++)
			{
				$_FILES['filetoUpload']['name']		= $_FILES['fileToUpload']['name'][$i];
				$_FILES['filetoUpload']['type']		= $_FILES['fileToUpload']['type'][$i];
				$_FILES['filetoUpload']['tmp_name']	= $_FILES['fileToUpload']['tmp_name'][$i];
				$_FILES['filetoUpload']['error']	= $_FILES['fileToUpload']['error'][$i];
				$_FILES['filetoUpload']['size']		= $_FILES['fileToUpload']['size'][$i];  

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$statusFileToUpload =$this->upload->do_upload('filetoUpload');


				if (!$statusFileToUpload && $_FILES['filetoUpload']['name'] != '')
				{
					$this->form_validation->set_message('file_upload', $this->upload->display_errors());
					return false;
				}
				elseif($statusFileToUpload)
				{

					$this->upload_data1[]['file'] = $this->upload->data();


				//$this->request_model->addIdUpload($this->upload_data['file']);
				}
			}
			//var_dump($this->upload_data1 );
		}
	}


	// *****************************************************************upload for the identity document************************************/
/**
 * [id_upload description]
 * @return [type] [description]
 */
public function id_upload(){
// upload file uptions
	$config['allowed_types'] = 'pdf|jpg|png|jpeg';
	$config['upload_path']   ='./id_upload/';
	$config['encrypt_name']   =true;			
	$config['overwrite']     = false;
	$config['max_size']	 = '5120';
	$minetype='ID' ;
//upload file for ID
	if($_FILES['idUpload']['size'] != 0){
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$statusIdUpload =$this->upload->do_upload('idUpload');

		if (!$statusIdUpload){
			$this->form_validation->set_message('id_upload', $this->upload->display_errors());
			return false;
		}
		elseif($statusIdUpload)
		{
			$this->upload_data['file'] = $this->upload->data();
			//send data to the database	
				//$this->request_model->addIdUpload($this->upload_data['file'],$minetype);

		}

		}//error if there in no file to upload

		return true;
	}
// **********************************************the success page of the request*******************************************************************************************//
/**
 * [requestPreview description]
 * @param  array  $user_addinfor [description]
 * @return [type]                [description]
 */
public function requestPreview($user_addinfor=array(),$fileID=0,$multipleFile=0)
{ 
	
	$search=array();
	if (empty($user_addinfor)) {
		$search['property_id']=$this->input->post('property_id');
		$search['userid']=$this->input->post('user_id');

		$user_addinfor= $this->request_model->getAddress($search);

	}else {
		foreach($user_addinfor as $userdata)
		{
			$search['property_id']=$userdata->property;
			$search['userid']=$userdata->id;


		}
	}
	
	
	$data['multipleFile']=$multipleFile;
	$data['fileID']=$fileID;


	$data['residentInfor']=$user_addinfor;
	$data['owner_addinfor']=$this->request_model->getOwner($search);
	
	//check if there is owner
	if(empty($data['owner_addinfor'])){
		//delete user adddress of where there is no owner
		$this->request_model->removeUserAddress($search);
		redirect("residents/userprofile?statusRequest=0");
		
	}
		/*$data['fileAttament1']=$this->request_model->cancelRequest($fileID);
		$data['fileAttament2']=$this->request_model->cancelRequest($multipleFile);
		var_dump($data['fileAttament1']);*/
		//$data['user_id']= $this->request_model->getAddress($search);
		$data['pageToLoad']='request/requestPreview';
		$data['pageActive']='request';
		$this->load->helper('form');
		
		
		
		$this->load->view('ini',$data);

	}
	
//end of request preview
/**
 * [confirmRequestInsert description]
 * @return [type] [description]
 */
public function confirmRequestInsert()
{
	$property_id=$this->input->post('property_id');
	$owner_id=$this->input->post('owner_id');
	$user_id=$this->input->post('user_id');

	if ($property_id != null) {
		$listvar=array('property_id'=>$property_id,'owner_id'=>$owner_id,'user_id'=>$user_id);

		$this->session->set_userdata($listvar);
	}
	else {

		$property_id=$_SESSION['property_id'];
		$owner_id=$_SESSION['owner_id'];
		$user_id=$_SESSION['user_id'];

	}
	$results=$this->request_model->insertRequest($user_id,$owner_id,$property_id);
	
	if($results!=true){
			//redirecting to the other page
		$statusInsert=0;
		redirect("Request_proof/request/$results?statusInsert=$statusInsert");
	}else {
			
		$this->waitingForApproval($user_id,$property_id,$status=1);
		

	}
	
}
/*public function updateRequest()
{
	$property_id=$this->input->post('property_id');
	//$owner_id=$this->input->post('owner_id');
	$user_id=$this->input->post('user_id');
var_dump($property_id,$user_id);
	if ($property_id != null) {
		$listvar=array('property_id'=>$property_id,'user_id'=>$user_id);

		$this->session->set_userdata($listvar);
	}
	else {

		$property_id=$_SESSION['property_id'];
		//$owner_id=$_SESSION['owner_id'];
		$user_id=$_SESSION['user_id'];

	}
	$statusUpdate=$this->request_model->updateRequest($user_id,$owner_id,$property_id);
	
			//redirecting to the other page
	

	redirect("residents/request?statusUpdate=$statusUpdate");
	
	
}*/
public function askDelete()


{   

	//$cancel=$this->input->post('cancel');
	$user_id=$this->input->post('user_id');
	$property_id=$this->input->post('property_id');
	

	$data['pageToLoad']='eresidence/askDelete';
	$data['pageActive']='eresidence';
	$this->load->helper('form');	

	$this->load->view('ini',$data);
}
	/**
	 * [waitingForApproval description]
	 * @param  integer $user_id     [description]
	 * @param  integer $property_id [description]
	 * @return [type]               [description]
	 */
	public function waitingForApproval($user_id=0,$property_id=0,$status)
	{ 
		//status for the inserted request
		$data['statusInsert']= $status;

		$search=array();

		$search['user_id']= $user_id;
		$search['property_id']= $property_id;
		//$search[23]= $this->input->get('user_id') ?? '0';
		if ($property_id != null) {
			$listvar=array('property_id'=>$property_id,'user_id'=>$user_id);

			$this->session->set_userdata($listvar);
		}
		else {
			
			$property_id=$_SESSION['property_id'];			
			$user_id=$_SESSION['user_id'];
			
		}

		$data['user_addinfor']= $this->request_model->getAddress($search);
		$data['user_id']= $search['user_id'];




		//$data['user_id']= $this->request_model->getAddress($search);
		$data['pageToLoad']='request/waitingForApproval';
		$data['pageActive']='request';
		$this->load->helper('form');
		// this is for validation 
		
		$this->load->library('form_validation');
		$this->load->view('ini',$data);

	}

/**
 * [getOwnerOfProperty description]
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
	public function getOwnerOfProperty($user_id){
		
		$search=array();
		$confirmlist=array();
		$search['user_id']=$user_id;

		
		
		return $data['owner']=$this->request_model->getOwner($search);

	}
	/**
	 * [confirmList description]
	 * @return [type] [description]
	 */
	public function confirmList() 
	{

  //user that does is not owner have no access to this view
  if ($_SESSION['owner'] != true) {
    redirect(base_url());
  }
		$search=array();		
		$requestPropertyID=array();		
		//$data['getOwnerListToComfirm']=array();		
		$data['owner']=$this->getOwnerOfProperty($_SESSION['id']);
		$search['owner']=$_SESSION['id'];
		//$count=count($data['owner']);
		$data['getListToComfirm']=$this->request_model->getListToComfirmRequest($search);
		//var_dump($data['owner']);
		foreach ($data['owner'] as $owner) {
		
			foreach ($data['getListToComfirm'] as $confirm) {
				if ($confirm->property_id==$owner->property) {
					
					/*$requestPropertyID[$confirm->property_id]=$confirm->property_id;*/
					//get the list that owner should complete
					$data['getOwnerListToComfirm']=$this->request_model->getListToComfirm();
					
				}					
			}		

			//$ownerPropertyID[$owner->property]=$owner->property;
			
		}
				
		
		
		
		/*foreach ($data['getListToComfirm'] as $confirm) {
			$requestPropertyID[$confirm->property_id]=$confirm->property_id;
		}
		if (expr) {
			
		}*/

		$data['pageToLoad']='request/confirmList';
		$data['pageActive']='request';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('ini',$data);


	}
	

/**
	 * [listOfApproval page]
	 * @return [type] [description]
	 */
	public function listOfApproval() 
	{
		if(null!=$this->input->get('statusApprove')){
			$data['statusApprove']= $this->input->get('statusApprove');

		}
		if(null!=$this->input->get('statusUpdate_AdminD')){
			$data['statusUpdate_AdminD']= $this->input->get('statusUpdate_AdminD');

		}
		if(null!=$this->input->get('statusUpdate_AdminA')){
			$data['statusUpdate_AdminA']= $this->input->get('statusUpdate_AdminA');

		}
		$search=array();		
		//might be used later for identify the person who approved the user
		$data['owner']=$this->getOwnerOfProperty($_SESSION['id']);
		
		/*foreach ($data['owner'] as $owner) {
			$search['property']=$owner->property;			
		}*/		
		
		$data['getListToComfirm']=$this->request_model->getListToApprove($search);

		$data['pageToLoad']='request/listOfApproval';
		$data['pageActive']='request';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('ini',$data);
	}
	/**
 * [load approve page for admin]
 * @return [type] [description]
 */
public function approveResident()
{
	if($_SESSION['role']!="admin")
	{
		redirect('login/login_');
	}
	$search=array();

	//$search['owner_id']= $this->input->post('owner_id');
	$search['request_id']= $this->input->post('request_id');

	//data for the user that is to be approved
	$search['user_id']= $this->input->post('user_id');
	
	$search['property_id']= $this->input->post('property_id');
	if($search['request_id']==null){
	//$data['statusApprove']=0;
		redirect('Request_proof/listOfApproval?statusApprove=0');
	}
	//data that will be stored in hidden input
	$data['user_id']=$search['user_id'];
	$data['property_id']=$search['property_id'];
	$data['request_id']=$search['request_id'];
	

	/*if ($search['property_id'] != null) {
		$listvar=array('property_id'=>$search['property_id'],
			'owner_id'=>$search['owner_id'],
			'user_id'=>$search['user_id'],
			'request_id'=>$search['request_id'],
		);

		$this->session->set_userdata($listvar);
	}
	else {

		$search['property_id']=$_SESSION['property_id'];
		$search['owner_id']=$_SESSION['owner_id'];
		$search['user_id']=$_SESSION['user_id'];
		$search['request_id']=$_SESSION['request_id'];

	}
	///*/
	$data['user_addinfor']= $this->approval_model->getAddress($search);

	// if there is no data delete the request
	if(empty($data['user_addinfor'])){
		$this->request_model->cancelRequest($search['request_id']);

	}
	$data['user_addr']= $this->request_model->getListToComfirm($search);

	/*if(empty($data['user_addinfor'])){
			$me=$this->request_model->deleteRequest($search['request_id']);

			redirect('residents/userprofile?statusConfirm=$me');
		}*/

		$data['pageToLoad']='request/approveResident';
		$data['pageActive']='request';

// loading the form and files for file uoload		
		$this->load->helper(array('form','file','url'));
		//$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->view('ini',$data);

	}

	public function approve()
	{
		if($_SESSION['role']!="admin")
		{
			redirect('login/login_');
		}
		$search=array();

	//$search['user_id']= $_SESSION['id'];
		$search['user_id']= $this->input->post('user_id');
		$search['property_id']= $this->input->post('property_id');
		$search['request_id']= $this->input->post('request_id');
		$data['user_request']=$this->request_model->getUserRequest($search);
		$data['userid']=$search['user_id'];

	//here administrator has approved the user
		if($this->input->post('approve')){
			$confirm=$this->request_model->approve_status(1,$search);
			
			redirect('Request_proof/listOfApproval?statusUpdate=$confirm');

		}

	//administrator has declined the usr request
		elseif($this->input->post('disapprove')){

			$confirm=$this->request_model->approve_status(2,$search);
			redirect('Request_proof/listOfApproval?statusUpdate=$confirm');
		}

	}
/**
 * [confirmResident page owner and the requester]
 * @return [type] [description]
 */
public function confirmResident()
{
	
	$search=array();

	$search['owner_id']= $this->input->post('owner_id');
	$search['request_id']= $this->input->post('request_id');
	$search['user_id']= $this->input->post('user_id');
	$search['property_id']= $this->input->post('property_id');


	if ($search['property_id'] != null) {
		$listvar=array('property_id'=>$search['property_id'],
			'owner_id'=>$search['owner_id'],
			'user_id'=>$search['user_id'],
			'request_id'=>$search['request_id'],
		);

		$this->session->set_userdata($listvar);
	}
	else {

		$search['property_id']=$_SESSION['property_id'];
		$search['owner_id']=$_SESSION['owner_id'];
		$search['user_id']=$_SESSION['user_id'];
		$search['request_id']=$_SESSION['request_id'];

	}
	///
	$data['user_addinfor']= $this->approval_model->getAddress($search);
	if(empty($data['user_addinfor'])){
		$me=$this->request_model->deleteRequest($search['request_id']);

		redirect('residents/userprofile?statusConfirm=$me');
	}

	$data['pageToLoad']='request/confirmResident';
	$data['pageActive']='request';

// loading the form and files for file uoload		
	$this->load->helper(array('form','file','url'));
		//$this->load->helper(array('form','url'));
	$this->load->library('form_validation');
	$this->load->view('ini',$data);

}
/**
 * [confirm page for the owner]
 * @return [type] [description]
 */
public function confirm()
{
	$search=array();

	
	//$search['user_id']= $_SESSION['id'];
	$search['user_id']= $this->input->post('user_id');
	$search['property_id']= $this->input->post('property_id');
	$search['request_id']= $this->input->post('request_id');
	$data['user_request']=$this->request_model->getUserRequest($search);
	$data['userid']=$search['user_id'];
	
	//owner confirms the user request
	if($this->input->post('confirm')){
		$confirm=$this->request_model->confirm_status(1,$search);

		redirect('Request_proof/confirmList?statusUpdate_OwnerC=$confirm');
		
	}
	//owner declined the user request
	elseif($this->input->post('decline')) {

		$confirm=$this->request_model->confirm_status(2,$search);
		redirect('Request_proof/confirmList?statusUpdate_OwnerD=$confirm');
	}
	//here administrator has approved the user
	elseif($this->input->post('approval')){
		$confirm=$this->request_model->approve_status(1,$search);
		
		$this->index($search['user_id'],$search['property_id']);
		
	}
	//administrator has declined the usr request
	elseif($this->input->post('disapprove')){
		$data['message']="'User request was not decline','Request was declined successfully'";
		$confirm=$this->request_model->approve_status(2,$search);
		redirect('Request_proof/listOfApproval?statusUpdate_AdminD=$confirm');
	}


}

public function check_date(){
	$search['user_id']=$this->input->post('user_id');
	$search['property_id']=$this->input->post('property_id');
	$data['user_data']=$this->request_model->getUserRequest($search);

	$data['days_left']=0;

	foreach ($data['user_data'] as $value) {
		//later
		//$data['days_left']=$this->request_model->check_date($value->administrator_confirmation_date);
		if ($value->b_deleted == 0) {
			$data['days_left']=$this->request_model->check_date($value->date_request);

		}
	}
	echo json_encode($data['days_left']);

}

 public	function index($userid,$property_id)
 	{
 		
 		$search['userid']=$userid;
         $search['property_id']=$property_id;
 		$data['pageToLoad']='makePDF/makepdf';
		$data['pageActive']='makepdf';
		//$this->load->view('ini',$data);

 		$this->load->library('Pdf');

 		$data['user_addinfor']= $this->request_model->getAddress($search);
 		$data['owner_addinfor']=$this->request_model->getOwner($search);
	//var_dump($data['owner_addinfor']);
	//check if there is owner
	if(empty($data['owner_addinfor'])){
		//delete user adddress of where there is no owner
		//$this->request_model->removeUserAddress($search);
		redirect("Testing/index?statusRequest=0");
		
	}

 		$this->load->view('makePDF/makepdf',$data);


 	}
}


