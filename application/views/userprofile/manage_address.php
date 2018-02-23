 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');

 ?>

 <div class="col-sm-8 col-lg-8 pfTbl_padding">
 			<div >
 				
 			</div>
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


 							<!--input type="hidden" class="property_id" name="property_id" value=<?php echo $value->property; ?>>                 
 							<input type="hidden" class="user_id" name="userid" data-userid="<?php echo $_SESSION['id']; ?>"-->                 

 							<?php if ($value->primary_prop =='1'){ ''; }else {
 								?>
 									<!--input type="hidden" class="user_id" name="user_id" data-userid="<?php echo $_SESSION['id']; ?>"-->
									<input type="hidden" class="user_id" name="user_id" >
            						<a href="#" type="button" data-userid="<?php echo $_SESSION['id']; ?>" data-propid="<?php echo $value->property; ?>" class="btn btn-default fa fa-trash fa-2x text-danger deleteAddress" ></a>
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