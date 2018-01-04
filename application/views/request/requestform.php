<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container ">

  <h1 > Request Form </h1>
  <div class="form-area">
    <?php
 //var_dump($user_id) ;
//echo $_SESSION['id'];
    $action="residents/request/";

    echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data', 'autocomplete'=>'off'));?>

    <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>
    <input type="hidden"  name="property_id" value="<?php echo $property_id; ?>">

    <div class="row tablereq">
    <div class="col-md-10"><span class="text-warning h4"> Owner :<?php //foreach ($db as $value) {
     // echo ', '.$value->name;
    //} ?> </span>
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


  <!-- Old Password-->	



  <div class="form-group  ">
    <div class="passlabels col-md-6">
      <label for="idnumber" class="control-label label-primary passlabels"><span class="footPadRight"> ID No.</span></label>				
    </div>
    <div class="col-md-6">
      <input type="text" id="idnumber" name="idnumber" class="form-control" placeholder="ID No." value="<?php echo isset($request_id)? $key->identitynumber :set_value('idnumber') ;?>">
    </div>
    <p><?php echo form_error('idnumber') ? alertMsg(false,'idnumber',form_error('idnumber')) : ''; ?></p>
  </div>

  <div class="form-group  ">
    <div class="passlabels col-md-6">
      <label for="email" class="control-label label-primary passlabels "><span class="footPadRight"> E-mail</span></label>
    </div>
    <div class="col-md-6">					
     <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" value="<?php echo isset($request_id)? $key->email : set_value('email') ;?>">
   </div>
   <p><?php echo form_error('email') ? alertMsg(false,'email',form_error('email')) : ''; ?></p>
 </div>

 <!-- New Password--> 


 <div class="form-group ">
  <div class="passlabels col-md-6">
    <label for="phone" class="control-label  "><span class="footPadRight"> Phone</span></label>
  </div>				
  <div class="col-md-6">
    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="<?php echo isset($request_id)? $key->phone : set_value('phone') ;?>">
  </div>
  <p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
</div>
<!-- File upload--> 

<div class="form-group col-lg-12 ">
  <div class="col-lg-5 ">
    <input type="text" class="idinput_path form-control text-success " disabled>
  </div>
  <div class="col-lg-4">
    <label class="idUpload ">
      <input type="file" name="idUpload" class="hidden">
      <span class="btn-idUpload">Choose Identity Doc.</span>
    </label>


    <p><?php echo form_error('idUpload') ? alertMsg(false,'idUpload',form_error('idUpload')) : ''; ?></p>
    <!--button class="btn btn-lg btn-warning passbtn" name="reset" type="reset" value="uploadid">upload id</button-->                  
  </div>
</div>
<div class="form-group col-lg-12 ">
  <div class="col-lg-5 ">
    <input type="text" class="pdinput_path form-control text-success" disabled>
  </div>
  <div class="col-lg-4">
    <label class="fileToUpload ">
     <input type="file"  class="hidden" name="fileToUpload[]" multiple>
     <span> Choose Property Doc.</span>  
     <!--button class="btn btn-lg btn-warning passbtn" name="reset" type="reset" value="Uploadfile">Upload file</button-->
   </label>
 </div>
</div>
<p><?php echo form_error('fileToUpload') ? alertMsg(false,'fileToUpload',form_error('fileToUpload')) : ''; ?></p>
<?php
}
?>


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
</div>
</div>
<!-- /div></card-container -->
<!-- /container --><!-- /.container -->

<script>
  $('.idUpload input[type="file"]').on('change', function() {

    $('.idinput_path').val(this.value.replace('C:\\fakepath\\', ''));
    
   

  });
/*$('.fileToUpload input[type="file"]').on('change', function() {

    $('.pdinput_path').val(this.value.replace('C:\\path\\', ''));

  });
  $(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'localhost' ? 'electronicproof/residents/request' : 'server/php';
    $('.fileToUpload').fileupload({
      url: url,
      dataType: 'json',
      done: function (e, data) {
        $.each(data.result.files, function (<?php echo base_url('residents/request'); ?>, file) {
          $('<p/>').text(file.name).appendTo('.pdinput_path');
        });
      },
      
    }).prop('disabled', !$.support.fileInput)
    .parent().addClass($.support.fileInput ? undefined : 'disabled');
  });*/
</script>