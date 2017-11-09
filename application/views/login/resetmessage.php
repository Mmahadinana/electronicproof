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
		$action="login/login/";
		echo form_open($action,array('class'=>'form-horizontal'));?>
			<div class="form-group resetTopPad">
		
				<button class="btn btn-lg btn-primary" type="submit">Go to my account</button>		
				<a href="<?php echo base_url('login/reset/') ?>" class="btn btn-lg btn-info " type="reset">Go back</a>
		
				</div>
			
		</form>
	</div>
</div>






