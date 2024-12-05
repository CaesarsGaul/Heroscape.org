<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Conventions</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		.conventionGroup {
			display: inline-block;
			width: 200px;
			margin-left: 10px;
			margin-right: 10px;
			vertical-align: top;
		}
		
		.conventionSeries {
			margin: auto; 
		}
		
		.convention, .conventionSeries {
			/*border: 1px solid black;*/
			padding: 5px;
			/*border-radius: 10px;*/
			margin-top: 10px;
			max-width: 200px;
		}
		
		.convention a, .conventionSeries a {
			text-decoration: none;
			color: initial;
		}
		
		#CreateLink {
			display: inline-block;
			padding: 5px;
			padding-left: 10px;
			padding-right: 10px;
			margin: 10px;
			border: 1px solid black;
			text-decoration: none;
			color: initial;
			background-color: var(--primary_color);
			border-radius: 5px;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
		
	<script>
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(EventsNav); ?>
	
	<div id='pageContent'>
		<article>	
			<h1>Conventions</h1>
			<div class='conventionGroup'>
				<h2>Current</h2>
				<div id='currentConventions'></div>
			</div>
			
			<div class='conventionGroup'>
				<h2>Upcoming</h2>
				<div id='upcomingConventions'></div>
			</div>
			
			<div class='conventionGroup'>
				<h2>Past</h2>
				<div id='pastConventions'></div>
			</div>
			
			<div>
				<h2>Convention Series</h2>
				<div id='conventionSeries'></div>
			</div>
			
			<script>
				function displayConvention(convention, divId) {
					var parentElem = document.getElementById(divId);
										
					var div = createDiv({class: 'convention'});
					parentElem.appendChild(div);
					
					var nameStr = convention.name;
					
					var link = createA({
						href: "/events/convention/?Convention="+convention.id, 
						innerHTML: nameStr});
					div.appendChild(link);					
				}
				
				function displayConventionSeries(conventionSeries) {
					var parentElem = document.getElementById("conventionSeries");
					
					var div = createDiv({class: 'conventionSeries'});
					parentElem.appendChild(div);
					
					var nameStr = conventionSeries.name;
					
					var link = createA({
						href: "/events/convention/series?ConventionSeries="+conventionSeries.id, 
						innerHTML: nameStr});
					div.appendChild(link);
				}
			
				const today = dateToString(new Date(), false);
				//const today = datetimeToString(new Date());
				
				// Current Conventions
				Convention.load(
					{startBefore: today,
						endAfter: today}, 
					function (conventions) {		
						for (var i = 0; i < conventions.length; i++) {
							displayConvention(conventions[i], "currentConventions");
						}
					}, 
					{joins: {
						"conventionSeriesID": {}
					}}
				);
				
				// Upcoming Conventions
				Convention.load(
					{startAfter: today}, 
					function (conventions) {						
						for (var i = 0; i < conventions.length; i++) {
							displayConvention(conventions[i], "upcomingConventions");
						}
					}, 
					{joins: {
						"conventionSeriesID": {}
					}}
				);
				
				// Past Conventions
				Convention.load(
					{endBefore: today},
					function (conventions) {						
						for (var i = 0; i < conventions.length; i++) {
							displayConvention(conventions[i], "pastConventions");
						}
					}, 
					{joins: {
						"conventionSeriesID": {}
					}}
				);
				
				// Convention Series
				ConventionSeries.load(
					{},
					function (conventionSeries) {
						for (let i = 0; i < conventionSeries.length; i++) {
							displayConventionSeries(conventionSeries[i]);
						}
					},
					{joins: {}}
				);
			</script>
			
			<!--<div>
				<a id='CreateLink' href='/events/convention/create'>Create New Convention</a>
			</div>-->
		</article>
	</div>

	<?php include(Footer); ?>

</div></body>
</html>