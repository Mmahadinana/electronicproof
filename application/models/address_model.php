<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/**
	 * [getAddress in a specific suburb]
	 * @param  integer $suburb_id [description]
	 * @return [type]             [description]
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
	 * [getAddresses all addresses]
	 * @param  array  $searchAddress [description]
	 * @return [type]                [description]
	 */
	public function getAddresses($searchAddress=array())
	{
		$street_name=$searchAddress['id'] ?? false;
		$door_number=$searchAddress['id'] ?? false;
		$suburb_id=$searchAddress['suburb'] ?? false;
		if ($street_name) {
			$this->db->where('address.id',$street_name)
					->where('address.suburb_id',$suburb_id);
		}if ($street_name) {
			$this->db->where('address.id',$door_number)
					->where('address.suburb_id',$suburb_id);
		}

		$this->db->select("address.id,address.door_number,address.street_name")
		->from("address")
			       
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id");
		
		return $this->db->get()->result();
		
	}

	/**
	 * [check_streetname if it is a valid input]
	 * @param  [type] $street_name [description]
	 * @return [type]              [description]
	 */
	public function check_streetname($street_name){
		$searchAddress['id']=$this->input->post('street_name');
		$searchAddress['suburb']=$this->input->post('suburb');

		if ($searchAddress['id'] ==0) {
			//return false if field is empty
			return false;
		}
		$data=$this->getAddresses($searchAddress);

		//return false if data is empty
		return	$retVal = (empty($data)) ? false: true;
	}

	/**
	 * [check_doornumber if it is valid input]
	 * @param  [type] $door_number [description]
	 * @return [type]              [description]
	 */
	public function check_doornumber($door_number){
		$searchAddress['id']=$this->input->post('door_number');
		$searchAddress['suburb']=$this->input->post('suburb');
		if ($searchAddress['id'] ==0) {
			//return false if field is empty
			return false;
		}
		$data=$this->getAddresses($searchAddress);

		//return false if data is empty
		return	$retVal = (empty($data)) ? false: true;
	}
	

}

?>
