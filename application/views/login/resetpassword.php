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
					<p><?php echo form_error('newpassword') ? alertMsg(false,'newpassword',form_error('newpassword')) : ''; ?></p>
				</div>
				
			</div>

			<div class="form-group ">
				<label for="confirmpass" class="control-label label-primary passlabels col-sm-4"><span class="footPadRight"> Confirm Password</span></label>					
				<div class="col-md-7">
					<input type="password" id="confirmpass" name="confirmpass" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('confirmpass') ;?>">
					<p><?php echo form_error('confirmpass') ? alertMsg(false,'confirmpass',form_error('confirmpass')) : ''; ?></p>
				</div>
				
			</div>

			<input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
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