<!DOCTYPE html>

<html>
<head>
	<?php 
		include('head.php');
		makeHead("Event Page");
		redirectToLogInIfLoggedOut($session);

		$eventID = intval($_GET['id']);

		$eventInfo = $database->getEventFromEventID($eventID);
		$eventPhotoURL = $database->getPhotoURLFromEventID($eventID);
		$eventHostUsername = $database->getUsernameFromUserID($eventInfo['idHost']);
		$participants = $database->getUsernamesInEventFromEventID($eventID);
	?>
		<link href="../styles/myEventsPageStyle.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
	<?php 
		displayHeader("Event");
	?>
	<div id="portfolio" class="container">

		<div class="box"> <a href="#"><img src="<?php echo $eventPhotoURL ?>" class="image" height="256" width="256"/></a>
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

			<input id="leave" class="button button-small" type="button" value="Leave" eventID="<?php echo $eventInfo['id']; ?>"/>	
		</div>

	</div>

	<script src="../Client/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../Client/eventPage.js"></script>
</body>
