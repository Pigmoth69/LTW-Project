<?php
	include 'session.php';

	$session = new Session;
	$session->endSession();
	header("Location: ../Pages/loginRegisterPage.php");
	die();
?>