<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		
		//library to access the session
		//$this->load->library("session");
		$this->load->model("address_model");
		$this->load->model("province_model");
		$this->load->model("suburb_model");
		//$this->load->model("ownersDetails_model");
		//$this->load->model("login_model");
		//$this->load->model("owners_property_model");
		//$this->load->model("listOfRes_model");
		//$this->load->library('pagination');
		
		$is_logged_in =$this->session->userdata('is_logged_in');

		//if($this->session->userdata('is_logged_in')==true)
		if(is_null($is_logged_in )){
			redirect('login/login_');
		} 
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
	 *Changes
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	// This function list all the properties and enable search for property

	 /**
	  * [Eresidence description]
	  */
	 /*public function Admin()
	 {
	 	if($_SESSION['role']!="admin")
	 	{
	 		redirect('residents/admin');
	 	}
	 	$id_remove=$this->input->post('id_Property');

	 	//variables holding the messages for success or failer when has done the following actions
	 	if ($id_remove!=0 and is_numeric($id_remove))
	 	{
	 		$data['statusRemove']= $this->ownersProperty_model->deleteProperty($id_remove);

	 	}
	 	if(null!=$this->input->get('statusEdit'))
	 	{
	 		$data['statusEdit']= $this->input->get('statusEdit');
	 	}
	 	if(null!=$this->input->get('statusRequest'))
	 	{
	 		$data['statusRequest']= $this->input->get('statusRequest');
	 	}
	 	if(null!=$this->input->get('statusInsert'))
	 	{
	 		$data['statusInsert']= $this->input->get('statusInsert');
	 	}	

	 	if(null!=$this->input->get('statusUpdate')){
			$data['statusUpdate']= $this->input->get('statusUpdate');

		}
  //user that does is not owner have no access to this view
		if ($_SESSION['owner'] != true) {
			redirect(base_url());
		}
		$search=array();		
		$requestPropertyID=array();		
		//$data['getOwnerListToComfirm']=array();		
		//$data['owner']=$this->getOwnerOfProperty($_SESSION['id']);
		$search['owner']=$_SESSION['id'];
		//$count=count($data['owner']);
		$data['getListToComfirm']=$this->request_model->getListToComfirmRequest($search);
		//var_dump($data['owner']);
		foreach ($data['owner'] as $owner) {

			foreach ($data['getListToComfirm'] as $confirm) {
				if ($confirm->property_id==$owner->property) {
					
					/*$requestPropertyID[$confirm->property_id]=$confirm->property_id;*/
					//get the list that owner should complete
					/*******************$data['getOwnerListToComfirm']=$this->request_model->getListToComfirm();
					
				}					
			}		
			//var_dump($data['getOwnerListToComfirm']);
			//$ownerPropertyID[$owner->property]=$owner->property;
			
		}		
		
	 	//load the page
	 	$data['pageToLoad']='Admin/admin';
	 	$data['pageActive']='admin';
	 	$this->load->helper('form');	

	 	/** start search for property   **/		
	 	/****************************************$search['inputForSearch']=$this->input->get('inputForSearch')??0;
	 	$data['inputForSearch']=$this->input->get('inputForSearch');
	 	//name of owner
	 	$search['name'] = '';

	 	$search['property_id'] = 0;
	 	$search['town'] = '';
	 	$search['municipality'] = '';
	 	$search['district'] = '';
	 	$search['province'] = '';
	 	
	 	//search by the the field that is selected
	 	if ($data['inputForSearch']==1) 
	 	{

	 		$search['name']=$this->input->get('mysearch') ?? '';
	 	}
	 	elseif ($data['inputForSearch']== 2) 
	 	{
	 		$search['property_id']=$this->input->get('mysearch') ?? 0;

	 	}
	 	elseif($data['inputForSearch']== 3)
	 	{
	 		$search['town']=$this->input->get('mysearch') ?? '';
	 	}
	 	elseif($data['inputForSearch']== 4)
	 	{
	 		$search['municipality']=$this->input->get('mysearch') ?? '';
	 	}
	 	elseif($data['inputForSearch']== 5)
	 	{
	 		$search['district']=$this->input->get('mysearch') ?? '';
	 	}
	 	elseif($data['inputForSearch']== 6)
	 	{
	 		$search['province']=$this->input->get('mysearch') ?? '';
	 	}

	 	$search['page']=$this->input->get('per_page')??0;


	 	$data['search']=$search;
		//get all the properties where there is owner		
	 	$data['db']=$this->ownersProperty_model->getProperty($search);
	 	//get all the properties that does not have the owner
	 	$search['owner_id']=0;
	 	//$data['all_properties']=$this->ownersProperty_model->availableProperties($search);
	 	$data['available_properties']=$this->ownersProperty_model->getAvailableProperties($search);

		// count for all the properties
		
	 	$data['countProperties']=$this->ownersProperty_model->countProperties($search);
	 	$data['countProp']=$this->ownersProperty_model->countAvailableProperties($search);

		//pagination for the Properties

	 	$config['enable_query_string']=true;
		//this is the one to show the actual page number,?page=someInt
	 	$config['page_query_string']=true;
		//url that will use the link
	 	$config['base_url']=base_url('residents/admin?inputForSearch='.$data["inputForSearch"].'&mysearch='.$this->input->get('mysearch'));

		//number of results to be devided on the pagintion
	 	$config['total_rows']=$data['countProperties'];
	 	//$config['total_rows']=$data['countProp'];


		// atribute for the class assigned to the pagination

	 	$config['uri_segment']  = 3;

	 	
	 	/*************tags for pagination with config**************/
	 	/*--$config['full_tag_open'] = '<ul class="pagination">';
	 	$config['full_tag_close'] = '</ul>';
	 	$config['first_link'] = 'FIRST';
	 	$config['last_link'] = 'LAST';
	 	$config['first_tag_open'] = '<li>';
	 	$config['first_tag_close'] = '</li>';
	 	$config['prev_link'] = 'Prev';
	 	$config['prev_tag_open'] = '<li class="prev">';
	 	$config['prev_tag_close'] = '</li>';
	 	$config['next_link'] = 'Next';
	 	$config['next_tag_open'] = '<li>';
	 	$config['next_tag_close'] = '</li>';
	 	$config['last_tag_open'] = '<li>';
	 	$config['last_tag_close'] = '</li>';
	 	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	 	$config['cur_tag_close'] = '</a></li>';
	 	$config['num_tag_open'] = '<li>';
	 	$config['num_tag_close'] = '</li>';
	 	//$this->getPagination($config);
	 	$this->pagination->initialize($config);
	 	$data['search_pagination']=$this->pagination->create_links();
	 	$this->load->view('ini',$data);
	 }*/

	 /**
	  * [getPagination description]
	  * @param  [type] $config [description]
	  * @return [type]         [description]
	  */
	 public function getPagination($config){

	 	$config['enable_query_string']=true;
	 	$config['page_query_string']=true;
	 	$config['uri_segment']  = 3;
	 	$config['full_tag_open'] = '<ul class="pagination">';
	 	$config['full_tag_close'] = '</ul>';
	 	$config['first_link'] = 'FIRST';
	 	$config['last_link'] = 'LAST';
	 	$config['first_tag_open'] = '<li>';
	 	$config['first_tag_close'] = '</li>';
	 	$config['prev_link'] = 'Prev';
	 	$config['prev_tag_open'] = '<li class="prev">';
	 	$config['prev_tag_close'] = '</li>';
	 	$config['next_link'] = 'Next';
	 	$config['next_tag_open'] = '<li>';
	 	$config['next_tag_close'] = '</li>';
	 	$config['last_tag_open'] = '<li>';
	 	$config['last_tag_close'] = '</li>';
	 	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	 	$config['cur_tag_close'] = '</a></li>';
	 	$config['num_tag_open'] = '<li>';
	 	$config['num_tag_close'] = '</li>';
	 	return $config;
	 }
	 /**
	  * [Newproperty admin add new property]
	  */
	 public function Newproperty(){
	 	$search=array();
		//var_dump($this->input->post('add_check'));
	 	$search['suburb']='n';
	 	$all_add=$this->province_model->getAddress($search);

	 	$data['address']=array();
		/*$all_properties=$this->province_model->getProperty();
		if (!empty($data['address'])) {
			$data['allAddress']='<option value="0"></option>';*/

	 	$data['addresslist']=$this->province_model->getAddressPropertyIsNull();
	 	$data['pageToLoad']='Admin/newproperty';
	 	$data['pageActive']='Admin';
	 	$this->load->helper('form');
	 	$this->load->library('form_validation');
		
	 	$config_validation = array
	 	(
	 		array(
	 			'field'=>'add_check',
	 			'label'=>' ',
	 			'rules'=>'required',
	 			'errors'=>array('required'=>'you should insert %s for the user')),
	 	);

	 	$this->form_validation->set_rules($config_validation);
	 	if($this->form_validation->run()===FALSE)
	 	{
			//var_dump($this->input->post());
	 		$this->load->view('ini',$data);

	 	}else
	 		{
		 		$statusInsert=$this->address_model->newproperty($this->input->post());

				//send success or failer message to jquery
		 		echo alertMsg($statusInsert,'Property was successfully added',
		 					'Sorry! This address does not exist.. <span class="glyphicon glyphicon-thumbs-down"></span>');
	 	}	
	 }

	/**
	 * [listOfResidents description]
	 * @param  integer $property_id [description]
	 * @return [type]               [description]
	 */
	
	public function getAllProperties()
	{	
		$data['allproperties']='';
		//$search['hide_owner_search']=$this->input->post('hide_owner_search');
		$data['all_properties']=$this->ownersProperty_model->availableProperties();

		foreach ($data['all_properties'] as $value) {

			$data['allproperties'].='<div class="colBrd"><div class="col-lg-1 ">'
								  .$value->property.'</div>'.'<div class="col-lg-2 ">'.$value->door_number
								  .' '.$value->street_name.'</div>'.'<div class="col-lg-2 ">'.$value->town
								  .'</div>'.'<div class="col-lg-2 ">'.$value->manucipality.'</div>'
								  .'<div class="col-lg-2 ">'.$value->district.'</div>'
								  .'<div class="col-lg-2  ">'.$value->province.'</div>'
								  .' <div class="col-lg-1  "><div class="col-lg-6 ">						                       
									<form action="#" enctype="multipart/form-data">
									<button type="submit" name="edit" class="fa fa-pencil text-primary"></button>
									</form></div><div class="col-lg-6"><form action="#" enctype="multipart/form-data">
									<button type="submit" title="delete property" class="glyphicon glyphicon-minus btn-warning">
									</button></form></div></div></div>';
		}
		echo $data['allproperties'];
	}

	/**
	 * [filterAllProperties is a search for properties that does not have owner called by jquery script in manage property]
	 * @return [type] [description]
	 */
	public function filterAllProperties()
	{	
		$data['allproperties']='';
		$search['hide_owner_search']=$this->input->post('hide_owner_search');
		//get all the properties
		$data['all_properties']=$this->ownersProperty_model->filterAllProperties($search);

		foreach ($data['all_properties'] as $value) {

			$data['allproperties'].='<div class="colBrd"><div class="col-lg-1 ">'.$value->property
								  .'</div><div class="col-lg-2 ">'.$value->door_number
								  .' '.$value->street_name.'</div><div class="col-lg-2 ">'.$value->town
								  .'</div><div class="col-lg-2 ">'.$value->manucipality
								  .'</div><div class="col-lg-2 ">'.$value->district.'</div>'
								  .'<div class="col-lg-2  ">'.$value->province
								  .'</div><div class="col-lg-1"><div class="col-lg-6 ">                       
									<form action="#" enctype="multipart/form-data">
									<button type="submit" name="edit" class="fa fa-pencil text-primary"></button>
									</form></div><div class="col-lg-6">
									<form action="#" enctype="multipart/form-data">
									<button type="submit" title="delete property" class="glyphicon glyphicon-minus btn-warning">
									</button></form></div></div></div>';
		}
		echo $data['allproperties'];
	}
	/**
	 * [searchAddress get the address by suburb]
	 * @return [type] [description]
	 */
	public function searchAddress()
	{		
		$data['allAddress']='';
		$data['address']=array();
		//get all the subrbs
		$search['suburb']=$this->input->post('input_search');

		//$all_add=$this->province_model->getAddress();

		$data['address']=array();
	
		//if (!empty($data['address'])) {
		$all_properties=$this->province_model->filterSuburb($search);
		$data['allAddress']='<option value="0"></option>';

		foreach ($all_properties as $value) {

			$data['allAddress'].='<option value="'.$value->suburb_id.'">'.$value->suburb.'</option>';
		}
		/*foreach ($all_add as $prop_val) {
			$search['address_id']=$prop_val->id;
			//get list of all properties where address_id id present
			//$all_properties=$this->province_model->getProperty($search);
			//get address where it does not exist on property
				
			
			if(empty($all_properties)){
				var_dump($all_properties);
				//get address where it does not exist on property
				$data['address']=$this->province_model->getAddressPropertyIsNull($search);
				var_dump($prop_val->id);
				
				$data['allAddress']='<option value="0"></option>';
				foreach ($all_properties as $value) {

					$data['allAddress'].='<option value="'.$value->suburb_id.'">'.$value->suburb.'</option>';
				}*/

				
			//}	
		//}

		echo $data['allAddress'];
	}

	/**
	 * [Addresslist description]
	 */
	public function Addresslist()
	{		
		$data['allAddress']='';
		$search['suburb_id']=$this->input->post('select_ad_suburb');
		//get all the address where there is suburb_id
		$all_add=$this->province_model->getAddress($search);

		$data['address']=array();

		//if (!empty($data['address'])) {
		foreach ($all_add as $prop_val) {

			$search['address_id']=$prop_val->id;
			//get list of all properties where address_id id present
			$all_properties=$this->province_model->getProperty($search);

			if(empty($all_properties)){
				//get address where it does not exist on property
				$data['address']=$this->province_model->getAddressPropertyIsNull($search);
			}
		}

		$data['allAddress']='<h4 class="text-success" >Choose a Street Address to add new Property</h4>';
		foreach ($data['address'] as $value) {
			$data['allAddress'].='<div class="col-lg-1">'.$value->door_number
							   .'</div><div class="col-lg-11"> <input type="checkbox" value="'.$value->id
							   .'"> '.$value->street_name.",\n".$value->town.",\n".$value->municipality
							   .",\n".$value->district.",\n".$value->province.'</div> <br>';
		}

		echo $data['allAddress'];
	}

	/**
	 * [AddresslistByProvince description]
	 */
	
	public function AddresslistByProvince()
	{		
		$allAddress='';
		$search['province_id']=$this->input->post('province_search');
		$data['address']=$this->address_model->getAddressPropertyIsNull($search);
		$count=count($data['address']);

		//html to be written on newproperty view
		//write the list group header
		$allAddress.='<h4 class="list-group-item-heading">Choose a Street Address to add new Property</h4>';
		
		//open the p element
		//the results with option select
		foreach ($data['address'] as $value) {
			$allAddress.='<div class="col-lg-1">'.$value->door_number
					   .'<label for="add_check"> </label></div><div class="col-lg-11"> 
					   <input type="checkbox" id="add_check" name="add_check" value="'.$value->id
					   .'"> '.$value->street_name.",\n".$value->town.",\n".$value->municipality
					   .",\n".$value->district.",\n".$value->province.'</div> <br>';
			/************pagination**********/
			
			/*$config['base_url']=base_url('admin/newproperty?province_search='.$search['province_id']);
			$config['total_rows']=$count;
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$config=$this->getPagination($config);
			$search_pagination=$this->pagination->create_links();*/

		 		/************pagination*********
			
			$config['base_url']=base_url('admin/newproperty?province_search='.$search['province_id']);
			$config['total_rows']=$count;
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$config=$this->getPagination($config);
			$search_pagination=$this->pagination->create_links();*/		 	
		}
			//close the p element
			//$allAddress.='</div>';
		echo ($allAddress);
	}

	/**
	 * [autocomplete not in use at the moment]
	 * @return [type] [description]
	 */
	
	public function autocomplete()
	{		
		$allAddress=array();
		$i=0;
		$search['province_id']=$this->input->post('province_search');

		$data['address']=$this->address_model->getAddressPropertyIsNull($search);
		//$data['allAddress']='<h4 class="text-success" >Choose a Street Address to add new Property</h4>';
		
		foreach ($data['address'] as $value) {

			$allAddress['street_name'][$i]=$value->street_name;
			/*$data['allAddress'].='<div class="col-lg-1">'.$value->door_number.'</div><div class="col-lg-6"> <input type="checkbox" value="'.$value->id.'"> '.$value->street_name.'</div> <br>';*/
			$i++;
		}
		echo json_encode($allAddress['street_name']);
	}

	/**
	 * [filterAvailableProperties is a search for all available properties called by jquery script in manage property]
	 * @return [type] [description]
	 */
	
	public function filterAvailableProperties()
	{		
		$data['avalProperties']='';
		$search['hide_owner_search']=$this->input->post('add_owner_search');
				//var_dump($search['hide_owner_search']);
		$data['all_properties']=$this->ownersProperty_model->filterAllProperties($search);
		foreach ($data['all_properties'] as $value) {

			$data['avalProperties'].='<div class="colBrd"><div class="col-lg-1 ">'.$value->property
								   .'</div><div class="col-lg-1">
								   <button type="submit" name="edit" class="fa fa-plus-circle text-success" title="Asign Owner to this property">
								   </button> <span class="text-default">Owner</span></div>
								   <div class="col-lg-2 ">'.$value->door_number
								   .' '.$value->street_name.'</div><div class="col-lg-1 ">'.$value->town
								   .'</div><div class="col-lg-2 ">'.$value->manucipality
								   .'</div><div class="col-lg-2 ">'.$value->district
								   .'</div><div class="col-lg-2  ">'.$value->province
								   .'</div><div class="col-lg-1"><div class="col-lg-6 ">                       
									<form action="#" enctype="multipart/form-data">
									<button type="submit" name="edit" class="fa fa-pencil text-primary"></button>
									</form></div><div class="col-lg-6"><form action="#" enctype="multipart/form-data">
									<button type="submit"  title="delete property" class=" glyphicon glyphicon-minus btn-warning">
									</button></form></div></div></div>';
		}
		echo $data['avalProperties'];
	}

	/**
	 * [getUser filter the user email]
	 * @return [type] [description]
	 */
	public function getUser(){

		$search=array();
		$email='';
		$email.='<option value="0">choose email</option>';
		$userid='';
		$search['username']=$this->input->post('mysearch');

		//echo json_encode($data['owner']);
		$data['username']=$this->user_model->getUser($search);

		foreach($data['username'] as $ownerdata){

			$email.='<option value="'.$ownerdata->userid.'" class="useremail">'.$ownerdata->email.'</option>';
			//$email.='<a href="#" class="list-group-item useremail">'.$ownerdata->email.'</a>';
			//$userid.='<input type="hidden" class="user_sid" name="user_sid"'.$ownerdata->userid.'>';
			//$userid.='<input type="hidden" class="user_sid" name="user_sid"'.$ownerdata->userid.'>';

		}
		//$mydata=array('mail'=>$email,'userid'=>$userid);
		//$mydata=array('mail'=>$email,'userid'=>$userid);
		echo json_encode($email);
	}

		/**
		 * [confirmList description]
		 * @return [type] [description]
		 */
	public function confirmList() 
	{
		
		if(null!=$this->input->get('statusUpdate')){
			$data['statusUpdate']= $this->input->get('statusUpdate');

		}
	 	//user that does is not owner have no access to this view
		if ($_SESSION['owner'] != true) {
			redirect(base_url());
		}
		$search=array();		
		$requestPropertyID=array();		
		//get the owner of the propety		
		$data['owner']=$this->getOwnerOfProperty($_SESSION['id']);
		$search['owner']=$_SESSION['id'];
		//$count=count($data['owner']);
		$data['getListToComfirm']=$this->request_model->getListToComfirmRequest($search);
		//var_dump($data['owner']);
		//
		foreach ($data['owner'] as $owner) {

			foreach ($data['getListToComfirm'] as $confirm) {

				if ($confirm->property_id==$owner->property) {					
					/*$requestPropertyID[$confirm->property_id]=$confirm->property_id;*/
					//get the list that owner should complete
					$data['getOwnerListToComfirm']=$this->request_model->getListToComfirm();					
				}					
			}	
			//$ownerPropertyID[$owner->property]=$owner->property;
			
		}		
			
		/*foreach ($data['getListToComfirm'] as $confirm) {
			$requestPropertyID[$confirm->property_id]=$confirm->property_id;
		}
		if (expr) {
			
		}*/


		$data['pageToLoad']='Admin/confirmList';
		$data['pageActive']='Admin';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('ini',$data);
	}
}


