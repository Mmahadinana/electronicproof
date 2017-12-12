<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container form-area">

	<h2 class="whtColor"> List Of Owners Property </h2>


	<?php

	$action="residents/OwnersProperty/";

	echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data'));?>
	<input type="hidden" id="user_id" name="user_id" value="100">

	<div class="row tablereq">
		<div class="col-md-8">
			<table class="table tably text-left">

				<tbody>

					<div class="col-lg-3 col-sm-7">
					<p class="text-left">
						<button type="button" id="button" onclick="clearFields()" class="clear btn btn-info">
							<span class="glyphicon glyphicon-search"></span> Search <input type="text" class="form-control" name="mysearch" value="<?php echo isset($search['mysearch']) ? $search['mysearch'] : '' ;?>" id="search" placeholder="Search" style="width: 90px">
						</button>
						<br>
						<br> 
						</p>
					</div>
					
      
  
					<tr>
						<td>Date						
						</td>
						<td class="text-primary"><?php  echo date('Y / m / d')?></td>
						<!--td>
							<div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
								<input type="date" class="form-control" name="date"  id="date" placeholder="date" required>
							</div>
							<p><?php echo form_error('date') ? alertMsg(false,'date',form_error('date')) : ''; ?></p>
						</td-->
						<td>
							<div class="col-md-2 text-left" >
								<a href="<?php echo base_url('publiczone/editUser/') ?>" class="editaddress" name="editaddress"><span></span>EDIT ADDRESS</a>
							</div>
						</td>
					</tr>

					<tr>
						<td>Resident Full Names</td>
						<td>
							<?php    

							foreach ($user_addinfor as $key ) {
								echo $key->name;
								?>

							</td>
						</tr>
						<tr>
							<td rowspan="7">Address</td>               
							<td ><?php  echo $key->door_number. ' '.$key->street_name?></td>      
						</tr>


						<tr>
							<td><?php  echo $key->street_name?></td>

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
 						

 							</tr>
 						</thead>
 						<tbody>
 							<?php foreach ($property_addinfor as $value) {?>
 							<tr>
 								<td><?php echo $value->property ?></td>
 								<td><?php echo $value->door_number. ' '.$value->street_name?></td>
 								<td><?php echo $value->town ?></td> 								
 							</tr><?php	} ?>
 						</tbody>
 					</table>
 				</div>
 			</div>

		<div class="pag">
			<div class="bs-example">
				<ul class="pagination col-lg-12">
					<li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>				
					<li><a href="#">&raquo;</a></li>
				</ul>
			</div>
			
			<div class="col-lg-3">
				<button class="btn btn-lg btn-primary form-control" type="submit">Send</button>			
			</div>

			<div class="col-lg-3">
				<a class="btn btn-lg btn-warning form-control" type="text">Back</a>
			</div>
		</div>

	</div>

