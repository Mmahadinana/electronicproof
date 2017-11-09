<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Register_model extends CI_MODEL{


		public function __construct(){
		parent::__construct();
		$this->load->database();
	}


public function getUser(array $search=array(),int $limit=ITEMS_PER_PAGE)
	{
		
		$offset=$search['page'] ?? 0;
		$this->carQuery($search)
		->limit($limit,$offset);
		return $this->db->get()->result();

	}
	public function createUser($data){

		$res = array(

		       
		        //'manufactures'=>$data['manufactures'],
		        'manucipality_id'=>$data['manucipality'],
		        'district_id'=>$data['district'],
		         'province'=>$data['province'],
		          );
		  $this->db->trans_start();
		$this->db->insert("user",$res);
		//$car_id = $this->db->insert_id();
	 //$this->addVehicle_manufacturer($id_vehicle,$data['manufactures']);
		return $this->db->trans_complete();

	}
	public function addUser_models($user_id,$models=array()){
      $batch=array();	
	foreach ($manucipalities as $manucipalities_id) {
			$batch[] = array(
						'user_id'=>$user_id,
						'manucipality_id'=>$manucipalities_id);
		
		}
      return	$this->db->insert_batch('user_model',$batch);
	}

}
