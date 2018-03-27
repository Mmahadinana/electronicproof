<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//This model is used to send the message
class Messages_model extends CI_MODEL
{


		public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/**
	 * [getMessages used to send the messages]
	 * @param  [true] $data [hold the data of the message and stores it to the database]
	 * @return [true]       [This function holds the specified data of the user.]
	 */
	 public function newMessages($data, $user_id=0)
		{
		  $message=array(
		  	'name'	 => $data['name'],
		    'email'  => $data['email'],
		    'message'=>$data['message'],
		    'phone'  =>$data['phone'],
		);
		      
		$this->db->trans_start();
		$this->db->insert("message",$message);

		return $this->db->trans_complete();
	}

	/**
	 * [insertComment description]
	 * @param  array   $data    [description]
	 * @param  integer $user_id [description]
	 * @return [type]           [description]
	 */
	public function insertComment($data=array(),$user_id= 0)	{
	
		$this->db->trans_start();
		$this->db->insert('comments',array("subjects"=>$data["subjects"],"comments"=>$data["comments"],"type"=>$data["type"]));

		$comm_id=$this->db->insert_id();
		
		if ($data['type']==3) {
			
			$getAdmi=$this->getUser();
			foreach ($getAdmi as $value) {
				
				if ($value->roleid==1) {
					$user_id=$value->id;
				}				
			}
		}
		$this->insertUser_Has_Comments($comm_id,$user_id);
	return $this->db->trans_complete();

	}

	/**
	 * [getUser for the admin id ]
	 * @return [type] [description]
	 */
	public function getUser(){
								
				$this->db->select("user.name,user.id,user.email,user.phone,user.identitynumber,role.id as roleid,role.role,login.id as loginid,login.password")
						->from("user")
						->join("login","login.user_id = user.id")
						->join("role","role.id = login.role_id")
		
				->order_by('user.id');
		return $this->db->get()->result() ;
	}
	
	/**
	 * [insertUser_Has_Comments description]
	 * @param  integer $comm_id [description]
	 * @param  integer $user_id [description]
	 * @return [type]           [description]
	 */
	public function insertUser_Has_Comments($comm_id=0,$user_id=0){

		$this->db->insert("user_has_comments",array("user_id"=>$user_id,"comments_id"=>$comm_id));	
	}
}
?>