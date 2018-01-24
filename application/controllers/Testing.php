<?php 
 
 /**
 * 
 */
 class Testing extends CI_Controller
 {
 	
 public	function index()
 	{
 		$this->load->library('Pdf');
 		$this->load->view('makePDF/makepdf');
 	}


 }
?>