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
		
		echo form_open($action,array('class'=>'form-horizontal col-md-offset-2 col-md-8',' autocomplete'=>'off'));
		?>

		<!--input <?php echo isset($user_id)? "value='$user_id'":"value='0'";?> id='userid' type='hidden' name='userid'-->
		<input  value='<?php echo $_SESSION["id"]?>' id='userid' type='hidden' name='userid'>
		<a href="<?php echo base_url('residents/userprofile') ?>"></a>
		
				<div class="col-xs-6 col-md-offset-3">
					<div class="col-md-12">
						<h2>Change User Address</h2>
						<!-- Province start-->
						<div class="form-group">

							<label for="province">Province</label>
							<!--select class="form-control" name="province" id="province" onchange ="update_distric()"-->
							<select class="form-control nextselect" name="province" id="province">
								<option  selected="true" disabled="disabled">Please select</option>

								
							</select>
							<?php  echo form_error('province') ? alertMsg(false,'',form_error('province')):'';?>
						</div>
						<!-- Province end-->

						<!-- District start-->
						<div class="form-group " id="select_district" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

							<label for="district">District</label>
							
							<!--select class="form-control"  name="district" id="district" onchange="update_manucipality()"-->
							<select class="form-control nextselect"  name="district" id="district">
								<option  selected="true" disabled="disabled">Please select</option>
							</select>
							<?php  echo form_error('district') ? alertMsg(false,'',form_error('district')):'';?>



						</div>
						<!-- District end-->

						<!-- manucipality start-->
						<div class="form-group" id="select_manucipality" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>						
							<label for="manucipality">Manucipality</label>
							<select class="form-control nextselect" name="manucipality" id="manucipality">
							<!--select class="form-control" name="manucipality" id="manucipality" onchange="update_town()"-->
							<option  selected="true" disabled="disabled">Please select</option>
							</select>
							<?php  echo form_error('manucipality') ? alertMsg(false,'',form_error('manucipality')):'';?>
						</div>
						<!-- manucipality end-->

						<!-- town start-->

						<div class="form-group" id="select_town" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

							<label for="town">town</label>
							<!--select class="form-control" name="town" id="town" onchange="update_suburb()"-->
							<select class="form-control nextselect" name="town" id="town">
								<option  selected="true" disabled="disabled">Please select</option>


							</select>
							<?php  echo form_error('town') ? alertMsg(false,'',form_error('town')):'';?>
						</div>
						<!-- town end-->

						<!-- suburb start-->
						<div class="form-group" id="select_suburb" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>

							<label for="suburb">Suburb</label>
							<select class="form-control nextselect" name="suburb" id="suburb">
							<!--select class="form-control" name="suburb" id="suburb" onchange="update_address()"-->
								<option  selected="true" disabled="disabled">Please select</option>


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

				
					<!--zip code end-->


					<!-- address start-->
					<!--div class="form-group" id="select_address" <?php //echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>-->
					<div class="form-group " id="select_address" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>
						<label for="street_name">Street Address</label>

						<select class="form-control nextselect" name="street_name" id="street_name">
							<option  selected="true" disabled="disabled">Please select</option>


						</select>
						<?php 
						echo form_error('street_name') ? alertMsg(false,'',form_error('street_name')):'';?>

					</div>
					<!-- address end-->


					<!-- door_number start-->			
					<!--div class="form-group" id="select_Number"  <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>
						<label for="door_number">Door Number</label>

						<input type="number" id="door" value="<?php echo isset($user_id)? $doorNoEdit: set_value('door')?>" name="door" min="1" max="1000">
						<?php  echo form_error('door_number') ? alertMsg(false,'',form_error('door_number')):'';?>

					</div-->
					<!-- door_number end-->
					<div class="form-group" id="select_Number" <?php echo  isset($user_id)? "style='display:block'" : "style='display:none'"?>>
						<label for="door_number">Door Number</label>

						<select class="form-control nextselect" name="door_number" id="door_number">
							<option  selected="true" disabled="disabled">Select door number</option>


						</select>
						<?php 
						echo form_error('door_number') ? alertMsg(false,'',form_error('door_number')):'';?>

					</div>
					<button class="btn btn-success btn-lg pull-right" type="submit" >Submit</button>
				</div>

			</div>

		

	</form><?php } ?>

</div>



<!--script for validating stepwizard -->

<script>


$(document).ready(function(){
	var nextselect=$('.nextselect');
	var selectId=$('#'+nextselect.attr('id'));
	var i=0;
	nextselect.parent().hide();
	 
	console.log(nextselect);
	/*var curStep = $(this).closest(".form-group"),
			curStepBtn = curStep.attr("id"),			
			curInputs = curStep.find("select"),*/
	$.ajax({
		   url:"getAddress",
		   method:"GET",
		   dataType:"json",
		   success:function(data)
		   { 
		$(nextselect).change(function(){

		});
		for (var i = 0; i < nextselect.length; i++) {
				console.log(nextselect[i]);
			}	
		if($(nextselect[i]).attr('id')=='province'){
			selectId.parent().show();
	      	displaySelects(selectId,data['district'],nextselect[1],data['province']);
	      	
	      		
		}
		
		if($(nextselect[i]).attr('id')=='district'){
			selectId.parent().show();
	      	displaySelects(selectId,data['manucipality'],nextselect[2],data['district']);
	      	
	      		
		}
		if($(nextselect[i]).attr('id')=='manucipality'){
			selectId.parent().show();
	      	displaySelects(selectId,data['towns'],nextselect[3],data['manucipality']);
	   
	    		
		}
		if($(nextselect[i]).attr('id')=='town'){
			selectId.parent().show();
	      	displaySelects(selectId,data['suburb'],nextselect[4],data['town']);	
	      	
	      	
		}
		if($(nextselect[i]).attr('id')=='suburb'){
			selectId.parent().show();
	      	displaySelects(selectId,data['address'],nextselect[5],data['suburb']);
	      	
	      			
		}
		if($(nextselect[i]).attr('id')=='address'){
			selectId.parent().show();
	      	displaySelects(selectId,data['street_name'],nextselect[6],data['address']);
	      			
		}
	}
});

	function displaySelects(selectId,nextdata,nextId,data1){

		//console.log($(nextselect).val());
		let current_data=($(nextId).attr('id'));
		   		   	
		   
	      $.each(data1, function (i, item) 
	      {	        
	        selectId.append($('<option>', 
	        { 
	          value: item.id,
	          text : item.name 
	        }));
		});
	      	selectId.change(function(){
	      		$(nextId).parent().show();
		        let current_id=selectId.val();
		        	       
			    $(nextId).empty();
			    $(nextId).append($('<option>',
			{ 
				value: 0,
				text : "select "+$(nextId).attr('id') 
			}));
			//$("#district select option[value='0']").attr("disabled","disabled");
			    $.each(nextdata[current_id], function (i, item) 
			      {
					$(nextId).append($('<option>', 
			        { 
			          value: item.id,
			          text : item.name 
			        }));

			      });
				});
	         
	       	
	      	return nextId;
		      
		  	}
		});
	
	

	    //if()

	  /* $('#province').change(function(){
	    	let province_id=$('#province').val();
	    	let districts=data['district'];
		    $("#district").empty();
		    $("#district").append($('<option>',
		{ 
			value: 0,
			text : "select district" 
		}));
		$("#district select option[value='0']").attr("disabled","disabled");
		    $.each(districts[province_id], function (i, item) 
		      {
				$('#district').append($('<option>', 
		        { 
		          value: item.id,
		          text : item.name 
		        }));

		      });
		    });  
	    $('#district').change(function(){
		     	console.log(nextselect.children('select').attr('id'));
	    	let district_id=$('#district').val();
	    	let manucipalities=data['manucipality'];
		    $("#manucipality").empty();
		    $.each(manucipalities[district_id], function (i, item) 
		      {
				$('#manucipality').append($('<option>', 
		        { 
		          value: item.id,
		          text : item.name 
		        }));

		      });
		    });  


		    $('#manucipality').change(function(){
	    	let manucipality_id=$(this).val();
	    	let towns=data['town'];
		    $("#town").empty();
		    $.each(towns[manucipality_id], function (i, item) 
		      {
				$('#town').append($('<option>', 
		        { 
		          value: item.id,
		          text : item.name 
		        }));

		      });
		    });  $('#town').change(function(){
	    	let town_id=$(this).val();
	    	let suburbs=data['suburb'];
		    $("#suburb").empty();
		    $.each(suburbs[town_id], function (i, item) 
		      {
				$('#suburb').append($('<option>', 
		        { 
		          value: item.id,
		          text : item.name 
		        }));

		      });
		    });

		      /*$('#province').change(function(){
	    	let province_id=$('#province').val();
	    	let districts=data['district'];
		    $("#district").empty();
		    $.each(districts[province_id], function (i, item) 
		      {
				$('#district').append($('<option>', 
		        { 
		          value: item.id,
		          text : item.name 
		        }));

		      });
		    });
	 
    
   }
  });
	 
})*/
</script>









