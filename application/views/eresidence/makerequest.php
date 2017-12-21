 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 //var_dump($user_id) ;
//echo $_SESSION['id'];
$action="residents/makerequest/";

echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data'));?>

  <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>


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
    <input type="file"  class="form-inline input-lg fileToUpload" name="idUpload" id="idUpload" >  
    <p><?php echo form_error('idUpload') ? alertMsg(false,'idUpload',form_error('idUpload')) : ''; ?></p>
    <!--button class="btn btn-lg btn-warning passbtn" name="reset" type="reset" value="uploadid">upload id</button-->                  
  </div>

  <div class="form-group">

   <input type="file"  class="form-inline input-lg fileToUpload" name="fileToUpload[]" id="fileToUpload" multiple>
   <span><?php// echo $_FILES['fileToUpload']['name'] ?></span>  
   <!--button class="btn btn-lg btn-warning passbtn" name="reset" type="reset" value="Uploadfile">Upload file</button-->

 </div>
 <p><?php echo form_error('fileToUpload') ? alertMsg(false,'fileToUpload',form_error('fileToUpload')) : ''; ?></p>


 <input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
 
 <div class="form-group">
  <div class="col-lg-6">
    <button class="btn btn-lg btn-primary form-control" name="submit" id="submit" type="submit">Submit</button>
  </div>

  <div class="col-lg-6">
    <button class="btn btn-lg btn-warning form-control" name="reset" type="reset" value="upload">Reset</button>
  </div>
</div>



</form><!-- /form -->
