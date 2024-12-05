<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Clock</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		.toggleLabel {
			display: block;
			/*text-decoration: underline;*/
			margin-bottom: 5px;
		}
		
		#CountDownDiv, #RemoteDiv, #ChessDiv {
			display: none;
		}
	
	
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
	
	<script src="/connect/socket.io/socket.io.js"></script>
		
	<script>
		clockId = null;
		clock = null;
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
			
			socket.on('setPlayerClock', (objStr) => {
				const player = JSON.parse(objStr).player;
				const timeInSeconds = JSON.parse(objStr).timeInSeconds;
				players[player.playerNumber].timeInSeconds = timeInSeconds;
				clockRunningPlayerNum = player.playerNumber;				
				_displayClocks();
			});
			
			socket.on('startClock', (objStr) => {
				const player = JSON.parse(objStr).player;
				clockRunningPlayerNum = player.playerNumber;	
				_displayClocks();
			});
			
			socket.on('stopClock', (objStr) => {
				clockRunningPlayerNum = null;				
				_displayClocks();
			});
		}
		
		function loadRemoteClock() {
			socket.emit("loadClock", JSON.stringify({clock: {id: clockId}}));
			Clock.load(
				{id: clockId},
				function(clocks) {
					clock = clocks[0];
					chess = clock.chess;
					local = false;
					countDown = clock.countDown;
					socket.emit("loadClock", JSON.stringify({
						clock: {
							id: clock.id
						}
					}));
					
					players = clock.playerClocks;
					for (let i = 0; i < players.length; i++) {
						players[i].playerNumber = i;
						players[i].countDown = clock.countDown;
						players[i].chess = clock.chess;
					}
					_displayClocks();
			},
			{joins: {
				"PlayerClock.clockID": {}
			}});
			
			document.getElementById("PreStartDiv").innerHTML = "";
		}
	
		class ClockPlayer {
			// name, playerNumber, clock
			
			constructor(playerNum, name=null) {
				this.timeInSeconds = null;
				this.countDown = null;
				this.playerNumber = playerNum;
				this.name = name != null
					? name
					: "Player " + playerNum;
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
			const secondsAvailable = parseInt(document.getElementById("Minutes").value) * 60 
				+ parseInt(document.getElementById("Seconds").value);
			
			for (let i = 0; i < players.length; i++) {
				const player = players[i];
				if (player != null) {
					if (countDown) {
						player.timeInSeconds = secondsAvailable;
						player.countDown = true;
					} else {
						player.timeInSeconds = 0;
						player.countDown = false;
					}
					
				}
			}
			
			if ( ! local) {				
				var clock = new Clock();
				clock.chess = chess;
				clock.countDown = countDown;
				clock.playerClocks = [];
				for (let i = 0; i < players.length; i++) {
					if (players[i] !== undefined && players[i] !== null) {
						clock.playerClocks.push(new PlayerClock({
							name: players[i].name,
							timeInSeconds: players[i].timeInSeconds
						}));
					}
				}
				clock._serverCreate({}, function(newClockObj) {
					window.location.href = "https://heroscape.org/clock?id="+newClockObj.id;
				});				
				return;
			}
			
			document.getElementById("PreStartDiv").style.display = "none";
			
			//var parentElem = document.getElementById("PostStartDiv");
			_displayClocks();
		}
		
		function _togglePlayerClock(playerNum) {
			if (clockRunningPlayerNum == playerNum && chess) {
				return; // Do Nothing
			}
			
			if (local) {
				if (timeInterval != null) {
					clearInterval(timeInterval);
					timeInterval = null;
				}
			}
				
			if (clockRunningPlayerNum != playerNum) {
				clockRunningPlayerNum = playerNum;
				if (local) {
					timeInterval = setInterval(function() {
						_updateClock(playerNum);
					}, 1 * 1000);
				} else {
					socket.emit("startPlayerClock", JSON.stringify({
						clock: decycle(clock),
						player: decycle(players[playerNum])
					}));
				}
			} else {
				clockRunningPlayerNum = null;
				if ( ! local) {
					socket.emit("stopPlayerClock", JSON.stringify({
						clock: decycle(clock)
					}));
				}
			}
			
			_displayClocks();
		}
		
		function _updateClock(playerNum) {
			if (players[playerNum].countDown) {
				players[playerNum].timeInSeconds -= 1;
				if (players[playerNum].timeInSeconds == 0) {
					clearInterval(timeInterval);
					timeInterval = null;
					clockRunningPlayerNum = null;
				}
			} else {
				players[playerNum].timeInSeconds += 1;
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
						onclick: "_togglePlayerClock("+player.playerNumber+")"
					});
					parentElem.appendChild(playerDiv);
					
					playerDiv.appendChild(createSpan({
						innerHTML: player.name,
						class: "playerName"
					}));
					
					minutes = Math.floor(player.timeInSeconds / 60);
					seconds = player.timeInSeconds % 60;
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
		
		// Toggles
		var countDown = false;
		function switchCountUpDown(refThis) {
			countDown = refThis.checked;
			if (countDown) {
				document.getElementById("countUpToggle").classList.remove("toggleSwitchSelected");
				document.getElementById("countDownToggle").classList.add("toggleSwitchSelected");
				document.getElementById("CountDownDiv").style.display = "block";
				document.getElementById("CountUpDiv").style.display = "none";
			} else {
				document.getElementById("countUpToggle").classList.add("toggleSwitchSelected");
				document.getElementById("countDownToggle").classList.remove("toggleSwitchSelected");
				document.getElementById("CountDownDiv").style.display = "none";
				document.getElementById("CountUpDiv").style.display = "block";
			}
			//updateURL();
		}
		var local = true;
		function switchLocal(refThis) {
			local = ! refThis.checked;
			if (! local) {
				document.getElementById("localToggle").classList.remove("toggleSwitchSelected");
				document.getElementById("remoteToggle").classList.add("toggleSwitchSelected");
				document.getElementById("LocalDiv").style.display = "none";
				document.getElementById("RemoteDiv").style.display = "block";
			} else {
				document.getElementById("localToggle").classList.add("toggleSwitchSelected");
				document.getElementById("remoteToggle").classList.remove("toggleSwitchSelected");
				document.getElementById("LocalDiv").style.display = "block";
				document.getElementById("RemoteDiv").style.display = "none";
			}
			//updateURL();
		}
		var chess = false;
		function switchChess(refThis) {
			chess = refThis.checked;
			if (chess) {
				document.getElementById("standardToggle").classList.remove("toggleSwitchSelected");
				document.getElementById("chessToggle").classList.add("toggleSwitchSelected");
				document.getElementById("StandardDiv").style.display = "none";
				document.getElementById("ChessDiv").style.display = "block";
			} else {
				document.getElementById("standardToggle").classList.add("toggleSwitchSelected");
				document.getElementById("chessToggle").classList.remove("toggleSwitchSelected");
				document.getElementById("StandardDiv").style.display = "block";
				document.getElementById("ChessDiv").style.display = "none";
			}
			//updateURL();
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1>Game Clock</h1>
			
			<div id='PreStartDiv'>
			
				<div id='PreStartOptionsDiv'>
					<span class='toggleSwitch'><!-- Count Up / Count Down -->
						<span class='toggleLabel'>Count Direction</span>
						<span id='countUpToggle' class='toggleSwitchString toggleSwitchSelected'>Up</span>
						<label class="switch"> 
							<input id='countUpDownCheckbox' type="checkbox" onchange="switchCountUpDown(this)" >
							<span class="slider round"></span>
						</label>
						<span id='countDownToggle' class='toggleSwitchString'>Down</span>
					</span>
					<span class='toggleSwitch'><!-- Local / Remote -->
						<span class='toggleLabel'>TBD</span>
						<span id='localToggle' class='toggleSwitchString toggleSwitchSelected'>Local</span>
						<label class="switch"> 
							<input id='localCheckbox' type="checkbox" onchange="switchLocal(this)" >
							<span class="slider round"></span>
						</label>
						<span id='remoteToggle' class='toggleSwitchString'>Remote</span>
					</span>
					<span class='toggleSwitch'><!-- Standard / Chess -->
						<span class='toggleLabel'>Chess-Clock</span>
						<span id='standardToggle' class='toggleSwitchString toggleSwitchSelected'>No</span>
						<label class="switch"> 
							<input id='countUpDownCheckbox' type="checkbox" onchange="switchChess(this)" >
							<span class="slider round"></span>
						</label>
						<span id='chessToggle' class='toggleSwitchString'>Yes</span>
					</span>
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
			
				<div id='CountUpDiv'>
					
				</div>
				<div id='CountDownDiv'>
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
			
				<div id='LocalDiv'>
				
				</div>
				<div id='RemoteDiv'>
				
				</div>
			
				<div id='StandardDiv'>
				
				</div>
				<div id='ChessDiv'>
				
				</div>
			
				<button id='StartButton' onclick='_start()'>Start</button>
			</div>
			
			
			
			<div id='PostStartDiv'>
				
				
				
			</div>
			
			<script>
				clockId = findGetParameter('id');
				if (clockId != null) {	
					createSocket();
					loadRemoteClock();
				}
			</script>
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>