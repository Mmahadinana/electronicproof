<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container ">

  <h1 > List Of Residents</h1>
  
  <?php
  

  $action="residents/listOfResidents/";

  echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data',' autocomplete'=>'off'));?>
  <div class="form-area">
    <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>
    <input type="hidden" id="property_id" name="property_id" value=<?php echo $_SESSION['property_id']; ?>>
  </form>
  <div class="row tablereq">
    <div class="col-md-10">
     
     <table class="table text-left romtbl_borders">

      <tbody>
        <tr>
          <td>Date</td>
          <td class="text-primary"><?php  echo date('Y / m / d')?></td>

        </tr>
        <tr>

          <td>
            <?php    

            foreach ($add_addinfor as $key ) {

              ?>

            </td>
          </tr>
          <tr>
            <td rowspan="7">Address</td>               
            <td ><?php  echo $key->door_number.$key->street_name?></td>      
          </tr>

          <tr>
            <td><?php  echo $key->town?></td>

          </tr>
          <tr>
            <td><?php  echo $key->zip_code?></td>

          </tr>
          <tr>
            <td><?php  echo $key->manucipality?></td>

          </tr>
          <tr>
            <td><?php  echo $key->district?></td>

          </tr>
          <tr>
            <td><?php  echo $key->province?></td>            
            </tr><?php
          }
          ?>
          
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>List Of Residents</th>
            <th>Edit</th>
            <th>Delete</th>
            
          </tr>
        </thead>
        <tbody>
         
         <?php    
 //var_dump($user_addinfor);
         foreach ($user_addinfor as $key1) {


          ?>
          <tr class="warning text-danger">
            <td><?php  echo $key1->name;?></td>

            <td>
              <?php

              $action="publiczone/editUser";

              echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


              <input type="hidden" name="userid" value=<?php echo $key1->user_id; ?>>
              <input type="hidden" name="usercheck" value="true">
              <button type="submit" name="confirm" class="glyphicon glyphicon-pencil text-primary" title="Edit"><span class="text-success"></span></button>
            </form>
          </td>
          
          <td>  <a href ="<?php echo base_url("residents/listOfResidents/".$key1->user_id) ?>" class ="btn btn-default btn-md" title="Delete">
            <span class="glyphicon glyphicon-trash text-danger"></span></a></td>
            

          </tr>
          
          <?php } ?>  
          
          
        </tbody>
      </table>

    </div>

  </div>

</div>
<!-- /form -->
</div>
