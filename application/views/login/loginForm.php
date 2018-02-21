<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="starter-template">    
 
  <!--div class="card-container card"-->    
    
    
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


    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Sign In </h2>
    <h2 class="inactive underlineHover"><a href="<?php echo base_url('publiczone/register') ?>" class="text-white"><span>Signup</span></a>
</h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form>
      <input type="text" id="email" name="username" class="fadeIn second" name="login" placeholder="Email address" value="<?php echo set_value('username') ;?>">
              <p><?php echo form_error('username') ? alertMsg(false,'username',form_error('username')) : ''; ?></p>

         <input type="password" id="password" name="password" class="fadeIn third" name="login" placeholder="Password" value="<?php echo set_value('username') ;?>">

        <p ><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a href="<?php echo base_url('passwords/reset/') ?>" class="underlineHover"><span>Forgot Password?</span> </a>

    </div>

  </div>
</div>
</div>