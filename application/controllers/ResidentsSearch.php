<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Residents extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		
		//library to access the session
		$this->load->library("session");
		$this->load->model("request_model");
		$this->load->model("approval_model");
		$this->load->model("ownersProperty_model");
		$this->load->model("ownersDetails_model");
		$this->load->model("login_model");
		$this->load->model("owners_property_model");
		$this->load->model("listOfRes_model");
		$this->load->library('pagination');
		logoutByInactiv();
		$is_logged_in = $this->session->userdata('is_logged_in') ?? FALSE;
		if(!$is_logged_in ){
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
	 public function Eresidence()
	 {
	 	if($_SESSION['role']!="admin")
	 	{
	 		redirect('login/login_');
	 	}
	 	$id_remove=$this->input->post('id_Property');
	 	if ($id_remove!=0 and is_numeric($id_remove))
	 	{
	 		$data['statusRemove']= $this->ownersProperty_model->deleteProperty($id_remove);

	 	}
	 	if(null!=$this->input->get('statusEdit'))
	 	{
	 		$data['statusEdit']= $this->input->get('statusEdit');
	 	}
	 	if(null!=$this->input->get('statusInsert'))
	 	{
	 		$data['statusInsert']= $this->input->get('statusInsert');
	 	}	

	 	//load the page
	 	$data['pageToLoad']='eresidence/eresidence';
	 	$data['pageActive']='eresidence';
	 	$this->load->helper('form');	

	 	/** start search for property   **/		
	 	$search['inputForSearch']=$this->input->get('inputForSearch')??0;
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
	 	

		//pagination for the Properties

	 	$config=$this->getPagination();
		//url that will use the link
	 	$config['base_url']=base_url('residents/eresidence?inputForSearch='.$data["inputForSearch"].'&mysearch='.$this->input->get('mysearch'));

		//number of results to be devided on the pagintion
	 	$config['total_rows']=$data['countProperties'];
	 	//$config['total_rows']=$data['countProp'];


		// atribute for the class assigned to the pagination
	 	
	 	
	 	//$this->getPagination($config);
	 	$this->pagination->initialize($config);
	 	$data['search_pagination']=$this->pagination->create_links();
	 	$this->load->view('ini',$data);
	 }
public function getPagination(){
		$config['uri_segment']  = 3;
	 	$config['enable_query_string']=true;
		//this is the one to show the actual page number,?page=someInt
	 	$config['page_query_string']=true;
	 	/*************tags for pagination with config**************/
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
 * [listOfResidents description]
 * @param  integer $property_id [description]
 * @return [type]               [description]
 */
public function getAllProperties()
{		$data['allproperties']='';
		//$search['hide_owner_search']=$this->input->post('hide_owner_search');
$data['all_properties']=$this->ownersProperty_model->availableProperties();
foreach ($data['all_properties'] as $value) {
	$data['allproperties'].='<div class="colBrd"><div class="col-lg-1 ">'.$value->property.'</div>'.'<div class="col-lg-2 ">'.$value->door_number.' '.$value->street_name.'</div>'.'<div class="col-lg-2 ">'.$value->town.'</div>'.'<div class="col-lg-2 ">'.$value->manucipality.'</div>'.'<div class="col-lg-2 ">'.$value->district.'</div>'.'<div class="col-lg-2  ">'.$value->province.'</div>'.' <div class="col-lg-1  ">  
	<div class="col-lg-6 ">                       
	<form action="#" enctype="multipart/form-data">
	<button type="submit" name="edit" class="fa fa-pencil text-primary"></button>
	</form>
	</div>
	<div class="col-lg-6">
	<form action="#" enctype="multipart/form-data">
	<button type="submit"  title="delete property" ="Submit" class=" glyphicon glyphicon-minus btn-warning"> </button>
	</form>              
	</div>

	</div></div>';
}
$data['countProp']=$this->ownersProperty_model->countAvailableProperties();
$config=$this->getPagination();
$config['total_rows']=$data['countProp'];
$this->pagination->initialize($config);
$data['allproperties'].= $this->pagination->create_links();
echo $data['allproperties'];
}
public function filterAllProperties()
{		$data['allproperties']='';
$search['hide_owner_search']=$this->input->post('hide_owner_search');
		//var_dump($search['hide_owner_search']);
$data['all_properties']=$this->ownersProperty_model->filterAllProperties($search);
foreach ($data['all_properties'] as $value) {
	$data['allproperties'].='<div class="colBrd"><div class="col-lg-1 ">'.$value->property.'</div>'.'<div class="col-lg-2 ">'.$value->door_number.' '.$value->street_name.'</div>'.'<div class="col-lg-2 ">'.$value->town.'</div>'.'<div class="col-lg-2 ">'.$value->manucipality.'</div>'.'<div class="col-lg-2 ">'.$value->district.'</div>'.'<div class="col-lg-2  ">'.$value->province.'</div>'.' <div class="col-lg-1  ">  
	<div class="col-lg-6 ">                       
	<form action="#" enctype="multipart/form-data">
	<button type="submit" name="edit" class="fa fa-pencil text-primary"></button>
	</form>
	</div>
	<div class="col-lg-6">
	<form action="#" enctype="multipart/form-data">
	<button type="submit"  title="delete property" ="Submit" class=" glyphicon glyphicon-minus btn-warning"> </button>
	</form>              
	</div>

	</div></div>';

}
echo $data['allproperties'];
}
/**
 * [filterAvailableProperties filter available properties]
 * @return [type] [description]
 */
public function filterAvailableProperties()
{		$data['avalProperties']='';
$search['hide_owner_search']=$this->input->post('add_owner_search');
		//var_dump($search['hide_owner_search']);
$data['all_properties']=$this->ownersProperty_model->filterAllProperties($search);
foreach ($data['all_properties'] as $value) {
	$data['avalProperties'].='<div class="colBrd"><div class="col-lg-1 ">'.$value->property.'</div>'.
	'<div class="col-lg-1"><button type="submit" name="edit" class="fa fa-plus-circle text-success" title="Asign Owner to this property"></button> <span class="text-default">Owner</span></div>'.
	'<div class="col-lg-2 ">'.$value->door_number.' '.$value->street_name.'</div>'.
	'<div class="col-lg-1 ">'.$value->town.'</div>'.'<div class="col-lg-2 ">'.$value->manucipality.'</div>'.
	'<div class="col-lg-2 ">'.$value->district.'</div>'.'<div class="col-lg-2  ">'.$value->province.'</div>'.
	' <div class="col-lg-1"><div class="col-lg-6 ">                       
	<form action="#" enctype="multipart/form-data">
	<button type="submit" name="edit" class="fa fa-pencil text-primary"></button>
	</form>
	</div>
	<div class="col-lg-6">
	<form action="#" enctype="multipart/form-data">
	<button type="submit"  title="delete property" ="Submit" class=" glyphicon glyphicon-minus btn-warning"> </button>
	</form>              
	</div>

	</div></div>';
}
echo $data['avalProperties'];
}

public function listOfResidents()
{
	if($_SESSION['role']=="resident")
	{
		redirect('login/login_');
	}
	$search=array();
	$property_id=$this->input->post('property_id');

	$search['property_id']=$property_id;
	$search['property_id1']=$property_id;
		//$data['property_id']=$_SESSION['property_id'];

	if ($property_id != null) {

		$this->session->set_userdata('property_id',$property_id);
	}
	else {

		$search['property_id']=$_SESSION['property_id'];
		$search['property_id1']=$_SESSION['property_id'];

	}
	$data['user_addinfor']= $this->listOfRes_model->getAddress($search);
		//var_dump($data['user_addinfor']);
	$data['add_addinfor']= $this->listOfRes_model->getAddressTwo($search);
	$data['pageToLoad']='eresidence/listOfResidents';
	$data['pageActive']='eresidence';

     //loading the form and files for file uoload		
	$this->load->helper(array('form','file','url'));
	//$this->load->helper(array('form','url'));
	$this->load->library('form_validation');
	//$this->load->view('ini',$data);

	$this->load->view('ini',$data);		




}
/**
 * [getOwnerOfProperty description]
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
public function getOwnerOfProperty($user_id){

	$search=array();
	$confirmlist=array();
	$search['user_id']=$user_id;
	echo json_encode($data['owner']);
	return $data['owner']=$this->request_model->getOwner($search);

}
/**
	 * [userprofile view has the inforamtion or profile of the user]
	 * @return [type] [description]
	 */
public function userprofile()
{
	if(null!=$this->input->get('statusInsert')){
		$data['statusInsert']= $this->input->get('statusInsert');

	}
	if(null!=$this->input->get('statusRequest')){
		$data['statusRequest']= $this->input->get('statusRequest');

	}	
	if(null!=$this->input->get('statusConfirm')){
		$data['statusConfirm']= $this->input->get('statusConfirm');

	}
	$search=array();
	$properties=array();
	$search['user_idprofile']= $_SESSION['id'];

		//$search[23]= $this->input->get('user_id') ?? '0';


	$data['user_addinfor']= $this->request_model->getUser($search);
	$data['property_addinfor']= $this->ownersProperty_model->getProperty($search);
	$data['add_addinfor']= $this->owners_property_model->getProperty($search);

	$data['pageToLoad']='userprofile/userprofile';
	$data['pageActive']='userprofile';

// loading the form and files for file uoload		
	$this->load->helper(array('form','file','url'));
		//$this->load->helper(array('form','url'));
	$this->load->library('form_validation');		

	$this->load->view('ini',$data);

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
		//$data['getOwnerListToComfirm']=array();		
		$data['owner']=$this->getOwnerOfProperty($_SESSION['id']);
		$search['owner']=$_SESSION['id'];
		//$count=count($data['owner']);
		$data['getListToComfirm']=$this->request_model->getListToComfirmRequest($search);
		//var_dump($data['owner']);
		foreach ($data['owner'] as $owner) {

			foreach ($data['getListToComfirm'] as $confirm) {
				if ($confirm->property_id==$owner->property) {
					
					/*$requestPropertyID[$confirm->property_id]=$confirm->property_id;*/
					//get the list that owner should complete
					$data['getOwnerListToComfirm']=$this->request_model->getListToComfirm();
					
				}					
			}		
			//var_dump($data['getOwnerListToComfirm']);
			//$ownerPropertyID[$owner->property]=$owner->property;
			
		}		
		
		/*foreach ($data['getListToComfirm'] as $confirm) {
			$requestPropertyID[$confirm->property_id]=$confirm->property_id;
		}
		if (expr) {
			
		}*/

		$data['pageToLoad']='request/confirmList';
		$data['pageActive']='request';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('ini',$data);
	}


	/**
	 * [OwnersDetails page for owner and admin]
	 * @param integer $property_id [description]
	 */
	public function OwnersDetails($property_id = 0)

	{
		$search=array();
		$search['property_id']=$property_id;
		//$search['property_id1']=$property_id;
		$data['user_addinfor']= $this->ownersDetails_model->getAddressTwo($search);
		$search['user_id']= $_SESSION['id'];
		

		$data['pageToLoad']='eresidence/OwnersDetails';
		$data['pageActive']='eresidence';

		$this->load->helper('form');

		$this->load->view('ini',$data);	

	}
	/**
	 * [ResidencialProperty page]
	 */
	public function ResidencialProperty()
	{
		$data['pageToLoad']='eresidence/ResidencialProperty';
		$data['pageActive']='ResidencialProperty';
		
		$id =  $_SESSION['id'];

		$search['user_id']= $_SESSION['id'];	
		$search['mysearch']= $this->input->post('mysearch')??'';

		$search['page']=$this->input->get('per_page')??0;
		
		$data['search']=$search;

	//$data['user_addinfor']= $this->request_model->getUser($search);
		//$config['per_page'] = 3;

		$data['property_addinfor']= $this->owners_property_model->getProperty($search);
		
		//$data['mysearch']= $this->owners_property_model->getProperty($search);
		$data['addressCount']=$this->ownersProperty_model->countProperties($search);

		$config['enable_query_string'] = TRUE;
		
		//to show the actual page number
		$config['page_query_string'] = TRUE;
		//config base_url that use pagination
		$config['base_url'] = base_url('residents/ResidencialProperty?mysearch='.$search['mysearch']);

		//number of results to be divided on the pagination
		$config['total_rows'] =$data['addressCount'];
		//load the pagination library

		//initialise the pagination with config
		$this->pagination->initialize($config);
		//create links to be send to the view
		$data['search_pagination']=$this->pagination->create_links();
		//var_dump($data['search_pagination']);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('ini',$data);

	}


}


