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
      <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/logos/Logos.jpg') ?>"  class="logo" alt="Logo" ></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li <?php echo setMenuActiveItem ($pageActive == "home")?>><a href="<?php echo base_url() ?>">Home</a></li>
        <li <?php echo setMenuActiveItem ($pageActive == "about")?>><a href="<?php echo base_url('publiczone/about') ?>">About</a></li>
        <li <?php echo setMenuActiveItem ($pageActive == "contact")?>><a href="<?php echo base_url('publiczone/Contact') ?>">Contact</a></li>
        <li <?php echo (isset($_SESSION['email']) )? "class=' '" : "class='hidden'"?> >             
          <a class="btn dropdown-toggle btn-bkg" type="button" data-toggle="dropdown">E-Residence  &nbsp;&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu dropdownmenu " >
            <li <?php echo setMenuActiveItem ($pageActive == "Request")?>><a href="<?php echo base_url('residents/request') ?>">Request</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "Manage Property")?>><a href="<?php echo base_url('residents/eresidence') ?>">Manage Property</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "Manage Residents")?>><a href="<?php echo base_url('residents/eresidence') ?>">Manage Residents</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "listOfRes")?>><a href="<?php echo base_url('residents/listOfResidents')?>">List of Residents</a></li><li <?php echo setMenuActiveItem ($pageActive == "confirmList")?>><a href="<?php echo base_url('residents/confirmList')?>">Confirm List</a></li>
           
            <li <?php echo setMenuActiveItem ($pageActive == "ownersProperty")?>><a href="<?php echo base_url('residents/ownersProperty') ?>">Owners Property</a></li>
            <li <?php echo setMenuActiveItem ($pageActive == "ownersDetails")?>><a href="<?php echo base_url('residents/ownersDetails') ?>">Owners Details</a></li>
          </ul>
        </li>
      <!--/ul>
      <ul class="nav navbar-nav" -->
       <li> <?php echo (isset($_SESSION['email']) )? '<a href="'. base_url("Publiczone/logout").'">
              Logout '.$_SESSION['name'].' <span class="text-success">'.ucfirst($_SESSION['role']).'</span></a>':'<a href="'.base_url("login/login_").'">
             Login </a>';?>
        </li>
       <!--li <?php echo setMenuActiveItem ($pageActive == "login")?>><a  id="loginButton" href="<?php echo base_url() ?>"><span>Login</span></a></li-->
     </ul>
   </div><!--/.nav-collapse -->
 </div>
</nav>

