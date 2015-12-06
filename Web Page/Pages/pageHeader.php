<?php
 function displayHeader($pageName, $userID){?>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">	
			<h1><a href="#"><?php echo $pageName ?></a></h1>
		</div>
			<div id="menu"> 
				<ul>
					<a href="homePage.php"><li>Homepage</li></a>
					<li><a>Events</a>
							<ul> 
								<a href='myEventsPage.php'><li>Manage my Events</li></a>
								<a href='searchEventsPage.php'><li>Search For Events</li></a>
							</ul> 
						</li>
					<a href="usersPage.php"><li>Users</li></a>
					<a href=" <?php echo 'profilePage.php?id=' . $userID; ?> "><li>Profile</li></a> 
					<a href="../Server/logout.php"><li>Logout</li></a>
				</ul>
		</div>
	</div>
</div>
<?php }?> 