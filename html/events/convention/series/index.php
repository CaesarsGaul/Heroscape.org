<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Convention Series</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/standings.css">
	<style>
		
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	<script src='/js/standings.js'></script>
	<script src='/js/announcement.js'></script>
	<script src="/connect/socket.io/socket.io.js"></script>
		
	<script>
		function displayConventionSeries(conventionSeries) {
			var parentElem = document.getElementById("h1");
			parentElem.innerHTML = conventionSeries.name;
			
			parentElem = document.getElementById("Conventions");
			var admins = [];
			var tournaments = [];
			for (let i = 0; i < conventionSeries.conventions.length; i++) {
				const convention = conventionSeries.conventions[i];
				var conventionDiv = createDiv({});
				
				conventionDiv.appendChild(createA({
					href: "/events/convention/?Convention="+convention.id,
					innerHTML: convention.name,
					target: "_blank"
				}));
				conventionDiv.appendChild(createSpan({
					innerHTML: " (" + convention.startDate + " - " + convention.endDate + ")"
				}));
				
				parentElem.appendChild(conventionDiv);
				
				for (let j = 0; j < convention.admins.length; j++) {
					if ( ! admins.includes(convention.admins[j].user.userName)) {
						admins.push(convention.admins[j].user.userName);
					}
				}
				
				tournaments = tournaments.concat(convention.tournaments);
			}
			
			displayStandings(tournaments, document.getElementById("Standings"));
			
			parentElem = document.getElementById("Admins");
			admins.sort();
			for (let i = 0; i < admins.length; i++) {
				const admin = admins[i];
				parentElem.appendChild(createP({
					innerHTML: admin
				}));
			}
		}
		
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(EventsNav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1 id='h1'></h1>
			<div id='Conventions'>
				<h2>Conventions</h2>
			</div>
			<div id='Standings'>
				<h2>Standings</h2>
			</div>
			<div id='Admins'>
				<h2>Admins</h2>
			</div>
			
			<script>
				const conventionSeriesID = findGetParameter("ConventionSeries");
				if (conventionSeriesID != null) {
					ConventionSeriesView.load(
						{ConventionSeries_id: conventionSeriesID},
						function (viewRows) {
							DatabaseObject.extractView(ConventionSeriesView.list);
							var conventionSeries = ConventionSeries.list[0];
							displayConventionSeries(conventionSeries);
						},
						{joins: {}}
					);
					ConventionSeries.load(
						{id: conventionSeriesID},
						function (series) {
							conventionSeries = series[0];
						},
						{joins: {
							"Convention.conventionSeriesID": {
								"Admin.conventionID": {
									"userID": {}
								}	
							},
					}});
				} else {
					document.getElementById("Convention").appendChild(
						createP({
							innerHTML: "There was an error loading this page; " +
								"make sure you used a valid link to reach this page."}));
				}
			</script>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>