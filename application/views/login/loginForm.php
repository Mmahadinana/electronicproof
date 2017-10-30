<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="starter-template">
<div class="container">
        <div class="card card-container">
            
           
            <?php
            
            $action="login/login/";

		echo form_open($action,array('class'=>'form-horizontal col-md-offset-2 col-md-8'));?>
		
               <div class="form-control">
               	<span class="label label-info">Info</span>
               </div>
        
                <input type="text" id="email" name="username" class="form-control" placeholder="Email address" value="<?php echo  set_value('username') ;?>">
                <p><?php echo form_error('username') ? alertMsg(false,'username',form_error('username')) : ''; ?></p>
                <h5>
        
        <span class="label label-info">Info</span>
        
      </h5>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password') ;?>">
                <p><?php echo form_error('password') ? alertMsg(false,'password',form_error('password')) : ''; ?></p>
                
                <div id="remember" class="checkbox">
                    <label>
                     <input type="checkbox" name="rememberme" value="rememberme">Rememberme
                    </label>
                </div>
               <input type="hidden" id="referrer" name="referrer" value="<?php //echo $referrer; ?>">
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <p class="">
            <a href="#" class="forgot-password">Forgot password?</a>
        </p>
        </div><!-- /card-container -->
    </div><!-- /container --><!-- /.container -->
</div>