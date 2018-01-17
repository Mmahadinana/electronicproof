<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   // $automovel_id 	= $user_data['automovel_id'] 		?? false; 
$id_province = $user_data->province_id ?? $this->input->post('province') ?? false;
$id_district= $user_data->district_id ?? $this->input->post('district') ?? false;
$id_manucipality = $user_data->manucipality_id ?? $this->input->post('manucipality') ?? false;
$id_town= $user_data->town_id ?? $this->input->post('town')?? false;

$id_suburb = $user_data->suburb_id ?? $this->input->post('suburb')?? false;
$id_address = $user_data->id ?? $this->input->post('street_name')?? false;
$streetName=$user_data->street_name ?? $this->input->post('street_name')?? false;
//**This is the registration page whereby the owner will access to register for the proof of address on the webpage**
?>
<div class="container form-area">

	<h1 ><?php echo $pageTitle;

		if(isset($statusEdit))
		{
			echo alertMsg($statusEdit,'User Added','User Not Added'); 
		}
		?></h1>


		<?php 


		$action=isset($user_id)? "publiczone/editUser/$user_id": "publiczone/registerUser";

		echo form_open($action,array('class'=>'form-horizontal col-md-offset-2 col-md-8',' autocomplete'=>'off'));
		?>

		<input <?php echo isset($user_id)? "value='$user_id'":"value='0'";?> id='userid' type='hidden' name='userid'>
		<input <?php echo isset($user_id1)? "value='$user_id1'":"value='0'";?> id='userid' type='hidden' name='userid'>


		<div class="stepwizard col-md-offset-4">
			<div class="stepwizard-row setup-panel">
				<div class="stepwizard-step">
					<a href="#step-1" type="button" class="btn btn-primary btn-circle"  ><i class="fa fa-lock" aria-hidden="true"></i></a>
					<p>Step 1</p>
				</div>
				<div class="stepwizard-step">
					<a href="#step-2" type="button" class="btn btn-default btn-circle" <?= isset($user_id)?'':'disabled="disabled"' ?>><i class="fa fa-user" aria-hidden="true"></i></a>
					<p>Step 2</p>
				</div>
				<div class="stepwizard-step" id="step-3" style="display:none">
					<a href="#step-3" type="button" class="btn btn-default btn-circle" <?= isset($user_id)?'':'disabled="disabled"'?>><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
					<p>Step 3</p>
				</div>
				<div class="stepwizard-step" >
					<a href="#step-4" type="button" class="btn btn-default btn-circle" <?= isset($user_id)?'':'disabled="disabled"'?>><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
					<p>Step 4</p>
				</div>

			</div>
		</div>
		<form role="form" action="" id="data" method="post">
			<div class="row setup-content" id="step-1">
				<div class="col-xs-6 col-md-offset-4">
					<div class="col-md-12">
						<h3>Setup Account</h3>
						<div class="form-group">
							<label for="email">email</label>
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
								<input type="email" class="form-control" name="email" id="email" value="<?php echo isset($user_id)? $emailEdit: set_value('email')?>" placeholder="Requested email"  required>
							</div>
							<p><?php echo form_error('email') ? alertMsg(false,'email',form_error('email')) : ''; ?></p>


						</div>
						<div <?php echo  isset($user_id)? "class='hidden'" : "class='form-group '"?>>
							<label for="password">Password</label>
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control" name="password"   id="password" placeholder="Password" onblur="validatePassword" required data-toggle="popover" title="Password Strength" data-content="Enter Password...">
							</div>
							<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>

						</div>


						<div <?php echo  isset($user_id)? "class='hidden'" : "class='form-group '"?>>
							<label for="confirm">Confirm Password</label>
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-resize-vertical"></span></span>
								<input type="password" class="form-control" name="confirm" onblur="validatePassword"  id="confirm" placeholder="Confirm Password" required>
							</div>
							<p><?php echo form_error('confirm') ? alertMsg(false,'confirm',form_error('confirm')) : ''; ?></p>
						</div>
						<label  id ="gender" class="control-label">Role</label>

						<div class="form-group">

							<input  name="gender" type="radio" name="tab" value="ABC" id="radio0" >
							<label for="radio10">Owner</label>
						</div>

						<div class="form-group">
							<input  name="gender" type="radio" name="tab" value="PQR" checked>
							<label for="radio1">Resident</label>
							<p><?php echo form_error('gender') ? alertMsg(false,'gender',form_error('gender')) : ''; ?></p>

						</div>
						<button class="btn btn-primary nextBtn btn-m pull-right" id="setup" name="setup" onclick="validatePassword"  >Next</button>
					</div>
				</div>
			</div>

			<div class="row setup-content" id="step-2">
				<div class="col-xs-6 col-md-offset-4">
					<div class="col-md-12">
						<h3>Personal Information</h3>
						<div class="form-group">
							<label class="control-label" for="name">Full Name</label>
							<div class="input-group"> <span class="input-group-addon"><span class="fa fa-user"></span></span>
								<input type="text" class="form-control" name="name" value="<?php echo isset($user_id)? $nameEdit: set_value('name')?>"    id="name" placeholder="full name" required>
							</div>
							<p><?php echo form_error('name') ? alertMsg(false,'name',form_error('name')) : ''; ?></p>

						</div>
						<div class="form-group">
							<label class="control-label" for="identitynumber">Identity Number</label>
							<div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
								<input type="text" class="form-control" name="identitynumber" value="<?php echo isset($user_id)? $identitynumberEdit: set_value('identitynumber')?>" id="identitynumber"  placeholder="identity number" required>
							</div>
							<p><?php echo form_error('identitynumber') ? alertMsg(false,'identitynumber',form_error('identitynumber')) : ''; ?></p>
						</div>
						<div class="form-group">
							<label class="control-label" for="dateofbirth">Date of Birth</label>
							<div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
								<input type="date" class="form-control" name="dateofbirth"  id="dateofbirth" value="<?php echo isset($user_id)? $dateofbirthEdit: set_value('dateofbirth')?>"  placeholder="date of birth" required>
							</div>
							<p><?php echo form_error('dateofbirth') ? alertMsg(false,'dateofbirth',form_error('dateofbirth')) : ''; ?></p>

						</div>


						<div class="form-group">

							<input type="hidden" class="form-control" name="date_registration"  id="date_registration" value="<?php echo isset($user_id)? $dateOfRegistrationEdit: date('Y-m-d')?>"   placeholder="date of registration" required>
							
							<p><?php echo form_error('date_registration') ? alertMsg(false,'date_registration',form_error('date_registration')) : ''; ?></p>


						</div>
						<div class="form-group">
							<label class="control-label" for="phone">Phone number</label>
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
								<input type="text" class="form-control" name="phone" value="<?php echo isset($user_id)? $phoneEdit: set_value('phone')?>"   id="phone" placeholder="phone numbers" required>
							</div>
							<p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
						</div>
						<label  id ="gender" class="control-label">Gender</label>

						<div class="form-group">

							<input  name="gender" type="radio" value="1" id="radio100" onclick="show1();">
							<label for="radio100">Male</label>
						</div>

						<div class="form-group">
							<input  name="gender" type="radio" value="2" id="radio101"  checked>
							<label for="radio101">Female</label>
							<p><?php echo form_error('gender') ? alertMsg(false,'gender',form_error('gender')) : ''; ?></p>

						</div>
						
						<button class="btn btn-primary nextBtn btn-m pull-right" id="personal" name="personal">Next</button>

					</div>

				</div>
			</div>


			<div class="row setup-content" id="step-3">
			<div class="col-xs-6 col-md-offset-4">
				<div class="col-md-12">
					<h3 >Owners Information</h3>
					<div class="form-group">
						<label class="control-label" for="phone">Title Deed</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-address-card-o"></span></span>
							<input type="text" class="form-control" name="phone" value="<?php echo isset($user_id)? $phoneEdit: set_value('phone')?>"   id="phone" placeholder="title deed" required>
						</div>
						<p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
					</div>
					<div class="form-group">
						<label class="control-label" for="phone">House Type</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-home"></span></span>
							<input type="text" class="form-control" name="phone" value="<?php echo isset($user_id)? $phoneEdit: set_value('phone')?>"   id="phone" placeholder="house type" required>
						</div>
						<p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
					</div>
					<div class="form-group">
						<label class="control-label" for="phone">Registration Number</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-registered"></span></span>
							<input type="text" class="form-control" name="phone" value="<?php echo isset($user_id)? $phoneEdit: set_value('phone')?>"   id="phone" placeholder="registreation no." required>
						</div>
						<p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
					</div>
					<div class="form-group">
						<label class="control-label" for="phone">Purchase Price</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-money"></span></span>
							<input type="text" class="form-control" name="phone" value="<?php echo isset($user_id)? $phoneEdit: set_value('phone')?>"   id="phone" placeholder="purchase price" required>
						</div>
						<p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
					</div>

					<div class="form-group">
						<label class="control-label" for="phone">Purchase Date</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
							<input type="text" class="form-control" name="phone" value="<?php echo isset($user_id)? $phoneEdit: set_value('phone')?>"   id="phone" placeholder="purchase date" required>
						</div>
						<p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
					</div>
					<div class="form-group col-lg-12 ">
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
					</div>
					<button class="btn btn-primary nextBtn btn-m pull-right" id="address" name="address">Next</button>

				</div>
			</div>
		</div>



			<div class="row setup-content" id="step-4">
				<div class="col-xs-6 col-md-offset-4">
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
					<button class="btn btn-success btn-lg pull-right" id="submit" name="submit" type="submit" >Submit</button>

				</div>
			</div>
		</div>

		


</form>

</div>

<!-------script for show/hide div on radio button------>

<script type="text/javascript">
$('input[type="radio"]').click(function(){
        if($(this).attr("value")=="PQR"){
            $("#step-3").hide('slow');
        }
        if($(this).attr("value")=="ABC"){
            $("#step-3").show('slow');

        }        
    });
$('input[type="radio"]').trigger('click');
</script>



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

		allNextBtn.click(function(e)
		{
			
			var curStep = $(this).closest(".setup-content"),
			curStepBtn = curStep.attr("id"),
			nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
			curInputs = curStep.find("input[type='text'],input[type='password'],input[type='url'],input[type='email']"),
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

			if (isValid){
				nextStepWizard.removeAttr('disabled').trigger('click');
			}
			e.preventDefault();	
		});

		$('div.setup-panel div a.btn-primary').trigger('click');
	});

</script>


<script> 
	var errors = false;
    /**
     * checks if the input name has only letters
     * 
     */
     $('#name').on('input',function()
     {
        //the input that called the function
        var input = $(this);
       //gets the value of the input
       var current_name = input.val();
       //regex to only allow leters for the name
       var regex = /^[a-zA-Z\s]+$/;
       //check the parent of the input to change the class latter
       var parent = input.parent();
       //check if the input has only letters if has
       if (regex.test(current_name))
       {
        //removes the class has errors from the input parent
        parent.removeClass('has-error'); 
         //adds the class has success to the input parent
         parent.addClass('has-success');
         errors = false;  
     } 
       else {//if not
       	var parent = input.parent();
         //removes the class has success from the input parent
         parent.removeClass('has-success');
         //adds the class has errors to the input parent
         parent.addClass('has-error');
         errors = true;
     }
 });
/**
 * checks if the email has the correct syntax eg: asdfdsf@fds.sdsd
 * 
 */
 $("#email").on('input',function () 
 {
        //the input that called the function
        var input =$(this);
       //the value of the email input
       var current_email = input.val();
       //the regex to check if the email is valid
       var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
       
       var email_registed = ["mail@example.com"];
       //check the parent of the input to change the class latter
       var parent = input.parent();
       //checks if the email corresponds with the regex and diferent of email_registed
       if (regex.test(current_email) && ($.inArray(current_email, email_registed))!=0)
       {
        //removes the class has errors from the input parent
        parent.removeClass('has-error');  
         //adds the class has success to the input parent
         parent.addClass('has-success');  
         errors = false;
     } 
     else {
     	var parent = input.parent();
         //removes the class has success from the input parent
         parent.removeClass('has-success');
         //adds the class has errors to the input parent
         parent.addClass('has-error');
         errors = true;

     }
 });


</script>

<script>


	/************************ getting the district through the province id********************/
	function update_distric() 
	{
	//bring all the districts from php to javascript
	let district 		= <?php echo json_encode($districts);?>;
	console.log(district);
//if in edit mode asssigns the model id if on insert assigns false
let id_district		= <?php echo $id_district ? $id_district : 'false' ?>; 
console.log(id_district	);

	//select box from the ditrict
	let district_id =$("#district");
		//province id from the select box of the provinces
		let selected  		= $("#province").val();

	//clear prev options
	district_id.empty();
//write new options
district_id.append($('<option>',
{ 
	value: 0,
	text : "select district" 
}));
$("#district select option[value='0']").attr("disabled","disabled");
$.each(district[selected], function (i, item) 
{
	district_id.append($('<option>', 
	{ 
		value: item.id,
		text : item.name 

	}));

});
//select the option of the edit mode
if(id_district)
{
	$("#select_district select").val(id_district);
}
else{
	$("#select_district select").val(0);
}
	//dispaly the select box
	$("#select_district").attr('style','display:block');
}
$( document ).ready(function() 
{
	update_distric() ;
});


/*get municipali by distric id*/	
function update_manucipality()
{
	//bring all the districts from php to javascript
	let manucipality 		= <?php echo json_encode($manucipalities);?>;
	let id_manucipality		= <?php echo $id_manucipality ? $id_manucipality : 'false' ?>; 
	
	
//select box from the ditrict
let manucipality_id =$("#manucipality");
		//province id from the select box of the provinces
		let selected  		= $("#district").val();
		
	//clear prev options
	manucipality_id.empty();
	//write new options
	manucipality_id.append($('<option>', 
	{ 
		value: 0,
		text : "select manucipality" 
	}));
	$("#manucipality select option[value='0']").attr("disabled","disabled");
	$.each(manucipality[selected], function (i, item)
	{

		manucipality_id.append($('<option>', 
		{ 
			value: item.id,
			text : item.name 
		}));
	});
//select the option of the edit mode
if(id_manucipality)
{
	$("#select_manucipality select").val(id_manucipality);
}
else{
	$("#select_manucipality select").val(0);
}
	//dispaly the select box
	$("#select_manucipality").attr('style','display:block');
}
$( document ).ready(function()
{
	update_manucipality() ;

});

/**get town by municipality id**/

function update_town()
{
	//bring all the districts from php to javascript
	let town= <?php echo json_encode($towns);?>;
	let id_town= <?php echo $id_town ? $id_town : 'false'; ?>; 
	console.log(town);
	
//select box from the ditrict
let town_id =$("#town");
		//province id from the select box of the provinces
		let selected= $("#manucipality").val();
		
	//clear prev options
	town_id.empty();
//write new options
town_id.append($('<option>', 
{ 
	value: 0,
	text : "select town" 
}));
$("#town select option[value='0']").attr("disabled","disabled");
$.each(town[selected], function (i, item) 
{
	
	town_id.append($('<option>', 
	{ 
		value: item.id,
		text : item.name 
	}));
});
if(id_town){
	$("#select_town select").val(id_town);
}
else{
	$("#select_town select").val(0);
}
	//dispaly the select box
	$("#select_town").attr('style','display:block');

}
$( document ).ready(function() 
{
	update_town();
});

/**get town by municipality id**/

function update_suburb()
{
	//bring all the districts from php to javascript
	let suburb= <?php echo json_encode($suburbs);?>;
	let id_suburb= <?php echo $id_suburb ? $id_suburb : 'false'; ?>; 
	console.log(suburb);
	
//select box from the ditrict
let suburb_id =$("#suburb");

		//province id from the select box of the provinces
		let selected= $("#town").val();
		
	//clear prev options
	suburb_id.empty();
//write new options
suburb_id.append($('<option>', 
{ 
	value: 0,
	text : "select suburb" 
}));
$("#suburb select option[value='0']").attr("disabled","disabled");
$.each(suburb[selected], function (i, item) 
{
	$("#zip_code_input").empty();
	$("#zip_code_input").append($('<input>', 
	{ 

		placeholder: item.zip_code,

	}));
	item.zip_code;
	suburb_id.append($('<option>', { 
		value: item.id,
		text : item.name 
	}));
	
});
	//select the option of the edit mode
	if(id_suburb)
	{
		$("#select_suburb select").val(id_suburb);
	}
	else{
		$("#select_suburb select").val(0);
	}
	//dispaly the select box
//console.log(towninput);
$("#zip_code_input").attr('style','display:block');
$("#select_suburb").attr('style','display:block');

}
$( document ).ready(function() 
{
	update_suburb();
});


function update_address()
{
	//bring all the districts from php to javascript
	let address= <?php echo json_encode($address);?>;
	let id_address= <?php echo $id_address ? $id_address : 'false'; ?>; 

//select box from the ditrict
let address_id =$("#street_name");
		//province id from the select box of the provinces
		let selected= $("#suburb").val();

	//clear prev options
	address_id.empty();
//write new options
address_id.append($('<option>', 
{ 
	value: 0,
	text : "select street_name" 
}));
console.log(address);
$("#street_name select option[value='0']").attr("disabled","disabled");
$.each(address[selected], function (i, item) 
{
	address_id.append($('<option>', 
	{ 
		value: item.id,
		text : item.street_name 
	}));


});
if(id_address)
{	
	$("#select_address select").val(id_address);
}
else{
	
	$("#select_address select").val(0);
}
	//dispaly the select box
	$("#select_address").attr('style','display:block');
	$("#select_Number").attr('style','display:block');
}
$( document ).ready(function()
{
	update_address();
});


</script>






<!-- validatin for password-->
</script>
<script type="text/javascript">
	var password = document.getElementById("password")
	, confirm = document.getElementById("confirm");

	function validatePassword()
	{
		if(password.value != confirm.value) 
		{
			confirm.setCustomValidity("Passwords Don't Match");
		}
		else 
		{
			confirm.setCustomValidity('');
		}
	}

	password.onchange = validatePassword;
	confirm.onkeyup = validatePassword;
</script>

