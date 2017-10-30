<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('html.php');
?>
<body>
  <div class="starter-template">
      <?php
 $this->load->view('template/header');
 $this->load->view($pageToLoad);

 
?>
</div>
<?php
$this->load->view('template/footer'); 
?>
    


    
  </body>