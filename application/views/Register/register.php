<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//var_dump($manucipality);
?>


<div class="container form-area">
	
	<?php
 //var_dump($user_id) ;
	$action="publiczone/register/";

	echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data'));?>

	<div class="stepwizard col-md-offset-3">
		<div class="stepwizard-row setup-panel">
			<div class="stepwizard-step">
				<a href="#step-1" type="button" class="btn btn-primary btn-circle"><i class="fa fa-lock" aria-hidden="true"></i></a>
				<p>Step 1</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-user" aria-hidden="true"></i></a>
				<p>Step 2</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
				<p>Step 3</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-home" aria-hidden="true"></i></a>
				<p>Step 4</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-file-text" aria-hidden="true"></i></a>
				<p>Step 5</p>
			</div>
		</div>
	</div>



	<form role="form" action="" method="post">
		<div class="row setup-content" id="step-1">
			<div class="col-xs-6 col-md-offset-3">
				<div class="col-md-12">
					<h3>Setup Account</h3>
					<div class="form-group">
						<?php echo form_error('email') ? alertMsg(false,'',form_error('email')):'';?>
						<label>email</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>

							<input type="text" class="form-control" name="email" id="email" placeholder="Requested email" required >
						</div>
					</div>
					<div class="form-group">
						<?php echo form_error('password') ? alertMsg(false,'',form_error('password')):'';?>
						<label>Password</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" required data-toggle="popover" title="Password Strength" data-content="Enter Password...">
						</div>
					</div>
					<div class="form-group">
						<?php echo form_error('confirm') ? alertMsg(false,'',form_error('confirm')):'';?>
						<label>Confirm Password</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-resize-vertical"></span></span>
							<input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm Password" required>
						</div>
					</div>
					<button class="btn btn-primary nextBtn btn-m pull-right" type="button">Next</button>
				</div>
			</div>
		</div>
		<div class="row setup-content" id="step-2">
			<div class="col-xs-6 col-md-offset-3">
				<div class="col-md-12">
					<h3>Personal Information</h3>
					<div class="form-group">
						<?php echo form_error('name') ? alertMsg(false,'',form_error('name')):'';?>
						<label class="control-label">Full Name</label>
						<input maxlength="100" type="text" required="required" name="name" class="form-control" placeholder="Full Name" />
					</div>
					
					<div class="form-group">
						<?php echo form_error('dateOfBirth') ? alertMsg(false,'',form_error('dateOfBirth')):'';?>
						<label class="control-label">Date of Birth</label>
						<input  type="text" required="required" class="form-control" name="dateOfBirth" placeholder="Date of Birth"  />
					</div>
					<div class="form-group">
						<?php echo form_error('phone') ? alertMsg(false,'',form_error('phone')):'';?>
						<label class="control-label">Phone number</label>
						<input maxlength="10" type="text" required="required" name="phone" class="form-control" placeholder="Phone number"  />
					</div>
					<label  id ="gender" class="control-label">Gender</label>

					<div class="form-group">

						<input name="group100" name="gender" type="radio" id="radio100">
						<label for="radio100">Male</label>
					</div>

					<div class="form-group">
						<?php echo form_error('name') ? alertMsg(false,'',form_error('name')):'';?>
						<input name="group100" name="gender" type="radio" id="radio101" checked>
						<label for="radio101">Female</label>
					</div>
					<button class="btn btn-primary nextBtn btn-m pull-right" type="button" >Next</button>
				</div>
			</div>
		</div>
		<div class="row setup-content" id="step-3">
			<div class="col-xs-6 col-md-offset-3">
				<div class="col-md-12">
					<h3 >Residential Information</h3>
					<div class="form-group">
						<?php echo form_error('streetAddress') ? alertMsg(false,'',form_error('streetAddress')):'';?>
						<label class="control-label">Street Address</label>
						<input maxlength="100" type="text"  required="required" name="streetAddress" class="form-control" placeholder="Street Address" />
					</div>
					<div class="form-group">
						<?php echo form_error('suburb') ? alertMsg(false,'',form_error('suburb')):'';?>
						<label class="control-label">suburb</label>
						<input maxlength="13" type="text" required="required" name="suburb" class="form-control" placeholder="suburb"  />
					</div>
					<form>
						<?php  echo form_error('town') ? alertMsg(false,'',form_error('town')):'';?>
						<div class="form-group">

							<label for="town">town</label>
							<select class="form-control" value="town" name="town" id="town">
								<option  selected="true" disabled="disabled">Please select</option>

								<?php 

								foreach ($manucipalities as $town){?>
								<option <?php 
								if(isset($user_id)  && $townEdit){

									echo ($townEdit == $town->name)? 'selected':'';


								}else{
									if(set_value('town')){
										echo (set_value('town') == $town->id)? 'selected':'';
									}

								}
								?>

								value="<?php echo $town->id ?>"><?php echo $town->name ?></option>
								<?php } ?>
							</select>
						</div>
						<form>
							<?php  echo form_error('zip_code') ? alertMsg(false,'',form_error('zip_code')):'';?>
							<div class="form-group">

								<label for="zip_code">zip_code</label>
								<select class="form-control" value="zip_code" name="zip_code" id="zip_code">
									<option  selected="true" disabled="disabled">Please select</option>

									<?php 

									foreach ($manucipalities as $zip_code){?>
									<option <?php 
									if(isset($user_id)  && $zip_codeEdit){

										echo ($zip_codeEdit == $zip_code->name)? 'selected':'';


									}else{
										if(set_value('zip_code')){
											echo (set_value('zip_code') == $zip_code->id)? 'selected':'';
										}

									}
									?>

									value="<?php echo $zip_code->id ?>"><?php echo $zip_code->name ?></option>
									<?php } ?>
								</select>
							</div>

							

							<form>
								<?php  echo form_error('manucipality') ? alertMsg(false,'',form_error('manucipality')):'';?>
								<div class="form-group">

									<label for="manucipality">manucipality</label>
									<select class="form-control" value="manucipality" name="manucipality" id="manucipality">
										<option  selected="true" disabled="disabled">Please select</option>

										<?php 

										foreach ($manucipalities as $manucipality){?>
										<option <?php 
										if(isset($user_id)  && $manucipalityEdit){

											echo ($manucipalityEdit == $manucipality->name)? 'selected':'';


										}else{
											if(set_value('manucipality')){
												echo (set_value('manucipality') == $manucipality->id)? 'selected':'';
											}

										}
										?>

										value="<?php echo $manucipality->id ?>"><?php echo $manucipality->name ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="form-group">

									<label for="district">district</label>
									<select class="form-control" value="district" name="district" id="district">
										<option  selected="true" disabled="disabled">Please select</option>

										<?php 

										foreach ($districts as $district){?>
										<option <?php 
										if(isset($user_id)  && $districtEdit){

											echo ($districtEdit == $district->name)? 'selected':'';


										}else{
											if(set_value('district')){
												echo (set_value('district') == $district->id)? 'selected':'';
											}

										}
										?>

										value="<?php echo $district->id ?>"><?php echo $district->name ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">

									<label for="province">province</label>
									<select class="form-control" value="province" name="province" id="province">
										<option  selected="true" disabled="disabled">Please select</option>

										<?php 

										foreach ($provinces as $province){?>
										<option <?php 

										if(set_value('province')){
											echo (set_value('province') == $province->id)? 'selected':'';
										}
										?>

										value="<?php echo $province->id ?>"><?php echo $province->name ?></option>
										<?php } ?>
									</select>
								</div>
								<button class="btn btn-primary nextBtn btn-m pull-right" type="button" >Next</button>
							</div>
						</div>
						
					</div>
				</form>
				
				<div class="row setup-content" id="step-4">
					<div class="col-xs-6 col-md-offset-3">
						<div class="col-md-12">
							<h3>Confirm Information</h3>

							<div class="leftdiv">
								<div class="form-group">
									<label class="control-label">FullName<br></label>
									<br>

								</div>
								<div class="form-group">
									<label class="control-label">Date</label>
									<br>
								</div>

								
								<div class="form-group">
									<label class="control-label">DateOfBirth</label>
									<br>
								</div>
								<div class="form-group">
									<label class="control-label">Email</label>
									<br>
								</div>
								<div class="form-group">
									<label class="control-label">Phone</label>
									<br>
								</div>

								<div class="form-group">
									<label class="control-label">Gender</label>
									<br>
								</div>
								<div class="form-group">
									<label class="control-label">Address</label>
								</div>


							</div>
							<div class="rightdiv">
								<div class="form-group">
									<label class="control-label">:Thatohatsi Mohohlo</label>
									<br>
								</div>
								<div class="form-group">
									<label class="control-label">:10/10/17</label>
									<br>
								</div>
								<div class="form-group">
									<label class="control-label">:06/05/90</label>
									<br>
								</div>
								<div class="form-group">
									<label class="control-label">:thatohatsi@gmail.com</label>
									<br>
								</div>
								<div class="form-group">
									<label class="control-label">:0835729736</label>
									<br>
								</div>
								<div class="form-group">
									<label class="control-label">:female</label>
									<br>
								</div>
								<div class="form-group">
									<label class="control-label">:450 Serapelo str<br>Phomolong<br>Henneman<br>9445<br>matjhabeng<br>Lejweleputswa<br>Free State</label>

								</div>
								<button class="btn btn-primary nextBtn btn-m pull-right" type="button" >Next</button>
							</div>

						</div>

					</div>


				</div>


				<div class="row setup-content" id="step-5">
					<div class="col-xs-6 col-md-offset-5">
						<div class="col-md-12">
							<h3> Step 5</h3>
							<button class="btn btn-success btn-m pull-right" type="submit">Submit</button>

						</div>
					</div>
				</div>
			</form>

		</div>






		<script type="text/javascript">
			$(document).ready(function () {
				var navListItems = $('div.setup-panel div a'),
				allWells = $('.setup-content'),
				allNextBtn = $('.nextBtn');

				allWells.hide();

				navListItems.click(function (e) {
					e.preventDefault();
					var $target = $($(this).attr('href')),
					$item = $(this);

					if (!$item.hasClass('disabled')) {
						navListItems.removeClass('btn-primary').addClass('btn-default');
						$item.addClass('btn-primary');
						allWells.hide();
						$target.show();
						$target.find('input:eq(0)').focus();
					}
				});

				allNextBtn.click(function(){
					var curStep = $(this).closest(".setup-content"),
					curStepBtn = curStep.attr("id"),
					nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
					curInputs = curStep.find("input[type='text'],input[type='url']"),
					isValid = true;

					$(".form-group").removeClass("has-error");
					for(var i=0; i<curInputs.length; i++){
						if (!curInputs[i].validity.valid){
							isValid = false;
							$(curInputs[i]).closest(".form-group").addClass("has-error");
						}
					}

					if (isValid)
						nextStepWizard.removeAttr('disabled').trigger('click');
				});

				$('div.setup-panel div a.btn-primary').trigger('click');
			});
</script>
<script> 
	var errors = false;
    /**
     * checks if the input name has only letterrs
     * 
     */
     $('#name').on('input',function(){
        //the input that called the function
        var input = $(this);
       //gets the value of the input
       var current_name = input.val();
       //regex to only allow leters for the name
       var regex = /^[a-zA-Z\s]+$/;
       //check the parent of the input to change the class latter
       var parent = input.parent();
       //check if the input has only letters if has
       if (regex.test(current_name)){
        //removes the class has errors from the input parent
        parent.removeClass('has-error'); 
         //adds the class has success to the input parent
         parent.addClass('has-success');
         errors = false;  
       } else {//if not
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
 $("#email").on('input',function () {
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
       if (regex.test(current_email) && ($.inArray(current_email, email_registed))!=0) {
        //removes the class has errors from the input parent
        parent.removeClass('has-error');  
         //adds the class has success to the input parent
         parent.addClass('has-success');  
         errors = false;
     } else {
     	var parent = input.parent();
         //removes the class has success from the input parent
         parent.removeClass('has-success');
         //adds the class has errors to the input parent
         parent.addClass('has-error');
         errors = true;

     }
 });


</script>
<script src="jquery.min.js"></script>
<script type="text/javascript">
	
	$("#province").change(function() {
		if ($(this).data('options') === undefined) {
			/*Taking an array of all options-2 and kind of embedding it on the select1*/
			$(this).data('options', $('#manucipality option').clone());
		}
		var id = $(this).val();
		var options = $(this).data('options').filter('[value=' + id + ']');
		$('#manucipality').html(options);
	});

</script>

