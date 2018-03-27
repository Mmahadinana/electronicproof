<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>



<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      
      <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/logos/Logos.jpg') ?>"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li <?php echo setMenuActiveItem ($pageActive == "home")?>><a href="<?php echo base_url() ?>">Home</a></li>
        <li <?php echo setMenuActiveItem ($pageActive == "about")?>><a href="<?php echo base_url('publiczone/about') ?>">About</a></li>
        <li <?php echo setMenuActiveItem ($pageActive == "contact")?>><a href="<?php echo base_url('publiczone/Contact') ?>">Contact</a></li>
        <li <?php echo setMenuActiveItem ($pageActive == "index")?>><a href="<?php echo base_url('Testing/index') ?>">Pdf</a></li>

        <!--!!!!!!!!!!!!!!!!!!!!!!!!Links and pages that will be views viewed by administrator !!!!!!!!!!!!!!!!!!!!!!!!!-->
        <?php if(isset($_SESSION['email']) && $_SESSION['role'] == "admin"){ ?>
        <li><a href="<?php echo base_url('residents/Admin') ?>">Admin Area</a></li>  

        <?php } if(isset($_SESSION['email']) && $_SESSION['role'] == "resident") { ?>
        
        <li <?php echo setMenuActiveItem ($pageActive == "Request")?>><a href="<?php echo base_url('request_proof/request') ?>">Request</a></li>
        <?php } if(isset($_SESSION['email']) && $_SESSION['role'] == "owner") { ?>
        <!--!!!!!!!!!!!!!!!!!!!!!Links and pages that will be views viewed by residents and owners !!!!!!!!!!!!!!!!!!!!!!!!!!-->
        <li  class='dropdown'>             
          <a class="btn dropdown-toggle btn-bkg" data-toggle="dropdown" aria-expanded="false">E-Residence  &nbsp;&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu dropdownmenu " >
            <li <?php echo setMenuActiveItem ($pageActive == "Request")?>><a href="<?php echo base_url('request_proof/request') ?>">Request</a></li>
            
            <li <?php echo setMenuActiveItem ($pageActive == "confirmList")?>><a href="<?php echo base_url('request_proof/confirmList')?>">Confirm List</a></li> 

            
            <li <?php echo setMenuActiveItem ($pageActive == "ownersDetails")?>><a href="<?php echo base_url('residents/ownersDetails')?>">Owner's Details</a></li>

          </ul>
        </li>
        <?php } ?>
        <!--to be converted into button-->
        <li> <?php echo (isset($_SESSION['email']) )? '<a href="'. base_url("Publiczone/logout").'">
          Logout '.$_SESSION['name'].' <span class="text-success">'.ucfirst($_SESSION['role']).'</span></a>':'<a href="'.base_url("login/login_").'">
          Login </a>';?>
        </li>
        <li <?php echo (isset($_SESSION['email']))? "class=' '":"class='hidden'"?>> 
             <a href="<?php echo base_url('residents/userprofile') ?>">My Profile</a>
        </li> 
        <li <?php echo (isset($_SESSION['email']))? "class=' '":"class='hidden'"?>> 
              <a href="<?php echo base_url('residents/userprofile') ?>" class="fa fa-bell fa-2x">
                <span class="badge badge-xs badge-danger notify_badge"></span>
              </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>E-Residence</h1> 


</div>
<?php
/*
    breadcrumb

 
// This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
    
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
    $combine=array();
    // This will build our "base URL" ... )
    $base = base_url();
 for ($i = 1; $i < count($path); ++$i) {
  $combine[$i]=$path[$i].'/'.$path[$i+1];
 }
 $combine=array_slice($combine,1);
    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
    $breadcrumbs = Array("<a href=\"$base\">$home</a>");

    // Find out the index for the last value in our path array
    $last = end($combine);
  
    // Build the rest of the breadcrumbs
    foreach ($combine AS $x => $crumb) {
        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
        $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));
 
        // If we are not on the last index, then display an <a> tag
        if ($x != $last)
            $breadcrumbs[] = "<a href=\"$base$crumb\">$title</a>";
        // Otherwise, just display the title (minus)
        else
            $breadcrumbs[] = $title;
    }
 
    // Build our temporary array (pieces of bread) into one big string :)
    return implode($separator, $breadcrumbs);
}
 
?>
 
<?php
// Default options - Home » Page Title
echo breadcrumbs() ;*/
// Change » to >
// echo breadcrumbs(' > ');
// Change 'Home' to 'Index' and » to ^^
// echo breadcrumbs(' ^^ ', 'Index');
?>
