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
</head>

<body>
	<?php 
		displayHeader(); 
	?>

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

	<script src="../Client/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../Client/myEventsPage.js"></script>
</body>
</html>