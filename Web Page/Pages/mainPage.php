<!DOCTYPE HTML>

<html>

<head>
	<?php
		include 'head.php';
		makeHead("Main Page");
		
	?>

	<link rel="stylesheet" href="../Styles/mainPageStyle.css"/>
	<link rel="icon" href="../Resources/Logos/icon.jpg"/>
	
	<title>Wild Bird</title>

</head>

<body>
		<video autoplay loop poster="../Resources/Intro/intro.jpg" id="introVideo">
			<source src="../Resources/Intro/intro.mp4" type="video/mp4">
		</video>

		<img id="logo" src="../Resources/Logos/logo.png" width="396" height="186" alt="companylogo">
		<h1>Welcome!</h1>
		<div id="mainPageButton">
			<form class="pageButton" action="loginRegisterPage.php">
				<input type="image" id="gotoPage" src="../Resources/Buttons/button.png" alt="Go To Page Form" />
			</form>
		</div>
		


</body>

</html>