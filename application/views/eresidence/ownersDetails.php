<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<<<<<<< HEAD
<div class="container ">
=======
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
>>>>>>> 054165ab82fe96573c260c4ff739a246cf319fb1

  <h1>Owners Information</h1>

  <?php
//var_dump($user_addinfor);
//echo $_SESSION['id'];
  $action="residents/details/";

  echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data'));?>

 <div class="form-area5">
    <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>
      <div class="col-xs-6 col-md-offset-4">
        <div class="col-md-12">
     

          <div class="form-group" >
            <label class="control-label" for="title_deed">Title Deed</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-address-card-o"></span></span>
              <input type="text" class="form-control" name="title_deed" value="<?php echo isset($user_id)? $title_deedEdit: set_value('title_deed')?>"   id="title_deed" placeholder="title deed" required>
            </div>
            <p><?php echo form_error('title_deed') ? alertMsg(false,'title_deed',form_error('title_deed')) : ''; ?></p>
          </div>
          <div class="form-group">
            <label class="control-label" for="registration_number">Registration Number</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-registered"></span></span>
              <input type="text" class="form-control" name="registration_number" value="<?php echo isset($user_id)? $registration_numberEdit: set_value('registration_number')?>"   id="registration_number" placeholder="registreation no." required>
            </div>
            <p><?php echo form_error('registration_number') ? alertMsg(false,'registration_number',form_error('registration_number')) : ''; ?></p>
          </div>
          <div class="form-group">
            <label class="control-label" for="purchase_price">Purchase Price</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-money"></span></span>
              <input type="text" class="form-control" name="purchase_price" value="<?php echo isset($user_id)? $purchase_priceEdit: set_value('purchase_price')?>"   id="purchase_price" placeholder="purchase price" required>
            </div>
            <p><?php echo form_error('purchase_price') ? alertMsg(false,'purchase_price',form_error('purchase_price')) : ''; ?></p>
          </div>


          <div class="form-group">
              <label class="control-label" for="purchase_date">Purchase Date</label>
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
                <input type="date" class="form-control" name="purchase_date"  id="purchase_date" value="<?php echo isset($user_id)? $purchase_dateEdit: set_value('purchase_date')?>"  placeholder="purchase_date" required>
              </div>
              <p><?php echo form_error('purchase_date') ? alertMsg(false,'purchase_date',form_error('purchase_date')) : ''; ?></p>

            </div>
            <div class="form-group">
            <label class="control-label" for="house_type">House Type</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
              <input type="text" class="form-control" name="house_type" value="<?php echo isset($user_id)? $house_typeEdit: set_value('house_type')?>"   id="house_type" placeholder="house_type" required>
            </div>
            <p><?php echo form_error('house_type') ? alertMsg(false,'house_type',form_error('house_type')) : ''; ?></p>
          </div>
          
          
          <button class="btn btn-primary nextBtn btn-m pull-right" id="address" name="address">Submit</button>

        </div>
      </div>
<<<<<<< HEAD
    </div>
=======
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



  


>>>>>>> 054165ab82fe96573c260c4ff739a246cf319fb1
