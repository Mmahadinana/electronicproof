<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//This page shows the list approved for the request//
?> 


<div class="container form-area">

  <?php
  //var_dump($getListToComfirm);
  $user_id=0;
  $property=0;
  $request_id=0;
  ?>
  <h1 class="whtColor"> List Of Residents To Be Approved </h1>
  <br>
  <?php
 if (isset($statusApprove)) {
    echo alertMsg($statusApprove,'','<b>Sorry, no waiting request to approve  <span class="glyphicon glyphicon-thumbs-down text-primary"></span></b>');
   

 } 
  // sending a failer message from administrator
 if (isset($statusUpdate_AdminD)) {
    echo alertMsg($statusUpdate_AdminD,'User request declined successfully','Request was unabled to be declined <span class="glyphicon glyphicon-thumbs-down"></span>');
   
 }
 //sending a success message from administrator
if (isset($statusUpdate_AdminA)) {
    echo alertMsg($statusUpdate_AdminA,'User request approved successfully','Request was unabled to be declined <span class="glyphicon glyphicon-thumbs-down"></span>');
   
 }?>
  <table class="table">
    <tr class="danger text-warning">
      <th>Name</th>
      <th>Address</th>
      <th>Date</th>
      <th>Edit</th>
    </tr>

    <?php foreach ($getListToComfirm as $user) { 
    //user_id of the user who is to confirmed 
        $user_id=$user->user_id;
        $property=$user->property_id;
        $request_id=$user->request_docs_id;
      ?>
      <tr><td><?php echo $user->name; ?> </td>
        <td><?php echo $user->door_number.' '.$user->street_name; ?></td>
        <td><?php echo $user->date_request; ?></td>
        <td class='text-center'>

           <?php

  $action="Request_proof/approveResident/" ;

  echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data','method'=>'POST'));?>

    <input type="hidden" name="property_id" value="<?php echo $property ?>">
    <input type="hidden" name="request_id" value="<?php echo $request_id ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">

      
   <button type="submit" class='btn btn-primary btn-xs' title="edit">
            <span class='glyphicon glyphicon-pencil'></span> 
          </button> 
   </form>       
        </td>

      </tr>
      
<?php }?>

    </table>


  </div>