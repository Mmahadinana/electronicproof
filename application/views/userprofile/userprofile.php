 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 ?>

 <div class="form-area">
<h1>User Profile</h1>

 	<?php $action="residents/userprofile/";
//ar_dump($user_addinfor);
 	echo form_open($action,array('class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data'));?>
 	<div class="container">
 		<input type="hidden" id="user_id" name="user_id" value=<?php echo $_SESSION['id']; ?>>
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
 				<div class="col-sm-8 col-lg-8 pfTbl_padding">
 					<table class="table ">
 						<caption class="h3 text-center">List of your properties</caption>
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
 							<?php foreach ($property_addinfor as $value) {?>

 							<tr>
 								<td><?php echo $value->property ?></td>
 								<td><?php echo $value->door_number. ' '.$value->street_name?></td>
 								<td><?php echo $value->town ?></td>
 								<td>  <a href="<?php echo base_url('residents/request/'.$value->property); ?>">&nbsp;&nbsp;<i class="fa fa-archive fa-2x text-primary" aria-hidden="true"></i></a></td>
 								<td>  <a href="#">&nbsp;&nbsp;<i class="fa fa-pencil fa-2x text-primary" aria-hidden="true"></i></a></td>

 							</tr><?php	} ?>
 						</tbody>
 					</table>
 				</div>
 			</div>
 		</div> 		 		
 	</form>
 </div>
