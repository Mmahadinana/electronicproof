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

		<p class="text-left">
		<button type="button" id="button" onclick="clearFields()" class="clear btn btn-info">
		<span class="glyphicon glyphicon-search"></span> Search <input type="text" class="form-control" name="search" value="<?php set_value('search') ;?>" id="search" placeholder="Search" style="width: 90px">
		</button>
		<br>
		<br>						 
		
					</p>
					<tr>
						<td>Date						
						</td>
						<td>
							<div class="input-group"> <span class="input-group-addon"><span class="fa fa-id-card-o"></span></span>
								<input type="date" class="form-control" name="date"  id="date" placeholder="date" required>
							</div>
							<p><?php echo form_error('date') ? alertMsg(false,'date',form_error('date')) : ''; ?></p>
						</td>
						<td>
							<div class="col-md-2 text-left" >
						<a href="<?php echo base_url('publiczone/E-Residence/') ?>" class="edit-address" name="edit address"><span></span>EDIT ADDRESS</a>
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

		<div class="row tablereq">
			<div class="col-md-10">
				<table class="table text-left ">


				</table>
			</div>
		</div>

		<div class="bs-example">
			<ul class="pagination">
				<li><a href="#">&laquo;</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
				<li><a href="#">8</a></li>
				<li><a href="#">9</a></li>
				<li><a href="#">10</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>
		</div>

<button class="btn btn-success btn-m pull-center" type="submit">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button class="btn btn-danger reset btn-m pull-center" type="button" >Cancel</button>

	</div>

