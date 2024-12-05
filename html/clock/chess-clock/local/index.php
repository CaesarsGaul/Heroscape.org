<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Chess-Clock | Local</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		#MinutesDiv, #SecondsDiv {
			display: inline-block;
			margin: 10px;
		}
		
		#StartButton {
			font-size: 20px;
			padding: 10px;
			padding-left: 20px;
			padding-right: 20px;
			margin-top: 50px;
		}
		
		#PostStartDiv {
			font-size: 40px;
		}
		
		.playerClockDiv {
			width: fit-content;
			margin: auto;
			margin-top: 20px;
			margin-bottom: 20px;
			padding-left: 40px;
			padding-right: 40px;
			padding-top: 20px;
			padding-bottom: 20px;
			border: 1px solid black;
			border-radius: 10px;
		}
		
		.playerName {
			padding: 10px;
		}
		
		.playerTime {
			padding: 10px;
		}
		
		.playerClockImg {
			width: 50px;
			vertical-align: middle;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	
		
	<script>
		class ClockPlayer {
			// name, playerNumber, clock
			
			constructor(playerNum, name=null) {
				this.clock = new Clock();
				this.playerNumber = playerNum;
				this.name = name != null
					? name
					: "Player " + playerNum;
			}
		}
		class Clock {
			// secondsRemaining
			
			constructor() {
				
			}
		}
		
		var players = [];
		var clockRunningPlayerNum = null;
		var timeInterval = null;
		
		function _addPlayer() {
			var parentDiv = document.getElementById("PlayersListDiv");
			const playerNum = players.length > 0
				? players.length
				: 1;
			var player = new ClockPlayer(playerNum);
			players[playerNum] = player;
			
			var playerDiv = createDiv({id: "Player_" + playerNum + "_Div"});
			parentDiv.appendChild(playerDiv);
			
			playerDiv.appendChild(createInput({
				id: "Player_" + playerNum + "_NameInput",
				type: "text",
				onchange: "_setPlayerName("+playerNum+",this)",
				value: player.name
			}));
			
			playerDiv.appendChild(createButton({
				innerHTML: "Delete",
				onclick: "_deletePlayer("+playerNum+")"
			}));
		}
		
		function _setPlayerName(playerNum, inputElem) {
			players[playerNum].name = inputElem.value;
		}
		
		function _deletePlayer(playerNum) {
			var parentDiv = document.getElementById("PlayersListDiv");
			var childDiv = document.getElementById("Player_"+playerNum+"_Div");
			parentDiv.removeChild(childDiv);
			players[playerNum] = null;
		}
		
		function _start() {
			document.getElementById("PreStartDiv").style.display = "none";
			
			var parentElem = document.getElementById("PostStartDiv");
			
			const secondsAvailable = parseInt(document.getElementById("Minutes").value) * 60 
				+ parseInt(document.getElementById("Seconds").value);
			
			for (let i = 0; i < players.length; i++) {
				const player = players[i];
				if (player != null) {
					player.clock.secondsRemaining = secondsAvailable;
				}
			}
			
			_displayClocks();
		}
		
		function _startPlayerClock(playerNum) {
			if (timeInterval != null) {
				clearInterval(timeInterval);
				timeInterval = null;
			}
			clockRunningPlayerNum = playerNum;
			timeInterval = setInterval(function() {
				_reduceClock(playerNum);
			}, 1 * 1000);
			_displayClocks();
		}
		
		function _reduceClock(playerNum) {
			players[playerNum].clock.secondsRemaining -= 1;
			if (players[playerNum].clock.secondsRemaining == 0) {
				clearInterval(timeInterval);
				timeInterval = null;
				clockRunningPlayerNum = null;
			}
			_displayClocks();
		}
		
		function _displayClocks() {
			var parentElem = document.getElementById("PostStartDiv");
			parentElem.innerHTML = "";
			
			for (let i = 0; i < players.length; i++) {
				const player = players[i];
				if (player != null) {
					var playerDiv = createDiv({
						id: "Player_" + player.playerNumber + "_ClockDiv",
						class: "playerClockDiv",
						onclick: "_startPlayerClock("+player.playerNumber+")"
					});
					parentElem.appendChild(playerDiv);
					
					playerDiv.appendChild(createSpan({
						innerHTML: player.name,
						class: "playerName"
					}));
					const minutes = Math.floor(player.clock.secondsRemaining / 60);
					var seconds = player.clock.secondsRemaining % 60;
					if (seconds < 10) {
						seconds = "0" + seconds;
					}
					playerDiv.appendChild(createSpan({
						id: "Player_"+player.playerNumber+"_TimeRemaining",
						class: "playerTime",
						innerHTML: minutes + ":" + seconds
					}));
					playerDiv.appendChild(createImg({
						class: "playerClockImg",
						src: player.playerNumber == clockRunningPlayerNum
							? "/images/clock_start.png"
							: "/images/clock_stop.png"
					}));
					
				}
			}
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1>Chess-Clock (Local)</h1>
			<div id='PreStartDiv'>
				<div id='TimeDiv'>
					<h2>Starting Time</h2>
					<div id='MinutesDiv'>
						<input type='number' id='Minutes' min=0 step=1 value='5'/>
						Minutes
					</div>
					<div id='SecondsDiv'>
						<input type='number' id='Seconds' min=0 max=59 step=1 value='0'/>
						Seconds
					</div>
				</div>
				<div id='Players'>
					<h2>Players</h2>
					<div id='PlayersListDiv'></div>
					<button onclick='_addPlayer()'>Add Player</button>
					<script>
						_addPlayer();
						_addPlayer();
					</script>
				</div>
				<button id='StartButton' onclick='_start()'>Start</button>
			</div>
			<div id='PostStartDiv'>
				
				
				
			</div>
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>