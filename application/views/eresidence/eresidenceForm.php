 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 ?>

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
  <!-- create a new car --> 
  
</div>

<div class="pfTbl_rom_padding text-left">
        <!--div class="col-sm-12 col-lg-12 pfTbl_rom_padding">
        <div class="col-sm-12 col-lg-12 pfTbl_rom_padding">
          <table class="table mytable">
          
            <thead-->
            <div class="row text-danger">
              <div class="col-lg-1 colBrd-warning colBrd"><span class="glyphicon glyphicon-home"></span>&nbsp;No.</div>
              <div class="col-lg-1 colBrd-warning colBrd"><i class="fa fa-user" aria-hidden="true"></i>  &nbsp;Owner</div>
              <div class="col-lg-1 colBrd-warning colBrd"><i class="fa fa-envelope-open" aria-hidden="true"></i>   &nbsp;Address</div>
              <div class="col-lg-2 colBrd-warning colBrd"><i class="fa fa-map-marker" aria-hidden="true"></i>   &nbsp;Town</div>
              <div class="col-lg-2 colBrd-warning colBrd"><i class="fa fa-location-arrow" aria-hidden="true"></i> &nbsp;Municipality</div>
              <div class="col-lg-2 colBrd-warning colBrd"><i class="fa fa-sitemap" aria-hidden="true"></i> &nbsp;District</div>
              <div class="col-lg-2 colBrd-warning colBrd"><i class="fa fa-globe" aria-hidden="true"></i> &nbsp;Province</div>
              <div class="col-lg-1 colBrd-warning colBrd">Action</div>

            </div>
            <!--/thead>
              <tbody-->
              <?php foreach ($db as $value) {?>

              <div class="row rowBrd">
                <div class="col-lg-1 colBrd"><?php echo $value->property ?></div>
                <div class="col-lg-1 colBrd"><?php echo $value->name ?></div>
                <div class="col-lg-1 colBrd"><?php echo $value->door_number. ' '.$value->street_name?></div>
                <div class="col-lg-2 colBrd"><?php echo $value->town ?></div>
                <div class="col-lg-2 colBrd"><?php echo $value->manucipality ?></div>
                <div class="col-lg-2 colBrd"><?php echo $value->district ?></div>
                <div class="col-lg-2 colBrd"><?php echo $value->province ?></div>


                <div class="col-lg-1 colBrd"> 
                  <div class="col-lg-6 "> 

                    <?php

                    $action="residents/listOfResidents";

                    echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


                    <input type="hidden" name="property_id" value=<?php echo $value->property; ?>>                 

                    <button type="submit" name="edit" class="fa fa-pencil text-primary"></button>
                  </form>
                </div>
                <div class="col-lg-6 ">
                  <?php

                  $action="residents/listOfResidents";

                  echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


                  <input type="hidden" name="property_id" value=<?php echo $value->property; ?>>                 

                  <button type="submit" name="delete" class="fa fa-trash text-danger"></button>
                </form>
              </div>

            </div>
          </div> 
          <!--input type="hidden" name="property_id" value="<?php echo $value->property?>"-->
          <?php } ?>
            <!--/tbody>
            </table--> 

          </div>
          <div class="">
            <ul class="pagination">
              <li>
                <?php echo $search_pagination; ?>
              </li>
            </ul>
          </div>

        </div>


      </div>
      <script>
        $(document).ready(function () {
          $('.Property_pagination').click(function(e) {
            e.stopPropagation();
          });
        });
      </script>