<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<div id="user-profile-2" class="user-profile">
	<div class="tabbable">

		<ul class="nav nav-tabs padding-18">
			<li class="active">
				<a data-toggle="tab" href="#home">
					<i class="green ace-icon fa fa-user bigger-120"></i>
					Profile
				</a>
			</li>

			<?php 
	/**
	 * do not display this tab when resident is in session; 
	 */
			if ($_SESSION['role'] == 'resident'){
				echo '';
			} 
			else{ ?>
			<li class="<?php echo ($_SESSION['role'] == 'resident') ? 'hidden' :'' ?>">
				<a data-toggle="tab" href="#feed" >
				
					Manage Properties
				</a>
			</li>

			<?php } ?>

			<li>
				<a data-toggle="tab" href="#friends">
					<i class="blue ace-icon fa fa-users bigger-120"></i>
					Manage Residencial Address
				</a>
			</li>
			
		</ul>
		<div class="row">
			<div class=" col-md-offset-3 col-md-6 " id="message" >
				<!--deleting user addres alert message-->
				<?php	 if (isset($statusDelete)) {
    			echo alertMsg($statusDelete,'You have successfully been removed from this address','Sorry!Delete failed  <span class="glyphicon glyphicon-thumbs-down"></span>');   
 				} if (isset($statusRequest)) {
    			echo alertMsg($statusRequest,'Request made successfully','Sorry!You have already made a request. <span class="glyphicon glyphicon-thumbs-down"></span>');   
 				}
 				 if (isset($statusInsert)) {
						echo alertMsg($statusInsert,'Address was successfully added','Sorry! you are not allowed to add this address  <span class="glyphicon glyphicon-thumbs-down"></span>');
   
 				}?>
 			</div>
 		</div>

		<div class="tab-content no-border padding-24">
			<div id="home" class="tab-pane in active">
				<div class="row">
					<div class="col-xs-12 col-sm-3 center">
						<span class="profile-picture">
							</span>img class="editable img-responsive" alt=" Avatar" id="avatar2" src="http://bootdey.com/img/Content/avatar/avatar6.png">
						</span>

						<div class="space space-4"></div>
						<?php
			/**
			 * [$action edit user]
			 * @var string			 */
						$action="publiczone/editUser";

						echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


						<input type="hidden" name="userid" value=<?php echo($_SESSION['id']) ?>>
						<input type="hidden" name="usercheck" value="true">
						<div class="col-lg-6">
							<button type="submit" name="confirm" class="btn btn-sm btn-block btn-success" title="Edit"><i class="ace-icon fa fa-plus-circle bigger-120 " aria-hidden="true">&nbsp;&nbsp;<span class="bigger-110">Edit My Information</span></i></button>
						</div>
 					<!--div class="col-lg-3">
 					<a class="btn btn-success" href="<?php echo base_url() ?>">Add New Property</a-->

 					</form>
 				</div><!-- /.col -->

 				<div class="col-xs-12 col-sm-9">
 					<h4 class="blue"></h4>					

 					<div class="profile-user-info">
 						<div class="profile-info-row">
 							<div class="profile-info-name">Date</div>

 							<div class="profile-info-value">
 								<span><?php  echo date('Y / m / d')?></span>
 							</div>
 						</div>

 						<div class="profile-info-row">
 							<div class="profile-info-name">Full Names</div>

 							<div class="profile-info-value">
 								<span><?php    
 								// print the information of the user
 									foreach ($user_addinfor as $key ) {
 										echo $key->name;
 										?>
 									</span>
 								</div>
 							</div>

 							<div class="profile-info-row">
 								<div class="profile-info-name"> Email</div>
 								
 								<div class="profile-info-value">
 									<span><?php  echo $key->email ?></span>
 								</div>
 							</div>

 							<div class="profile-info-row">
 								<div class="profile-info-name"> ID </div>

 								<div class="profile-info-value">
 									<span><?php  echo $key->identityNumber?></span>
 								</div>
 							</div>
 							<div class="profile-info-row">
 								<div class="profile-info-name"> Date Of Birth </div>

 								<div class="profile-info-value">
 									<span><?php  echo $key->dateOfBirth?></span>
 								</div>
 							</div>
 							<div class="profile-info-row ">
 								<div class="profile-info-name"> Gender </div>

 								<div class="profile-info-value">
 									<span><?php  echo ($key->gender==0) ? "Male" : "Female"?></span>
 								</div>
 							</div>

 							<div class="profile-info-row">
 								<div class="profile-info-name"> Phone </div>

 								<div class="profile-info-value">
 									<span><?php  echo $key->phone?></span><?php
 								}
 								?>
 							</div>
 						</div>
 					</div>

 					<div class="hr hr-8 dotted"></div>
 					<div class="hr hr-8 dotted"></div>


 				</div><!-- /.col -->
 			</div><!-- /.row -->

 			<div class="space-20"></div>


 		</div><!-- /#home -->
<!--List of all the properties that ower has-->

 		<div id="feed" class="tab-pane">


 			<div class="space-12"></div>
 			<table <?php echo $_SESSION['owner'] != false ? "class=' '" : "class='hidden'"?> class="table ">

 				<caption class="h3 text-center" id="center">List of your properties</caption>

 				<thead>

 					<tr class="warning text-danger">
 						<th><span class="glyphicon glyphicon-home"></span>   &nbsp;&nbsp;Number</th>
 						<th><i class="fa fa-envelope-open" aria-hidden="true"></i>   &nbsp;&nbsp;Address</th>
 						<th><i class="fa fa-map-marker" aria-hidden="true"></i>   &nbsp;&nbsp;Town</th>

 						<th>Edit Address</th>

 					</tr>
 				</thead>
 				<tbody>

 					<?php 
 						//printing th properties of the user
 					foreach ($property_addinfor as $value) {?>

 					<tr>
 						<td><?php echo $value->property ?></td>
 						<td><?php echo $value->door_number. ' '.$value->street_name?></td>
 						<td><?php echo $value->town ?></td>

 						<td>
 						  <div class="col-lg-6">
 							<div class="col-lg-3">
 								<?php

 								$action="residents/listOfResidents";

 								echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


 										<input type="hidden" name="property_id" value=<?php echo $value->property; ?>>                 


 										<button type="Submit" class=" fa fa-pencil fa-2x text-primary"></button>
 								</form>
 							</div>
					
 					</div>
 				</td>

 			</tr><?php	} ?>
 		</tbody>
 	</table>
 	<div class="center">

 	</div>
 </div><!-- /#feed -->

 <div id="friends" class="tab-pane">
 	<div class="row" id="man_address" >
 		 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');

 ?>

 <div class="col-sm-8 col-lg-8 pfTbl_padding">
 			
 			<table class="table ">
 				<caption class="h3 text-center" id="live">Lives at:</caption>
 				<thead>
 					<tr class="warning text-danger">
 						<th><span class="glyphicon glyphicon-home"></span>   &nbsp;&nbsp;Number</th>
 						<th><i class="fa fa-envelope-open" aria-hidden="true"></i>   &nbsp;&nbsp;Address</th>
 						<th><i class="fa fa-map-marker" aria-hidden="true"></i>   &nbsp;&nbsp;Town</th> 						
 						<th>Edit Address</th>
 						<th></th>

 					</tr>
 				</thead>
 				<tbody>
 					<?php 

 				//printing the addresses of where the user lives
 					foreach ($add_addinfor as $value) {?>

 					<tr>
 						<td><?php echo $value->property ?></td>
 						<td><?php echo $value->door_number. ' '.$value->street_name?></td>
 						<td><?php echo $value->town ?></td>
 						
 						<td> 
 						 <div class="col-lg-6">
 						 	<div class="col-lg-6">
 							<?php
 							/********  button Edit  *************************/
 							$action="residents/listOfResidents";

 							echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?><input type="hidden" name="property_id" value=<?php echo $value->property; ?>> 
 							<button type="Submit" class="btn btn-default fa fa-pencil fa-2x text-info"></button>

 						</form>
 						</div>
 						<div class="col-lg-6">
 						<?php

 						/********  button Delete  *************************/
 							$action="residents/deleteUserAddress";

 							echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


 							<input type="hidden" class="property_id" name="property_id" value=<?php echo $value->property; ?>>                 
 							<input type="hidden" class="user_id" name="user_id" data-userid="<?php echo $_SESSION['id']; ?>">                 

 							<?php if ($value->primary_prop =='1'){ ''; }else {
 								?>
									<a href="#" type="button" data-propid="<?php echo $value->property; ?>" class="btn btn-default fa fa-trash fa-2x text-danger deleteAddress" ></a>
 								<?php
 							} ?>
 							
 						</form>
 						</div>
 					</div>
 				</td>
 				<td>  
 							<?php

 							/********  button request  *************************/

 							if ($value->primary_prop == 1){
 							$action="Request_proof/request";

 							echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data','method'=>'POST'));?>
 							<input type="hidden" name="property_id" value=<?php echo $value->property ?>>
 							<input type="hidden" name="usercheck" value="true">
 							<div class="form-group text-left">
	 							<label class="contrl-label col-sm-8 text-success">
	 							<button type="submit" class="btn fa fa-archive fa-2x text-primary" title="request" >
	 								<!--i class="fa fa-archive fa-2x text-primary" aria-hidden="true"></i-->
	 							</button>  Make a Request</label>
 							</div>
 						</form> <?php }else { 
					
 							?>

 						<div class="form-group text-success text-left primaryChange">
 							
 							<input type="hidden" name="prop_id" class="prop_id" value="<?php echo $value->property ?>">
 							<label class="contrl-label">

							<input type="radio" class="primaryRadio" name="primary_ad" value="<?php echo $value->address_id; ?>"/>  Mark as Primary Address</label>
							<a href="#" type="button" data-propid="<?php echo $value->property; ?>" class="
								" ></a>
						<!--/form--> 
						</div>
					
 						<?php	
 						}
 						?>

 						<!--a href="<?php echo base_url('Request_proof/request/'.$value->property); ?>">&nbsp;&nbsp;<i class="fa fa-archive fa-2x text-primary" aria-hidden="true"></i></a--></td>

 			</tr><?php	} ?>
 			<tr class="warning">
 				<td  colspan="1" class="col-lg-3">
 					<a class="btn btn-lg form-control btn-primary text-danger" href="<?php echo base_url('publiczone/change_add') ?>">Add New Address</a>
 				</td>
 				<td  colspan="4" class="col-lg-9">
 					<a class="btn btn-lg form-control btn-warning text-danger" href="<?php echo base_url('Request_proof/viewRequestMade') ?>">&nbsp;&nbsp;<i class="fa fa-list-alt " aria-hidden="true"></i>&nbsp;&nbsp;View Request Made</a>
 				</td>

 			</tr>
 		</tbody>
 	</table>
 </div>
</div>

<div class="hr hr10 hr-double"></div>



</div>
</div>
</div>
<script type="text/javascript">
		
		

	
</script>