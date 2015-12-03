<!DOCTYPE html>

<html>

<head>
	<?php 
		include('head.php');
		makeHeader("Main Page"); 
	?>
	<link href="../styles/mainPageStyle.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
	<?php 
		include('pageHeader.php');
		displayHeader(); 
	?>

	<div id="page-wrapper">
		<div id="welcome" class="container">
			<div class="title">
				<h2>Welcome to our website</h2>
			</div>
			<p>This is <strong>EarthyBlue</strong>, a free, fully standards-compliant CSS template designed by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. The photos in this template are from <a href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty much free to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :) </p>
			<img src="../Resources/Images/banner.jpg" class="image image-full" alt="" />
		</div>
	</div>


	<?php
		include('pageFooter.php');
		displayFooter();
	?>
</body>
</html>
