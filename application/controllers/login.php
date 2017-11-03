<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	public function login_()
	{
		$data['pageToLoad']='login/login_';
		$data['pageActive']='login_';
		$this->load->helper('form');
		// this is for validation 
		$this->load->library('form_validation');
		$this->load->view('ini',$data);


		
	}
	public function changepass()
	{
		$data['pageToLoad']='login/changepass';
		$data['pageActive']='changepass';
		$this->load->helper('form');
		// this is for validation 
		$this->load->library('form_validation');
		$this->load->view('ini',$data);


		
	}
	public function reset()
	{
		$data['pageToLoad']='login/reset';
		$data['pageActive']='reset';
		$this->load->helper('form');
		// this is for validation 
		$this->load->library('form_validation');
		$this->load->view('ini',$data);		
	}
	public function resetmessage()
	{
		$data['pageToLoad']='login/resetmessage';
		$data['pageActive']='resetmessage';
		$this->load->helper('form');
		// this is for validation 
		$this->load->library('form_validation');
		$this->load->view('ini',$data);		
	}
	public function resetpassword()
	{
		$data['pageToLoad']='login/resetpassword';
		$data['pageActive']='resetpassword';
		$this->load->helper('form');
		// this is for validation 
		$this->load->library('form_validation');
		$this->load->view('ini',$data);		
	}
}
