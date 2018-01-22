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