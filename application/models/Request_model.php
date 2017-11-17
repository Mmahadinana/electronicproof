<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Request_model extends CI_MODEL{
var $file_uploadpath;
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('file','form','url'));

		$this->file_uploadpath=realpath(APPPATH . './id_upload');
		
	}

public function requestquery($search ){

$user_id = $search['user_id'] ?? FALSE;

if('$user_id'){
		$this->db->where('user.id','100');
	}
return $this->db
->select("user.id,user.name,user.identitynumber,role.role,role.id as roleid,
		owners.id as owner,owners.user_id,owners.house_type,property.id as property,property.address,property.suburb,
		town.name as town,town.zip_code,
		manucipality.name as manucipality,
		district.name as district,
		province.name as province ")
	->from("user")
	->join("gender","gender.id = user.gender_id")
	->join("login"," login.user_id = user.id ")
	->join("role"," role.id = login.role_id ")

	->join("owners","owners.user_id = user.id")
	->join("owners_property","owners_property.owners_id = owners.id")
	->join("property"," property.id= owners_property.property_id")
	->join("town","town.id = property.town_id")
	->join("manucipality","manucipality.id = town.manucipality_id")
	->join("district","district.id = manucipality.district_id")
	->join("province","province.id = district.province_id")
	
	->group_by('user.id')
	->order_by('user.id');

}



public function getAddress(array $search = array(),int $limit = ITEMS_PER_PAGE){
//public function getAddress(){
	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->requestquery($search)
	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result() ;
}
public function insertFileData($data){
	//var_dump($data);
$requests = array(
		     		'original_name'=>$data['file_name'],
		     		'file_path'=>$data['full_path'],
		     		'original_name'=>$data['client_name'],
		     		'url'=>$data['file_path'],
		     		'newname'=>$data['raw_name'],
		     		//'minetype'=>$minetype,
		     		);
		     	$this->db->trans_start();
		     	$this->db->insert("attachments",$requests);
		     	$attachments_id = $this->db->insert_id();
		     	return $this->db->trans_complete();
 
 
}
public function insertMultipleFileData($data){

foreach ($data as $value) {
	foreach ($value as $file) {
		
	}
	//$status = $this->addIdUpload($file);
	$this->insertFileData($file);

	/*if(!$status){

		 return $status;
	}*/
}
//return $status;

 
}

/*public function getOwner($search ){
//public function getAddress(){
	//where to start bringing the rows for the pagination
	$offset = $search['page'] ?? 0;
//call the query to bring the residence
	$this->requestquery()
		$this->db->where('user.id','100');

	//$this->requestquery();
		//establish the limit and start to bring the owner address
	->limit($limit,$offset);
			//get data from bd
	return $this->db->get()->result() ;
}
*/



/*public function makeRequest($data){
$this->checkResidentAddress($data);
$requests = array(
		     		'user_id'=>$data['user_id'],
		     		'property_id'=>$data['property_id'],
		     		'date_request'=>$data['date_request'],
		     		);
		     	$this->db->trans_start();
		     	$this->db->insert("books",$requests);
		     	$book_id = $this->db->insert_id();
		     	return $this->db->trans_complete();
 
 
}
public function checkResidentAddress($data){

 $requests=array( 	
 	"phone"=>$data["phone"];
 	"identitynumber"=>$data["idnumber"];
 	"email"=>$data["email"];
 	"id"=>$data["user_id"];
 );

 //$this->requestquery($requests);
 if($requests === requestquery($requests)){
 	$this->makeRequest();
 }
 }
 public function insertRequestFiles($data){

 $requests=array( 	
 	"phone"=>$data["phone"];
 	"identitynumber"=>$data["idnumber"];
 	"email"=>$data["email"];
 	"id"=>$data["user_id"];
 );

 //$this->requestquery($requests);
 if($requests === requestquery($requests)){
 	$this->makeRequest();
 }
 }
 
public function callback_checkFile($dir){
$result = array(); 	
$uploads_dir= 'C:\xampp';
$result = scandir($uploads_dir,1);
foreach ($result as $file) {
     $files[$file] = filemtime($uploads_dir . '/' . $file);	
}
arsort($result);
    $result = array_keys($result);

    return ($result) ? $result : false;

}*/


}
?>
