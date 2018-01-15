<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container ">

  <h1 > Confirm User </h1>

  <?php
if(empty($user_addinfor)){
echo "<div class='text-danger'><i class='fa fa-frown-o fa-4x' aria-hidden='true' ></i>".'This request has been canceled </div>';
?>
<a class='text-primary h3' href="<?php echo base_url('residents/listOfApproval') ?>"><i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i>OK</a>
  <?php
}else {
  

  $action="residents/confirm/";

  echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data','autocomplete'=>'on'));?>
  <div class="form-area" >
    <input type="hidden" id="user_id" name="user_id" value=<?php echo $user_id; ?>>
    
    <input type="hidden" id="property_id" name="property_id" value=<?php echo $property_id; ?>>
    <input type="hidden" id="request_id" name="request_id" value=<?php echo $request_id; ?>>
    <div class="row tablereq" id="approval">
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

                foreach ($user_addinfor as $key ) {

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
        <h5 id="para">This is to confirm <?php echo $key->name;?> Id numbers <?php echo $key->identitynumber;?> 
          stays at the above mentioned address since (<?php echo $key->date_registration;?>)   until today. The house owned by <?php echo $key->name;?> </h5>
          <h5 id="pari">You can go to  (<a href ="<?php echo base_url("publiczone/editUser/") ?>">Confirm User Address</a>) to check the applicant  </h5>

          
        </div>
        <div class="col-lg-12">
          
        
        <div class="col-lg-3">
          <button class="btn btn-md btn-primary form-control" name="approve" type="submit">Approve</button>     
        </div>

        <div class="col-lg-3">
          <button class="btn btn-md btn-warning form-control" name="disapprove" type="submit">Decline</button>
        </div>
</div></form><!-- /form -->
      </div>
    </div>
  <?php }?>
</div>

