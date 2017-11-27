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
		$this->load->model('suburb_model');
		$this->load->model("district_model");
		$this->load->model('town_model');
		$this->load->model('user_model');
		$this->load->model('login_model');
		$this->load->library('email');
		$this->load->model('Postoffice_model');
		$this->load->model('address_model');



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
	public function logout(){
		//delete cookie data from db
		$this->login_model->deleteCookieByToken();
		//delete the cookie
		delete_cookie(COOKIE_TOKEN);
		//distroy the session
		$this->session->sess_destroy();
		redirect('Publiczone');

	}//end of logout function
	/*******************************this function checks the email for reset*******************************/
	public function reset()
	{
		if(null!=$this->input->get('statusUsername')){
			$data['statusUsername']= $this->input->get('statusUsername');
		}
		if(null!=$this->input->get('statusToken')){
			$data['statusToken']= $this->input->get('statusToken');
		}if(null!=$this->input->get('statusDate')){
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
					array('checkEmail',array($this->login_model,'callback_checkUsername'))),
				'errors'=>array(
					'required'=>'%s is required',
					'valid_email'=>'invalid email',
					'checkEmail'=>'%s does not exist, please enter the correct email'

					) 					
				),				
			);
		$this->form_validation->set_rules($config_validation);
		if ($this->form_validation->run()===FALSE) {

			$this->load->view('ini',$data);
		}else{

			$data['db']=$this->login_model->get_user($this->input->post('username'));

			$user_id= $data['db']->id;
			$name = $data['db']->name;

			$email =$data['db']->email;


					/*$name = 'name';
					$email ='freestateresident@gmail.com';*/
					$token = bin2hex(openssl_random_pseudo_bytes(32));				
					$url = 'publiczone/resetpassword/'.$token.'/'.$user_id;
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
					$this->login_model->inserEmailToken($user_id,$token);
					redirect('publiczone/resetmessage/');

				}
	}//end of reset function
	/***********************************this function load the notification that email has been send ****************/ 
	public function resetmessage()
	{
		$data['pageToLoad']='login/resetmessage';
		$data['pageActive']='resetmessage';
		$this->load->helper('form');
		// this is for validation 
		//$this->load->library('form_validation');	

		$this->load->view('ini',$data);		
	}//end of resetmassage function
	
		/************************************This function load from the email link to enter new password***************/
	public function resetpassword($mailtoken=0,$user_id=0)
	{	
		//var_dump($mailtoken);
		$data['db']= $this->login_model->get_mailToken($mailtoken,$user_id);
		
	
		if ($data['db'] == null ) {

			$statusUsername=false;
			redirect('publiczone/reset?statusUsername=$statusUsername');			
			
		}
		if ($mailtoken != $data['db']->emailtoken && $user_id != $data['db']->user_id) {
			$statusToken=true;
			redirect('publiczone/reset?statusToken=$statusToken');

		}
		if ($data['db']->expiretime < date('Y-m-d H:i:s') ) {
			$statusDate=true;
			redirect('publiczone/reset?statusDate=$statusDate');
		}

			

			$data['pageToLoad']='login/resetpassword';
			$data['pageActive']='resetpassword';
			$this->load->helper('form');
		// this is for validation 
			$this->load->library('form_validation');

			
			$config_validation =array(
			 array(
				'field'=>'newpassword',
				'label'=>'Enter New Password',
				'rules'=>array('required',	'min_length[5]'),						
				'errors'=>array(						
					'required'=>'you should insert one %s for reset',
					'min_length[5]'=>'You should at least enter 5 charactors of %'),
					

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
		if($this->form_validation->run()===FALSE){

			$this->load->view('ini',$data);

		}else
		{
			$statusInsert=$this->login_model->updatePassword($this->input->post(),$user_id);

			//redirect("login/login_?statusResetPass=$statusResetPass");
			redirect("login/login_");

		}	

			

		
	}//end of resetpassword function
	/*public function getDistrict()
	{
		echo "string";
		$province_id = $this->input->post('province');
		$districts = $this->district_model->getDistrict($province_id);
		if (count($districts)>0) {
			$district_select='';
			$district_select .= "<option value=''>Select District";
			foreach ($districts as $district) {
				$district_select .= '<option value="'.$district->id.'">'.$district->name;
			}

			echo json_encode($district_select );
		}
	}*/
	public function getProvinceDistrict():array
	{
		$tempdata=array();
				$tempdata['province']=$this->province_model->getProvince();
				foreach ($tempdata['province'] as $prov) {
					$tempdata['district'][$prov->id]=$this->district_model->getDistrict($prov->id);
				
				}
				$tempdata['districts']=$this->district_model->getDistricts();
				foreach ($tempdata['districts'] as $distr) {
				$tempdata['manucipality'][$distr->id]=$this->manucipality_model->getManucipality($distr->id);
				
				}
				$tempdata['manucipalities']=$this->manucipality_model->getManucipalities();
				foreach ($tempdata['manucipalities'] as $tow) {
				$tempdata['town'][$tow->id]=$this->town_model->getTown($tow->id);
				
				}

				$tempdata['towns']=$this->town_model->getTowns();
				foreach ($tempdata['towns'] as $sub) {
				$tempdata['suburb'][$sub->id]=$this->suburb_model->getSuburb($sub->id);
				
				}
				$tempdata['towns']=$this->suburb_model->getSuburbs();
				foreach ($tempdata['towns'] as $add) {
				$tempdata['address'][$add->id]=$this->address_model->getAddress($add->id);
				
				}

			return $tempdata;		

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

		/***get the provice and distric by provice id*******/
		$selDistrict = $this->getProvinceDistrict();
			$data['province'] = $selDistrict['province'];
			$data['district']     = $selDistrict['district'];
			$data['manucipality']=$selDistrict['manucipality'];	
			$data['town']=$selDistrict['town'];	
			$data['suburb']=$selDistrict['suburb'];	
			$data['address']=$selDistrict['address'];	
			//var_dump($data['manucipality']);	
		/*****end */		
					

		//data from db
		;
		
		$search = array();
		$data['province']=$this->province_model->getProvince();
		$district = $this->input->post('province');

		//$data['district']=$this->district_model->getDistrict($district);
		
		
/*$search['district'] = 
		//$data['district']=$this->district_model->getDistrict();
		$data['province']=$this->province_model->getProvince();
		foreach ($data['province'] as $key => $value) {
			$data['district']=$this->district_model->getDistrict($value->name);
		}*/
		
		
//Including validation library
		


		$config_validation = array(
			array(
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
				'rules'=>
				'required',
				'errors'=>array('required'=>'you should insert %s for the user')

				),
			array(
				'field'=>'confirm',
				'label'=>'Confirm Password',
				'rules'=>
				'required',
				'errors'=>array('required'=>'you should insert %s for the user')

				),

			array('field'=>'name',
				'label'=>'Full Name',
				'rules'=>'required',
				'errors'=>array('required'=>'you should insert %s for the user')						
				),



			array(
				'field'=>'identitynumber',
				'label'=>'Identity Number',
				'rules'=>
				'required',				
				),
			'errors'=>array(
				'required'=>' %s is required'

				),
			
			/*array(
				'field'=>'dateOfBirth',
				'label'=>'Date of Birth',
				'rules'=>
					'required',
								
					'errors'=>array('required'=>'you should insert %s for the user')
					),*/

array(
	'field'=>'phone',
	'label'=>'Phone number',
	'rules'=>array(
		'required',
		'exact_length[10]',						

		'regex_match[/^[0-9]+$/]',
		),



	'errors'=>array('required'=>'you should insert one %s ',
		'exact_length'=>'the %s must have at least length of 10 ',						
		'regex_match'=>'the %s must be numbers only',									
		)	 					
	),
			/*array(
				'field'=>'dateOfRegistraion',
				'label'=>'Date of Registration',
				'rules'=>
					'required',
					'errors'=>array('required'=>'you should insert %s for the user')						
),

			
			
			

			/*array(
				'field'=>'address',
				'label'=>'Street Address',
				'rules'=>'required',
					'errors'=>array('required'=>'you should insert %s for the user')
					),*/
   array(
	'field'=>'gender',
	'label'=>'Gender',
	'rules'=>'required',
	'errors'=>array('required'=>'you should insert %s for the user')
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
	'rules'=>
	'required',	
	'errors'=>array('required'=>'you should insert %s for the user')),



array(
	'field'=>'manucipality',
	'label'=>'manucipality',
	'rules'=>'required',
	'errors'=>array('required'=>'you should insert one %s for the user'

		)
	)
);



$this->form_validation->set_rules($config_validation);
if($this->form_validation->run()===FALSE){

	$this->load->view('ini',$data);

}else
{

	$statusInsert=$this->user_model->addUser($this->input->post());

	redirect("publiczone/registerUser?statusInsert=$statusInsert");

}

}


}


