<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container ">

  <h1 > Approval Form </h1>

  <?php
 //var_dump($user_id) ;
//echo $_SESSION['id'];
  $action="residents/approve/";

  echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data'));?>
  <div class="form-area">
    <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>
    <div class="row tablereq">
      <div class="col-md-10">
        <table class="table text-left romtbl_borders">

          <tbody>
            <tr>
              <td>Date</td>
              <td>2017/11/02</td>

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
          <h5 id="pari">You can go to  (<a href="publiczone/registerUser/">Confirm User Address</a>) to check the applicant  </h5>
        <div class="form-group">
          <div class="col-lg-4">
            <button class="btn btn-lg btn-primary " name="approve" id="approve" type="approve">Approve</button>
          </div>

          <div class="col-lg-4">
            <button class="btn btn-lg btn-warning " name="decline"  id="decline" type="decline" value="decline">Decline</button>
          </div>
        </div>

      </div>

    </div>
  </form><!-- /form -->
</div>