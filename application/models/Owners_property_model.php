<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 //This model hold the information of the owner's property
class Owners_property_model extends CI_MODEL
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
		
	}
//This function holds the request query of the owners details
	public function getOwnerquery($search )
	{
	
		//$pOwner = $search['$pOwner'] ?? FALSE;
		$property_id = isset($search['property_id'])? $search['property_id']: FALSE;
		$user_id = isset($search['user_id'])? $search['user_id'] : FALSE;
		//comes from listofresidents view to delete owner
		if($property_id)
		{
			$this->db->where('owners_property.property_id',$property_id )
					->where('owners.user_id',$user_id );
		}
	/*if($user_id)
{
		$this->db->where('owners_property.user_id',$user_id );
	}*/
	/*if($pOwner)
	{
		$this->db->where('owners_property.property_id',$pOwner );
	}*/
	return $this->db
	->select("user.id,user.name,user.identitynumber,
		owners.user_id,owners.id as owner_id,property.id as property,property.address_id,
		town.name as town,town.zip_code,
		manucipality.name as manucipality,
		district.name as district,
		province.name as province ")
	->from("user")
	->join("owners","owners.user_id = user.id")
	->join("owners_property","owners_property.owners_id = owners.id")
	->join("property"," property.id= owners_property.property_id")
	->join("address"," address.id= property.address_id")
	->join("suburb"," suburb.id= address.suburb_id")
	//->join("property"," property.id= owners_property.property_id")
	->join("town","town.id = suburb.town_id")
	->join("manucipality","manucipality.id = town.manucipality_id")
	->join("district","district.id = manucipality.district_id")
	->join("province","province.id = district.province_id")
	->where("owners_property.deleted",0)
	
	//->group_by('user.id')
	->order_by('user.id');

}
//This query holds the data for the property
public function propertyquery($search )
{
//var_dump($search);
		$user_idprofile = isset($search['user_idprofile'])? $search['user_idprofile'] :  FALSE; 
		$user_id = isset($search['user_id'])? $search['user_id'] :  FALSE; 
		$mysearch = isset($search['mysearch'])? $search['mysearch'] :  FALSE; 

		if($user_idprofile)
		{
			$this->db->where('lives_on.user_id',$user_idprofile)
						->where('lives_on.deleted',0);	 
		}
		if($user_id)
		{
			$this->db->where('lives_on.user_id',$user_id)
					->where('lives_on.deleted',0); 
		}
		if($mysearch && $user_id)
		{
			$this->db->where('lives_on.user_id',$user_id)
					->where('address.door_number',$mysearch); 
		}
		return $this->db
		->select("user.id,user.name,user.identitynumber,
			role.role,role.id as roleid,
			login.id as login id,
			lives_on.primary_prop,		
			property.id as property,property.address_id,
			address.id as addressid, address.door_number, address.street_name, address.suburb_id,
			suburb.id as suburb,suburb.name as suburbname,suburb.town_id,
			town.name as town,town.zip_code,
			manucipality.name as manucipality,
			district.name as district,
			province.name as province ")
		->from("user")
		->join("gender","gender.id = user.gender_id")
		->join("login"," login.user_id = user.id ")
		->join("role"," role.id = login.role_id ")
		->join("lives_on","lives_on.user_id = user.id")		
		->join("property"," property.id= lives_on.property_id")
		->join("address"," address.id= property.address_id")
		->join("suburb"," suburb.id = address.suburb_id")
		->join("town","town.id = suburb.town_id")
		->join("manucipality","manucipality.id = town.manucipality_id")
		->join("district","district.id = manucipality.district_id")
		->join("province","province.id = district.province_id")

		->order_by('lives_on.primary_prop','DESC')
		->order_by('lives_on.property_id','ASC');

		

	}
	//This function gets the information for the owners details.
public function getOwner( $search = array(), $limit = ITEMS_PER_PAGE)
{
//public function getAddress(){
	//where to start bringing the rows for the pagination
	$offset = isset($search['page'])? $search['page'] : 0;
//call the query to bring the residence
	$this->getOwnerquery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result() ;
}
/**
 * this function is where the owner getProperty
 */
public function getProperty($search = array(),$limit = ITEMS_PER_PAGE)
{

	//where to start bringing the rows for the pagination
	$offset = isset($search['page'])? $search['page'] : 0;
//call the query to bring the residence
	$this->propertyquery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
		
	return $this->db->get()->result() ;
}
public function deleteOwner($search=array()){
	$owner_id=0;
	//if (!empty($search) ) {
		$owner=$this->getOwner($search);
		
		if(!empty($owner)){
			foreach ($owner as $value) {
			$owner_id=$value->owner_id;
			
		}
		$this->db->trans_start();
		$this->db->where("owners_id",$owner_id)
				->where("property_id",$search['property_id'])
				->update("owners_property",array("deleted"=>1,"delete_date"=>date('Y-m-d H:s:m')));
		return $this->db->trans_complete()	;
		}
	//}
}
}