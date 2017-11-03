<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container form-area">
  <h1 class="whtColor"> Request Form </h1>

  <?php

  $action="residents/request/";

  echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data'));?>
  <div class="row">
        <div class="col-md-10">
          <table class="table text-left">
            
            <tbody>
              <tr>
                <td>Date</td>
                <td>2017/11/02</td>
            </tr>
                <tr>
                <td>Resident Full Names</td>
                <td>Mmahadinana Rosy Marumo</td>
            </tr>
                <tr>
                <td rowspan="7">Address</td>               
                <td >69 Nahoon</td>               
              </tr>
              <?php 
              for ($i=0; $i < 6; $i++) { 
                 echo "<tr>
                <td>Details</td>
                
              </tr>";
              }
              ?>
              
            </tbody>
          </table>
        </div>
     </div>
        

  <!-- Old Password-->	

  <div class="form-group  ">
    <div class="passlabels col-md-6">
    <label for="idnumber" class="control-label label-primary passlabels"><span class="footPadRight"> ID No.</span></label>				
   </div>
    <div class="col-md-6">
        <input type="text" id="idnumber" name="idnumber" class="form-control" placeholder="ID No." value="<?php echo set_value('idnumber') ;?>">
    </div>
    <p><?php echo form_error('idnumber') ? alertMsg(false,'idnumber',form_error('idnumber')) : ''; ?></p>
    </div>

    <div class="form-group  ">
<div class="passlabels col-md-6">
        <label for="email" class="control-label label-primary passlabels "><span class="footPadRight"> E-mail</span></label>
        </div>
        <div class="col-md-6">					
           <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" value="<?php echo set_value('email') ;?>">
       </div>
       <p><?php echo form_error('email') ? alertMsg(false,'email',form_error('email')) : ''; ?></p>
   </div>

   <!-- New Password--> 

    <div class="form-group ">
        <div class="passlabels col-md-6">
        <label for="phone" class="control-label  "><span class="footPadRight"> Phone</span></label>
        </div>				
        <div class="col-md-6">
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="<?php echo set_value('phone') ;?>">
        </div>
        <p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
    </div>
<!-- File upload--> 

    <div class="form-group">
        <input type="file"  class="input-lg fileToUpload" name="idUpload" id="idUpload" >  
        <p><?php echo form_error('idUpload') ? alertMsg(false,'idUpload',form_error('idUpload')) : ''; ?></p>                  
    </div>

    <div class="form-group">

       <input type="file"  class="input-lg fileToUpload" name="fileToUpload" id="fileToUpload" multiple>  

    </div>
    <p><?php echo form_error('fileToUpload') ? alertMsg(false,'fileToUpload',form_error('fileToUpload')) : ''; ?></p>


    <input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
    <div class="form-group">
    <div class="col-md-6">
        <button class="btn btn-lg btn-primary passbtn" type="submit">Submit</button>
    </div>
    <div class="col-md-6">
        <button class="btn btn-lg btn-warning passbtn" type="reset">Reset</button>
    </div>
    </div>


    </form><!-- /form -->
</div>
<!-- /div></card-container -->
<!-- /container --><!-- /.container -->

