<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?> 

<div class="container form-area">

  <?php
  //****************************************************** defining variables *///////////////////////////////////////////
  $property_id=0;
  $user_id=0;
  $owner_id=0;
  $getOwnerListToComfirm=array();

  ?>
  <h1 class="whtColor"> List Of Residents To Confirm </h1>
  <br>
  <?php
  
   if (isset($statusUpdate)) {
    echo alertMsg($statusUpdate,'Request confirmed','Sorry! you are not allowed to register on this property  <span class="glyphicon glyphicon-thumbs-down"></span>');
   
 }?>
  <h4><b><span class="text-danger"><?php 
  /*******getOwnerListToComfirmariable used to increament in the array index********/
  $i=0;
  foreach ($owner as $owner_val) {
    // storing the values of data that will be used to approve request by administrator
   // $property_id=$owner_val->property_id;
    $owner_id=$owner_val->id;
    $owners= $owner_val->name.', '; 
    foreach ($getListToComfirm as $user_val) {

      /********************condition for the list that should be printed***********************/
      if ($owner_val->property==$user_val->property_id ) {
        // storing the user data in the array
        $getOwnerListToComfirm[$i]=$user_val;
        $i +=1;
      }
    }

  } 
//*****************************************print name of owner*************************************************************/
    //echo $owners;
  ?></span><i>Confirm Request</b></i></h4>

  <!--*****************************************print name of owner*************************************************************/-->
  <table class="table">
    <tr class="danger text-warning">
      <th>Name</th>
      <th>Address</th>
      <th>Date</th>
      <th>Edit</th>
    </tr>

    <?php

 //*************print name of list of users that made requests for session owner*************************/   

    foreach ($getOwnerListToComfirm as $user) {

      $property_id=$user->property_id;
      $request_id=  $user->request_docs_id;    
      $user_id=  $user->user_id;    

      ?>


      <tr><td><?php echo $user->name; ?> </td>
        <td><?php echo $user->door_number.' '.$user->street_name; ?></td>
        <td><?php echo $user->date_request; ?></td>
        <td class='text-center'>
          <?php

//echo $_SESSION['id'];
          $action="residents/confirmResident/"; 

          echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data','autocomplete'=>'off'));?>

          <input type="hidden" name="owner_id" value=<?php echo $owner_id; ?>>
          <input type="hidden" name="user_id" value=<?php echo $user_id; ?>>
          <input type="hidden" name="request_id" value=<?php echo $request_id; ?>>
          <input type="hidden" name="property_id" value=<?php echo $property_id; ?>>
          <button type="submit" name="confirm" class="btn-success btn-md btn-radius"><span class='glyphicon glyphicon-pencil'></span> </button>
        </form>

      </td>

    </tr>
    <?php 
  }?>
  

</table>




</div>