<?php
	session_start();
	$_SESSION = array();	
	header("Location: ../Pages/loginRegisterPage.php");
	die();
?>