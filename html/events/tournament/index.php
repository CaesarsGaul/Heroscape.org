<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Tournament</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/announcement.css">
	<link rel="stylesheet" href="/css/tournament.css">
	<!--<link rel="stylesheet" href="/css/standings.css">-->

	<style>
		h1 {
			font-size: 30px;
		}
		
		#ShowGameData {
			display: none;
		}
		
		#roundTimerDiv {
			font-size: 50px;
		}
	
		.gameWinner {
			background-color: yellow;
		}
		.gameTie {
			background: repeating-linear-gradient(45deg, yellow, white 33.3%);
		}
		
		#CurrentRound .reportFormDiv {
			display: none;
		}
		
		.reportFormDiv button {
			display: block;
			margin: auto;
		}
		
		.PartialPointsDiv {
			display: none;
		}
		
		.inlineBlockDiv {
			display: inline-block;
			margin-left: 20px;
			margin-right: 20px;
		}
		
		.adminColumnDiv {
			display: inline-block;
			width: 45%;
			max-width: 400px;
			min-width: min(95%, 300px);
			vertical-align: top;
			margin-left: 10px;
			margin-right: 10px;
		}
		
		.adminActionDiv {
			width: 100%;
			min-height: 100px;
		}
		
		.adminActionDiv label {
			display: block;
			/*text-align: left;*/
		}
		
		#Standings table {
			margin: auto;
		}
		
		#Standings table tr th,
		#Standings table tr td {
			text-align: left;
			padding-right: 10px;
		}
		
		.adminActionButton {
			padding: 5px;
			padding-left: 10px;
			padding-right: 10px;
		}
		
		.signupButton {
			display: block;
			margin: auto;
			margin-top: 5px;
			margin-bottom: 5px;
		}
		@media (max-width:800px)  { 
			.signupButton {
				padding-top: 15px;
				padding-bottom: 15px;
				padding-left: 15px;
				padding-right: 15px;
			}
		}


		
		#hideFullMatchupButton {
			display: none;
			margin: auto;
		}
		
		#showFullMatchupButton {
			margin: auto;
			display: block;
		}
		
		#hideEditableMatchupButton {
			display: none;
			margin: auto;
		}
		
		#showEditableMatchupButton {
			margin: auto;
			display: block;
		}
		
		#fullStandingsGameDiv {
			display: none;
			text-align: left;
		}
		
		#matchupsDiv {
			display: inline-block;
			text-align: left;
		}
		
		#matchupsDiv table, #matchupsDiv th, #matchupsDiv td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		
		#matchupsDiv th, #matchupsDiv td {
			padding: 5px;
		}
		
		.matchupArmysDiv {
			/*margin-left: 40px;*/
		}
		
		.matchupArmyDiv {
			/*margin-left: 40px;*/
		}
		
		#publishRoundButton {
			display: block;
			margin: auto;
			margin-bottom: 10px;
		}
		
		.gameRematch {
			background-color: #F75D59;
		}
		
		#GameData {
			text-align: left;
		}
		
		.bracket {
			/*text-align: left;*/
			display: flex;
			flex-direction: row;
		}
		
		.bracketRound {
			display: flex;
			flex-direction: column;
			justify-content: center;
			width: 150px;
			list-style: none;
			padding: 0;
		}
		
		/*.bracketRound .spacer {
			flex-grow: 1;
		}
		
		.bracketRound .spacer:first-child, .round .spacer:last-child{ 
			flex-grow:.5; 
		}

		.bracketRound .game-spacer{
			flex-grow:1;
		}*/
		
		.bracketGame {
			border: 1px solid black;
			border-radius: 5px;
			display: block; /* TODO - change this to get one round left of the next */
			/*width: 150px;*/
			margin: 5px;
			padding: 5px;
			text-align: left;
		}
		
		.bracketPlayer {
			
		}
		
		#EditTournament {
			display: none;
		}
		
		.mapImageDiv {
			display: inline-block;
			max-width: 300px;
			vertical-align: top;
		}
		
		.mapImageDiv img {
			max-width: 100%;
			max-height: 170px;
		}
		
		.mapImageDiv {
			padding: 5px;
			margin: 5px;
			background-color: #ddeced;
			border-radius: 10px;
			width: 200px;
			height: 230px;
			position: relative;
		}
		
		.mapImageDiv button {
			position: absolute;
			bottom: 5px;
		}
		
		.mapImageDivBroughtByMeButton {
			right: 5px;
		}
		
		.mapImageDivUnclaimedButton {
			left: 40px;
			right: 40px;
		}
		
		.broughtByMe {
			border: 1px solid red;
		}
		
		.mapImageDiv p {
			position: absolute;
			bottom: 10px;
			width: calc(100% - 10px);
			margin: 0;
		}
		
		.mapLinkFinished {
			/*color: inherit;*/
			text-decoration: none;
		}
		
		.teamCaptain {
			color: red;
			padding-left: 5px;
		}
		
		.droppedPlayer {
			color: #A9A9A9;
		}
		
		.teamCaptainRow {
			margin-top: 10px;
		}
		
		.notTeamCaptain {
			padding-left: 15px;
		}
		
		.streamingMapLabel {
			background-color: yellow;
			color: red;
			display: inline-block;
			width: 30px;
			text-align: center;
			border: 1px solid black;
			margin-right: 5px;
			font-weight: bold;
			border-radius: 10px;
		}
		
		.rankColumn {
			min-width: 35px;
			padding-right: 0 !important;
		}
		
		.broughtByP {
			background-color: inherit;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	<script src='/js/stats.js'></script>
	<!--<script src='/js/standings.js'></script>-->
	<script src='/js/announcement.js'></script>
	<script src='/js/tournament.js'></script>
	<script src="/connect/socket.io/socket.io.js"></script>
	
	<script type='text/javascript'>
		GameMap.options.fieldsToInclude = ["name", "number", "active", "forStreaming", "altOhsGdocId"];
		GameMap.options.linksToInclude = ["gameMapGlyphs"];
		GameMap.options.labelsToIgnore = ["name"];
		
		GameMapGlyph.options.fieldsToInclude = ["glyph"];
		GameMapGlyph.options.linksToInclude = [];
		GameMapGlyph.options.labelsToIgnore = ["glyph"];
		
		Tournament.options.fieldsToInclude = ["name", "description", "startTime", "address",
			"endDate", "allowSignupAfter", "allowArmySubmissionAfter", "allowLateSignup", "online", 
			"maxEntries", "numLossesToBeEliminated", "pairAfterEliminated", "roundLengthMinutes"];
		HeroscapeTournament.options.fieldsToInclude = ["pointLimit", "hexLimit", "figureLimit", "useDeltaPricing", "includeVC", "includeMarvel", "uniquesOnly", "commonsOnly", "heroesOnly", "squadsOnly", "banList", "restrictedList"];
		Tournament.options.labelsToIgnore = ["name"];
		Tournament.options.linksToInclude = ["tournamentFormatTags"];
		
		TournamentFormatTag.options.fieldsToInclude = ["format", "data"];
		TournamentFormatTag.options.multiLevelEditsToSkip = ["create"];
		
		GameMapGlyph.options.multiLevelEditsToSkip = ["create"];
		
		Glyph.load(
			{},
			function (glyphs) {
				// Intentionally blank
			},
			{joins: {
				
		}});
		
		TournamentFormat.load(
			{},
			function (formats) {
				// Intentionally blank
			},
			{joins: {
				
		}});
		
		var isAdmin = false;
		var currentTournament = null;
		var currentRound = null;
		
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
						}
					});*/
					
			socket.on("connect", function(objStr) {
				console.log("Connect event fired");
				console.log(objStr);
				socket.emit("loadTournament", JSON.stringify({
					tournament: {
						id: currentTournament.id,
						name: currentTournament.name,
						numArmies: currentTournament.numArmies}}), function (err, responseData) {
							if (err) {
								alert("There was an unknown error connecting to the tournament. Try refreshing the page.");
							}
						});
			});
			
			socket.on('signedUp', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				var player = new Player(jsonObj.player);
				displayTournament();
			});
			
			socket.on('cannotSignup', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				alert(jsonObj.msg);
			});
			
			socket.on('announcementError', function(objStr) {
				alert("There was an error making the announcement.");
			});
			
			socket.on('withdrawn', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				var player = new Player(jsonObj.player);
				
				for (let i = 0; i < currentTournament.players.length; i++) {
					if (currentTournament.players[i].id == player.id) {
						currentTournament.players.splice(i, 1);
					}
				}
				
				displayTournament();
			});

			socket.on('loadAdmin', function(objStr) {
				isAdmin = true;
				if (currentTournament.rounds.length > 0) {
					displayCurrentRound();
				}
				if ( ! currentTournament.finished) {
					refreshAdmin();
				}
				displayTournament();
			});
			
			socket.on('gameResult', function(objStr) {
				var game = JSON.parse(objStr).game;
				for (let i = 0; i < Game.list.length; i++) {
					if (Game.list[i].id == game.id) {
						for (let j = 0; j < Game.list[i].heroscapeGamePlayers.length; j++) {
							for (let k = 0; k < game.heroscapeGamePlayers.length; k++) {
								if (Game.list[i].heroscapeGamePlayers[j].id == game.heroscapeGamePlayers[k].id) {
									Game.list[i].heroscapeGamePlayers[j].result = game.heroscapeGamePlayers[k].result;
								}
							}
						}
					}
				}
				displayCurrentRound();
				_displayStandings();
				checkRoundCompleted();
				refreshAdmin();
			});
			
			socket.on('gameReportingError', function(objStr) {
				alert("There was an unknown error reporting the result of the game. " +
					"Tell Chris Perkins its probably the Peoria bug. " + 
					"Refresh the page and try submitting again.");
			});
			
			socket.on('notEnoughMaps', function(objStr) {
				alert("There are not enough maps entered.");
			});
			
			socket.on('playerMissingArmy', function(objStr) {
				var playerName = JSON.parse(objStr).userName;
				alert(playerName + " has not submitted their army(s) yet.");
			});
			
			socket.on('roundCreationError', function(objStr) {
				alert("Unknown error creating the round.");
			});
			
			socket.on('cancelCurrentRound', function(objStr) {
				currentTournament.rounds.splice(currentTournament.rounds.length-1, 1);
				currentRound = null;
				displayCurrentRound();
				_displayStandings();
				refreshAdmin();
			});
			
			socket.on('roundCancelError', function(objStr) {
				alert("Unknown error cancelling the round.");
			});
			
			socket.on('markPlayerInactiveError', function(objStr) {
				alert("Unknown error marking the player inactive.");
			});
			
			socket.on('markPlayerActiveError', function(objStr) {
				alert("Unknown error un-dropping the player.");
			});
			
			socket.on('publishRoundError', function(objStr) {
				alert("Unknown error publishing the round.");
			});
			
			socket.on('nextRoundPaired', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				var round = new Round(jsonObj.round);
				if (currentTournament.bracket != null) {
					currentTournament.bracket = Bracket.get({id: currentTournament.bracket.id});
				}
				currentRound = round;
				refreshAdmin();
				displayCurrentRound();
			});
			
			socket.on('gamePaired', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				var game = null;
				if (HeroscapeGame.exists(jsonObj.game)) {
					for (let i = 0; i < HeroscapeGame.list.length; i++) {
						if (HeroscapeGame.list[i].id == jsonObj.game.id) {
							game = HeroscapeGame.list[i];
							if (jsonObj.game.heroscapeGamePlayers.length == 1) {
								game.heroscapeGamePlayers[0].result = 
								jsonObj.game.heroscapeGamePlayers[0].result;
							}
							break;
						}
					}
				} else {
					game = new HeroscapeGame(jsonObj.game);
				}
				displayCurrentRound();
				_displayStandings();
			});
			
			socket.on('changeGameError', function(objStr) {
				alert("Unknown error changing the game.");
			});
			
			socket.on('gameChanged', function(objStr) {
				if ( ! isAdmin) {
					return;
				}
				var jsonObj = JSON.parse(objStr);
				var jsonGame = jsonObj.game;
				var game = Game.get({id: jsonGame.id});
				
				// Set Map 
				var map = null;
				if (jsonGame.map != null) {
					map = GameMap.get({id: jsonGame.map.id});
				}
				game.map = map;
				
				// Set Players
				for (let i = 0; i < game.heroscapeGamePlayers.length; i++) {
					game.heroscapeGamePlayers[i].game = null;
				}
				game.heroscapeGamePlayers = [];
				for (let i = 0; i < jsonGame.heroscapeGamePlayers.length; i++) {
					var gamePlayer = null;
					for (let j = 0; j < HeroscapeGamePlayer.list.length; j++) {
						if (HeroscapeGamePlayer.list[j].id == jsonGame.heroscapeGamePlayers[i].id) {
							gamePlayer = HeroscapeGamePlayer.list[j];
							break;
						}
					}
					if (gamePlayer != null) {
						gamePlayer.game = game;
						game.heroscapeGamePlayers.push(gamePlayer);
					}
				}
				
				// Update View
				displayCurrentRound();
			});
			
			socket.on('setRoundClock', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				const secondsLeft = jsonObj.secondsLeft;
				const minutes = Math.floor(secondsLeft / 60);
				var seconds = secondsLeft % 60;
				seconds = seconds < 10 ? "0"+seconds : seconds;
				var timerDiv = document.getElementById("roundTimerDiv");
				if (timerDiv != null) {
					timerDiv.innerHTML = "";
					timerDiv.appendChild(createP({innerHTML: "Time Left in Round : " + minutes + ":" + seconds}));		
					if (secondsLeft == 0) {
						timerDiv.appendChild(createP({innerHTML: "ROUND OVER!"}));
					} /*else if (minutes < 2) {
						timerDiv.appendChild(createP({innerHTML: "LAST ORDER MARKER!"}));
					}*/ /*else if (minutes < 10) {
						timerDiv.appendChild(createP({innerHTML: "LAST ROUND!"}));
					}*/
				}
			});
			
			socket.on('playerInactive', function(objStr) {
				var tempPlayer = JSON.parse(objStr).player;
				for (let i = 0; i < Player.list.length; i++) {
					if (Player.list[i].id == tempPlayer.id) {
						Player.list[i].active = 0;
						break;
					}
				}
				_displayStandings();
			});
			
			socket.on('playerActive', function(objStr) {
				var tempPlayer = JSON.parse(objStr).player;
				for (let i = 0; i < Player.list.length; i++) {
					if (Player.list[i].id == tempPlayer.id) {
						Player.list[i].active = 1;
						break;
					}
				}
				_displayStandings();
			});
			
			socket.on('playerDropped', function(objStr) {
				var tempPlayer = JSON.parse(objStr).player;
				for (let i = 0; i < currentTournament.players.length; i++) {
					if (currentTournament.players[i].id == tempPlayer.id) {
						currentTournament.players.splice(i, 1);
						break;
					}
				}
				_displayStandings();
			});
			
			socket.on('roundPublished', function(objStr) {
				currentRound.started = true;
				displayCurrentRound();
			});
			
			socket.on('createNonUserPlayerError', function(objStr) {
				alert("Unknown error creating new player.");
			});
			
			socket.on('nonUserPlayerCreated', function(objStr) {
				var playerJSON = JSON.parse(objStr).player;
				var player = new Player(playerJSON);
				player.tournament = currentTournament;
				currentTournament.players.push(player);
				_clearNewPlayer(false);
				_displayStandings();
			});
			
			socket.on('bracketCreated', function(objStr) {
				var bracket = new Bracket(JSON.parse(objStr).bracket);
				currentTournament.bracket = bracket;				
				displayBracket();
			});
			
			socket.on('bracketCreationError', function(objStr) {
				alert("Unknown error creating bracket.");
			});
			
			socket.on('mapClaimed', function(objStr) {
				var obj = JSON.parse(objStr);
				const user = obj.user;
				const gameMap = obj.gameMap;
				var map = null;
				for (let i = 0; i < GameMap.list.length; i++) {
					if (GameMap.list[i].id == gameMap.id) {
						map = GameMap.list[i];
						break;
					}
				}
				if (map != null) {
					map.broughtByUser = user;
				}
				displayMapImages();
			});
			
			socket.on('mapUnClaimed', function(objStr) {
				var obj = JSON.parse(objStr);
				const gameMap = obj.gameMap;
				var map = null;
				for (let i = 0; i < GameMap.list.length; i++) {
					if (GameMap.list[i].id == gameMap.id) {
						map = GameMap.list[i];
						break;
					}
				}
				if (map != null) {
					map.broughtByUser = null;
				}
				displayMapImages();
			});
			
			socket.on('startTournamentError', function(objStr) {
				alert("Unknown error starting the tournament");
			});
			
			socket.on('finishTournamentError', function(objStr) {
				alert("Unknown error finishing the tournament");
			});
			
			socket.on('restartTournamentError', function(objStr) {
				alert("Unknown error re-starting the tournament");
			});
			
			socket.on('tournamentStarted', function(objStr) {
				currentTournament.started = true;
				displayTournament();
			});
			
			socket.on('tournamentFinished', function(objStr) {
				currentTournament.finished = true;
				displayTournament();
			});
			
			socket.on('tournamentRestarted', function(objStr) {
				currentTournament.finished = false;
				document.getElementById('GameData').innerHTML = "";
				refreshAdmin();
				displayTournament();
			});
		}
		
		function checkRoundCompleted() {
			var roundIdx = currentTournament.rounds.length - 1;
			var roundFinished = true;
			for (let i = 0; i < currentTournament.rounds[roundIdx].games.length; i++) {
				const game = currentTournament.rounds[roundIdx].games[i];
				for (let j = 0; j < game.heroscapeGamePlayers.length; j++) {
					if (game.heroscapeGamePlayers[j].result == null) {
						roundFinished = false;
						break;
					}
				}
				if ( ! roundFinished) {
					break;
				}
			}
			if (roundFinished) {
				currentRound = null;
			}
		}
		
		function _getLoggedInUserName() {
			return decodeURIComponent(getCookieValue("hs_username"));
		}
		
		function displayTournament() {
			const today = dateToString(new Date(), false);
			
			//const startTime = createDate(currentTournament.startTime);
			const now = new Date();
			
			var parentElem = document.getElementById("MyArmy");
			parentElem.innerHTML = "";
			
			const allowSignupAfter = currentTournament.allowSignupAfter != null
				? createDate(currentTournament.allowSignupAfter)
				: now;
			const allowArmySubmissionAfter = currentTournament.allowArmySubmissionAfter != null
				? createDate(currentTournament.allowArmySubmissionAfter)
				: now;
			const signupUrl = "/events/tournament/signup/?Tournament="+currentTournament.id;
			
			var signedUp = false;
			var armySubmitted = false;
			var userPlayer = null;
			if (loggedIn()) {
				const userName = decodeURIComponent(getCookieValue("hs_username"));
				//const userName = getCookieValue("hs_username").replaceAll("%20", " ").replaceAll("%2C", ",");
				for (let i = 0; i < currentTournament.players.length; i++) {
					const player = currentTournament.players[i];
					if (player.name == userName) {
						signedUp = true;
						userPlayer = player;
						const armies = player.playerArmys;
						if (armies.length > 0) {
							armySubmitted = true;
						}					
					}
				}
			}
			
			const allowLateSignup = currentTournament.allowLateSignup;
			
			if ( ! currentTournament.started || currentTournament.finished) {
				displayMapImages();
				displayArmyBuilderLink();
				displayNumPlayersSignedUp();
			}
			if ( ! currentTournament.started || 
					( ! currentTournament.finished && allowLateSignup && loggedIn() && ! signedUp)) {				
				
				if (loggedIn()) {
					const userName = decodeURIComponent(getCookieValue("hs_username"));
					for (let i = 0; i < currentTournament.players.length; i++) {
						const player = currentTournament.players[i];
						if (player.name == userName) {
							const armies = player.playerArmys;
							if (armies.length > 0) {
								for (let i = 0; i < armies.length; i++) {
									parentElem.appendChild(createP({innerHTML: "Army #"+(i+1)+" : " + armies[i].toDisplayString()}));
								}	
								var changeArmyP = createP({});
								parentElem.appendChild(changeArmyP);
								//changeArmyP.appendChild(createA({innerHTML: "Change Army", href: signupUrl}));
								changeArmyP.appendChild(createButton({class: "signupButton", innerHTML: "Change Army", onclick: "location.href='"+signupUrl+"';"}));
							}					
						}
					}
				}
				if ( ! signedUp) {
					if (now >= allowSignupAfter) {
						if (loggedIn()) {
							if (currentTournament.maxEntries == null || currentTournament.maxEntries > currentTournament.players.length) {
								
								if (currentTournament.teamSize > 1) {
									var teamSelect = createSelect({
										id: "teamCaptainSelect"});
									teamSelect.appendChild(createOption({
										value: "-1", 
										innerHTML: "-- New Team Captain --"}));
									
									for (let i = 0; i < currentTournament.players.length; i++) {
										const player = currentTournament.players[i];
										if (player.teamCaptain == null) {
											var teamSize = 1;
											for (let j = 0; j < currentTournament.players.length; j++) {
												if (currentTournament.players[j].teamCaptain == player) {
													teamSize++;
												}
											}
											if (teamSize < currentTournament.teamSize) {
												teamSelect.appendChild(createOption({
													value: player.id, 
													innerHTML: player.name}));
											}
										}
									}
									parentElem.appendChild(teamSelect);
								}
								
								parentElem.appendChild(createButton({class: "signupButton", innerHTML: "Sign-up", onclick: "_signup()"}));
							} else {
								parentElem.appendChild(createDiv({innerHTML: "Tournament is Full"}));
							}
						}
					} else {
						parentElem.appendChild(createDiv({innerHTML: "Sign-ups begin at " + allowSignupAfter.toLocaleString()}));
					}
				} else {
					if ( ! armySubmitted) {
						if (now >= allowArmySubmissionAfter) {
							if (currentTournament.numArmies > 0) {
								//parentElem.appendChild(createA({href: signupUrl, innerHTML: "Submit Army"}));
								parentElem.appendChild(createButton({class: "signupButton", innerHTML: "Submit Army", onclick: "location.href='"+signupUrl+"';"}));
							}
						} else {
							parentElem.appendChild(createDiv({innerHTML: "Army submission begins at " + allowArmySubmissionAfter.toLocaleString()}));
						}
					}
				}
			} else if (currentTournament.started && ! currentTournament.finished) {
				if ( ! armySubmitted && signedUp && currentTournament.numArmies > 0) {
					//parentElem.appendChild(createA({href: signupUrl, innerHTML: "Submit Army"}));
					parentElem.appendChild(createButton({class: "signupButton", innerHTML: "Submit Army", onclick: "location.href='"+signupUrl+"';"}));
				}
			}
			if (signedUp && ! currentTournament.started) {
				parentElem.appendChild(createButton({
					innerHTML: "Drop", 
					class: "signupButton", 
					onclick: "_withdraw()"}));	
			}
			if (signedUp && userPlayer.active && ! currentTournament.finished) {
				parentElem.appendChild(createButton({
					innerHTML: "Mark Inactive",
					class: "signupButton",
					onclick: "_userSelfDrop()"
				}));
			}
			
			createSocket();
			if ( ! currentTournament.finished) {
				//createSocket();
				if (currentTournament.started) {
					displayCurrentRound();
				}
				document.getElementById('ShowGameData').style.display = "block";
			} else {
				//document.getElementById('ShowGameData').style.display = "none";
				displayGameData();
				
				if (isAdmin) {
					_createRestartTournamentDiv(document.getElementById("GameData"));
				}
			}
			
			_displayStandings();
		}
		
		function showGameData() {
			displayGameData();
			document.getElementById('ShowGameData').style.display = "none";
		}
		
		function _userSelfDrop() {
			if (confirm("Are you sure you wish to mark yourself inactive?\n" + 
					"You will not be paired in again until either you or a TD marks you active.")) {
				socket.emit("markSelfInactive", JSON.stringify(""));
			}
		}
		
		function _signup() {
			var signupObj = {
				tournament: {
					id: currentTournament.id
				}
			};
			if (currentTournament.teamSize > 1) {
				var selectElem = document.getElementById("teamCaptainSelect");
				if (selectElem != null) {
					var selectedOption = 
						selectElem.options[selectElem.selectedIndex];
					var teamCaptainId = 
						selectedOption.value;
					signupObj.teamCaptain = {
						id: teamCaptainId
					}				
				}
			}
			socket.emit("signupTournament", JSON.stringify(signupObj));
		}
		
		function _withdraw() {
			if (confirm("Are you sure you want to withdraw from this tournament?\n" + 
					"This will delete your army and entirely remove you from the event.")) {
				socket.emit("deRegisterTournament", JSON.stringify({tournament: {id: currentTournament.id}})); 
			}
		}
		
		function displayMapImages() {
			var parentElem = document.getElementById("MapImages");
			parentElem.innerHTML = "";
			parentElem.appendChild(createH2({
				innerHTML: "Maps"
			}));
			var maps = {};
			var mapsQuantity = {};
			for (let i = 0; i < GameMap.list.length; i++) {
				const gameMap = GameMap.list[i];
				if (maps[gameMap.name] == null) {
					maps[gameMap.name] = gameMap;
					mapsQuantity[gameMap.name] = 0;
				}
				mapsQuantity[gameMap.name] += 1;
			}
			for (let name in maps) {
				const gameMap = maps[name];
				var heroscapeMap = null;
				for (let j = 0; j < HeroscapeMap.list.length; j++) {
					if (HeroscapeMap.list[j].name == gameMap.name) {
						heroscapeMap = HeroscapeMap.list[j];
						break;
					}
				}
				
				var mapDiv = createDiv({class: "mapImageDiv"});
				parentElem.appendChild(mapDiv);
				//if (currentTournament.finished) {
					mapDiv.classList.add("mapImageDivFinished"); // needed for dark mode (sadly)
				//}
				
				
				
				var mapNameDiv = createDiv({
					class: "mapImageDivName"
				});
				mapDiv.appendChild(mapNameDiv);
				
				// currentTournament.finished .started
				
				if (heroscapeMap == null) {
					mapNameDiv.innerHTML = gameMap.name
				} else {
					mapNameDiv.appendChild(createA({
						innerHTML: gameMap.name,
						href: "/map/view/?HeroscapeMap="+heroscapeMap.id,
						target: "_blank"
					}));
				}
				
				mapNameDiv.innerHTML += " (" + mapsQuantity[name] + ")";
				
				if (gameMap.gameMapGlyphs.length > 0) {
					var glyphText = "";
					for (var i = 0; i < gameMap.gameMapGlyphs.length; i++) {
						const glyph = gameMap.gameMapGlyphs[i].glyph;
						if (glyphText.length > 0) {
							glyphText += ", ";
						}
						glyphText += glyph.name;
					}
					mapDiv.appendChild(createDiv({
						innerHTML: "Glyphs: " + glyphText
					}));
				}
				
				if (heroscapeMap != null) {
					mapDiv.appendChild(createImg({
						src: heroscapeMap.imageUrl
					}));
				}
				
				if ( ! currentTournament.started && ! currentTournament.online) {
					if (gameMap.broughtByUser != null) {
						const user = gameMap.broughtByUser;
						if (user.userName == _getLoggedInUserName()) {
							/*mapDiv.appendChild(createButton({
								innerHTML: "Un-Claim Map",
								onclick: "_unClaimMap("+gameMap.id+")"
							}));*/
							mapDiv.classList.add("broughtByMe");
							mapDiv.appendChild(createP({
								innerHTML: "Brought by Me",
								class: "broughtByP"}));
							mapDiv.appendChild(createButton({
								innerHTML: "X",
								class: "mapImageDivBroughtByMeButton",
								onclick: "_unClaimMap("+gameMap.id+")"
							}));
						} else {
							mapDiv.appendChild(createP({
								innerHTML: "Brought by " + user.userName,
								class: "broughtByP"}));
						}
					} else {
						if (loggedIn()) {
							mapDiv.appendChild(createButton({
								innerHTML: "Claim Map",
								class: "mapImageDivUnclaimedButton",
								onclick: "_claimMap("+gameMap.id+")"
							}));
						}
					}
				}
			}
		}
		
		function generateStandings(tournament) {
			var standings = [];
			for (let i = 0; i < currentTournament.players.length; i++) {
				const player = currentTournament.players[i];
				
				if (currentTournament.maxNumPlayersPerGame == 2) {
					if (player.wins() == 0 && player.losses() == 0 && player.ties() == 0) {
						if (currentTournament.rounds.length > 1) {
							continue;
						}
					}
				}
				standings.push(player);
			}
			standings.sort(comparePlayers);
			return standings;
		}
		function comparePlayers(a, b) {
			if (a.teamCaptain != null) {
				a = a.teamCaptain;
			}
			if (b.teamCaptain != null) {
				b = b.teamCaptain;
			}
			
			if (currentTournament.bracket != null) {
				for (let i = currentTournament.rounds.length-1; i > 0; i--) {
					const round = currentTournament.rounds[i];
					if ( ! round.name.includes("Round of ")) {
						break;
					}
					
					var aMadeIt = false;
					var bMadeIt = false;
					var aResult = null;
					var bResult = null;
					
					for (let j = 0; j < round.games.length; j++) {
						const game = round.games[j];
						for (let k = 0; k < game.heroscapeGamePlayers.length; k++) {
							const player = game.heroscapeGamePlayers[k].player;
							const result = game.heroscapeGamePlayers[k].result;
							
							if (a.id == player.id) {
								aMadeIt = true;
								aResult = result;
							} else if (b.id == player.id) {
								bMadeIt = true;
								bResult = result;
							}
						}
					}
					
					if (aMadeIt && ! bMadeIt) {
						return -1;
					} else if ( ! aMadeIt && bMadeIt) {
						return 1;
					} else if (aMadeIt && bMadeIt && aResult != null && bResult != null) {
						if (aResult < bResult) {
							return 1;
						} else if (aResult > bResult) {
							return -1;
						}
					}
					
				}
				
			}
			
			if (a.calculatePoints() < b.calculatePoints()){
				return 1;
			} else if (a.calculatePoints() > b.calculatePoints()) {
				return -1;
			}
			if (currentTournament.maxNumPlayersPerGame == 2) {
				if (a.wins() < b.wins()) {
					return 1;
				} else if (a.wins > b.wins()) {
					return -1;
				}
				if (a.losses() < b.losses()) {
					return -1;
				} else if (a.losses() > b.losses()) {
					return 1;
				}
			}
			if (a.strengthOfSchedule() < b.strengthOfSchedule()) {
				return 1;
			} else if (a.strengthOfSchedule() > b.strengthOfSchedule()) {
				return -1;
			}
			return 0;
		}
		
		function displayNumPlayersSignedUp() {
			var parentElem = document.getElementById("HeroscapeTournament");
			var childDiv = document.getElementById("NumPlayersSignedUp");
			if (childDiv == null) {
				parentElem.appendChild(createDiv({id: "NumPlayersSignedUp"}));
			} else {
				childDiv.innerHTML = "";
			}
			childDiv = document.getElementById("NumPlayersSignedUp");
			childDiv.appendChild(createDiv({innerHTML: currentTournament.players.length + " Players Signed-Up"}));
			if (currentTournament.maxEntries != null) {
				childDiv.appendChild(createDiv({innerHTML: "Player Cap: " + currentTournament.maxEntries}));
			}
		}
		
		function displayArmyBuilderLink() {
			var parentElem = document.getElementById("HeroscapeTournament");
			var childDiv = document.getElementById("ArmyBuilderLink");
			if (childDiv == null) {
				parentElem.appendChild(createDiv({id: "ArmyBuilderLink"}));
				childDiv = document.getElementById("ArmyBuilderLink");
				childDiv.appendChild(createA({href: "/builder/tournament/?HeroscapeTournament="+currentTournament.id, target: "_blank", innerHTML: "Army Builder"}));
			}
		}
		
		function _displayStandings() {
			var parentElem = document.getElementById("Standings");
			parentElem.innerHTML = "";
			
			//displayStandings([currentTournament], parentElem);
			
			parentElem.appendChild(createH2({innerHTML: "Standings"}));
			
			var standings = generateStandings(currentTournament);
			
			var tableElem = createTable({});
			parentElem.appendChild(tableElem);
			var headerRow = createTr({});
			tableElem.appendChild(headerRow);
			
			headerRow.appendChild(createTh({class: "rankColumn"}));
			headerRow.appendChild(createTh({innerHTML: "Player"}));
			
			if (currentTournament.maxNumPlayersPerGame > 2) {
				headerRow.appendChild(createTh({innerHTML: "Points"}));
			} else {
				headerRow.appendChild(createTh({innerHTML: "W"}));
				headerRow.appendChild(createTh({innerHTML: "L"}));
				headerRow.appendChild(createTh({innerHTML: "T"}));
				headerRow.appendChild(createTh({innerHTML: "SoS"}));
			}
			headerRow.appendChild(createTh({innerHTML: "Army(s)"}));
			
			for (let i = 0; i < standings.length; i++) {
				const player = standings[i];
				
				if (currentTournament.teamSize > 1 && player.teamCaptain != null) {
					continue;
				}
				
				var rank = i+1;
				if (i > 0 && comparePlayers(player, standings[i-1]) == 0) {
					for (let j = i-1; j >= 0; j--) {
						if (comparePlayers(player, standings[j]) != 0) {
							break;
						}
						rank = j+1;
					}
					rank = "T-" + rank;
				}
				if (Number.isInteger(rank) && i < standings.length-1 && comparePlayers(player, standings[i+1]) == 0) {
					rank = "T-" + rank;
				}
				
				_displayPlayerInStandings(player, tableElem, rank);
	
				if (currentTournament.teamSize > 1 && player.teamCaptain == null) {
					for (let j = 0; j < player.players.length; j++) {
						_displayPlayerInStandings(player.players[j], tableElem, rank);
					}
				}
			}
			
			if (currentTournament.finished) {
				parentElem.appendChild(createH3({innerHTML: "Meta-Health Index"}));
				parentElem.appendChild(createDiv({
					id: "metaHealthIndex",
					innerHTML: "Calculating..."
				}));
				ignoreLoadingIcon = true;
				mhi(currentTournament, function(mhi) {
					document.getElementById("metaHealthIndex").innerHTML = mhi.toFixed(4);
				});
				parentElem.appendChild(createA({
					innerHTML: "Read More",
					href: "/documents/MHI (Meta-Health Index).pdf",
					target: "_blank"
				}));
			}
		}
		
		function _displayPlayerInStandings(player, tableElem, rank) {
			var row = createTr({});
				
			if ( ! player.active) {
				row.classList.add("droppedPlayer");
			}
			
			row.appendChild(createTd({class: "rankColumn", innerHTML: rank}));
			
			tableElem.appendChild(row);
			var playerNameTd = createTd({innerHTML: player.name});
			if (currentTournament.teamSize > 1) {
				if (player.teamCaptain == null) {
					playerNameTd.appendChild(createSpan({class: "teamCaptain", innerHTML: "C"}));
					//row.classList.add("teamCaptainRow");
				} else {
					playerNameTd.classList.add("notTeamCaptain");
				}
			}
			row.appendChild(playerNameTd);
			
			if (currentTournament.maxNumPlayersPerGame > 2) {
				row.appendChild(createTd({innerHTML: player.calculatePoints()}));
			} else {
				if (currentTournament.teamSize == 1 || player.teamCaptain == null) {
					row.appendChild(createTd({innerHTML: player.wins()}));
					row.appendChild(createTd({innerHTML: player.losses()}));
					row.appendChild(createTd({innerHTML: player.ties()}));
					row.appendChild(createTd({innerHTML: player.strengthOfSchedule()}));
				} else {
					row.appendChild(createTd({innerHTML: ""}));
					row.appendChild(createTd({innerHTML: ""}));
					row.appendChild(createTd({innerHTML: ""}));
					row.appendChild(createTd({innerHTML: ""}));
				}
			}
			
			var armyString = "";
			if (player.playerArmys.length > 0) {
				if (player.playerArmys[0].toDisplayString() !== null) {
					for (let j = 0; j < player.playerArmys.length; j++) {
						if (player.playerArmys[j].id !== undefined) {
							if (j > 0) {
								armyString += "<br>";
							}
							if (player.playerArmys.length > 1) {
								armyString += (j+1) + ") ";
							}
							armyString += player.playerArmys[j].toDisplayString();
							/*if (player.playerArmys.length > 1) {
								armyString += ". ";
							}*/
						}
					}
				} else {
					armyString = "[Submitted]";
				}
			} else {
				armyString = "";
			}
			
			row.appendChild(createTd({innerHTML: armyString}));
		}
		
		function _showFullMatchups() {
			document.getElementById("showFullMatchupButton").style.display = "none";
			document.getElementById("hideFullMatchupButton").style.display = "block";
			document.getElementById("fullStandingsGameDiv").style.display = "inline-block";
		}
		
		function _hideFullMatchups() {
			document.getElementById("showFullMatchupButton").style.display = "block";
			document.getElementById("hideFullMatchupButton").style.display = "none";
			document.getElementById("fullStandingsGameDiv").style.display = "none";
		}
		
		function _isRematch(game) {
			if (game.heroscapeGamePlayers.length != 2) {
				// Multiplayer or Bye 
				return false;
			}
			for (let i = 0; i < currentTournament.rounds.length; i++) {
				if (currentTournament.rounds[i].id != game.round.id) {
					var currRound = currentTournament.rounds[i];
					for (let j = 0; j < currRound.games.length; j++) {
						
						if (currRound.games[j].heroscapeGamePlayers.length < 2) {
							continue;
						}
					
						var player1 = game.heroscapeGamePlayers[0].player;
						var player2 = game.heroscapeGamePlayers[1].player;
						var playerA = currRound.games[j].heroscapeGamePlayers[0].player;
						var playerB = currRound.games[j].heroscapeGamePlayers[1].player;
					
						if (player1.id == playerA.id || player1.id == playerB.id) {
							if (player2.id == playerA.id || player2.id == playerB.id) {
								return true;
							}
						}
					}
				}
			}
			return false;
		}
		
		function displayCurrentRound() {
			displayBracket(); 
			
			var parentElem = document.getElementById("CurrentRound");
			parentElem.innerHTML = "";
			
			if (currentTournament.rounds.length > 0) {
				parentElem.appendChild(createH2({
					id: "roundH2",
					innerHTML: /*"Current Round " + */currentTournament.rounds[currentTournament.rounds.length-1].name}));
			}
			var username = getCookieValue("hs_username");
			if (username != null) {
				username = decodeURIComponent(username);
				//username = username.replaceAll("%20", " ").replaceAll("%2C", ",");
			}
			
			var timerDiv = createDiv({id: "roundTimerDiv"});
			parentElem.appendChild(timerDiv);
			
			var roundIdx = currentTournament.rounds.length - 1;
			if (roundIdx >= 0) {
				var roundFinished = true;
				for (let i = 0; i < currentTournament.rounds[roundIdx].games.length; i++) {
					const game = currentTournament.rounds[roundIdx].games[i];
					if (game.heroscapeGamePlayers === undefined ||
							game.heroscapeGamePlayers === null || 
							game.heroscapeGamePlayers.length == 0 || 
							game.heroscapeGamePlayers[0].result == null) {
						roundFinished = false;
						break;
					}
				}
				if (roundFinished) {
					parentElem.appendChild(createP({innerHTML: "Next round has not started yet."}));
				} else {
					currentRound = currentTournament.rounds[roundIdx];			
					
					if ( ! currentRound.started && isAdmin) {
						parentElem.appendChild(createButton({
							id: "publishRoundButton",
							innerHTML: "Publish & Start Round",
							onclick: "_publishRound()"}));
						document.getElementById("roundH2").innerHTML += " (Not Published Yet)";
					}

					_createMatchupsTable(parentElem, username);
					_createFullMatchupsDiv(parentElem);
				}
			} else {
				parentElem.appendChild(createP({innerHTML: "Tournament has not started yet."}));
			}
		}
		
		function powerOfTwo(x) {
			return (Math.log(x)/Math.log(2)) % 1 === 0;
		}
		
		function displayBracket() {
			var bracket = currentTournament.bracket;
			if (bracket == null) {
				return;
			}
						
			var parentElem = document.getElementById("Bracket");
			parentElem.innerHTML = "";
			
			parentElem.appendChild(createH2({
				id: "bracketH2",
				innerHTML: "Bracket"}));
				
			var bracketDiv = createDiv({class: "bracket"});
			parentElem.appendChild(bracketDiv);
							
			var size = bracket.bracketEntrys.length; 
			if ( ! powerOfTwo(size)) {
				var upSize = 1;
				var n = 1;
				while (upSize < size) {
					upSize = Math.pow(2,n++);
				}
				size = upSize;
			}
									
			var roundNum = 0;
			var prevRound = null;
			for (let roundIdx = 1; roundIdx < size; roundIdx *= 2) {
				var roundDiv = createDiv({class: "bracketRound"});
				bracketDiv.appendChild(roundDiv);
				
				roundNum++;
				
				const numGamesInRound = (size/2) / roundIdx;
				
				var numPlayersInRound = roundIdx == 1
					? bracket.bracketEntrys.length
					: numGamesInRound * 2;
					
				if ( ! powerOfTwo(numPlayersInRound)) {
					var n = 1;
					var k = Math.pow(2,n);
					while (k < numPlayersInRound) {
						k = Math.pow(2, ++n);
					}
					numPlayersInRound = k;
				}	
					
				var round = null;
				for (let i = 0; i < currentTournament.rounds.length; i++) {
					if (currentTournament.rounds[i].name == "Round of " + numPlayersInRound) {
						round = currentTournament.rounds[i];
						break;
					}
				}
				
				var seeds = Array.from({length: numPlayersInRound}, (v, k) => k + 1);
								
				var gameSeeds = getBracket(seeds);
				if (bracket.reSeedEachRound && prevRound != null) {
					gameSeeds = [];
					if (round != null) {
						for (let i = 0; i < round.games.length; i++) {
							const game = round.games[i];
							var player1 = game.heroscapeGamePlayers[0].player;
							var player2 = game.heroscapeGamePlayers.length > 1
								? game.heroscapeGamePlayers[1].player
								: null;
							var entry1 = null;
							var entry2 = null;
							for (let j = 0; j < bracket.bracketEntrys.length; j++) {
								var entry = bracket.bracketEntrys[j];
								if (player1.id == entry.player.id) {
									entry1 = entry;
								}
								if (player2 != null && player2.id == entry.player.id) {
									entry2 = entry;
								}
							}
							gameSeeds.push([entry1.seed, entry2.seed]);
						}
					} else {
						var remainingSeeds = [];
						for (let i = 0; i < bracket.bracketEntrys.length; i++) {
							var entry = bracket.bracketEntrys[i];
							if ( ! entry.eliminated) {
								remainingSeeds.push(entry.seed);
							}
						}
						remainingSeeds.sort(function(a, b) {
							return a - b;
						});
						while (remainingSeeds.length > 0) {
							var seed1 = remainingSeeds.shift();
							var seed2 = remainingSeeds.length > 0
								? remainingSeeds.pop()
								: null;
							gameSeeds.push([seed1, seed2]);
						}
					}
				}
								
				for (let g = 0; g < gameSeeds.length; g++) {
					var gameDiv = createDiv({class: "bracketGame"});
					roundDiv.appendChild(gameDiv);
										
					var higherSeed = gameSeeds[g][0];
					var lowerSeed = gameSeeds[g][1];
					var higherSeedEntry = null;
					var lowerSeedEntry = null;
					
					if (roundNum == 1) {
						for (let j = 0; j < bracket.bracketEntrys.length; j++) {
							const bracketEntry = bracket.bracketEntrys[j];
							if (bracketEntry.seed == higherSeed) {
								higherSeedEntry = bracketEntry;
							} else if (bracketEntry.seed == lowerSeed) {
								lowerSeedEntry = bracketEntry;
							}
						}
					} else if (prevRound != null) {
						var higherSeedValidOpponentSeeds = [];
						var tempNumPlayersInRound = numPlayersInRound * 2;
						while (tempNumPlayersInRound <= size) {
							higherSeedValidOpponentSeeds = 
								higherSeedValidOpponentSeeds.concat(
									_findValidOpponentSeeds(higherSeed, tempNumPlayersInRound, size));
							tempNumPlayersInRound *= 2;
						}
						/*var higherSeedValidOpponentSeeds = 
							_findValidOpponentSeeds(higherSeed, numPlayersInRound * 2, size);*/
						higherSeedValidOpponentSeeds.push(higherSeed);
						
						var lowerSeedValidOpponentSeeds = [];
						tempNumPlayersInRound = numPlayersInRound * 2;
						while (tempNumPlayersInRound <= size) {
							lowerSeedValidOpponentSeeds = 
								lowerSeedValidOpponentSeeds.concat(
									_findValidOpponentSeeds(lowerSeed, tempNumPlayersInRound, size));
							tempNumPlayersInRound *= 2;
						}
						/*var lowerSeedValidOpponentSeeds = 
							_findValidOpponentSeeds(lowerSeed, numPlayersInRound * 2, size);*/
						lowerSeedValidOpponentSeeds.push(lowerSeed);
							
						if (bracket.reSeedEachRound) {
							for (let beId = 0; beId < bracket.bracketEntrys.length; beId++) {
								const bEntry = bracket.bracketEntrys[beId];
								if (bEntry.seed == higherSeed) {
									higherSeedEntry = bEntry;
								} else if (bEntry.seed == lowerSeed) {
									lowerSeedEntry = bEntry;
								}
							}							
						} else {
							//var player1Set = false;
							//var player2Set = false;
							for (let gId = 0; gId < prevRound.games.length; gId++) {
								var game = prevRound.games[gId];
								var player1 = game.heroscapeGamePlayers[0];
								if (player1.result == null) {
									continue;
								}
								var player2 = game.heroscapeGamePlayers.length > 1
									? game.heroscapeGamePlayers[1]
									: null;
								for (let beId = 0; beId < bracket.bracketEntrys.length; beId++) {
									const bEntry = bracket.bracketEntrys[beId];
									for (let sId = 0; sId < higherSeedValidOpponentSeeds.length; sId++) {
										const currSeed = higherSeedValidOpponentSeeds[sId];
										if (currSeed == bEntry.seed) {
											if (bEntry.player.id == player1.player.id && player1.result > 0) {
												higherSeedEntry = bEntry;
											} else if (player2 != null && bEntry.player.id == player2.player.id && player2.result > 0) {
												higherSeedEntry = bEntry;
											}
										}
									}
									for (let sId = 0; sId < lowerSeedValidOpponentSeeds.length; sId++) {
										const currSeed = lowerSeedValidOpponentSeeds[sId];
										if (currSeed == bEntry.seed) {
											if (bEntry.player.id == player1.player.id && player1.result > 0) {
												lowerSeedEntry = bEntry;
											} else if (player2 != null && bEntry.player.id == player2.player.id && player2.result > 0) {
												lowerSeedEntry = bEntry;
											}
										}
									}
								}
							}	
						}						
					}

					var player1Name = "TBD";
					if (higherSeedEntry != null) {
						player1Name = higherSeedEntry.seed + ". " + higherSeedEntry.player.name;
					}
					var player1Div = createDiv({
						class: "bracketPlayer",
						innerHTML: player1Name
					});
					gameDiv.appendChild(player1Div);
					if (higherSeedEntry != null && round != null) {
						for (let i = 0; i < round.games.length; i++) {
							const game = round.games[i];
							for (let j = 0; j < game.heroscapeGamePlayers.length; j++) {
								const gamePlayer = game.heroscapeGamePlayers[j];
								if (gamePlayer.player.id == higherSeedEntry.player.id) {
									if (gamePlayer.result != null && gamePlayer.result > 0) {
										player1Div.classList.add("gameWinner");
									}
									break;
								}
							}
						}
					}
					
					var player2Name = "TBD";
					if (lowerSeedEntry != null) {
						player2Name = lowerSeedEntry.seed + ". " + lowerSeedEntry.player.name
					} else {
						if (roundIdx == 1) {
							player2Name = "-- bye --"
						}
					}
					var player2Div = createDiv({
						class: "bracketPlayer",
						innerHTML: player2Name
					});
					gameDiv.appendChild(player2Div);
					if (lowerSeedEntry != null && round != null) {
						for (let i = 0; i < round.games.length; i++) {
							const game = round.games[i];
							for (let j = 0; j < game.heroscapeGamePlayers.length; j++) {
								const gamePlayer = game.heroscapeGamePlayers[j];
								if (gamePlayer.player.id == lowerSeedEntry.player.id) {
									if (gamePlayer.result != null && gamePlayer.result > 0) {
										player2Div.classList.add("gameWinner");
									}
									break;
								}
							}
						}
					}
				}
				prevRound = round;
			}						
		}
		
		function _findValidOpponentSeeds(seed, roundSize, bracketSize) {
			// Ex. 1, 4, 8 => [4,5]
			// Ex. 1, 4, 16 => [4,5,13,12]
			// [4,5] => [4,5,16-4+1,16-5+1]
			var validSeeds = [];
			
			var comparisonSeed = seed;
			if (comparisonSeed > roundSize) {
				var tempRoundSize = roundSize;
				while (comparisonSeed > tempRoundSize) {
					tempRoundSize *= 2;
				}
				comparisonSeed = Math.min.apply(Math, _findValidOpponentSeeds(seed, tempRoundSize, bracketSize));  
			}
			validSeeds.push(roundSize+1-comparisonSeed);
			
			var cutoff = bracketSize;
			if ( ! powerOfTwo(cutoff)) {
				var n = 1;
				var k = Math.pow(2,n);
				while (k < cutoff) {
					k = Math.pow(2, ++n);
				}
				cutoff = k;
			}
			for (let currRoundSize = roundSize*2; currRoundSize <= cutoff; currRoundSize*=2) {
				var newValidSeeds = [];
				for (let j = 0; j < validSeeds.length; j++) {
					newValidSeeds.push(currRoundSize+1-validSeeds[j]);
				}
				validSeeds = validSeeds.concat(newValidSeeds);
			}
			return validSeeds;
		}
		
		function getBracket(participants) {
			var participantsCount = participants.length;	
			var rounds = Math.ceil(Math.log(participantsCount)/Math.log(2));
			var bracketSize = Math.pow(2, rounds);
			var requiredByes = bracketSize - participantsCount;

			if (participantsCount < 2) {
				return [];
			}

			var matches = [[1,2]];

			for (var round = 1; round < rounds; round++) {
				var roundMatches = [];
				var sum = Math.pow(2, round + 1) + 1;

				for (var i = 0; i < matches.length; i++) {
					var home = changeIntoBye(matches[i][0], participantsCount);
					var away = changeIntoBye(sum - matches[i][0], participantsCount);
					roundMatches.push([home, away]);
					home = changeIntoBye(sum - matches[i][1], participantsCount);
					away = changeIntoBye(matches[i][1], participantsCount);
					roundMatches.push([home, away]);
				}
				matches = roundMatches;   
			}   
			return matches;    
		}

		function changeIntoBye(seed, participantsCount) {
			return seed <= participantsCount ?  seed : null;
		}
		
		function displayGameData() {
			displayBracket();
			
			var parentElem = document.getElementById("GameData");
			parentElem.innerHTML = "";
			
			for (let i = 0; i < currentTournament.rounds.length; i++) {
				const round = currentTournament.rounds[i];
				if (round.id === undefined) {
					continue;
				}
				
				var roundDiv = createDiv({class: "roundGames"});
				parentElem.appendChild(roundDiv);
				roundDiv.appendChild(createH3({innerHTML: round.name}));
				
				_createMatchupsTable(roundDiv, null, round);
			}
		}
		
		function _publishRound() {
			if (confirm("Are you sure you're ready to publish & start the round?")) {
				socket.emit("publishNextRound", JSON.stringify({
					round: {
						id: currentRound.id
					}
				}));
			}			
		}
		
		function _createMatchupsTable(parentElem, username, round=null) {
			var matchupsDiv = createDiv({id: 'matchupsDiv'});
			parentElem.appendChild(matchupsDiv);
			
			var table = createTable({});
			matchupsDiv.appendChild(table);
			
			if (round == null) {
				round = currentRound;
			}
			
			var editableTableHr = createTr({});
			table.appendChild(editableTableHr);
			editableTableHr.appendChild(createTh({innerHTML: "Map"}));
			
			if (currentTournament.online) {
				editableTableHr.appendChild(createTh({innerHTML: ""}));
			}
			
			for (let i = 0; i < currentTournament.maxNumPlayersPerGame; i++) {
				editableTableHr.appendChild(createTh({innerHTML: "Player " + (i+1)}));
			}
			
			// Doesn't seem to be doing anything...
			round.games.sort(function(a, b) {
				if (a.heroscapeGamePlayers.length > b.heroscapeGamePlayers.length) {
					return -1;
				} else if (a.heroscapeGamePlayers.length < b.heroscapeGamePlayers.length) {
					return 1;
				}
				var game1Wins = 0;
				for (let i = 0; i < a.heroscapeGamePlayers.length; i++) {
					game1Wins += a.heroscapeGamePlayers[i].player.wins()
				}
				var game2Wins = 0;
				for (let i = 0; i < b.heroscapeGamePlayers.length; i++) {
					game2Wins += b.heroscapeGamePlayers[i].player.wins()
				}
				if (game1Wins > game2Wins) {
					return -1;
				} else if (game1Wins < game2Wins) {
					return 1;
				} else {
					return 0;
				}
			});
			for (let i = 0; i < round.games.length; i++) {
				const game = round.games[i];
				
				var tableRow = createTr({});
				table.appendChild(tableRow);
				
				if (round == currentRound && _isRematch(game)) {
					tableRow.classList.add("gameRematch")
				}
				
				if (game.map != null) {
					var mapTd = createTd({
						id: "editable_map_"+game.map.id,
						draggable: isAdmin && ! round.started,
						ondragstart: "_drag(event,"+game.map.id+",true)",
						ondrop: "_drop(event,"+game.map.id+",true)",
						ondragover: "_dragover(event)"});
					tableRow.appendChild(mapTd);
					
					if (game.map.forStreaming) {
						mapTd.appendChild(createSpan({
							innerHTML: "S",
							class: "streamingMapLabel"
						}));
					}
					
					if (game.map != null) { // "Should" never be null...
						var heroscapeMap = null;
						for (let j = 0; j < HeroscapeMap.list.length; j++) {
							if (HeroscapeMap.list[j].name == game.map.name) {
								heroscapeMap = HeroscapeMap.list[j];
								break;
							}
						}
						if (currentTournament.finished && heroscapeMap != null) {
							mapTd.appendChild(createA({
								href: "/map/view/?HeroscapeMap="+heroscapeMap.id,
								target: "_blank",
								class: "mapLinkFinished",
								innerHTML: game.map.name
							}));
						} else {
							mapTd.appendChild(createText(game.map.name));
						}
						mapTd.appendChild(createText(" " + game.map.number));
					}
						
				} else {
					tableRow.appendChild(createTd({innerHTML: ""}));
				}
				
				if (currentTournament.online) {
					var onlineTd = createTd({});
					tableRow.appendChild(onlineTd)
					if (game.onlineUrl != null) {
						onlineTd.appendChild(createA({
							innerHTML: "OHS",
							href: game.onlineUrl,
							target: "_blank"
						}));
					} 
				}
				
				if (game.heroscapeGamePlayers !== undefined && game.heroscapeGamePlayers !== null) {
					for (let j = 0; j < game.heroscapeGamePlayers.length; j++) {
						const gamePlayer = game.heroscapeGamePlayers[j];
						const player = gamePlayer.player;
						
						var playerNames = player.name;
						for (let k = 0; k < player.players.length; k++) {
							playerNames += ", " + player.players[k].name;
						}
						
						var td = createTd({
							id: "editable_player_"+gamePlayer.id,
							innerHTML: playerNames,
							draggable: isAdmin && ! round.started,
							ondragstart: "_drag(event,"+gamePlayer.id+")",
							ondrop: "_drop(event,"+gamePlayer.id+")",
							ondragover: "_dragover(event)"});
						if (currentTournament.maxNumPlayersPerGame == 2) {
							if (gamePlayer.result == 2) {
								td.classList.add("gameWinner");
							} else if (gamePlayer.result == 1) {
								td.classList.add("gameTie");
							}
						} else {
							if (gamePlayer.result != null && gamePlayer.result > 0) {
								var higherResult = false;
								for (let k = 0; k < game.heroscapeGamePlayers.length; k++) {
									if (game.heroscapeGamePlayers[k].result > gamePlayer.result) {
										higherResult = true;
										break;
									}
								}
								if ( ! higherResult) {
									td.classList.add("gameWinner");
								}
							}
						}							
						tableRow.appendChild(td);
					}
					for (let j = game.heroscapeGamePlayers.length; j < currentTournament.maxNumPlayersPerGame; j++) {
						tableRow.appendChild(createTd({innerHTML: ""}));
					}
					
					if (username !== null) {
						if (currentRound.started) {
							var reportResultTd = createTd({});
							tableRow.appendChild(reportResultTd);
							
							var usersGame = false;
							for (let j = 0; j < game.heroscapeGamePlayers.length; j++) {
								const gamePlayer = game.heroscapeGamePlayers[j];
								if (gamePlayer.player.name == username) {
									usersGame = true;
									break;
								}
							}
							if ((usersGame || isAdmin) && game.heroscapeGamePlayers.length >= 2) {
								const reportButtonLabel = game.heroscapeGamePlayers[0].result === null
									? "Report Result"
									: "Fix Result";
								var reportDiv = createDiv({});
								reportResultTd.appendChild(reportDiv);
								reportDiv.appendChild(createButton({
									id: "reportResultButton_"+game.id,
									innerHTML: reportButtonLabel,
									onclick: "showSubmitGame("+game.id+")"
								}));
								_createReportForm(reportDiv, game);
							}		
							
						} 
					}
					
					if (currentTournament.started && ! currentTournament.finished && currentRound !== null && currentRound.started) {
						var pcsTd = createTd({});
						tableRow.appendChild(pcsTd);
							
						if (currentTournament.numArmies == 1 && game.heroscapeGamePlayers[0].result === null) {
							var pcsDiv = createDiv({});
							pcsTd.appendChild(pcsDiv);
							var pcsUrl = "";
							pcsUrl += "/tools/scoring?army1="+game.heroscapeGamePlayers[0].player.playerArmys[0].toDisplayString(true);
							pcsUrl += "&army2="+game.heroscapeGamePlayers[1].player.playerArmys[0].toDisplayString(true);
							pcsUrl += "&delta="+ (currentTournament.useDeltaPricing
									? "true"
									: "false");
							pcsUrl += "&vc=" + (currentTournament.includeVC
									? "true"
									: "false");
							pcsDiv.appendChild(createA({
								href: pcsUrl,
								target: "_blank",
								innerHTML: "PCS"
							}));
						}
					}
					
				}				
			}		
			if ( ! round.started && isAdmin) {
				for (let i = 0; i < GameMap.list.length; i++) {
					const map = GameMap.list[i];
					var mapUsed = false;
					for (let j = 0; j < round.games.length; j++) {
						const game = round.games[j];
						
						if (game.map != null) {
							if (game.map.id == map.id) {
								mapUsed = true;
								break;
							}
						}
					}
					if ( ! mapUsed) {
						var tableRow = createTr({});
						table.appendChild(tableRow);
						
						tableRow.appendChild(createTd({
							id: "editable_map_"+map.id,
							innerHTML: map.name + " " + map.number,
							draggable: isAdmin && ! round.started,
							ondragstart: "_drag(event,"+map.id+",true)",
							ondrop: "_drop(event,"+map.id+",true)",
							ondragover: "_dragover(event)"}));
					}
				}
			}
		}	
		
		function _createFullMatchupsDiv(parentElem) {
			parentElem.appendChild(createButton({
				id: "showFullMatchupButton",
				innerHTML: "Show Full Matchups",
				onclick: "_showFullMatchups()"
			}));
			parentElem.appendChild(createButton({
				id: "hideFullMatchupButton",
				innerHTML: "Hide Full Matchups",
				onclick: "_hideFullMatchups()"
			}));
			
			var fullMatchupsDiv = createDiv({id: 'fullStandingsGameDiv'});
			parentElem.appendChild(fullMatchupsDiv);
			
			for (let i = 0; i < currentRound.games.length; i++) {
				const game = currentRound.games[i];
				
				var fullMatchupGameDiv = createDiv({});
				fullMatchupsDiv.appendChild(fullMatchupGameDiv);
				
				if (game.heroscapeGamePlayers !== undefined && game.heroscapeGamePlayers !== null) {
					if (game.heroscapeGamePlayers.length == 1) {
						fullMatchupGameDiv.appendChild(createSpan({
							innerHTML: game.heroscapeGamePlayers[0].player.name + " has a bye."}));
						continue;
					}
					for (let j = 0; j < game.heroscapeGamePlayers.length; j++) {
						const gamePlayer = game.heroscapeGamePlayers[j];
						const player = gamePlayer.player;
						
						var playerSpan = createSpan({
							innerHTML: player.name + 
								" ("+player.wins()+"-"+player.losses()+"-"+player.ties()+")"});
						fullMatchupGameDiv.appendChild(createSpan({
							innerHTML: player.name + 
								" ("+player.wins()+"-"+player.losses()+"-"+player.ties()+")"}));
						if (gamePlayer.result == 2) { // TODO : make this work for multiplayer
							playerSpan.classList.add("gameWinner");
						}
						
						if (j < game.heroscapeGamePlayers.length - 1) {
							fullMatchupGameDiv.appendChild(createSpan({innerHTML: " v. "}));
						}
					}
					if (game.map != null) { // "Should" never be null...
						fullMatchupGameDiv.appendChild(createSpan({
							innerHTML: " on " + game.map.name + " " + game.map.number}));
					}
					
					if (game.onlineUrl != null) {
						var gameLinkDiv = createDiv({
							innerHTML: "Game Link : "
						});
						fullMatchupGameDiv.appendChild(gameLinkDiv);
						gameLinkDiv.appendChild(createA({
							innerHTML: game.onlineUrl,
							href: game.onlineUrl,
							target: "_blank"
						}));
					}
				
					for (let j = 0; j < game.heroscapeGamePlayers.length; j++) {
						const gamePlayer = game.heroscapeGamePlayers[j];
						const player = gamePlayer.player;
						
						var armysDiv = createDiv({class: "matchupArmysDiv"});
						fullMatchupGameDiv.appendChild(armysDiv);
						armysDiv.appendChild(createSpan({
							innerHTML: "&nbsp;&nbsp;&nbsp;&nbsp;" + player.name}));
						
						for (let k = 0; k < player.playerArmys.length; k++) {
							armysDiv.appendChild(createDiv({
								class: "matchupArmyDiv", 
								innerHTML: "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Army #" + 
									(k+1) + " : " + player.playerArmys[k].toDisplayString()}));
						}
					}
				}
			}	
		}
		
		function _drag(ev, objId, isMap=false) {
			ev.dataTransfer.setData("text/plain", JSON.stringify({id: objId, isMap: isMap}));  
		}
		
		function _drop(ev, objId, isMap=false) {
			ev.preventDefault();
			
			var data = JSON.parse(ev.dataTransfer.getData("text/plain"));
			
			if (data.isMap != isMap) {
				alert("You can't switch a map with a player, silly.");
				return;
			}
			if (objId == data.id) {
				return; 
			}
			
			var draggedObj = null;
			var droppedObj = null;
			if (isMap) {
				for (let i = 0; i < GameMap.list.length; i++) {
					if (GameMap.list[i].id == objId) {
						droppedObj = GameMap.list[i];
					} else if (GameMap.list[i].id == data.id) {
						draggedObj = GameMap.list[i];
					}
				}
			} else {
				for (let i = 0; i < HeroscapeGamePlayer.list.length; i++) {
					if (HeroscapeGamePlayer.list[i].id == objId) {
						droppedObj = HeroscapeGamePlayer.list[i];
					} else if (HeroscapeGamePlayer.list[i].id == data.id) {
						draggedObj = HeroscapeGamePlayer.list[i];
					}
				}
			}
			if (draggedObj != null && droppedObj != null) {
				var confirmMsg = "Switch ";
				confirmMsg += isMap
					? draggedObj.name + " " + draggedObj.number
					: draggedObj.player.name;
				confirmMsg += " with ";
				confirmMsg += isMap
					? droppedObj.name + " " + droppedObj.number
					: droppedObj.player.name;;
				confirmMsg += "?";
				if (confirm(confirmMsg)) {
					var draggedGame = null;
					var droppedGame = null;
					if (isMap) {
						for (let i = 0; i < currentRound.games.length; i++) {
							if (currentRound.games[i].map == null) {
								continue;
							}
							if (currentRound.games[i].map.id == draggedObj.id) {
								draggedGame = currentRound.games[i];
							} else if (currentRound.games[i].map.id == droppedObj.id) {
								droppedGame = currentRound.games[i];
							}
						}
					} else {
						draggedGame = draggedObj.game;
						droppedGame = droppedObj.game;
					}
					if (draggedGame == droppedGame) {
						alert("That player is already in that game; nothing to change.");
						return;
					}
					
					// Update local display
					if (isMap) {
						/*const tempMap = draggedGame.map;
						draggedGame.map = droppedGame.map;
						droppedGame.map = tempMap;*/
						const tempMap = draggedObj;
						if (draggedGame != null) {
							draggedGame.map = droppedObj;
						}
						if (droppedGame != null) {
							droppedGame.map = tempMap;
						}
					} else {
						var draggedObjIdx = draggedGame.heroscapeGamePlayers.indexOf(draggedObj);
						var droppedObjIdx = droppedGame.heroscapeGamePlayers.indexOf(droppedObj)
						var tempPlayer = draggedObj;
						draggedGame.heroscapeGamePlayers[draggedObjIdx] = droppedObj;
						droppedGame.heroscapeGamePlayers[droppedObjIdx] = tempPlayer;
						draggedObj.game = droppedGame;
						droppedObj.game = draggedGame;
					}
					
					// Update on server
					if (draggedGame != null) {
						var map1 = draggedGame.map == null
							? null
							: {
								id: draggedGame.map.id
							};
						var draggedGameObj = {
							id: draggedGame.id,
							map: map1,
							heroscapeGamePlayers: []
						};
						for (let i = 0; i < draggedGame.heroscapeGamePlayers.length; i++) {
							draggedGameObj.heroscapeGamePlayers.push({
								id: draggedGame.heroscapeGamePlayers[i].id
							});
						}
						socket.emit('changeGame', JSON.stringify({
							game: draggedGameObj
						}));
					}
					
					if (droppedGame != null) {
						var map2 = droppedGame.map == null
							? null
							: {
								id: droppedGame.map.id
							};
						var droppedGameObj = {
							id: droppedGame.id,
							map: map2,
							heroscapeGamePlayers: []
						};
						for (let i = 0; i < droppedGame.heroscapeGamePlayers.length; i++) {
							droppedGameObj.heroscapeGamePlayers.push({
								id: droppedGame.heroscapeGamePlayers[i].id
							});
						}
						
						socket.emit('changeGame', JSON.stringify({
							game: droppedGameObj
						}));
					}
				}
			}
			displayCurrentRound();
		}
		
		function _dragover(ev) {
			ev.preventDefault();
		}
		
		function _createReportForm(parentElem, game) {
			var reportForm = createDiv({
				id: "reportFormDiv_"+game.id,
				class: "reportFormDiv"});
			$(reportForm).data("game", game);
			parentElem.appendChild(reportForm);
			
			if (currentTournament.maxNumPlayersPerGame == 2) {
				var player1 = game.heroscapeGamePlayers[0].player;
				var player2 = game.heroscapeGamePlayers[1].player;
				
				var reportSelect = createSelect({
					id: "reportFormSelect_"+game.id});
				//$(reportSelect).data("game", game);
				reportForm.appendChild(reportSelect);
				reportSelect.appendChild(createOption({
					innerHTML: "-- Who Won? --",
					value: "-1"}));
				reportSelect.appendChild(createOption({
					innerHTML: player1.name,
					value: 1}));
				reportSelect.appendChild(createOption({
					innerHTML: player2.name,
					value: 2}));
				if (currentTournament.bracket == null) {
					reportSelect.appendChild(createOption({
						innerHTML: "Tie",
						value: 0}));
				}
				
				var togglePointsDiv = createDiv({});
				reportForm.appendChild(togglePointsDiv);
				var togglePointsLabel = createLabel({});
				togglePointsDiv.appendChild(togglePointsLabel);
				togglePointsLabel.appendChild(createText("Game Went To Time"));
				togglePointsLabel.appendChild(createInput({
					type: 'checkbox',
					id: 'togglePointsCheckbox_'+game.id,
					onclick: 'toggleGameResultPoints('+game.id+')'}));
				
				var partialPointsDiv = createDiv({
					id: 'PartialPointsDiv_'+game.id,
					class: 'PartialPointsDiv'
				});
				reportForm.appendChild(partialPointsDiv);
				var player1PointsLabel = createLabel({});
				partialPointsDiv.appendChild(player1PointsLabel);
				player1PointsLabel.appendChild(createText("Player 1 Points: "));
				player1PointsLabel.appendChild(createInput({
					type: "number",
					min: "0",
					step: "1",
					id: "player1Points_"+game.id}));
				var player2PointsLabel = createLabel({});
				partialPointsDiv.appendChild(player2PointsLabel);
				player2PointsLabel.appendChild(createText("Player 2 Points: "));
				player2PointsLabel.appendChild(createInput({
					type: "number",
					min: "0",
					step: "1",
					id: "player2Points_"+game.id}));
			} else {
				for (let i = 0; i < game.heroscapeGamePlayers.length; i++) {
					const gamePlayer = game.heroscapeGamePlayers[i];
					
					var playerDiv = createDiv({});
					reportForm.appendChild(playerDiv);
					
					var playerLabel = createLabel({
						innerHTML: gamePlayer.player.name + ": "
					});
					playerDiv.appendChild(playerLabel);
					var playerSelect = createSelect({
						class: "gameSelect_"+game.id
					});
					playerLabel.appendChild(playerSelect);
					$(playerSelect).data("gamePlayer", gamePlayer)
					playerSelect.appendChild(createOption({
						value: "-1",
						innerHTML: "-- Rank --"
					}));
					for (let j = 0; j < game.heroscapeGamePlayers.length; j++) {
						playerSelect.appendChild(createOption({
							value: (j+1),
							innerHTML: (j+1)
						}));
					}
				}				
			}
			
			reportForm.appendChild(createButton({
				innerHTML: "Submit",
				onclick: "submitGameResult("+game.id+")"
			}));
		}
		
		function toggleGameResultPoints(gameId) {
			var element = document.getElementById("PartialPointsDiv_"+gameId);
			if (element.style.display == "block") {
				element.style.display = "none";
			} else {
				element.style.display = "block";
			}			
		}
		
		function showSubmitGame(gameId) {
			document.getElementById("reportFormDiv_"+gameId).style.display = "block";
			document.getElementById("reportResultButton_"+gameId).style.display = "none";
		}
		
		function submitGameResult(gameId) {
			var parentElem = document.getElementById("reportFormDiv_"+gameId);
			var game = $(parentElem).data("game");
			var gamePlayers = [];
			
			if (currentTournament.maxNumPlayersPerGame == 2) {
				var selectElem = document.getElementById("reportFormSelect_"+gameId);
				var selectedOption = selectElem.options[selectElem.selectedIndex];
				if (selectedOption.value >= 0) {				
					var wentToTime = false;
					var player1PointsLeft = null;
					var player2PointsLeft = null;
					var togglePointsCheckbox = document.getElementById("togglePointsCheckbox_"+gameId);
					if (togglePointsCheckbox.checked) {
						var player1Points = document.getElementById("player1Points_"+gameId).value;
						var player2Points = document.getElementById("player2Points_"+gameId).value;
						
						if (player1Points.length == 0) {
							alert("You must enter the # of points Player 1 had remaining.");
							return;
						}
						if (player2Points.length == 0) {
							alert("You must enter the # of points Player 2 had remaining.");
							return;
						}
						
						wentToTime = true;
						player1PointsLeft = parseInt(player1Points);
						player2PointsLeft = parseInt(player2Points);					
					}
					gamePlayers.push({
						id: game.heroscapeGamePlayers[0].id,
						name: game.heroscapeGamePlayers[0].name,
						playerID: game.heroscapeGamePlayers[0].player.id,
						result: selectedOption.value == 1
							? 2
							: selectedOption.value == 2 
								? 0
								: 1,
						pointsLeft: player1PointsLeft
					});
					gamePlayers.push({
						id: game.heroscapeGamePlayers[1].id,
						name: game.heroscapeGamePlayers[1].name,
						playerID: game.heroscapeGamePlayers[1].player.id,
						result: selectedOption.value == 1
							? 0
							: selectedOption.value == 2 
								? 2
								: 1,
						pointsLeft: player2PointsLeft
					});
				} else {
					alert('You must choose a winner');
					return;
				}
			} else { // Multiplayer case 
				var selects = document.getElementsByClassName("gameSelect_"+game.id);
				
				for (let i = 0; i < selects.length; i++) {
					const select = selects[i];
					const gamePlayer = $(select).data("gamePlayer");
					const rank = parseInt(select.options[select.selectedIndex].value);
					
					if (rank <= 0) {
						alert('You must assign each player a rank.');
						return;
					}
					
					gamePlayers.push({
						id: gamePlayer.id,
						name: gamePlayer.player.name,
						playerID: gamePlayer.player.id,
						rank: rank,
						pointsLeft: null
					});
				}
			}
			
			// Send to server
			socket.emit("submitGameResult", 
				JSON.stringify({
					game: {
						id: game.id, 
						round: {
							id: game.round.id,
							name: game.round.name,
							order: game.round.order,
							tournament: {
								id: game.round.tournament.id}
							},
						map: {
							id: game.map.id,
							name: game.map.name,
							number: game.map.number
						},
						wentToTime: wentToTime,
						heroscapeGamePlayers: gamePlayers,	
					}/*, 
					winnerValue: selectedOption.value*/}));
					
			// Clean up locally 
			parentElem.style.display = "none";
		}
		
		function _editResultRoundSelectChanged(refThis) {
			const roundIdx = refThis.options[refThis.selectedIndex].value;
			
			var gameSelectDiv = document.getElementById("editResultsGameSelectDiv");
			gameSelectDiv.innerHTML = "";
			document.getElementById("editResultsFormDiv").innerHTML = "";
			
			if (roundIdx >= 0) {
				const round = currentTournament.rounds[roundIdx];
				
				var gameSelect = createSelect({
					onchange: "_editResultGameSelectChanged(this)"
				});
				gameSelectDiv.appendChild(gameSelect);
				gameSelect.appendChild(createOption({
					innerHTML: "-- Choose Game --",
					value: -1
				}));
				
				for (let i = 0; i < round.games.length; i++) {
					const game = round.games[i];
					if (game.heroscapeGamePlayers.length >= 2) {
						var label = "";
						for (let j = 0; j < game.heroscapeGamePlayers.length; j++) {
							if (label.length > 0) {
								label += " v. ";
							}
							label += game.heroscapeGamePlayers[j].player.name
						}
						label += " on " + game.map.name + " " + game.map.number;
						
						gameSelect.appendChild(createOption({
							innerHTML: label,
							value: game.id
						}));
					}
				} 
			}
		}
		
		function _editResultGameSelectChanged(refThis) {
			const gameId = refThis.options[refThis.selectedIndex].value;
			
			var formDiv = document.getElementById("editResultsFormDiv");
			formDiv.innerHTML = "";
			
			if (gameId > 0) {
				var game = null;
				for (let i = 0; i < Game.list.length; i++) {
					if (Game.list[i].id == gameId) {
						game = Game.list[i];
						break;
					}
				}
				if (game != null) {
					_createReportForm(formDiv, game);
				}
			}
		}
		
		function refreshAdmin() {
			var parentElem = document.getElementById("Admin");
			parentElem.innerHTML = "";
			
			if ( ! isAdmin) {
				return;
			}
			
			parentElem.appendChild(createH2({innerHTML: "Admin Actions"}));
			
			//const startTime = createDate(currentTournament.startTime);
			const now = new Date();
			
			var topActionsDiv = createDiv({});
			parentElem.appendChild(topActionsDiv);
			
			// Pair/Cancel Round
			if (currentTournament.started) {
				if (currentRound == null) {
					topActionsDiv.appendChild(createButton({
						class: "adminActionButton",
						innerHTML: "Pair Next Round", 
						onclick: "pairNextRound();"}));
				} else {
					topActionsDiv.appendChild(createButton({
						class: "adminActionButton",
						innerHTML: "Cancel Current Round", 
						onclick: "cancelCurrentRound();"}));
				}
			}
			
			// Google Sheet Link
			var sheetLinkDiv = createDiv({class: 'inlineBlockDiv'});
			topActionsDiv.appendChild(sheetLinkDiv);
			sheetLinkDiv.appendChild(createA({
				innerHTML: "Google Sheet", 
				target: "_blank", 
				href: "https://docs.google.com/spreadsheets/d/"+currentTournament.sheetId}));
			
			// Help Link
			topActionsDiv.appendChild(createA({
				innerHTML: "Help / Documentation", 
				href: "/about/tournaments#TD", 
				target: "_blank"}));

			// Announcement
			/*var adminColumnDiv4 = createDiv({id: "announcementDiv"});
			parentElem.appendChild(adminColumnDiv4);
			adminColumnDiv4.appendChild(createH3({innerHTML: "Make Announcement"}));
			adminColumnDiv4.appendChild(createTextarea({
				id: "announcementTextarea"
			}));
			adminColumnDiv4.appendChild(createButton({
				innerHTML: "Announce!",
				type: "button",
				onclick: "_makeAnnouncement()"
			}));
			adminColumnDiv4.appendChild(createButton({
				innerHTML: "Clear",
				type: "button",
				onclick: "_clearAnnouncement()"
			}));*/
			parentElem.appendChild(createDiv({id: "Announcement"}));
			_displayAnnouncementSection();
			
			var leftColumn = createDiv({class: "adminColumnDiv"});
			parentElem.appendChild(leftColumn);
			_createAddPlayerDiv(leftColumn);
			_createPlayerActiveStatusDiv(leftColumn, now);
			if (currentTournament.rounds.length == 0) {
				_createDropDiv(leftColumn, now);
			}
			_createEditGameResultDiv(leftColumn, now);
			_createAddBracketDiv(leftColumn, now);
			_createEditTournamentDiv(leftColumn);
			
			var rightColumn = createDiv({class: "adminColumnDiv"});
			parentElem.appendChild(rightColumn);
			if ( ! currentTournament.started) {
				_createStartTournamentDiv(rightColumn);
			} else if ( ! currentTournament.finished) {
				_createFinishTournamentDiv(rightColumn);
			}
			_createMapsDiv(rightColumn);
		}
		
		function _createAddPlayerDiv(parentElem) {
			var addPlayerDiv = createDiv({class: "adminActionDiv"});
			parentElem.appendChild(addPlayerDiv);
			addPlayerDiv.appendChild(createH3({innerHTML: "Add (Non-User) Player"}));
			var nameLabel = createLabel({innerHTML: "Name: "});
			addPlayerDiv.appendChild(nameLabel);
			nameLabel.appendChild(createInput({
				id: "addPlayerNameInput",
				type: "text",
				required: true,
			}));
			for (let i = 0; i < currentTournament.numArmies; i++) {
				var armyLabel = createLabel({innerHTML: "Army #" + (i+1) + ": "});
				addPlayerDiv.appendChild(armyLabel);
				armyLabel.appendChild(createInput({
					id: "addPlayerArmyInput_"+i,
					type: "text",
					required: true
				}));
			}
			addPlayerDiv.appendChild(createButton({
				type: "button",
				onclick: "_createNewPlayer()",
				innerHTML: "Create"
			}));
			addPlayerDiv.appendChild(createButton({
				type: "button",
				onclick: "_clearNewPlayer()",
				innerHTML: "Clear"
			}));
		}
		
		function _createDropDiv(parentElem, now) {
			var dropDiv = createDiv({class: "adminActionDiv"});
			parentElem.appendChild(dropDiv);
			dropDiv.appendChild(createH3({innerHTML: "Drop Player"}));
			var dropSelect = createSelect({
				id: "hardDropSelect", 
				onclick: "dropPlayer(this);"});
			dropDiv.appendChild(dropSelect);
			dropSelect.appendChild(createOption({innerHTML: "-- Select Player --", value: "-1"}));
			for (let i = 0; i < currentTournament.players.length; i++) {
				var player = currentTournament.players[i];
				var option = createOption({
					innerHTML: player.name, 
					value: player.id});
				$(option).data("player", player);
				dropSelect.appendChild(option);
			}
			dropDiv.appendChild(createDiv({id: "hardDropPlayerButtonDiv"}));
		}
		
		function _createPlayerActiveStatusDiv(parentElem, now) {
			var dropUndropDiv = createDiv({class: "adminActionDiv"});
			parentElem.appendChild(dropUndropDiv);
			dropUndropDiv.appendChild(createH3({innerHTML: "De-Activate/Activate Player"}));
			var dropSelect = createSelect({
				id: "dropSelect", 
				onchange: "togglePlayerActiveStatus(this);"});
			dropUndropDiv.appendChild(dropSelect);
			dropSelect.appendChild(createOption({innerHTML: "-- Select Player --", value: "-1"}));
			for (let i = 0; i < currentTournament.players.length; i++) {
				var player = currentTournament.players[i];
				var option = createOption({
					innerHTML: player.name, 
					value: player.id});
				$(option).data("player", player);
				dropSelect.appendChild(option);
			}
			dropUndropDiv.appendChild(createDiv({id: "dropPlayerButtonDiv"}));
		}
		
		function _createEditGameResultDiv(parentElem, now) {
			var editGameDiv = createDiv({class: "adminActionDiv"});
			parentElem.appendChild(editGameDiv);
			editGameDiv.appendChild(createH3({innerHTML: "Edit Game Result"}));
			if (currentTournament.started) {
				var roundSelect = createSelect({
					onchange: "_editResultRoundSelectChanged(this)",
					id: "editResultsRoundSelect"
				});
				editGameDiv.appendChild(roundSelect);
				roundSelect.appendChild(createOption({
					innerHTML: "-- Choose Round --",
					value: -1
				}));
				for (let i = 0; i < currentTournament.rounds.length; i++) {
					var roundOption = createOption({
						innerHTML: currentTournament.rounds[i].name,
						value: i
					});
					roundSelect.appendChild(roundOption);
				}
				editGameDiv.appendChild(createDiv({id: "editResultsGameSelectDiv"}));
				editGameDiv.appendChild(createDiv({id: "editResultsFormDiv"}));				
			}
		}
		
		function _createAddBracketDiv(parentElem, now) {
			if (currentTournament.maxNumPlayersPerGame > 2) {
				return;
			}
			if (currentTournament.started && currentTournament.bracket == null) {
				var createBracketDiv = createDiv({class: "adminActionDiv"});
				parentElem.appendChild(createBracketDiv);
				createBracketDiv.appendChild(createH3({innerHTML: "Create Bracket"}));
				
				var label1 = createLabel({innerHTML: "# Players Included: "});
				createBracketDiv.appendChild(label1);
				label1.appendChild(createInput({
					type: "number",
					min: 0,
					step: 1,
					id: "bracket_size"
				}));
				
				var label2 = createLabel({innerHTML: "Re-Seed Each Round: "});
				createBracketDiv.appendChild(label2);
				label2.appendChild(createInput({
					type: "checkbox",
					id: "bracket_reSeedEachRound"
				}));
				
				createBracketDiv.appendChild(createButton({
					class: "adminActionButton",
					type: "button",
					innerHTML: "Create Bracket",
					onclick: "_createBracket();"
				}));
			}
		}
		
		function _createEditTournamentDiv(parentElem) {
			var editSectionDiv = createDiv({});
			parentElem.appendChild(editSectionDiv);
			
			editSectionDiv.appendChild(createH3({innerHTML: "Edit Tourney Details"}));
			
			editSectionDiv.appendChild(createButton({
				type: "button",
				id: "ShowEditTournamentButton",
				innerHTML: "Show / Edit Details",
				onclick: "_showEditTournament()"
			}));
			
			var editDiv = createDiv({id: "EditTournament"});
			editSectionDiv.appendChild(editDiv);
			currentTournament.display("EditTournament");
		}
		
		function _showEditTournament() {
			var editDiv = document.getElementById('EditTournament');
			var button = document.getElementById('ShowEditTournamentButton');
			
			if (button.innerHTML == "Show / Edit Details") {
				editDiv.style.display = "block";
				button.innerHTML = "Hide Details";
			} else {
				editDiv.style.display = "none";
				button.innerHTML = "Show / Edit Details";
			}
		}
		
		function _createStartTournamentDiv(parentElem) {
			var startDiv = createDiv({class: "adminActionDiv"});
			parentElem.appendChild(startDiv);
			startDiv.appendChild(createH3({innerHTML: "Tournament State"}));
			startDiv.appendChild(createButton({
				innerHTML: "Start Tournament",
				onclick: "_startTournament()"
			}));
		}
		
		function _createFinishTournamentDiv(parentElem) {
			var finishDiv = createDiv({class: "adminActionDiv"});
			parentElem.appendChild(finishDiv);
			finishDiv.appendChild(createH3({innerHTML: "Tournament State"}));
			finishDiv.appendChild(createButton({
				innerHTML: "Finish Tournament",
				onclick: "_finishTournament()"
			}));
		}
		
		function _createRestartTournamentDiv(parentElem) {
			var restartDiv = createDiv({class: "adminActionDiv"});
			parentElem.appendChild(restartDiv);
			restartDiv.appendChild(createH3({innerHTML: "Tournament State"}));
			restartDiv.appendChild(createButton({
				innerHTML: "Resume Tournament",
				onclick: "_restartTournament()"
			}));
		}
		
		function _startTournament() {
			if (confirm("Are you sure you want to start the tournament?")) {
				socket.emit("startTournament", JSON.stringify({}));
			}
		}
		
		function _finishTournament() {
			if (confirm("Are you sure you want to finish the tournament?")) {
				socket.emit("finishTournament", JSON.stringify({}));
			}
		}
		
		function _restartTournament() {
			if (confirm("Are you sure you want to re-start the tournament?")) {
				socket.emit("restartTournament", JSON.stringify({}));
			}
		}
		
		function _createMapsDiv(parentElem) {
			var mapsDiv = createDiv({class: "adminActionDiv"});
			parentElem.appendChild(mapsDiv);
			mapsDiv.appendChild(createH3({innerHTML: "Maps"}));
			mapsDiv.appendChild(createDiv({id: "create-GameMap"}));
			mapsDiv.appendChild(createDiv({id: "edit-GameMap"}));
			GameMap.fetchAndDisplay(
				"edit-GameMap", 
				{tournament: currentTournament},
				{joins: {}}, 
				null, 
				null);
			GameMap.createAddSection(
				"create-GameMap", 
				{targetDivID: "edit-GameMap", 
					sectionDivID: "GameMap-tournament_"+currentTournament.id,
					implicitClasses: {tournament: currentTournament}},
				null,
				null,
				null,
				function() {
					var inputElem = document.getElementById("GameMap-edit-name");
					HeroscapeMap.loadDatalist("name", function(names) {
						inputElem.setAttribute('list', 'HeroscapeMap_name_Datalist');
					});
				}
			);
		}
		
		function _createNewPlayer() {
			if (confirm("Are you sure you want to add this player?")) {
				var playerNameInput = document.getElementById("addPlayerNameInput");
				if ( ! playerNameInput.reportValidity()) {
					return;
				}
				var player = {
					name: playerNameInput.value,
					armies: []
				};
				for (let i = 0; i < currentTournament.numArmies; i++) {
					var armyInput = document.getElementById("addPlayerArmyInput_"+i);
					if ( ! armyInput.reportValidity()) {
						return;
					}
					player.armies.push({
						army: armyInput.value,
						armyNumber: i+1
					});
				}
				socket.emit("createNonUserPlayer", JSON.stringify({player: player}));
			}
		}
		
		function _clearNewPlayer(ask=true) {
			if ( ! ask || confirm("Are you sure you want to clear this form?")) {
				document.getElementById("addPlayerNameInput").value = "";
				for (let i = 0; i < currentTournament.numArmies; i++) {
					document.getElementById("addPlayerArmyInput_"+i).value = "";
				}
			}
		}
		
		function _claimMap(mapId) {
			socket.emit("claimMap", JSON.stringify({gameMap: {id: mapId}}));
		}
		
		function _unClaimMap(mapId) {
			socket.emit("unClaimMap", JSON.stringify({gameMap: {id: mapId}}));
		}
		
		function _emitAnnouncement(announcement) {
			socket.emit("tournamentAnnouncement",
				JSON.stringify({
					tournament: {
						id: currentTournament.id,
						name: currentTournament.fullDisplayName()
					},
					announcement: announcement
				})
			);
		}
		
		function dropPlayer(refThis) {
			var option = refThis.options[refThis.selectedIndex];
			
			var targetDiv = document.getElementById("hardDropPlayerButtonDiv");
			targetDiv.innerHTML = "";
			
			if (option.value > 0) {
				var player = $(option).data("player");
				
				targetDiv.appendChild(createButton({
					innerHTML: "Drop Player", 
					onclick: "_dropPlayer("+player.id+")"}));
					
			} 	
		}
		
		function _dropPlayer(playerId) {
			if (confirm("Are you sure you want to completely remove this player?")) {
				socket.emit("dropPlayer", 
					JSON.stringify({
						player: {
							id: playerId},
						tournament: {
							id: currentTournament.id
						}}));
				var selectElem = document.getElementById("hardDropSelect");
				selectElem.selectedIndex = 0;
				dropPlayer(selectElem);
			}
		}
		
		function togglePlayerActiveStatus(refThis) {
			var option = refThis.options[refThis.selectedIndex];
			
			var targetDiv = document.getElementById("dropPlayerButtonDiv");
			targetDiv.innerHTML = "";
			
			if (option.value > 0) {
				var player = $(option).data("player");
				
				if (player.active) {
					targetDiv.appendChild(createButton({innerHTML: "Make Inactive", onclick: "markPlayerInactive("+player.id+")"}));
				} else {
					targetDiv.appendChild(createButton({innerHTML: "Make Active", onclick: "markPlayerActive("+player.id+")"}));
				}		
			} 			
		}
		
		function markPlayerInactive(playerId) {
			if (confirm("Are you sure you want to mark this player inactive?")) {
				socket.emit("markPlayerInactive", 
					JSON.stringify({
						player: {
							id: playerId},
						tournament: {
							id: currentTournament.id
						}}));
				var selectElem = document.getElementById("dropSelect");
				selectElem.selectedIndex = 0;
				togglePlayerActiveStatus(selectElem);
			}
		}
		
		function markPlayerActive(playerId) {
			if (confirm("Are you sure you want to mark this player active?")) {
				socket.emit("markPlayerActive", 
					JSON.stringify({
						player: {
							id: playerId},
						tournament: {
							id: currentTournament.id
						}}));
				var selectElem = document.getElementById("dropSelect");
				selectElem.selectedIndex = 0;
				togglePlayerActiveStatus(selectElem);
			}
		}
		
		function pairNextRound() {
			if (confirm("Are you sure you are ready to pair the next round?")) {
				socket.emit("pairNextRound", 
					JSON.stringify({
						tournament: {
							id: currentTournament.id,
							name: currentTournament.fullDisplayName(),
							numLossesToBeEliminated: currentTournament.numLossesToBeEliminated,
							pairAfterEliminated: currentTournament.pairAfterEliminated,
							roundLengthMinutes: currentTournament.roundLengthMinutes,
							maxNumPlayersPerGame: currentTournament.maxNumPlayersPerGame}}));
			}
		}
		
		function _createBracket() {
			if (confirm("Are you sure you wish to create a single-elimination bracket?")) {
				var bracket = {
					reSeedEachRound: document.getElementById("bracket_reSeedEachRound").checked,
					size: document.getElementById("bracket_size").value
				};
				socket.emit('createBracket', JSON.stringify({bracket: bracket}));
			}
		}
		
		function cancelCurrentRound() {
			if (confirm("Are you sure you want to CANCEL the current round? All pairings & results will be lost.")) {
				socket.emit("cancelCurrentRound",
					JSON.stringify({
						tournament: {
							id: currentTournament.id}}));
			}			
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(EventsNav); ?>
	
	<div id='pageContent'>		
		<article>	
			<div id='HeroscapeTournament'>
				<div id='TournamentInfoDiv'></div>
			</div>
			
			<div id='DisplayTournament'>
				<div id='MyArmy'></div>
				<div id='CurrentRound'></div>
				<div id='Bracket'></div>
				<div id='Standings'></div>
				<div id='MapImages'></div>
				<div id='ShowGameData'>
					<button onclick='showGameData()'>Show Round/Game Results</button>
				</div>
				<div id='GameData'></div>
				<div id='Admin'></div>
			</div>
			
			<script>
				const tournamentID = findGetParameter("Tournament");
				if (tournamentID != null) {
					/*Heroscape*/Tournament.load(
						{id: tournamentID},
						function (tournaments) {
							if (tournaments.length == 1) {
								currentTournament = tournaments[0];
																
								writeTournamentInfo(currentTournament, true, true);
								
								document.getElementsByTagName("title")[0].innerHTML = currentTournament.fullDisplayName();
								displayTournament();
								refreshAdmin();
								//if ( ! currentTournament.finished) {
									HeroscapeMap.load(
										{},
										function (hsMaps) {
											displayTournament();
										},
										{joins: {
											
										}});
								//}
							} else {
								document.getElementById("HeroscapeTournament").appendChild(
									createP({
										innerHTML: "There was an error loading this page; " +
											"make sure you used a valid link to reach this page."}));
							}
						},
						{joins: {
							"figureSetID": {},
							"conventionID": {
								"conventionSeriesID": {}
							},
							"Player.tournamentID": {
								"PlayerArmy.playerID": {
									"PlayerArmyCard.playerArmyID": {
										"cardID": {}
									}
								},
								"teamCaptainID": {
									"userID": {},
									"tournamentID": {}
								},
								"userID": {}
							},
							"Round.tournamentID": {
								"HeroscapeGame.roundID": {
									"mapID": {},
									"HeroscapeGamePlayer.gameID": {
										"playerID": {}
									}
								}
							},
							"GameMap.tournamentID": {
								"GameMapGlyph.gameMapID": {
									"glyphID": {}
								},
								"broughtByUserID": {}
							},
							"bracketID": {
								"BracketEntry.bracketID": {
									"playerID": {
										"tournamentID": {}
									}
								}
							},
							"TournamentSeasonLink.tournamentID": {
								"seasonID": {
									"leagueID": {}
								}
							},
							"TournamentFormatTag.tournamentID": {
								"formatID": {}
							},
							"TournamentIncludesFigureSetSubGroup.tournamentID": {
								"figureSetSubGroupID": {}
							}
					}});
				} else {
					document.getElementById("HeroscapeTournament").appendChild(
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