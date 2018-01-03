<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Residents extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		header('Cache-Control: no-cache,must-revalidate, max-age=0');
		header('Cache-Control:post-check=0, pre-check=0', false);
		header('Pragma:no-cache');

		//library to access the session
		$this->load->library("session");
		$this->load->model("request_model");
		$this->load->model("approval_model");
		$this->load->model("ownersProperty_model");
		$this->load->model("ownersDetails_model");
		$this->load->model("manucipality_model");
		$this->load->model("district_model");
		$this->load->model("province_model");
		$this->load->model("user_model");
		$this->load->model("login_model");
		$this->load->model("owners_property_model");	

		$this->load->model("listOfRes_model");
		$this->load->library('pagination');
		logoutByInactiv();
		$is_logged_in = $this->session->userdata('is_logged_in') ?? FALSE;
		if (!$is_logged_in)
		 {
			//no login check the cookie
			if (!$this->login_model->CheckLoginWithCookie()) {
				//no login go out
				redirect(base_url('login/login_?frompage=eresidence'));
			}   

		}


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

	

	 
	

/************* this function enable the user who has made a request to view the request they maderesidence*************/
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
		redirect('request/viewRequestMade');
		
	}

	//////////**************** this function enable the user to make a request for proof of residence************///////////
	/**
	 * [request description]
	 * @return [type] [description]
	 */
	public function request()
	{ 

		$property_id=$this->input->post('property_id');
		//var_dump($property_id);	
		$data['property_id']=$property_id;	
		if ($property_id != null)
		 {
			$search=array();

			$search['property_id']= $property_id;
			$search["user_id"]= $_SESSION['id'];


			$data['user_addinfor']= $this->request_model->getAddress($search);

			$data['db']= $this->request_model->getOwner($search);

			$data['pageToLoad']='request/request';
			$data['pageActive']='request';
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
							array('checkPhone',array($this->login_model,'callback_checkPhone'))),


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
							array('checkIdnumber',array($this->login_model,'callback_checkIdnumber'))				
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
							array('checkEmail',array($this->login_model,'callback_checkEmail'))),
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
					$fileID=$this->request_model->insertFileData($this->upload_data['file'],'ID',$proofOfRecData);
					
					$multipleFile=$this->request_model->insertMultipleFileData($this->upload_data1,$proofOfRecData);
					
			/*/$this->load->view('ini',$data); 
					$this->requestPreview($data['user_addinfor']);
			//redirect('residents/requestPreview/'.$this->input->get('user_id'));

			//send data to the database
					$this->request_model->insertFileData($this->upload_data['file'],'ID');
					
					$this->request_model->insertMultipleFileData($this->upload_data1);
			//$this->load->view('ini',$data); */

					$this->requestPreview($data['user_addinfor'],$fileID,$multipleFile);
			//redirect('residents/requestPreview/'.$this->input->get('user_id'));
				}

			}
			else{
				$this->load->view('ini',$data);


			}
			
		}
		else {
			redirect('residents/userprofile');
		}
		

	}
	public function EditRequest()
	{ 
		$search=array();
		
		$property_id=$this->input->post('property_id');
		$data['request_id']=$this->input->post('request_id');
		$request_id=$data['request_id'];
	
		//$search['request_id']=$request_id;
		$search['user_id']=$_SESSION['id'];
		$search['idUpload']='ID';
		
		$data['fileToUpload']=$this->request_model->getAttachment($search);
		
		$search['fileToUpload']='PD';
		$search['idUpload']='';
		$data['idUpload']=$this->request_model->getAttachment($search);

		$data['property_id']=$property_id;	
		if ($property_id != null) {
			

			$search['property_id']= $property_id;
			$search["user_id"]= $_SESSION['id'];


			$data['user_addinfor']= $this->request_model->getAddress($search);
			
			$data['db']= $this->request_model->getOwner($search);
			

			$data['pageToLoad']='request/request';
			$data['pageActive']='request';
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
							array('checkPhone',array($this->login_model,'callback_checkPhone'))),


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
							array('checkIdnumber',array($this->login_model,'callback_checkIdnumber'))				
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
							array('checkEmail',array($this->login_model,'callback_checkEmail'))),
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
				if ($this->form_validation->run()===FALSE) {

					$this->load->view('ini',$data);
				}else{
			/*
			//send data to the database
			$proofOfRecData=array();
			foreach($data['user_addinfor'] as $property){
				$proofOfRecData['property']= $property->property;

			}
			//$property_id=
			$proofOfRecData['user_id']=$_SESSION['id'];
					$this->request_model->insertFileData($this->upload_data['file'],'ID',$proofOfRecData);
					//var_dump($this->upload_data1['file']);
					$this->request_model->insertMultipleFileData($this->upload_data1,$proofOfRecData);
			//$this->load->view('ini',$data); 
					$this->requestPreview($data['user_addinfor']);
			//redirect('residents/requestPreview/'.$this->input->get('user_id'));

			*/
			//send data to the database
					//$this->request_model->insertFileData($this->upload_data['file'],'ID');
					//var_dump($this->upload_data1['file']);
					//$this->request_model->insertMultipleFileData($this->upload_data1);
			//$this->load->view('ini',$data); 

					$this->requestPreview($data['user_addinfor']);
			//redirect('residents/requestPreview/'.$this->input->get('user_id'));
				}

			}else{
				$this->load->view('ini',$data);


			}
			
		}else {
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
		else
		{
			$this->form_validation->set_message('id_upload', "Identity document must be uploaded ");
			return false;
			
		}		
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
		foreach($user_addinfor as $userdata)
		{
			$search['property_id']=$userdata->property;
			
		}
		$data['multipleFile']=$multipleFile;
		$data['fileID']=$fileID;

		
		$data['residentInfor']=$user_addinfor;
		$data['owner_addinfor']=$this->request_model->getOwner($search);
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
		$this->request_model->insertRequest($user_id,$owner_id,$property_id);
		//redirect('residents/waitingForApproval/'.$user_id);
		$this->waitingForApproval($user_id,$property_id);
	}

	/**
	 * [waitingForApproval description]
	 * @param  integer $user_id     [description]
	 * @param  integer $property_id [description]
	 * @return [type]               [description]
	 */
	public function waitingForApproval($user_id=0,$property_id=0)
	{ 
	
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
		$data['pageToLoad']='requestrequest/waitingForApproval';
		$data['pageActive']='requestrequest';
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
	

	$data['pageToLoad']='request/confirmResident';
	$data['pageActive']='request';

// loading the form and files for file uoload		
	$this->load->helper(array('form','file','url'));
		//$this->load->helper(array('form','url'));
	$this->load->library('form_validation');
	$this->load->view('ini',$data);

}
public function confirm()
{
	$search=array();

	
	//$search['user_id']= $_SESSION['id'];
	$search['user_id']= $this->input->post('user_id');
	$search['property_id']= $this->input->post('property_id');
	$search['request_id']= $this->input->post('request_id');
	$data['user_request']=$this->request_model->getUserRequest($search);
	

	if($this->input->post('confirm')){
		//$this->request_model->confirm_status(1,$search);
	
		redirect('request/confirmList');
	}
	else {

		$this->request_model->confirm_status(2,$search);
		redirect('request/confirmList');
	}
}


}


