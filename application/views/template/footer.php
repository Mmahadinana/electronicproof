<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<footer>
  <div class="navbar footer"> &copy; E_Residence 2017
    <div class="pull-right footPadRight">
    <a href="<?php echo base_url('login/resetpassword') ?>"><i class="fa fa-cog"></i></a>
    
    <a href="<?php echo base_url('publiczone/help') ?>"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
  </div></div>
  
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

   
  <!--script src="js/ie-emulation-modes-warning.js"></script-->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>    
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--script src="js/bootstrap.min.js"></script-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--script src="js/ie10-viewport-bug-workaround.js"></script-->
     <?php 
  $Js_Files=['ie-emulation-modes-warning.js',
  'bootstrap.min.js',
  'ie10-viewport-bug-workaround.js',
'myjs.js'];

  foreach ($Js_Files as $js_file) {?>
    <link src="<?php echo base_url('assets/js/'.$js_file);?>" rel="stylesheet"><?php
  }
  ?>
</footer>
