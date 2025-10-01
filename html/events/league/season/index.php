<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Season</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/standings.css">
	<link rel="stylesheet" href="/css/announcement.css">
	<style>
		#TournamentDiv {
			text-align: left;
		}
		
		#TournamentDiv h2 {
			text-align: center;
		}
		
		#TournamentDiv a {
			color: inherit;
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
		
		function displayDate(date) {
			var parts = date.split("-");
			return parts[1] + "/" + parseInt(parts[2]) + "/" + parts[0].substr(2);
		}
	
		function displaySeason(season) {
			socket.emit("loadSeason", JSON.stringify({season: {
				id: season.id,
				name: season.name,
				league: {
					id: season.league.id,
					name: season.league.name
				}
			}}));
			
			document.getElementById("h1").innerHTML = season.name;
			
			var parentElem = document.getElementById("Season");
			
			parentElem.appendChild(createP({
				innerHTML: displayDate(season.start) + " - " + displayDate(season.end)}));
			
			if (season.description != null) {
				parentElem.appendChild(createP({innerHTML: season.description}));
			}
			
			var tournamentDiv = createDiv({id: "TournamentDiv"});
			parentElem.appendChild(tournamentDiv);
			tournamentDiv.appendChild(createH2({innerHTML: "Tournaments"}));
			for (let i = 0; i < season.tournaments.length; i++) {
				const tournament = season.tournaments[i];
				
				var tourneyDiv = createDiv({});
				tournamentDiv.appendChild(tourneyDiv);
				tourneyDiv.appendChild(createA({
					href: "https://heroscape.org/events/tournament/?Tournament="+tournament.id,
					innerHTML: tournament.name,
					target: "_blank"
				}));				
			}
		
			parentElem.appendChild(createH2({innerHTML: "Season Standings"}));
			
			displayStandings(season.tournaments, parentElem);
			
			const userName = loggedIn()
				? decodeURIComponent(getCookieValue("hs_username"))
				: null;
			var isAdmin = false;
			for (let i = 0; i < season.league.admins.length; i++) {
				const adminUserName = season.league.admins[i].user.userName;
				parentElem.appendChild(createP({
					innerHTML: adminUserName
					}));
				if (userName !== null && userName == adminUserName) {
					isAdmin = true;
				}
			}
			
			if (isAdmin) {
				_displayAnnouncementSection();
			}
		}
		
		var season;
		
		function _emitAnnouncement(announcement) {
			socket.emit("seasonAnnouncement",
				JSON.stringify({
					season: {
						id: season.id,
						name: season.name,
						league: {
							id: season.league.id,
							name: season.league.name
						}
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
		<h1 id='h1'>Loading...</h1>
		<article>	
			<!--<div id='Seasons'></div>-->
			<div id='Season'></div>
			<div id='Announcement'></div>
			
			<script>	
				const seasonID = findGetParameter("Season");
				if (seasonID != null) {
					Season.load(
						{id: seasonID},
						function (seasons) {
							/*Season.displayDropdownPreloaded(
								"Seasons",
								function (selectElem) {
									var parentElem = document.getElementById("Season");
									parentElem.innerHTML = "";
									
									var season = $(selectElem.options[selectElem.selectedIndex])
										.data("databaseObject");
									if (season !== undefined && season !== null) {
										displaySeason(season);
									}
								},
								null,
								null,
								{includeLabel: false});*/
							season = seasons[0];
							displaySeason(seasons[0]);
						},
						{joins: {
							"leagueID": {
								"Admin.leagueID": {
									"userID": {}
								}
							},
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
					}});
				}
			</script>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>