<!DOCTYPE html>

<html>
<head>
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../styles/eventsPageStyle.css" rel="stylesheet" type="text/css" media="all" />
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
	<div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#">Blue Bird</a></h1>
				<div id="menu">
					<ul>
						<li class="active"><a href="mainPage.php" accesskey="1" title="">Homepage</a></li>
						<li><a href="#" accesskey="2" title="">Events</a></li>
						<li><a href="#" accesskey="3" title="">Search</a></li>
						<li><a href="profilePage.php" accesskey="4" title="">Profile</a></li>
						<li><a href="../Server/logout.php" accesskey="5" title="">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="wrapper">
		<div id="portfolio" class="container">
				<?php
					foreach($events as $row){
						if(!$database->userIsFollowing($session->getUserID(), $row['id']) && !$database->eventIsPrivate($row['id'])) {
							?>
						<div class="column">
							<div class="box"> <a href="#"><img src="../Resources/Images/scr01.jpg" alt="" class="image image-full" /></a>
								<p><?php echo $row['description']; ?></p>
								<input id="Aderir<?php echo $row['id']; ?>" class="button button-small" type="button" value="Aderir" eventID="<?php echo $row['id'] ?>"/>	
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
	<script type="text/javascript" src="../Client/searchPage.js"></script>
</body>
</html>