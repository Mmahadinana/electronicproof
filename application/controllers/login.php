<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();  
		//loads the model for the login
		//$this->load->model("Login_model");
		$this->load->library("user_agent");
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
	//**This function enable the user to log onto the page
	public function login_()
	{	
		
		if(null!=$this->input->get('statusResetPass'))
		{
			$data['statusResetPass']= $this->input->get('statusResetPass');
		}
		if(null!=$this->input->get('statusInsert')){
			$data['statusInsert']= $this->input->get('statusInsert');

		}
		if(null!=$this->input->get('statusRequest')){
			$data['statusRequest']= $this->input->get('statusRequest');

		}	
		if(null!=$this->input->get('statusConfirm')){
			$data['statusConfirm']= $this->input->get('statusConfirm');

		}		
	    
		//check if the is session
		

	
		//view load
		/*$search=array();

		$search['username']= $this->input->get('username') ?? '0';
		//$search[23]= $this->input->get('user_id') ?? '0';
		

		$data['username']= $this->login_model->getAddress($search);*/
		$data['pageToLoad']='login/loginForm'; 
		//what link is to be active
		$data['pageActive']='login';
		$this->load->helper('form');
		//validation rules
		$this->load->library('form_validation');
		//$data['username']=$this->Login_model->getUser();

		$config_validation = array(
			array(
				'field'=>'username',
				'label' =>'Username',
				'rules' =>array(
					'required',
					'valid_email', 
					),
			'errors' =>array(
				'required'=>'you should insert one %s for the login',
				'valid_email' =>'Invalid_email',
				

				)
				),
				array(
						'field'=>'rememberme',
						'label'=>'Rememberme',
						),
						array(
							'field'=>'password',
							'label'=>'Password',
							'rules'=>array(
								'required',
								array(
									'checkPassword',
								array($this->Login_model,'checkPassword')
							      )
							     ),
				'errors'=>array(
					'required'=>'you should insert one %s for the login',
					'checkPassword'=>'Invalid username or password',
				    )
				  )
				);

		$this->form_validation->set_rules($config_validation);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('ini',$data);
		}else
		{

		//redirect ($data['referrer']);
		redirect(base_url());

		} 

		
	}
/**
 * [changepass this will enable the user or owner to change their password once it has expire.]
 * 
 * @return [true] [description]
 */
	public function changepass()
	{
		
		$data['pageToLoad']='login/changepass';
		$data['pageActive']='changepass';
		$this->load->helper('form');
		// this is for validation 
		$this->load->library('form_validation');
		$this->load->view('ini',$data);		
	}
	/*public function reset()
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
		//$this->load->library('form_validation');
		$this->load->view('ini',$data);		
	}*/
}
