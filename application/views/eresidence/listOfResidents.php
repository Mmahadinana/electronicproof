<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container ">

  <h1 > List Of Residents</h1>
 
  <?php
 //var_dump($user_id) ;
//echo $_SESSION['id'];
  $action="residents/list/";

  echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data'));?>
  <div class="form-area">
    <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>
    <div class="row tablereq">
      <div class="col-md-10">
        <table class="table text-left romtbl_borders">
   <table class="table text-left romtbl_borders">

          <tbody>
            <tr class="table-active">
              <td>Date</td>
              <td>2017/11/02</td>

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

              <tr class="table-success">
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
              <tr class="table-active">
                <th>List Of Residents</th>
                <th>Edit</th>
                <th>Delete</th>
                
              </tr>
            </thead>
            <tbody>
             
 <?php    
 
                foreach ($user_addinfor as $key1) {

                  ?>
              <tr class="table-active">
                <td><?php  echo $key1->name;?></td>

                <td><a href ="<?php echo base_url("publiczone/editUser/".$key1 ->id) ?>" class ="btn btn-default btn-md" title="Edit">
          <span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>  <a href ="<?php echo base_url("publiczone/askdelete/".$key1->id) ?>" class ="btn btn-default btn-md" title="Delete">
          <span class="glyphicon glyphicon-trash"></span></a></td>
            
              </tr>
          
                <?php } ?>  
             
                
              </tbody>
            </table>

          </div>

        </div>

      </div>
    </form><!-- /form -->
  </div>
