<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container ">

  <h1 ><?php echo $pageTitle; ?></h1>
  <div class="form-area">
    <?php

    (isset($userid) && !empty($fileToUpload))? $count=count($propFiles) : '';  
    $action= isset($userid)? "residents/EditRequest/":"residents/request/";

    echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data', 'autocomplete'=>'off'));?>

    <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>
    <input type="hidden"  name="property_id" value="<?php echo $property_id; ?>">

    <div class="row tablereq">
    <div class="col-md-10"><!--span class="text-warning h4"> Owner :<?php foreach ($db as $value) {
      echo ', '.$value->name;
    } ?> </span-->
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
          </tr>

        </tbody>
      </table>
    </div>
  </div>

  <!-- enter information that will be verified-->	
  <div class="form-group  ">
    <div class="passlabels col-md-6">
      <label for="idnumber" class="control-label label-primary passlabels"><span class="footPadRight"> ID No.</span></label>				
    </div>
    <div class="col-md-6">
      <input type="text" id="idnumber" name="idnumber" class="form-control" placeholder="ID No." value="<?php echo isset($userid)? $key->identitynumber : set_value('idnumber') ;?>">
    </div>
    <p><?php echo form_error('idnumber') ? alertMsg(false,'idnumber',form_error('idnumber')) : ''; ?></p>
  </div>

  <div class="form-group  ">
    <div class="passlabels col-md-6">
      <label for="email" class="control-label label-primary passlabels "><span class="footPadRight"> E-mail</span></label>
    </div>
    <div class="col-md-6">					
     <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" value="<?php echo isset($userid)? $key->email : set_value('email') ;?>">
   </div>
   <p><?php echo form_error('email') ? alertMsg(false,'email',form_error('email')) : ''; ?></p>
 </div>

 <!-- Phone--> 


 <div class="form-group ">
  <div class="passlabels col-md-6">
    <label for="phone" class="control-label  "><span class="footPadRight"> Phone</span></label>
  </div>				
  <div class="col-md-6">
    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="<?php echo isset($userid)? $key->phone : set_value('phone') ;?>">
  </div>
  <p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
</div>
<!-- File upload--> 

<div class="form-group col-lg-12 ">
  <div class="col-lg-5 ">
    <input type="text" class="idinput_path form-control text-success" name="identity_doc" value="<?php echo isset($userid) ? $idFiles: set_value('idFiles') ;?>" disabled>
  </div>
  <div class="col-lg-4">
    <?php echo isset($userid)? "<a href= 'request' class='btn btn-warning form-control text-success'><b>Change Files</b></a>":"<label class='idUpload '>
    <input type='file' name='idUpload' class='hidden'>
    <span class='btn-idUpload'>Choose Identity Doc.</span>
  </label>"?>



  <p><?php echo form_error('idUpload') ? alertMsg(false,'idUpload',form_error('idUpload')) : ''; ?></p>
  <!--button class="btn btn-lg btn-warning passbtn" name="reset" type="reset" value="uploadid">upload id</button-->                  
</div>
</div>
<div class="form-group col-lg-12 "><?php
if(isset($userid) && !empty($fileToUpload)) {
  for($i = 0; $i <$count; $i++){
    /*****************outpu in an edit mode*********************************************/
    echo "<div class='col-lg-5'> <span class='btn-default form-control text-left'> $propFiles </span> </div><br>";
  } 
} elseif(isset($userid) && empty($fileToUpload)) {
  /*************output nothing if the was no file uploaded*****************************/
  echo '';
}else{
  /*****************outpu in an insert mode*********************************************/
 echo "<div class='col-lg-5'>
 <input type='text' class='pdinput_path form-control text-success' name='property_doc' 
 value=''disabled>
 </div>

 <div class='col-lg-4'>
 <label class='fileToUpload '>
 <input type='file'  class='hidden' name='fileToUpload[]'  multiple>
 <span> Choose Property Doc.</span>  

 </label>
 </div>";
}?>
<!--button class="btn btn-lg btn-warning passbtn" name="reset" type="reset" value="Uploadfile">Upload file</button-->
</div>
<p><?php echo form_error('fileToUpload') ? alertMsg(false,'fileToUpload',form_error('fileToUpload')) : ''; ?></p>
<?php
}
?>


<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
<?php echo isset($userid)? '':'
<div class="form-group">
  <div class="col-lg-6">
    <button class="btn btn-lg btn-primary form-control" name="submit" id="submit" type="submit">Submit</button>
  </div>

  <div class="col-lg-6">
    <button class="btn btn-lg btn-warning form-control" name="reset" type="reset" value="upload">Reset</button>
  </div>
</div>'?>



</form><!-- /form -->
</div>
</div>
<!-- /div></card-container -->
<!-- /container --><!-- /.container -->

<script>

  /****************query for the idetity document upload***********************/

  $('.idUpload input[type="file"]').on('change', function() {

    $('.idinput_path').val(this.value.replace('C:\\fakepath\\', ''));
    


  });
  /******************jquery for the multiple files for property*************/
  $(".fileToUpload").on('change', function () {

    var fp = $('.fileToUpload input[type="file"]');
    var lg = fp[0].files.length; // get length
    var items = fp[0].files;
    var fragment = "";

    if (lg > 0) {
      for (var i = 0; i < lg; i++) {
            var fileName = items[i].name; // get file name          

            // append li to UL tag to display File info
            
            fragment += fileName + " ,";
          }

      //display file in the an input
      $('.pdinput_path').val(fragment);
    }
  });
</script>