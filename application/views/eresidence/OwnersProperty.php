<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container form-area">

 <h2 class="whtColor"> List Of Owners Property </h2>


 <?php

 $action="residents/property/";

 echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data'));?>
     <input type="hidden" id="user_id" name="user_id" value="100">

 <div class="row tablereq">
      <div class="col-md-10">
        <table class="table text-left ">
          
          <tbody>
            <tr>
              <td>Date</td>
              <td>2017/11/02</td>
            </tr>
            <tr>
              <td>Resident Full Names</td>
              <td>
                <?php    
                
                foreach ($user_id as $key ) {
                  echo $key->name;
                  ?>
                  
                </td>
              </tr>
              <tr>
                <td rowspan="7">Address</td>               
                <td ><?php  echo $key->address?></td>      
              </tr>
              
              
              <tr>
                <td><?php  echo $key->suburb?></td>
                
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