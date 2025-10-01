<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Convention Series</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/standings.css">
	<link rel="stylesheet" href="/css/announcement.css">
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
		socket = null;
		
		function createSocket() {
			socket = io.connect("/", {path: "/connect/socket.io"});
			
			/*socket.on('userDropped', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				const removedUser = jsonObj.user;
				
				for (let i = 0; i < currentConvention.attendees.length; i++) {
					const attendee = currentConvention.attendees[i];
					const user = attendee.user;
					
					if (user.id == removedUser.id) {
						currentConvention.attendees.splice(i,1);
						break;
					}
				}
				displayConvention();
			});*/
		}

		currentConventionSeries = null;
		isAdmin = false;
		
		function _checkAdmin() {
			if (loggedIn()) {
				const userName = decodeURIComponent(getCookieValue("hs_username"));
				for (let i = 0; i < currentConventionSeries.admins.length; i++) {
					const adminUser = currentConventionSeries.admins[i].user;
					if (adminUser.userName == userName) {
						isAdmin = true;
						return;
					}
				}
			}
		}
		
		function _emitAnnouncement(announcement) {
			socket.emit("conventionSeriesAnnouncement",
				JSON.stringify({
					conventionSeries: {
						id: currentConventionSeries.id,
						name: currentConventionSeries.name
					},
					announcement: announcement
				})
			);
		}
		
		function displayConventionSeries(conventionSeries) {
			currentConventionSeries = conventionSeries;
			
			var parentElem = document.getElementById("h1");
			parentElem.innerHTML = conventionSeries.name;
			
			_checkAdmin();
			
			createSocket();
			socket.emit("loadConventionSeries", JSON.stringify({conventionSeries: {id: currentConventionSeries.id}}));
			
			if (isAdmin) {
				_displayAnnouncementSection();
			}
			
			parentElem = document.getElementById("Conventions");
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
				
				tournaments = tournaments.concat(convention.tournaments);
			}
			
			displayStandings(tournaments, document.getElementById("Standings"));
			
			parentElem = document.getElementById("Admins");
			var admins = [];
			for (let i = 0; i < conventionSeries.admins.length; i++) {
				const admin = conventionSeries.admins[i];
				admins.push(admin.user.userName);
			}
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
			<h1 id='h1'>Loading...</h1>
			<div id='Info'></div> <!-- TODO -->
			<div id='Conventions'>
				<h2>Conventions</h2>
			</div>
			<div id='Announcement'></div> <!-- TODO -->
			<div id='DisplayConventionSeries'>
				<div id='Standings'>
					<h2>Standings</h2>
				</div>
				<div id='Admins'>
					<h2>Admins</h2>
				</div>
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
								/*"Admin.conventionID": {
									"userID": {}
								}	*/
							},
							"Admin.conventionSeriesID": {
								"userID": {}
							}
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