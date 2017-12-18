<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  ?> 

  <div class="container form-area">
 
    <?php
$property=0;
  $action="residents/listOfApproval/";

  echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data','method'=>'POST'));?>
   <h1 class="whtColor"> List Of Residents To Be Approved </h1>
    <br>
    <h4><b><span class="text-danger"><?php foreach ($owner as $value) {
      $property=$value->property;
      echo $value->name.', ';?></span><i>Approve Request</b></i></h4>
<input type="hidden" name="property_id" value="<?php echo $value->property ?>">
      <?php
    
    } ?>
    <table class="table">
  <tr class="danger text-warning">
    <th>Name</th>
    <th>Address</th>
    <th>Date</th>
    <th>Edit</th>
  </tr>
  
  <?php foreach ($getListToApprove as $user) {      
    ?>
    <tr><td><?php echo $user->name; ?> </td>
    <td><?php echo $user->door_number.' '.$user->street_name; ?></td>
    <td><?php echo $user->date_request; ?></td>
     <td class='text-center'>
      <a href="<?php echo base_url('residents/approve/'); ?>" class='btn btn-primary btn-xs' title="edit">
        <span class='glyphicon glyphicon-pencil'></span> 
      </a>
    </td>

      </tr>
    <?php }?>
  

</table>
<br>
<h4><b><i>Approve Residents Registration</b></i></h4>
  <table class="table">
  <tr class="danger text-warning">
    <th>Name</th>
    <th>Address</th>
    <th>Date</th>
    <th>Edit</th>
  </tr>
  <tr>
    <td>Rebecca Motseare</td>
    <td>1814 Phahameng Section</td>
    <td>12/02/2017</td>
     <td><span class="glyphicon glyphicon-pencil"></span></td>
  </tr>
  <tr>
    <td>Larochelle Tess Martens</td>
    <td>1814 Phahameng Section</td>
    <td>24/02/2017</td>
     <td><span class="glyphicon glyphicon-pencil"></span></td>
  </tr>
  <tr>
    <td>Rosy Marumo</td>
    <td>1814 Phahameng Section</td>
    <td>26/05/2017</td>
     <td><span class="glyphicon glyphicon-pencil"></span></td>
  </tr>
  <tr>
    <td>Sybil Dichaba</td>
    <td>1814 Phahameng Section</td>
    <td>29/10/2017</td>
     <td><span class="glyphicon glyphicon-pencil"></span></td>
  </tr>
  <tr>
    <td>Tess Marumo</td>
    <td>1814 Phahameng Section</td>
    <td>27/08/2017</td>
     <td><span class="glyphicon glyphicon-pencil"></span></td>
  </tr>
  <tr>
    <td>Palesa Dichaba</td>
    <td>1814 Phahameng Section</td>
    <td>03/03/2017</td>
     <td><span class="glyphicon glyphicon-pencil"></span></td>
  </tr>

</table>
</div>