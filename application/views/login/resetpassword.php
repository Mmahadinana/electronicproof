<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="starter-template">
	<div class="container form-area">
		<h1 class="whtColor"> Reset Password </h1>
		<!--div class="card card-container"-->
		<?php
           //var_dump($db);
		$action="passwords/resetpassword/".$db->emailtoken."/".$db->user_id;

		echo form_open($action,array('class'=>'form-horizontal'));?>


		<div class="resetTopPad text-center">
			<div class="form-group ">
				<label for="newpassword" class="control-label label-primary passlabels col-sm-4"><span class="footPadRight">Enter New Password</span></label>				
				<div class="col-md-7">
					<input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="Enter New Password" value="<?php echo set_value('newpassword') ;?>">
					<p id="results"><?php echo form_error('newpassword') ? alertMsg(false,'newpassword',form_error('newpassword')) : ''; ?></p>
				</div>
				
			</div>

			<div class="form-group ">
				<label for="confirmpass" class="control-label label-primary passlabels col-sm-4"><span class="footPadRight"> Confirm Password</span></label>					
				<div class="col-md-7">
					<input type="password" id="confirmpass" name="confirmpass" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('confirmpass') ;?>">
					<p id="CheckPasswordMatch"><?php echo form_error('confirmpass') ? alertMsg(false,'confirmpass',form_error('confirmpass')) : ''; ?></p>
				</div>
				
			</div>

			
			<div class="col-md-10 ">
				<button class="btn btn-lg btn-primary passbtn" type="submit">Back to login</button>
			</div>
		</div>

	</form><!-- /form -->
	<div class="container">

	</div>
	<!--/div>< /card-container -->
</div><!-- /container --><!-- /.container -->
</div>
<script>
	$(document).ready(function() {
		$('#newpassword').keyup('input',function() {
			//show input indication on failer and or success
			$('#results').html(checkStrength($('#newpassword').val()));
			if(checkStrength($('#newpassword').val())!='Strong')
			{	//show input error if password does no meet requirements
				$(this).parent().removeClass('has-success');
				$(this).parent().addClass('has-error');
			}
			else{
				//show input success if password meet requirements
				$(this).parent().removeClass('has-error');
				$(this).parent().addClass('has-success');
			}
		})
		// Confirm password to match newpassword
		$('#confirmpass').keyup('input',function() {
			var password = $("#newpassword").val();
			var confirmPassword = $("#confirmpass").val();
				//when passwords do not match
			if (password != confirmPassword){
				$("#CheckPasswordMatch").html("Passwords do not match!");
				$("#CheckPasswordMatch").removeClass("text-success");
				$("#CheckPasswordMatch").addClass("text-danger");
				$(this).parent().removeClass('has-success');
				$(this).parent().addClass('has-error');
			}
			else{
				//when passwords match
				$("#CheckPasswordMatch").html("Passwords match.");
				$("#CheckPasswordMatch").removeClass("text-danger");
				$("#CheckPasswordMatch").addClass("text-success");
				$(this).parent().removeClass('has-error');
				$(this).parent().addClass('has-success')
			}
		})
		//check password 
		function checkStrength(password) {
			//uoppercase and lowercase
			var regex_lowercase_uppercase=password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/);
			//letters and numbers			
			var regex_number=password.match(/([a-zA-Z])/) && password.match(/([0-9])/);
			//special charactors
			var regex_special=password.match(/([!,%,&,@,#,$,^,*,?,_,~])/);
			//initialize strength to zero
			var strength = 0;
			//check length
		if (password.length < 5) {
				$('#results').removeClass();
				$('#results').addClass('short text-danger h5');
				return 'Too short'
			}
			
		if (password.length > 5) strength += 1
			// If password contains both lower and uppercase characters, increase strength value.
		if (regex_lowercase_uppercase) strength += 1
			// If it has numbers and characters, increase strength value.
		if (regex_number) strength += 1
			// If it has one special character, increase strength value.
		if (regex_special) strength += 1
			
			// Calculated strength value, we can return messages
			// If value is less than 2
			if (strength < 2) {
				$('#results').removeClass();
				$('#results').addClass('weak text-danger h5');
			
			return 'Weak, password contain all(special character,number,uppercase and lowercase';

		} else if (strength == 2) {
			$('#results').removeClass();
			$('#results').addClass('good text-warning h5');

			return 'Good, password contain all(special character,number,uppercase and lowercase)';

		} else {
			$('#results').removeClass();
			$('#results').addClass('strong text-success h5');
			return 'Strong';
		}
	}
});




</script>