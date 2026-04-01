<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>

	<title>Data | Player Rankings</title>
	
	<!-- CSS -->
	<!--<link rel="stylesheet" type="text/css" href="/css/TODO.css">-->
	<link rel="stylesheet" type="text/css" href="/css/sortableTable.js">
	<style>
		#StandingsTable {
			margin: auto;
		}
		
		#StandingsTable th {
			padding-left: 15px;
			padding-right: 15px;
		}
		
		#StandingsTable td {
			max-width: 200px;
		}
		
		#StandingsTable td a {
			text-decoration: none;
			color: inherit;
		}
	</style>
	
	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	<script src='/js/elo.js/elo.js'></script>
	<script src='/js/sortableTable.js'></script>
	<script>
		const today = datetimeToString(new Date());
		
		function displayStandings(users) {
			var table = document.getElementById("StandingsTable");
			
			_sortableTableData = {};
			
			var headers = ["User", "ELO", "TTT CSE", "W", "L", "Win %"];
			var data = [];
			
			var playerCount = 1;
			for (let i = 0; i < users.length; i++) {
				const user = users[i];
				
				// Some users have requested to be excluded from the list 
				if (user.id == 137) { // Matthias
					continue;
				}
				
				var name = "<a href='https://heroscape.org/user?userName="+user.userName+"' target='_blank'>"+user.userName+"</a>";
				data.push([name, user.elo, user.tttCSE, user.W, user.L, user.WinPercent]);
				
				playerCount++;
				
				if (playerCount > 100) {
					break;
				}
			}
			
			createSortableTable("StandingsTable", headers, data);
		}
		
	</script>
</head>
<body><div id='content'>

	<?php include(Nav); ?>
	<?php include(DataNav); ?>

	<div id='pageContent'>
		<h1>Player Rankings</h1>
		<article>
			<div id='Standings'>
				<table id='StandingsTable'>
					<tr>
						<th></th>
						<th>User</th>
						<th>ELO</th>
						<th>W</th>
						<th>L</th>
						<th>Win %</th>
					<tr>
				</table>
			</div>

			<script>
				StandingsView.load(
					{},
					function (users) {
						displayStandings(users);
					},
					{joins: {}}
				);
			</script>
				
			
			
		</article>
	</div>
	
	<?php include(Footer); ?>
</div></body>
</html>