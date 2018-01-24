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
	 * [getDistrict description]
	 * @param  integer $search [data of each district on each user and municipalities]
	 * @return [true]          [and shows the districts in each municipalities]
	 */
	public function getDistrict($search=0)
{
	//var_dump($search);
	$this->db->select("district.id,district.name,province_id")
		         ->from("district")
		         ->where('province_id',$search);
		       return $this->db->get()->result();
}

/**
 * [getDistricts description]
 * @return [true] [This function retrieves the list of districts]
 */
public function getDistricts()
{
	
	$this->db->select("district.id,district.name,province_id")
		         ->from("district");
		         //->where('province_id',$search);
		       return $this->db->get()->result();
}


		
}
?>