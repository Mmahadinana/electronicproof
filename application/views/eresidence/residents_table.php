<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container ">

  <h1 >Residents</h1> 
  
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
            <th>List Of Residents</th>
            <th>Edit</th>
            <th>Delete</th>
            
          </tr>
        </thead>
        <tbody>
         
         <?php    
 //var_dump($user_addinfor);
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
              <button type="submit" name="confirm"   class="btn btn-md glyphicon glyphicon-pencil text-primary" title="Edit"><span class="text-success"></span></button>
            </form><?php  } else{ '';}?>
          </td>
          

          <td><button href ="<?php echo base_url("residents/listOfResidents/".$key1->user_id) ?>" class ="btn btn-default btn-md" title="Delete">
            <span class="glyphicon glyphicon-trash text-danger"></span></button></td>
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
            </form>
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
            <select id="hide_user" name="user_id" class="form-control">
             
         
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

    $('#add1').on('click',function(event){
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
    alert(aduser_id);
    console.log(ad_id);
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
*/
      });

  });

</script>