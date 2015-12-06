<!DOCTYPE html>

<html>
<head>
	<?php 
	include('head.php');
	makeHead("Event Page");
	redirectToLogInIfLoggedOut($session);

	$eventID = intval($_GET['id']);
	$userID = intval($_SESSION['userID']);

	//$_SESSION['eventID'] = $eventID;
	$eventInfo = $database->getEventFromEventID($eventID);
	$eventPhotoURL = $database->getPhotoURLFromEventID($eventID);
	$eventHostUsername = $database->getUsernameFromUserID($eventInfo['idHost']);

	$participants = $database->getUsernamesInEventFromEventID($eventID);
	$comments = $database->getComments($eventID);
	$hostID = $database->getUserID($eventHostUsername);
	$following = $database->userIsFollowing($userID, $eventID);
	?>
	<link href="../styles/eventPage.css" rel="stylesheet" type="text/css" media="all" />
	<script src="../Client/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../Client/eventPage.js"></script>
	<input id='userID' value="<?php echo $userID;?>" hidden/> 
	<input id='hostID' value="<?php echo $hostID;?>" hidden/> 
	<input id='following' value="<?php echo $following;?>" hidden/> 

</head>
<body>
	<?php 
	displayHeader("Event", $userID);
	?>

	<div id="profile" class="container">
		<div id="profileInfo">
			<div id="profilePic">
				<img src=<?php echo $eventPhotoURL; ?> height="300" width="300">
			</div>
			<div id="profileDescription">
				<a class="descriptionP">
					<?php 
					echo $eventInfo['name'];
					?>
				</a><br><br>
				<a class="subTitle">Event created by </a>
				<a>
					<?php 
					echo $eventHostUsername;
					?>
				</a><br><br>
				<a class="subTitle">Description: </a>
				<a>
					<?php 
					echo $eventInfo['description'];
					?>
				</a><br><br>
				<a class="subTitle">Type of the event: </a>
				<a>
					<?php 
					echo $eventInfo['type'];
					?>
				</a><br><br>
				<a class="subTitle">Event happening at </a>
				<a>
					<?php 
					echo $eventInfo['location'];
					?>
				</a><br><br>
				<a class="subTitle">Event created at  </a>
				<a>
					<?php 
					echo $eventInfo['creationDate'];
					?>
				</a><br><br>
				<a class="subTitle">Event happening at  </a>
				<a>
					<?php 
					echo $eventInfo['eventDate'];
					?>
				</a>
			</div>
		</div>
	</div>

	<table id="optionButtons">
		<tr>
			<td><input id="leave" class="button button-small" type="button" value="Leave"/></td>
			<td><input id="edit" class="button button-small" type="button" value="Edit"/></td>
			<td><input id="delete" class="button button-small" type="button" value="Delete"/></td>
			<td><input id="join" class="button button-small" type="button" value="Join"/></td>
			<td><input id="invite" class="button button-small" type="button" value="Invite"/></td>
		</tr>
	</table>

	<form class="editInfoForm" id="editInfoForm" action="../Server/editEventInfo.php" method="post" enctype="multipart/form-data">
		<div id="description">
			<p>Name: </p>
			<p>Photo: </p>
			<p>Description: </p>
			<p>Type: </p>
			<p>Location: </p>
			<p>New Event Date: </p>
		</div>

		<div id="inputsDiv">
			<input id='eventID' name='eventID' value="<?php echo $eventID;?>" hidden/> 
			<div><input type="text" value="" placeholder="Name" id="name" name="name" class="profileInput" size="30%"/></div>
			<div><input type="file" id="photo" name="photo"/></div>
			<div><input type="text" value="" placeholder="Description" id="editdescription" name="editdescription" class="profileInput" size="30%"/></div>
			<div><select id="eventtype" name="eventtype" class="profileInput">
				<option value="----">----</option>
				<option value="Birthday">Birthday</option>
				<option value="Concert">Concert</option> 
				<option value="Sports">Sports</option>
				<option value="Meeting">Meeting</option>
				<option value="Wedding">Wedding</option>
				<option value="Party">Party</option>
				<option value="Conference">Conference</option>
				<option value="Misc Event">Misc Event</option>
			</select>
		</div>
		<div><input type="text" value="" placeholder="Location" id="location" name="location" class="profileInput" size="30%"/></div>
		<div><input type="date" value="" class="profileInput" id="date" name="date"/></div>
	</div>


	<span id="save"><input type="submit" id="saveButton" value="Save Changes"></span>

	<div id="message"></div>
</form>

<div id="message1"></div>

<div id="comments" class="container">
	<div class="box">
		<?php
		foreach($comments as $comments){?>
		<div class="comment-box">
			<?php 
			$userPhotoURL = $database->getPhotoURLFromUserID($comments['idUser']);
			$username = $database->getUsernameFromUserID($comments['idUser']);
			$comment = $comments['commentary'];
			?>
			<table>
				<tr>
					<td rowspan="2"><img src="<?php echo $userPhotoURL ?>" class="image" height="128" width="128"/></td>
					<td><h3><?php echo $username . " commented: "?></h3></td>
				</tr>
				<tr>
					<td><p><?php echo $comment ?></p></td>
				</tr>
			</table>
		</div>
		<?php } ?>
		<div id="makeComment"class="comment-box">
			<?php 
			$userPhotoURL = $database->getPhotoURLFromUserID($userID);
			$username = $database->getUsernameFromUserID($userID);
			?>
			<table>
				<tr>
					<td rowspan="2"><img src="<?php echo $userPhotoURL ?>" class="image" height="128" width="128"/></td>
					<td><h3><?php echo $username . " says: "?></h3></td>
				</tr>
				<tr>
					<td><textarea rows="7%" cols="100%" id="userComment" name="userComment"></textarea></td>
				</tr>
				<tr>
					<td colspan="2">
						<div id="evID" value="<?php echo $_GET['id']?>"</div>
						<input id="addComment" class="button button-small" type="button" value="Comment"/>
					</td>
				</tr>
			</table>
		</div>
	</div>

</div>

<div id="inviteUser" class="modal">
	<div class="modal-form">
		<form id="inviteForm">
			<input id="invitedUsername" type="text" placeholder="Invite user" value=""/>

			<input id="sendInvite" class="button button-small" type="submit" value="Send"/>
			<input id="cancelInvite" class="button button-small" type="button" value="Cancel"/>
		</form> 
	</div>
</div>

<?php
include('pageFooter.php');
displayFooter();
?>
</body>


