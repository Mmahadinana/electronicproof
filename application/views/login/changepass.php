<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="starter-template">
	<div class="container">
		<div class="card card-container">
			<?php

			$action="login/login/";

			echo form_open($action,array('class'=>'form-horizontal col-md-offset-2 col-md-8'));?>
			<!-- Old Password-->			
			<div class="label-info ">
				<h3>				
					<label for="oldpassword" class="label ">Info</label>
				</h3>
			</div>
			<input type="password" id="oldpassword" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ;?>">
			<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
			<div class="label-info ">
				<h3>				
					<label for="repeatPassword" class="label ">Info</label>
				</h3>
			</div>
			<input type="password" id="repeatPassword" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ;?>">
			<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>

			<!-- New Password--> 
			<div class="label-info ">
				<h3>				
					<label for="newpassword" class="label ">Info</label>

				</h3>
			</div>
			<input type="password" id="newpassword" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ;?>">
			<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
			<div class="label-info ">
				<h3>				
					<label for="repeatnewpass" class="label ">Info</label>
				</h3>
			</div>
			<input type="password" id="repeatnewpass" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ;?>">
			<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
			
			<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
			
		</form><!-- /form -->
		
	</div><!-- /card-container -->
</div><!-- /container --><!-- /.container -->
</div>