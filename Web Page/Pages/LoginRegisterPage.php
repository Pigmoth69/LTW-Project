<html>
<head>
	<?php 

		include 'head.php';
		makeHead("LoginRegister Page");
		redirectToHomePageIfLoggedIn($session);

	?>
	<link href="../Styles/loginRegisterPageStyle.css" rel="stylesheet" type="text/css" media="all" />
	<script src="../Client/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../Client/loginRegister.js"></script>
</head>

<body>
<div class="logo">
</div>
<div class="login-block">
	<h1>Wild Bird</h1>
	
	<form id="validationForm" method="POST">

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

			<input type="submit" id="submit" value="Log In">

			<div id="message"></div>
		</form>
</div>

</body>
</html>