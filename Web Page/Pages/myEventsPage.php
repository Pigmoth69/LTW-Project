<!DOCTYPE html>

<html>
<head>
	<?php 
		include('head.php');
		makeHead("My Events Page");
		redirectToLogInIfLoggedOut($session);
		$userID = intval($_SESSION['userID']);
		$events = $database->getAllEvents();
	?>

<link href="../Styles/myEventsPageStyle.css" rel="stylesheet" type="text/css" media="all" />
<script src="../Client/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../Client/myEventsPage.js"></script>
</head>

<body>
	<?php 
		displayHeader("My Events", $userID); 
	?>
	
	<div id="CreateEvent">
		<input id="createButton" type="button" value="Create Event">
	</div>
	<div id="CancelEvent">
		<input id="cancelButton" type="button" value="Cancel">
	</div>

	<form id="addEvent" method="POST" enctype="multipart/form-data">
		<table>
			<tr>
				<td><span>New Event</span></td>
			</tr>
			<tr>
				<td rowspan="9">
					<figure>
						<img style="width:512px;height:512px;"id="preview" src="../Resources/Images/empty.jpg" alt="your image" />
						<figcaption>Event Image</figcaption>
					</figure>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type='file' id="eventImage" name="eventImage"/></td>
			</tr>
			<tr>
				<td><span>Event Name:</span></td>
				<td><input id="eventName" name="eventName" type="text"></td>
			</tr>
			<tr>
				<td><span>Type:</span></td>
				<td>
				<select id="eventType" name="eventType">
					<option value="Birthday">Birthday</option>
					<option value="Concert">Concert</option> 
					<option value="Sports">Sports</option>
					<option value="Meeting">Meeting</option>
					<option value="Wedding">Wedding</option>
					<option value="Party">Party</option>
					<option value="Conference">Conference</option>
					<option value="Misc Event">Misc Event</option>
				</select>
				</td>
			</tr>
			<tr>
				<td><span>Location:</span></td>
				<td><input id="eventLocation" name="eventLocation" type="text"></td>
			</tr>
			<tr>
				<td><span>Description:</span></td>
				<td><textarea rows="10%" cols="20%" id="eventDescription" name="eventDescription"></textarea></td>
			</tr>
			<tr>
				<td><span>Date:</span></td>
				<td><input type="date" id="eventDate" name="eventDate"></td>
			</tr>
			<tr>
				<td><span>Event Privacy</span></td>
				<td><select id="eventPrivacy" name="eventPrivacy">
					<option value="Public">Public</option> 
					<option value="Private">Private</option>
				</select></td>
			</tr>
			<tr>
				<td colspan="2"><input id="submit" type="submit" value="Submit"></td>
			</tr>
		</table>
		<div id="message"></div>
	</form>
		
	<div class="wrapper">
		<div id="portfolio" class="container">
				<?php
					foreach($events as $row){
						if($database->userIsFollowing($session->getUserID(), $row['id'])) {
							?>
						<div class="column">
							<div class="box"> <a href="#"><img src=" <?php echo $database->getPhotoURLFromEventID($row['id']); ?> " alt="" class="image image-full" height="200"/></a>
								<p><?php echo $row['description']; ?></p>
								<input id="Checkout<?php echo $row['id']; ?>" class="button" type="button" value="Checkout" eventID="<?php echo $row['id'] ?>"/>	
							</div>
						</div>
					<?php } }?>
		</div>
	</div>


	<?php
		include('pageFooter.php');
		displayFooter();
	?>

</body>
</html>