<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getDistrict($search=0)
{
	//var_dump($search);
	$this->db->select("district.id,district.name,province_id")
		         ->from("district")
		         ->where('province_id',$search);
		       return $this->db->get()->result();
}
public function getDistricts()
{
	
	$this->db->select("district.id,district.name,province_id")
		         ->from("district");
		         //->where('province_id',$search);
		       return $this->db->get()->result();
}


		
}
?>