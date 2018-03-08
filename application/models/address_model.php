<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getAddressPropertyIsNullQuery($search=array()){

		$province=$search['province_id'] ?? FALSE;
		$district=$search['district'] ?? FALSE;
		$municipality=$search['municipality'] ?? FALSE;
		$town=$search['town'] ?? FALSE;
		$suburb=$search['suburb'] ?? FALSE;
		$address=$search['address'] ?? FALSE;

		if($province)
		{	
			$this->db->where('province.id',$province);
			 
		}if($district)
		{	$where='(district.name LIKE "%'.$district.'%")';
				$this->db->where($where);
			 
		}if($municipality)
		{	$where='(municipality.name LIKE "%'.$municipality.'%")';
				$this->db->where($where);
			 
		}if($town)
		{	$where='(town.name LIKE "%'.$town.'%")';
				$this->db->where($where);
			 
		}if($suburb)
		{	$where='(suburb.name LIKE "%'.$suburb.'%")';
				$this->db->where($where);
			 
		}if($address)
		{	$where='(address.name LIKE "%'.$address.'%")';
				$this->db->where($where);
			 
		}

		return $this->db->select("address.id,address.door_number,address.street_name,address.suburb_id,
			suburb.name as suburb,
			town.name as town,
			manucipality.name as municipality,
			district.name as district,
			province.name as province,province.id as province_id")
		->from("address")				
				->join("property","property.address_id != address.id ")
				->join("owners_property","owners_property.property_id = property.id")
				->join("suburb","suburb.id = address.suburb_id")
				->join("town","town.id = suburb.town_id")
				->join("manucipality","manucipality.id = town.manucipality_id")
				->join("district","district.id= manucipality.district_id")
				->join("province","province.id = district.province_id")

				->group_by('address.id')
				->order_by('address.street_name');
	}

	/**
	 * [getAddress in a specific suburb]
	 * @param  integer $suburb_id [description]
	 * @return [type]             [description]
	 */
	public function getAddress($suburb_id=0)
	{

		$this->db->select("address.id,address.door_number,address.street_name,address.suburb_id")
		->from("address")				
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id")
				->where("suburb_id",$suburb_id)

				->group_by('address.id')
				->order_by('address.street_name');
		return $this->db->get()->result();
		
	}

	/**
	 * [getAddresses all addresses]
	 * @param  array  $searchAddress [description]
	 * @return [type]                [description]
	 */
	public function getAddresses($searchAddress=array())
	{
		$street_name=$searchAddress['id'] ?? false;
		$door_number=$searchAddress['id'] ?? false;
		$suburb_id=$searchAddress['suburb'] ?? false;
		if ($street_name) {
			$this->db->where('address.id',$street_name)
					->where('address.suburb_id',$suburb_id);
		}if ($street_name) {
			$this->db->where('address.id',$door_number)
					->where('address.suburb_id',$suburb_id);
		}

		$this->db->select("address.id,address.door_number,address.street_name")
		->from("address")
			       
				->join("property","property.address_id =address.id ")
				->join("owners_property","owners_property.property_id = property.id");
		
		return $this->db->get()->result();
		
	}
	public function getAddressPropertyIsNull(array $search = array(),int $limit = ITEMS_PER_PAGE)
	{
		$offset = $search['page'] ?? 0;

		$this->getAddressPropertyIsNullQuery($search)		
				->limit($limit,$offset);
		return $this->db->get()->result();
		
	}

	/**
	 * [check_streetname if it is a valid input]
	 * @param  [type] $street_name [description]
	 * @return [type]              [description]
	 */
	public function check_streetname($street_name){
		$searchAddress['id']=$this->input->post('street_name');
		$searchAddress['suburb']=$this->input->post('suburb');

		if ($searchAddress['id'] ==0) {
			//return false if field is empty
			return false;
		}
		$data=$this->getAddresses($searchAddress);

		//return false if data is empty
		return	$retVal = (empty($data)) ? false: true;
	}

	/**
	 * [check_doornumber if it is valid input]
	 * @param  [type] $door_number [description]
	 * @return [type]              [description]
	 */
	public function check_doornumber($door_number){
		$searchAddress['id']=$this->input->post('door_number');
		$searchAddress['suburb']=$this->input->post('suburb');
		if ($searchAddress['id'] ==0) {
			//return false if field is empty
			return false;
		}
		$data=$this->getAddresses($searchAddress);

		//return false if data is empty
		return	$retVal = (empty($data)) ? false: true;
	}

	public function newproperty($data=array()){
		
		$this->db->select("property.address_id")
				->from("property")
				->where("address_id",$data['add_check']);
		$results=$this->db->get()->result();
		$data['date']=date('Y-m-d H:i:s');
		if(!empty($results)){
			return false;
		}
		elseif(!empty($data)){
			$this->db->trans_start();
			$this->db->insert('property',array('address_id'=>$data['add_check'],'start_date'=>$data['date']));
			return $this->db->trans_complete();
		}
	}
	

}

?>
