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
		if(!isset($_SESSION['login'])){
			header("Location: loginRegisterPage.php"); 
			exit();
		}

		$database = new Database;

		$username = $_SESSION['username'];
		$id = $database->getUserID($username);
		$fullname = $database->getFullnameFromUsername($username);
		$photourl = $database->getPhotoURLFromUsername($username);
		$birth = $database->getBirthFromUsername($username);
		$email = $database->getEmailFromUsername($username);
		$joinedEvents = $database->getUserEvents($id);
		$ownedEvents = $database->getUserOwnedEvents($id);
	?>
</head>
<body>
	<?php 
		include('pageHeader.php');
		displayHeader(); 
	?>

	<div id="profile" class="container">
		<div id="profileInfo">
			<div id="profilePic">
				<img src=<?php echo $photourl; ?> height="256" width="256">
			</div>
			<div id="profileDescription">
				<a class="descriptionP">
					<?php 
						echo $fullname;
					?>
				</a><br><br>
				<a class="subTitle">Username: </a>
				<a>
					<?php 
						echo $username;
					?>
				</a><br><br>
				<a class="subTitle">Date of birth: </a>
				<a>
					<?php 
						echo $birth;
					?>
				</a><br><br>
				<a class="subTitle">Email: </a>
				<a>
					<?php 
						echo $email;
					?>
				</a><br><br>
				<a class="subTitle">Joined Events: </a>
				<a>
					<?php 
						echo count($joinedEvents);
					?>
				</a><br><br>
				<a class="subTitle">Owned Events: </a>
				<a>
					<?php 
						echo count($ownedEvents);
					?>
				</a>
			</div>
		</div>
	</div>



	<?php
		include('pageFooter.php');
		displayFooter();
	?>
</body>
</html>
