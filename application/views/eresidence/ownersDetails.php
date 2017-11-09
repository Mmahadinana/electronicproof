 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 ?>

 <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css" rel="stylesheet">
 <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>



 <div class="container form-area">
 	<?php
 //var_dump($user_id) ;
 	$action="residents/eresidence/";

 	echo form_open($action,array('class'=>'form-horizontal','enctype'=>'multipart/form-data'));?>




 	<div class="stepwizard col-md-offset-3">
 		<div class="stepwizard-row setup-panel">
 			<div class="stepwizard-step">
 				<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
 				<p>Step 1</p>
 			</div>
 			<div class="stepwizard-step">
 				<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
 				<p>Step 2</p>
 			</div>
 			<div class="stepwizard-step">
 				<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
 				<p>Step 3</p>
 			</div>
 			<div class="stepwizard-step">
 				<a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
 				<p>Step 4</p>
 			</div>
 			<div class="stepwizard-step">
 				<a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
 				<p>Step 5</p>
 			</div>
 		</div>
 	</div>
 	<div>
 		<h1>Resident Information</h1>

 	</div>
 	<form role="form" action="" method="post">
 		<div class="row setup-content" id="step-2">
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
 					<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
 				</div>
 			</div>
 		</div>
 		<div class="row setup-content" id="step-3">
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
 					<div class="form-group">
 						<label class="control-label">Municipality</label>
 						<input maxlength="10" type="text" required="required" class="form-control" placeholder="Municipality"  />
 					</div>
 					<div class="form-group">
 						<label class="control-label">District</label>
 						<input maxlength="10" type="text" required="required" class="form-control" placeholder="District"  />
 					</div>
 					<div class="form-group">
 						<label class="control-label">Province</label>
 						<input maxlength="10" type="text" required="required" class="form-control" placeholder="Province"  />
 					</div>

 					<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
 				</div>
 			</div>
 		</div>
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
 				<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
 			</div>
 		</div>
 		<div class="row setup-content" id="step-4">
 			<div class="col-xs-6 col-md-offset-4">
 				<div class="col-md-12">
 					<h3> Step 4</h3>
 					<button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
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