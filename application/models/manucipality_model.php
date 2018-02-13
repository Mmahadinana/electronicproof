<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manucipality_model extends CI_MODEL
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//This function retrieves the list of manucipalities
	public function getManucipality($manucipality_id=0)
	{

		$this->db->select("manucipality.id,manucipality.name,district_id")
				->from("manucipality")		        	
		        ->join("town","town.manucipality_id =manucipality.id ")
		        ->join("suburb","suburb.town_id = town.id")
				->join("address"," address.suburb_id = suburb.id")
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id")

				->where("district_id",$manucipality_id)

		   		->group_by('manucipality.id')
				->order_by('manucipality.name');
		return $this->db->get()->result();
		
	}
	/**
	 * [getManucipalities get all the minicipalities]
	 * @return [true] [retrieves the data of each municipality]
	 */
	public function getManucipalities()
	{

		$this->db->select("manucipality.id,manucipality.name,district_id")
		->from("manucipality")
		->join("town","town.manucipality_id =manucipality.id ")
		        ->join("suburb","suburb.town_id = town.id")
				->join("address"," address.suburb_id = suburb.id")
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id");
		
		return $this->db->get()->result();
		
	}
	public function check_municipality(){}

}

?>
