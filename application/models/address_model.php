<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getAddress($suburb_id=0)
	{

		$this->db->select("address.door_number,address.street_name")
		->from("address")
		->where("suburb_id",$suburb_id);
		return $this->db->get()->result();
		
	}
	
}

?>
