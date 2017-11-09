<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists("setMenuActiveItem")) {
	function setMenuActiveItem($flag=false)
	{
		if ($flag) {
			return 'class=active';
		}
		else{
			return'';
		}
	}
}
if (!function_exists("alertMsg")) {
	function alertMsg($flag=false, string $successMsg='', string $errorMsg='')
	{
		if ($flag) {
			return '<div class="alert alert-success alert-dismissable ">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong><span class="glyphicon glyphicon-ok-sign"></span></strong> ' .$successMsg.' 
			.</div>';
		}
		else{
			return '<div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong><span class="glyphicon glyphicon-remove-sign"></span></strong> ' .$errorMsg.' 
			.</div>'; 
			
		}
	}
}
?>