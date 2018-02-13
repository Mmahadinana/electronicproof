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
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id")
				->where("suburb_id",$suburb_id)

				->group_by('address.id')
				->order_by('address.street_name');
		return $this->db->get()->result();
		
	}
	/**
	 * [getAddresses description]
	 * @return [true] [retrieves address of the user]
	 */
	public function getAddresses()
	{

		$this->db->select("address.id,address.door_number,address.street_name")
		->from("address")
			       
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id");
		
		return $this->db->get()->result();
		
	}
	public function check_streetname($street_name){

	}
	public function check_doornumber($door_number){
		
	}

}

?>
