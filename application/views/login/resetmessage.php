<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('html.php');
?>

<div class="starter-template">
	<div class="form-area">
		<h1 class="whtColor">Username: </h1>
			<div>
			Message has been send to your email with the link to reset your password, please click on that link to able to reset your email
			</div>

		<?php
		$action="login/login_/";
		echo form_open($action,array('class'=>'form-horizontal'));?>
			<div class="form-group resetTopPad">
		
				<a class="btn btn-lg btn-primary" href="https://accounts.google.com" >Go to my account</a>		
				<a href="<?php echo base_url('passwords/reset/') ?>" class="btn btn-lg btn-info " type="reset">Go back</a>
		
				</div>
			
		</form>
	</div>
</div>






