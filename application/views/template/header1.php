<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/pic/logo3.png') ?>"  class="logo" alt="Logo" ></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li <?php echo setMenuActiveItem ($pageActive == "home")?>><a href="<?php echo base_url() ?>">Home</a></li>
        <li <?php echo setMenuActiveItem ($pageActive == "about")?>><a href="<?php echo base_url('publiczone/about') ?>">About</a></li>
        <li <?php echo setMenuActiveItem ($pageActive == "contact")?>><a href="<?php echo base_url('publiczone/Contact') ?>">Contact</a></li>
        <li>              
          <a class="btn dropdown-toggle btn-bkg" type="button" data-toggle="dropdown">E-Residence  &nbsp;&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu dropdownmenu">
            <li <?php echo setMenuActiveItem ($pageActive == "Request")?>><a href="<?php echo base_url('residents/request') ?>">Request</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "Manage Property")?>><a href="<?php echo base_url('residents/eresidence') ?>">Manage Property</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "Manage Residents")?>><a href="<?php echo base_url('residents/eresidence') ?>">Manage Residents</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "listOfRes")?>><a href="<?php echo base_url('residents/eresidence')?>">List of Residents</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "ownersProperty")?>><a href="<?php echo base_url('residents/ownersProperty') ?>">Owners Property</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "ownersDetails")?>><a href="<?php echo base_url('residents/ownersDetails') ?>">Owners Details</a></li>
          </ul>
        </li>
      <!--/ul>
      <ul class="nav navbar-nav" -->
        
       <li><?php echo (isset($_SESSION['username']) )?  '<a id="loginButton" href="'.base_url('publiczone/logout') .'"><span>Login</span></a>':'
       
        <a id="loginButton" href="'. base_url('login/login_').' "><span>Login</span></a>'?>
        </li>
       <!--li <?php echo setMenuActiveItem ($pageActive == "login")?>><a  id="loginButton" href="<?php echo base_url() ?>"><span>Login</span></a></li
       -->
     </ul>
   </div><!--/.nav-collapse -->
 </div>
</nav>
<div class="dropdown-grids">
                        <div id="loginContainer">
                            
                            <div id="loginBox">                
                                <!--form id="loginForm"-->
                                  <?php

$options = array("id"=>"loginForm", "method"=>"POST");
echo form_open("login/login_",$options); 
?>
                                    <div class="login-grids" >
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
