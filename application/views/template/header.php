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
          <button class="btn dropdown-toggle btn-bkg" type="button" data-toggle="dropdown">E-Residence<span class="caret"></span></button>
          <ul class="dropdown-menu navbar-nav">
            <li <?php echo setMenuActiveItem ($pageActive == "Request")?>><a href="<?php echo base_url('residents/eresidence') ?>">Request</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "Manage Property")?>><a href="<?php echo base_url('residents/eresidence') ?>">Manage Property</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "Manage Residents")?>><a href="<?php echo base_url('residents/eresidence') ?>">Manage Residents</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "Profile")?>><a href="<?php echo base_url('residents/eresidence') ?>">Profile</a></li>
          </ul>
        </li>
      </ul>
      <ul>
      <li <?php echo setMenuActiveItem ($pageActive == "Register")?>><a href="<?php echo base_url('publiczone/register') ?>">Register</a></li>
       <li <?php echo setMenuActiveItem ($pageActive == "login")?>><a href="<?php echo base_url('login/login_') ?>">Login</a></li>
     </ul>
   </div><!--/.nav-collapse -->
 </div>
</nav>

