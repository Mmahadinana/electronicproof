<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_MODEL{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

public function booksquery($search){
	return $this->db->select(", GROUP_CONCAT(aut.name) as author")
	->from("user")
	->join("","editor.id = books.id_editor")
	->join("book_authors as autbook","autbook.id_book = books.id")
	->join("authors as aut","aut.id = autbook.id_author")
	->group_by('books.id')
	->order_by('books.id');

}

}
?>