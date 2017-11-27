<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$modelo_id 		= $dados_carro['modelo_id'] 		?? $this->input->post('modelo_id') 		?? false;
//var_dump($manucipality);
?>


<div class="container form-area"></div>

	<?php 
	$options = array("class"=> "form-group","method"=>"POST","name"=>"form_name","id"=>"form_id","class"=>"form_class");
	echo form_open("publiczone/registerUser",$options);
	?>

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
			
			
		</div>
	</div>
	<form role="form" action="" method="post">
		<div class="row setup-content" id="step-1">
			<div class="col-xs-6 col-md-offset-3">
				<div class="col-md-12">
					<h3>Setup Account</h3>
					<div class="form-group">
						<label for="email">email</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
							<input type="email" class="form-control" name="email" id="email" placeholder="Requested email"  onblur="validate()" required>
						</div>
						<p><?php echo form_error('email') ? alertMsg(false,'email',form_error('email')) : ''; ?></p>

					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							<input type="text" class="form-control" name="password"  onblur="validate()"   id="password" placeholder="Password" required data-toggle="popover" title="Password Strength" data-content="Enter Password...">
						</div>
						<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>

					</div>
					<div class="form-group">
						<label for="confirm">Confirm Password</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-resize-vertical"></span></span>
							<input type="text" class="form-control" name="confirm"   onblur="validate()"  id="confirm" placeholder="Confirm Password" required>
						</div>
						<p><?php echo form_error('confirm') ? alertMsg(false,'confirm',form_error('confirm')) : ''; ?></p>
					</div>
					<button class="btn btn-primary nextBtn btn-m pull-right" id="submit" name="submit" type="submit" >Next</button>
				</div>
			</div>
		</div>
		
		<div class="row setup-content" id="step-2">
			<div class="col-xs-6 col-md-offset-3">
				<div class="col-md-12">
					<h3>Personal Information</h3>
					<div class="form-group">
						<label class="control-label" for="name">Full Name</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-user"></span></span>
							<input type="text" class="form-control" name="name"   id="name" placeholder="full name" required>
						</div>
						<p><?php echo form_error('name') ? alertMsg(false,'name',form_error('name')) : ''; ?></p>

					</div>
					<div class="form-group">
						<label class="control-label" for="identitynumber">Identity Number</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
							<input type="text" class="form-control" name="identitynumber"  id="identitynumber" placeholder="identity number" required>
						</div>
						<p><?php echo form_error('identitynumber') ? alertMsg(false,'identitynumber',form_error('identitynumber')) : ''; ?></p>

					</div>
					<div class="form-group">
						<label class="control-label" for="dateofbirth">Date of Birth</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
							<input type="date" class="form-control" name="dateofbirth"  id="dateofbirth" placeholder="date of birth" required>
						</div>
						<p><?php echo form_error('dateofbirth') ? alertMsg(false,'dateofbirth',form_error('dateofbirth')) : ''; ?></p>

					</div>
					<div class="form-group">
						<label class="control-label">Date of Registration</label>
						<div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
							<input type="date" class="form-control" name="date_registration"  id="date_registration"  placeholder="date of birth" required>
						</div>
						<p><?php echo form_error('date_registration') ? alertMsg(false,'date_registration',form_error('date_registration')) : ''; ?></p>

					</div>
					<div class="form-group">
						<label class="control-label" for="phone">Phone number</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
							<input type="text" class="form-control" name="phone"   id="phone" placeholder="phone numbers" required>
						</div>
						<p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
					</div>
					<label  id ="gender" class="control-label">Gender</label>

					<div class="form-group">

						<input  name="gender" type="radio" value="1" id="radio100">
						<label for="radio100">Male</label>
					</div>

					<div class="form-group">
						<input  name="gender" type="radio" value="2" id="radio101"   checked>
						<label for="radio101">Female</label>
						<p><?php echo form_error('gender') ? alertMsg(false,'gender',form_error('gender')) : ''; ?></p>

					</div>
					<button class="btn btn-primary nextBtn btn-m pull-right" type="button">Next</button>
				</div>
			</div>
		</div>
		<div class="row setup-content" id="step-3">
			<div class="col-xs-6 col-md-offset-3">
				<div class="col-md-12">
					<h3 >Residential Information</h3>
					
					<div class="form-group">

						<label for="province">province</label>
						<select class="form-control" name="province" id="province">
							<option value="">Select a province</option>
							<?php	
							foreach ($province as $provinces)
								{?>	
							<option value="<?php echo $provinces->id;?>"><?php echo $provinces->name;?></option>
							<?php
						}
						?>
					</select>
				</div>

				
				<div class="form-group" id="select_district" style="display:none">
					<label for="district">District</label>
					
					<select class="form-control" name="district" id="district" required>
					</select>
					<?php  echo form_error('district') ? alertMsg(false,'',form_error('district')):'';?>
					
				</div>

				<div class="form-group" id="select_manucipality" style="display:none">
					<label for="manucipality">Manucipality</label>
					
					<select class="form-control" name="manucipality" id="manucipality" required>
					</select>
					<?php  echo form_error('manucipality') ? alertMsg(false,'',form_error('manucipality')):'';?>
					
				</div>
				<div class="form-group" id="select_town" style="display:none">
					<label for="town">town</label>
					
					<select class="form-control" name="town" id="town" required>
					</select>
					<?php  echo form_error('town') ? alertMsg(false,'',form_error('town')):'';?>
					
				</div>
				<div class="form-group" id="zip_code_input" style="display:none">
					<label for="zip_code">Zip Code</label>


					<?php  echo form_error('zip_code') ? alertMsg(false,'',form_error('zip_code')):'';?>

				</div>

				<div class="form-group" id="select_suburb" style="display:none">
					<label for="suburb">Suburb</label>
					
					<select class="form-control" name="suburb" id="suburb" required>
					</select>
					<?php  echo form_error('suburb') ? alertMsg(false,'',form_error('suburb')):'';?>
					
				</div>

				

				<div class="form-group" id="select_address" style="display:none">
					<label for="address">Street Name</label>
					
					<select class="form-control" name="address" id="address" required>
					</select>
					<?php  echo form_error('address') ? alertMsg(false,'',form_error('address')):'';?>
					
				</div>
				<div class="form-group" id="select_address" style="display:none">
					<label for="street_name">Street Name</label>
					
					<select class="form-control" name="street_name" id="street_name" required>
					</select>
					<?php  echo form_error('street_name') ? alertMsg(false,'',form_error('street_name')):'';?>
					
				</div>
				<div class="form-group" id="select_Number" style="display:none">
					<label for="door_number">Door Number</label>
					<!--input type="text" name="door_number" id="door_number" placeholder="Enter door_number" >
					<select class="form-control" name="door_number" id="door_number" required>
					</select-->
					<input type="number" id="door" value="" name="door" min="1" max="1000">
					<?php  echo form_error('door_number') ? alertMsg(false,'',form_error('door_number')):'';?>
					
				</div>
				<button class="btn btn-success btn-lg pull-right" type="submit" >Submit</button>
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

<script>


	/************************ getting the district through the provinve id********************/
	$( document ).ready(function() {
		$('#province').on('change',function(){
	//bring all the districts from php to javascript
	let district 		= <?php echo json_encode($district);?>;

	
//select box from the ditrict
let district_id =$("#district");
		//province id from the select box of the provinces
		let selected  		= $("#province").val();

	//clear prev options
	district_id.empty();
//write new options
district_id.append($('<option>', { 
	value: 0,
	text : "select district" 
}));
$("#district select option[value='0']").attr("disabled","disabled");
$.each(district[selected], function (i, item) {
	district_id.append($('<option>', { 
		value: item.id,
		text : item.name 

	}));

});
	//select the option of the edit mode
	/*if(id_district){
	$("#select_district select").val(id_district);
}else{
	$("#select_district select").val(0);
}*/
	//dispaly the select box
	$("#select_district").attr('style','display:block');
});
	});
	/*get municipali by distric id*/	
	$( document ).ready(function() {
		$('#district').on('change',function(){
	//bring all the districts from php to javascript
	let manucipality 		= <?php echo json_encode($manucipality);?>;
	console.log(manucipality);
	
//select box from the ditrict
let manucipality_id =$("#manucipality");
		//province id from the select box of the provinces
		let selected  		= $("#district").val();
		
	//clear prev options
	manucipality_id.empty();
//write new options
manucipality_id.append($('<option>', { 
	value: 0,
	text : "select manucipality" 
}));
$("#manucipality select option[value='0']").attr("disabled","disabled");
$.each(manucipality[selected], function (i, item) {

	manucipality_id.append($('<option>', { 
		value: item.id,
		text : item.name 
	}));
});
	//select the option of the edit mode
	/*if(id_district){
	$("#select_district select").val(id_district);
}else{
	$("#select_district select").val(0);
}*/
	//dispaly the select box
	$("#select_manucipality").attr('style','display:block');
});
	});

	/**get town by municipality id**/
	$( document ).ready(function() {
		$('#manucipality').on('change',function(){
	//bring all the districts from php to javascript
	let town 		= <?php echo json_encode($town);?>;
	console.log(town);
	
//select box from the ditrict
let town_id =$("#town");
		//province id from the select box of the provinces
		let selected  		= $("#manucipality").val();
		
	//clear prev options
	town_id.empty();
//write new options
town_id.append($('<option>', { 
	value: 0,
	text : "select town" 
}));
$("#town select option[value='0']").attr("disabled","disabled");
$.each(town[selected], function (i, item) {
	
	town_id.append($('<option>', { 
		value: item.id,
		text : item.name 
	}));
});

	//dispaly the select box
	$("#select_town").attr('style','display:block');

});
	});

	/**get town by municipality id**/
	$( document ).ready(function() {
		$('#town').on('change',function(){
	//bring all the districts from php to javascript
	let suburb 		= <?php echo json_encode($suburb);?>;
	console.log(suburb);
	
//select box from the ditrict
let suburb_id =$("#suburb");

		//province id from the select box of the provinces
		let selected  		= $("#town").val();
		
	//clear prev options
	suburb_id.empty();
//write new options
suburb_id.append($('<option>', { 
	value: 0,
	text : "select suburb" 
}));
$("#suburb select option[value='0']").attr("disabled","disabled");
$.each(suburb[selected], function (i, item) {
	$("#zip_code_input").empty();
	$("#zip_code_input").append($('<input>', { 

		placeholder: item.zip_code,

	}));
	item.zip_code;
	suburb_id.append($('<option>', { 
		value: item.id,
		text : item.name 
	}));
	
});
	//select the option of the edit mode
	/*if(id_district){
	$("#select_district select").val(id_district);
}else{
	$("#select_district select").val(0);
}*/
	//dispaly the select box
//console.log(towninput);
$("#zip_code_input").attr('style','display:block');
$("#select_suburb").attr('style','display:block');

});
});

$( document ).ready(function() {
	$('#suburb').on('change',function(){
	//bring all the districts from php to javascript
	let address 		= <?php echo json_encode($address);?>;

	
//select box from the ditrict
let address_id =$("#address");
		//province id from the select box of the provinces
		let selected  		= $("#suburb").val();

	//clear prev options
	address_id.empty();
//write new options
address_id.append($('<option>', { 
	value: 0,
	text : "select address" 
}));
$("#address select option[value='0']").attr("disabled","disabled");
$.each(address[selected], function (i, item) {
	address_id.append($('<option>', { 
		value: item.id,
		text : item.street_name 

	}));
	/*$("#select_Number").empty();
	$("#select_Number").append($('<input name="door_number" type="text">', { 
		//value: item.id,
		placeholder : "Enter door number", 
		

	}));*/

});
	//select the option of the edit mode
	/*if(id_district){
	$("#select_district select").val(id_district);
}else{
	$("#select_district select").val(0);
}*/
	//dispaly the select box
	$("#select_address").attr('style','display:block');
	$("#select_Number").attr('style','display:block');
});
});
/*$( document ).ready(function() {
	$('#door').on('change',function(){
//$("#select_Number").append($('<input name="door_number" type="text">', { 
		//value: item.id,
		//placeholder : $('#door').val(), 
		var number = $(this).data();
    /*$("#door_number").val(function() {
        return this.value + number;
    });*/
	/*	console.log(number);

	});
   // $('#example').append($('#example-textarea').val());


});
//});*/


</script>


<!-- validatin for password-->
</script>
<script type="text/javascript">
	var password = document.getElementById("password")
	, confirm = document.getElementById("confirm");

	function validatePassword(){
		if(password.value != confirm.value) {
			confirm.setCustomValidity("Passwords Don't Match");
		} else {
			confirm.setCustomValidity('');
		}
	}

	password.onchange = validatePassword;
	confirm.onkeyup = validatePassword;
</script>

