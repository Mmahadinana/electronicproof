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
		$this->load->model('user_model');


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
	public function register()
	{
		$data['pageToLoad']='Register/register';
		$data['pageActive']='register';

		
		

		//from helper and library
		$this->load->helper('form');
		$this->load->library('form_validation');

		

		if($this->form_validation->run()===FALSE){
			$this->load->view('ini',$data);

		}else
		{
			$statusInsert=$this->province_model->createVehicle($this->input->post());
			redirect("publiczone/register?statusInsert=$statusInsert");
		}
		//if(empty($this->input->post()))


		//view load
		
		
	}

	public function addUser(){
		$data['pageToLoad'] = 'Register/register';
		$data['pageActive']='register';
		$data['pageTitle'] = 'Add User';

		//data from db
		$data['province']=$this->province_model->getProvince();
		$data['manucipality']=$this->manucipality_model->getManucipality();
		$data['district']=$this->district_model->getDistrict();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$config_validation = array(
			array(
				'field'=>'email',
				'label'=>'email',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),
			array(
				'field'=>'password',
				'label'=>'password',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),
			array(
				'field'=>'confirm',
				'label'=>'confirm',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),

			array(
				'field'=>'name',
				'label'=>'name',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),
			array(
				'field'=>'identityNumber',
				'label'=>'identityNumber',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),
			array(
				'field'=>'phone',
				'label'=>'phone',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),
			array(
				'field'=>'gender',
				'label'=>'gender',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),
			array(
				'field'=>'address',
				'label'=>'address',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),
			array(
				'field'=>'suburb',
				'label'=>'suburb',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),
			array(
				'field'=>'town',
				'label'=>'town',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),
			array(
				'field'=>'zip_code',
				'label'=>'zip_code',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>'
					)
				),
			array(
				'field'=>'municipality',
				'label'=>'municipality',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>',
					array('checkColor',array($this->manucipality_model,'callback_checkManufacturers'))
					)
				),
			array(
				'field'=>'district',
				'label'=>'district',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>',
					array('checkColor',array($this->district_model,'callback_checkDistrict'))
					)
				),
			array(
				'field'=>'province',
				'label'=>'province',
				'rules'=>'required',
				'errors'=>array('required'=>'<b>you should insert one %s for the user</b>',
					array('checkColor',array($this->province_model,'callback_checkProvince'))
					)
				)

			);


$this->form_validation->set_rules($config_validation);
if($this->form_validation->run()===FALSE){
	$this->load->view('ini',$data);

}else
{
	$statusInsert=$this->province_model->register($this->input->post());
	redirect("publiczone/register?statusInsert=$statusInsert");
}


}

}

