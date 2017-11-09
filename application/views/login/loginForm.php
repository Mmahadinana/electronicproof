<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<!--div class="starter-template"-->		
	<div class="container">	
	<div class="card-container card">		
		<h1> Login </h1>
		
		<?php

		$action="login/login/";

		echo form_open($action,array('class'=>'form-horizontal'));?>


		<div class="form-group ">
			<label  for="email" class="  col-sm-4">Username</label>	
			<div class="col-lg-8 col-xs-12">
				<input type="text" id="email" name="username" class="form-control" placeholder="Email address" value="<?php echo  set_value('username') ;?>">
			</div>
			<p><?php echo form_error('username') ? alertMsg(false,'username',form_error('username')) : ''; ?></p>
		</div>
		<div class="form-group ">

			<label for="inputPassword" class=" col-sm-4">Password</label>

			<div class="col-lg-8 col-xs-12">
				<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ;?>">
			</div>
				<p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
			</div>
			<div id="remember" class="checkbox">
				<label>
					<input type="checkbox" name="rememberme" value="rememberme">Rememberme
				</label>
			</div>
			<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
			<button class="btn btn-lg btn-primary" type="submit">Sign in</button>
			<a href="<?php echo base_url('login/reset/') ?>" class="forgot-password"><span>Forgot Password?</span></a>
		</form><!-- /form -->
	
	</div><!-- /card-container -->
</div><!-- /container --><!-- /.container -->