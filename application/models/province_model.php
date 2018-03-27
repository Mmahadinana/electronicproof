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

		$province=isset($search['province_id'])? $search['province_id'] : FALSE;
		$district=isset($search['district'])? $search['district'] : FALSE;
		$municipality=isset($search['municipality'])? $search['municipality'] : FALSE;
		$town=isset($search['town'])? $search['town'] : FALSE;
		$suburb=isset($search['suburb'])? $search['suburb'] : FALSE;
		$suburb_id=isset($search['suburb_id'])? $search['suburb_id'] : FALSE;
		$address_id=isset($search['address_id'])? $search['address_id'] : FALSE;

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
				$this->db->where($where)
				->where("address.id",$address_id);
			 
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
				->order_by('address.street_name');
	}

	/**
	 * [getProperty description]
	 * @return [type] [description]
	 */
	public function getProperty($search = array())
	{	
		$address_id=isset($search['address_id'])? $search['address_id'] : FALSE;
		if($address_id)
		{	
			$this->db->where('address_id',$address_id);
			 
		}
		$this->db->select("property.address_id")
				->from("property")
				->join("address","address.id=property.address_id");
					
					
		return $this->db->get()->result();
	}

	/**
	 * [getAddress description]
	 * @param  array  $search [description]
	 * @return [type]         [description]
	 */
	public function getAddress($search = array())
	{	
		$suburb_id=isset($search['suburb_id'])? $search['suburb_id'] : FALSE;
		$suburb=isset($search['suburb'])? $search['suburb'] : FALSE;
		if($suburb)
		{	$where='(suburb.name LIKE "%'.$suburb.'%")';
				$this->db->where($where);
		
		}
		if($suburb_id)
		{	
			$this->db->where('suburb_id',$suburb_id);
			 
		}

		$this->db->select("address.id")
				->from("address")

				->join("suburb","suburb.id = address.suburb_id")
				->join("town","town.id = suburb.town_id")
				->join("manucipality","manucipality.id = town.manucipality_id")
				->join("district","district.id= manucipality.district_id")
				->join("province","province.id = district.province_id");
					
		return $this->db->get()->result();
	}

	/**
	 * [getAddressPropertyIsNull description]
	 * @param  array       $search [description]
	 * @param  int|integer $limit  [description]
	 * @return [type]              [description]
	 */
	public function getAddressPropertyIsNull($search = array(),$limit = 50)
	{
		$offset = isset($search['page'])? $search['page'] : 0;

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
		$province_id = isset($province)? $province : false;
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

	/**
	 * [filterSuburb description]
	 * @param  array  $search [description]
	 * @return [type]         [description]
	 */
	public function filterSuburb($search = array()){
		$address=$this->getAddress();
		$suburb_list=array();
		$i=0;
		foreach ($address as $value_ad) {
			$search['address_id']=$value_ad->id;
			$property_add=$this->getProperty($search);

			if (empty($property_add)) {

				$suburb=$this->getAddressPropertyIsNull($search);
				foreach ($suburb as $value) {
					if(!empty($value)){
						
					$suburb_list[$i]=$value;
					$i +=1;
				}
				}
				
			}
		}return $suburb_list;		
	}
}


?>