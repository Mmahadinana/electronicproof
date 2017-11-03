<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District_model extends CI_MODEL{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function getDistrict()
	$this->db->select("district.id,district.name")
		         ->from("district");
		       return $this->db->get()->result();
}
	public function callback_checkManufacturers($district_id){
		$this->db->select("district.id")
		->from("district")
		->where("id",$district_id);
		if($this->db->get()->row()){
			return TRUE;
		}else {
			return FALSE;
		}
	}
}

?>