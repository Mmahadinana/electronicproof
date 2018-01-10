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
		->where("manucipality_id",$manucipality_id);

		return $this->db->get()->result();
		//var_dump($this->db->get()->result());
	}
	public function getTowns()
	{
		$this->db->select("town.id,town.name,town.zip_code,manucipality_id")
		->from("town");
		//->where("manucipality_id",$manucipality_id);

		return $this->db->get()->result();
		//var_dump($this->db->get()->result());
	}
	
}

?>
