<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manucipality_model extends CI_MODEL
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * [getManucipality retrieves the list of manucipalities]
	 * @param  integer $manucipality_id [description]
	 * @return [type]                   [description]
	 */
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
	 * @param  array  $searchMuni [description]
	 * @return [type]             [description]
	 */
	public function getManucipalities($searchMuni=array())
	{
		$municipality_id=isset($searchMuni['manucipality'] )? $searchMuni['manucipality']  :false;
		$district_id=isset($searchMuni['district'])? $searchMuni['district'] : false;
		if ($municipality_id) {
			$this->db->where('manucipality.id',$municipality_id)
					->where('manucipality.district_id',$district_id);
		}
		$this->db->select("manucipality.id,manucipality.name,district_id")
		->from("manucipality")
		->join("town","town.manucipality_id =manucipality.id ")
		        ->join("suburb","suburb.town_id = town.id")
				->join("address"," address.suburb_id = suburb.id")
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id");
		
		return $this->db->get()->result();
		
	}
	/**
	 * [check_municipality
	 * ]
	 * @return [type] [description]
	 */
	public function check_municipality(){
		$searchMuni['manucipality']=$this->input->post('manucipality');
		$searchMuni['district']=$this->input->post('district');
		 if ($searchMuni['manucipality'] ==0) {
		 	//return false if field is empty
			return false;
		}
		$data=$this->getManucipalities($searchMuni);
		
			//return false if data is empty
			return	$retVal = (empty($data)) ? false: true;
		}	

	}

?>
