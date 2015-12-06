<!DOCTYPE html>

<html>
<head>
	<?php 
		include('head.php');
		makeHead("Users Page");
		redirectToLogInIfLoggedOut($session);
		$userID = intval($_SESSION['userID']);
		$users = $database->getAllUsers();
	?>

<link href="../Styles/myEventsPageStyle.css" rel="stylesheet" type="text/css" media="all" />
<script src="../Client/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../Client/usersPage.js"></script>
</head>

<body>
	<?php 
		displayHeader("Wild Birds", $userID); 
	?>
		
	<div class="wrapper">
		<div id="portfolio" class="container">
				<?php
					foreach($users as $row){
						if($session->getUserID() != $row['id']) {
							?>
						<div class="column">
							<div class="box"> <a href="#"><img src=" <?php echo $database->getPhotoURLFromUserID($row['id']); ?> " alt="" class="image image-full" height="200"/></a>
								<p><?php echo $row['username']; ?></p>
								<input id="Checkout<?php echo $row['id']; ?>" class="button" type="button" value="Checkout" userID="<?php echo $row['id'] ?>"/>	
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