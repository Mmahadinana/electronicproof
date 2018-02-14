<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/**
	 * [getProvince description]
	 * @return [true] [correct provinces information]
	 */
		public function getProvince()
	{
		$this->db->select("province.id,province.name")
			         ->from("province");
			       return $this->db->get()->result();
	}
	public function check_province($province){
		

	}

}


?>