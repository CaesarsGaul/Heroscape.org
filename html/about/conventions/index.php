<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>About | Conventions</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/about.css">
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1>About | Conventions</h1>
			
			<p>The <a href='/events/convention/list'>Conventions</a> page supports running a Heroscape 
			convention, where a convention consists of a series of tournaments played by a 
			common player pool.</p>
			<p>A convention must be created manually by Chris Perkins. 
			<a href='/contact'>Contact Heroscape.org</a> if you would like to use the site to 
			run a convention.</p>
			
			<h2>Features</h2>
			<ul>
				<li>Registration : A user must have an account on Heroscape.org to register. Optionally, 
				you may specify a private key that a user must use to register for the convention.</li>
				<li>Tournaments : Each tournament that is part of the convention is listed on the main 
				convention page. Once a user is registered for the convention, they are then able to 
				register for individual tournaments.</li>
				<li>Standings : An overall standings list that combines records from all tournaments 
				in the convention is displayed on the main convention page.</li>
				<li>Announcements : A convention admin may make an announcement to all users registered 
				for the convention. This causes an email to be sent to each user containing the announcement.</li>
			</ul>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>