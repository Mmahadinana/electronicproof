<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   // $automovel_id   = $user_data['automovel_id']    ?? false; 
$id_province = $user_data->province_id ?? $this->input->post('province') ?? false;
$id_district= $user_data->district_id ?? $this->input->post('district') ?? false;
$id_manucipality = $user_data->manucipality_id ?? $this->input->post('manucipality') ?? false;
$id_town= $user_data->town_id ?? $this->input->post('town')?? false;

$id_suburb = $user_data->suburb_id ?? $this->input->post('suburb')?? false;
$id_address = $user_data->id ?? $this->input->post('street_name')?? false;
$streetName=$user_data->street_name ?? $this->input->post('street_name')?? false;

?>
<h1>Owner's Details</h1>
<div class="container form-area">
  <?php 

  $action="residents/details/";    ?>

  <input <?php echo isset($user_id)? "value='$user_id'":"value='0'";?> id='userid' type='hidden' name='userid'>

  <div class="stepwizard col-md-offset-3">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-primary btn-circle"  ><i class="fa fa-lock" aria-hidden="true"></i></a>
        <p>Step 1</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" ><i class="fa fa-user" aria-hidden="true"></i></a>
        <p>Step 2</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-3" type="button" class="btn btn-default btn-circle" ><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
        <p>Step 3</p>
      </div>


    </div>
  </div>
  <form role="form" action="" id="data" method="post">


    <div <?php echo  isset($user_id)? "class='hidden'" : "class='form-group '"?>>

      <?php foreach ($user_addinfor as $userdata) {
        
      ?>
      <div class="row setup-content" id="step-1">
      <div class="col-xs-6 col-md-offset-3">
          <div class="col-md-12">
            <h3>Personal Information</h3>
            <div class="col-md-6 text-left h5">
              <div class="control-label" for="name">Full Name</div>
              <div class="control-label" for="identitynumber">Identity Number</div>
              <div>Date of Birth</div>
              <div for="email">email</div>
              <div >Phone number</div>
              <div  id ="gender" class="control-label">Gender</div>
              

            </div>
            <div class="col-md-6 text-left h5">
              
              <div><?php echo $userdata->name; ?></div>
              <div><?php echo $userdata->email; ?></div>
              <div><?php echo $userdata->identityNumber; ?></div>
              <div><?php echo $userdata->dateOfBirth; ?></div>              
              <div><?php echo $userdata->phone; ?></div>
              <div><?php echo $userdata->description ?></div>
            </div>
            <?php } ?>
            <button class="btn btn-primary nextBtn btn-m pull-right" type="button">Next</button>
          </div>
        </div>
      </div>
      <div class="row setup-content" id="step-2">
        <div class="col-xs-6 col-md-offset-3">
          <div class="col-md-12">
            <h3 >Residential Information</h3>
            <!-- Province start-->
            <div class="form-group">

              <label for="province">Province</label>
              <select class="form-control" name="province" id="province" onchange ="update_distric()">
                <option  selected="true" disabled="disabled">Please select</option>

                <?php 

                foreach ($province as $province)
                  {?>
                <option <?php 
                if(isset($user_id)  && $provinceEdit)
                {

                  echo ($provinceEdit == $province->name)? 'selected':'';


                }
                else{
                  if(set_value('province'))
                  {
                    echo (set_value('province') == $province->id)? 'selected':'';
                  }

                }
                ?>

                value="<?php echo $province->id ?>"><?php echo $province->name ?></option>
                <?php } ?>
              </select>
              <?php  echo form_error('province') ? alertMsg(false,'',form_error('province')):'';?>
            </div>
            <!-- Province end-->

            <!-- District start-->
            <div class="form-group" id="select_district" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

              <label for="district">District</label>

              <select class="form-control"  name="district" id="district" onchange="update_manucipality()">

              </select>
              <?php  echo form_error('district') ? alertMsg(false,'',form_error('district')):'';?>



            </div>
            <!-- District end-->

            <!-- manucipality start-->
            <div class="form-group" id="select_manucipality" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>           
              <label for="manucipality">Manucipality</label>
              <select class="form-control" name="manucipality" id="manucipality" onchange="update_town()">

              </select>
              <?php  echo form_error('manucipality') ? alertMsg(false,'',form_error('manucipality')):'';?>
            </div>
            <!-- manucipality end-->

            <!-- town start-->

            <div class="form-group" id="select_town" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

              <label for="town">town</label>
              <select class="form-control" name="town" id="town" onchange="update_suburb()">
                <option  selected="true" disabled="disabled">Please select</option>


              </select>
              <?php  echo form_error('town') ? alertMsg(false,'',form_error('town')):'';?>
            </div>
            <!-- town end-->

            <!-- suburb start-->
            <div class="form-group" id="select_suburb" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

              <label for="suburb">Suburb</label>
              <select class="form-control" name="suburb" id="suburb" onchange="update_address()">
                <!--option  selected="true" disabled="disabled">Please select</option-->


              </select>
              <?php echo form_error('suburb') ? alertMsg(false,'',form_error('suburb')):'';?>
            </div>
            <!-- suburb end-->

            <!-- zip code start-->
            <div class="form-group" id="zip_code_input" style="display:none">
              <!--label for="zip_code">Zip Code</label>
                <select class="form-control" name="zip_code" id="zip_code" onchange="update_address()">

                <option  selected="true" disabled="disabled">Please select</option>
              </select-->
            </div>

            <?php  echo form_error('zip_code') ? alertMsg(false,'',form_error('zip_code')):'';?>

          </div>
          <!--zip code end-->


          <!-- address start-->
          <!--div class="form-group" id="select_address" <?php //echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>-->
          <div class="form-group" id="select_address" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>
            <label for="street_name">Street Address</label>

            <select class="form-control" name="street_name" id="street_name">
              <option  selected="true" disabled="disabled">Please select</option>


            </select>
            <?php 
            echo form_error('street_name') ? alertMsg(false,'',form_error('street_name')):'';?>

          </div>
          <!-- address end-->


          <!-- door_number start-->     
          <div class="form-group" id="select_Number"  <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>
            <label for="door_number">Door Number</label>

            <input type="number" id="door" value="<?php echo isset($user_id)? $doorNoEdit: set_value('door')?>" name="door" min="1" max="1000">
            <?php  echo form_error('door_number') ? alertMsg(false,'',form_error('door_number')):'';?>

          </div>
          <!-- door_number end-->
          <button class="btn btn-success btn-lg pull-right" type="next" >Next</button>
        </div>

      </div>

    </div>
    <div class="row setup-content" id="step-3">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>House Details</h3>
          <div class="form-group">
            <label class="control-label" for="name">Title Deed</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-user"></span></span>
              <input type="text" class="form-control" name="name" value="<?php echo isset($user_id)? $nameEdit: set_value('name')?>"    id="name" placeholder="full name" required>
            </div>
            <p><?php echo form_error('name') ? alertMsg(false,'name',form_error('name')) : ''; ?></p>

          </div>
          <div class="form-group">
            <label class="control-label" for="identitynumber">House Type</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
              <input type="text" class="form-control" name="identitynumber" value="<?php echo isset($user_id)? $identitynumberEdit: set_value('identitynumber')?>" id="identitynumber"  placeholder="identity number" required>
            </div>
            <p><?php echo form_error('identitynumber') ? alertMsg(false,'identitynumber',form_error('identitynumber')) : ''; ?></p>
          </div>
          <div class="form-group">
            <label class="control-label" for="dateofbirth">Registration Number</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
              <input type="date" class="form-control" name="dateofbirth"  id="dateofbirth" value="<?php echo isset($user_id)? $dateofbirthEdit: set_value('dateofbirth')?>"  placeholder="date of birth" required>
            </div>
            <p><?php echo form_error('dateofbirth') ? alertMsg(false,'dateofbirth',form_error('dateofbirth')) : ''; ?></p>

          </div>
          <div class="form-group">
            <label class="control-label" for="date_registration">Registration Date</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
              <input type="date" class="form-control" name="date_registration" <?php
              $currentDate = date('Y-m-d');
              echo $currentDate;
              ?>  id="date_registration" value="<?php echo isset($user_id)? $dateOfRegistrationEdit: set_value('date_registration')?>"   placeholder="date of registration" required>
            </div>
            <p><?php echo form_error('date_registration') ? alertMsg(false,'date_registration',form_error('date_registration')) : ''; ?></p>


          </div>
          <div class="form-group">
            <label class="control-label" for="phone">Purchase Price</label>
            <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
              <input type="text" class="form-control" name="phone" value="<?php echo isset($user_id)? $phoneEdit: set_value('phone')?>"   id="phone" placeholder="phone numbers" required>
            </div>
            <p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
          </div>
          <div class="form-group">
            <label class="control-label" for="phone">Purchase Date</label>
            <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
              <input type="text" class="form-control" name="phone" value="<?php echo isset($user_id)? $phoneEdit: set_value('phone')?>"   id="phone" placeholder="phone numbers" required>
            </div>
            <p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
          </div>
          <label class="control-label" for="phone">Upload Files</label>

          <div class="form-group">
            <input type="file"  class="form-inline input-lg fileToUpload" name="idUpload" id="idUpload" >  
            <p><?php echo form_error('idUpload') ? alertMsg(false,'idUpload',form_error('idUpload')) : ''; ?></p>
            <!--button class="btn btn-lg btn-warning passbtn" name="reset" type="reset" value="uploadid">upload id</button-->                  
          </div>
          <button class="btn btn-primary nextBtn btn-m pull-right" type="submit">Submit</button>
        </div>
      </div>
    </div>

  </form>

</div>

</div>

<!--script for validating stepwizard -->
<script type="text/javascript">
  $(document).ready(function ()
  {
    var navListItems = $('div.setup-panel div a'),
    allWells = $('.setup-content'),
    allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) 
    {
      e.preventDefault();
      var $target = $($(this).attr('href')),
      $item = $(this);

      if (!$item.hasClass('disabled')) 
      {
        navListItems.removeClass('btn-primary').addClass('btn-default');
        $item.addClass('btn-primary');
        allWells.hide();
        $target.show();
        $target.find('input:eq(0)').focus();
      }
    });

    allNextBtn.click(function()
    {
      var curStep = $(this).closest(".setup-content"),
      curStepBtn = curStep.attr("id"),
      nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
      curInputs = curStep.find("input[type='text'],input[type='url']"),
      isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++)
      {
        if (!curInputs[i].validity.valid)
        {
          isValid = false;
          $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
      }

      if (isValid)
        nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
  });
  
  $.ajax({
   url:"../publiczone/getAddress",
   method:"GET",
   dataType:"json",
   success:function(data)
   {
      $.each(data[province], function (i, item) 
      {
        alert(i);
        $('#province').append($('<option>', 
        { 
          value: item.id,
          text : item.name 
        }));


      });
  console.log(data['province']);
    
    
   }
  });
</script>



  


