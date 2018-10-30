<?php	
	header('content-type: text/css');
	require_once("../class/class.fn.php");
	require_once("../config.php");
	ob_start('ob_gzhandler');
	header('Cache-Control: max-age=31536000, must-revalidate');
	
	
	
	
	require_once("style.css");
?>