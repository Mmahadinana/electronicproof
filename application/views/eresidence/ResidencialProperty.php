<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container form-area">

	<h2 class="whtColor"><i>LIVE'S AT</i></h2>


	<?php

	$action="residents/ResidencialProperty/";

	echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data','method'=>'POST'));?>
	
	<div class="row tablereq">
		<div class="col-lg-7 ">
			<div class="col-lg-3">
				<button type="submit" id="button" class="btn btn-info form-control">
					<span class="glyphicon glyphicon-search"></span> Search </button>
				</div>
				<div class="col-lg-4">		
					<input type="text" class="form-control" name="mysearch" value="<?php echo isset($search['mysearch']) ? $search['mysearch'] : '' ;?>" id="search" placeholder="Search Address Number" >
				</div>

			</div>
		</form>
			<br>
			<br>
			<br>
			<div class="col-md-10"><span class="text-warning">Residencial :</span> 
				<table class="table tably text-left">
					<tbody>
						<tr>
							<td>Date						
							</td>
							<td class="text-primary"><?php  echo date('Y / m / d')?></td>						

						</tr>

						<tr>
							<td>Resident Full Names</td>
							<td>
								<?php    

								foreach ($property_addinfor as $key ) {
									echo $key->name;
									?>

								</td>
							</tr>
							
							<tr>
								
								<td rowspan="7">Address</td>               
								<td ><?php  echo $key->door_number. ' '.$key->street_name?></td>  
								<td rowspan="7" class="col-md-4 text-left">
									<?php
 //var_dump($user_id) ;
//echo $_SESSION['id'];
									//$action="residents/makerequest/";
									$action="residents/request/";

									echo form_open($action,array('class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data'));?>


									<input type="hidden" name="property_id" value=<?php echo $key->property; ?>>
									<input type="hidden" name="usercheck" value="true">
									<button type="submit" name="confirm" class="btn-success btn-md btn-radius"><span class="text-success">Make a Proof of resident request</span></button>
								</form>

							</td>

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

		<div class="pag">
			<div class="bs-example">
				<ul class="pagination col-lg-12">
						<!--li><a href="#">&laquo;</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>				
						<li><a href="#">&raquo;</a></li-->
							<li ><?php echo $search_pagination; ?></li>
						</ul>
					</div>

				</form>

			</div>

		</div>

