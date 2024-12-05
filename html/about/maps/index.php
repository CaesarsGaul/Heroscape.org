<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>About | Maps</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/about.css">
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1>About | Maps</h1>
			
			<p>The <a href='/maps'>Maps</a> page contains data associated with many different Heroscape maps.</p>
			<p>The page contains a dropdown that lets you choose the name of a map. After choosing the map, the known data for the map is displayed on the page.</p>
			<h2>Map Information</h2>
			<p>The following data is displayed for each map (when it is known):</p>
			<ul>
				<li>Author</li>
				<li>Build Instructions</li>
				<li># of Players</li>
				<li>Terrain Requirements</li>
				<li>Tags</li>
				<li>Image</li>
				<li>Tournaments hosted on Heroscape.org that used the map</li>
			</ul>
			<h2>Tags</h2>
			<p>A series of tags are used to describe various maps. A list of those tags appears below.</p>
			<p>Map Groups:</p>
			<ul>
				<li>ARV</li>
				<li>BoV</li>
				<li>WoS</li>
			</ul>
			<p>Map Formats:</p>
			<ul>
				<li>Burnout</li>
				<li>Heat of Battle</li>
				<li>Scraps</li>
			</ul>
			<p>Other:</p>
			<ul>
				<li>Casual</li>
				<li>Large SZ</li>
				<li>Small SZ</li>
				<li>Team</li>
				<li>Tournament</li>
			</ul>
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>