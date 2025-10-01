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
		
		//var players = {};
		
		/*function calculateElo() {
			for (let i = 0; i < User.list.length; i++) {
				players[User.list[i].id] = {
					user: User.list[i],
					elo: 1600
				};
			}
			
			for (let i = 0; i < Tournament.list.length; i++) {
				const tournament = Tournament.list[i];
				
				for (let j = 0; j < tournament.rounds.length; j++) {
					const round = tournament.rounds[j];
					
					for (let k = 0; k < round.games.length; k++) {
						const game = round.games[k];
						if (game.heroscapeGamePlayers.length == 2) {
							const gamePlayer1 = game.heroscapeGamePlayers[0];
							const gamePlayer2 = game.heroscapeGamePlayers[1];
							
							if (gamePlayer1.player.user != null &&
									gamePlayer2.player.user != null) {
								const user1 = gamePlayer1.player.user;
								const user2 = gamePlayer2.player.user;
								
								const user1Elo = players[user1.id].elo;
								const user2Elo = players[user2.id].elo;
								
								
								
								players[user1.id].elo = Elo.getNewRating(user1Elo, user2Elo, gamePlayer1.result / 2.0);
								players[user2.id].elo = Elo.getNewRating(user2Elo, user1Elo, gamePlayer2.result / 2.0);
								
							}
						}
												
						// Elo.getNewRating(1600, 1700, 1)     // => 1620
						// Elo.getNewRating(1600, 1700, 0.5)   // => 1604
						// Elo.getNewRating(1600, 1700, 0)     // => 1588
						
					}
				}
			}
		}*/
		
		/*function displayElo() {
			var players2 = [];
			for (const [key, value] of Object.entries(players)) {
				players2.push(value);
			}
			players2.sort(function(x, y) {
				if (x.elo < y.elo) {
					return 1;
				}
				if (x.elo > y.elo) {
					return -1;
				}
				return 0;
			});
			
			var parentDiv = document.getElementById("ResultsDiv");
			parentDiv.innerHTML = "";
			var resultsTable = createTable({});
			parentDiv.appendChild(resultsTable);
			var th = createTr({});
			resultsTable.appendChild(th);
			th.appendChild(createTh({innerHTML: "User"}));
			th.appendChild(createTh({innerHTML: "ELO"}));
			th.appendChild(createTh({innerHTML: "W"}));
			th.appendChild(createTh({innerHTML: "L"}));
			th.appendChild(createTh({innerHTML: "T"}));
			for (let i = 0; i < players2.length; i++) {
				const player = players2[i];
				const user = player.user;
				const elo = player.elo;
				
				var tr = createTr({});
				resultsTable.appendChild(tr);
				tr.appendChild(createTd({innerHTML: user.userName}));
				tr.appendChild(createTd({innerHTML: elo}));
				tr.appendChild(createTd({innerHTML: user.wins()}));
				tr.appendChild(createTd({innerHTML: user.losses()}));
				tr.appendChild(createTd({innerHTML: user.ties()}));
				
				/*parentDiv.appendChild(createSpan({
					class: "playerSpan",
					innerHTML: user.userName + " : ELO = " + elo
				}));
				*/
			/*}
		}*/
		
		function displayStandings(users) {
			var table = document.getElementById("StandingsTable");
			
			_sortableTableData = {};
			
			var headers = ["User", "ELO", "W", "L", "Win %"];
			var data = [];
			
			var playerCount = 1;
			for (let i = 0; i < users.length; i++) {
				const user = users[i];
				
				// Some users have requested to be excluded from the list 
				if (user.id == 137) { // Matthias
					continue;
				}
				
				var name = "<a href='https://heroscape.org/user?userName="+user.userName+"' target='_blank'>"+user.userName+"</a>";
				data.push([name, user.elo, user.W, user.L, user.WinPercent]);
				
				/*var tr = createTr({});
				table.appendChild(tr);
				
				tr.appendChild(createTd({innerHTML: playerCount}));
				
				var userTd = createTd({});
				userTd.appendChild(createA({
					href: "https://heroscape.org/user?userName="+user.userName,
					target: "_blank",
					innerHTML: user.userName}
				));
				tr.appendChild(userTd);
				
				
				tr.appendChild(createTd({innerHTML: user.elo}));
				tr.appendChild(createTd({innerHTML: user.W}));
				tr.appendChild(createTd({innerHTML: user.L}));
				tr.appendChild(createTd({innerHTML: user.WinPercent}));*/
				
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