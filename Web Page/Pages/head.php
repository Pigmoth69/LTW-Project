<?php

	include '../Server/database.php';
	include '../Server/session.php';
	include 'pageHeader.php';

	$session = new Session;
	$database = new Database;

 function makeHead($title){?>


<title><?php echo $title; ?> </title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../Styles/pageHeaderStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Styles/pageFooterStyle.css" rel="stylesheet" type="text/css" media="all" />

<?php } ?>

<?php
	function redirectToHomePageIfLoggedIn(){
		if($session->isLoggedIn()){
			header('../Pages/HomePage.php');
		}
	}
?>