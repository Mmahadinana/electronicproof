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
 * [getMessages description]
 * @param  [true] $data [description]
 * This function holds the specified data of the user.
 * @return [false]       [getMessages]
 */
 public function getMessages($data)
	{
		  $message=array(
		  	'name' => $data['name'],
		    'email' => $data['email'],
		    'message' =>$data['message'],
		     'phone' =>$data['phone'],
		);
		      
		  $this->db->trans_start();
	$this->db->insert("message",$message);
		$message_id = $this->db->insert_id();
		return $this->db->trans_complete();
	}
}
?>