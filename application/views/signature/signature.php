<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h2>Lisence.com | jQuery Signature Pad & Canvas Image </h2>

<div id="signArea">
	<h2 class="tag-ingo" >Put signature below,</h2>
	<div class="sig sigWrapper" style="height:auto;" >
		<div class="typed"></div>
		<canvas class="sign-pad" id="sign-pad" width="300" height="100" ></canvas>
	</div>
</div>

<button id="btnSaveSign" > Save Signature</button>

<div class="sign-container" >
<?php
$image_list = glob("./doc_signs/*.png");
foreach ($image_list as $image ) {
	//echo $image;
?>
<img src="<?php echo $image; ?>" class="sign-preview"/>
<?php
}
?>
</div>

<script>
	$(document).ready(function)() {
		$('#signArea').signaturePad)({drawOnly:true, drawBezierCurves:true, lineTop:90});

	});
$("#btnSaveSign").click(function(e)
	html2canvas([document.getElementById('sign-pad')],{
		onrendered:function(canvas){
			var canvas_img_data = canvas.toDataURL('image/png');
			var img_data = canvas_img_data.replace(/^data:image\/png|jpg);base64,/, "");
			//ajax call to save image inside folder
			$.ajax({
				url: 'save_sign.php',
				data: {img_data:img_data},
				type:'post',
				dataType:'json',
				success:function (response) {
					window.location.reload();
				}
			});
		});
	});

</script>
