<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  ?> 

  <div class="container form-area">
 
    <?php

  $action="residents/";
//var_dump($getListToComfirm);
  echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data'));?>
  <?php foreach ($getListToComfirm as $user) {      
    ?>
   <h1 class="whtColor"> List Of Requests Made By <span class="text-warning"> <?php echo $_SESSION['role'].' '. $user->name ?> </span></h1>
   	<br>
   	<h4><b><i>Confirm Request</b></i></h4>
   	<table class="table">
  <tr class="danger text-warning">
    <th>Name</th>
    <th>Address</th>
    <th>Date</th>
    <th>Edit</th>
  </tr>
  
  
    <tr><td><?php echo $user->name; ?> </td>
    <td><?php echo $user->door_number.' '.$user->street_name; ?></td>
    <td><?php echo $user->date_request; ?></td>
     <td class='text-center'>
      <a href="<?php echo base_url('residents/request/'.$_SESSION['id']); ?>" class='btn btn-primary btn-xs' title="edit">
        <span class='glyphicon glyphicon-pencil'></span> 
      </a>
      <a href="<?php echo base_url('residents/cancelRequest/'.$user->id); ?>" class='btn btn-warning btn-xs' title="cancel">
         <span class="glyphicon glyphicon-remove-sign">Cancel</span>
      </a>
    </td>

      </tr>
    <?php }?>
  

</table>

</div>