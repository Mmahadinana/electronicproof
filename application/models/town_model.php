<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Town_model extends CI_MODEL
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/**
	 * [getTown description]
	 * @param  [type] $manucipality_id [description]
	 * @return [true]                  [retrieves owner/user towns]
	 */
	public function getTown($manucipality_id)
	{
		$this->db->select("town.id,town.name,town.zip_code,manucipality_id")
				->from("town")

		        ->join("suburb","suburb.town_id = town.id")
				->join("address"," address.suburb_id = suburb.id")
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id")

				->where("manucipality_id",$manucipality_id)

				->group_by('town.id')
				->order_by('town.name');
		return $this->db->get()->result();
		//var_dump($this->db->get()->result());
	}
	/**
	 * [getTowns description]
	 * @return [type] [verify the assigned town of each suburb]
	 */
	public function getTowns()
	{
		$this->db->select("town.id,town.name,town.zip_code,manucipality_id")
		->from("town")

		        ->join("suburb","suburb.town_id = town.id")
				->join("address"," address.suburb_id = suburb.id")
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id");
		//->where("manucipality_id",$manucipality_id);

		return $this->db->get()->result();
		//var_dump($this->db->get()->result());
	}
	public function check_town(){}

}

?>
