 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container" id="askDelete">
  	

      <div class="starter-template">
        <h1>Are you sure you want to cancel your request?</h1>
        <p>This operation can not be cancelled</p>
        <div class="">
          <div class="col-lg-3 pull-right align-left">
          <?php                

$action= "residents/userprofile";
  $options = array("class"=>"form-horizontal ","method"=>"POST");
  echo form_open($action,$options);
  ?> 
  
      
      <input type="hidden" name="user_id" value="<?php echo $user_id;?>" >
      <input type="hidden" name="property_id" value="<?php echo $property_id;?>">
     
         <button type="submit" name="cancel" class ="btn btn-default btn-md" title="No Cancel">NO
          <span class="glyphicon glyphicon-remove"></span></button>
          
       </form>
        </div>
        <div class="col-lg-3 pull-right"> 
       <?php $action= "residents/userprofile";
  $options = array("class"=>"form-horizontal ","method"=>"POST");
  echo form_open($action,$options);
  ?> 
  
      <input type="hidden" name="" value="<?php echo isset($property_id) ? $property_id:0;?>" placeholder="">
       
         <button type="submit" class ="btn btn-default btn-md" title="Yes Cancel">YES
          <span class="glyphicon glyphicon-ok"></span></button>
					
       </form>
      </div>
      </div>

    </div><!-- /.container -->