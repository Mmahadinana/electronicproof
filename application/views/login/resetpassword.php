<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="starter-template">
	<div class="container form-area">
		<h1 class="whtColor"> Reset Password </h1>
		<!--div class="card card-container"-->
			<?php

			$action="login/login_/";

			echo form_open($action,array('class'=>'form-horizontal'));?>

			<!--input type="hidden" name="user_id" value="<?php echo set_value('password') ;?>"-->
			<div class="resetTopPad text-center">
			<div class="form-group ">
				<label for="newpassword" class="control-label label-primary passlabels col-sm-4"><span class="footPadRight"> Enter New Password</span></label>				
				<div class="col-md-7">
					<input type="password" id="newpassword" name="password" class="form-control" placeholder="Enter New Password" value="<?php echo set_value('password') ;?>">
				</div>
				<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
			</div>

			<div class="form-group ">
				<label for="repeatnewpass" class="control-label label-primary passlabels col-sm-4"><span class="footPadRight"> Confirm Password</span></label>					
				<div class="col-md-7">
					<input type="password" id="repeatnewpass" name="password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('password') ;?>">
				</div>
				<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
			</div>

			<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
			<div class="col-md-10 ">
				<button class="btn btn-lg btn-primary passbtn" type="submit">Sign in</button>
			</div>
		</div>
			
		</form><!-- /form -->
		<div class="container">
			
		</div>
	<!--/div>< /card-container -->
</div><!-- /container --><!-- /.container -->
</div>