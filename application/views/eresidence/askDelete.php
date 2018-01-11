 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container">
  	

      <div class="starter-template">
        <h1>Are you sure you want to cancel your request?</h1>
        <p>This operation can not be cancelled</p>
        <?php
                    

$action= "residents/requestPreview";
  $options = array("class"=>"form-horizontal ","method"=>"POST");
  echo form_open($action,$options);
  ?> 
  
      
      <input type="hidden" name="user_id" value="<?php echo isset($user_id) ? $user_id:0;?>" >
      <input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id:0;?>">
     
         <button type="submit" name="cancel" class ="btn btn-default btn-md" title="Cancel">NO
          <span class="glyphicon glyphicon-remove"></span></button>
          
       </form>
       <?php $action= "residents/requestPreview";
  $options = array("class"=>"form-horizontal ","method"=>"POST");
  echo form_open($action,$options);
  ?> 
  
      <input type="hidden" name="" value="<?php echo isset($id_vehicle) ? $id_vehicle:0;?>" placeholder="">
       
         <button type="submit" class ="btn btn-default btn-md" title="Yes Cancel">YES
          <span class="glyphicon glyphicon-ok"></span></button>
					
       </form>
      
      </div>

    </div><!-- /.container -->