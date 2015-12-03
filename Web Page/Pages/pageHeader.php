<?php
 function displayHeader(){?>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">Blue Bird</a></h1>
		</div>
			<div id="menu"> 
				<ul>
					<li><a href="mainPage.php">Homepage</a></li>
					<li><a href="#">Events</a>
							<ul> 
								<li><a href='eventsPage.php'>View all Events</a></li> 
								<li><a href='#'>Manage Events</a></li>
								<li><a href='#'>Sub Link 3</a></li>
								<li><a href='#'>Sub Link 4</a></li>
							</ul>
						</li>
					<li><a href="#">Search</a></li>
					<li><a href="profilePage.php">Profile</a></li> 
					<li><a href="../Server/logout.php">Logout</a></li> 
				</ul>
		</div>
	</div>
</div
<?php }?> 



