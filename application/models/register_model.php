<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Register_model extends CI_MODEL{


		public function __construct(){
		parent::__construct();
		$this->load->database();
	}


public function createUser($data){

		$car = array(

		       
		        //'manufactures'=>$data['manufactures'],
		        'manucipality_id'=>$data['manucipality'],
		        'district_id'=>$data['district'],
		         'province_plate'=>$data['province_plate'],
		          );
		  $this->db->trans_start();
		$this->db->insert("user",$car);
		//$car_id = $this->db->insert_id();
	 //$this->addVehicle_manufacturer($id_vehicle,$data['manufactures']);
		return $this->db->trans_complete();

	}

	public function addUser_models($user_id,$manucipalities=array()){
      $batch=array();	
	foreach ($manucipalities as $manucipality_id) {
			$batch[] = array(
						'user_id'=>$user_id,
						'manucipality_id'=>$manucipality_id);
		
		}
      return	$this->db->insert_batch('user_model',$batch);
	}
}
