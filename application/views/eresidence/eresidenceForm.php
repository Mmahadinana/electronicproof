<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 $owner_property=array();
 ?>
 <div class="eres_tabs">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" id="owner_property">Owner's Property</a></li>
    <li><a data-toggle="tab" id="available_property">Available Properties</a></li>
    <li><a data-toggle="tab" id="all">All propertyies</a></li>
    <!--li><a data-toggle="tab" href="#manage_owner">Manage Owners</a></li-->
  </ul>
</div>
<div class="form-area ">
  <h1>List of Properties</h1>

  <?php $action="residents/eresidence/";

  echo form_open($action,array('class'=>'form-horizontal','method'=>'GET','enctype'=>'multipart/form-data'));?>
  

  <div class="container">

    <!--search for editor-->      
    <div class="col-lg-3 col-sm-7">
      <select class="form-control" id="search" name="inputForSearch">              
        <option value= 0></option>     
        <option value= 1>Owner's Name</option>
        <option value= 2>Property Number</option> 
        <option value= 3>Town</option> 
        <option value= 4>Municipality</option>      
        <option value= 5>District</option>      
        <option value= 6>Province</option>

      </select>
    </div>   
    <div class="col-lg-3 col-sm-7">
      <input class="form-control" type="text" name="mysearch" id="search" placeholder="search" value="<?php echo isset($search['mysearch']) ? $search['mysearch'] : '' ;?>">    
    </div>
  </form>

  <div class="col-lg-2 col-sm-7">  
    <button class="btn btn-primary form-control" type="submit" name="bntSearch">Search</button>

  </div>
  <div class="col-lg-2 col-sm-7">  
    <a class="btn btn-success form-control" href="<?php echo base_url('publiczone/change_add') ?>" name="add">Add Property</a>

  </div>
  <!-- create a new car --> 
  
</div>

<div class="pfTbl_rom_padding text-left">
        <!--div class="col-sm-12 col-lg-12 pfTbl_rom_padding">
        <div class="col-sm-12 col-lg-12 pfTbl_rom_padding">
          <table class="table mytable">
          
            <thead-->
            <div class="row text-danger">
              <div class="col-lg-1 colBrd-warning colBrd"><span class="glyphicon glyphicon-home"></span>&nbsp;No.</div>
              <div class="col-lg-1 colBrd-warning colBrd hide_owner"><i class="fa fa-user" aria-hidden="true"></i>  &nbsp;Owner</div>
              <div class="col-lg-1 colBrd-warning colBrd"><i class="fa fa-envelope-open" aria-hidden="true"></i>   &nbsp;Address</div>
              <div class="col-lg-2 colBrd-warning colBrd"><i class="fa fa-map-marker" aria-hidden="true"></i>   &nbsp;Town</div>
              <div class="col-lg-2 colBrd-warning colBrd"><i class="fa fa-location-arrow" aria-hidden="true"></i> &nbsp;Municipality</div>
              <div class="col-lg-2 colBrd-warning colBrd"><i class="fa fa-sitemap" aria-hidden="true"></i> &nbsp;District</div>
              <div class="col-lg-2 colBrd-warning colBrd"><i class="fa fa-globe" aria-hidden="true"></i> &nbsp;Province</div>
              <div class="col-lg-1 colBrd-warning colBrd">Action</div>

            </div>
            <!--/thead>
              <tbody-->
              <?php foreach ($db as $value) {
                $owner_property=$value;
                ?>

                <div class="row rowBrd man_properties">
                  <div class="col-lg-1 value1 colBrd"><?php echo $value->property ?></div>
                  <div class="col-lg-1 value2 colBrd no_owner"><?php echo $value->name ?></div>
                  <!--div class="col-lg-1 value colBrd add_owner text-success hidden"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></div-->
                  <div class="col-lg-1 colBrd add_owner hidden"> 


                    <?php

                    $action="residents/listOfResidents";

                    echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


                    <input type="hidden" name="property_id" value=<?php echo $value->property; ?>>                 

                    <button type="submit" name="edit" class="fa fa-plus-circle text-success" title="Asign Owner to this property"></button> <span class="text-default">Owner</span>
                  </form>

                </div>
                <div class="col-lg-1 value3 colBrd"><?php echo $value->door_number. ' '.$value->street_name?></div>
                <div class="col-lg-2 value4 colBrd"><?php echo $value->town ?></div>
                <div class="col-lg-2 value5 colBrd"><?php echo $value->manucipality ?></div>
                <div class="col-lg-2 value6 colBrd"><?php echo $value->district ?></div>
                <div class="col-lg-2 value7 colBrd"><?php echo $value->province ?></div>


                <div class="col-lg-1 colBrd"> 
                  <div class="col-lg-6 "> 

                    <?php

                    $action="residents/listOfResidents";

                    echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


                    <input type="hidden" name="property_id" value=<?php echo $value->property; ?>>                 

                    <button type="submit" name="edit" class="fa fa-pencil text-primary"></button>
                  </form>
                </div>
                <div class="col-lg-6">
                  <?php

                  $action="residents/listOfResidents";

                  echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


                  <input type="hidden" name="property_id" value=<?php echo $value->property; ?>>                 


                  <input type="image" src="<?php echo base_url('assets/icons/Icons8-Windows-8-Users-Edit-User.png') ?>" alt="Submit" class=" resize_usericon">
                </form>
              </div>

            </div>
          </div> 
          <!--input type="hidden" name="property_id" value="<?php echo $value->property?>"-->
          <?php } ?>
            <!--/tbody>
            </table--> 

          </div>
          <div class="cintainer">

            <?php echo $search_pagination; ?>
            
          </div>

        </div>


      </div>
      <script>
        $(document).ready(function () {
          $('.Property_pagination').click(function(e) {
            e.stopPropagation();
          });

          let owner_property=<?php echo json_encode($db);?>;
          $('#owner_property').on('click',function(){

        //Selected value
        //var owner_property = <?php json_encode($db);?>; //get the value of selected manufacturer 
        //check if manufacturer has been selected
        $.each(owner_property, function(eresidence, val) {
          $('.no_owner').removeClass('hidden');
          $('.add_owner').addClass('hidden');
          $('.hide_owner').removeClass('hidden');
          console.log(val.province);
        });



      });  
         // get all properties that does have owners
         $('#available_property').on('click',function(){

          $('.no_owner').addClass('hidden');
          $('.add_owner').removeClass('hidden');
          $('.hide_owner').removeClass('hidden');


          $.each(owner_property, function(eresidence, val) {
            $('.no_owner').addClass('hidden');
            
          });



        }); 
         //get all the properties

         $('#all').on('click',function(){
          $('.no_owner').hide();
        //$('.no_owner').removeClass('hidden');
        $('.add_owner').addClass('hidden');
        $('.hide_owner').addClass('hidden');
        /*$.each(owner_property, function(eresidence, val) {
          $('.no_owner').hide();
        });*/



      });   
       });

     </script>
