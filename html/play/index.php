<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Play Heroscape</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/dice.css">
	<style>
		article {
			position: relative;
		}
	
		#GameBoxes {
			position: absolute;
			float: right;
			top: 0;
			right: 0;
		}
		
		.gameBox {
			border: 1px solid black;
			border-radius: 10px;
			
			padding-left: 10px;
			padding-right: 10px;
			
			margin-top: 10px;
		}
		
		
		#WoundDiv {
			/*display: inline-block;*/
			
		}
		.figureWoundDiv {
			text-align: right;
		}
		.figureWoundName {
			
		}
		.figureWoundInput {
			width: 30px !important;
			margin-left: 10px;
			margin-right: 10px;
		}
		.figureWoundTotal {
			
		}
		
		#OrderMarkerDiv {
			float: right;
			clear: both
		}
		
		
		#DiceDiv {
			float: right;
			clear: both
		}
		.diceSummary {
			display: inline-block;
			vertical-align: top;
			padding-top: 3px;
		}
		.dice {
			display: inline-block;
			border: 1px solid black;
			border-radius: 5px;
			width: 20px;
			height: 20px;
			margin: 5px;
		}

		.figureFacing1 { /* Strait up - 270 deg */ 
			
		}
		
		.figureFacing2 { /* Up/Right - 315 deg */ 
			-webkit-transform: rotate(60deg);
			-moz-transform: rotate(60deg);
			-o-transform: rotate(60deg);
			-ms-transform: rotate(60deg);
			transform: rotate(60deg);
		}
		
		.figureFacing3 { /* Down/Right - 45 deg */ 
			transform-origin: 0 0;
			transform: rotate(45deg);
		}
		
		.figureFacing4 { /* Strait down - 90 deg */ 
			
		}
		
		.figureFacing5 { /* Down/Left - 135 deg */ 
			
		}
		
		.figureFacing6 { /* Up/Left - 225 deg */ 
			
		}

	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/hexagon.js"></script>
	<!--<script src="/connect/socket.io/socket.io.js"></script>-->
		
	<script>
		socket = null;
		function createSocket() {
			if (socket != null) {
				return;
			}
			
			socket = io.connect("/", {path: "/connect/socket.io"});
			
			/*socket.emit("loadTournament", JSON.stringify({
				tournament: {
					id: currentTournament.id,
					name: currentTournament.name,
					numArmies: currentTournament.numArmies}}), function (err, responseData) {
						if (err) {
							alert("There was an unknown error connecting to the tournament. Try refreshing the page.");
						}*/
			
		}
		
		function rollDice() {
			const numAttackDice = document.getElementById('AttackDiceInput').value;
			const numDefenseDice = document.getElementById('DefenseDiceInput').value;
			
			var attackDice = [];
			for (let i = 0; i < numAttackDice; i++) {
				attackDice.push(_rollHeroscapeDice());
			}
			
			var defenseDice = [];
			for (let i = 0; i < numDefenseDice; i++) {
				defenseDice.push(_rollHeroscapeDice());
			}
			
			var parentElem = document.getElementById("DiceResultDiv");
			parentElem.innerHTML = "";
			
			var attackResultDiv = createDiv({});
			parentElem.appendChild(attackResultDiv);
			var numAttackSkulls = 0;
			for (let i = 0; i < attackDice.length; i++) {
				if (attackDice[i] == DiceOutcome.Skull) {
					numAttackSkulls++;
				}
			}
			attackResultDiv.appendChild(createSpan({
				class: "diceSummary",
				innerHTML: numAttackSkulls + "/" + numAttackDice + " Skulls"}));
			for (let i = 0; i < attackDice.length; i++) {
				var diceSpan = createSpan({class: "dice"});
				attackResultDiv.appendChild(diceSpan);
				if (attackDice[i] == DiceOutcome.Skull) {
					diceSpan.classList.add("skull");
				} else if (attackDice[i] == DiceOutcome.Shield) {
					diceSpan.classList.add("shield");
				} else if (attackDice[i] == DiceOutcome.Blank) {
					diceSpan.classList.add("blank");
				}
			}
			
			var defenseResultDiv = createDiv({});
			parentElem.appendChild(defenseResultDiv);
			var numDefenseShields = 0;
			for (let i = 0; i < defenseDice.length; i++) {
				if (defenseDice[i] == DiceOutcome.Shield) {
					numDefenseShields++;
				}
			}
			defenseResultDiv.appendChild(createSpan({
				class: "diceSummary",
				innerHTML: numDefenseShields + "/" + numDefenseDice + " Shields"}));
			for (let i = 0; i < defenseDice.length; i++) {
				var diceSpan = createSpan({class: "dice"});
				defenseResultDiv.appendChild(diceSpan);
				if (defenseDice[i] == DiceOutcome.Skull) {
					diceSpan.classList.add("skull");
				} else if (defenseDice[i] == DiceOutcome.Shield) {
					diceSpan.classList.add("shield");
				} else if (defenseDice[i] == DiceOutcome.Blank) {
					diceSpan.classList.add("blank");
				}
			}
			
			parentElem.appendChild(createDiv({
				innerHTML: Math.max(0, numAttackSkulls-numDefenseShields) + " Wounds"
			}));			
		}
		
		function rollD20Dice() {
			const d20 = _rollD20();
			
			
		}
		
		const DiceOutcome = {
			Skull: "Skull",
			Shield: "Shield",
			Blank: "Blank"
		};
		function _rollHeroscapeDice() {
			const d6 = _rollD6();
			if (d6 == 1 || d6 == 2 || d6 == 3) {
				return DiceOutcome.Skull;
			} else if (d6 == 4 || d6 == 5) {
				return DiceOutcome.Shield;
			} else if (d6 == 6) {
				return DiceOutcome.Blank;
			}
			return null;
		}
		
		function _rollD6() {
			return Math.floor(Math.random() * 6) + 1;
		}
		
		function _rollD20() {
			return Math.floor(Math.random() * 20) + 1;
		}
		
		/*var $die = $('.die'),
			sides = 20,
			initialSide = 1,
			lastFace,
			timeoutId,
			transitionDuration = 500;
		function rollTo(face) {
			$('ul > li > a').removeClass('active');
			$('[href=' + face + ']').addClass('active');
			$die.attr('data-face', face);
		}*/
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
	
		
		<article>	
			<h1>Play Heroscape</h1>
			
			<!--<canvas id='HexCanvas' width='1000' height='725'></canvas>-->
			<svg id='SvgHexGrid' width='1000' height='725'>
				<g id='svgTileGrid'></g>
				<g id='svgGlyphGrid'></g>
				<g id='svgFigureGrid'></g>
			</svg>
			
			<div id='GameBoxes'>
			
				<div id='WoundDiv' class='gameBox'>
					<h2>Wounds</h2>
				</div>
				
				<div id='OrderMarkerDiv' class='gameBox'>
					<h2>Order Markers</h2>
					<!-- TODO --> 
				</div>
				
				<div id='DiceDiv' class='gameBox'>
					<h2>Dice</h2>
					<div id='AttackDiceDiv'>
						<label>
							Attack
							<input id='AttackDiceInput' type='number' min=0 step=1 />
						</label>
					</div>
					<div id='DefenseDiceDiv'>
						<label>
							Defense
							<input id='DefenseDiceInput' type='number' min=0 step=1 />
						</label>
					</div>
					<button onclick='rollDice()'>Roll</button>
					<button onclick='rollD20Dice()'>Roll d20</button>
					<!--<div class="die">
						<figure class="face face-1"></figure>
						<figure class="face face-2"></figure>
						<figure class="face face-3"></figure>
						<figure class="face face-4"></figure>
						<figure class="face face-5"></figure>
						<figure class="face face-6"></figure>
						<figure class="face face-7"></figure>
						<figure class="face face-8"></figure>
						<figure class="face face-9"></figure>
						<figure class="face face-10"></figure>
						<figure class="face face-11"></figure>
						<figure class="face face-12"></figure>
						<figure class="face face-13"></figure>
						<figure class="face face-14"></figure>
						<figure class="face face-15"></figure>
						<figure class="face face-16"></figure>
						<figure class="face face-17"></figure>
						<figure class="face face-18"></figure>
						<figure class="face face-19"></figure>
						<figure class="face face-20"></figure>
					</div>-->
					<div id='DiceResultDiv'></div>
				</div>
			
			</div>
				
			<script>
				/*const highwaysAndDiewaysData = {
					name: "Highways And Dieways",
					tiles: {
						0: [
							{row: 1, height: 1, type: grass},
							{row: 2, height: 1, type: grass},
							{row: 3, height: 1, type: grass},
							{row: 4, height: 1, type: grass},
							{row: 5, height: 1, type: grass},
							{row: 6, height: 1, type: grass},
						],
						1: [
							{row: 0, height: 1, type: grass},
							{row: 1, height: 1, type: grass},
							{row: 2, height: 1, type: grass},
							{row: 3, height: 1, type: grass},
							{row: 4, height: 2, type: grass},
							{row: 5, height: 1, type: grass},
							{row: 6, height: 0, type: water},
							{row: 7, height: 2, type: road},
							{row: 8, height: 1, type: grass}
						],
						2: [
							{row: 1, height: 1, type: grass},
							{row: 2, height: 1, type: grass},
							{row: 3, height: 1, type: grass},
							{row: 4, height: 1, type: grass},
							{row: 5, height: 2, type: road},
							{row: 6, height: 0, type: water},
							{row: 7, height: 1, type: grass},
							{row: 8, height: 2, type: road},
							{row: 9, height: 1, type: grass}
						],
						3: [
							{row: 1, height: 1, type: grass},
							{row: 2, height: 1, type: grass},
							{row: 3, height: 1, type: grass},
							{row: 4, height: 0, type: water},
							{row: 5, height: 2, type: road},
							{row: 6, height: 0, type: water},
							{row: 7, height: 12, type: tree},
							{row: 8, height: 2, type: road},
							{row: 9, height: 1, type: grass},
							{row: 10, height: 3, type: grass}
						],
						4: [
							{row: 1, height: 1, type: grass},
							{row: 2, height: 1, type: grass},
							{row: 3, height: 1, type: grass},
							{row: 4, height: 0, type: water},
							{row: 5, height: 3, type: grass},
							{row: 6, height: 2, type: road},
							{row: 7, height: 0, type: water},
							{row: 8, height: 0, type: water},
							{row: 9, height: 2, type: road},
							{row: 10, height: 3, type: grass},
							{row: 11, height: 3, type: grass}
						],
						5: [
							{row: 1, height: 1, type: grass},
							{row: 2, height: 1, type: grass},
							{row: 3, height: 0, type: water},
							{row: 4, height: 3, type: grass},
							{row: 5, height: 2, type: road},
							{row: 6, height: 2, type: road},
							{row: 7, height: 2, type: road},
							{row: 8, height: 2, type: road},
							{row: 9, height: 2, type: road},
							{row: 10, height: 2, type: road},
							{row: 11, height: 2, type: road}
						],
						6: [
							{row: 3, height: 0, type: water},
							{row: 4, height: 2, type: road},
							{row: 5, height: 2, type: road},
							{row: 6, height: 13, type: tree},
							{row: 7, height: 3, type: grass},
							{row: 8, height: 15, type: tree},
							{row: 9, height: 2, type: road},
							{row: 10, height: 1, type: grass},
							{row: 11, height: 1, type: grass},
							{row: 12, height: 2, type: road}
						],
						7: [
							{row: 3, height: 2, type: road},
							{row: 4, height: 3, type: grass},
							{row: 5, height: 2, type: road},
							{row: 6, height: 3, type: grass},
							{row: 7, height: 3, type: grass},
							{row: 8, height: 3, type: grass},
							{row: 9, height: 2, type: road},
							
							{row: 11, height: 1, type: grass},
							{row: 12, height: 2, type: road}
						],
						8: [
							{row: 3, height: 1, type: grass},
							{row: 4, height: 2, type: road},
							{row: 5, height: 3, type: grass},
							{row: 6, height: 2, type: road},
							{row: 7, height: 3, type: grass},
							{row: 8, height: 14, type: tree},
							{row: 9, height: 2, type: road},
							
							
							{row: 12, height: 2, type: road},
							{row: 13, height: 1, type: grass}
						],
						9: [
							{row: 3, height: 0, type: water},
							{row: 4, height: 2, type: road},
							
							{row: 6, height: 2, type: road},
							{row: 7, height: 2, type: road},
							{row: 8, height: 2, type: road},
							{row: 9, height: 2, type: road},
							
							{row: 11, height: 2, type: road},
							{row: 12, height: 0, type: water}
						],
						10: [
							{row: 3, height: 1, type: grass},
							{row: 4, height: 2, type: road},
							
							
							{row: 7, height: 2, type: road},
							{row: 8, height: 14, type: tree},
							{row: 9, height: 3, type: grass},
							{row: 10, height: 2, type: road},
							{row: 11, height: 3, type: grass},
							{row: 12, height: 2, type: road},
							{row: 13, height: 1, type: grass}
						],
						11: [
							{row: 3, height: 2, type: road},
							{row: 4, height: 1, type: grass},
							
							{row: 6, height: 2, type: road},
							{row: 7, height: 3, type: grass},
							{row: 8, height: 3, type: grass},
							{row: 9, height: 3, type: grass},
							{row: 10, height: 2, type: road},
							{row: 11, height: 3, type: grass},
							{row: 12, height: 2, type: road}
						],
						12: [
							{row: 4, height: 2, type: road},
							{row: 5, height: 1, type: grass},
							{row: 6, height: 1, type: grass},
							{row: 7, height: 2, type: road},
							{row: 8, height: 15, type: tree},
							{row: 9, height: 3, type: grass},
							{row: 10, height: 14, type: tree},
							{row: 11, height: 2, type: road},
							{row: 12, height: 2, type: road},
							{row: 13, height: 0, type: water}
						],
						13: [
							{row: 4, height: 2, type: road},
							{row: 5, height: 2, type: road},
							{row: 6, height: 2, type: road},
							{row: 7, height: 2, type: road},
							{row: 8, height: 2, type: road},
							{row: 9, height: 2, type: road},
							{row: 10, height: 2, type: road},
							{row: 11, height: 3, type: grass},
							{row: 12, height: 0, type: water},
							{row: 13, height: 1, type: grass},
							{row: 14, height: 1, type: grass}
						],
						14: [
							{row: 5, height: 3, type: grass},
							{row: 6, height: 3, type: grass},
							{row: 7, height: 2, type: road},
							{row: 8, height: 0, type: water},
							{row: 9, height: 0, type: water},
							{row: 10, height: 2, type: road},
							{row: 11, height: 3, type: grass},
							{row: 12, height: 0, type: water},
							{row: 13, height: 1, type: grass},
							{row: 14, height: 1, type: grass},
							{row: 15, height: 1, type: grass}
						],
						15: [
							{row: 5, height: 3, type: grass},
							{row: 6, height: 1, type: grass},
							{row: 7, height: 2, type: road},
							{row: 8, height: 13, type: tree},
							{row: 9, height: 0, type: water},
							{row: 10, height: 2, type: road},
							{row: 11, height: 0, type: water},
							{row: 12, height: 1, type: grass},
							{row: 13, height: 1, type: grass},
							{row: 14, height: 1, type: grass}
						],
						16: [
							{row: 7, height: 1, type: grass},
							{row: 8, height: 2, type: road},
							{row: 9, height: 1, type: grass},
							{row: 10, height: 0, type: water},
							{row: 11, height: 2, type: road},
							{row: 12, height: 1, type: grass},
							{row: 13, height: 1, type: grass},
							{row: 14, height: 1, type: grass},
							{row: 15, height: 1, type: grass}
						],
						17: [
							{row: 7, height: 1, type: grass},
							{row: 8, height: 2, type: road},
							{row: 9, height: 0, type: water},
							{row: 10, height: 1, type: grass},
							{row: 11, height: 2, type: grass},
							{row: 12, height: 1, type: grass},
							{row: 13, height: 1, type: grass},
							{row: 14, height: 1, type: grass},
							{row: 15, height: 1, type: grass}
						],
						18: [
							{row: 10, height: 1, type: grass},
							{row: 11, height: 1, type: grass},
							{row: 12, height: 1, type: grass},
							{row: 13, height: 1, type: grass},
							{row: 14, height: 1, type: grass},
							{row: 15, height: 1, type: grass}
						],
					}
				};
				
				const glyphs = [
					{glyph: valda, col: 11, row: 4},
					{glyph: wannok, col: 7, row: 11}
				];
				
				var players = [
					{name: "Player 1",
					army: [
						{unit: SirDenrick, col: 1, row: 2},
						{unit: SirDupuis, col: 1, row: 3}
					]},
					{name: "Player 2",
					army: [
						{unit: Arkmer, col: 6, row: 4},
						{unit: Sonlen, col: 8, row: 6}
					]}
				];
				
				var highwaysAndDieways = new Map(highwaysAndDiewaysData, glyphs, players);*/
				
				var game = null;// = new HsGame(highwaysAndDieways, players);
				
				HeroscapeCard.load(
					{}, // TODO - load only 1 FigureSet? Or all? 
					function (allCards) {
						// TODO 
					},
					{joins: {
						"Figure.cardID": {},
						"HeroscapeCardPower.cardID": {}
					}}
				);
				
				
				hsGame = null;
				
				const gameID = findGetParameter("id");
				if (gameID !== undefined && gameID !== null) {
					OnlineGame.load(
						{id: gameID},
						function (games) {
							if (games.length == 1) {
								game = games[0];
								hsGame = new HsGame(game);
								
								// TODO 
								
							} else {
								// TODO - Error Handling
							}
						},
						{joins: {
							"mapID": {},
							"OnlineGamePlayer.gameID": {
								"OnlineGamePlayerFigure.playerID": {
									"figureID": {
										"cardID": {
											"HeroscapeCardPower.cardID": {}
										}
									}
								}
							},
							"OnlineGameRound.gameID": {
								"OnlineGameOrderMarkers.roundID": {
									"playerID": {},
									"initiativeID": {},
									"om1CardID": {},
									"om2CardID": {},
									"om3CardID": {},
									"omXCardID": {},
									"om1GameStateID": {
										"DiceRoll.gameStateID": {},
										"OnlineGameStateFigure.gameStateID": {
											"figureID": {}
										},
										"OnlineGameAttack.gameStateID": {
											"attackingFigureID": {},
											"defendingFigureID": {},
											"attackRollID": {},
											"defenseRollID": {}
										}
									},
									"om2GameStateID": {
										"DiceRoll.gameStateID": {},
										"OnlineGameStateFigure.gameStateID": {
											"figureID": {}
										},
										"OnlineGameAttack.gameStateID": {
											"attackingFigureID": {},
											"defendingFigureID": {},
											"attackRollID": {},
											"defenseRollID": {}
										}
									},
									"om3GameStateID": {
										"DiceRoll.gameStateID": {},
										"OnlineGameStateFigure.gameStateID": {
											"figureID": {}
										},
										"OnlineGameAttack.gameStateID": {
											"attackingFigureID": {},
											"defendingFigureID": {},
											"attackRollID": {},
											"defenseRollID": {}
										}
									}
								}
							},
							"OnlineGameState.gameID": {
								"OnlineGameStateFigure.gameStateID": {
									"figureID": {}
								}
							},
							"GlyphLocation.onlineGameID": {
								"glyphID": {}
							}
					}});
				}
			</script>
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>