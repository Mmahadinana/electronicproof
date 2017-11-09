<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<<<<<<< HEAD

	<div class=" container ">
		
		
=======
<div class="starter-template">
	<div class="container form-area">
		<h1 class="whtColor"> Reset Password </h1>
		<div class="card card-container">
>>>>>>> 4eb0575e4e7e2e433f7f86ee19937f8c29fbba7e
			<?php

			$action="login/resetmessage/";

			echo form_open($action,array('class'=>'form-horizontal col-md-offset-2 col-md-8'));?>

<<<<<<< HEAD
	<div class="card-container card text-center">
		<h1 > Reset Password </h1>	
		<div class=" form-group ">
			<label  for="email" class="  col-sm-2">Username</label>	
			<div class="col-xs-12 col-lg-6">
				<input type="text" id="email" name="username" class="form-control" placeholder="Email address" value="<?php echo  set_value('username') ;?>">
			</div>
			<p><?php echo form_error('username') ? alertMsg(false,'username',form_error('username')) : ''; ?></p>
		</div>	
			<div class=" col-lg-2 ">
			<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
		</div>
			<div class="col-lg-3">
			<button class="btn btn-lg btn-primary form-control" type="submit">Send</button>			
			</div>
			<div class="col-lg-3">
			<a class="btn btn-lg btn-warning form-control" type="text">Back</a>
			</div>
=======
			
			<div class="label-info ">
				<h3><label  for="email" class="label">Email Address</label></h3>	
			</div>
			<input type="text" id="email" name="username" class="form-control" placeholder="Email address" value="<?php echo  set_value('username') ;?>">
			<p><?php echo form_error('username') ? alertMsg(false,'username',form_error('username')) : ''; ?></p>		
			<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Send</button>
			
>>>>>>> 4eb0575e4e7e2e433f7f86ee19937f8c29fbba7e
		</form><!-- /form -->
		
			
<<<<<<< HEAD
		
	
</div><!-- /container --><!-- /.container   -->
=======
		</div>
	</div><!-- /card-container -->
</div><!-- /container --><!-- /.container -->
>>>>>>> 4eb0575e4e7e2e433f7f86ee19937f8c29fbba7e
</div>