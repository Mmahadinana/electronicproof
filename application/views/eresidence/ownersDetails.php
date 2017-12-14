<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container ">

  <h1>Owner's Details</h1>

  <?php

//echo $_SESSION['id'];
  $action="residents/details/";

  echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data'));?>
  <div class="form-area">
    <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>
      <div class="row tablereq">
    <div class="col-md-10">
      <table class="table text-left romtbl_borders">

        <tbody>
          <tr>
            <td>Date</td>
           <td class="text-primary"><?php  echo date('Y / m / d')?></td>

          </tr>
          <tr>
            <td>Resident Full Names</td>
            <td>
              <?php    

              foreach ($user_addinfor as $key ) {
                echo $key->name;
                ?>
                

              </td>
            </tr>
            <tr>
              <td rowspan="7">Address</td>               
              <td ><?php  echo $key->door_number. ' '.$key->street_name?></td>      
            </tr>


            <tr>
              <td><?php  echo $key->street_name?></td>

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
      </div>
    </div>
    </div>
    </div>