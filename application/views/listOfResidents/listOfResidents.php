<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container ">

  <h1 >Owner at this residents</h1> 
  
  <?php
  
//stores property id to be send to add a user
$property_id=0;
  $action="residents/listOfResidents/";

  echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data',' autocomplete'=>'off'));?>
  <div class="form-area9">
    <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>    
    <input type="hidden" id="property_id" name="property_id" value=<?php echo $_SESSION['property_id']; ?>>
  </form>
  <div class="row tablereq">
    <div id="message">
      
    </div>
    <div class="col-md-10">
     
     <table class="table text-left romtbl_borders">

      <tbody>
        <tr>
          <td>Date</td>
          <td class="text-primary"><?php  echo date('Y / m / d')?></td>

        </tr>
        <tr>

          <td>
            <?php    


            foreach ($add_addinfor as $key ) {

              //saving value of property id
              $property_id=$key->property;
              ?>

            </td>
          </tr>
          <tr>
            <td rowspan="7">Address</td>               
            <td ><?php  echo $key->door_number.$key->street_name?></td>      
          </tr>

          <tr>
            <td><?php  echo $key->town?></td>

          </tr>
          <tr>
            <td><?php  echo $key->zip_code?></td>

          </tr>
          <tr>
            <td><?php  echo $key->manucipality?></td>

          </tr>
          <tr>
            <td><?php  echo $key->district?></td>

          </tr>
          <tr>
            <td><?php  echo $key->province?></td>            
            </tr><?php
          }
          ?>
          
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
          <tr>
            <?php if($_SESSION['role']!='admin') {
              //view for owner?>
            <th colspan="2">Owners</th>
            <th >Registration Date</th>
            
            <?php ; }else {
              //view for admin  ?>
            <th colspan="3">Owners</th>
            <?php ;} ?>      
            
          </tr>
        </thead>
        <tbody>
         
         <?php    

         foreach ($user_addinfor as $key1) {


          ?>
          <tr class="warning text-danger">
            <td><?php  echo $key1->name;?></td>

            <td>
              <?php
              if ($_SESSION['id']==$key1->user_id) {
                
             
              $action="publiczone/editUser";

              echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>

              <input type="hidden" name="userid" value=<?php echo $key1->user_id; ?>>
              <input type="hidden" id="primary_ad" name="primary_ad" value=<?php echo $key1->address_id; ?>>
              <input type="hidden" name="usercheck" value="true">
              <button type="submit" name="confirm"   class="btn btn-md glyphicon glyphicon-pencil text-default" title="Edit"></button><span class="text-info"> This is you</span>
            </form><?php  } else{?> 

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
            
          

          <td><?php if($_SESSION['role']!='admin') {
              echo $key1->date_registration;
              }else {?>
               <a href ="#" class ="btn btn-default btn-md delete_owner" data-userid="<?php echo $key1->user_id; ?>" data-propid="<?php echo $key1->property; ?>" title="Delete">
                  <span class="glyphicon glyphicon-trash text-danger"></span>
               </a>
          </td>
          <?php } ?>
              
            
             </tr>
             <?php } ?> 
         <!--tr>
      
          </tr> 
         
           
          
             <td>Add new Resident</td>
        <td></td>
       <td>
              <?php

              $action="publiczone/registerUser";

              echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


              <input type="hidden" name="userid" value=<?php echo $key1->user_id; ?>>
              <input type="hidden" name="usercheck" value="true">
              <button name="confirm"  id="add1" class="btn btn-md glyphicon glyphicon-plus text-primary" title="Add"><span class="text-success"></span></button>
            </form>
          </td></tr-->
        </tbody>
      </table>

    <!--search div -->
  <div id="manage_res" >
      
  </div>
 <!-- End search div -->

  </div>
</div>
<!-- /form -->
</div>

<!--show search div onclick -->
<script type="text/javascript">
$(document).ready(function(){
$( "#manage_res" ).load("manage_residents"); 
});
/*    $('#add1').on('click',function(event){
      event.preventDefault();
      $('#add').show();
       
    });
    var useremail=$('.useremail');
    //hide the div
        $('#hide_owner').hide();
        //filter by email of user
  $('#mysearch').on('keyup',function(){
       //store the valeus of search
       var data = $(this).val();

       if(data !=''){
        $.ajax({
        // url: "getOwner",
         url: "getUser",
         method: "POST",
         data: {'mysearch': data },
         dataType: "json",   
         success:function(userval)
         {
          //useremail=ownerval;
         console.log(userval);
              //show the div  
             $('#hide_owner').show();
             //append data in the div
            // $('#hide_owner').html(userval['mail'],userval['userid']);      
             $('#hide_user').html(userval);      
              
         },
          error: function(){
                       alert('has error');
                     }

        });

      }  

  });
  $(document).on('change','#hide_user',function(e){
    e.preventDefault();
    var ad_id=$('#primary_ad').val();
     var aduser_id=$(this).val();
    //alert(aduser_id);
   // console.log(ad_id);
   $.post('addUserAddress',{primary_ad:ad_id,user_id:aduser_id},function(data){
    
     //reload the div (manage_address) tab
      //$( "#man_address" ).load( "manage_address");   
      //send a message on html userprofile  
      $('#message').html(data);
     
        
      });
   /* $(this).append();
  })
   filterfield is the input field 
         $('#mysearch').on('keyup',function(){ 
          
         //store the value search         
          var data = $(this).val();
          if(data === ''){
            $('#hide_owner').hide();          
          }    
          else{
            $.post('getOwner',{mysearch:data},function(value){

              //console.log(value);
              console.log(data);
            //show the div  
               $('#hide_owner').show();
            //write data on the div
               $('#hide_owner').append(value[name]);
            });
        }

      });

  });*/

</script>