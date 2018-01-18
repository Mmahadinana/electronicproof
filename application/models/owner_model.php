<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner_model extends CI_MODEL
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
	public function getOwner()
{
	$this->db->select("owners.id,owners.title_deed,owners.registration_number,owners.registration_date,owners.house_type
			")
		         ->from("owners");
		       return $this->db->get()->result();
}

}


?>