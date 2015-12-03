<?php
 function displayHeader(){?>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">Wild Bird</a></h1>
		</div>
			<div id="menu"> 
				<ul>
					<li><a href="homePage.php">Homepage</a></li>
					<li><a href="#">Events</a>
							<ul> 
								<li><a href='myEventsPage.php'>View my Events</a></li> 
								<li><a href='createEventPage.php'>Create New Event</a></li>
								<li><a href='searchEventsPage.php'>Search For Events</a></li>
							</ul>
						</li>
					<li><a href="usersPage.php">Users</a></li>
					<li><a href="profilePage.php">Profile</a></li> 
					<li><a href="../Server/logout.php">Logout</a></li> 
				</ul>
		</div>
	</div>
</div>
<?php }?> 



