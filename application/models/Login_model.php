<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function query($search){
		return $this->db->select("user.name,user.id,user.email,user.phone,user.identitynumber,role.id as roleid,role.role,login.id as loginid,login.password,
			GROUP_CONCAT(user.name) as author")
		->from("user")
		->join("login","login.user_id = user.id")
		->join("login","login.role_id = role.id")
		->join("tokens","tokens.login_id =login.id")	

		->group_by('user.id')
		->order_by('user.id');

	}
	public function getUser(array $search = array(),int $limit = ITEMS_PER_PAGE){
//public function getAddress(){
	//where to start bringing the rows for the pagination 
		$offset = $search['page'] ?? 0;
//call the query to bring the residence
		$this->Query($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
		->limit($limit,$offset);
			//get data from bd
		return $this->db->get()->result() ;
	}



	public function callback_checkEmail($email){
		$user_id = $this->input->post('user_id');
		$this->db->select("user.email")
		->from("user")
		->where("id",$user_id);
		$testemail=$this->db->get()->row();
		if ($testemail->email != $email) {
			return false;
		}else{
			return true;

		} 

	}public function callback_checkPhone($phone){
		$user_id = $this->input->post('user_id');
		$this->db->select("user.phone,")
		->from("user")
		->where("id",$user_id);
		$testphone=$this->db->get()->row();
		if ($testphone->phone != $phone) {
			return false;
		}else{
			return true;

		} 

	}public function callback_checkIdnumber($identitynumber){
	//var_dump($this->input->post('user_id'));
		$user_id = $this->input->post('user_id');
		$this->db->select("user.identitynumber,user.phone")
		->from("user")
		->where("user.id",$user_id);
		     	     //var_dump($this->db->get()->row() );
		$identity=$this->db->get()->row();
		//var_dump($identity);
		//foreach ($identity as $value) {
			if ($identity->identitynumber != $identitynumber) {
				//var_dump($value->identitynumber );
				return false;
			}
			else{
				return true;

			//} 


		}

	}
}
?>