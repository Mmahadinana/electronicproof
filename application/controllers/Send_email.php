<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email extends CI_Controller {

	/**
	 * [__construct description]
	 */
	
	public function __construct(){
		parent::__construct();
		//$this->load->library('email');
		//$this->load->model('Postoffice_model');
		$is_logged_in =$this->session->userdata('is_logged_in');

		//if($this->session->userdata('is_logged_in')==true)
		if(is_null($is_logged_in )){
			redirect('login/login_');
		}
	}

	/**
	 *send a registration email with the template on views\email\new_user_email_template
	 *
	 **/
	public function index($data =array()){
		//email

		$name = 'name';
		$email ='freestateresident@gmail.com';
		$token = bin2hex(openssl_random_pseudo_bytes(32));				
		$url = 'login/changepass/'.$token;
					//url to be sent by the email
		$url_to_activate = base_url($url);
					//prepare the template new user to be sent by email
		$this->Postoffice_model->setTemplate($this->load->view("email/new_user_email_template",array(),TRUE));
					//prepare the data neaded for the email
		$templateData = array(
			'user_name'			=> $name,
			'url_to_activate' 	=> $url_to_activate 
		);
		$this->Postoffice_model->setDataToTemplate($templateData);
		$subject ='Registration' ;
					//send email to the new user
		$this->Postoffice_model->sendEmail($subject,$email);
					//end email
		redirect('publiczone/resetmessage/');
	}//end index methode
}