<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="starter-template">
	<div class="container form-area">
		<h1 class="whtColor"> Reset Password </h1>
		<div class="card card-container">
			<?php

			$action="login/resetmessage/";

			echo form_open($action,array('class'=>'form-horizontal col-md-offset-2 col-md-8'));?>

			
			<div class="label-info ">
				<h3><label  for="email" class="label">Email Address</label></h3>	
			</div>
			<input type="text" id="email" name="username" class="form-control" placeholder="Email address" value="<?php echo  set_value('username') ;?>">
			<p><?php echo form_error('username') ? alertMsg(false,'username',form_error('username')) : ''; ?></p>		
			<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Send</button>
			
		</form><!-- /form -->
		<div class="container">
			
		</div>
	</div><!-- /card-container -->
</div><!-- /container --><!-- /.container -->
</div>