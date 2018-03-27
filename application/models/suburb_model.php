<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suburb_model extends CI_MODEL
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	* [getSuburb in a specific town]
	 * @param  integer $town_id [description]
	 * @return [type]           [description]
	 */
	public function getSuburb($town_id=0)
	{

		$this->db->select("suburb.id,suburb.name,suburb.town_id,town.zip_code")
		->from("suburb")
		->join("town","town.id = suburb.town_id")		        
				->join("address"," address.suburb_id = suburb.id")
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id")

				->where("town_id",$town_id)
				
				->group_by('suburb.id')
				->order_by('suburb.name');
		return $this->db->get()->result();
		
	}

	/**
	 * [getSuburbs list of all suburbs]
	 * @param  array  $searchSuburb [description]
	 * @return [type]               [description]
	 */
	public function getSuburbs($searchSuburb=array())
	{
		$suburb_id= isset($searchSuburb['suburb'])? $searchSuburb['suburb'] : false;
		$town_id= isset($searchSuburb['town'])? $searchSuburb['town'] : false;
		if ($suburb_id) {
			$this->db->where('suburb.id',$suburb_id)
					->where('suburb.town_id',$town_id);
		}
		$this->db->select("suburb.id,suburb.name,suburb.town_id")
		->from("suburb")	        
				->join("address"," address.suburb_id = suburb.id")
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id");
		return $this->db->get()->result();
	}

	/**
	 * [check_surburb if it a valid input]
	 * @return [type] [description]
	 */
	public function check_surburb(){
		$searchSuburb['suburb']=$this->input->post('suburb');
		$searchSuburb['town']=$this->input->post('town');
		 if ($searchSuburb['suburb'] ==0) {
		 	//return false if field is empty
			return false;
		}
		$data=$this->getSuburbs($searchSuburb);
		
			//return false if data is empty
			return	$retVal = (empty($data)) ? false: true;
		}
	
}

?>
