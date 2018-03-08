<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getAddressPropertyIsNullQuery($search=array()){

		$province=$search['province_id'] ?? FALSE;
		$district=$search['district'] ?? FALSE;
		$municipality=$search['municipality'] ?? FALSE;
		$town=$search['town'] ?? FALSE;
		$suburb=$search['suburb'] ?? FALSE;
		$suburb_id=$search['suburb_id'] ?? FALSE;
		$address_id=$search['address_id'] ?? FALSE;

		if($province)
		{	
			$this->db->where('province.id',$province);
			 
		}if($district)
		{	$where='(district.name LIKE "%'.$district.'%")';
				$this->db->where($where);
			 
		}if($municipality)
		{	$where='(manucipality.name LIKE "%'.$municipality.'%")';
				$this->db->where($where);
			 
		}if($town)
		{	$where='(town.name LIKE "%'.$town.'%")';
				$this->db->where($where);
			 
		}if($suburb)
		{	$where='(suburb.name LIKE "%'.$suburb.'%")';
				$this->db->where($where);
				//->where_not_in("address.id",$address_id)
			 
		}if($suburb_id)
		{	//$where='(address.suburb_id LIKE "%'..'%")';
				$this->db->where('address.suburb_id',$suburb_id)
						->where("address.id",$address_id);
			 
		}

		return $this->db->select("address.id,address.door_number,address.street_name,address.suburb_id,
				suburb.name as suburb,suburb.id as suburb_id,
				town.name as town,
				manucipality.name as municipality,manucipality.id as municipality_id,
				district.name as district,
				province.name as province,province.id as province_id")
				->from("address")			
		
				
				->join("suburb","suburb.id = address.suburb_id")
				->join("town","town.id = suburb.town_id")
				->join("manucipality","manucipality.id = town.manucipality_id")
				->join("district","district.id= manucipality.district_id")
				->join("province","province.id = district.province_id")
				
				
				->group_by('province.id')
				//->group_by('province.id')
				->order_by('province.name');
	}
	/**
	 * [getProperty description]
	 * @return [type] [description]
	 */
	public function getProperty($search = array())
	{	
		$address_id=$search['address_id'] ?? FALSE;
		if($address_id)
		{	
			$this->db->where('address_id',$address_id);
			 
		}
		$this->db->select("property.address_id")
				->from("property")
				->join("address","address.id=property.address_id");
					
					
		return $this->db->get()->result();
	}
	public function getAddress($search = array())
	{	
		$suburb_id=$search['suburb_id'] ?? FALSE;
		if($suburb_id)
		{	
			$this->db->where('suburb_id',$suburb_id);
			 
		}

		$this->db->select("id")
				->from("address");
				//->where("suburb_id",$search['suburb_id'])	
					
		return $this->db->get()->result();
	}
	/**
	 * [getAddressPropertyIsNull description]
	 * @param  array       $search [description]
	 * @param  int|integer $limit  [description]
	 * @return [type]              [description]
	 */
	public function getAddressPropertyIsNull(array $search = array(),int $limit = 50)
	{
		$offset = $search['page'] ?? 0;

		$this->getAddressPropertyIsNullQuery($search)		
				->limit($limit,$offset);
		return $this->db->get()->result();		
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