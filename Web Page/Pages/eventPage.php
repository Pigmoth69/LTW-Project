<!DOCTYPE html>

<html>
<head>
	<?php 
		include('head.php');
		makeHead("Event Page");
		redirectToLogInIfLoggedOut($session);

		$eventID = intval($_GET['id']);
		$userID = intval($_SESSION['userID']);
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
</head>
<body>
	<?php 
		displayHeader("Event", $userID);
	?>
	<div id="portfolio" class="container">

		<input id='eventID' value="<?php echo $eventID;?>" hidden/> 
		<input id='userID' value="<?php echo $userID;?>" hidden/>
		<input id='hostID' value="<?php echo $hostID;?>" hidden/>
		<input id='following' value="<?php echo $following;?>" hidden/>

		<div class="box">
			<a href="#"><img src="<?php echo $eventPhotoURL ?>" class="image" height="256" width="256"/></a>
			<div id='eventName'><?php echo $eventInfo['name']; ?></div>
			<div id='eventHost'><?php echo 'Event created by ' . $eventHostUsername; ?></div>
			<div id='eventDescription'><?php echo 'Description: ' . $eventInfo['description']; ?></div>
			<div id='eventLocation'><?php echo 'Event happening at ' . $eventInfo['location']; ?></div>
			<div id='eventCreationDate'><?php echo 'Event created at ' .$eventInfo['creationDate']; ?></div>
			<div id='eventDate'><?php echo 'Event happening at ' . $eventInfo['eventDate']; ?></div>
			<div id='eventParticipants'><?php 
				foreach($participants as $participant){
					echo $participant['username'] . '<br>';
				}?>
			</div>

			<input id="leave" class="button button-small" type="button" value="Leave"/>
			<input id="edit" class="button button-small" type="button" value="Edit"/>
			<input id="delete" class="button button-small" type="button" value="Delete"/>

			<input id="join" class="button button-small" type="button" value="Join"/>
			
		</div>
		
		<div id="message"></div>

	</div>

	<div id="comments" class="container">
		<div class="box" id="comment-box">
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
		</div>
		<div class="addComment">
		</div>
	</div>
</body>


