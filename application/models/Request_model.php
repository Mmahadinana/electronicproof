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
->select("user.id,user.name,role.role as role,
		owners.user_id,property.id as property,property.address,property.suburb,
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
public function addIdUpload($data){
	//var_dump($data);
$requests = array(
		     		'original_name'=>$data['file_name'],
		     		'file_path'=>$data['full_path'],
		     		'original_name'=>$data['client_name'],
		     		'url'=>$data['file_path'],
		     		'newname'=>$data['raw_name'],
		     		);
		     	$this->db->trans_start();
		     	$this->db->insert("attachments",$requests);
		     	$attachments_id = $this->db->insert_id();
		     	return $this->db->trans_complete();
 
 
}




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
 public function callback_file_upload(){

$newName="";
$prevName="";
//$prevName=$_FILES['picture']['name'];
$uploads_dir= 'uploads/';   
$filesCount = count($_FILES['idUpload']['name']);
$filesCounter = 0;
 //check if there is files uploaded                         
 if(!empty($_FILES) && $_FILES['idUpload']['name'][0]){
    foreach ( $_FILES['idUpload']['name'] as $key => $value) {
      // copies the loaded file to the uploads
        $info = pathinfo($_FILES['idUpload']['name'][$key]); 
        $prevName= $info['basename'];
       //returns the file extension 
       if(isset($info['extension'] ) && $info['extension']){
          $ext = $info['extension']; 
       }else{
        $ext = "";
       }
       if(($ext == 'jpg') or ($ext == 'png') or ($ext == 'pdf')){
         do{
          //generates a random name with the uniquid function
          $new_random_file_name = uniqid(); 
          //writes the new name an the file extension
          $newName = $new_random_file_name.'.'.$ext;
          //Checks whether a file or directory exists
        }while(file_exists('uploads_dir/$newName'));
//Moves an uploaded file from a temporary location to a new location
        move_uploaded_file($_FILES['idUpload']['tmp_name'][$key],"$uploads_dir/$newName");
        //hasfile turn to true 
        $hasfiles=1;
        $filepath=$uploads_dir."/".$newName;      
        
      }
      
         $filesCounter++;
    }*/
    /*if ($filesCounter==$filesCount){
     
      $error[5] = false;
    }else{
   $error[5] = true;
       }
}else{
   $error[5] = false;
       }*/
 /*public function do_upload(){

$config =array(
'allowed_types' => 'pdf|jpg|png|jpeg',
'upload_path'  => $this->file_uploadpath
);

$this->load->library('upload', $config);
$this->upload->do_upload();
$id_upload =$this->upload->data();

}*/
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

}

}
?>
