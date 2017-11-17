<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



  <div class="starter-template">
  	<h1>Preview Message</h1>
  	<div class="card card-container">
  		<h4>Your request has been successfully submitted</h4>
  		<h4><mark>NB</mark>Please contact the owner of the residence if you have not recieve email or text message of the proof of residence within 48 hours!!!</h4>
  	</div>
      <div class="form-area">
<h1>Proof of Residence</h1>
<div class="row tablereq">
        <div class="col-md-10">
        	<?php echo form_open_multipart('upload/do_upload');
        	foreach ($user_id as $key ) {?>

<input type="hidden" name="user_id" <?php echo isset($user_id)? "value='echo $key->id'":"value='0'" ?> />

<br /><br />



</form>

          <table class="table text-left romtbl_borders">
            
            <tbody>
              <tr>
                <td>Date</td>
                <td>2017/11/02</td>
            </tr>
                <tr>
                <td>Resident Full Names</td>
                <td>
                  <?php    
                 
                  
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
                       
              </tr>
              
            </tbody>
          </table>
        </div>
     </div>
     <div class="text-left">
     <p>This is to confirm that  <strong class="text-warning"><?php echo $key->name?> </strong>ID number <strong class="text-warning"><?php echo $key->identitynumber?> </strong> stays at the above mentioned address since (date) until today. The <strong class="text-warning"><?php  echo $key->house_type?></strong> owned by <strong class="text-warning"><?php  echo $key->name  ?></strong>.</p>
     <br>
     <p> This letter will be valid for only three months, starting from the date issued.</p>
     <?php
              }
              ?>
 </div>
     <div>      
     <div class="signleft"> SIGNATURE</div>
     <div class="signline">
     <!--ins><span ></span></ins--> <hr class="signline">
     </div> 
 </div>
      </div>
       <div class="form-group">
    <div class="col-md-6">
        <button class="btn btn-lg btn-primary " name="submit" id="submit" type="submit">CONFIRM</button>
    </div>
    <div class="col-md-6">
        <a href="<?php echo base_url() ?>" class="btn btn-lg btn-warning ">CANCEL</a>
    </div>
    </div>
</div>