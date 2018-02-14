<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District_model extends CI_MODEL
{
	/**
	 * [__construct the data of the district of each user]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/**
	 * [getDistrict retrieves the list of province]
	 * @param  integer $search [data of each district on each user and municipalities]
	 * @return [true]          [and shows the districts in each municipalities]
	 */
	public function getDistrict($search=0)
	{		

		$this->db->select("district.id,district.name,province_id")
			        ->from("district")	
			        ->join("province","province.id = district.province_id")
			        ->join("manucipality"," manucipality.district_id =district.id")	
			        ->join("town","town.manucipality_id =manucipality.id ")
			        ->join("suburb","suburb.town_id = town.id")
					->join("address"," address.suburb_id = suburb.id")
					->join("property","property.address_id =address.id ")
					->join("owners_property","owners_property.property_id = property.id")
					//->join("owners_property","owners_property.owners_id = owners.id") 
			        					
					
			        ->where('province_id',$search)

			        ->group_by('district.id')
					->order_by('district.name');
			       return $this->db->get()->result();
	}

	/**
	 * [getDistricts list of all districts]
	 * @param  array  $search_district [description]
	 * @return [type]                  [description]
	 */
	public function getDistricts($search_district=array())
	{
		
		$district_id =$search_district['district'] ?? false;
		$province_id =$search_district['province'] ?? false;

		//check if the district id exists
		if ($district_id) {
			$this->db->where('district.id',$district_id)
						->where('district.province_id',$province_id);
		}

		$this->db->select("district.id,district.name,province_id")
			        ->from("district")
			        ->join("province","province.id = district.province_id")
			        ->join("manucipality"," manucipality.district_id =district.id")	
			        ->join("town","town.manucipality_id =manucipality.id ")
			        ->join("suburb","suburb.town_id = town.id")
					->join("address"," address.suburb_id = suburb.id")
					->join("property","property.address_id =address.id ")
					->join("owners_property","owners_property.property_id = property.id") ;
			         //->where('province_id',$search);
			       return $this->db->get()->result();
	}
	/**
	 * [check_district if the input is valid]
	 * @return [type] [description]
	 */
	public function check_district()
	{	
		$search['district']=$this->input->post('district');		
		$search['province']=$this->input->post('province');		

		 if ($search['district'] ==0) {
		 	//return false if field is empty
			return false;
		}
		$data=$this->getDistricts($search);
		
				//return false if data is empty
			return	$retVal = (empty($data)) ? false: true;
		}
	
}
?>