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
	 * [getTown in a specific municipality]
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
		
	}

	/**
	 * [getTowns list of all towns]
	 * @param  array  $searchTown [description]
	 * @return [type]             [description]
	 */
	public function getTowns($searchTown=array())
	{
		$town_id= isset($searchTown['town'] )? $searchTown['town'] :false;
		$municipality_id= isset($searchTown['municipality'])? $searchTown['municipality'] : false;
		if ($town_id) {
			$this->db->where('town.id',$town_id)
					->where('town.manucipality_id',$municipality_id);
		}
		$this->db->select("town.id,town.name,town.zip_code,manucipality_id")
		->from("town")

		        ->join("suburb","suburb.town_id = town.id")
				->join("address"," address.suburb_id = suburb.id")
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id");	

		return $this->db->get()->result();		
	}

	/**
	 * [check_town if the input is valid]
	 * @return [type] [description]
	 */
	public function check_town(){
		$searchTown['town']=$this->input->post('town');
		$searchTown['municipality']=$this->input->post('manucipality');
		 if ($searchTown['town'] ==0) {
		 	//return false if field is empty
			return false;
		}
		$data=$this->getTowns($searchTown);		
		//return false if data is empty
			return	$retVal = (empty($data)) ? false: true;
		}
}

?>
