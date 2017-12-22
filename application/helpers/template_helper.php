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
if(!function_exists('logoutByInactiv')){
	function logoutByInactiv(){
		if (isset($_SESSION['LAST_ACTIVITY'])) {
			
			if ($_SESSION['LAST_ACTIVITY'] < time() - (5*60)) {
				session_destroy();
				redirect('publiczone/index');
			}
			
		}
		$_SESSION['LAST_ACTIVITY'] = time();
	}
}

if ( ! function_exists('redirect_back'))
{
	function redirect_back()
	{
		if(isset($_SERVER['HTTP_REFERER']))
		{
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}
		else
		{
			header('Location: http://'.$_SERVER['SERVER_NAME']);
		}
		exit;
	}
}
?>