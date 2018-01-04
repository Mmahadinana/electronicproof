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
		->where("district_id",$manucipality_id);
		return $this->db->get()->result();
		
	}
	public function getManucipalities()
	{

		$this->db->select("manucipality.id,manucipality.name,district_id")
		->from("manucipality");
		//->where("district_id",$manucipality_id);
		return $this->db->get()->result();
		
	}
	
}

?>
