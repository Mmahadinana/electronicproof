<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Residents extends CI_Controller {
	public function __construct(){
		parent::__construct();
		parent::__construct();
		$this->load->model("request_model");
		$this->load->model("listOfRes_model");
		$this->load->model("ownersProperty_model");
		$this->load->model("ownersDetails_model");
		$this->load->model("register_model");
		$this->load->model("manucipality_model");
		$this->load->model("district_model");
		$this->load->model("province_model");
		$this->load->model("user_model");
		$this->load->model("login_model");

	//$this->load->helper(array('form','url'));

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
		

		$data['user_id']= $this->request_model->getAddress($search);
		
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
			array('field'=>'idUpload',
				'label'=>'idUpload',
				'rules'=>array(//'required',					
					'callback_file_upload'),
					//array('checkFile',array($this->request_model,'callback_checkFile'))
				
			
			'errors'=>array(
			//'callback_file_upload'=>'%s is required',
			//'checkFile'=>'type for %s exist'


			)
		),
		/*	array('field'=>'fileToUpload',
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
/*if($this->input->post('idUpload')){
			$this->request_model->do_upload();
		}*/
		//var_dump($config_validation);
		//Validating the form
		$this->form_validation->set_rules($config_validation);
		if ($this->form_validation->run()===FALSE) {

			$this->load->view('ini',$data);
		}else{

			//$this->request_model->addIdUpload($this->input->post());
			//$this->do_upload1();
			//$this->file_upload();
			$this->request_model->addIdUpload($this->upload_data['file']);
			$this->load->view('ini',$data);
		}
		
	}

	/******UPLOADING A FILE TO THE FLDER***********************/
	/*public function do_upload1(){
	//var_dump($_FILES);

		$type= explode('.',$_FILES['fileToUpload']['name']);
		$type= $type[count($type)-1];
		if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'])){
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], './uploads/'.uniqid(rand()).'.'.$type);

		}
		
	}*/
/*public function do_upload1(){
	$config1=array();
		if($_FILES['fileToUpload']['size'] != 0){
         		//var_dump($_FILES);
			$upload_dir = 'C:\xampp';		
			if (!is_dir($upload_dir)) {
				mkdir($upload_dir);
			}	

			$config1['allowed_types'] = 'pdf|jpg|png|jpeg';
			$config1['upload_path']   ='./file_upload/';
			$config1['encrypt_name']   =true;
			$config1['file_name']     = 'fileUpload_'.substr(md5(rand()),0,7);
			$config1['overwrite']     = false;
			$config1['max_size']	 = '5120';
//var_dump($_FILES);
			$this->load->library('upload', $config1);
			if (!$this->upload->do_upload('fileToUpload')){
				$this->form_validation->set_message('do_upload1', $this->upload->display_errors());
				return false;
			}	
			else{
				$this->upload_data['file'] = $this->upload->data();				
				return true;
			}	
		}	
		else{//check file exist if condition
			$this->form_validation->set_message('do_upload1', "No file selected");
			return false;
		}
	} */
	/******UPLOADING A FILE TO THE FLDER***********************/	/******UPLOADING A FILE TO THE FLDER***********************/
	public function file_upload() { 
		//$this->load->library('upload');
		$config=array();
		if($_FILES['idUpload']['size'] != 0){
         		//var_dump($_FILES);
			$upload_dir = 'C:\xampp';		
			if (!is_dir($upload_dir)) {
				mkdir($upload_dir);
			}	

			$config['allowed_types'] = 'pdf|jpg|png|jpeg';
			$config['upload_path']   ='./id_upload/';
			$config['encrypt_name']   =true;
			$config['file_name']     = 'idUpload_'.substr(md5(rand()),0,7);
			$config['overwrite']     = false;
			$config['max_size']	 = '5120';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('idUpload')){
				$this->form_validation->set_message('file_upload', $this->upload->display_errors());
				return false;
			}	
			else{
				$this->upload_data['file'] = $this->upload->data();
				//$this->request_model->addIdUpload($this->upload_data['file']);
				
				return true;
			}	
		}	
		else{
			$this->form_validation->set_message('file_upload', "No file selected");
			return false;
		}
	}
	

function registerUser() {

	$search=array();
		//$search['user_id']= $this->input->get('user_id') ?? '0';
	$search['user_id']= 203;
	$data['search'] = $search;
	  	//$data['authors'] = $authors;
	  	//$data['editor'] = $editor;

	$data['db'] = $this->user_model->getUser($search);
//var_dump($data['db'] );
	$data['user_id']= $this->user_model->getUser($search);

	$data['pageToLoad'] = 'register/register';
	$data['pageActive']='register';
	$data['pageTitle'] = 'Add User';
		//data from db
	$data['manucipality']=$this->manucipality_model->getManucipality();
		//var_dump($data['manucipality']);
	$data['district']=$this->district_model->getDistrict();
	$data['province']=$this->province_model->getProvince();



//Including validation library
	$this->load->helper('form');
	$this->load->library('form_validation');

	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


	$config_validation = array(
		array(
			'field'=>'email',
			'label'=>'email',
			'rules'=>'required',
			'errors'=>array('required'=>'you should insert %s for the user')

		),
		array(
			'field'=>'name',
			'label'=>'name',
			'rules'=>'required',
			'errors'=>array('required'=>'you should insert %s for the user')
		),

		array(
			'field' =>'dateOfBirth',
			'label' =>'dateOfBirth',
			'rules' =>array(
				'required',
				'regex_match[/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/]')


		),
		array(
			'field' =>'phone',
			'label' =>'phone',
			'rules' =>array(
				'required',
				'regex_match[/^[0-9]{10}$/]')

		),
		array(
			'field'=>'gender',
			'label'=>'gender',
			'rules'=>'required',
			'errors'=>array('required'=>'you should insert %s for the user')
		),
		array(
			'field'=>'address',
			'label'=>'address',
			'rules'=>array('required','min_length[10]|max_length[50]',
				'errors'=>array('required'=>'you should insert %s for the user'))
		),
		array(
			'field'=>'suburb',
			'label'=>'suburb',
			'rules'=>'required',
			'errors'=>array('required'=>'you should insert one %s for the user')
		),
		array(
			'field'=>'town',
			'label'=>'town',
			'rules'=>'required',
			'errors'=>array('required'=>'you should insert one %s for the user')
		),

		array(
			'field'=>'district',
			'label'=>'district',
			'rules'=>'required',
			'errors'=>array('required'=>'you should insert one %s for the user',
				array('callback_checkDistrict',array($this->district_model,'callback_checkDistrict'))
			)
		),
		array(
			'field'=>'province',
			'label'=>'province',
			'rules'=>'required',
			'errors'=>array('required'=>'you should insert one %s for the user',
				array('callback_checkProvince',array($this->user_model,'callback_checkProvince'))
			)
		),
		array(
			'field'=>'zip_code',
			'label'=>'zip_code',
			'rules'=>'required',
			'errors'=>array('required'=>'you should insert one %s for the user')
		),
		array(
			'field'=>'manucipality',
			'label'=>'manucipality',
			'rules'=>'required',
			'errors'=>array('required'=>'you should insert one %s for the user', 
				array('callback_checkManucipality',array($this->manucipality_model,'callback_checkManucipality'))
			)
		)
	);



	$this->form_validation->set_rules($config_validation);
	if($this->form_validation->run()===FALSE){
		$this->load->view('ini',$data);

	}else
	{
		$statusInsert=$this->register_model->createUser($this->input->post());
		redirect("Residents/register?statusInsert=$statusInsert");

	}
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