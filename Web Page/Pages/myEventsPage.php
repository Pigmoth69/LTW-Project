<!DOCTYPE html>

<html>
<head>
	<?php 
		include('head.php');
		makeHead("My Events Page");
		redirectToLogInIfLoggedOut($session);

		$events = $database->getAllEvents();
	?>

<link href="../Styles/myEventsPageStyle.css" rel="stylesheet" type="text/css" media="all" />
<script src="../Client/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../Client/myEventsPage.js"></script>
</head>

<body>
	<?php 
		displayHeader("My Events"); 
	?>
	
	<div id="CreateEvent">
		<input id="createButton" type="button" value="Create Event">
	</div>
	<div id="CancelEvent">
		<input id="cancelButton" type="button" value="Cancel">
	</div>

	<div id="addEvent">
		<table>
			<tr>
				<td><span>New Event</span></td>
			</tr>
			<tr>
				<td rowspan="9">
					<figure>
						<img style="width:256px;height:256px;"id="preview" src="../Resources/Images/empty.jpg" alt="your image" />
						<figcaption>Event Image</figcaption>
					</figure>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type='file' id="eventImage" /></td>
			</tr>
			<tr>
				<td><span>Event Name:</span></td>
				<td><input id="eventName" type="text"></td>
			</tr>
			<tr>
				<td><span>Type:</span></td>
				<td>
				<select id="eventType">
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
				<td><input id="eventLocation" type="text"></td>
			</tr>
			<tr>
				<td><span>Description:</span></td>
				<td><textarea rows="10%" cols="20%" id="eventDescription"></textarea></td>
			</tr>
			<tr>
				<td><span>Date:</span></td>
				<td><input type="date" id="eventDate" name="eventdate"></td>
			</tr>
			<tr>
				<td><span>Private</span></td>
				<td><input type="checkbox" id="eventPrivacy"name="private" value=""></td>
			</tr>
			<tr>
				<td colspan="2"><input id="submit" type="submit" value="Submit"></td>
			</tr>
		</table>
		<div id="message"></div>
	</div>
		
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