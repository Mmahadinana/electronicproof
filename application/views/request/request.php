 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



  <div class='container'>
  	
  
      <?php

  if (isset($statusInsert)) {
   echo alertMsg($statusInsert,' Your request was made','You have already made a request for this address');
 }

?></div><?php
 $this->load->view('request/requestform');


 //$this->load->view($pageToLoad);

 
?>
