<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//var_dump($manucipality);
?>


<div class="container form-area">

	<?php 
	$options = array("class"=> "form-group","method"=>"POST");
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
			<div class="stepwizard-step">
				<a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-home" aria-hidden="true"></i></a>
				<p>Step 4</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-home" aria-hidden="true"></i></a>
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
					<div class="form-group" for="address">
						<label class="control-label">Street Address</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
							<input type="text" class="form-control" name="address"    id="address" placeholder="address" required>
						</div>
						<p><?php echo form_error('address') ? alertMsg(false,'address',form_error('address')) : ''; ?></p>

					</div>
					<div class="form-group">
						<label class="control-label" for="suburb">suburb</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
							<input type="text" class="form-control" name="suburb" id="suburb"   placeholder="suburb" required>
						</div>
						<p><?php echo form_error('suburb') ? alertMsg(false,'suburb',form_error('suburb')) : ''; ?></p>

					</div>
					<div class="form-group">
						<label class="control-label" for="town">town</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
							<input type="text" class="form-control" name="town" id="town"    placeholder="town" required>
						</div>
						<p><?php echo form_error('town') ? alertMsg(false,'town',form_error('town')) : ''; ?></p>

					</div>
					<div class="form-group">
						<label class="control-label" for="zip_code">zip code</label>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
							<input type="text" class="form-control" name="zip_code" id="zip_code"   placeholder="zip_code" required>
						</div>
						<p><?php echo form_error('zip_code') ? alertMsg(false,'zip_code',form_error('zip_code')) : ''; ?></p>

					</div>
					<div class="form-group">

						<label for="province">province</label>
						<select class="form-control" value="province" name="province" id="province">
							<?php	
							foreach ($province as $provinces)
								{?>	
							<option value="<?php echo $provinces->id;?>"><?php echo $provinces->name;?></option>
							<?php
						}
						?>
					</select>
				</div>

				<?php  echo form_error('district') ? alertMsg(false,'',form_error('district')):'';?>
				<div class="form-group">

					<label for="district">district</label>
					<select class="form-control" value="districts" name="district" id="district">
						<?php	
						foreach ($district as $districts)
							{?>	
						<option value="<?php echo $districts->id;?>"><?php echo $districts->name;?></option>
						<?php
					}
					?>
				</select>
			</div>
			<?php  echo form_error('manucipality') ? alertMsg(false,'',form_error('manucipality')):'';?>
			<div class="form-group">

				<label for="manucipality">manucipality</label>
				<select class="form-control" value="manucipality" name="manucipality" id="manucipality">
					<?php	
					foreach ($manucipality as $manucipalities)
						{?>	
					<option value="<?php echo $manucipalities->id;?>"><?php echo $manucipalities->name;?></option>
					<?php
				}
				?>
			</select>
		</div>
<script type="text/javascript">

$province = $_POST['provinceid'];   // department id

$sql = "SELECT id,name FROM district WHERE province=".$provinceid;

$result = mysqli_query($con,$sql);

$district_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $districtid = $row['id'];
    $name = $row['name'];

    $district_arr[] = array("id" => $district_id, "name" => $name);
}

// encoding array to json format
echo json_encode($district_arr);
	
</script>

<script type="text/javascript">
	$(document).ready(function(){

    $("#province").change(function(){
        var provinceid = $(this).val();

        $.ajax({
            url: 'register.php',
            type: 'post',
            data: {province:provinceid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#district").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#district").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });

});
</script>





















		
		<button class="btn btn-primary nextBtn btn-m pull-right" id="submit" type="button" >Next</button>

	</div>
</div>

</div>


<div class="row setup-content" id="step-4">
	<div class="col-xs-6 col-md-offset-4">
		<div class="col-md-12">

			<button class="btn btn-primary nextBtn btn-m pull-right" id="submit" type="button" >Next</button>
			
		</div>
	</div>
</div>

<div class="row setup-content" id="step-5">
	<div class="col-xs-6 col-md-offset-5">
		<div class="col-md-12">
			<h3> Step 5</h3>
			<button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
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
<script>
//updates the car models on the form
function actualiza_modelos(){
	//bring all the models from php to javascript
	let modelos 		= <?php echo json_encode($modelos);?>;
		//if in edit mode asssigns the model id if on insert assigns false
	let id_province		= <?php echo $province_id ? $province_id : 'false'; ?>; 
//select box from the models
	let province_id 		=$("#province_id");
		//manufacturer id from the select box of the manufacturers
	let selected  		= $("#district_id").val();
	//clear prev options
province_id.empty();
//write new options
province_id.append($('<option>', { 
        value: 0,
        text : "escolha um modelo" 
    }));
$("#select_modelo select option[value='0']").attr("disabled","disabled");
	$.each(modelos[selected], function (i, item) {
    province_id.append($('<option>', { 
        value: item.id,
        text : item.nome 
    }));
});
	//select the option of the edit mode
	if(id_province){
	$("#select_modelo select").val(id_province);
}else{
	$("#select_modelo select").val(0);
}
	//dispaly the select box
	$("#select_modelo").attr('style','display:block');
}
$(document).ready(function() {
actualiza_modelos();
});
</script>


