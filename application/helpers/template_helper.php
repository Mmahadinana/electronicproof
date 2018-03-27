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
/**
 * alert messages
 */
if (!function_exists("alertMsg")) {
	function alertMsg($flag=false,$successMsg='',$errorMsg='')
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
/**
 * logout session
 */
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
/**
 * redirect correct location from the database
 */
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
/**
 * generating generateBreadcrumb
 */
if(!function_exists('')){
function generateBreadcrumb(){
  $ci = &get_instance();
  $i=1;
  $uri = $ci->uri->segment($i);
  $link = '
  <div class="pageheader">
      <h2><i class="fa fa-edit"></i>'.$ci->uri->segment($i).'</h2>
      <div class="breadcrumb-wrapper">
 
  <ol class="breadcrumb">';
 
  while($uri != ''){
    $prep_link = '';
  for($j=1; $j<=$i;$j++){
    $prep_link .= $ci->uri->segment($j).'/';
  }
 
  if($ci->uri->segment($i+1) == ''){
    $link.='<li class="active"><a href="'.site_url($prep_link).'">';
    $link.=$ci->uri->segment($i).'</a></li> ';
  }else{
    $link.='<li><a href="'.site_url($prep_link).'">';
    $link.=$ci->uri->segment($i).'</a><span class="divider"></span></li> ';
  }
 
  $i++;
  $uri = $ci->uri->segment($i);
  }
    $link .= '</ol></div></div>';
    return $link;
  }
}
?>