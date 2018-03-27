<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('html.php');
?>

<div class="starter-template">
	<div class="container">
		<h1 class="text-left">Help</h1>
		<div class="row">
			<div class="col-lg-4 pull-left">

				<div class="panel-group text-left" id="accordion">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">LOGIN</a>
							</h4>
						</div>

						<div id="collapse1" class="panel-collapse collapse in">
							<div class="panel-body black-text">
								<ol class="h5">
									<li><a href="#Login">Login to the system</a></li>

									<li><a href="#Forgot">What do the user do when they Forgot Password</a></li>
									<li><a href="#Reset">How to Reset Password</a></li>
									<li><a href="#Change">How to Change Password</a></li>
								</ol>
							</div>
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse2"> How to get the Proof of Residence</a>
							</h4>
						</div>

						<div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body black-text">
								<ol class="orderedList h5">
									<li><a href="">Go to the your residential address</a></li>
									<li><a href="">Fill the Request Form</a></li>
									<li><a href="">Edit Request Form the Request Form</a></li>
									<li><a href="">Confirm the Information Provided</a></li>								
									<li><a href="">Waiting for approval</a></li>
									<li><a href="">Getting the proof of resident</a></li>
								</ol>						
							</div>
						</div>
					</div>			

					<div class="panel panel-info">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Register as a New User</a>
							</h4>
						</div>

						<div id="collapse4" class="panel-collapse collapse">
							<div class="panel-body black-text">
								<ol class="orderedList h5">
									<li><a href="#register">What do I do to register</a></li>
									<li><a href="#registerOwner">What do I do to register as owner of the Residence</a></li>
									<li><a href="#adduser">How to I add a new resident/s in my residential address </a></li>
									<li><a href="#residentialaddress">How to confirm the residential address </a></li>
									<li><a href="#waitapproval">Waiting for approval</a></li>										
									<li><a href="#UserAddress">Confirm User's Address</a></li>										
								</ol>									
							</div>
						</div>
					</div>

					<div class="panel panel-info">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">All the Lists</a></h4>
							</div>

							<div id="collapse5" class="panel-collapse collapse">
								<div class="panel-body black-text">

									<ol class="orderedList h5">
										<li><a href="#Confirmlist">List of Residents to Confirm</a></li>
										<li><a href="#Approvelist">List of Residents to Approve</a></li>												
										<li><a href="#Propartylist">List of Owner's Proparty</a></li>								

									</ol>	
								</div>
							</div>
						</div>

					</div>
				</div>
				
				<div>
					

					<div class="col-lg-8 pull-right danger text-left ">

						<!--This section is for How to login as user, reset and change password-->		
						<div id="Login"  class="section">
							<h2>Login</h2>
							<ul>
								<li><h5><b><i><u>Setup the account</h5></b></u></i></li>
								<p>type the password and username(email) to login</p>
								<p>if you forgot password you have to click forgot password link</p>												
								<p>if you want to change your password you have to click forgot password link </p>
								<p>when your password have expired the system will redirect your to change password</p>
								<p>when your are deceased your will be deleted</p>   
							</ul>
						</div>
						<div id="Forgot" class="section">
							<h2>Forgot password</h2>
							<ul>
								<li><h5><b><i><u>Click Forgot password</h5></b></u></i></li>
								<p>Is to insert your email for you to get a message through your email account</p>

							</ul>
						</div>
						<div id="Reset" class="section">
							<h2>Reset Password</h2>
							<ul>
								<li><h5><b><i><u>Click Forgot password</h5></b></u></i></li>
								<p>Is to insert your email for you to get a message through your email account</p>
								<p>then the user will back to their email account and click the link that was sent to you to send a password</p>
								<p>the link will direct you to change password page than you will able to login to the system again when you login</p>

							</ul>
						</div>
						<div id="Change" class="section">
							<h2>Change Password</h2>
							<ul>
								<li><h5><b><i><u>login</h5></b></u></i></li>										
								<p>Redirect to change password link</p>
								<li><h5><b><i><u>click button</h5></b></u></i></li>
								<p>Is to insert new password</p>
							</ul>
						</div>

						<!--This section is for How to register a user, resident and Owner-->		
						<div id="register"  class="section">
							<h2>Register</h2>
							<ul>
								<li><h5><b><i><u>Setup the account</h5></b></u></i></li>
								<p>Is to insert the password and username(email)</p>
								<li><h5><b><i><u>Adding Personal Details</h5></b></u></i></li>
								<p>Is to insert your personal information(full name,ID nº,date of birth,date of registration,phone,gender)</p>
								<li><h5><b><i><u>Adding residencial Address</h5></b></u></i></li>										
								<p>Is to insert the residencial information(Province,Distric,Municipality,town,suburb,Street address,Door nº)</p>	    
								<li><h5><b><i><u>Edit User's Details</h5></b></u></i></li>
								<p>Is to insert all the information(Setup the account</p>
								<p>Adding Personal Details</p>
								<p>Adding residencial Address)</p>						    		    
								<li><h5><b><i><u>Confirm your Details of the User</b></h5></u></i></li>
								<p>View all the information for user</p>
							</ul>
						</div>
						<div id="registerOwner" class="section">
							<h2>Register Owner</h2>
							<ul>
								<li><h5><b><i><u>Setup the account</h5></b></u></i></li>
								<p>Is to insert the password and username(email)</p>
								<li><h5><b><i><u>Adding Personal Details</h5></b></u></i></li>
								<p>Is to insert your personal information(full name,ID nº,date of birth,date of registration,phone,gender)</p>
								<li><h5><b><i><u>Adding residencial Address</h5></b></u></i></li>										
								<p>Is to insert the residencial information(Province,Distric,Municipality,town,suburb,Street address,Door nº)</p>	    
								<li><h5><b><i><u>Edit User's Details</h5></b></u></i></li>
								<p>Is to insert all the information(Setup the account</p>
								<p>Adding Personal Details</p>
								<p>Adding residencial Address)</p>						    		    
								<li><h5><b><i><u>Confirm your Details of the Owner</b></h5></u></i></li>
								<p>View all the information for user</p>									
							</ul>
						</div>
						<div id="adduser" class="section">
							<h2>Add User</h2>
							<ul>
								<li><h5><b><i><u>Setup the account</h5></b></u></i></li>
								<p>Is to insert the password and username(email)</p>
								<li><h5><b><i><u>Adding Personal Details</h5></b></u></i></li>
								<p>Is to insert your personal information(full name,ID nº,date of birth,date of registration,phone,gender)</p>
								<li><h5><b><i><u>Adding residencial Address</h5></b></u></i></li>
								<p>Is to insert the residencial information(Province,Distric,Municipality,town,suburb,Street address,Door nº)</p>
								<li><h5><b><i><u>Fill in owner information</b></h5></u></i></li>
								<p>Is to insert personal information about the owner of tha proparty such as (full name,ID nº,date of birth,date of registration,phone,gender,email)</p>
								<li><h5><b><i><u>Confirm your Details of the User</b></h5></u></i></li>
								<p>View all the information for user</p>
							</ul>
						</div>
						<div id="residentialaddress"  class="section">
							<h2>How to confirm the residential address</h2>
							<ul>
								<li><h5><b><i><u>Setup the account</h5></b></u></i></li>
								<p>Is to insert the password and username(email)</p>
								<li><h5><b><i><u>Adding Personal Details</h5></b></u></i></li>
								<p>Is to insert your personal information(full name,ID nº,date of birth,date of registration,phone,gender)</p>
								<li><h5><b><i><u>Adding residencial Address</h5></b></u></i></li>
								<p>Is to insert the residencial information(Province,Distric,Municipality,town,suburb,Street address,Door nº)</p>   		    
								<li><h5><b><i><u>Edit User's Details</h5></b></u></i></li>
								<p>Is to insert all the information(Setup the account</p>
								<p>Adding Personal Details</p>
								<p>Adding residencial Address)</p>						    		    
								<li><h5><b><i><u>Confirm your Details of the User</b></h5></u></i></li>
								<p>View all the information for user</p>
							</ul>
						</div>
						<div id="waitapproval" class="section">
							<h2>Waiting for approval</h2>
							<ul>
								<li><h5><b><i><u>Setup the account</h5></b></u></i></li>
								<p>Is to insert the password and username(email)</p>
								<li><h5><b><i><u>Adding Personal Details</h5></b></u></i></li>
								<p>Is to insert your personal information(full name,ID nº,date of birth,date of registration,phone,gender)</p>
								<li><h5><b><i><u>Adding residencial Address</h5></b></u></i></li>
								<p>Is to insert the residencial information(Province,Distric,Municipality,town,suburb,Street address,Door nº)</p>
								<li><h5><b><i><u>Fill in owner information</b></h5></u></i></li>
								<p>Is to insert personal information about the owner of tha proparty such as (full name,ID nº,date of birth,date of registration,phone,gender,email)</p>
								<li><h5><b><i><u>Confirm your Details of the Owner</b></h5></u></i></li>
								<p>View all the information for user</p>
							</ul>
						</div>
						<div id="UserAddress" class="section">
							<h2>Confirm User's Address</h2>
							<ul>
								<li><h5><b><i><u>Setup the account</h5></b></u></i></li>
								<p>Is to insert the password and username(email)</p>
								<li><h5><b><i><u>Adding Personal Details</h5></b></u></i></li>
								<p>Is to insert your personal information(full name,ID nº,date of birth,date of registration,phone,gender)</p>
								<li><h5><b><i><u>Adding residencial Address</h5></b></u></i></li>
								<p>Is to insert the residencial information(Province,Distric,Municipality,town,suburb,Street address,Door nº)</p>
								<li><h5><b><i><u>Fill in owner information</b></h5></u></i></li>
								<p>Is to insert personal information about the owner of tha proparty such as (full name,ID nº,date of birth,date of registration,phone,gender,email)</p>
								<li><h5><b><i><u>Confirm your Details of the User</b></h5></u></i></li>
								<p>View all the information for user</p>
							</ul>
						</div>

						<!--This section guid throught the list of residents page and owners, also to confirm and approved list-->		
						<div id="Confirmlist"  class="section">
							<h2>List of Residents to Confirm</h2>
							<ul>
								<li><h5><b><i><u>Setup the account</h5></b></u></i></li>
								<p>Is to insert the password and username(email)</p>
								<li><h5><b><i><u>Adding Personal Details</h5></b></u></i></li>
								<p>Is to insert your personal information(full name,ID nº,date of birth,date of registration,phone,gender)</p>
								<li><h5><b><i><u>Adding residencial Address</h5></b></u></i></li>
								<p>Is to insert the residencial information(Province,Distric,Municipality,town,suburb,Street address,Door nº)</p>   		    
								<li><h5><b><i><u>Edit User's Details</h5></b></u></i></li>
								<p>Is to insert all the information(Setup the account</p>
								<p>Adding Personal Details</p>
								<p>Adding residencial Address)</p>						    		    
								<li><h5><b><i><u>Confirm your Details of the User</b></h5></u></i></li>
								<p>View all the information for user</p>
							</ul>
						</div>
						<div id="Approvelist" class="section">
							<h2>List of Residents to Approve</h2>
							<ul>
								<li><h5><b><i><u>Setup the account</h5></b></u></i></li>
								<p>Is to insert the password and username(email)</p>
								<li><h5><b><i><u>Adding Personal Details</h5></b></u></i></li>
								<p>Is to insert your personal information(full name,ID nº,date of birth,date of registration,phone,gender)</p>
								<li><h5><b><i><u>Adding residencial Address</h5></b></u></i></li>
								<p>Is to insert the residencial information(Province,Distric,Municipality,town,suburb,Street address,Door nº)</p>
								<li><h5><b><i><u>Fill in owner information</b></h5></u></i></li>
								<p>Is to insert personal information about the owner of tha proparty such as (full name,ID nº,date of birth,date of registration,phone,gender,email)</p>
								<li><h5><b><i><u>Confirm your Details of the Owner</b></h5></u></i></li>
								<p>View all the information for user</p>
							</ul>
						</div>
						<div id="Propartylist" class="section">
							<h2>List of Owner's Property</h2>
							<ul>
								<li><h5><b><i><u>Setup the account</h5></b></u></i></li>
								<p>Is to insert the password and username(email)</p>
								<li><h5><b><i><u>Adding Personal Details</h5></b></u></i></li>
								<p>Is to insert your personal information(full name,ID nº,date of birth,date of registration,phone,gender)</p>
								<li><h5><b><i><u>Adding residencial Address</h5></b></u></i></li>
								<p>Is to insert the residencial information(Province,Distric,Municipality,town,suburb,Street address,Door nº)</p>
								<li><h5><b><i><u>Fill in owner information</b></h5></u></i></li>
								<p>Is to insert personal information about the owner of tha proparty such as (full name,ID nº,date of birth,date of registration,phone,gender,email)</p>
								<li><h5><b><i><u>Confirm your Details of the User</b></h5></u></i></li>
								<p>View all the information for user</p>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>





	<script >

		$(' a').click(function(e)
		{
    // Special stuff to do when this link is clicked...

    // Cancel the default action
   // e.preventDefault();
   //event.stopPropagation();

});
</script>