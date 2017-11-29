<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class="starter-template">
  <div class="card card-container">
    <h1>Preview Message</h1>
  <h4 class="text-success">Your request has been successfully submitted</h4>
  
</div>
<div class="form-area">
  <h1>Proof of Residence</h1>
  <div class="row tablereq">
    <div class="col-md-10 ">
     <?php 
//var_dump($user_addinfor);
     echo form_open_multipart('upload/do_upload');
     //echo $_POST['user_id'];
     foreach ($user_addinfor as $key ) {?>

     <input type="hidden" name="user_id" <?php echo isset($user_id)? "value='echo $key->id'":"value='0'" ?> />

     <br /><br />



   </form>

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
                $user_id=$key->id;
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

<div class="text-left">
 <p class="text-center"><strong class="text-danger">Your application is waiting for approval</strong></p>

 
 <?php
}
?>
</div>
<div>      

<div class="form-group text-center">
  <div class="col-lg-12">
    <button class="btn btn-lg btn-default " disabled="disabled" name="submit" id="submit" type="submit">APPROVED</button>
    <a class="h4" href="<?php echo base_url('residents/viewRequestMade/'.$user_id)?>"><span class="glyphicon glyphicon-eye-open"></span> <span class="text-primary"> View the list of your requests</span></a>
  </div>

</div>
</div>

</div>