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
	 * [getSuburb description]
	 * @param  integer $manucipality_id [description]
	 * @return [true]                   [getSuburb for all the manucipality]
	 */
	public function getSuburb($manucipality_id=0)
	{

		$this->db->select("suburb.id,suburb.name,suburb.town_id,town.zip_code")
		->from("suburb")
		->join("town","town.id = suburb.town_id")
		->where("town_id",$manucipality_id);
		return $this->db->get()->result();
		
	}
	/**
	 * [getSuburbs description]
	 * @return [type] [verify the assigned suburb of the user]
	 */
	public function getSuburbs()
	{
		$this->db->select("suburb.id,suburb.name,suburb.town_id")
		->from("suburb");
		return $this->db->get()->result();
	}
	
	
}

?>
