<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<!--div class="starter-template"-->		
	<div class="container">	
	<!--div class="card-container card"-->		
		
		
		<?php

		/*$action="login/login_/";

		echo form_open($action,array('class'=>'form-horizontal'));*/?>


		<div class="dropdown-grids">
                        <div id="loginContainer">
                          
                            <div id="loginBox">                
                                <form id="loginForm">
                                    <div class="login-grids" >
                                        <div class="login-grid-left">
                                         <h1> Login </h1> 
                                            <fieldset id="body">
                                                <fieldset>
                                                    <label for="email">Username</label>
                                                    <input type="text" name="username" id="email">
                                                </fieldset>
                                                <fieldset>
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password">
                                                </fieldset>
                                                <input type="submit" id="login" value="Sign in">
                                                <label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label>
                                            </fieldset>
                                            <span><a href="<?php echo base_url('publiczone/reset/') ?>">Forgot your password?</a></span>
                                            <div class="or-grid">
                                                <p>OR</p>
                                            </div>
                                            <div class="social-sits">
                                                <input type="hidden" name="referrer" value="<?php// echo $referrer ?>">
                                                <div class="button-bottom">
                                                    <p> <a href="<?php echo base_url('publiczone/registerUser') ?>">New account? Signup</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                </div>
	<!-- /div></card-container -->
<!--/div>< /container --><!-- /.container -->
