<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?> 

<div class="container form-area">

  <?php
  //****************************************************** defining variables *///////////////////////////////////////////
  $property_id=0;
  $user_id=0;
  $owner_id=0;
  $approvalListForRequest=array();

  ?>
  <h1 class="whtColor"> List Of Residents To Confirm </h1>
  <br>
  <h4><b><span class="text-danger"><?php foreach ($owner as $owner_val) {
    // storing the values of data that will be used to approve request by administrator
    $property_id=$owner_val->property;
    $owner_id=$owner_val->id;
    $owners= $owner_val->name.', '; 
    foreach ($getListToApproval as $user_val) {
      //********************condition for the list that should be printed*/////////////////////////////////////////////////
      if ($owner_val->property==$user_val->property_id ) {
        $approvalListForRequest[$user_val->property_id]=$user_val;
      }
    }
    
  } 
//*****************************************print name of owner*************************************************************/
    //echo $owners;
  ?></span><i>Approval Request</b></i></h4>
  
  <!--*****************************************print name of owner*************************************************************/-->
  <table class="table">
    <tr class="danger text-warning">
      <th>Name</th>
      <th>Address</th>
      <th>Date</th>
      <th>Edit</th>
    </tr>

    <?php

    
 //*****************************************print name of list of users that made requests******************************/   
    foreach ($approvalListForRequest as $user) {
      


      $user_id=  $user->id;    
      ?>


      <tr><td><?php echo $user->name; ?> </td>
        <td><?php echo $user->door_number.' '.$user->street_name; ?></td>
        <td><?php echo $user->date_request; ?></td>
        <td class='text-center'>
          <?php
 //var_dump($user_id) ;
//echo $_SESSION['id'];
          $action="residents/approval_list/";

          echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data'));?>

          <input type="hidden" name="owner_id" value=<?php echo $owner_id; ?>>
          <input type="hidden" name="user_id" value=<?php echo $user_id; ?>>
          <input type="hidden" name="property_id" value=<?php echo $property_id; ?>>
          <button type="submit" name="confirm" class="btn-success btn-md btn-radius"><span class='glyphicon glyphicon-pencil'></span> </button>
        </form>

      </td>

    </tr>
    <?php 
  }?>
  

</table>


</div>