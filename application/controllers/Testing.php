<?php 
 
 /**
 * 
 */
 class Testing extends CI_Controller
 {
 		public function __construct()
	{
		parent::__construct();
 			$this->load->model("listOfRes_model");
 		}

 public	function index()
 	{
 		$data['pageToLoad']='makePDF/makepdf';
		$data['pageActive']='makepdf';
		//$this->load->view('ini',$data);

 		$this->load->library('Pdf');
 		$data['user_addinfor']= $this->listOfRes_model->getAddress();

 		$this->load->view('makePDF/makepdf',$data);


 	}


 }
?>