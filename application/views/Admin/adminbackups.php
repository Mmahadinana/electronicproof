<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$owner_property=array();
$no_owner_property=array();
?>

<div class="container"> <!-- style="overflow:hidden" -->
	<nav id="mainNav" class="hidden navbar navbar-default navbar-fixed-top navbar-custom affix-top">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header page-scroll">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
				</button>                
				<!-- <img class="navbar-brand" src="#"/> -->
				<a class="navbar-brand" href="#page-top">Connect Your Care</a>
			</div>

			<!-- Menu options -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="hidden active">
						<a href="#page-top"></a>
					</li>
					<li class="page-scroll">
						<a href="#">Option 1</a>
					</li>
					<li class="page-scroll">
						<a href="#">Option 2</a>
					</li>
					<li class="page-scroll">
						<a href="#">Option 3</a>
					</li>
					<li class="page-scroll">
						<a href="#">Option 4</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12" style="overflow:auto">
			<div id="MyAccountsTab" class="tabbable tabs-left">
				<!-- Account selection for desktop - I -->
				<ul  class="nav nav-tabs col-md-1 hidden-xs">
					<li class="active">
						<div data-target="#ad_manage_p" data-toggle="tab">
							<div class="ellipsis">
								<span class="account-type">Manage </span><br/>
								<span class="account-amount">Property</span><br/>

							</div>
						</div>
					</li>
					<li>
						<div data-target="#ad_confirm" data-toggle="tab">
							<div>
								<span class="account-type">confirm </span><br/>
								<span class="account-amount">list</span><br/>
							</div>
						</div>
					</li>
					<li>
						<div data-target="#ad_approve" data-toggle="tab">
							<div>
								<span class="account-type">list of </span><br/>
								<span class="account-amount">approval</span><br/>
							</div>
						</div>
					</li>
					<li>
						<div data-target="#ad_addOwner" data-toggle="tab">
							<div>
								<span class="account-type">Add</span><br/>
								<span class="account-amount">Owner</span><br/>
							</div>
						</div>
					</li>

				</ul>
				<div class="tab-content col-md-11 content">
					<div class="tab-pane active" id="ad_manage_p"><!--style="padding-left: 60px; padding-right:100px"-->


						<div class="row">
							<div class="eres_tabs">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" id="owner_property">Owner's Property</a></li>
									<li><a data-toggle="tab" id="available_property">Available Properties</a></li>
									<li><a data-toggle="tab" id="all">All propertyies</a></li>
									<!--li><a data-toggle="tab" href="#manage_owner">Manage Owners</a></li-->
								</ul>
							</div>

							<div class="form-area form-area2">
								<h1>List of Properties</h1>

								<?php $action="residents/admin/";

								echo form_open($action,array('class'=>'form-horizontal','method'=>'GET','enctype'=>'multipart/form-data'));?>

								<!--search for editor-->      
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
							</form><!-- create a new car --> 



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
        <div class="tab-pane" id="add_owner">
        </div>
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
<div class="tab-pane" id="ad_confirm">
	<div class="container form-area">

  <?php
  //****************************************************** defining variables *///////////////////////////////////////////
  $property_id=0;
  $user_id=0;
  $owner_id=0;
  $getOwnerListToComfirm=array();

  ?>
  <h1 class="whtColor"> List Of Residents To Confirm </h1>
  <br>
  <?php
  // sending a failer message from owner
   if (isset($statusUpdate_OwnerD)) {
    echo alertMsg($statusUpdate_OwnerD,'Request declined','Sorry! you are not allowed to register on this property  <span class="glyphicon glyphicon-thumbs-down"></span>');
   
 }
 //sending a success message from owner
 if (isset($statusUpdate_OwnerC)) {
    echo alertMsg($statusUpdate_OwnerC,'Request confirmed','Sorry! you are not allowed to register on this property  <span class="glyphicon glyphicon-thumbs-down"></span>');
   
 }?>
  <h4><b><span class="text-danger"><?php 
  /*******getOwnerListToComfirmariable used to increament in the array index********/
  $i=0;
  foreach ($owner as $owner_val) {
    // storing the values of data that will be used to approve request by administrator
   // $property_id=$owner_val->property_id;
    $owner_id=$owner_val->id;
    $owners= $owner_val->name.', '; 
    foreach ($getListToComfirm as $user_val) {

      /********************condition for the list that should be printed***********************/
      if ($owner_val->property==$user_val->property_id ) {
        // storing the user data in the array
        $getOwnerListToComfirm[$i]=$user_val;
        $i +=1;
      }
    }

  } 
//*****************************************print name of owner*************************************************************/
    //echo $owners;
  ?></span><i>Confirm Request</b></i></h4>

  <!--*****************************************print name of owner*************************************************************/-->
  <table class="table">
    <tr class="danger text-warning">
      <th>Name</th>
      <th>Address</th>
      <th>Date</th>
      <th>Edit</th>
    </tr>

    <?php

 //*************print name of list of users that made requests for session owner*************************/   

    foreach ($getOwnerListToComfirm as $user) {

      $property_id=$user->property_id;
      $request_id=  $user->request_docs_id;    
      $user_id=  $user->user_id;    

      ?>


      <tr><td><?php echo $user->name; ?> </td>
        <td><?php echo $user->door_number.' '.$user->street_name; ?></td>
        <td><?php echo $user->date_request; ?></td>
        <td class='text-center'>
          <?php

//echo $_SESSION['id'];
          $action="request_proof/confirmResident/"; 

          echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data','autocomplete'=>'off'));?>

          <input type="hidden" name="owner_id" value=<?php echo $owner_id; ?>>
          <input type="hidden" name="user_id" value=<?php echo $user_id; ?>>
          <input type="hidden" name="request_id" value=<?php echo $request_id; ?>>
          <input type="hidden" name="property_id" value=<?php echo $property_id; ?>>
          <button type="submit" name="confirm" class="btn-success btn-md btn-radius"><span class='glyphicon glyphicon-pencil'></span> </button>
        </form>

      </td>

    </tr>
    <?php 
  }?>
  

</table>




</div>
</div>
<div class="tab-pane" id="ad_approve">
	<div class="container form-area">

  <?php

  //var_dump($getListToComfirm);
  $user_id=0;
  $property=0;
  $request_id=0;
  ?>
  <h1 class="whtColor"> List Of Residents To Be Approved </h1>
  <br>
  <?php
 if (isset($statusApprove)) {
    echo alertMsg($statusApprove,'','<b>Sorry, no waiting request to approve  <span class="glyphicon glyphicon-thumbs-down text-primary"></span></b>');
   

 } 
  // sending a failer message from administrator
 if (isset($statusUpdate_AdminD)) {
    echo alertMsg($statusUpdate_AdminD,'User request declined successfully','Request was unabled to be declined <span class="glyphicon glyphicon-thumbs-down"></span>');
   
 }
 //sending a success message from administrator
if (isset($statusUpdate_AdminA)) {
    echo alertMsg($statusUpdate_AdminA,'User request approved successfully','Request was unabled to be declined <span class="glyphicon glyphicon-thumbs-down"></span>');
   
 }?>
  <table class="table">
    <tr class="danger text-warning">
      <th>Name</th>
      <th>Address</th>
      <th>Date</th>
      <th>Edit</th>
    </tr>

    <?php foreach ($getListToComfirm as $user) { 
    //user_id of the user who is to confirmed 
        $user_id=$user->user_id;
        $property=$user->property_id;
        $request_id=$user->request_docs_id;
      ?>
      <tr><td><?php echo $user->name; ?> </td>
        <td><?php echo $user->door_number.' '.$user->street_name; ?></td>
        <td><?php echo $user->date_request; ?></td>
        <td class='text-center'>

           <?php

  $action="Request_proof/approveResident/" ;

  echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data','method'=>'POST'));?>

    <input type="hidden" name="property_id" value="<?php echo $property ?>">
    <input type="hidden" name="request_id" value="<?php echo $request_id ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">

      
   <button type="submit" class='btn btn-primary btn-xs' title="edit">
            <span class='glyphicon glyphicon-pencil'></span> 
          </button> 
   </form>       
        </td>

      </tr>
      
<?php }?>

    </table>


  </div>
</div>
<div class="tab-pane" id="ad_addOwner">
	<div class="col-md-offset-1">
		<div class="row" style="line-height: 14px; margin-bottom: 34.5px">
			<div class="form-area6">
  <?php 

  $action="residents/details/";?>

  <input <?php echo isset($user_id)? "value='$user_id'":"value='0'";?> id='userid' type='hidden' name='userid'>

  <div class="stepwizard col-md-offset-3">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-primary btn-circle"  ><i class="fa fa-lock" aria-hidden="true"></i></a>
        <p>Step 1</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" ><i class="fa fa-user" aria-hidden="true"></i></a>
        <p>Step 2</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-3" type="button" class="btn btn-default btn-circle" ><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
        <p>Step 3</p>
      </div>


    </div>
  </div>
  <form role="form" action="" id="data" method="post">


    <div <?php echo  isset($user_id)? "class='hidden'" : "class='form-group '"?>>


      <div class="row setup-content" id="step-1">
      <div class="col-xs-6 col-md-offset-3">
          <div class="col-md-12">
            <h3>Personal Information</h3>
            <div class="form-group">
              <label class="control-label" for="name">Full Name</label>
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-user"></span></span>
                <input type="text" class="form-control" name="name"     id="name" placeholder="full name" required>
              </div>
              <p><?php echo form_error('name') ? alertMsg(false,'name',form_error('name')) : ''; ?></p>

            </div>
            <div class="form-group">
              <label class="control-label" for="identitynumber">Identity Number</label>
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
                <input type="text" class="form-control" name="identitynumber"  id="identitynumber"  placeholder="identity number" required>
              </div>
              <p><?php echo form_error('identitynumber') ? alertMsg(false,'identitynumber',form_error('identitynumber')) : ''; ?></p>
            </div>
            <div class="form-group">
              <label class="control-label" for="dateofbirth">Date of Birth</label>
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
                <input type="date" class="form-control" name="dateofbirth"  id="dateofbirth"  placeholder="date of birth" required>
              </div>
              <p><?php echo form_error('dateofbirth') ? alertMsg(false,'dateofbirth',form_error('dateofbirth')) : ''; ?></p>

            </div>
            <div class="form-group">
              <label for="email">email</label>
              <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="email" class="form-control" name="email" id="email"  placeholder="Requested email"  required>
              </div>
              <p><?php echo form_error('email') ? alertMsg(false,'email',form_error('email')) : ''; ?></p>


            </div>

            <div class="form-group">
              <label class="control-label" for="phone">Phone number</label>
              <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
                <input type="text" class="form-control" name="phone"    id="phone" placeholder="phone numbers" required>
              </div>
              <p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
            </div>
            <label  id ="gender" class="control-label">Gender</label>

            <div class="form-group">

              <input  name="gender" type="radio" value="1" id="radio100">
              <label for="radio100">Male</label>
            </div>

            <div class="form-group">
              <input  name="gender" type="radio" value="2" id="radio101"  checked>
              <label for="radio101">Female</label>
              <p><?php echo form_error('gender') ? alertMsg(false,'gender',form_error('gender')) : ''; ?></p>

            </div>
            <button class="btn btn-primary nextBtn btn-m pull-right" type="button">Next</button>
          </div>
        </div>
      </div>
      <div class="row setup-content" id="step-2">
        <div class="col-xs-6 col-md-offset-3">
          <div class="col-md-12">
            <h3 >Residential Information</h3>
            <!-- Province start-->
            <div class="form-group">

              <label for="province">Province</label>
              <select class="form-control" name="province" id="province" onchange ="update_distric()">
                <option  selected="true" disabled="disabled">Please select</option>

                <?php 

                foreach ($province as $province)
                  {?>
                <option <?php 
                if(isset($user_id)  && $provinceEdit)
                {

                  echo ($provinceEdit == $province->name)? 'selected':'';


                }
                else{
                  if(set_value('province'))
                  {
                    echo (set_value('province') == $province->id)? 'selected':'';
                  }

                }
                ?>

                value="<?php echo $province->id ?>"><?php echo $province->name ?></option>
                <?php } ?>
              </select>
              <?php  echo form_error('province') ? alertMsg(false,'',form_error('province')):'';?>
            </div>
            <!-- Province end-->

            <!-- District start-->
            <div class="form-group" id="select_district" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

              <label for="district">District</label>

              <select class="form-control"  name="district" id="district" onchange="update_manucipality()">

              </select>
              <?php  echo form_error('district') ? alertMsg(false,'',form_error('district')):'';?>
              


            </div>
            <!-- District end-->

            <!-- manucipality start-->
            <div class="form-group" id="select_manucipality" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>           
              <label for="manucipality">Manucipality</label>
              <select class="form-control" name="manucipality" id="manucipality" onchange="update_town()">

              </select>
              <?php  echo form_error('manucipality') ? alertMsg(false,'',form_error('manucipality')):'';?>
            </div>
            <!-- manucipality end-->

            <!-- town start-->

            <div class="form-group" id="select_town" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

              <label for="town">town</label>
              <select class="form-control" name="town" id="town" onchange="update_suburb()">
                <option  selected="true" disabled="disabled">Please select</option>


              </select>
              <?php  echo form_error('town') ? alertMsg(false,'',form_error('town')):'';?>
            </div>
            <!-- town end-->

            <!-- suburb start-->
            <div class="form-group" id="select_suburb" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

              <label for="suburb">Suburb</label>
              <select class="form-control" name="suburb" id="suburb" onchange="update_address()">
                <!--option  selected="true" disabled="disabled">Please select</option-->


              </select>
              <?php echo form_error('suburb') ? alertMsg(false,'',form_error('suburb')):'';?>
            </div>
            <!-- suburb end-->
              
            <!-- zip code start-->
            <div class="form-group" id="zip_code_input" style="display:none">
              <!--label for="zip_code">Zip Code</label>
                <select class="form-control" name="zip_code" id="zip_code" onchange="update_address()">

                <option  selected="true" disabled="disabled">Please select</option>
              </select-->
            </div>

            <?php  echo form_error('zip_code') ? alertMsg(false,'',form_error('zip_code')):'';?>

          </div>
          <!--zip code end-->


          <!-- address start-->
          <!--div class="form-group" id="select_address" <?php //echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>-->
          <div class="form-group" id="select_address" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>
            <label for="street_name">Street Address</label>

            <select class="form-control" name="street_name" id="street_name">
              <option  selected="true" disabled="disabled">Please select</option>


            </select>
            <?php 
            echo form_error('street_name') ? alertMsg(false,'',form_error('street_name')):'';?>

          </div>
          <!-- address end-->


          <!-- door_number start-->     
          <div class="form-group" id="select_Number"  <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>
            <label for="door_number">Door Number</label>

            <input type="number" id="door"  name="door" min="1" max="1000">
            <?php  echo form_error('door_number') ? alertMsg(false,'',form_error('door_number')):'';?>

          </div>
          <!-- door_number end-->
          <button class="btn btn-success btn-lg pull-right" type="next" >Next</button>
        </div>

      </div>

    </div>
    <div class="row setup-content" id="step-3">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>House Details</h3>
          <div class="form-group">
            <label class="control-label" for="name">Title Deed</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-user"></span></span>
              <input type="text" class="form-control" name="name"     id="name" placeholder="full name" required>
            </div>
            <p><?php echo form_error('name') ? alertMsg(false,'name',form_error('name')) : ''; ?></p>

          </div>
          <div class="form-group">
            <label class="control-label" for="identitynumber">House Type</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
              <input type="text" class="form-control" name="identitynumber"  id="identitynumber"  placeholder="identity number" required>
            </div>
            <p><?php echo form_error('identitynumber') ? alertMsg(false,'identitynumber',form_error('identitynumber')) : ''; ?></p>
          </div>
          <div class="form-group">
            <label class="control-label" for="dateofbirth">Registration Number</label>
           <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
              <input type="text" class="form-control" name="identitynumber"  id="identitynumber"  placeholder="identity number" required>
            </div>
            <p><?php echo form_error('dateofbirth') ? alertMsg(false,'dateofbirth',form_error('dateofbirth')) : ''; ?></p>

          </div>
          <div class="form-group">
            <label class="control-label" for="date_registration">Registration Date</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
              <input type="date" class="form-control" name="date_registration" <?php
              $currentDate = date('Y-m-d');
              echo $currentDate;
              ?>  id="date_registration"    placeholder="date of registration" required>
            </div>
            <p><?php echo form_error('date_registration') ? alertMsg(false,'date_registration',form_error('date_registration')) : ''; ?></p>


          </div>
          <div class="form-group">
            <label class="control-label" for="phone">Purchase Price</label>
            <div class="input-group"> <span class="input-group-addon"><span class="fa fa-money"></span></span>
              <input type="text" class="form-control" name="phone"    id="phone" placeholder="phone numbers" required>
            </div>
            <p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
          </div>
          <div class="form-group">
            <label class="control-label" for="phone">Purchase Date</label>
          <div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
              <input type="date" class="form-control" name="date_registration" <?php
              $currentDate = date('Y-m-d');
              echo $currentDate;
              ?>  id="date_registration"    placeholder="date of registration" required>
            </div>
            <p><?php echo form_error('phone') ? alertMsg(false,'phone',form_error('phone')) : ''; ?></p>
          </div>
          <label class="control-label" for="phone">Upload Files</label>

          <div class="form-group">
            <input type="file"  class="form-inline input-lg fileToUpload" name="idUpload" id="idUpload" >  
            <p><?php echo form_error('idUpload') ? alertMsg(false,'idUpload',form_error('idUpload')) : ''; ?></p>
            <!--button class="btn btn-lg btn-warning passbtn" name="reset" type="reset" value="uploadid">upload id</button-->                  
          </div>
          <button class="btn btn-primary nextBtn btn-m pull-right" type="submit">Submit</button>
        </div>
      </div>
    </div>

  </form>

</div>

</div>

		</div>
	</div>
</div>
</div>
<!-- Account selection for desktop - F -->
</div>
</div>
</div>
</div>
<script>

	/*$(document).ready(function () {
		$('.Property_pagination').click(function(e) {
			e.stopPropagation();
		});

		let owner_property=<?php echo json_encode($db);?>;
    //when id for owner property is clicked
    $('#owner_property').on('click',function(){
    	$('#add_owner').addClass('hidden');
    	$('.is_owner').removeClass('hidden');
    	$('.add_owner').addClass('hidden');
    	$('.hide_owner').addClass('hidden');
    	$('.hide_all_properties').show();
    	$('.show_all_properties').removeClass('col-lg-2');
    	$('.show_all_properties').addClass('col-lg-1');        

    });   
         // get all properties that does have owners/////////////////////
         $('#available_property').on('click',function(){
         	let no_owner_property=<?php echo json_encode($available_properties);?>;
         	$('.is_owner').addClass('hidden');
         	$('.hide_all_properties').show();
         	$('.add_owner').removeClass('hidden');
         	$('.hide_owner').addClass('hidden');
         	$('.show_all_properties').addClass('col-lg-1');
         	$('#add_owner').addClass('hidden');
          // get all properties that does have owners/////////////////////
          $('#add_owner_search').keyup(function(){          
          	var data = $(this).val();
          	if($('#add_owner_search').val() === ''){           
          		$('.add_owner_filter').hide();
          		$('.add_owner').removeClass('hidden');

          	}    
          	else{
          		$.post('filterAvailableProperties',{add_owner_search:data},function(value){
          			$('#add_owner').removeClass('hidden');
          			$('.add_owner').addClass('hidden');
          			$('.add_owner_filter').show();
          			$('#add_owner').html(value);
          		});
          	}
          });
      }); 
         //get all the properties

         $('#all').on('click',function(){
          //hide other divs tap
          $('#add_owner').addClass('hidden');
          $('.is_owner').addClass('hidden');
          $('.hide_all_properties').hide();          
          $('.add_owner').addClass('hidden');

          //increase a div to be 2 columns
          $('.show_all_properties').removeClass('col-lg-1');
          $('.show_all_properties').addClass('col-lg-2');
        /*$.each(owner_property, function(eresidence, val) {
          $('.no_owner').hide();
      });*/
        //display  the dive that will show all the properties
        /*$('.hide_owner').removeClass('hidden');

          //search in a table



      }); 

         //filtering all properties
         $.post('getAllProperties',function(value){
         	/* tab is the table's id */

         /*	$('#hide_owner').html(value);
         });

         /* filterfield is the input field 
         $('#hide_owner_search').keyup(function(){          
         	var data = $(this).val();
         	if($('#hide_owner_search').val() === ''){
         		$.post('getAllProperties',function(value){

         			$('#hide_owner').html(value);
         		}); 
         	}    
         	else{
         		$.post('filterAllProperties',{hide_owner_search:data},function(value){

         			$('#hide_owner').html(value);
         		});
         	}
         });
     });

$(document).ready(function(){
	var searchProvinve=[];

	var idproperty=["#FS","#GP","#WC","#NC","#MP","#NW","#L","#EC","#KZN"]*/

    /*if('.idproperty').click(checkinarray(){

    }) 

      //searchProvinve[i]=;



  }) */
/** 
$(document).ready(function()
{
	var idproperty=["#FS","#GP","#WC","#NC","#MP","#NW","#L","#EC","#KZN"];
	var id="";
	$(".idproperty").click(function(){
		for (var i = 0; i < idproperty.length; i++) {

			if (idproperty[i]=='#'+$(this).attr('id')){
				id= "'#"+ $(this).attr('id')+"'";

			}      
		}


	})


});*/

 $(document).ready(function(){
  $('a[data-toggle="tab"]').on('show.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  var activeTab = localStorage.getItem('activeTab');
  console.log(activeTab );
  if(activeTab){
    $('#myTab a[href="' + activeTab + '"]').tab('show');
  }
});
</script>

<!---its for a vertical tab used for admin area 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/padding.js"></script>-->
