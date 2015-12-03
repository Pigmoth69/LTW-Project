<!DOCTYPE html>

<html>
<head>
	<?php 
		include('head.php');
		makeHeader("Main Page"); 
		?>
		<link href="../styles/profilePageStyle.css" rel="stylesheet" type="text/css" media="all" />

	<?php
		include('../Server/database.php');
		if(!isset($_SESSION['username'])){
			header("Location: loginRegisterPage.php"); 
			exit();
		}


		$username = $_SESSION['username'];
		$database = new Database;
		$photourl = $database->getPhotoURLFromUsername($username);

	?>
</head>


<body>
<div id="header-wrapper"> 
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">Blue Bird</a></h1>
			<div id="menu">
				<ul>
					<li class="active"><a href="mainPage.php" accesskey="1">Homepage</a></li>
					<li><a href="eventsPage.php" accesskey="2">Events</a></li>
					<li><a href="#" accesskey="3">Search</a></li>
					<li><a href="#" accesskey="4">Profile</a></li>
					<li><a href="../Server/logout.php" accesskey="5">Logout</a></li>
				</ul>
			</div>
		</div>

		<div id="profile" class="container">
			<div id="profileInfo">
				<div id="profilePic">
					<img src=<?php echo $photourl; ?> height="256" width="256">
				</div>
				<div id="profileDescription">
					<p class="descriptionP">
						<?php 
							echo $username;
						?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>
