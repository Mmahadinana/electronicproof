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
            <li <?php echo setMenuActiveItem ($pageActive == "Profile")?>><a href="<?php echo base_url('residents/eresidence') ?>">Profile</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "Profile")?>><a href="<?php echo base_url('residents/eresidence') ?>">Profile</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "listOfRes")?>><a href="<?php echo base_url('residents/eresidence') ?>">List of Residents</a></li>

          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav" >
      <li <?php echo setMenuActiveItem ($pageActive == "Register")?>><a href="<?php echo base_url('publiczone/register') ?>">Register</a></li>
       <li <?php echo setMenuActiveItem ($pageActive == "login")?>> <div class="dropdown-grids">
                        <div id="loginContainer">
                            <a id="loginButton"><span>Login</span></a>
                            <div id="loginBox">                
                                <form id="loginForm">
                                    <div class="login-grids">
                                        <div class="login-grid-left">
                                            <fieldset id="body">
                                                <fieldset>
                                                    <label for="email">Email Address</label>
                                                    <input type="text" name="email" id="email">
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
                                                
                                                <div class="button-bottom">
                                                    <p> <a href="<?php echo base_url('publiczone/register') ?>">New account? Signup</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div></li>
       <!--li <?php echo setMenuActiveItem ($pageActive == "login")?>><a  id="loginButton" href="<?php echo base_url() ?>"><span>Login</span></a></li-->
     </ul>
   </div><!--/.nav-collapse -->
 </div>
</nav>

