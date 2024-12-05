<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>About | Autoload Builder</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/about.css">
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1>About | Autoload Builder</h1>
			
			<p>The <a href='/builder'>Autoload Builder</a> helps build an army for a 
			given point/figure/hex combination.</p>
			<p>Enter the quantity of each unit in your army, and the builder will display the 
			point, figure, and hex total of the army as you go.</p>
			
			<h2>How to Use</h2>
			<p>Scroll through the list of figures to find each given figure, and use the 
			'+' & '-' buttons to increase (or decrease) the quantity of that figure in your army.</p>
			
			<h2>Settings</h2>
			<ul>
				<li>Unit List : Classic v. VC</li>
				<li>Pricing : Standard v. Delta</li>
			</ul>
			
			<h2>Searching</h2>
			<p>Use the search bar to limit the figures in the list.</p>
			<p>The search bar checks unit names and unit power text.</p>
			
			<h2>Sorting</h2>
			<p>Units can be sorted by up to 2 sorting methods at once.</p>
			<p>The default sorting method is 'Alphabetical'.</p>
			<p>To sort the units, select a sorting option from either the first sorting dropdown, 
			or both sorting dropdowns. The dropdowns are listed near the top of the page, 
			to the right of the search bar.</p>
			<p>The following sort methods are supported:</p>
			<ul>
				<li>Alphabetical</li>
				<li>Points (High to Low)</li>
				<li>Points (Low to High)</li>
				<li>General</li>
				<li>Species</li>
				<li>Personality</li>
				<li>Class</li>
				<li>Move</li>
				<li>Range</li>
				<li>Attack</li>
				<li>Defense</li>
				<li>Life</li>
			</ul>
		</article>
	</div>
	<?php include(Footer); ?>

</div></body>
</html>