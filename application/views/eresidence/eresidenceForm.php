 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 ?>

 <div class="form-area">
<h1>List of Properties</h1>

 	<?php $action="residents/eresidence/";
//var_dump($db);
 	echo form_open($action,array('class'=>'form-horizontal','method'=>'GET','enctype'=>'multipart/form-data'));?>
 	<div class="container">
 		
 		  <div class="container">

    <!--search for editor-->      
    <div class="col-lg-3">
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
<div class="col-lg-4">
    <input class="form-control" type="text" name="mysearch" id="search" placeholder="search" value="<?php echo isset($search['mysearch']) ? $search['mysearch'] : '' ;?>">    
  </div>

  <div class="col-lg-2">  
    <button class="btn btn-primary form-control" type="submit" name="bntSearch">Search</button>

  </div>
  <!-- create a new car --> 
  
</div>
 	
 			<div class="row">
 				<div class="col-sm-12 col-lg-12 pfTbl_rom_padding">
 				<!--div class="col-sm-12 col-lg-12 pfTbl_rom_padding"-->
 					<table class="table ">
 					
 						<thead>
 							<tr class="warning text-danger">
 								<th><span class="glyphicon glyphicon-home"></span>   &nbsp;Number</th>
								<th><i class="fa fa-user" aria-hidden="true"></i>  &nbsp;Name Of Owner</th>
 								<th><i class="fa fa-envelope-open" aria-hidden="true"></i>   &nbsp;Address</th>
 								<th><i class="fa fa-map-marker" aria-hidden="true"></i>   &nbsp;Town</th>
 								<th><i class="fa fa-location-arrow" aria-hidden="true"></i> &nbsp;Municipality</th>
 								<th><i class="fa fa-sitemap" aria-hidden="true"></i> &nbsp;District</th>
 								<th><i class="fa fa-globe" aria-hidden="true"></i> &nbsp;Province</th>
 								<th>Action</th>

 							</tr>
 						</thead>
 						<tbody>
 							<?php foreach ($db as $value) {?>

 							<tr>
 								<td><?php echo $value->property ?></td>
 								<td><?php echo $value->name ?></td>
 								<td><?php echo $value->door_number. ' '.$value->street_name?></td>
 								<td><?php echo $value->town ?></td>
 								<td><?php echo $value->manucipality ?></td>
 								<td><?php echo $value->district ?></td>
 								<td><?php echo $value->province ?></td>
 							
 								<td>  <a href="#">&nbsp;<i class="fa fa-pencil fa-2x text-primary" aria-hidden="true"></i></a><a href="#">&nbsp;<i class="fa fa-trash fa-2x text-danger" aria-hidden="true"></i></a></td>

 							</tr><?php	} ?>
 						</tbody>
 					</table> 
 					<div class="align-center">
 					<?php echo $search_pagination; ?>
 				</div>
 				</div>
 				
 			</div>
 				 		
 	</form>
 </div>
<script>
	$(document).ready(function () {
	$('.Property_pagination').click(function(e)	{
		e.stopPropagation();
	});
});
</script>