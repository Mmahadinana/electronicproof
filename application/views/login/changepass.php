<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="starter-template">
	<div class="container white-text">
		
		<?php

		$action="login/login_/";

			//echo form_open($action,array('class'=>'form-inline col-md-offset-2 col-md-8'));
		echo form_open($action,array('class'=>'form-horizontal'));?>

		<!-- Old Password-->	

		<div class="form-group  ">
			<label for="oldpassword" class="control-label label-primary passlabels col-sm-2"><span class="footPadRight"> Enter Old Password</span></label>				
			<div class="col-md-6">
				<input type="password" id="oldpassword" name="password" class="form-control" placeholder="Enter Old Password" value="<?php echo set_value('password') ;?>">
			</div>
			<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
		</div>

		<div class="form-group  ">
			<label for="repeatPassword" class="control-label label-primary passlabels col-sm-2"><span class="footPadRight"> Confirm Password</span></label>
			<div class="col-md-6">					
				<input type="password" id="repeatPassword" name="password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('password') ;?>">
			</div>
			<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
		</div>

		<!-- New Password--> 

		<div class="form-group ">
			<label for="newpassword" class="control-label label-primary passlabels col-sm-2"><span class="footPadRight"> Enter New Password</span></label>				
			<div class="col-md-6">
				<input type="password" id="newpassword" name="password" class="form-control" placeholder="Enter New Password" value="<?php echo set_value('password') ;?>">
			</div>
			<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
		</div>

		<div class="form-group ">
			<label for="repeatnewpass" class="control-label label-primary passlabels col-sm-2"><span class="footPadRight"> Confirm Password</span></label>					
			<div class="col-md-6">
				<input type="password" id="repeatnewpass" name="password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('password') ;?>">
			</div>
			<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
		</div>

		<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
		<div class="col-md-10 ">
			<button class="btn btn-lg btn-primary passbtn" type="submit">Sign in</button>
		</div>
		

	</form><!-- /form -->

	<!-- /div></card-container -->
</div><!-- /container --><!-- /.container -->
</div>