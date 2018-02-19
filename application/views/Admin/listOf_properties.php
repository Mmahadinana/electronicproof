<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<div class="tab-pane active" id="lA"><!--style="padding-left: 60px; padding-right:100px"-->
	<div class="row">
    <!--navigation for managing property-->
		<div class="eres_tabs">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" id="owner_property">Owner's Property</a></li>
				<li><a data-toggle="tab" id="available_property">Available Properties</a></li>
				<li><a data-toggle="tab" id="all">All propertyies</a></li>
				<!--li><a data-toggle="tab" href="#manage_owner">Manage Owners</a></li-->
			</ul>
		</div>
    <!--main div for managing property--> 
			<div class="form-area form-area2">
				<h1>List of Properties</h1>

				<?php $action="residents/admin/";

				echo form_open($action,array('class'=>'form-horizontal','method'=>'GET','enctype'=>'multipart/form-data'));?>

				<!--search for (inputs)editor-->      
				<div class="col-lg-3 col-sm-7 is_owner">
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
				<div class="col-lg-3 col-sm-7 is_owner">
					<input class="form-control" type="text" name="mysearch" id="inputsearch" placeholder="search" value="<?php echo isset($search['mysearch']) ? $search['mysearch'] : '' ;?>">   


				</div>
				<div class="col-lg-3 col-sm-7 add_owner hidden">


					<input class="form-control " type="text" name="add_owner_search" id="add_owner_search" placeholder="my search" >

				</div>
				<div class="col-lg-3 col-sm-7 hide_owner hidden">

					<input class="form-control" type="text" name="hide_owner_search" id="hide_owner_search" placeholder="search all" >    
				</div>


				<div class="col-lg-2 col-sm-7 is_owner ">  
					<button class="btn btn-primary form-control" type="submit" name="bntSearch">Search</button>

				</div>
				<div class="col-lg-2 col-sm-7">  
					<a class="btn btn-success form-control" href="<?php echo base_url('publiczone/change_add') ?>" name="add">Add Property</a>

				</div>
			</form><!-- end of search inputs --> 



			<div class="pfTbl_rom_padding text-left">
				<div class="col-sm-12 col-lg-12">
          <!--div class="col-sm-12 col-lg-12 pfTbl_rom_padding">
          <table class="table mytable">
          
        	<thead-->
        	<div class="row text-danger">
        		<div class="col-lg-1 colBrd-warning colBrd"><span class="glyphicon glyphicon-home"></span>&nbsp;No.</div>
        		<div class="col-lg-1 colBrd-warning colBrd hide_all_properties"><i class="fa fa-user" aria-hidden="true"></i>  &nbsp;Owner</div>
        		<div class="col-lg-1 colBrd-warning colBrd show_all_properties"><i class="fa fa-envelope-open" aria-hidden="true"></i>   &nbsp;Address</div>
        		<div class="col-lg-2 colBrd-warning colBrd"><i class="fa fa-map-marker" aria-hidden="true"></i>   &nbsp;Town</div>
        		<div class="col-lg-2 colBrd-warning colBrd"><i class="fa fa-location-arrow" aria-hidden="true"></i> &nbsp;Municipality</div>
        		<div class="col-lg-2 colBrd-warning colBrd hide_all_properties"><i class="fa fa-sitemap" aria-hidden="true"></i> &nbsp;District</div>
        		<div class="col-lg-2 colBrd-warning colBrd hide_all_properties"><i class="fa fa-globe" aria-hidden="true"></i> &nbsp;Province</div>
        		<div class="col-lg-1 colBrd-warning colBrd">Action</div>

        	</div>
          <!--/thead>

          <tbody-->
          <!--displays the list of properties that has owner-->
          <?php foreach ($db as $value) {
          	$owner_property=$value;
          ?>

          <div class="row rowBrd is_owner">
        		<div class="col-lg-1 value1 colBrd"><?php echo $value->property ?></div>
        		<div class="col-lg-1 value2 colBrd "><?php echo $value->name ?></div>                  
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

          <!--list data from the jquery where there is no owner for filter search-->

          <div class="" id="add_owner"></div>
          
          <!--end-->
        <?php } ?>
        <!--end of properties that has owner-->
        <!--displays the list of properties that does not have owner-->
        <?php foreach ($available_properties as $value) {
        	$no_owner_property=$value;
        ?>

        <div class="row rowBrd add_owner hidden" >
        	<div class="col-lg-1 value1 colBrd"><?php echo $value->property ?></div>
      		<div class="col-lg-1 colBrd "> 


      			<?php

      			$action="residents/listOfResidents";

      			echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


      			   <input type="hidden" name="property_id" value=<?php echo $value->property; ?>>                 

      			   <button type="submit" name="edit" class="fa fa-plus-circle text-success" title="Asign Owner to this property"></button> <span class="text-default">Owner</span>
      		  </form>

      	  </div>

          <div class="col-lg-1 value3 colBrd "><?php echo $value->door_number. ' '.$value->street_name?></div>
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


              		<button type="submit"  title="delete property" ="Submit" class=" glyphicon glyphicon-minus btn-warning"> </button>
              	</form>
              </div>
            </div>
          </div> 
          <!--input type="hidden" name="property_id" value="<?php echo $value->property?>"-->
          <?php } ?>
          <!--end of properties that does not have owner-->
          <!--displays the list of all properties -->


          <div id="page-selection">

          </div> 
          <div class="row hide_owner hidden" id="hide_owner">



                <!--div class="col-lg-1 colBrd"> 
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

                  $action="#";

                  echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


                  <input type="hidden" name="property_id" value=<?php echo $value->property; ?>>                 


                  <button type="submit"  title="delete property" ="Submit" class=" glyphicon glyphicon-minus btn-warning"> </button>
                </form>
              </div-->

            </div>

            <!--input type="hidden" name="property_id" value="<?php echo $value->property?>"-->

            <!--end of list of all properties -->

            <div class="container is_owner">

             <?php echo $search_pagination; ?>

           </div>
         </div>
       </div>
     </div>
    </div> 



