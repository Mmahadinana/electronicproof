<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Register_model extends CI_MODEL
{


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/**
	 * [createUser description]
	 * @param  [false] $data [ot retrieved the information that is need form the database]
	 * @return [true]       [when the owner createUser]
	 */
	public function createUser($data)
	{

		$muni = array(

			
		        //'manufactures'=>$data['manufactures'],
			'manucipality_id'=>$data['manucipality'],
			'district_id'=>$data['district'],
			'province_id'=>$data['province_id'],
			);
		$this->db->trans_start();
		$this->db->insert("user",$muni);
		//$car_id = $this->db->insert_id();
	 //$this->addVehicle_manufacturer($id_vehicle,$data['manufactures']);
		return $this->db->trans_complete();

	}
	/**
	 * [addUser_models description]
	 * @param [true] $user_id        [retrieve the information that is need from the database]
	 * @param array  $manucipalities [addUser_models]
	 */
	public function addUser_models($user_id,$manucipalities=array())
	{
		$batch=array();	
		foreach ($manucipalities as $manucipality_id)
		{
			$batch[] = array(
				'user_id'=>$user_id,
				'manucipality_id'=>$manucipality_id);
			
		}
		return	$this->db->insert_batch('user_model',$batch);
	}
}
