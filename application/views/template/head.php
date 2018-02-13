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

    <title>E_Residence</title>

     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2./jquery.min.js"></script>
  <script src="./js/numeric-1.2.6.min.js"></script>
  <script src="./js/bezier.js"></script-->

  
  <script src="https:github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
    <!--script src="./js/jason2.min.js"></script-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <?php 
  $Css_Files=[
    'bootstrap.min.css',
    'font-awesome.css',
  'ie10-viewport-bug-workaround.css',
  'master.css',
  'admin.css',
  'navigator.css',
  'substyle.css','particles.css',
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
 <script src='<?php echo base_url("assets/js/jquery.bootpag.js")?>'></script>
  </head>