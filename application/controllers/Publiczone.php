<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publiczone extends CI_Controller 
{
	
	//$this->load->library('session');
	public function __construct()
	{
		parent::__construct();
		//$this->load->model("messages_model");
		$this->load->model('province_model');
		$this->load->model('manucipality_model');
		$this->load->model('suburb_model');
		$this->load->model("district_model");
		$this->load->model('town_model');
		//$this->load->model('user_model');
		//$this->load->model('login_model');
		$this->load->model('owner_model');
		//$this->load->library('email');
		//$this->load->model('Postoffice_model');
		$this->load->model('address_model');
		$this->load->helper('form');

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
/**
 * [index description]
 * @return [true] [its hold all the navigation]
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

	
	/**
	 * [contact form which allow the user to require information with regarding the app]
	 * @return [true] [respond that it works well]
	 */
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
			
		);

		$this->form_validation->set_rules($config_validation);
		if($this->form_validation->run()===FALSE)
		{
			$this->load->view('ini',$data);

		}else
		{
			$statusInsert=$this->messages_model->getMessages($this->input->post());
			redirect("publiczone/contact?statusInsert=$statusInsert");
		}


		
	}

	/**
	 * [eResidence loads the project pages]
	 * @return [true] [description]
	 */
	public function eResidence()
	{
		$data['pageToLoad']='E-Residence/eResidence';
		$data['pageActive']='eResidence';
		$this->load->view('ini',$data);
		
	}
	/**
	 * [listOfResidents shows a list of residents staying in that particulsr property]
	 * @return [true] [once the owner has approve that list]
	 */
	public function listOfResidents()
	{
		$data['pageToLoad']='E-Residence/listOfRes';
		$data['pageActive']='listOfRes';
		$this->load->view('ini',$data);
		
	}
	/**
	 * [login  this retrieves whether user/owner/admin information is correct in the database so that the user/owner/admin can be able to login]
	 * @return [true] [login]
	 *
	 */
	public function login()
	{
		$data['pageToLoad']='login/loginForm';
		$data['pageActive']='loginForm';
		$this->load->view('ini',$data);
		
	}
	/**
	 * [logout description]
	 * @return [type] [description]
	 */
	public function logout()
	{
		//delete cookie data from db
		//$this->login_model->deleteCookieByToken();
		//delete the cookie
		delete_cookie(COOKIE_TOKEN);
		//distroy the session
		$this->session->sess_destroy();
		redirect('Publiczone');

	}

	/**
	 * [getProvinceDistrict description]
	 * @return [true] [this retrieves the correct information of getProvinceDistrict]
	 */
	public function getProvinceDistrict():array
	{
		$tempdata=array();
		$tempdata['province']=$this->province_model->getProvince();
		foreach ($tempdata['province'] as $prov) 
		{
			$tempdata['district'][$prov->id]=$this->district_model->getDistrict($prov->id);
			
		}
		$tempdata['districts']=$this->district_model->getDistricts();
		foreach ($tempdata['districts'] as $distr) 
		{
			$tempdata['manucipality'][$distr->id]=$this->manucipality_model->getManucipality($distr->id);
			
		}
		$tempdata['manucipalities']=$this->manucipality_model->getManucipalities();
		foreach ($tempdata['manucipalities'] as $tow)
		{
			$tempdata['town'][$tow->id]=$this->town_model->getTown($tow->id);
			
		}

		$tempdata['towns']=$this->town_model->getTowns();
		foreach ($tempdata['towns'] as $sub) 
		{
			$tempdata['suburb'][$sub->id]=$this->suburb_model->getSuburb($sub->id);

			
		}
		$tempdata['suburbs']=$this->suburb_model->getSuburbs();
		foreach ($tempdata['suburbs'] as $sub) 
		{
			$tempdata['address'][$sub->id]=$this->address_model->getAddress($sub->id);
			
		}
		
		

		return $tempdata;		

	}
	/**
	 * [registerUser description]
	 * @return [true] [this retrieves the correct information for registerUser]
	 */
	public function register() 
	{

		$search=array();
		
		//$search['user_id']= $this->input->get('user_id') ?? '0';
		
		//$data['user_id']= $this->user_model->getUser($search);
		$data['user_add']= $this->user_model->getUser($search);

		$data['pageToLoad'] = 'register/register';
		$data['pageActive']='register';
		$data['pageTitle'] = 'Register User';
		$this->load->helper('form');
		$this->load->library('form_validation');
		

		/***get the provice and distric by province id*******/
		$selDistrict= $this->getProvinceDistrict();
		$data['province']= $selDistrict['province'];
		$data['districts']= $selDistrict['district'];
		$data['manucipalities']=$selDistrict['manucipality'];	
		$data['towns']=$selDistrict['town'];	
		$data['suburbs']=$selDistrict['suburb'];	
		$data['address']=$selDistrict['address'];	
		//$data['zip_code']=$selDistrict['zip_code'];	
			//var_dump($data['manucipality']);	
		/*****end */		
		

		//data from db
		
		
		$search = array();
		$data['province']=$this->province_model->getProvince();
		$district = $this->input->post('province');

		//$data['district']=$this->district_model->getDistrict($district);
		
		

		
//Including validation library

		$config_validation = array
		(
			array('field'=>'email',
				'label'=>'email',
				'rules'=>array(
    				'required', 
    				'valid_email',   				
    				'is_unique[user.email]',
    				'max_length[30]',			
    				),
				'errors'=>array
				('required'=>'you should insert %s for the user',
					'valid_email'=>'please enter the correct %s',
					'is_unique'     => 'This %s already exists.',
					'max_length[30]'     => '%s length should not exceed 30.',
				)						
			),

			array(
				'field'=>'password',
				'label'=>'Password',
				'rules'=>array('required',
					'min_length[5]',
					'max_length[25]',
					array('validatePassword',array($this->Login_model,'validatePassword'))),						
				'errors'=>array(						
					'required'=>'you should insert one %s for reset',
					'min_length[5]'=>'You should at least enter 5 charactors of %s',
					'max_length[25]'=>'%s should not exit 25 charactors',
					'validatePassword'=>'password should have at least one simbol/charactor',),			

			),

			array(
				'field'=>'confirm',
				'label'=>'Confirm Password',
				'rules'=>array('required',
					'matches[password]'),											
				'errors'=>array(						
					'required'=>'you should insert one %s for login',
					'matches[newpassword]'=>'% you entered does not match'),
			),

			array('field'=>'name',
				'label'=>'Full Name',
				'rules'=>array
				('required',
					'min_length[3]',
					'max_length[30]',
					'alpha'),
				'errors'=>array
				('required'=>'insert %s ',
					'min_length'=>'%s should have minimum of 3 ',
					'max_length'=>'%s should have maximum of 25',
					'alpha'=>'%s should have alphabet')						
			),	
			
			 array('field'   => 'identitynumber',
    			'label'  =>  'Identity Number',
    			'rules'  =>  array(
    				'required',
    				'exact_length[13]',
    				'numeric',
    				'is_unique[user.identitynumber]'),

    			'errors'  =>  array(
    				'required'  =>  ' %s is required',
    				'exact_length'  =>  'the %s must have 13 numbers',
    				'numeric'  =>  'the %s must have only numbers',
    				'is_unique'     => 'This %s already exists.')
    			),

    			array(
    				'field'=>'dateofbirth',
    				'label'=>'Date of Birth',
    				'rules'=>array('required',
    					'regex_match[/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/]'),
    				'errors'=>array
    				('required'=>'you should insert %s for the user',
    				'regex_match'=>'%s is not valid',)
    			),

    			array(
    				'field'=>'phone',
    				'label'=>'Phone number',
    				'rules'=>array
    				(
    					'required',
    					'exact_length[10]',
    					'numeric',
    					'regex_match[/^[0]\d{9}$/]',
    				),
    				'errors'=>array
    				('required'=>'you should insert one %s ',
    					'exact_length'=>'the %s must have at least length of 10 ',						
    					'regex_match'=>'the %s must starts with 0',									
    					'numeric'=>'the %s must be numbers')	 					
    			),
    			
    			array(
    				'field'=>'gender',
    				'label'=>'Gender',
    				'rules'=>'required',
    				'errors'=>array
    				('required'=>'you should insert %s for the user')    				
    			),
    			array(
    				'field'=>'suburb',
    				'label'=>'Suburb',
    				'rules'=>'required',
    				'errors'=>array
    				('required'=>'you should insert one %s for the user')),

    			array(
    				'field'=>'town',
    				'label'=>'Town',
    				'rules'=>'required',
    				'errors'=>array
    				('required'=>'you should insert one %s for the user')),

    			array(
    				'field'=>'district',
    				'label'=>' District',
    				'rules'=>'required',
    				'errors'=>array
    				('required'=>'you should insert one %s for the user')),

    			array(
    				'field'=>'province',
    				'label'=>'Province',    			
    				'rules'=>'required',
    				'errors'=>array
    				('required'=>'you should insert one %s for the user')

    			),
    			array(

    				'field'=>'manucipality',
    				'label'=>'Manucipality',
    				'rules'=>'required',
    				'errors'=>array
    				('required'=>'you should insert one %s for the user')

    			),
    				array(
				'field'=>'street_name',
				'label'=>'Street Address',
				'rules'=>
				'required',	
				'errors'=>array('required'=>'you should insert %s for the user')
			),
			array(
				'field'=>'door_number',
				'label'=>'Door Number',
				'rules'=>
				'required',	
				'errors'=>array('required'=>'you should insert %s for the user')),				
			);

		$this->form_validation->set_rules($config_validation);
		if($this->form_validation->run()===FALSE)
		{

			$this->load->view('ini',$data);

		}else
		{

			$statusInsert=$this->user_model->addUser($this->input->post());

		redirect("login/login_/userprofile?$statusInsert=$statusInsert");

		}

	}

	/**
	 * [user description]
	 * @return [true] [this retrieves the correct information of user]
	 */


	public function user()
	{

		$data['pageToLoad'] = 'eresidence/listOfResidents';
		$data['pageActive']='listOfResidents';

			//from helper and library
		$this->load->helper('form');


		$this->load->library('form_validation');
		$id_remove = $this->input->post('user_id');

		

		if(null!=$this->input->get('statusEdit'))
		{
			$data['statusEdit'] = $this->input->get('statusEdit');
		}
		if(null!=$this->input->get('statusInsert'))
		{
			$data['statusInsert']=$this->input->get('statusInsert');
		}

		$search=array();

		$search['search']= $this->input->get('search') ?? '';
		$search['page']= $this->input->get('page') ?? 0;
		$search['inputsearch']= $this->input->get('inputsearch') ?? '';
//db communication 


		$config['base_url'] =base_url('publiczone/user?search='.$search['search'].'&inputsearch='.$search['inputsearch']);


	  	//$data['authors'] = $authors;
	  	//$data['editor'] = $editor;

		$data['db'] = $this->user_model->getuser($search);
		$data['userCount'] = $this->user_model->countuser($search);
	  	//$data['models']=$this->Model_model->getModels();
	  	//$data['colors']=$this->Color_model->getColors();
	  	//var_dump($search);
	  	//pagination for the books

	  	//To re-write the links
		$config['enable_query_string'] = TRUE;
	  	 //To  show the actual page number
		$config['page_query_string'] = TRUE;
          //url that will use the pagination
	  	 //$config['base_url'] = base_url('publiczone/fleet?models='.$search['models'].'&licence_plate='.$search['licence_plate'].'&manufactures='.$search['manufactures'].'&colors='.$search['colors'].'&available='.$search['available']);
	  	 //$config['total_rows'] = $data['vehiclesCount'];

	  	 //load the pagination library
	  	 //$this->load->library('pagination');
	  	 //initialize the pagination
	  	 //$this->pagination->initialize($config);
	  	 //$data['search_pagination']=$this->pagination->create_links();



		$this->load->view('ini',$data);


	}

//public function editUser($id=0)

/**
 * [editUser description]
 * @return [true] [this retrieves the correct information when editUser]
 */
	public function editUser()
	{
		$id=$this->input->post('userid');
		//var_dump($id);
		if($id!=0 and is_numeric($id))
		{
			$data['user_id'] = $id;
		 //unset($_SESSION['userid']);
			$this->session->set_userdata('userid',$id);
		}else{
			$id=$data['user_id'] =$_SESSION['userid'];
		}


		$data['pageToLoad'] = 'register/register';
		$data['pageActive']='register';
		$data['pageTitle']='Edit User';
		

		//data from db
		$search=array();
		$data['user_id'] =$_SESSION['userid'];
		$search['user_id']= $data['user_id'];
		//var_dump($search);

		$data['email']=$this->user_model->getUser();
		$data['name']=$this->user_model->getUser();
		$data['identitynumber']=$this->user_model->getUser();
		$data['dateOfbirth']=$this->user_model->getUser();
		$data['date_registration']=$this->user_model->getUser();
		$data['phone']=$this->user_model->getUser();
		//$data['title_deed']=$this->user_model->getUser();
		//$data['registration_number']=$this->user_model->getUser();
		//$data['purchase_price']=$this->user_model->getUser();
		//$data['purchase_date']=$this->user_model->getUser();
		//$data['house_type']=$this->user_model->getUser();

		$data['province']=$this->province_model->getProvince();
		$data['districts']=$this->district_model->getDistricts();
    	$data['manucipalities']=$this->manucipality_model->getManucipalities();
    	$data['towns']=$this->town_model->getTowns();
    	$data['suburbs']=$this->suburb_model->getSuburbs();
    	$data['addresses']=$this->address_model->getAddresses();
    	$data['door_numbers']=$this->address_model->getAddresses();
    	
    	$selDistrict = $this->getProvinceDistrict();
    	$data['province'] = $selDistrict['province'];
    	$data['districts'] = $selDistrict['district'];
    	$data['manucipalities']=$selDistrict['manucipality'];	
    	$data['towns']=$selDistrict['town'];	
    	$data['suburbs']=$selDistrict['suburb'];	
    	$data['address']=$selDistrict['address'];


    	//$data['zip_code']=$this->zip_code_model->getZip_code();

    	$data['userInfo']= $this->user_model->getUser($search);
    	//var_dump($data['userInfo']);
    	foreach ($data['userInfo'] as $key => $value) 
    	{
    		$data['user_data']=$value;


    	}

    	foreach ($data['userInfo'] as $value) 
    	{

    		$data['userEdit'] = $value->user_id;
    		$data['emailEdit'] = $value->email;
    		$data['nameEdit'] = $value->name;
    		$data['identitynumberEdit'] = $value->identityNumber;
    		$data['dateofbirthEdit'] = $value->dateOfBirth;
    		$data['dateOfRegistrationEdit'] = $value->date_registration;
    		$data['phoneEdit'] = $value->phone;
    		$data['provinceEdit'] = $value->province;
    		$data['districtEdit'] = $value->district;
    		$data['manucipalityEdit'] = $value->manucipality;
    		$data['townEdit'] = $value->town;
    		$data['suburbEdit'] = $value->suburb;
    		$data['streetNameEdit'] = $value->street_name;
    		$data['doorNoEdit'] = $value->door_number;
    		//$data['title_deedEdit'] = $value->title_deed;
    		//$data['registration_numberEdit'] = $value->registration_number;
    		//$data['purchase_priceEdit'] = $value->purchase_price;
    		//$data['purchase_dateEdit'] = $value->purchase_date;
    		//$data['house_typeEdit'] = $value->house_type;

			//$data['zip-codeEdit'] = $value->zip_code;

    	}
		//from helper and library
    	$this->load->helper('form');
    	$this->load->library('form_validation');


//Including validation library
    	if(!$this->input->post('usercheck')){
    		$config_validation = array(
    				array('field'=>'email',
				'label'=>'email',
				'rules'=>'required',
				'errors'=>array
				('required'=>'you should insert %s for the user')						
			),


    			

    			array('field'=>'date_registration',
    				'label'=>'Date of Registration',
    				'rules'=>'required',
    				'errors'=>array('required'=>'you should insert %s for the user')						
    			),
    				array(
    				'field'=>'dateofbirth',
    				'label'=>'Date of Birth',
    				'rules'=>'required',
    				'errors'=>array
    				('required'=>'you should insert %s for the user')
    			),

    			array('field'=>'name',
    				'label'=>'Full Name',
    				'rules'=>'required',
    				'errors'=>array('required'=>'you should insert %s for the user')						
    			),


    				array(
				'field'=>'identitynumber',

				'label'=>'Identity Number',
				'rules'=>array
				(
					'required',
					'exact_length[13]',						

					//'regex_match[ /^([0-9]){2}([0-1][0-9])([0-3][0-9])([0-9]){4}([0-1])([0-9]){2}?$/]',
				)),




    			array(
    				'field'=>'phone',
    				'label'=>'Phone number',
    				'rules'=>array(
    					'required',
    					'exact_length[10]',						
    					'regex_match[/^[0-9]+$/]',
    				),



    				'errors'=>array(
    					'required'=>'you should insert one %s ',
    					'exact_length'=>'the %s must have at least length of 10 ',						
    					'regex_match'=>'the %s must be numbers only',)									
    					 					
    			),

    			array(
    				'field'=>'gender',
    				'label'=>'Gender',
    				'rules'=>'required',
    				'errors'=>array(
    					'required'=>'you should insert %s for the user')
    			),

    			array(
    				'field'=>'suburb',
    				'label'=>'Suburb',
    				'rules'=>'required',
    				'errors'=>array(
    					'required'=>'you should insert one %s for the user')
    			),

    			array(
    				'field'=>'town',
    				'label'=>'town',
    				'rules'=>'required',
    				'errors'=>array(
    					'required'=>'you should insert one %s for the user')
    			),

    			array(
    				'field'=>'district',
    				'label'=>'District',
    				'rules'=>'required',
    				'errors'=>array(
    					'required'=>'you should insert one %s for the user')
    			),

    			array(
    				'field'=>'province',
    				'label'=>'Province',
    				'rules'=>'required',
    				'errors'=>array(
    					'required'=>'you should insert one %s for the user')
    			),



    			array(
    				'field'=>'zip_code',
    				'label'=>'zip code',
    				'rules'=>'required',
    				'errors'=>array(
    					'required'=>'you should insert %s for the user')
    			),



    			array(
    				'field'=>'manucipality',
    				'label'=>'Manucipality',
    				'rules'=>'required',
    				'errors'=>array(
    					'required'=>'you should insert one %s for the user'

    				)
    			)
    		
    		);




    		$this->form_validation->set_rules($config_validation);
    		if($this->form_validation->run()===FALSE)
    		{
    			$this->load->view('ini',$data);

    		}else
    		{
    			$statusEdit=$this->user_model->updateUser($this->input->post());
    			//redirect("publiczone/editUser?statusEdit=$statusEdit");
		redirect("residents/userprofile?statusRequest=0");
    		}
    	}else {
    		
    	}
					$this->load->view('ini',$data);
    }



    /**
     * [askdelete description]
     * @param  integer $id_remove [description]
     * @return [true]             [this retrieves when the user has been removed/deleted by owner when the user has been deceased]
     */
    public function askdelete($id_remove=0)
    {



    	if($id_remove!=0 and is_numeric($id_remove))
    	{
    		$data['id_user']=$id_remove;
			//$this->Vehicle_model->deleteVehicle($id_remove);
		}/*else{
			redirect("publiczone/fleet");
		}*/

		$data['pageToLoad'] = 'eResidence/askdelete';
		$data['pageActive']='eResidence';
		$this->load->helper('form');
		$this->load->library('form_validation');

		//Launch the view to check delete
		$this->load->view('ini',$data);

	}
	/******************** for address **************/






	public function change_add() 
	{

		$search=array();
		//$search['user_id']= $this->input->get('user_id') ?? '0';
		
		//$data['user_id']= $this->user_model->getUser($search);

		$data['pageToLoad'] = 'request/change_add';
		$data['pageActive']='request';
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		if(null!=$this->input->get('statusInsert'))
		{
			$data['statusInsert']=$this->input->get('statusInsert');
		}


		/***get the provice and distric by province id*******/
		$selDistrict= $this->getProvinceDistrict();
		$data['province']= $selDistrict['province'];
		$data['districts']= $selDistrict['district'];
		$data['manucipalities']=$selDistrict['manucipality'];	
		$data['towns']=$selDistrict['town'];	
		$data['suburbs']=$selDistrict['suburb'];	
		$data['address']=$selDistrict['address'];	
		//$data['zip_code']=$selDistrict['zip_code'];	
			//var_dump($data['manucipality']);	
		/*****end */		
		

		//data from db
		
		
		$search = array();
		$data['province']=$this->province_model->getProvince();
		$district = $this->input->post('province');

		//$data['district']=$this->district_model->getDistrict($district);
		
		

		
//Including validation library

		$config_validation = array
		(
			

			array(
				'field'=>'suburb',
				'label'=>'suburb',
				'rules'=>'required',
				'errors'=>array
				('required'=>'you should insert one %s for the user')
			),

			array(
				'field'=>'town',
				'label'=>'town',
				'rules'=>'required',
				'errors'=>array
				('required'=>'you should insert one %s for the user')
			),

			array(
				'field'=>'district',
				'label'=>'district',
				'rules'=>'required',
				'errors'=>array
				('required'=>'you should insert one %s for the user'

			)
			),

			array(
				'field'=>'province',
				'label'=>'province',
				'rules'=>'required',
				'errors'=>array
				('required'=>'you should insert one %s for the user'

			)
			),array(
				'field'=>'manucipality',
				'label'=>'manucipality',
				'rules'=>'required',
				'errors'=>array
				('required'=>'you should insert one %s for the user'

			)
			),
			array(
				'field'=>'street_name',
				'label'=>'Street Address',
				'rules'=>
				'required',	
				'errors'=>array('required'=>'you should insert %s for the user'
			)
			),
			array(
				'field'=>'door_number',
				'label'=>'Door Number',
				'rules'=>
				'required',	
				'errors'=>array('required'=>'you should insert %s for the user'
			)
			),




		);

		$this->form_validation->set_rules($config_validation);
		if($this->form_validation->run()===FALSE)
		{

			$this->load->view('ini',$data);

		}else
		{

			$statusInsert=$this->user_model->addUserAddress($this->input->post());
				

		redirect("residents/userprofile?statusInsert=$statusInsert");


		}

	}





}


