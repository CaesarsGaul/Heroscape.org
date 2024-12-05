<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>About | Scoring</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/about.css">
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1>About | Scoring</h1>
			
			<p>The <a href=''>Scoring</a> page lets you calculate the partial card scoring values 
			for 2 armies at once.</p>
			<p>This tool is designed for use when figuring out who won when a game goes to time.</p>
			
			<h2>How to Use</h2>
			<p>In the figure list, use the '+' and '-' buttons to increase (or decrease) 
			the quantity of each figure included in Army 1 or Army 2.</p>
			<p>For heroes, the quantity represents the number of lives that hero has remaining.</p>
			<p>For squads, the quantity represents the number of individual figures remaining.</p>
			
			<h2>Options (Settings / Searching / Sorting)</h2>
			<p>The Scoring page supports the same options as the Autoload Builder. See it's 
			<a href='/about/builder'>about page</a> for details.</p>
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>