<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manucipality_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function getManucipalities()
	{
		$this->db->select("manucipality.id,manucipality.name,district_id")
		->from("manucipality");

		//return $this->db->get()->result();
		//var_dump($this->db->get()->result());
	}
	public function getManucipality()
	{
		$this->db->select("manucipality.id,manucipality.name,district_id")
		->from("manucipality");
		//->where("manucipality_id",$manucipality_id);

		return $this->db->get()->result();
		//var_dump($this->db->get()->result());
	}
	public function callback_checkManucipality($manucipality_id){
		$this->db->select("manucipality.id")
		->from("manucipality")
		->where("id",$manucipality_id);
		if($this->db->get()->row()){
			return TRUE;
		}else {
			return FALSE;
		}
	}
}

?>
