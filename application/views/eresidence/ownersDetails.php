<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container ">

  <h1>Owner's Details</h1>

  <?php
//var_dump($user_addinfor);
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
              <td class="text-danger">
                <?php    
                 foreach ($user_addinfor as $key ) {
                  echo $key->name;

                  ?>

                </td>
              </tr>
              <tr>
                <td >Email</td>               
                <td class="text-danger"><?php  echo $key->email ?></td>      
              </tr>


              <tr>
                <td >Identification Number</td>
                <td class="text-danger"><?php  echo $key->identityNumber?></td>

              </tr> 
              <tr>
                <td >Phone Numbers</td>
                <td class="text-danger"><?php  echo $key->phone?></td>

              </tr>
              <tr>
                <td >Date of Birth</td>
                <td class="text-danger"><?php  echo $key->dateOfBirth?></td>

              </tr>            
              <tr>
                <td >Date of Registration</td>
                <td class="text-danger"><?php  echo $key->date_registration?></td>

              </tr>
              
              <!--tr>
                <td >Gender</td>
                <td class="text-danger"><?php  echo ($key->gender==0) ? "Male" : "Female"?></td>            
                </tr--><?php
              }
              ?>

            </tbody>
        </table>
         <div class="col-lg-3">
          <button class="btn btn-lg btn-primary form-control" name="approve"  type="submit">Confirm</button>     
        </div>

        <div class="col-lg-3">
          <a class="btn btn-lg btn-warning form-control" type="text">Edit</a>
        </div>
      </div>
    </div>
    </div>
    </div>