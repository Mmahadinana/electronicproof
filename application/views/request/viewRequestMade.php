<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$property_id=0;
//var_dump($getListToComfirm); 
?> 

<div class="container form-area">


 <h1 class="whtColor"> List Of Requests Made By <span class="text-warning"> <?php echo ucfirst($_SESSION['role']).' '. $_SESSION['name'];?> </span></h1>
 <br>
 <h4><b><i>Confirm Request</b></i></h4>
 <table class="table">
  <tr class="danger text-warning">
    <th>Name</th>
    <th>Address</th>
    <th>Date</th>
    <th>
    Edit request &nbsp;&nbsp; Remove request
  </th>
  </tr>
  <?php 

  foreach ($getListToComfirm as $user) { 
    $property_id=$user->property_id;
    $request_id=$user->id;
    $user_id=$user->user_id;
    ?>


    <tr><td><?php echo $user->name; ?> </td>
      <td><?php echo $user->door_number.' '.$user->street_name; ?></td>
      <td><?php echo $user->date_request; ?></td>
      <td class='text-center'>
        <div class="col-lg-6">
          <?php

          $action="residents/EditRequest";
//var_dump($getListToComfirm);
          echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data','method'=>'POST','autocomplete'=>'off'));?>
          <input type="hidden" name="property_id" value=<?php echo $property_id ?>>
          <input type="hidden" name="usercheck" value="true">
          <input type="hidden" name="request_id" value=<?php echo $request_id ?>>
          <input type="hidden" name="user_id" value=<?php echo $user_id ?>>
          <button type="submit"  class='btn btn-primary btn-xs' title="edit">
            <span class='glyphicon glyphicon-pencil'></span> 
          </button>
        </form>
      </div>
      <div class="col-lg-6">
         <?php

          $action="residents/cancelRequest";
//var_dump($getListToComfirm);
          echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data','method'=>'POST', 'autocomplete'=>'off'));?>
          <input type="hidden" name="request_id" value=<?php echo $request_id ?>>
          
          <button type="submit"  class='btn btn-warning btn-xs' title="cancel">
            <span class='glyphicon glyphicon-minus'></span> 
          </button>
        </form>
      </div>
        
   </td>

 </tr>
 <?php 
}?>

</div>

</table>

</div>