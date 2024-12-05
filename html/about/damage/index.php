<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>About | Damage Calculator</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/about.css">
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1>About | Damage Calculator</h1>
			
			<p>The <a href=''>Damage Calculator</a> calculates the odds of each possible 
			outcome for a given attack v. defense roll.</p>
			
			<h2>How To Use</h2>
			<ol>
				<li>Set the attack value</li>
				<li>Set the defense value</li>
				<li>(Optionally) Set any special attack or defense powers by checking the box to the left of the power's name</li>
				<li>Click 'Calculate'</li>
			</ol>
			
			<h2>Output</h2>
			<p>The output is displayed in tabular format.</p>
			<p>Each row represents a given amount of wounds that could be inflicted.</p>
			<p>The first column contains the probability that no more than the given number of wounds will be inflicted.</p>
			<p>The second column contains the probability that exactly the given number of wounds will be inflicted.</p>
			<p>The third column contains the probability that at least the given number of wounds will be inflicted.</p>
			
			<h2>Inspiration</h2>
			<p>Thanks to Vegietarian18 for inspiring this tool via his Sterilizing Pear 
			app (Android only). Definitely worth a download for any android users out there.</p>
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>