<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<div class=" container ">
		
		
			<?php
			if (isset($statusUsername)) {
   echo alertMsg(false,' ','Username not found ');
 }
 if (isset($statusToken)) {
   echo alertMsg(false,' ','Token is not Correct ');
 }
 if (isset($statusDate)) {
   echo alertMsg(false,' ','Date has expired');
 }
			$action="passwords/reset/";

			echo form_open($action,array('class'=>'form-horizontal'));?>

	<div class="card-container card text-center">
		<h1 > Reset Password </h1>	
		<div class=" form-group ">
			<label  for="email" class="  col-sm-2">Username</label>	
			<div class="col-xs-12 col-lg-6">
				<input type="text" id="email" name="username" class="form-control" placeholder="Email address" value="<?php echo  set_value('username') ;?>">
				<p><?php echo form_error('username') ? alertMsg(false,'username',form_error('username')) : ''; ?></p>
			</div>
			
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
		</form><!-- /form -->
		
			
		
	
</div><!-- /container --><!-- /.container   -->
</div>