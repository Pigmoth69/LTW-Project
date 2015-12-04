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
		<form action="" method="post">
			<h1>Create new Event</h1>
			<form id="uploadImg">
				<input type='file' id="eventImage" />
				<img id="preview" src="../Resources/Images/empty.jpg" alt="your image" />
			</form>
			Name<input id="name" name="name" type="text">
			Type
			<select>
				<option value="Birthday">Birthday</option>
				<option value="Concert">Concert</option>
				<option value="Sports">Sports</option>
				<option value="Meeting">Meeting</option>
				<option value="Wedding">Wedding</option>
				<option value="Party">Party</option>
				<option value="Conference">Conference</option>
				<option value="Misc Event">Misc Event</option>
			</select>
			Location<input id="name" name="name" type="text">
			Descrição<textarea rows="10%" cols="20%" name="comment"></textarea>
			Date<input type="date" name="eventdate">
			Private<input type="checkbox" name="private" value="">
			<input id="submit" type="submit" value="Submit">
		</form>
	</div>
	</div>
	
	<div class="wrapper">
		<div id="portfolio" class="container">
				<?php
					foreach($events as $row){
						if($database->userIsFollowing($session->getUserID(), $row['id'])) {
							?>
						<div class="column">
							<div class="box"> <a href="#"><img src="../Resources/Images/scr01.jpg" alt="" class="image image-full" /></a>
								<p><?php echo $row['description']; ?></p>
								<input id="Checkout<?php echo $row['id']; ?>" class="button button-small" type="button" value="Checkout" eventID="<?php echo $row['id'] ?>"/>	
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