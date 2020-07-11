<?php 
	include('inc/config.php');
	if(isset($_SESSION['UserData'])){
		unset($_SESSION['UserData']);
		session_destroy();
	}
	header("Location: ".$SiteUrl."admin/login.php");
	exit();
?>