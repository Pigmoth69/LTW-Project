<!DOCTYPE html>

<html>
<head>
	<?php 
		include('head.php');
		makeHead("Profile Page");
		redirectToLogInIfLoggedOut($session);


		$database = new Database;
		$userID = intval($_SESSION['userID']);
		$username = $database->getUsernameFromUserID($userID);
		$fullname = $database->getFullnameFromUserID($userID);
		$photourl = $database->getPhotoURLFromUserID($userID);
		$birth = $database->getBirthFromUserID($userID);
		$email = $database->getEmailFromUserID($userID);
		$joinedEvents = $database->getUserEvents($userID);
		$ownedEvents = $database->getUserOwnedEvents($userID);
		?>
		<link href="../Styles/profilePageStyle.css" rel="stylesheet" type="text/css" media="all" />
		<script src="../Client/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="../Client/editProfile.js"></script>

</head>

<body>
	<?php 
		displayHeader("Wild Bird"); 
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

	<div class="editInfoDiv"><input type="button" id="editInfo" value="Edit Profile"></div> 

	<form class="editInfoForm" method="POST">
		<div id="user-fullname">
			<span>Full Name: </span>
			<input type="text" value="" placeholder="Full Name" id="fullname" size="30rem"/>
		</div>

		<div id="user-photo">
			<span>Insert Profile Photo: </span>
			<input type="file" value="" placeholder="Photo" id="photo" />
		</div>

		<div id="user-password">
			<span>Insert New Password: </span>
			<input type="password" value="" placeholder="New Password" id="password" size="30rem"/>
		</div>

		<div id="user-verifypassword">
			<span>Repeat New Password: </span>
			<input type="password" value="" placeholder="Verify New Password" id="verifyPassword" size="30rem"/>
		</div>

		<div id="user-email">
			<span>New Email: </span>
			<input type="text" value="" placeholder="New Email" id="email" size="30rem"/>
		</div>

		<div id="user-birthdate">
			<span>Insert New Birth Date: </span>
			<input type="date" value="" id="date" />
		</div>

		<div class="save"><input type="submit" id="saveButton" value="Save Changes"></div> 

		<div id="message"></div>
	</form>


	<?php
		include('pageFooter.php');
		displayFooter();
	?>

	
</body>
</html>
