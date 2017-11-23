<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container form-area">
	<div>
		<h1>Owners Information</h1>

	</div>


	<div class="stepwizard col-md-offset-3">
		<div class="stepwizard-row setup-panel">
			<div class="stepwizard-step">
				<a href="#step-1" type="button" class="btn btn-primary btn-circle"><i class="fa fa-lock" aria-hidden="true"></i></a>
				<p>Step 1</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-user" aria-hidden="true"></i></a>
				<p>Step 2</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
				<p>Step 3</p>
			</div>
			<div class="stepwizard-step">
				<a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-home" aria-hidden="true"></i></a>
				<p>Step 4</p>
			</div>

		</div>
	</div>


	<?php

	$action="residents/details/";

	echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data'));?>
	<div class="row setup-content" id="step-1">
		<div class="col-xs-6 col-md-offset-3">
			<div class="col-md-12">
				<h3>Personal Information</h3>
				<div class="form-group">
					<label class="control-label">Full Name</label>
					<input maxlength="100" type="text" required="required" class="form-control" placeholder="Full Name" />
				</div>
				<div class="form-group">
					<label class="control-label">Identity Number</label>
					<input maxlength="13" type="text" required="required" class="form-control" placeholder="Identity Number"  />
				</div>
				<div class="form-group">
					<label class="control-label">Date of Birth</label>
					<input  type="text" required="required" class="form-control" placeholder="Date of Birth"  />
				</div>
				<div class="form-group">
					<label class="control-label">Email</label>
					<input   type="email" required="required" class="form-control" placeholder="Email Address"/>
				</div>

				<div class="form-group">
					<label class="control-label">Phone number</label>
					<input maxlength="10" type="text" required="required" class="form-control" placeholder="Phone number"  />
				</div>
				<label  id ="gender" class="control-label">Gender</label>

				<div class="form-group">

					<input name="group100" type="radio" id="radio100">
					<label for="radio100">Male</label>
				</div>

				<div class="form-group">
					<input name="group100" type="radio" id="radio101" checked>
					<label for="radio101">Female</label>
				</div>
				<button class="btn btn-primary nextBtn btn-m pull-right" type="button" >Next</button>
			</div>
		</div>
	</div>
	<div class="row setup-content" id="step-2">
		<div class="col-xs-6 col-md-offset-3">
			<div class="col-md-12">
				<h3>Residential Information</h3>
				<div class="form-group">
					<label class="control-label">Street Address</label>
					<input maxlength="100" type="text" required="required" class="form-control" placeholder="Street Address" />
				</div>
				<div class="form-group">
					<label class="control-label">suburb</label>
					<input maxlength="13" type="text" required="required" class="form-control" placeholder="suburb"  />
				</div>
				<div class="form-group">
					<label class="control-label">City/Town</label>
					<input  type="text" required="required" class="form-control" placeholder="City/Town"  />
				</div>
				<div class="form-group">
					<label class="control-label">Zip Code</label>
					<input maxlength="10" type="text" required="required" class="form-control" placeholder="Zip Code"  />
				</div>
				<?php 


				$action= isset($user_id)?"Residents/registerUser/$user_id" : "Residents/registerUser";
				echo form_open($action,array('class'=>'form-horizontal col-md-offset-2 col-md-8'));?>
				<input <?php echo isset($user_id)? "value='$user_id'":"value='0'";?> id='user_id' type='hidden' name='user_id'>

				<form>
					<?php  echo form_error('manucipality') ? alertMsg(false,'',form_error('manucipality')):'';?>
					<div class="form-group">

						<label for="province">province</label>
						<select class="form-control" value="province" name="province" id="province">
							<?php	
							foreach ($province as $provinces)
								{?>	
							<option value="<?php echo $provinces->id;?>"><?php echo $provinces->name;?></option>
							<?php
						}
						?>
					</select>
				</div>

				<?php  echo form_error('district') ? alertMsg(false,'',form_error('district')):'';?>
				<div class="form-group">

					<label for="district">district</label>
					<select class="form-control" value="districts" name="district" id="district">
						<?php	
						foreach ($district as $districts)
							{?>	
						<option value="<?php echo $districts->id;?>"><?php echo $districts->name;?></option>
						<?php
					}
					?>
				</select>
			</div>
			<?php  echo form_error('manucipality') ? alertMsg(false,'',form_error('manucipality')):'';?>
			<div class="form-group">

				<label for="manucipality">manucipality</label>
				<select class="form-control" value="manucipality" name="manucipality" id="manucipality">
					<?php	
					foreach ($manucipality as $manucipalities)
						{?>	
					<option value="<?php echo $manucipalities->id;?>"><?php echo $manucipalities->name;?></option>
					<?php
				}
				?>
			</select>
		</div>
					<button class="btn btn-primary nextBtn btn-m pull-right" type="button" >Next</button>
				</div>
			</div>

		</div>
	</form>

	<div class="row setup-content" id="step-3">
		<div class="col-xs-6 col-md-offset-3">
			<div class="col-md-12">
				<h3>Owner Information</h3>
				<div class="form-group">
					<label class="control-label">Title Deed</label>
					<input type="text" required="required" class="form-control" placeholder="Title Deed" />
				</div>
				<div class="form-group">
					<label class="control-label">House Type</label>
					<input type="text" required="required" class="form-control" placeholder="House Type"  />
				</div>
				<div class="form-group">
					<label class="control-label">Registration Number</label>
					<input   type="text" required="required" class="form-control" placeholder="Registration Number"  />
				</div>
				<div class="form-group">
					<label class="control-label">Registration Date</label>
					<input  type="text" required="required" class="form-control" placeholder="Registration Date"  />
				</div>
				<div class="form-group">
					<label class="control-label">Purchase Price</label>
					<input type="text" required="required" class="form-control" placeholder="Purchase Price"  />
				</div>
				<div class="form-group">
					<label class="control-label">Purchase Date</label>
					<input type="text" required="required" class="form-control" placeholder="Purchase Date"  />
				</div>
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<span class="btn btn-primary btn-file"><span class="fileupload-new">upload file</span>
					<span class="fileupload-exists">Change</span>         <input type="file" /></span>
					<span class="fileupload-preview"></span>
					<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
				</div>
			</div>
			<button class="btn btn-primary nextBtn btn-m pull-right" type="button" >Next</button>
		</div>
	</div>
	<div class="row setup-content" id="step-4">
		<div class="col-xs-6 col-md-offset-4">
			<div class="col-md-12">
				<h3> Step 4</h3>
				<button class="btn btn-success btn-m pull-right" type="submit">Submit</button>
			</div>
		</div>
	</div>
</form>


</div>







<script type="text/javascript">
	$(document).ready(function () {
		var navListItems = $('div.setup-panel div a'),
		allWells = $('.setup-content'),
		allNextBtn = $('.nextBtn');

		allWells.hide();

		navListItems.click(function (e) {
			e.preventDefault();
			var $target = $($(this).attr('href')),
			$item = $(this);

			if (!$item.hasClass('disabled')) {
				navListItems.removeClass('btn-primary').addClass('btn-default');
				$item.addClass('btn-primary');
				allWells.hide();
				$target.show();
				$target.find('input:eq(0)').focus();
			}
		});

		allNextBtn.click(function(){
			var curStep = $(this).closest(".setup-content"),
			curStepBtn = curStep.attr("id"),
			nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
			curInputs = curStep.find("input[type='text'],input[type='url']"),
			isValid = true;

			$(".form-group").removeClass("has-error");
			for(var i=0; i<curInputs.length; i++){
				if (!curInputs[i].validity.valid){
					isValid = false;
					$(curInputs[i]).closest(".form-group").addClass("has-error");
				}
			}

			if (isValid)
				nextStepWizard.removeAttr('disabled').trigger('click');
		});

		$('div.setup-panel div a.btn-primary').trigger('click');
	});



</script>
<script src="jquery.min.js"></script>
<script type="text/javascript">
	
	$("#province").change(function() {
		if ($(this).data('options') === undefined) {
			/*Taking an array of all options-2 and kind of embedding it on the select1*/
			$(this).data('options', $('#manucipality option').clone());
		}
		var id = $(this).val();
		var options = $(this).data('options').filter('[value=' + id + ']');
		$('#manucipality').html(options);
	});

</script>
