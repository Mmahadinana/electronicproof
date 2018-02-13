<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   // $automovel_id 	= $user_data['automovel_id'] 		?? false; 
$id_province = $user_data->province_id ?? $this->input->post('province') ?? false;
$id_district= $user_data->district_id ?? $this->input->post('district') ?? false;
$id_manucipality = $user_data->manucipality_id ?? $this->input->post('manucipality') ?? false;
$id_town= $user_data->town_id ?? $this->input->post('town')?? false;

$id_suburb = $user_data->suburb_id ?? $this->input->post('suburb')?? false;
$id_address = $user_data->id ?? $this->input->post('id')?? false;
$streetName=$user_data->street_name ?? $this->input->post('street_name')?? false;
$doorNumber=$user_data->door_number ?? $this->input->post('door_number')?? false;
//**This is the registration page whereby the owner will access to register for the proof of address on the webpage**
$editmode = isset($user_id)? 'true':'false';

?>
	<div class="stepwizard col-md-offset-3">
		<div class="stepwizard-row setup-panel">
			<div class="stepwizard-step">
				<a href="#step-1" type="button" class="btn btn-primary btn-default btn-circle"  ><i class="fa fa-lock" aria-hidden="true"></i></a>
				<p>Account</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-2" type="button" class="btn btn-default btn-circle" <?= isset($user_id)?'':'disabled="disabled"' ?>><i class="fa fa-user" aria-hidden="true"></i></a>
				<p>Personal</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-3" type="button" class="btn btn-default btn-circle" <?= isset($user_id)? '' :'disabled="disabled"'?>><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
				<p>Address</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-4" type="button" class="btn btn-default btn-circle" <?= isset($user_id)? '' :'disabled="disabled"'?>><i class="fal fa-binoculars"></i></a>
				<p>Output</p>
			</div>

		</div>
	</div>
<div class="container form-area"> 

	<div>	
	<?php 
	$action=isset($user_id)? "publiczone/editUser": "publiczone/register";

	echo form_open($action,array('class'=>'form-horizontal col-md-offset-2 col-md-8',' autocomplete'=>'off',"method"=>"POST"));
	?>

	<input <?php echo isset($user_id)? "value='$user_id'":"value='0'";?> id='userid' type='hidden' name='userid'>
	<!--input <?php echo isset($user_id1)? "value='$user_id1'":"value='0'";?> id='userid' type='hidden' name='userid'-->



	<!--setup Account>
	<form role="form" action="" id="data" method="post" onSubmit="alert('Successfully Registered.');"-->
		<div class="row setup-content" id="step-1" style="display: block;" >
			<h1>Setup Account</h1>
			<div class="col-xs-6 col-md-offset-3">
				<div class="col-md-12">
					
					<div class="form-group">
						<label for="email">email</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
							<input type="email" class="form-control" name="email" id="email" value="<?php echo isset($user_id)? $emailEdit: set_value('email')?>" placeholder="Requested email"  required>
						</div>
						<p><?php echo form_error('email') ? alertMsg(false,'email',form_error('email')) : ''; ?></p>


					</div>
					<div <?php echo  isset($user_id)? "class='hidden'" : "class='form-group '"?>>
						<label for="newpassword">Password</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							<input <?php echo  isset($user_id)? "disabled" : ""?>  type="password" class="form-control" name="password"   id="newpassword" placeholder="Password" required data-toggle="popover" title="Password Strength" data-content="Enter Password...">
						</div>
						<p id="results"><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>

					</div>


					<div <?php echo  isset($user_id)? "class='hidden'" : "class='form-group '"?>>
						<label for="confirmpass">Confirm Password</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							<input <?php echo  isset($user_id)? "disabled" : ""?>  type="password" class="form-control" name="confirm" id="confirmpass" placeholder="Confirm Password" required>
						</div>
						<p id='CheckPasswordMatch'><?php echo form_error('confirm') ? alertMsg(false,'confirm',form_error('confirm')) : ''; ?></p>
					</div>
					

					<button class="btn btn-primary nextBtn btn-m pull-right" id="setup" name="setup">Next</button>
				</div>
			</div>
		</div>

		<div class="row setup-content" id="step-2" style="display: none;">
			<h1>Personal Information</h1>
			<div class="col-xs-6 col-md-offset-3">
				<div class="col-md-12">
					
					<div class="form-group">
						<label class="control-label" for="name">Full Name</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-user"></span></span>
							<input type="text" class="form-control" name="name" value="<?php echo isset($user_id)? $nameEdit: set_value('name')?>"    id="name" placeholder="full name" required>
						</div>
						<p id="name"><?php echo form_error('name') ? alertMsg(false,'name',form_error('name')) : ''; ?></p>
						<p id="demo"></p>

					</div>
					<div class="form-group">
						<label class="control-label" for="dateofbirth">Date of Birth</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
							
							<input type="date" class="form-control" name="dateofbirth"  id="dateofbirth" value="<?php echo isset($user_id)? $dateofbirthEdit: set_value('dateofbirth')?>"  placeholder="date of birth" required>
						</div>
						<p><?php echo form_error('dateofbirth') ? alertMsg(false,'dateofbirth',form_error('dateofbirth')) : ''; ?></p>
					</div>

					<div class="form-group">
						<label class="control-label" for="identitynumber">Identity Number</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
							<input type="text" class="form-control" name="identitynumber" value="<?php echo isset($user_id)? $identitynumberEdit: set_value('identitynumber')?>" id="identitynumber"  placeholder="identity number" required>
						</div>
						<p id="id_results"><?php echo form_error('identitynumber') ? alertMsg(false,'identitynumber',form_error('identitynumber')) : ''; ?></p>
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
						<p id="phone_results"><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
					</div>
					<label  id ="gender" class="control-label">Gender</label>

					<div class="form-group" id="gender">
						
						<?php if (isset($user_id))
						//is in edit mode-editing and updating user information
						{?>
						<label class="radio-inline" for="male">Male</label>
						<input  name="gender" id="male" type="radio" value="1" <?php echo ($gender_id == 1) ? 'checked':''; ?> />						
						<label class="radio-inline" for="female">Female</label>
						<input  name="gender" id="female" type="radio" value="2" <?php echo ($gender_id == 2) ? 'checked':''; ?> />
					<?php }else {
						//is on create or add mode- creating new user
						?>
						<label class="radio-inline" for="male">Male</label>
						<input  name="gender" id="male" type="radio" value="1" <?php echo set_radio('gender', '1',true); ?> />						
						<label class="radio-inline" for="female">Female</label>
						<input  name="gender" id="female" type="radio" value="2" <?php echo  set_radio('gender', '2'); ?> />
					<?php }?>
						
						
						
						<p class="gender"><?php echo form_error('gender') ? alertMsg(false,'gender',form_error('gender')) : ''; ?></p>

					</div>
					<button class="btn btn-primary nextBtn btn-m pull-right" id="personal" name="personal">Next</button>
				</div>
			</div>
		</div>




		<div class="row setup-content" id="step-3" style="display: none;">
			<h1>User Address</h1>
			<div class="col-xs-6 col-md-offset-3">
				<div class="col-md-12">
					
					<!-- Province start-->
					<div class="form-group">

						<label for="province">Province</label>
						<select class="form-control" name="province" id="province" onchange ="update_distric()" required >
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
						</select><span class="select"></span>
						<?php  echo form_error('province') ? alertMsg(false,'',form_error('province')):'';?>
					</div>
					<!-- Province end-->

					<!-- District start-->
					<div class="form-group" id="select_district" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

						<label for="district">District</label>

						<select class="form-control"  name="district" id="district" onchange="update_manucipality()"></select><span class="select"></span>
						<?php  echo form_error('district') ? alertMsg(false,'',form_error('district')):'';?>
					</div>
					<!-- District end--> 

					<!-- manucipality start-->
					<div class="form-group" id="select_manucipality" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>						
						<label for="manucipality">Manucipality</label>
						<select class="form-control" name="manucipality" id="manucipality" onchange="update_town()" required></select><span class="select"></span>
						<?php  echo form_error('manucipality') ? alertMsg(false,'',form_error('manucipality')):'';?>
					</div>
					<!-- manucipality end-->

					<!-- town start-->

					<div class="form-group" id="select_town" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

						<label for="town">Town</label>
						<select class="form-control" name="town" id="town" onchange="update_suburb()">
							<option  selected="true" disabled="disabled">Please select</option>
						</select><span class="select"></span>
						<?php  echo form_error('town') ? alertMsg(false,'',form_error('town')):'';?>
					</div>
					<!-- town end-->

					<!-- suburb start-->
					<div class="form-group" id="select_suburb" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

						<label for="suburb">Suburb</label>
						<select class="form-control" name="suburb" id="suburb" onchange="update_address()" required></select><span class="select"></span>
						<?php echo form_error('suburb') ? alertMsg(false,'',form_error('suburb')):'';?>
					</div>
					<!-- suburb end-->

					<!-- zip code start-->
					<div class="form-group" id="zip_code_input" style="display:none">

						<?php  echo form_error('zip_code') ? alertMsg(false,'',form_error('zip_code')):'';?>

					</div>
					<!--zip code end-->


					<!-- address start-->
					<!--div class="form-group" id="select_address" <?php //echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>-->
					<div class="form-group" id="select_address" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>
						<label for="street_name">Street Address</label>

						<select class="form-control" name="street_name" id="street_name" required>
							<option  selected="true" disabled="disabled">Please select</option>
						</select><span class="select"></span>
						<?php 
						echo form_error('street_name') ? alertMsg(false,'',form_error('street_name')):'';?>

					</div>
					<!-- address end-->


					<!-- door_number start-->			
					<div class="form-group" id="select_Number" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>
						<label for="door_number">Door Number</label>

						<select class="form-control" name="door_number" id="door_number" required>
							<option  selected="true" disabled="disabled">Select door number</option>
						</select><span class="select"></span>
						<?php 
						echo form_error('door_number') ? alertMsg(false,'',form_error('door_number')):'';?>

					</div>
					
					<button id="lasbtnsubmit"  class="btn btn-primary nextBtn" >Submit</button>
					

				</div>
			</div>
		</div>
		<div class="row setup-content" id="step-4" style="display: none;">
			<h1>Details Preview</h1>
			<div class="col-lg-10col-md-offset-3">
				<div class="col-md-12 h5" >
					<table class="table">
						<thead>
							<tr class="warning h4 text-danger">
								<td>Title</td>
								<td>Your Information</td>
							</tr>
						</thead>
						<tbody id="output">

						</tbody>
					</table>
				</div>				
			</div>
			<div class="col-lg-3 pull-right">
				<button id="submit"  class="btn btn-primary " >Submit</button>
			</div>
		</div>
	</form>
</div>

<!--script for validating stepwizard -->

<script type="text/javascript">
	$(document).ready(function (){
		//stores the Id of the inputs temporarely
		var inputattr=[];
		//stores the ID that is going to be diplayed
		var lastoutput=[];
		//stores the value that should be diplayed
		var outputval=[];
		//hold the values to be displayed temporaly
		var outputattr=[];
		
		var navListItems = $('div.setup-panel div a'),
		allWells = $('.setup-content'),
		allNextBtn = $('.nextBtn');		
		allWells.hide();
		//show the step when we load the 		
		$('#step-1').show();
		navListItems.click(function (e) 
		{
			e.preventDefault();
			var $target = $($(this).attr('href'));
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
		//controlls the next step
		allNextBtn.click(function(e)
		{
			var curStep = $(this).closest(".setup-content"),
			curStepBtn = curStep.attr("id"),
			nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
			curInputs = curStep.find("input[type='text'],input[type='password'],input[type='date'],input[type='radio'],input[type='email'],select"),
			isValid = true;
			//console.log(nextStepWizard);
			//console.log(curStepBtn);
			
			var editMode = <?=$editmode?>;
			//for the edit user
			if(editMode){
				if (!curInputs[0].validity.valid){
					isValid = false;
					$(curInputs[i]).closest(".form-group").addClass("has-error");
				}
			}else{
				for(var i=0; i<curInputs.length; i++){
					//console.log($(curInputs[i]).attr('id'));
					//console.log($('#'+$(curInputs[2]).attr('id')).val());
					if ($(curInputs[1]).attr('id')== 'newpassword' || $(curInputs[2]).attr('id')== 'confirmPassword') {

						if($('#'+$(curInputs[1]).attr('id')).val() != $('#'+$(curInputs[2]).attr('id')).val()){
							isValid = false;
							$(curInputs[i]).closest(".form-group").addClass("has-error");
						}
					}
					if ($('#'+$(curInputs[i]).attr('id')).val()== null || $('#'+$(curInputs[i]).attr('id')).val()==0) {
							isValid = false;
							$(curInputs[i]).closest(".form-group").addClass("has-error");
							$('.select').text('You must select an option').addClass('text-danger');
					}					
										
					//are the inputs filled with data
					if (!curInputs[i].validity.valid)
					{
						isValid = false;
						$(curInputs[i]).closest(".form-group").addClass("has-error");
					}
					//check if there are any error in the inputs
					if ($(curInputs[i]).parent().hasClass("has-error")){

						isValid = false;
					}
					//storing values and data of the current input steps
					outputval[i]=$('#'+$(curInputs[i]).attr('id')).val();
					inputattr[i]=$(curInputs[i]).attr('id');									
				}//end forloop validation
			}
			if (isValid){				
				//variable storing the values of the inputs
				var view='';
				//variable temporarely store inputs to be displayed
				var tempattr='';
		
				//collecting data dispayed later from each step
				//step 1
					if((curStepBtn) == 'step-1'){					
						for (var i = outputval.length - 1; i >= 0; i--) {
							view +=outputval[i]+'#$';
							tempattr +=inputattr[i]+' ';			
						}//end forloop

						//saving the results;
						lastoutput +=view;
						outputattr +=tempattr;
					}//end if step 1

					//step 2
					if((curStepBtn) == 'step-2'){					
						for (var i = outputval.length - 1; i >= 0; i--) {
							// elimination radio input that is not cheched	
							if ((($(curInputs[i]).attr('checked')) !='checked') && (($(curInputs[i]).attr('type'))=='radio')) continue; 
							//end if
							
							view +=outputval[i]+'#$';
							tempattr +=inputattr[i]+' ';				
						}//end forloop

						//saving the results;				
						lastoutput +=view;
						outputattr +=tempattr;
					}//end if step 2

					//Step 3 
					if((curStepBtn) == 'step-3'){					
						for (var i = outputval.length - 1; i >= 0; i--) {
							//checking if it is select option
							if($(curInputs[i]).prop('type') == 'select-one' ){
								//storing selected option					

							outputval[i]=$(curInputs[i]).children().filter(':selected').text();
							
							}//end if

						view +=outputval[i]+'#$';								
						tempattr +=inputattr[i]+' ';

						}//end forloop

						//saving the results;
						lastoutput +=view;
						outputattr +=tempattr;						
					
						//convert string into array
						lastoutput=lastoutput.split("#$");					
						outputattr=outputattr.split(" ");

						//cutting off passwords					
						lastoutput.pop(lastoutput.splice(0,2));
						outputattr.pop(outputattr.splice(0,2));
						$("#output").empty();
						//print inputs for view on html
						for (var i = 0; i < lastoutput.length; i++) {
							outputattr[i]=(outputattr[i].substr(0,1)).toUpperCase() + outputattr[i].substr(1);
							//output on the html tag div
							$("#output").append("<tr>","<td><b>"+outputattr[i]+"</b> </td> \n <td class='info'> "+lastoutput[i]+"</td></tr>");
							//$("#output .table").children();
							$("#output").has('tr').addClass('table table-dark table-striped text-success');

						}//end forloop		
				}//end if step 3		
				
				//go to next wizard step
				nextStepWizard.removeAttr('disabled').trigger('click');
			}
			
			e.preventDefault();	
		});		
});

function myFunction() {
		var inpObj = document.getElementById("name");
		if (!inpObj.checkValidity()) {
			document.getElementById("demo").innerHTML = inpObj.validationMessage;
		} else {
			document.getElementById("demo").innerHTML = "Input OK";
		} 
	} 

/************************ getting the district through the province id********************/
function update_distric() 
	{
		//bring all the districts from php to javascript
		let district 		= <?php echo json_encode($districts);?>;	
		//if in edit mode asssigns the model id if on insert assigns false
		let id_district		= <?php echo $id_district ? $id_district : 'false' ?>; 
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
		$.each(manucipality[selected], function (i, item){

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
/*get address by surbub id*/	
function update_address()
{
		//bring all the districts from php to javascript
		let address= <?php echo json_encode($address);?>;
		let id_address= <?php echo $id_address ? $id_address : 'false'; ?>; 

		//select box from the ditrict
		let address_id =$("#street_name");
		let door_number =$("#door_number");
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

		$("#street_name select option[value='0']").attr("disabled","disabled");
		$.each(address[selected], function (i, item) 
		{
			address_id.append($('<option>', 
			{ 
				value: item.street_name,
				text : item.street_name 
			}));
			door_number.append($('<option>', 
			{ 
				value: item.id,
				text : item.door_number 
			}));
		});
		if(id_address)
		{	
			$("#select_address select").val(id_address);
		}
		else{
			
			$("#select_address select").val(0);
			$("#select_Number selected").val(0);
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


