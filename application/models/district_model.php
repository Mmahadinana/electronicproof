<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District_model extends CI_MODEL{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function getDistrict()
{
	$this->db->select("district.id,district.name,province_id")
		         ->from("district");
		       return $this->db->get()->result();
}

		
}
?>