<?php 
 
 /**
 * 
 */
 class Testing extends CI_Controller
 {
 		public function __construct()
	{
		parent::__construct();
 			//$this->load->model("listOfRes_model");
 		    //$this->load->model("request_model");
		$is_logged_in =$this->session->userdata('is_logged_in');

		//if($this->session->userdata('is_logged_in')==true)
		if(is_null($is_logged_in )){
			redirect('login/login_');
		}
 	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	 public	function index()
 	{
 		$data['pageToLoad']='makepdf/makepdf';
		$data['pageActive']='makepdf';
		//$this->load->view('ini',$data);

 		$this->load->library('Pdf');
 		$data['user_addinfor']= $this->listOfRes_model->getAddress();
 		$data['owner_addinfor']=$this->request_model->getOwner();
	
	//check if there is owner
	if(empty($data['owner_addinfor'])){
		//delete user adddress of where there is no owner
		$this->request_model->removeUserAddress($search);
		redirect("Testing/index?statusRequest=0");
		
	}

 		$this->load->view('makepdf/makepdf',$data);

 	}

 }
?>