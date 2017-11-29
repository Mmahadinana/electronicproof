<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 

<div class="starter-template">
<h1>Preview of Proof of Residence</h1>
 <div class="card card-container">
  <h4>Well done!!! Please click a confirm button to confirm your request or cancel to cancel your request</h4>
  <h4>Please contact the owner of the residence if you have not recieve email or text message of the proof of residence within 48 hours!!!</h4>
</div>
<div class="form-area">
  <h1>Proof of Residence</h1>
  <div class="row tablereq">
    <div class="col-md-10">
     <?php 
       
//var_dump($user_addinfor);
     echo form_open_multipart('upload/do_upload');
     //echo $_POST['user_id'];
     foreach ($residentInfor as $key ) {?>

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

             
                echo $key->name;
                $userid=$key->id;
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
            
            foreach ($owner_addinfor as $valowner ) {
                //storing the data of the owner where resident lives
              $owner_id=$valowner ->owner;
              $property_id=$valowner ->property;

            ?>
            
          </tbody>
        </table>

</div>
</div>
<div class="text-left">
 <p>This is to confirm that  <strong class="text-warning"><?php echo $key->name;?> </strong>ID number <strong class="text-warning"><?php echo $key->identitynumber;?> </strong> stays at the above mentioned address since (date) until today. The <strong class="text-warning"><?php  echo $valowner->house_type;?></strong> owned by <strong class="text-warning"><?php  echo $valowner->name;  }}?></strong>.</p>
 <br>
 <p> This letter will be valid for only three months, starting from the date issued.</p>

</div>
<div> 
   
 <div class="signleft"> SIGNATURE</div>
 <div class="signline">
   <!--ins><span ></span></ins--> <hr class="signline">
 </div> 
</div>
<div class="form-group">

  <div class="col-lg-4 col-md-12  ">
   
   <a href="<?php echo base_url('residents/waitingForApproval/'.$userid.'/'.$owner_id.'/'.$property_id) ?>" class="btn btn-lg btn-primary ">CONFIRM</a>
  </div>
  <div class="col-lg-4 col-md-12">
    <a href="<?php echo base_url() ?>" class="btn btn-lg btn-warning ">CANCEL</a>
  </div>
</div>
</div>


</div>