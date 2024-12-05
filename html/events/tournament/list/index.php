<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Tournament</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		.tournamentGroup {
			display: inline-block;
			width: 200px;
			margin-left: 10px;
			margin-right: 10px;
			vertical-align: top;
		}
		
		.tournament {
			/*border: 1px solid black;*/
			/*border-bottom: 1px solid black;*/
			padding: 5px;
			margin-top: 5px;
			margin-bottom: 5px;
		}
		
		.tournament:not(:last-child) {
			border-bottom: 1px solid black;
		}
		
		.tournament a {
			text-decoration: none;
			color: initial;
		}
		
		#CreateLink {
			display: inline-block;
			padding: 5px;
			padding-left: 10px;
			padding-right: 10px;
			margin: 10px;
			margin-top: 20px;
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
	
	<script src="/connect/socket.io/socket.io.js"></script>
	
	<script>
		
		function createSpectatorSocket() {
			socket = io.connect("/", {path: "/connect/socket.io"});

			socket.on('serverResponse1', function(objStr) {
				console.log(objStr);
				var jsonObj = JSON.parse(objStr);
				console.log(jsonObj);
			});
			
		}
		
		createSpectatorSocket();
		
		function _searchPastTournaments(refThis) {
			const searchText = refThis.value.toLowerCase();
			var parentDiv = document.getElementById("searchPastTournamentsDiv");
			parentDiv.innerHTML = "";
			
			if (searchText.length > 0) {
				for (let i = 0; i < Tournament.list.length; i++) {
					const tournament = Tournament.list[i];
					if (tournament.convention != null) {
						continue;
					}
					if (tournament.endDate < today) {
						if (tournament.name.toLowerCase().includes(searchText) || 
								dateToString(createDate(tournament.startTime)).includes(searchText) || 
								tournament.endDate.includes(searchText) || 
								_searchSeasons(tournament, searchText)) {
							displayTournament(tournament, "searchPastTournamentsDiv", pastOptions);
						}
					}
				}				
			}
		}
		
		function _searchSeasons(tournament, searchText) {
			for (let i = 0; i < tournament.seasons.length; i++) {
				const season = tournament.seasons[i];
				if (season.name.toLowerCase().includes(searchText) || 
						season.league.name.toLowerCase().includes(searchText)) {
					return true;
				}
			}
			return false;
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(EventsNav); ?>
	
	<div id='pageContent'>
		<article>	
			<div>
				<a id='CreateLink' href='/events/tournament/create'>Create New Tournament</a>
			</div>
		
			<div class='tournamentGroup'>
				<h2>Current</h2>
				<div id='currentTournaments'></div>
			</div>
			
			<div class='tournamentGroup'>
				<h2>Upcoming</h2>
				<div id='upcomingTournaments'></div>
			</div>
			
			<div class='tournamentGroup'>
				<h2>Past Month</h2>
				<div id='pastTournaments'></div>
				<!--<a href='/events/tournament/list/past'>All Past Tournaments</a>-->
				<h2>Search Past</h2>
				<input type='text' id='pastTournamentSearchBar' oninput='_searchPastTournaments(this)' />
				<div id='searchPastTournamentsDiv'></div>				
			</div>
			
			<script>
				//const today = dateToString(new Date());
				const today = datetimeToString(new Date());
				var oneMonthBefore = new Date();
				if (oneMonthBefore.getMonth() == 0) {
					oneMonthBefore.setMonth(11);
					oneMonthBefore.setYear(oneMonthBefore.getFullYear()-1);
				} else {
					oneMonthBefore.setMonth(oneMonthBefore.getMonth()-1);
				}
				oneMonthBefore = datetimeToString(oneMonthBefore);
				
				const currentOptions = [];
				const upcomingOptions = ["showDate"];
				const pastOptions = ["showDate"];
				
				// Current Tournaments
				TournamentOverviewView.load(
					{startBefore: today,
						endAfter: today.substr(0, today.indexOf(' ')),
						Tournament_conventionID: null},
					function (viewRows) {
						var tournaments = DatabaseObject.extractView(TournamentOverviewView.list, HeroscapeTournament);
						for (let i = 0; i < tournaments.length; i++) {
							if ((tournaments[i].started || tournaments[i].startTime < today) && 
									( ! tournaments[i].finished || tournaments[i].endDate > today)) {
								displayTournament(tournaments[i], "currentTournaments", currentOptions);
							}
						}
					},
					{joins: {}}
				);
				/*HeroscapeTournament.load(
					{startBefore: today,
						endAfter: today.substr(0, today.indexOf(' ')),
						convention: null}, 
					function (tournaments) {		
						for (var i = 0; i < tournaments.length; i++) {
							displayTournament(tournaments[i], "currentTournaments", currentOptions);
						}
					}, 
					{joins: {
						"conventionID": {
							"conventionSeriesID": {}
						},
						"TournamentSeasonLink.tournamentID": {
							"seasonID": {
								"leagueID": {}
							}
						}
					}}
				);*/
				
				// Upcoming Tournaments
				TournamentOverviewView.load(
					{startAfter: today,
						Tournament_conventionID: null},
					function (viewRows) {
						var tournaments = DatabaseObject.extractView(TournamentOverviewView.list, HeroscapeTournament);
						for (let i = 0; i < tournaments.length; i++) {
							if ( ! tournaments[i].started && tournaments[i].startTime > today) {
								displayTournament(tournaments[i], "upcomingTournaments", upcomingOptions);
							}
						}
					},
					{joins: {}}
				);
				/*HeroscapeTournament.load(
					{startAfter: today,
						convention: null}, 
					function (tournaments) {	
						for (var i = 0; i < tournaments.length; i++) {
							displayTournament(tournaments[i], "upcomingTournaments", upcomingOptions);
						}
					}, 
					{joins: {
						"conventionID": {
							"conventionSeriesID": {}
						},
						"TournamentSeasonLink.tournamentID": {
							"seasonID": {
								"leagueID": {}
							}
						}
					}}
				);*/
				
				// Past Tournaments
				TournamentOverviewView.load(
					{endBefore: today,
						Tournament_conventionID: null}, // TODO : This isn't working ... 
					function (viewRows) {
						var tournaments = DatabaseObject.extractView(TournamentOverviewView.list, HeroscapeTournament);
						tournaments = tournaments.reverse();
						for (let i = 0; i < tournaments.length; i++) {
							if (tournaments[i].finished && tournaments[i].startTime >= oneMonthBefore) {
								displayTournament(tournaments[i], "pastTournaments", pastOptions);
							} 
						}
					},
					{joins: {}}
				);
					
				/*HeroscapeTournament.load(
					{endBefore: today,
						convention: null},
					function (tournaments) {		
						tournaments = tournaments.reverse();					
						for (var i = 0; i < tournaments.length; i++) {
							if (tournaments[i].startTime >= oneMonthBefore) {
								displayTournament(tournaments[i], "pastTournaments", pastOptions);
							} else {
								//console.log(tournaments[i].name);
							}
						}
					}, 
					{joins: {
						"TournamentSeasonLink.tournamentID": {
							"seasonID": {
								"leagueID": {}
							}
						}
					}}
				);*/
			</script>
			
			
		</article>
	</div>

	<?php include(Footer); ?>

</div></body>
</html>