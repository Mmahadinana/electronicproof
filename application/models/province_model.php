<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province_model extends CI_MODEL{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function getProvince()
{
	$this->db->select("province.id,province.name")
		         ->from("province");
		       return $this->db->get()->result();
}

		public function callback_checkModel($province_id){
		$this->db->select("province.id")
		->from("province")
		->where("id",$province_id);
		if($this->db->get()->row()){
			return TRUE;
		}else {
			return FALSE;
		}
	}
}


?>