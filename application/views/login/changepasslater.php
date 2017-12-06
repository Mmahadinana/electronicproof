<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="starter-template">
	<div class="container white-text">
		
			<?php

			$action="login/login_/";

			//echo form_open($action,array('class'=>'form-inline col-md-offset-2 col-md-8'));
			echo form_open($action,array('class'=>'form-horizontal','method'=>'POST'));?>
<input <?php echo isset($user_id)? "value='user_id'":"value='0'";?> 
	type='hidden' id='userid' name='userid'>
			<!-- Old Password-->	

			<div class="form-group  ">
				<label for="oldpassword" class="control-label label-primary passlabels col-sm-2"><span class="footPadRight"> Enter Old Password</span></label>				
				<div class="col-md-6">
					<input type="password" id="oldpassword" name="oldpassword" class="form-control" placeholder="Enter Old Password" value="<?php echo set_value('oldpassword') ;?>">
				</div>
				<p><?php echo form_error('oldpassword') ? alertMsg(false,'oldpassword',form_error('oldpassword')) : ''; ?></p>
			</div>

			<div class="form-group  ">
				<label for="repeatPassword" class="control-label label-primary passlabels col-sm-2"><span class="footPadRight"> Confirm Password</span></label>
				<div class="col-md-6">					
					<input type="password" id="repeatPassword" name="repeatpassword" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('oldpassword') ;?>">
				</div>
				<p><?php echo form_error('oldpassword') ? alertMsg(false,'oldpassword',form_error('oldpassword')) : ''; ?></p>
			</div>

			<!-- New Password--> 

			<div class="form-group ">
				<label for="newpassword" class="control-label label-primary passlabels col-sm-2"><span class="footPadRight"> Enter New Password</span></label>				
				<div class="col-md-6">
					<input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="Enter New Password" value="<?php echo set_value('newpassword') ;?>">
				</div>
				<p><?php echo form_error('newpassword') ? alertMsg(false,'newpassword',form_error('newpassword')) : ''; ?></p>
			</div>

			<div class="form-group ">
				<label for="repeatnewpass" class="control-label label-primary passlabels col-sm-2"><span class="footPadRight"> Confirm Password</span></label>					
				<div class="col-md-6">
					<input type="password" id="repeatnewpass" name="password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('newpassword') ;?>">
				</div>
				<p><?php echo form_error('newpassword') ? alertMsg(false,'newpassword',form_error('newpassword')) : ''; ?></p>
			</div>

			<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
			<div class="col-md-10 ">
				<button class="btn btn-lg btn-primary passbtn" type="submit">Sign in</button>
			</div>
			

		</form><!-- /form -->

	<!-- /div></card-container -->
</div><!-- /container --><!-- /.container -->
</div>