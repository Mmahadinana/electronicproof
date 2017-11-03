<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="starter-template">
	<div class="container form-area">
		<h1 class="whtColor"> Reset Password </h1>
		<div class="card card-container">
			<?php

			$action="login/login/";

			echo form_open($action,array('class'=>'form-horizontal col-md-offset-2 col-md-8'));?>

			
			<div class="label-info ">
				<h3><label  for="email" class="label">Username</label></h3>	
			</div>
			<input type="text" id="email" name="username" class="form-control" placeholder="Email address" value="<?php echo  set_value('username') ;?>">
			<p><?php echo form_error('username') ? alertMsg(false,'username',form_error('username')) : ''; ?></p>
			
			<div class="label-info ">
				<h3>				
					<label for="inputPassword" class="label ">Password</label>
				</h3>
			</div>
			<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ;?>">
			<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
			<div id="remember" class="checkbox">
				<label>
					<input type="checkbox" name="rememberme" value="rememberme">Rememberme
				</label>
			</div>
			<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
			<a href="<?php echo base_url('login/reset/') ?>" class="forgot-password"><span>Forgot Password?</span></a>
		</form><!-- /form -->
		<div class="container">
			
		</div>
	</div><!-- /card-container -->
</div><!-- /container --><!-- /.container -->
</div>