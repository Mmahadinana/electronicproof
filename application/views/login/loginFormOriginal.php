<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="starter-template">    
  <div class="container form-area12"> 
  <!--div class="card-container card"-->    
    <h1> Login </h1>
    
    <?php
//var_dump($_SESSION ['user_time']);
if (isset($statusUsername)) {
   echo alertMsg($statusResetPass,'Password reset successfully ','Username not found ');
 }
 if (isset($statusUserInsert)) {
   echo alertMsg($statusUserInsert,'You have successfully registered ','Failed registration or User is in session');
 }
    $action="login/login_/";

    echo form_open($action,array('class'=>'form-horizontal','method'=>'POST'));?>


    <div class="form-group ">
      <label  for="email" class="col-sm-4">Username</label> 
      <div class="col-lg-6 col-xs-12">
        <input type="text" id="email" name="username" class="form-control" placeholder="Email address" value="<?php echo  set_value('username') ;?>">
        <p><?php echo form_error('username') ? alertMsg(false,'username',form_error('username')) : ''; ?></p>
      </div>
      
    </div>
    <div class="form-group ">

      <label for="inputPassword" class="col-sm-4">Password</label>

      <div class="col-lg-6 col-xs-12">
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ;?>">
        <p ><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
      </div>
        
      </div>
      
      <div class="col-md-6 text-right" >
      
      <button class="btn btn-lg btn-primary" type="submit">Sign in</button>
    </div>
      <div class="col-md-3 text-left" >
        <a href="<?php echo base_url('passwords/reset/') ?>" class="forgot-password"><span>Forgot Password?</span></a><br>
      <a href="<?php echo base_url('publiczone/register') ?>" class="text-white"><span>New account? Signup</span></a>
      </div>
      
    </form><!--/form -->
  
  <!--div class="dropdown-grids">
                        <div id="loginContainer">
                            
                            <div id="loginBox">                
                                <form id="loginForm"-->
                                  <?php

/*$options = array("id"=>"loginForm", "method"=>"POST");
echo form_open("login/login_",$options); */
?>
                                    <!--div class="login-grids" >
                                        <div class="login-grid-left">
                                            <fieldset id="body">
                                                <fieldset>
                                                    <label for="email">Email Address</label>
                                                    <input type="email" name="username" id="email" placeholder="Email address" value="<?php set_value('username')?>">
                                                </fieldset>
                                                <fieldset>
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password">
                                                </fieldset>
                                                <input type="submit" id="login" value="Sign in">
                                                <label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label>
                                            </fieldset>
                                            <span><a href="<?php echo base_url('login/reset/') ?>">Forgot your password?</a></span>
                                            <div class="or-grid">
                                                <p>OR</p>
                                            </div>
                                            <div class="social-sits"-->
                                                <!--input type="hidden" name="referrer" value="<?php echo $referrer ?>"-->
                                                <!--div class="button-bottom">
                                                    <p> <a href="<?php echo base_url('publiczone/registerUser') ?>">New account? Signup</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div-->
                        </div>
                </div>
  <!-- /div></card-container -->
<!--/div>< /container --><!-- /.container -->