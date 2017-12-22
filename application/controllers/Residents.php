<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Residents extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
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

	// This function list all the properties and enable search for property
	public function Eresidence()
	{
		//var_dump($_SESSION);
		$id_remove=$this->input->post('id_Property');
		if ($id_remove!=0 and is_numeric($id_remove))
		{
			$data['statusRemove']= $this->ownersProperty_model->deleteProperty($id_remove);

		}
		if(null!=$this->input->get('statusEdit'))
		{
			$data['statusEdit']= $this->input->get('statusEdit');
		}
		if(null!=$this->input->get('statusInsert'))
		{
			$data['statusInsert']= $this->input->get('statusInsert');
		}	


		$data['pageToLoad']='eresidence/eresidence';
		$data['pageActive']='eresidence';
		$this->load->helper('form');	
		
		/** start search for property   **/		
		$search['inputForSearch']=$this->input->get('inputForSearch')??0;
		$data['inputForSearch']=$this->input->get('inputForSearch');
		
		$search['name'] = '';
		$search['property_id'] = 0;
		$search['town'] = '';
		$search['municipality'] = '';
		$search['district'] = '';
		$search['province'] = '';

		if ($data['inputForSearch']==1) 
		{

			$search['name']=$this->input->get('mysearch') ?? '';
		}
		elseif ($data['inputForSearch']== 2) 
		{
			$search['property_id']=$this->input->get('mysearch') ?? 0;

		}
		elseif($data['inputForSearch']== 3)
		{
			$search['town']=$this->input->get('mysearch') ?? '';
		}
		elseif($data['inputForSearch']== 4)
		{
			$search['municipality']=$this->input->get('mysearch') ?? '';
		}
		elseif($data['inputForSearch']== 5)
		{
			$search['district']=$this->input->get('mysearch') ?? '';
		}
		elseif($data['inputForSearch']== 6)
		{
			$search['province']=$this->input->get('mysearch') ?? '';
		}

		$search['page']=$this->input->get('per_page')??0;


		$data['search']=$search;
		//var_dump($search);		
		$data['db']=$this->ownersProperty_model->getProperty($search);
		
		$data['countProperties']=$this->ownersProperty_model->countProperties($search);

		//pagination for the Properties
		
		$config['enable_query_string']=true;
		//this is the one to show the actual page number,?page=someInt
		$config['page_query_string']=true;
		//url that will use the link
		$config['base_url']=base_url('residents/eresidence?inputForSearch='.$data["inputForSearch"].'&mysearch='.$this->input->get('mysearch'));

		//number of results to be devided on the pagintion
		$config['total_rows']=$data['countProperties'];
		//load the pagination library		
		
		// atribute for the class assigned to the pagination
		
		$config['uri_segment']  = 3;
		//intialize the pagination with our config
		$this->pagination->initialize($config);
		$data['search_pagination']=$this->pagination->create_links();



		$this->load->view('ini',$data);


	}

	//////////**************** this function enable the user who has made a request to view the request they maderesidence************///////////
	public function viewRequestMade()
	{ 
		$search=array();
		$search['user_id']=$_SESSION['id'];
		
		$data['getListToComfirm']=$this->request_model->getListToComfirm($search);

		$data['pageToLoad']='eresidence/viewRequestMade';
		$data['pageActive']='eresidence';
		$this->load->helper('form');
		// this is for validation 
		
		$this->load->library('form_validation');
		$this->load->view('ini',$data);
		
	}
	//////////****************this function enable the user who has made a request to cancel the request they maderesidence************///////////
	public function cancelRequest()
	{
		
		$search=array();
		//$search['request_id']=$this->input->post('user_id');
		$request_id=$search['request_id'];
		$data['db']=$this->request_model->getListToComfirm($search);
		var_dump($data['db']);

		$data['message']=$this->request_model->cancelRequest($request_id);

		$data['pageToLoad']='eresidence/cancelRequest';
		$data['pageActive']='eresidence';
		$this->load->helper('form');
		// this is for validation 
		
		$this->load->library('form_validation');
		redirect('residents/viewRequestMade');
		
	}

	//////////**************** this function enable the user to make a request for proof of residence************///////////
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

			$data['pageToLoad']='eresidence/request';
			$data['pageActive']='eresidence';
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

			}
			else{
				$this->load->view('ini',$data);


			}
			
		}
		else {
			redirect('residents/userprofile');
		}
		

	}


	/******UPLOADING A FILE TO THE FLDER***********************/	/******UPLOADING A FILE TO THE FLDER***********************/
	public function file_upload()
	 	{ 
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
	public function requestPreview($user_addinfor=array())
	{ 
		$search=array();
		foreach($user_addinfor as $userdata)
		{
			$search['property_id']=$userdata->property;
			
		}
		
		$data['residentInfor']=$user_addinfor;
		$data['owner_addinfor']=$this->request_model->getOwner($search);
		
		

		//$data['user_id']= $this->request_model->getAddress($search);
		$data['pageToLoad']='eresidence/requestPreview';
		$data['pageActive']='eresidence';
		$this->load->helper('form');
		
		
		
		$this->load->view('ini',$data);

	}
	public function userprofile()
	{ 
		$search=array();
		$properties=array();
		$search['user_idprofile']= $_SESSION['id'];

		//$search[23]= $this->input->get('user_id') ?? '0';


		$data['user_addinfor']= $this->request_model->getUser($search);
		$data['property_addinfor']= $this->ownersProperty_model->getProperty($search);
		$data['add_addinfor']= $this->owners_property_model->getProperty($search);

		$data['pageToLoad']='userprofile/userprofile';
		$data['pageActive']='userprofile';
		
// loading the form and files for file uoload		
		$this->load->helper(array('form','file','url'));
		//$this->load->helper(array('form','url'));
		$this->load->library('form_validation');		

		$this->load->view('ini',$data);

	}
//end of request preview

	public function confirmRequestInsert()
	{
		$property_id=$this->input->post('property_id');
		$owner_id=$this->input->post('owner_id');
		$user_id=$this->input->post('user_id');
		$this->request_model->insertRequest($user_id,$owner_id,$property_id);
		//redirect('residents/waitingForApproval/'.$user_id);
		$this->waitingForApproval($user_id,$property_id);
	}
	public function waitingForApproval($user_id=0,$property_id=0)
	{ 
	
		$search=array();

		$search['user_id']= $user_id;
		$search['property_id']= $property_id;
		//$search[23]= $this->input->get('user_id') ?? '0';


		$data['user_addinfor']= $this->request_model->getAddress($search);
		$data['user_id']= $search['user_id'];

	


		//$data['user_id']= $this->request_model->getAddress($search);
		$data['pageToLoad']='eresidence/waitingForApproval';
		$data['pageActive']='eresidence';
		$this->load->helper('form');
		// this is for validation 
		
		$this->load->library('form_validation');
		$this->load->view('ini',$data);

	}

	public function listOfResidents($property_id = 0)
	{
		$search=array();

		$search['property_id']=$property_id;
		$search['property_id1']=$property_id;

	//$search['user_id']= $_SESSION['id'];

		$data['user_addinfor']= $this->listOfRes_model->getAddress($search);
		//var_dump($data['user_addinfor']);
		$data['add_addinfor']= $this->listOfRes_model->getAddressTwo($search);
		$data['pageToLoad']='eresidence/listOfResidents';
		$data['pageActive']='eresidence';

     //loading the form and files for file uoload		
		$this->load->helper(array('form','file','url'));
	//$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	//$this->load->view('ini',$data);

		$config_validation=array(
			array('field'=>'name',
				'label'=>'name',
				'rules'=>array(
					'required',
					'exact_length[10]',						
					'regex_match[/^[0-9]+$/]'),


				'errors'=>array(
					'required'=>'you should insert a %s ',
					'exact_length'=>'the %s must have at least length of 10 ',						
					'regex_match'=>'the %s must be numbers only',					
				)	 					
			),		
			array(
				'field'=>'address',
				'label'=>'address.',
				'rules'=>array(
					'required',
					'exact_length[13]',
					'numeric',				
				),
				'errors'=>array(
					'required'=>' %s is required',
					'exact_length'=>'the %s must have 13 numbers',
					'numeric'=>'the %s must have only numbers',)

			),

			array('field'=>'date',
				'label'=>'date',
				'rules'=>array(
					'required','valid_email'),
					'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',

				) 					
			),
			array('field'=>'edit',
				'label'=>'edit',
				'rules'=>array(
					'required','valid_email'),
				    'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',

				) 					
			),			
		);		


		$this->form_validation->set_rules($config_validation);
		if ($this->form_validation->run()===FALSE) {

			$this->load->view('ini',$data);
		}else{


		}

	}

	public function getOwnerOfProperty($user_id){
		
		$search=array();
		$confirmlist=array();
		$search['user_id']=$user_id;

		
		
		return $data['owner']=$this->request_model->getOwner($search);

	}
	public function confirmList() 
	{
		$search=array();		
		$requestPropertyID=array();		
		//$data['getOwnerListToComfirm']=array();		
		$data['owner']=$this->getOwnerOfProperty($_SESSION['id']);
		
		//$count=count($data['owner']);
		$data['getListToComfirm']=$this->request_model->getListToComfirm();
		/*foreach ($data['owner'] as $owner) {
		
			foreach ($data['getListToComfirm'] as $confirm) {
				if ($confirm->property_id==$owner->property) {
					
					$requestPropertyID[$confirm->property_id]=$confirm->property_id;
					$data['getOwnerListToComfirm']=$this->request_model->getListToComfirm($requestPropertyID);
				}					
			}		

			//$ownerPropertyID[$owner->property]=$owner->property;

		}
		var_dump($requestPropertyID);*/		
		
		
		
		/*foreach ($data['getListToComfirm'] as $confirm) {
			$requestPropertyID[$confirm->property_id]=$confirm->property_id;
		}
		if (expr) {
			
		}*/
		$data['pageToLoad']='eresidence/confirmList';
		$data['pageActive']='eresidence';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('ini',$data);


	}
	public function listOfApproval() 
	{
		$search=array();		
		
		$data['owner']=$this->getOwnerOfProperty($_SESSION['id']);
		
		foreach ($data['owner'] as $owner) {
			$search['property']=$owner->property;			
		}		
		
		$data['getListToComfirm']=$this->request_model->getApproveToComfirm($search);

		$data['pageToLoad']='eresidence/confirmList';
		$data['pageActive']='eresidence';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('ini',$data);


	}
	
	
		public function OwnersDetails($property_id = 0)
	{
		$search=array();
		$search['property_id']=$property_id;
		$search['property_id1']=$property_id;
		$data['user_addinfor']= $this->ownersDetails_model->getAddressTwo($search);

	//var_dump($data['user_addinfor']);

		$data['pageToLoad']='eresidence/OwnersDetails';
		$data['pageActive']='eresidence';

		$this->load->helper('form');
		$this->load->library('form_validation');

		$config_validation=array(
			array('field'=>'name',
				'label'=>'name',
				'rules'=>array(
					'required',
					'exact_length[10]',						
					'regex_match[/^[0-9]+$/]'),


				'errors'=>array(
					'required'=>'you should insert a %s ',
					'exact_length'=>'the %s must have at least length of 10 ',						
					'regex_match'=>'the %s must be numbers only',					
				)	 					
			),		
			array(
				'field'=>'address',
				'label'=>'address.',
				'rules'=>array(
					'required',
					'exact_length[13]',
					'numeric',				
				),
				'errors'=>array(
					'required'=>' %s is required',
					'exact_length'=>'the %s must have 13 numbers',
					'numeric'=>'the %s must have only numbers',)

			),

			array('field'=>'date',
				'label'=>'date',
				'rules'=>array(
					'required','valid_email'),
					'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',

				) 					
			),
			array('field'=>'edit',
				'label'=>'edit',
				'rules'=>array(
					'required','valid_email'),
					'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',

				) 					
			),			
		);		



		$this->form_validation->set_rules($config_validation);
		if ($this->form_validation->run()===FALSE) 
		{

			$this->load->view('ini',$data);
		}
		else{


		}

	}
	
	public function ResidencialProperty()
	{
		$data['pageToLoad']='eresidence/ResidencialProperty';
		$data['pageActive']='ResidencialProperty';
		
		$id =  $_SESSION['id'];

		$search['user_id']= $_SESSION['id'];	
		$search['mysearch']= $this->input->get('mysearch')??'';
		$search['page']=$this->input->get('per_page')??0;
		
		$data['search']=$search;

	//$data['user_addinfor']= $this->request_model->getUser($search);
		//$config['per_page'] = 3;

		$data['property_addinfor']= $this->owners_property_model->getProperty($search);
		//$data['mysearch']= $this->owners_property_model->getProperty($search);
		$data['addressCount']=$this->ownersProperty_model->countProperties($search);

		$config['enable_query_string'] = TRUE;
		
		//to show the actual page number
		$config['page_query_string'] = TRUE;
		//config base_url that use pagination
		$config['base_url'] = base_url('residents/ResidencialProperty?mysearch='.$search['mysearch']);

		//number of results to be divided on the pagination
		$config['total_rows'] =$data['addressCount'];
		//load the pagination library

		//initialise the pagination with config
		$this->pagination->initialize($config);
		//create links to be send to the view
		$data['search_pagination']=$this->pagination->create_links();
		//var_dump($data['search_pagination']);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('ini',$data);

	}

/*$search['page']=$this->input->get('per_page')??0;


		$data['search']=$search;		
		$data['db']=$this->ownersProperty_model->getProperty($search);
		
		$data['countProperties']=$this->ownersProperty_model->countProperties($search);

		//pagination for the Properties
		
		$config['enable_query_string']=true;
		//this is the one to show the actual page number,?page=someInt
		$config['page_query_string']=true;
		//url that will use the link
		$config['base_url']=base_url('residents/eresidence?inputForSearch='.$data["inputForSearch"].'&mysearch='.$this->input->get('mysearch'));

		//number of results to be devided on the pagintion
		$config['total_rows']=$data['countProperties'];
		//load the pagination library		
		
		// atribute for the class assigned to the pagination
		
		$config['uri_segment']  = 3;
		//intialize the pagination with our config
		$this->pagination->initialize($config);
		$data['search_pagination']=$this->pagination->create_links();*/




/*public function ownerProperty($user_addinfor=array())
{
		
	$search=array();
	$properties=array();
	$search['user_idprofile']= $_SESSION['id'];

	//$data['user_addinfor']=$user_addinfor;

	$data['user_addinfor']= $this->request_model->getUser($search);
	$data['property_addinfor']= $this->ownersProperty_model->getProperty($search);
//var_dump($data['user_addinfor']);
		//$data['user_id']= $this->request_model->getAddress($search);
	$data['pageToLoad']='eresidence/ownersProperty';
	$data['pageActive']='eresidence';
	$this->load->helper('form');
		// this is for validation 

	$this->load->library('form_validation');
		//$this->load->view('ini',$data);

	
		//to re-write the links
	$config['enable_query_string'] = TRUE;
		//to show the actual page number
	$config['page_query_string'] = TRUE;
		//config base_url that use pagination
		//$config['base_url'] = base_url('residents/ownerProperty?search='.$search['search'].'&id='.$search['id']);
		//number of results to be divided on the pagination
		//$config['total_rows'] =$data['addressCount'];
		//load the pagination library
	$this->load->library('pagination');
		//initialise the pagination with config
	$this->pagination->initialize($config);
		//create links to be send to the view
	$data['search_pagination']=$this->pagination->create_links();
		//view load page
	

}*/


public function approve()
{
	
	$search=array();

	//$search['owner_id']= $this->input->post('owner_id');
	$search['user_id']= $_SESSION['id'];
	//$search['user_id']= $this->input->post('user_id');
	//$search['property_id']= $this->input->post('property_id');
	

	$data['user_addinfor']= $this->approval_model->getAddress($search);
	
	$data['pageToLoad']='eresidence/approve';
	$data['pageActive']='eresidence';

// loading the form and files for file uoload		
	$this->load->helper(array('form','file','url'));
		//$this->load->helper(array('form','url'));
	$this->load->library('form_validation');
	$this->load->view('ini',$data);

}


}


