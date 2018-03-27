<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-md-12">

  <h4 >Residents</h4> 
  
  <?php
  
//stores property id to be send to add a user
$property_id=0;
$count=0;
  ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="3" class="count_res"><?php //echo($count)?> Residents</th>
            
            <!--th>Edit</th>
            <th>Delete</th-->
            
          </tr>
        </thead>
        <tbody>
         
         <?php    
// var_dump($user_infor);
         foreach ($user_infor as $key1) {

          $count = $key1->number_of_residents;
          ?>
          <tr class="warning text-danger">
            <td><?php  echo $key1->name;?></td>

            <td>
              <?php
              if ($_SESSION['id']==$key1->user_id) {
                
             
              $action="publiczone/editUser";

              echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


              <input type="hidden" name="userid" value='<?php echo $key1->user_id; ?>'>
              <input type="hidden" id="primary_ad" name="primary_ad" value='<?php echo $key1->address_id; ?>'>
              <input type="hidden" name="usercheck" value="true">
              <button type="submit" name="confirm"   class="btn btn-md glyphicon glyphicon-pencil text-primary" title="Edit"><span class="text-success"></span></button>
            </form><?php  } else{

              ?>
          <!--Owner view user information -->
          <?php
              $action="residents/userDetails";
              echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


              <input type="hidden" name="userid" value='<?php echo $key1->user_id; ?>'>
              <input type="hidden" id="property_id" name="property_id" value='<?php echo $key1->property_id; ?>'>
              <input type="hidden" name="usercheck" value="true">
            <button name="" class="btn btn-md fa fa-eye text-primary" title="View user"><span class="text-success"></span></button> <?php ;} ?>
            </form>
             
          </td>
          
          <!--Owner delete user from this address -->
          <td>
            <input type="hidden" class="user_id" name="user_id" >
            <a href="#" type="button" data-userid="<?php echo $key1->user_id; ?>" data-propid="<?php echo $key1->property_id; ?>" class="btn btn-default fa fa-trash text-danger deleteAddress" ></a>
          </td>
             </tr>
         <tr>
      
          </tr> 
         
          <?php } ?>  
          
             <td>Add new Resident</td>
        <td></td>
       <td>
              <!--?php

              $action="publiczone/registerUser";

              echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


              <input type="hidden" name="userid" value=<?php echo $key1->user_id; ?>-->
              <input type="hidden" name="usercheck" value="true">
              <button name="confirm"  id="add1" class="btn btn-md glyphicon glyphicon-plus text-primary" title="Add"><span class="text-success"></span></button>
            <!--/form-->
          </td>
        </tbody>
      </table>

    <!--search div -->
      <div id="add" style="display:none">
       <!--div class="col-lg-3 col-sm-7"  >
      <select class="form-control" id="search" name="inputForSearch">              
        <option value= 0></option>     
        <option value= 1>Owner's Name</option>
      </select>
    </div-->   
          <div class="col-lg-7" >
              <input class="form-control" type="text" name="mysearch" id="mysearch" placeholder="email" >    
            <!--input class="form-control" type="text" name="mysearch" id="search" placeholder="search" value="<?php echo isset($search['mysearch']) ? $search['mysearch'] : '' ;?>"-->    
          </div> 
          
          <!--write the results of owner search here-->
          <div class="col-md-offset-1 col-lg-6 list-group text-left text-info" id="hide_owner">
            <select id="hide_user" name="userid" class="form-control">
             
         
            </select>
          </div>
           <!--div class="col-lg-7 col-sm-7">  
              <button class="btn btn-primary form-control" id="searchId" type="submit" name="bntSearch">Search</button>
          </div-->
  </div>
 <!-- End search div -->

  </div>
</div>
<!-- /form -->
</div>

<!--show search div onclick -->
<script type="text/javascript">
  $(document).ready(function(){
      var count=<?php echo($count)?>;
      $('.count_res').prepend("<b>"+count+"</b>: : ");
  })
</script>