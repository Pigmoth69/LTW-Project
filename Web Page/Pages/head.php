<?php

	include '../Server/database.php';
	include '../Server/session.php'; 

	session_start();

	function startSession() {
		$session = NULL;
		try {
			$session = new Session;
		}
		catch(Exception $e) {
			die($e->getMessage());
		}

		if(!$session->getLogin()){
			header("Location: loginRegisterPage.php"); 
			exit();
		}
		else return $session;
	}


 function makeHeader($title){?>
 
<title><?php echo $title; ?> </title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../Styles/pageHeaderStyle.css" rel="stylesheet" type="text/css" media="all" />
<link href="../Styles/pageFooterStyle.css" rel="stylesheet" type="text/css" media="all" />

<?php }?> 