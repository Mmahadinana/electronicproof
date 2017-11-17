<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Residents extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("request_model");
		$this->load->model("listOfRes_model");
		$this->load->model("ownersProperty_model");
		$this->load->model("ownersDetails_model");
		$this->load->model("manucipality_model");
		$this->load->model("district_model");
		$this->load->model("province_model");
		$this->load->model("user_model");
		$this->load->model("login_model");
		$this->load->model("owners_property_model");




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
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function Eresidence()
	{
		$data['pageToLoad']='eresidence/eresidence';
		$data['pageActive']='eresidence';
		$this->load->helper('form');
		// this is for validation 
		
		$this->load->library('form_validation');
		$this->load->view('ini',$data);

	}
	public function request()
	{
		$search=array();

		$search['user_id']= $this->input->get('user_id') ?? '0';
		//$search[23]= $this->input->get('user_id') ?? '0';
		

		$data['user_id']= $this->request_model->getAddress($search);
		//$data['db']= $this->owners_property_model->getOwner($search);
		//$data['bd']=$this->request_model->getAddress();
		//var_dump($data['db']);
		$data['pageToLoad']='eresidence/request';
		$data['pageActive']='request';
		
// loading the form and files for file uoload		
		$this->load->helper(array('form','file','url'));
		//$this->load->helper(array('form','url'));
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
			/*array('field'=>'idUpload',
				'label'=>'idUpload',
				'rules'=>array(//'required',					
					'callback_file_upload'),
					//array('checkFile',array($this->request_model,'callback_checkFile'))
				

				'errors'=>array(
			//'callback_file_upload'=>'%s is required',
			//'checkFile'=>'type for %s exist'


				)
			),
			array('field'=>'fileToUpload',
				'label'=>'fileToUpload',
				'rules'=>array(//'required',					
					'callback_do_upload1'),
					//array('checkFile',array($this->request_model,'callback_checkFile'))
				
			
			'errors'=>array(
			//'callback_do_upload1'=>'%s is required',
			//'checkFile'=>'type for %s exist'


			)
		),*/

	);		


		//Validating the form
		$this->form_validation->set_rules($config_validation);
		if ($this->form_validation->run()===FALSE) {

			$this->load->view('ini',$data);
		}else{


			
			$this->file_upload();
			//$this->load->view('ini',$data);
			redirect('residents/requestPreview/'.$this->input->get('user_id'));
		}

		
		
	}


	/******UPLOADING A FILE TO THE FLDER***********************/	/******UPLOADING A FILE TO THE FLDER***********************/
	public function upload_opt() { 
		//$this->load->library('upload');

		// upload file uptions	
		$config=array();
		$config['allowed_types'] = 'pdf|jpg|png|jpeg';
		$config['upload_path']   ='./id_upload/';
		$config['encrypt_name']   =true;			
		$config['overwrite']     = false;
		$config['max_size']	 = '5120';
		
		return $config;
			
		}
	

	// 
	


	public function file_upload(){

	$config=array();
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
				$this->form_validation->set_message('file_upload', $this->upload->display_errors());
				return false;
			}elseif($statusIdUpload){
				$this->upload_data['file'] = $this->upload->data();
			//send data to the database	
				$this->request_model->addIdUpload($this->upload_data['file'],$minetype);

			}

		}//error if there in no file to upload
		else{
			$this->form_validation->set_message('file_upload', "Identity document must be uploaded ");
			return false;
			
		}
//upload file for Property/ fileToUpload
		if ($_FILES['fileToUpload']['name'] != '') {

			$config['upload_path']   ='./file_upload/';
			$minetype='PD' ;
//uload file
			$number_of_files_uploaded= count($_FILES['fileToUpload']['name']);
			for($i=0; $i<$number_of_files_uploaded; $i++){
				$_FILES['fileToUpload']['name']		= $_FILES['fileToUpload']['name'][$i];
				$_FILES['fileToUpload']['type']		= $_FILES['fileToUpload']['type'][$i];
				$_FILES['fileToUpload']['tmp_name']	= $_FILES['fileToUpload']['tmp_name'][$i];
				//$_FILES['fileToUpload']['error']	= $_FILES['fileToUpload']['error'][$i];
				$_FILES['fileToUpload']['size']		= $_FILES['fileToUpload']['size'][$i];  

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$statusFileToUpload =$this->upload->do_upload('fileToUpload');

				if (!$statusFileToUpload && $_FILES['fileToUpload']['name'] != '') {
					$this->form_validation->set_message('file_upload', $this->upload->display_errors());
					return false;
				}elseif($statusFileToUpload){

					$this->upload_data['file'] = $this->upload->data();
		//send data to the database
					$this->request_model->addIdUpload($this->upload_data['file'],$minetype);

 //var_dump($this->upload_data['file']);

				//$this->request_model->addIdUpload($this->upload_data['file']);
				}	
			}
		}
		return true;
	}

	public function requestPreview($user_id=0)
	{
		$search=array();

		$search['user_id']=$user_id;
		

		$data['user_id']= $this->request_model->getAddress($search);
		$data['pageToLoad']='eresidence/requestPreview';
		$data['pageActive']='eresidence';
		$this->load->helper('form');
		// this is for validation 
		
		$this->load->library('form_validation');
		$this->load->view('ini',$data);

	}

	public function listOfResidents()
	{
		$data['pageToLoad']='eresidence/listOfResidents';
		$data['pageActive']='listOfResidents';
		$this->load->helper('form');
		$this->load->library('form_validation');



		$config_validation=array(
			array('field'=>'name',
				'label'=>'name',
				'rules'=>array('required',
					'exact_length[10]',						
					'regex_match[/^[0-9]+$/]'),


				'errors'=>array('required'=>'you should insert a %s ',
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
				'rules'=>array('required','valid_email'),
				'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',

				) 					
			),
			array('field'=>'edit',
				'label'=>'edit',
				'rules'=>array('required','valid_email'),
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
	public function OwnersDetails()
	{
		$data['pageToLoad']='eresidence/OwnersDetails';
		$data['pageActive']='OwnersDetails';
		$this->load->helper('form');
		$this->load->library('form_validation');



		$config_validation=array(
			array('field'=>'name',
				'label'=>'name',
				'rules'=>array('required',
					'exact_length[10]',						
					'regex_match[/^[0-9]+$/]'),


				'errors'=>array('required'=>'you should insert a %s ',
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
				'rules'=>array('required','valid_email'),
				'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',

				) 					
			),
			array('field'=>'edit',
				'label'=>'edit',
				'rules'=>array('required','valid_email'),
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
	public function OwnersProperty()
	{
		$data['pageToLoad']='eresidence/ownersProperty';
		$data['pageActive']='ownersProperty';
		$this->load->helper('form');
		$this->load->library('form_validation');



		$config_validation=array(
			array('field'=>'name',
				'label'=>'name',
				'rules'=>array('required',
					'exact_length[10]',						
					'regex_match[/^[0-9]+$/]'),


				'errors'=>array('required'=>'you should insert a %s ',
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
				'rules'=>array('required','valid_email'),
				'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',

				) 					
			),
			array('field'=>'edit',
				'label'=>'edit',
				'rules'=>array('required','valid_email'),
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
}


