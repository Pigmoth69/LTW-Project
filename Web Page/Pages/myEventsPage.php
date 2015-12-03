<!DOCTYPE html>

<html>
<head>
	<?php 
		include('head.php');
		makeHeader("Main Page"); 
	?>

<link href="../styles/myEventsPageStyle.css" rel="stylesheet" type="text/css" media="all" />
<?php
	include '../Server/startSession.php';
	include '../Server/Database.php';
	include '../Server/session.php';
	
	$database = new Database;
	$events = $database->getAllEvents();
	try {
		$session = new Session;
	}
	catch(Exception $e) {
		die($e->getMessage());
	}

?>

</head>

<body>
	<?php 
		include('pageHeader.php');
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