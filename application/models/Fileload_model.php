<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Fileload_model extends CI_MODEL
{
var $file_uploadpath;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('file','form','url'));

		$this->file_uploadpath=realpath(APPPATH . './id_upload');
		
	}
}