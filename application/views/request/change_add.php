<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   // $automovel_id 	= $user_data['automovel_id'] 		?? false; 
$id_province = $user_data->province_id ?? $this->input->post('province') ?? false;
$id_district= $user_data->district_id ?? $this->input->post('district') ?? false;
$id_manucipality = $user_data->manucipality_id ?? $this->input->post('manucipality') ?? false;
$id_town= $user_data->town_id ?? $this->input->post('town')?? false;

$id_suburb = $user_data->suburb_id ?? $this->input->post('suburb')?? false;
$id_address = $user_data->id ?? $this->input->post('street_name')?? false;
$streetName=$user_data->street_name ?? $this->input->post('street_name')?? false;

?>
<div class="container form-area">




		<?php 
		if($user_id!=0){
			echo '
			<div class="text-danger"> <i class="fa fa-ban fa-5x" aria-hidden="true"></i></div><h4 class="text-warning"> You do not have address, please <a class="text-danger" href=" '.("../publiczone/change_add").'">Register Address</a> where you live before Editing your information</h4>';
		}else {
			
		
		$action="publiczone/change_add";
		
		echo form_open($action,array('class'=>'form-horizontal ',' autocomplete'=>'off'));
		?>

		<!--input <?php echo isset($user_id)? "value='$user_id'":"value='0'";?> id='userid' type='hidden' name='userid'-->
		<input  value='<?php echo $_SESSION["id"]?>' id='userid' type='hidden' name='userid'>
		<a href="<?php echo base_url('residents/userprofile') ?>"></a>
		
				
					<div class="col-xs-6 col-md-offset-3">
					<div class="col-md-12">
						<h2>Change User Address</h2>
						<!-- Province start-->
						<div class="form-group">

							<label class="control-label col-sm-6" for="province">Province</label>
							<div class="col-sm-6">
							<select class="form-control" name="province" id="province" onchange ="update_distric()">
								<option  selected="true" disabled="disabled">Please select</option>

								<?php 

								foreach ($province as $province)
								{?>
								<option <?php 
								
									if(set_value('province'))
									{
										echo (set_value('province') == $province->id)? 'selected':'';
									}

							
								?>

								value="<?php echo $province->id ?>"><?php echo $province->name ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-sm-12">
							<?php  echo form_error('province') ? alertMsg(false,'',form_error('province')):'';?>
							</div>
						</div>
						<!-- Province end-->

						<!-- District start-->
						<div class="form-group" id="select_district" <?php echo  isset($user_id)? "style='display:none'" : "style='display:none'"?>>

							<label class="control-label col-sm-6" for="district">District</label>
							<div class="col-sm-6">
							
							<select class="form-control"  name="district" id="district" onchange="update_manucipality()">
								
							</select>
						</div>
						<div class="col-sm-12">
							<?php  echo form_error('district') ? alertMsg(false,'',form_error('district')):'';?>
						</div>

						</div>
						<!-- District end-->

						<!-- manucipality start-->
						<div class="form-group" id="select_manucipality" <?php echo  isset($user_id)? "style='display:none'" : "style='display:none'"?>>						
							<label class="control-label col-sm-6" for="manucipality">Manucipality</label>
							<div class="col-sm-6">
							<select class="form-control" name="manucipality" id="manucipality" onchange="update_town()">

							</select>
						</div>
						<div class="col-sm-12">
							<?php  echo form_error('manucipality') ? alertMsg(false,'',form_error('manucipality')):'';?>
							</div>
						</div>
						<!-- manucipality end-->

						<!-- town start-->

						<div class="form-group" id="select_town" <?php echo  isset($user_id)? "style='display:none'" : "style='display:none'"?>>

							<label class="control-label col-sm-6" for="town">town</label>
							<div class="col-sm-6">
							<select class="form-control" name="town" id="town" onchange="update_suburb()">
								<option  selected="true" disabled="disabled">Please select</option>


							</select>
						</div>
						<div class="col-sm-12">
							<?php  echo form_error('town') ? alertMsg(false,'',form_error('town')):'';?>
							</div>
						</div>
						<!-- town end-->

						<!-- suburb start-->
						<div class="form-group" id="select_suburb" <?php echo  isset($user_id)? "style='display:none'" : "style='display:none'"?>>

							<label class="control-label col-sm-6" for="suburb">Suburb</label>
							<div class="col-sm-6">
							<select class="form-control" name="suburb" id="suburb" onchange="update_address()">
								<!--option  selected="true" disabled="disabled">Please select</option-->


							</select>
						</div>
						<div class="col-sm-12">
							<?php echo form_error('suburb') ? alertMsg(false,'',form_error('suburb')):'';?>
							</div>
						</div>
						<!-- suburb end-->

						<!-- zip code start-->
						<div class="form-group" id="zip_code_input" <?php echo  isset($user_id)? "style='display:none'" : "style='display:none'"?>>
							
							<div class="col-sm-6" ></div>
								<!--select class="form-control" name="zip_code" id="zip_code" onchange="update_address()">

								<option  selected="true" disabled="disabled">Please select</option>
							</select-->
						</div>
						<div class="col-sm-12">
								<?php  echo form_error('zip_code') ? alertMsg(false,'',form_error('zip_code')):'';?>
						</div>
				
					<!--zip code end-->


					<!-- address start-->
					<!--div class="form-group" id="select_address" <?php //echo  isset($user_id)? "style='display:none'" : "style='display:none'"?>-->
					<div class="form-group" id="select_address" <?php echo  isset($user_id)? "style='display:none'" : "style='display:none'"?>>
						<label class="control-label col-sm-6" for="street_name">Street Address</label>
						<div class="col-sm-6">

						<select class="form-control" name="street_name" id="street_name" >
							<option  selected="true" disabled="disabled">Please select</option>


						</select>
						
					</div>
						<div class="col-sm-12">
								<?php 
								echo form_error('street_name') ? alertMsg(false,'',form_error('street_name')):'';?>
						</div>

					</div>
					<!-- address end-->


					<!-- door_number start-->			
					<!--div class="form-group" id="select_Number"  <?php echo  isset($user_id)? "style='display:none'" : "style='display:none'"?>>
						<label for="door_number">Door Number</label>

						<input type="number" id="door" value="<?php echo isset($user_id)? $doorNoEdit: set_value('door')?>" name="door" min="1" max="1000">
						<?php  echo form_error('door_number') ? alertMsg(false,'',form_error('door_number')):'';?>

					</div-->
					<!-- door_number end-->
					<div class="form-group" id="select_Number" <?php echo  isset($user_id)? "style='display:none'" : "style='display:none'"?>>
						<label class="control-label col-sm-6" for="door_number">Door Number</label>
						<div class="col-sm-6">

						<select class="form-control" name="door_number" id="door_number">
							<option  selected="true" disabled="disabled">Select door number</option>


						</select>
						
					</div>
					<div class="col-sm-12">
						<?php 
						echo form_error('door_number') ? alertMsg(false,'',form_error('door_number')):'';?>
						</div>

					</div>
					<div class="form-group">
						<label class="contrl-label col-sm-8 text-success">Make this primary address</label>
						<div class="col-sm-3 text-left">
						<input type="checkbox" name="primary_ad" value="1" <?php echo set_checkbox('primary_ad', '1',true); ?> />
					</div>
					</div>
					<button class="btn btn-success btn-lg pull-right" type="submit" >Submit</button>
				</div>

			</div>

		

	</form><?php } ?>

</div>



<!--script for validating stepwizard -->

<script>


	/************************ getting the district through the provinve id********************/
function update_distric() 
	{
		//bring all the districts from php to javascript
		let district 		= <?php echo json_encode($districts);?>;	
		//if in edit mode asssigns the model id if on insert assigns false
		let id_district		= <?php echo $id_district ? $id_district : 'false' ?>; 
		//select box from the ditrict
		let district_id =$("#district");
		//province id from the select box of the provinces
		let selected  		= $("#province").val();

		//clear prev options
		district_id.empty();
		//write new options
		district_id.append($('<option>',
		{ 
			value: 0,
			text : "select district" 
		}));
		$("#district select option[value='0']").attr("disabled","disabled");
		$.each(district[selected], function (i, item) 
		{
			district_id.append($('<option>', 
			{ 
				value: item.id,
				text : item.name 
			}));

		});
		//select the option of the edit mode
		if(id_district)
		{
			$("#select_district select").val(id_district);
			$("#select_district").attr('style','display:block');
		}
		if(district_id.val() !=0)
		{
			$("#select_district").attr('style','display:block');
		}
		
			//dispaly the select box
			$("#province").change(function(){
				$("#select_district").attr('style','display:block');				
				$("#select_manucipality").attr('style','display:none');
				$("#select_town").attr('style','display:none');
				$("#zip_code_input").attr('style','display:none');
				$("#select_suburb").attr('style','display:none');
				$("#select_address").attr('style','display:none');
				$("#select_Number").attr('style','display:none');
				// empty all the select option
				$("#select_district select").val(0);
				$("#select_manucipality select").val(0);
				$("#select_town select").val(0);
				$("#select_suburb select").val(0);
				$("#select_address select").val(0);
				$("#select_Number selected").val(0);
			})			
	}
// call update_distric
$( document ).ready(function() 
{
	update_distric() ;
});

/*get municipali by distric id*/	
function update_manucipality()
{
		//bring all the districts from php to javascript
		let manucipality 		= <?php echo json_encode($manucipalities);?>;
		let id_manucipality		= <?php echo $id_manucipality ? $id_manucipality : 'false' ?>; 
		
			
		//select box from the ditrict
		let manucipality_id =$("#manucipality");
			//province id from the select box of the provinces
		let selected  		= $("#district").val();
			
		//clear prev options
		manucipality_id.empty();
		//write new options
		manucipality_id.append($('<option>', 
		{ 
			value: 0,
			text : "select manucipality" 
		}));
		$("#manucipality select option[value='0']").attr("disabled","disabled");
		$.each(manucipality[selected], function (i, item){

			manucipality_id.append($('<option>', 
			{ 
				value: item.id,
				text : item.name 
			}));
		});
		//select the option of the edit mode
		if(id_manucipality)
		{
			$("#select_manucipality select").val(id_manucipality);
		}
		if(manucipality_id.val() !=0)
		{
			
			$("#select_manucipality").attr('style','display:block');
		}
		
			//dispaly the select box
			$("#district").change(function(){
				$("#select_manucipality").attr('style','display:block');
				$("#select_town").attr('style','display:none');
				$("#zip_code_input").attr('style','display:none');
				$("#select_suburb").attr('style','display:none');
				$("#select_address").attr('style','display:none');
				$("#select_Number").attr('style','display:none');
			})
			//$("#select_manucipality").attr('style','display:block');
	}
//call update_manucipality function
$( document ).ready(function()
{
	update_manucipality() ;

});

/**get town by municipality id**/
function update_town()
{
		//bring all the districts from php to javascript
		let town= <?php echo json_encode($towns);?>;
		let id_town= <?php echo $id_town ? $id_town : 'false'; ?>; 
	
	
		//select box from the ditrict
		let town_id =$("#town");
		//province id from the select box of the provinces
		let selected= $("#manucipality").val();
		
		//clear prev options
		town_id.empty();
		//write new options
		town_id.append($('<option>', 
		{ 
			value: 0,
			text : "select town" 
		}));
		$("#town select option[value='0']").attr("disabled","disabled");
		$.each(town[selected], function (i, item) 
		{
			
			town_id.append($('<option>', 
			{ 
				value: item.id,
				text : item.name 
			}));
		});
		if(id_town){
			$("#select_town select").val(id_town);
		}
		if(town_id.val() !=0)
		{
			
			$("#select_town").attr('style','display:block');
		}
		
			//dispaly the select box
			$("#manucipality").change(function(){
				$("#select_town").attr('style','display:block');
				$("#zip_code_input").attr('style','display:none');
				$("#select_suburb").attr('style','display:none');
				$("#select_address").attr('style','display:none');
				$("#select_Number").attr('style','display:none');
			
			})
			//$("#select_town").attr('style','display:block');
	}
//call update_town function
$( document ).ready(function() 
{
	update_town();
});

/**get town by municipality id**/
function update_suburb()
{
		//bring all the districts from php to javascript
		let suburb= <?php echo json_encode($suburbs);?>;
		let id_suburb= <?php echo $id_suburb ? $id_suburb : 'false'; ?>; 

		let label ='<label class="control-label col-sm-6" for="zip_code">Zip Code</label>';	
		//select box from the ditrict
		let suburb_id =$("#suburb");

		//province id from the select box of the provinces
		let selected= $("#town").val();
		
		//clear prev options
		suburb_id.empty();
		//write new options
		suburb_id.append($('<option>', 
		{ 
			value: 0,
			text : "select suburb" 
		}));
		$("#suburb select option[value='0']").attr("disabled","disabled");
		$.each(suburb[selected], function (i, item) 
		{
			$("#zip_code_input").empty();

			$("#zip_code_input").append(label,$('<input>', 
			{ 
				class: "col-sm-6",
				placeholder: item.zip_code,

			}));

			//item.zip_code;
			suburb_id.append($('<option>', { 
				value: item.id,
				text : item.name 
			}));
			
		});
			//select the option of the edit mode
			if(id_suburb)
			{
				$("#select_suburb select").val(id_suburb);
			}
		if(suburb_id.val() !=0)
		{
			//$("#select_suburb select").val(suburb_id.val());
			$("#zip_code_input").attr('style','display:block');
			$("#select_suburb").attr('style','display:block');
			
		}
			
			//dispaly the select box
		$("#town").change(function(){
				$("#zip_code_input").attr('style','display:block');
				$("#select_suburb").attr('style','display:block');				
				$("#select_address").attr('style','display:none');
				$("#select_Number").attr('style','display:none');
			})
		/*$("#zip_code_input").attr('style','display:block');
		$("#select_suburb").attr('style','display:block');*/

	}
//call update_suburb function
$( document ).ready(function() 
{
	update_suburb();
});
/*get address by surbub id*/	
function update_address()
{
		//bring all the districts from php to javascript
		let address= <?php echo json_encode($address);?>;
		let id_address= <?php echo $id_address ? $id_address : 'false'; ?>; 

		//select box from the ditrict
		let address_id =$("#street_name");
		let door_number =$("#door_number");
		//province id from the select box of the provinces
		let selected= $("#suburb").val();

		//clear prev options
		address_id.empty();
		//write new options
		address_id.append($('<option>', 
		{ 
			value: 0,
			text : "select street_name" 
		}));

		$("#street_name select option[value='0']").attr("disabled","disabled");
		$.each(address[selected], function (i, item) 
		{
			address_id.append($('<option>', 
			{ 
				value: item.id,
				text : item.street_name 
			}));
			door_number.append($('<option>', 
			{ 
				value: item.id,
				text : item.door_number 
			}));
		});
		if(id_address)
		{	
			$("#select_address select").val(id_address);
			$("#select_Number select").val(id_address);
		}
		if(address_id.val() !=0)
		{
			$("#select_address select").val(address_id.val());
			$("#select_address").attr('style','display:block');
			
			
		}if(door_number.val() !=0)
		{
			$("#select_Number select").val(door_number.val());			
			$("#select_Number").attr('style','display:block');
			$("#select_address").attr('style','display:block');
			
		}
		
		/*$("#select_address").attr('style','display:block');
			$("#select_Number").attr('style','display:block');*/
			//dispaly the select box
			$("#suburb").change(function(){
				$("#select_address").attr('style','display:block');				
				$("#select_Number").attr('style','display:none');
			
			})
			$("#street_name").change(function(){
				
			$("#select_Number").attr('style','display:block');
			})
			 
	}
//call update_address function
$( document ).ready(function()
{
	update_address();
});


</script>









