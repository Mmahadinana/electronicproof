<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Residents extends CI_Controller {
	public function __construct(){
		parent::__construct();
	$this->load->model("request_model");
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
		//$data['db'] =$this->request_model->getAddress($search);
		$data['pageToLoad']='eresidence/request';
		$data['pageActive']='request';
		$this->load->helper('form');
		// this is for validation 

		$this->load->library('form_validation');
			

		$config_validation=array(
			array('field'=>'phone',
					'label'=>'Phone',
					'rules'=>array('required',
						'exact_length[10]',						
						'regex_match[/^[0-9]+$/]'),
										
						
					'errors'=>array('required'=>'you should insert a %s ',
						'exact_length'=>'the %s must have at least length of 10 ',						
						'regex_match'=>'the %s must be numbers only',					
						)	 					
				),		
			array(
			'field'=>'idnumber',
			'label'=>'ID No.',
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
			
		array('field'=>'email',
				'label'=>'E-mail',
				'rules'=>array('required','valid_email'),
				'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',

				) 					
			),
			
		);		

		//Validating the form
		$this->form_validation->set_rules($config_validation);
		if ($this->form_validation->run()===FALSE) {

			$this->load->view('ini',$data);
		}else{


		}
		
	}
}
