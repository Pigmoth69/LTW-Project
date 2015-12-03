<html>
<head>

	<?php
		include '../Server/startSession.php';
		include '../Server/database.php';
		include '../Server/session.php';

		try {
			$session = new Session;
		}
		catch(Exception $e) {
			die($e->getMessage());
		}

		if($session->getLogin()){
			header("Location: mainPage.php"); 
			exit();
		}
		?>

	<link rel="stylesheet" href="../Styles/loginRegisterPageStyle.css"/>
	<meta charset="UTF-8">
	<link rel="icon" href="../Resources/Logos/icon.jpg"/>
	<title>Login/Register</title>
</head>
<body>

<div class="logo">
</div>
<div class="login-block">
	<h1>Wild Bird</h1>
	
	<form id="validationForm" method="POST">
		<input type="hidden" id="acessType" value="login" >

		<div id="FormType">
				<input type="button" id="LoginButton" value="Log In" >
				<input type="button" id="RegisterButton" value="Register">
			</div>

			<div id="user-name">
				<input type="text" value="" placeholder="Username" id="username" />
			</div>

			<div id="user-password">
				<input type="password" value="" placeholder="Password" id="password" />
			</div>

			<div id="verify-password">
				<input type="password" value="" placeholder="Verify Password" id="verifyPassword" />
			</div>

			<div id="user-email">
				<input type="text" value="" placeholder="Email" id="email" />
			</div>

			<input type="button" id="submitLog" value="Log In">
			<input type="button" id="submitReg" value="Register">

			<div id="message"></div>
		</form>
</div>

	<script src="../Client/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../Client/loginRegister.js"></script>
</body>
</html>