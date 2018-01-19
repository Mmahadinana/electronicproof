<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * Enables the user to retrieve the address from the database.
	 */
	public function getAddress($suburb_id=0)
	{

		$this->db->select("address.id,address.door_number,address.street_name,address.suburb_id")
		->from("address")
		->where("suburb_id",$suburb_id);
		return $this->db->get()->result();
		
	}
	public function getAddresses()
	{

		$this->db->select("address.id,address.door_number,address.street_name")
		->from("address");
		
		return $this->db->get()->result();
		
	}
	
}

?>
