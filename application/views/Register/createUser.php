<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container form-container">

	<h1 ><?php echo $pageTitle;

		if(isset($statusEdit)){
			echo alertMsg($statusEdit,'Vehicle Added','Vehicle Not Added');
		}
		?></h1>


		<?php 

//var_dump($db);
//var_dump([$editors]);

		$action= isset($user_id)?"residents/editUser/$user_id" : "publiczone/registerUser";
		echo form_open($action,array('class'=>'form-horizontal col-md-offset-2 col-md-8'));?>
		<input <?php echo isset($user_id)? "value='$user_id'":"value='0'";?> id='iduser' type='hidden' name='iduser'>
		<form>


			<?php  echo form_error('manufacturers') ? alertMsg(false,'',form_error('manufacturers')):'';?>
			<div class="form-group">

				<label for="manufacturers">manufacturers</label>
				<select class="form-control" value="manufacturers" name="manufacturers" id="manufacturers">
					<option  selected="true" disabled="disabled">Please select</option>

					<?php 

					foreach ($manufacturers as $manufacture){?>
					<option <?php 
					if(isset($id_vehicle)  && $manufactureEdit){

						echo ($manufactureEdit == $manufacture->name)? 'selected':'';


					}else{
						if(set_value('manufacture')){
							echo (set_value('manufacture') == $manufacture->id)? 'selected':'';
						}

					}
					?>

					value="<?php echo $manufacture->id ?>"><?php echo $manufacture->name ?></option>
					<?php } ?>
				</select>
			</div>





			<?php  echo form_error('models') ? alertMsg(false,'',form_error('models')):'';?>
			<div class="form-group">

				<label for="models">Models</label>
				<select class="form-control" value="models" name="models" id="models">
					<option selected="true" disabled="disabled">Please select</option>
					<?php 
					foreach ($models as $model){?>
					<option <?php 
					if(isset($id_vehicle)  && $modelEdit){
						echo ($modelEdit == $model->name)? 'selected':'';


					}else{
						if(set_value('model')){
							echo (set_value('model') == $model->id)? 'selected':'';
						}

					}
					?>

					value="<?php echo $model->id ?>"><?php echo $model->name ?></option>
					<?php } ?>
				</select>
			</div>



			<?php echo form_error('colors') ? alertMsg(false,'',form_error('colors')):'';?>
			<div class="form-group">

				<label for="colors">Color</label>
				<select class="form-control" value="colors" name="colors" id="colors">
					<option selected="true" disabled="disabled">Please select</option>
					<?php 
					foreach ($colors as $color){?> 
					<option <?php 
					if(isset($id_vehicle)  && $colorEdit){
						echo ($colorEdit == $color->name)? 'selected':'';


					}else{
						if(set_value('color')){
							echo (set_value('color') == $color->id)? 'selected':'';
						}

					}
					?>
					value="<?php echo $color->id ?>"><?php echo $color->name ?></option>
					<?php } ?>
				</select>
			</div>
			<?php echo form_error('licence_plate') ? alertMsg(false,'',form_error('licence_plate')):'';?>
			<div class="form-group">

				<label for="licence_plate">Licence Plate</label>
				<input type="text" value="<?php echo isset($id_vehicle)? $licence_plateEdit: set_value('licence_plate')?>" class="form-control" id="licence_plate" name="licence_plate" placeholder="XX-XX-XX">

			</div>

			<a   href ="<?php echo base_url("publiczone/fleet/")?>"  style="margin-left: 280px;" type="reset" class="btn btn-default">Cancel</a>
			<button type="submit" class="btn btn-default">Save</button>
		</form>
	</div>
	<script src="jquery.min.js"></script>
	<script type="text/javascript">

		$("#manufacturers").change(function() {
			if ($(this).data('options') === undefined) {
				/*Taking an array of all options-2 and kind of embedding it on the select1*/
				$(this).data('options', $('#models option').clone());
			}
			var id = $(this).val();
			var options = $(this).data('options').filter('[value=' + id + ']');
			$('#models').html(options);
		});

	</script>