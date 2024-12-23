<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>

	<title>Heroscape.org Software</title>
	
	<!-- CSS -->
	<!--<link rel="stylesheet" type="text/css" href="/css/TODO.css">-->
	<style>
		#SearchDiv label {
			margin-left: 20px;
			margin-right: 20px;
		}
		
		#SearchDiv button {
			display: block;
			margin: auto;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	
		.figureSpan {
			display: block;
		}
		
		p {
			text-align: left;
		}
		ul {
			text-align: left;
		}
	</style>
	
	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	
	<script>
		const today = datetimeToString(new Date());
		
		function loadFigures() {
			displayFigureData();
		}
		
		function displayFigureData() {
			var figures = {};
			
			const startDate = document.getElementById('startDateInput').value;
			const endDate = document.getElementById('endDateInput').value;
			
			
			for (let i = 0; i < Tournament.list.length; i++) {
				const tournament = Tournament.list[i];
				
				if (tournament.endDate > endDate) {
					continue;
				}
				if (tournament.startTime < startDate) {
					continue;
				}
				
				for (let j = 0; j < tournament.players.length; j++) {
					const player = tournament.players[j];
					for (let k = 0; k < player.playerArmys.length; k++) {
						const playerArmy = player.playerArmys[k];
						
						for (let l = 0; l < playerArmy.playerArmyCards.length; l++) {
							const playerArmyCard = playerArmy.playerArmyCards[l];
							
							if (figures[playerArmyCard.card.name] === undefined) {
								figures[playerArmyCard.card.name] = 0;
							}
							figures[playerArmyCard.card.name] += 1;
						}
						
						/*if (playerArmy.toDisplayString() != null) { 
							const armyFigs = playerArmy.toDisplayString().split(",");
							for (let l = 0; l < armyFigs.length; l++) {
								var fig = armyFigs[l];
								fig = fig.trim();
								
								var match = fig.match(/(.*) x[0-9]+$/);
								if (match !== null) {
									fig = match[1];
								}

								
								if (figures[fig] === undefined) {
									figures[fig] = 0;
								}
								figures[fig] += 1;
							}
						}*/
					}
				}
			}
			
			var figures2 = [];
			for (const [key, value] of Object.entries(figures)) {
				figures2.push({name: key, quantity: value});
			}
			figures2.sort(function(x, y) {
				if (x.quantity < y.quantity) {
					return 1;
				}
				if (x.quantity > y.quantity) {
					return -1;
				}
				return 0;
			});
			
			var parentDiv = document.getElementById('ResultsDiv');
			parentDiv.innerHTML = "";
			for (let i = 0; i < figures2.length; i++) {
				const fig = figures2[i];
				
				if (fig.quantity == 1) {
					break;
				}
				
				parentDiv.appendChild(createSpan({
					class: "figureSpan",
					innerHTML: fig.quantity + " : " + fig.name
				}));
			}
		}
	</script>
</head>
<body><div id='content'>

	<?php include(Nav); ?>
	<?php include(DataNav); ?>
	
	<div id='pageContent'>
		<h1>Delta Figure Usage Data</h1>
		<article>
			<p>Notes:</p>
			<ul>
				<li>Tournaments that have not started are excluded</li>
				<li>Tournaments where you bring > 1 army are excluded</li>
				<li>Multiplayer tournaments are excluded</li>
				<li>Temporary user's armies are excluded</li>
				<li>Figures used only once in the given time frame are skipped</li>
			</ul>
			<div id='SearchDiv'>
				<label>
					Start Date: 
					<input id='startDateInput' type='date' value='2022-07-01' />
				</label>
				
				<label>
					End Date:
					<input id='endDateInput' type='date' />
				</label>
				<script>
					document.getElementById('endDateInput').valueAsDate = new Date();
				</script>
				
				<button type='button' onclick='loadFigures()'>
					Search
				</button>
			</div>	
		
			<div id='ResultsDiv'></div>

			<script>
				Card.load(
					{},
					function (cards) {
						
					},
					{joins: {
						"figureSetID": {}
					}}
				);
				FigureUsageView.load(
					{Tournament_started: true,
						HeroscapeTournament_useDeltaPricing: true,
						Tournament_maxNumPlayersPerGame: 2,
						Tournament_figureSetID: 1,
						HeroscapeTournament_numArmies: 1},
					function (viewEntries) {
						console.log(viewEntries);
						DatabaseObject.extractView(FigureUsageView.list);						
						displayFigureData();
					},
					{joins: {}}
				);
				/*HeroscapeTournament.load(
					{startBefore: today,
						useDeltaPricing: 1},
					function (tournaments) {
						displayFigureData();
					},
					{joins: {
						"Player.tournamentID": {
							"PlayerArmy.playerID": {
								/*"PlayerArmyCard.playerArmyID": {
									"cardID": {}
								}*
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