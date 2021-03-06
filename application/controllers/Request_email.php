<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passwords extends CI_Controller 
{
	
	
	public function __construct()
	{
		
		parent::__construct();

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

	/*******************************this function checks the email for reset*******************************/
	/**
	 * [reset description]
	 * @return [true] [this retrieves the correct information when the owner want to reset his/her password]
	 */
	public function reset()
	{
		if(null!=$this->input->get('statusUsername'))
		{
			$data['statusUsername']= $this->input->get('statusUsername');
		}
		if(null!=$this->input->get('statusToken'))
		{
			$data['statusToken']= $this->input->get('statusToken');
		}
		if(null!=$this->input->get('statusDate'))
		{
			$data['statusDate']= $this->input->get('statusDate');
		}
		$data['pageToLoad']='login/reset';
		$data['pageActive']='reset';
		$this->load->helper('form');
		// this is for validation 
		$this->load->library('form_validation');
		$config_validation = array(
			array('field'=>'username',
				'label'=>'Username',
				'rules'=>array('required','valid_email',
					array('checkUsername',array($this->Login_model,'checkUsername'))),
				'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',
					'checkUsername'=>'%s does not exist, please enter the correct email'

			) 					
			),				
		);
		$this->form_validation->set_rules($config_validation);
		if ($this->form_validation->run()===FALSE)
		 {

			$this->load->view('ini',$data);
		}else
		{

			$data['db']=$this->Login_model->get_user($this->input->post('username'));
			

			$user_id= $data['db']->id;
			$name = $data['db']->name;

			$email =$data['db']->email;


					/*$name = 'name';
					$email ='freestateresident@gmail.com';*/
					$token = bin2hex(openssl_random_pseudo_bytes(32));				
					$url = 'passwords/resetpassword/'.$token.'/'.$user_id;
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
					$this->Login_model->inserEmailToken($user_id,$token);
					redirect('passwords/resetmessage/');

				}
	}//end of reset function
	
	/**
	 * [resetmessage load the notification that email has been send]
	 * @return [true] [thats where the owner will get a resetmessage for new password]
	 */
	public function resetmessage()
	{
		$data['pageToLoad']='login/resetmessage';
		$data['pageActive']='resetmessage';
		$this->load->helper('form');
		// this is for validation 
		//$this->load->library('form_validation');	

		$this->load->view('ini',$data);		
	}//end of resetmassage function
	
		
		/**
		 * [resetpassword email link to enter new password]
		 * @param  integer $mailtoken [from email]
		 * @param  integer $user_id   [user id]
		 * @return [true]             [thats where the owner will get a resetpassword for new password]
		 */
	public function resetpassword($mailtoken=0,$user_id=0)
	{	
		//get the data from the get_mailtotaken by mailtoken and user_id
		$data['db']= $this->Login_model->get_mailToken($mailtoken,$user_id);
		
	
		if ($data['db'] == null ) 
		{

		$statusUsername=false;
			redirect('passwords/reset?statusUsername=$statusUsername');			
			
		}
		if ($mailtoken != $data['db']->emailtoken && $user_id != $data['db']->user_id) 
		{
			$statusToken=true;
				redirect('passwords/reset?statusToken=$statusToken');
				
		}
		if ($data['db']->expiretime < date('Y-m-d H:i:s') ) 
		{
			$statusDate=true;
			redirect('passwords/reset?statusDate=$statusDate');
		}
			

			$data['pageToLoad']='login/resetpassword';
			$data['pageActive']='resetpassword';
			$this->load->helper('form');
		 
			$this->load->library('form_validation');

			// this is for validation
			$config_validation =array(
			 array(
				'field'=>'newpassword',
				'label'=>'Enter New Password',
				'rules'=>array('required',
					'min_length[5]',
					'max_length[25]',
					array('validatePassword',array($this->Login_model,'validatePassword'))),						
				'errors'=>array(						
					'required'=>'you should insert one %s for reset',
					'min_length[5]'=>'You should at least enter 5 charactors of %s',
					'max_length[25]'=>'%s should not exit 25 charactors',
					'validatePassword'=>'password should have at least one simbol/charactor',
				),
			),			
			array(
				'field'=>'confirmpass',
				'label'=>'Confirm Password',
				'rules'=>array('required',
					'matches[newpassword]'),											
				'errors'=>array(						
					'required'=>'you should insert one %s for login',
					'matches[newpassword]'=>'% you entered does not match'),
			)

			
		);
			$this->form_validation->set_rules($config_validation);
		if($this->form_validation->run()===FALSE)
		{

			$this->load->view('ini',$data);

		}
		else
		{
			$statusInsert=$this->Login_model->updatePassword($this->input->post(),$user_id);
			if($statusInsert==true){
				$this->Login_model->updateEmailToken($user_id,$mailtoken);
			}
			//redirect("login/login_?statusResetPass=$statusResetPass");
			redirect("login/login_");

		}	

			
		
	}//end of resetpassword function
}