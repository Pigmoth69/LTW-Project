<!DOCTYPE html>

<html>
<head>
	<?php 
		include('head.php');
		makeHead("Search Page");
		redirectToLogInIfLoggedOut($session);

		$events = $database->getAllEvents();
	?>

<link href="../Styles/myEventsPageStyle.css" rel="stylesheet" type="text/css" media="all" />

<script src="../Client/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../Client/searchEventsPage.js"></script>
</head>

<body>
	<?php 
		displayHeader("Search Events"); 
	?>

	<div class="wrapper">
		<div id="portfolio" class="container">
				<?php
					foreach($events as $row){
						if(!$database->userIsFollowing($session->getUserID(), $row['id']) && !$database->eventIsPrivate($row['id'])) {
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