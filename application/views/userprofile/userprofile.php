 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');

 ?>

 <div class="form-area">
 	  <?php

  if (isset($statusInsert)) {
   echo alertMsg($statusInsert,' Your request was made successfully','Sorry! you are not allowed to register on this property  <span class="glyphicon glyphicon-thumbs-down"></span>');
 } 
 if (isset($statusRequest)) {
   echo alertMsg($statusRequest,' Your request was made successfully',"Oops! something went wrong, registeraddress in order make arequest <i class='fa fa-frown-o fa-2x' aria-hidden='true' ></i>");
 }

?>
 	<h1>User Profile</h1>

 	
 	<div class="container">
 		
 		<div class="row tablereq">
 			<div class="col-xm-12 col-sm-8 col-md-12">
 				<table class="table text-left romtbl_borders">

 					<tbody>
 						<tr>
 							<td>Date</td>
 							<td class="text-primary"><?php  echo date('Y / m / d')?></td>

 						</tr>
 						<tr>
 							<td>Resident Full Names</td>
 							<td class="text-danger">
 								<?php    
 								// print the unfirmation of the user
 								foreach ($user_addinfor as $key ) {
 									echo $key->name;
 									?>

 								</td>
 							</tr>
 							<tr>
 								<td >Email</td>               
 								<td class="text-danger"><?php  echo $key->email ?></td>      
 							</tr>


 							<tr>
 								<td >Identification Number</td>
 								<td class="text-danger"><?php  echo $key->identityNumber?></td>

 							</tr> 
 							<tr>
 								<td >Phone Numbers</td>
 								<td class="text-danger"><?php  echo $key->phone?></td>

 							</tr>
 							<tr>
 								<td >Date of Birth</td>
 								<td class="text-danger"><?php  echo $key->dateOfBirth?></td>

 							</tr>            
 							<tr>
 								<td >Date of Registration</td>
 								<td class="text-danger"><?php  echo $key->date_registration?></td>

 							</tr>
 							<tr>
 								<td >Gender</td>
 								<td class="text-danger"><?php  echo ($key->gender==0) ? "Male" : "Female"?></td>            
 								</tr><?php
 							}
 							?>

 						</tbody>
 					</table>
 				</div>
 			</div>
 			<div class="row">
 				 <?php

                    $action="residents/listOfResidents";

                    echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


 					<input type="hidden" name="userid" value=<?php echo($_SESSION['id']) ?>>
 					<input type="hidden" name="usercheck" value="true">
 					<div class="col-lg-6">
 						<button type="submit" name="confirm" class="btn btn-lg form-control btn-warning text-danger" title="Edit"><i class="fa fa-list-alt " aria-hidden="true">&nbsp;&nbsp;Edit My Information</i></button>
 					</div>
 					<!--div class="col-lg-3">
 						<a class="btn btn-success" href="<?php echo base_url() ?>">Add New Property</a>
 					</div-->
 				</form>
 				<table <?php echo $_SESSION['owner'] != false ? "class=' '" : "class='hidden'"?> class="table ">

 					<caption class="h3 text-center">List of your properties</caption>

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

 							<td>  <div class="col-lg-6">
 								<?php

 								$action="residents/listOfResidents";

 								echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


 								<input type="hidden" name="property_id" value=<?php echo $value->property; ?>>                 


 								<button type="Submit" class=" fa fa-pencil fa-2x text-primary"></button>
 							</form>
 						</div>
 					</td>

 				</tr><?php	} ?>
 			</tbody>
 		</table>
 	</div>
 </div>
 <div class="row">
 	<div class="col-sm-8 col-lg-8 pfTbl_padding">
 		<table class="table ">
 			<caption class="h3 text-center">Lives at:</caption>
 			<thead>
 				<tr class="warning text-danger">
 					<th><span class="glyphicon glyphicon-home"></span>   &nbsp;&nbsp;Number</th>
 					<th><i class="fa fa-envelope-open" aria-hidden="true"></i>   &nbsp;&nbsp;Address</th>
 					<th><i class="fa fa-map-marker" aria-hidden="true"></i>   &nbsp;&nbsp;Town</th>
 					<th>Make a Request</th>
 					<th>Edit Address</th>

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
 						<?php

 						$action="residents/request";

 						echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data','method'=>'POST'));?>
 						<input type="hidden" name="property_id" value=<?php echo $value->property ?>>
 						<input type="hidden" name="usercheck" value="true">
 						<button type="submit" class="fa fa-archive fa-2x text-primary" title="request" >
 							<!--i class="fa fa-archive fa-2x text-primary" aria-hidden="true"></i-->
 						</button>
 					</form>

 					<!--a href="<?php echo base_url('residents/request/'.$value->property); ?>">&nbsp;&nbsp;<i class="fa fa-archive fa-2x text-primary" aria-hidden="true"></i></a--></td>
 					<td>  <div class="col-lg-6">
 						<?php

 						$action="residents/listOfResidents";

 						echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?> 						<input type="hidden" name="property_id" value=<?php echo $value->property; ?>> 
 						<button type="Submit" ><span class=" fa fa-pencil fa-2x text-primary"></span></button>
 					</form>
 				</div>
 			</td>

 		</tr><?php	} ?>
 		<tr class="warning">
 			<td  colspan="1" class="col-lg-3">
 				<a class="btn btn-lg form-control btn-primary text-danger" href="<?php echo base_url('publiczone/change_add') ?>">Add Property</a>
 			</td>
 			<td  colspan="4" class="col-lg-9">
 				<a class="btn btn-lg form-control btn-warning text-danger" href="<?php echo base_url('residents/viewRequestMade') ?>">&nbsp;&nbsp;<i class="fa fa-list-alt " aria-hidden="true"></i>&nbsp;&nbsp;View Request Made</a>
 			</td>
 			
 		</tr>
 	</tbody>
 </table>
</div>
</div>
</div> 		 		

</div>
