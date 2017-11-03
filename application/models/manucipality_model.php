<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manucipality_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
}

?>
