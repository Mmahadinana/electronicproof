<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container ">

  <h1>Details</h1>

  <?php
//var_dump($user_addinfor);
//used to store the names of the user
$name='';
  $action="residents/details/";

  echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data'));?>
  <div class="form-area1">
    <input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>
      <div class="row tablereq">
    
      <table class="table text-left romtbl_borders"> 
      <thead >
        <tr class="info text-primary">
          <td class="h4" colspan="2">Personal Information</td>
        </tr>
      </thead>      
          <tbody>
            <tr>
              <td>Date</td>
              <td class="text-primary"><?php  echo date('Y / m / d')?></td>

            </tr>
            <tr>
              <td>Resident Full Names</td>
              <td class="text-info">
                <?php  

                 foreach ($user_addinfor as $key ) {
                  echo ucfirst($key->name);
                  $name= $key->name;

                  ?>

                </td>
              </tr>
              <tr>
                <td >Email</td>               
                <td class="text-info"><?php  echo $key->email ?></td>      
              </tr>


              <tr>
                <td >Identification Number</td>
                <td class="text-info"><?php  echo $key->identityNumber?></td>

              </tr>
              <tr>
                <td >Gender</td>
                <td class="text-info"><?php  echo ucfirst($key->description)?></td>

              </tr> 
              <tr>
                <td >Phone Numbers</td>
                <td class="text-info"><?php  echo $key->phone?></td>

              </tr>
              <tr>
                <td >Date of Birth</td>
                <td class="text-info"><?php  echo $key->dateOfBirth?></td>

              </tr>            
              <tr>
                <td >Date of Registration</td>
                <td class="text-info"><?php  echo $key->date_registration?></td>

              </tr>
              
              <!--tr>
                <td >Gender</td>
                <td class="text-danger"><?php  echo ($key->gender==0) ? "Male" : "Female"?></td>            
                </tr--><?php
              }
              ?>

            </tbody>
        </table>
        <br>
        <hr><div class="text-primary text-left h3">
        <?php
        if (!empty($isowner_addinfor)) { 
        echo ucfirst(($name)).' - Properties';
        // number for the property
        $j=1;
        //var_dump($isowner_addinfor);
        ?>
        
          <a href="#" class="btn bgrUserDetails h4 " id="user_propeties"><span id='view_p'></span> Properties </a></div><hr>
        <div class="col-md-offset-2 col-md-10" id="u_propeties">
        <div class="panel-group text-left" id="accordion">
          
        <?php 
          
        
         foreach($isowner_addinfor as $myproperties){?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo($j) ?>"> Property No.<?php echo($j) ?></a>
              </h4>
            </div>

            <div id="collapse<?php echo($j) ?>" class="panel-collapse collapse <?php echo($j ==0)? 'in': '' ?>">
              <div class="panel-body text-info">
                  <?php   echo 
                  $myproperties->name.'<br>'.                
                $myproperties->door_number."\n\n".$myproperties->street_name."\n Street <br>".
                
                $myproperties->suburbname."\n Suburb <br>".
                $myproperties->town."\n\n".$myproperties->zip_code.'<br>'.
                $myproperties->manucipality."\n Municipality <br>".
                $myproperties->district."\n District <br>".
                $myproperties->province."\n Province <br><hr>";
                $j++;
        ?>  </div>
           </div>
          </div>      
          <?php }?>
          </div>
        </div>

        <div class="row col-md-12 text-left">
        <hr><div class="text-primary text-left  h3">
           <?php }?>

           <?php
          // user has other addresses 
        if (!empty($other_address)) { 
        echo  ucfirst(($name)).' - Address';
        // number for the property
        $i=1;
        //var_dump($isowner_addinfor);
        ?>
        <!--p class="text-warning">The following is the other residencial addresses if the resident</p-->
        <a href="#" class="btn bgrUserDetails h4 " id="user_address"><span id='view_a'></span> addresses </a></div><hr>
        <div class="col-md-offset-2 col-md-10" id="u_address">
        <div class="panel-group text-left" id="accordion">
          
        <?php 
          
        
         foreach($other_address as $address){?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo($i) ?>"> Address No.<?php echo($i) ?></a>
              </h4>
            </div>

            <div id="collapse<?php echo($i) ?>" class="panel-collapse collapse <?php echo($i ==0)? 'in': '' ?>">
              <div class="panel-body text-info">
                  <?php   echo 
                  $address->name.'<br>'.                
                $address->door_number."\n\n".$address->street_name."\n Street <br>".
                
                $address->suburbname."\n Suburb <br>".
                $address->town."\n\n".$address->zip_code.'<br>'.
                $address->manucipality."\n Municipality <br>".
                $address->district."\n District <br>".
                $address->province."\n Province <br><hr>";
                $i++;
        ?>  </div>
           </div>
          </div>      
          <?php }?>
          </div>
        </div>
      </div>
           <?php }?>
         
         <!--div class="col-lg-3">
          <button class="btn btn-lg btn-primary form-control" name="approve"  type="submit">Confirm</button>     
        </div>

        <div class="col-lg-3">
          <a class="btn btn-lg btn-warning form-control" type="text">Edit</a>
        </div-->
  
    </div>
    </div>
    </div>
    <script type="text/javascript">
      $('#u_address').hide();
      $('#u_propeties').hide()
      $('#view_a').text('View');
      $('#view_p').text('See');
      $(document).on('click','#user_address',function(e){
       e.preventDefault();
        //$('#u_address').toggle();
        
        //$('#view_a').toggle().text('hide');
        $('#u_address').slideToggle('slow', function() {
        if ($(this).is(':visible')) {
             $('#view_a').text('Hide ');                
        } else {
             $('#view_a').text('View');                
        }        
    });       

      })
      $(document).on('click','#user_propeties',function(e){
        e.preventDefault();

        $('#u_propeties').slideToggle('slow', function() {
        if ($(this).is(':visible')) {
             $('#view_p').text('Hide ');                
        } else {
             $('#view_p').text('View');                
        }   
       // $('#u_propeties').show();
      });
      });
    </script>