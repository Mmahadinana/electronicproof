<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('html.php');
?>

<div class="starter-template">
	<h1>Help</h1>
	<div class="row">
		<div class="col-lg-4 pull-left">

			<div class="panel-group text-left" id="accordion">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">LOGIN</a></h3>
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
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse2"> How to get the Proof of Residence</a></h4>
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
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Register as a New User</a></h4>
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
								<!--div class="panel panel-info">
									<div class="panel-heading">

										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">South African Structure </a></h4>
										</div>
										<div id="collapse6" class="panel-collapse collapse">
											<div class="panel-body black-text">
												<ol class="orderedList h5">																				
												<li><a href="">List of Provinces in South Africa</a></li>
												<li><a href="">List of District in South Africa</a></li>
											</ol>
											</div>
										</div>
									</div-->
								</div>
							</div>
							<div class="col-lg-8 pull-right danger text-left ">

								<!--This section is for How to login as user, reset and change password-->		
								<div id="Login"  class="section">
									<h2>Login</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>						    		    
										<li>Edit User's Details</li>						    		    
										<li>Confirm your Details of the User</li>
									</ul>
								</div>
								<div id="Forgot" class="section">
									<h2>Forgot password</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>
										<li>Fill in owner information</li>
										<li>Confirm your Details of the Owner</li>
									</ul>
								</div>
								<div id="Reset" class="section">
									<h2>Reset Password</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>
										<li>Fill in owner information</li>
										<li>Confirm your Details of the User</li>
									</ul>
								</div>
								<div id="Change" class="section">
									<h2>Change Password</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>
										<li>Fill in owner information</li>
										<li>Confirm your Details of the User</li>
									</ul>
								</div>

								<!--This section is for How to register a user, resident and Owner-->		
								<div id="register"  class="section">
									<h2>Register</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>						    		    
										<li>Edit User's Details</li>						    		    
										<li>Confirm your Details of the User</li>
									</ul>
								</div>
								<div id="registerOwner" class="section">
									<h2>Register Owner</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>
										<li>Fill in owner information</li>
										<li>Confirm your Details of the Owner</li>
									</ul>
								</div>
								<div id="adduser" class="section">
									<h2>Add User</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>
										<li>Fill in owner information</li>
										<li>Confirm your Details of the User</li>
									</ul>
								</div>
								<div id="residentialaddress"  class="section">
									<h2>How to confirm the residential address</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>						    		    
										<li>Edit User's Details</li>						    		    
										<li>Confirm your Details of the User</li>
									</ul>
								</div>
								<div id="waitapproval" class="section">
									<h2>Waiting for approval</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>
										<li>Fill in owner information</li>
										<li>Confirm your Details of the Owner</li>
									</ul>
								</div>
								<div id="UserAddress" class="section">
									<h2>Confirm User's Address</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>
										<li>Fill in owner information</li>
										<li>Confirm your Details of the User</li>
									</ul>
								</div>

								<!--This section guid throught the list of residents page and owners, also to confirm and approved list-->		
								<div id="Confirmlist"  class="section">
									<h2>List of Residents to Confirm</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>						    		    
										<li>Edit User's Details</li>						    		    
										<li>Confirm your Details of the User</li>
									</ul>
								</div>
								<div id="Approvelist" class="section">
									<h2>List of Residents to Approve</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>
										<li>Fill in owner information</li>
										<li>Confirm your Details of the Owner</li>
									</ul>
								</div>
								<div id="Propartylist" class="section">
									<h2>List of Owner's Proparty</h2>
									<ul>
										<li>Setup the account</li>
										<li>Adding Personal Details</li>
										<li>Adding residentioal Address</li>
										<li>Fill in owner information</li>
										<li>Confirm your Details of the User</li>
									</ul>
								</div>

							</div>
						</div>



