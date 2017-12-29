<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    

    <title>Getting Started with E_Residence</title>

     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <?php 
  $Css_Files=[
    'bootstrap.min.css',
    'font-awesome.css',
  'ie10-viewport-bug-workaround.css',
  'master.css',
  'substyle.css',
  'mystyle.css'];

  foreach ($Css_Files as $css_file) {?>
    <link href="<?php echo base_url('assets/css/'.$css_file);?>" rel="stylesheet">
   
    
    <?php
    

  }
  ?>
  <!--script src="js/ie-emulation-modes-warning.js"></script>
  <script src="js/myjs.js"></script-->
  <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
 
  </head>