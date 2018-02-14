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
	 * [getProvince list all provinces]
	 * @param  integer $province [description]
	 * @return [type]            [description]
	 */
		public function getProvince($province =0)
	{
		$province_id =$province ?? false;
		if ($province_id) {
			$this->db->where('province.id',$province_id);
		}
		$this->db->select("province.id,province.name")
			         ->from("province");
			       return $this->db->get()->result();
	}
	/**
	 * [check_province if the inpu is valid]
	 * @param  [type] $province [description]
	 * @return [type]           [description]
	 */
	public function check_province(){
		$province=$this->input->post('province');
	
		$data=$this->getProvince($province);
	return	$retVal = (empty($data)) ? false: true;
		/*foreach ($this->getProvince() as $value) {
			
		}*/

	}

}


?>