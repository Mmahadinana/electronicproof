<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('html.php');
?>
<body>
  <div class="starter-template">
  	
      <?php
 $this->load->view('template/header');
 //echo password_hash("rosy", PASSWORD_BCRYPT);

 	 $this->load->view($pageToLoad);

 
 ?>
 

</div>
<?php
$this->load->view('template/footer'); 
?>

<script > 
// Login Form
$(function() {
    var button = $('#loginButton');
    var box = $('#loginBox');
    var form = $('#loginForm');
    button.removeAttr('href');
    button.mouseup(function(login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(login) {
        if(!($(login.target).parent('#loginButton').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });
});</script>

    
  </body>