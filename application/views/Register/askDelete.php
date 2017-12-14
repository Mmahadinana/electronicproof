 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container">
  	

      <div class="starter-template">
        <h1>Are you sure you want to delete this user?</h1>
        <p>This operation can not be cancelled</p>
        <?php
                    

	$action= "publiczone/user";
	$options = array("class"=>"form-horizontal ","method"=>"POST");
	echo form_open($action,$options);
	?> 
	
	    <input type="hidden" name="id_vehicle" value="<?php echo isset($id_vehicle) ? $id_vehicle:0;?>" placeholder="">
       <a href ="<?php echo base_url("publiczone/user/") ?>" class ="btn btn-default " title="No Delete">NO
					<span class="glyphicon glyphicon-remove"></span></a>
         <button type="submit" class ="btn btn-default btn-md" title="Yes Delete">YES
					<span class="glyphicon glyphicon-ok"></span></button>
					
       </form>
      
      </div>

    </div><!-- /.container -->