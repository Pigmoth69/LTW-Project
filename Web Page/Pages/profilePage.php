<!DOCTYPE html>

<html>
<head>
	<?php 
		include('head.php');
		makeHead("Profile Page");
		redirectToLogInIfLoggedOut($session);

		$userIDLink = intval($_GET['id']);

		$database = new Database;
		$userID = intval($_SESSION['userID']);
		$username = $database->getUsernameFromUserID($userIDLink);
		$fullname = $database->getFullnameFromUserID($userIDLink);
		$photourl = $database->getPhotoURLFromUserID($userIDLink);
		$birth = $database->getBirthFromUserID($userIDLink);
		$email = $database->getEmailFromUserID($userIDLink);
		$joinedEvents = $database->getUserEvents($userIDLink);
		$ownedEvents = $database->getUserOwnedEvents($userIDLink);
	?>
		<link href="../Styles/profilePageStyle.css" rel="stylesheet" type="text/css" media="all" />
		<script src="../Client/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="../Client/editProfile.js"></script>

</head>

<body>
	<?php 
		displayHeader("Wild Bird", $userID); 
	?>

	<input id='userID' value="<?php echo $userID;?>" hidden/> 
	<input id='userIDLink' value="<?php echo $userIDLink;?>" hidden/> 

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
		<div class="editInfoDiv">
				<input type="button" id="editInfo" value="Edit Profile">
				<input type="button" id="deleteAccount" value="Delete Account">
		</div> 

		<form class="editInfoForm" id="editInfoForm" action="../Server/editUserInfo.php" method="post" enctype="multipart/form-data">
			<div id="description">
				<p>Full Name: </p>
				<p>Insert Profile Photo: </p>
				<p>Insert New Password: </p>
				<p>Repeat New Password: </p>
				<p>New Email: </p>
				<p>Insert New Birth Date: </p>

			</div>

			<div id="inputsDiv">
				<div><input type="text" value="" placeholder="Full Name" id="fullname" name="fullname" class="profileInput" size="30%"/></div>
				<div><input type="file" id="photo" name="photo"/></div>
				<div><input type="password" value="" placeholder="New Password" id="password" name="password" class="profileInput" size="30%"/></div>
				<div><input type="password" value="" placeholder="Verify New Password" id="verifyPassword" name="verifyPassword" class="profileInput" size="30%"/></div>
			<div><input type="text" value="" placeholder="New Email" id="email" name="email" class="profileInput" size="30%"/></div>
			<div><input type="date" value="" class="profileInput" id="date" name="date"/></div>
		</div>


		<span id="save"><input type="submit" id="saveButton" value="Save Changes"></span>

		<div id="message"></div>
	</form>
	<div id="deleteMessage"></div>	


	<?php
		include('pageFooter.php');
		displayFooter();
	?>

	
</body>
</html>
