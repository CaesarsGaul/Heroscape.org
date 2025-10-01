<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>League</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/standings.css">
	<link rel="stylesheet" href="/css/announcement.css">
	<style>
		#Leagues {
			margin-top: 10px;
			border-bottom: 1px solid black;
		}
		
		.leagueLink {
			display: inline-block;
			margin-left: 10px;
			margin-right: 10px;
			margin-top: 0;
			margin-bottom: 10px;
			border: 1px solid black;
			border-radius: 10px;
			padding-top: 5px;
			padding-bottom: 5px;
			padding-left: 10px;
			padding-right: 10px;
		}
		
		.leagueLink a {
			text-decoration: none;
			color: inehrit;
		}
		
		/*.leagueLink a:visited {
			color: inherit;
		}*/
		
		
	
		#League p ul {
			text-align: left;
			margin: auto;
			width: fit-content;
		}
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
		Season.options.fieldsToInclude = ["name", "start", "end"];
		Season.options.linksToInclude = [];
		
		socket = null;
		function createSocket() {
			if (socket != null) {
				return;
			}
			
			socket = io.connect("/", {path: "/connect/socket.io"});
			
			socket.on("announcementError", function(objStr) {
				alert("There was an unknown error sending the announcement.");
			});
		}
		createSocket();
	
		function displayLeague(league) {
			socket.emit("loadLeague", JSON.stringify({league: {
				id: league.id,
				name: league.name
			}}));
			
			document.getElementById("h1").innerHTML = league.name;									
			
			var parentElem = document.getElementById("League");
			//parentElem.innerHTML = "";
			
			if (league.description != null) {
				parentElem.appendChild(createP({innerHTML: league.description}));
			}
			
			var tournaments = [];
			if (league.seasons.length > 0) {
				parentElem.appendChild(createH2({
					innerHTML: "Seasons"
				}));
			}
			for (let i = 0; i < league.seasons.length; i++) {
				const season = league.seasons[i];
				
				Array.prototype.push.apply(tournaments, season.tournaments);
				
				var seasonDiv = createDiv({class: "seasonDiv"});
				parentElem.appendChild(seasonDiv);
				seasonDiv.appendChild(createA({
					href: "/events/league/season/?Season="+season.id, 
					innerHTML: season.name.trim().length == 0 ? "Season" : season.name}));
			}
			
			parentElem.appendChild(createH2({innerHTML: "League Standings"}));
			
			displayStandings(tournaments, parentElem);
			
			parentElem.appendChild(createH2({innerHTML: "League Admins"}));
			
			const userName = loggedIn()
				? decodeURIComponent(getCookieValue("hs_username"))
				: null;
			var isAdmin = false;
			for (let i = 0; i < league.admins.length; i++) {
				const adminUserName = league.admins[i].user.userName;
				parentElem.appendChild(createP({
					innerHTML: adminUserName
					}));
				if (userName !== null && userName == adminUserName) {
					isAdmin = true;
				}
			}
			
			if (isAdmin) {
				Season.createAddSection(
					"CreateSeason", 
					{implicitClasses: {
						league: league
					}});	
				_displayAnnouncementSection();
			}
			
			
		}
		
		var league;
		function displayLeagues(leagues) {
			var parentElem = document.getElementById("Leagues");
			
			for (let i = 0; i < leagues.length; i++) {
				const l = leagues[i];
				
				var leagueDiv = createDiv({
					class: "leagueLink hasBorder"
				});
				parentElem.appendChild(leagueDiv);
				
				leagueDiv.appendChild(createA({
					href: "/events/league/?League="+l.id,
					innerHTML: l.name
				}));
			}
		}
		
		function _emitAnnouncement(announcement) {
			socket.emit("leagueAnnouncement",
				JSON.stringify({
					league: {
						id: league.id,
						name: league.name
					},
					announcement: announcement
				})
			);
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(EventsNav); ?>
	
	<div id='pageContent'>	
		<h1>Leagues</h1>
		<div id='Leagues'></div>
		<article>	
			<h1 id='h1'></h1>
			<div id='League'></div>
			<div id='Announcement'></div>
			<div id='CreateSeason'></div>
			
			<script>		
				const leagueID = findGetParameter("League");
				if (leagueID != null) {
					document.getElementById("h1").innerHTML = "Loading..."
					League.load(
						{id: leagueID},
						function (leagues) {
							/*League.displayDropdownPreloaded(
								"Leagues",
								function (selectElem) {
									var parentElem = document.getElementById("League");
									parentElem.innerHTML = "";
									
									var league = $(selectElem.options[selectElem.selectedIndex])
										.data("databaseObject");
									if (league !== undefined && league !== null) {
										displayLeague(league);
									}
								},
								null,
								null,
								{includeLabel: false});*/
							league = leagues[0];
							displayLeague(leagues[0]);
						},
						{joins: {
							"Season.leagueID": {
								"TournamentSeasonLink.seasonID": {
									"tournamentID": {
										"Player.tournamentID": {
											"userID": {},
											"HeroscapeGamePlayer.playerID": {
												"gameID": {
													
												}
											}
										}
									}
								}
							},
							"Admin.leagueID": {
								"userID": {}
							}
					}});
				} else {
					
				}
				
				League.load(
					{},
					function(leagues) {
						displayLeagues(leagues);
					},
					{joins: {
						
					}}
				);
			</script>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>