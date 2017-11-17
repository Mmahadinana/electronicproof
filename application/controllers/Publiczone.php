<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publiczone extends CI_Controller {
	
	//$this->load->library('session');
	public function __construct()
	{
		parent::__construct();
		$this->load->model("messages_model");
		$this->load->model('province_model');
		$this->load->model('manucipality_model');
		$this->load->model("district_model");
		$this->load->model('town_model');
		$this->load->model('user_model');


	}
	/**
	 * Index Page for this controller.
	 * this is for to apply a commit to check
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

	public function index()
	{
		$data['pageToLoad']='home/home';
		$data['pageActive']='home';
		$this->load->view('ini',$data);
		
	}
	public function about()
	{
		$data['pageToLoad']='about/about';
		$data['pageActive']='about';
		$this->load->view('ini',$data);
		
	}
	public function help()
	{
		$data['pageToLoad']='help/help';
		$data['pageActive']='help';
		$this->load->view('ini',$data);
		
	}
	public function contact()
	{
		$data['pageToLoad']='Contact/contact';
		$data['pageActive']='contact';
		$this->load->helper('form');
		$this->load->library('form_validation');
		if(null!=$this->input->get('statusInsert'))
		{
			$data['statusInsert']=$this->input->get('statusInsert');
		}


		$config_validation= array(

			array(
				'field'=>'name',
				'label'=>'name',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>You should enter your %s </b>'
					)
				),

			
			array(
				'field'=>'email',
				'label'=>'email',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>You should enter your %s </b>'
					)
				),
			array(
				'field'=>'message',
				'label'=>'message',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>You should type a %s </b>'
					)
				),
			array(
				'field'=>'phone',
				'label'=>'phone',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>You should type a %s </b>'
					)
				),
			);

		$this->form_validation->set_rules($config_validation);
		if($this->form_validation->run()===FALSE){
			$this->load->view('ini',$data);

		}else
		{
			$statusInsert=$this->messages_model->getMessages($this->input->post());
			redirect("publiczone/contact?statusInsert=$statusInsert");
		}


		
	}
	public function eResidence()
	{
		$data['pageToLoad']='E-Residence/eResidence';
		$data['pageActive']='eResidence';
		$this->load->view('ini',$data);
		
	}
	public function listOfResidents()
	{
		$data['pageToLoad']='E-Residence/listOfRes';
		$data['pageActive']='listOfRes';
		$this->load->view('ini',$data);
		
	}
	public function login()
	{
		$data['pageToLoad']='login/loginForm';
		$data['pageActive']='loginForm';
		$this->load->view('ini',$data);
		
	}
	
	function registerUser() {

		$search=array();
		$search['user_id']= $this->input->get('user_id') ?? '0';
		//$search['user_id']= 161;
		//$data['search'] = $search;
	  	//$data['authors'] = $authors;
	  	//$data['editor'] = $editor;

		//$data['db'] = $this->user_model->getUser($search);
		//var_dump($data['db']);
		$data['user_id']= $this->user_model->getUser($search);

		$data['pageToLoad'] = 'register/register';
		$data['pageActive']='register';
		$data['pageTitle'] = 'Register User';
		$this->load->helper('form');
		$this->load->library('form_validation');
		//data from db
		$data['manucipality']=$this->manucipality_model->getManucipality();
		//var_dump($data['manucipality']);
		$data['district']=$this->district_model->getDistrict();
		$data['province']=$this->province_model->getProvince();

		
		
//Including validation library
		


		$config_validation = array(
			/*array(
				'field'=>'email',
				'label'=>'email',
				'rules'=>array('required','valid_email'),
				'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',

					) 					
				),

		
			array(
				'field'=>'password',
				'label'=>'Password',
				'rules'=>array(
					'required',
					'exact_length[8]',
					'numeric',				
					),
				'errors'=>array(
					'required'=>' %s is required',
					'exact_length'=>'the %s must have 8 numbers',
					'numeric'=>'the %s Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character ')
				
				),
			
			array(
				'field'=>'confirm',
				'label'=>'Confirm Password',
				'rules'=>array(
					'required',
					'exact_length[8]',
					'numeric',				
					),
				'errors'=>array(
					'required'=>' %s is required',
					'exact_length'=>'the %s must have 8 numbers',
					'numeric'=>'the %s Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character ')
				
				),*/

			array('field'=>'name',
			'label'=>'Full Name',
			'rules'=>array('required',
				'exact_length[10]',						
				//'regex_match[/^[0-9]+$/]'
			),
			
			'errors'=>array('required'=>'you should insert a %s ',
				'exact_length'=>'the %s must have at least length of 10 ',						
				//'regex_match'=>'the %s must be numbers only',					
				)	 					
			),	



			/*array(
				'field'=>'identitynumber',
				'label'=>'Identity Number',
				'rules'=>array(
					'required',
					'exact_length[13]',
					'numeric',				
					),
				'errors'=>array(
					'required'=>' %s is required',
					'exact_length'=>'the %s must have 13 numbers',
					'numeric'=>'the %s must have only numbers')
				
				),
			
			/*array(
				'field'=>'dateOfBirth',
				'label'=>'Date of Birth',
				'rules'=>array(
					'required',
					'exact_length[8]',
					'numeric',				
					),
				'errors'=>array(
					'required'=>' %s is required',
					'exact_length'=>'the %s must have 8 numbers',
					'numeric'=>'the %s must have only numbers')
				
				),
			

			array(
				'field'=>'phone',
				'label'=>'Phone number',
				'rules'=>array(
					'required',
					'exact_length[10]',						
					'regex_match[/^[0-9]+$/]'),


				'errors'=>array('required'=>'you should insert one %s ',
					'exact_length'=>'the %s must have at least length of 10 ',						
					'regex_match'=>'the %s must be numbers only',					
					)	 					
				),
			array(
				'field'=>'gender',
				'label'=>'Gender',
				'rules'=>'required',
				'errors'=>array('required'=>'you should insert %s for the user')
				),

			array(
				'field'=>'address',
				'label'=>'Street Address',
				'rules'=>array('required','min_length[10]|max_length[20]',
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
				'errors'=>array('required'=>'you should insert one %s for the user'
					
					)
				),

			array(
				'field'=>'province',
				'label'=>'province',
				'rules'=>'required',
				'errors'=>array('required'=>'you should insert one %s for the user'
					
					)
				),



			array(
				'field'=>'zip_code',
				'label'=>'zip code',
				'rules'=>array(
					'required',
					'exact_length[4]',						
					'regex_match[	/^([0-9]){4}$/]'),


				'errors'=>array('required'=>'you should insert one %s ',
					'exact_length'=>'the %s must have at least length of 4 ',						
					'regex_match'=>'the %s must be numbers only',					
					)	 					
				),

			array(
				'field'=>'manucipality',
				'label'=>'manucipality',
				'rules'=>'required',
				'errors'=>array('required'=>'you should insert one %s for the user'
					
					)
				)*/
			);



$this->form_validation->set_rules($config_validation);
if($this->form_validation->run()===FALSE){
	echo "hello";
	$this->load->view('ini',$data);

}else
{
	$statusInsert=$this->user_model->addUser($this->input->post());
    redirect("publiczone/registerUser?statusInsert=$statusInsert");

}

}



}


