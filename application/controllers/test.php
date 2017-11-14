<?php 
$newName="";
$prevName="";
//$prevName=$_FILES['picture']['name'];
$uploads_dir= './uploads';   
$filesCount = count($_FILES['picture']['name']);
$filesCounter = 0;
 //check if there is files uploaded                         
 if(!empty($_FILES) && $_FILES['picture']['name'][0]){
    foreach ( $_FILES['picture']['name'] as $key => $value) {
      // copies the loaded file to the uploads
        $info = pathinfo($_FILES['picture']['name'][$key]); 
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
        move_uploaded_file($_FILES['picture']['tmp_name'][$key],"$uploads_dir/$newName");
        //hasfile turn to true 
        $hasfiles=1;
        $filepath=$uploads_dir."/".$newName;      
        
      }
      
         $filesCounter++;
    }
    if ($filesCounter==$filesCount){
     
      $error[5] = false;
    }else{
   $error[5] = true;
       }
}else{
   $error[5] = false;
       }
?>