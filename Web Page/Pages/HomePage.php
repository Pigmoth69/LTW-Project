<!DOCTYPE html>

<html>

<head>
	<?php 
		include('head.php');
		makeHeader("Home Page"); 

		include('../Server/database.php');
		if(!isset($_SESSION['username'])){
			header("Location: loginRegisterPage.php"); 
			exit();
		}
		$username = $_SESSION['username'];
	?>
	<link href="../Styles/homePageStyle.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
	<?php 
		include('pageHeader.php');
		displayHeader(); 
	?>

	<div id="page-wrapper">
		<div id="welcome" class="container">
			<div class="title">
				<h2>Welcome, <?php echo $username; ?>!!!</h2>
			</div>
			<p>Wild Bird is a web project developed by engineering students from Faculdade de Engenharia da Universidade do Porto.</p>
			<p>In this website, any user is able to work on an event system, where he can join or be invited to any public event. Also, it is possible to create a new custom event, for any purpose, making it private or public, and inviting any user registered on the server! Also, everyone are able to cancel their own subscription to any event as well as cancel a event that they created!</p>
			<p>It is possible to consult other users profiles and leave a comment on their personal pages! As obvious, a user can view and edit his personal info!</p>
			<p>Have fun browsing on our Wild Bird!!!</p>
			<div id="slider1"><img src="../Resources/Slide/slider1.png" class="image-full " /></div>
			<div id="slider2"><img src="../Resources/Slide/slider2.png" class="image-full " /></div>
			<div id="slider3"><img src="../Resources/Slide/slider3.png" class="image-full " /></div>
			<div id="slider4"><img src="../Resources/Slide/slider4.png" class="image-full " /></div>
		</div>
	</div>


	<?php
		include('pageFooter.php');
		displayFooter();
	?>


	<script src="../Client/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../Client/slider.js"></script>
</body>
</html>
