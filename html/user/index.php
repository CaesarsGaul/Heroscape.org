<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>User</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		article {
			max-width: 1025px;
		}
	
		th {
			padding-left: 10px;
			padding-right: 10px;
		}
		
		#User {
			display: inline-block;
			text-align: left;
		}
		
		#Record {
			text-align: center;
		}
		
		h2 {
			text-align: center;
		}
		
		.column {
			display: inline-block;
			max-width: 500px;
			vertical-align: top;
		}
		
		#MapsDiv {
			vertical-align: top;
		}
		
		.mapDiv {
			display: inline-block;
			margin: 10px;
			vertical-align: top;
			max-width: 230px;
		}
		
		.mapDiv a {
			display: block;
			text-align: center;
		}
		
		.mapImg {
			width: 225px;
		}
		
		.gameOpponents, .gameMap, .gameLink {
			margin-left: 30px;
		}
		
		#UserSettingsDiv {
			display: none;
		}
		
		.userSetting {
			display: inline-block;
			vertical-align: top;
			border: 1px solid black;
			border-radius: 10px;
			margin-left: 5px;
			margin-right: 5px;
			margin-top: 5px;
			margin-bottom: 5px;
			padding: 10px;
		}
		
		.userSetting h3 {
			margin: 0;
		}
		
		
		
		
.toggle {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
         
        /* Hide the checkbox input */
        .toggle input {
            display: none;
        }
         
        /* Describe slider's look and position. */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: gray;
            transition: .4s;
            border-radius: 34px;
        }
         
        /* Describe the white ball's location 
              and appearance in the slider. */
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
         
        /* Modify the slider's background color to 
              green once the checkbox has been selected. */
        input:checked+.slider {
            background-color: green;
        }
         
        /* When the checkbox is checked, shift the 
              white ball towards the right within the slider. */
        input:checked+.slider:before {
            transform: translateX(26px);
        }
		
		#UserCollectionDiv {
			display: none;
		}
		
		.userCollectionTerrainSet {
			margin-bottom: 5px;
		}
		
		.userCollectionTerrainSet input[type=number] {
			width: 40px;
			margin-right: 10px;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	<script src="/connect/socket.io/socket.io.js"></script>
	
	<script>
		HeroscapeMap.options.fieldsToInclude = ["name", "authorName", "buildInstructionsUrl", "imageUrl", "numberOfPlayers", "ohsGdocId"];
		HeroscapeMap.options.linksToInclude = ["heroscapeMapSets", "tags"];
		HeroscapeMap.options.labelsToIgnore = ["name"];
		
		HeroscapeMapSet.options.fieldsToInclude = ["terrainSet", "quantity"];
		HeroscapeMapSet.options.multiLevelEditsToSkip = ["create"];
		
		socket = null;
		function createSocket() {
			if (socket != null) {
				return;
			}
			
			socket = io.connect("/", {path: "/connect/socket.io"});
			
			socket.on("tbd", function(objStr) {
				
			});
		}
		createSocket();
		
		var _displayUserSettingsCallCounter = 0;
		function displayUserSettings() {
			_displayUserSettingsCallCounter++;
			if (_displayUserSettingsCallCounter == 2) {
				var parentElem = document.getElementById("DisplayUserSettingsDiv");
				
				for (let i = 0; i < UserSetting.list.length; i++) {
					const userSetting = UserSetting.list[i];
					var settingDiv = createDiv({class: "userSetting"});
					parentElem.appendChild(settingDiv);
					
					settingDiv.appendChild(createH3({innerHTML: userSetting.name}));
					
					var userSettingTag = null;
					for (let j = 0; j < UserSettingTag.list.length; j++) {
						const tag = UserSettingTag.list[j];
						if (tag.userSetting.id == userSetting.id) {
							userSettingTag = tag;
							break;
						}
					}
					
					switch (userSetting.dataType) {
						case "string":
							
							break;
						case "list{string}":					
							var select = createSelect({
								id: "UserSetting_" + userSetting.id,
								name: "UserSetting_" + userSetting.id,
								onchange: "toggleUserSetting(" + userSetting.id + ")"
							});
							settingDiv.appendChild(select);
							select.appendChild(createOption({
								innerHTML: "-- Select --",
								value: -1
							}));
							for (let j = 0; j < userSetting.userSettingOptions.length; j++) {
								const settingOption = userSetting.userSettingOptions[j];
								var option = createOption({
									innerHTML: settingOption.name,
									value: settingOption.name
								});
								select.appendChild(option);
								if (userSettingTag !== null && userSettingTag.data == settingOption.name) {
									option.setAttribute('selected', '');
								}
							}
							break;
						case "boolean": 
							var label = createLabel({class: "toggle"});
							settingDiv.appendChild(label);
							var checkbox = createInput({
								id: "UserSetting_" + userSetting.id,
								type: 'checkbox',
								name: "UserSetting_" + userSetting.id,
								onchange: "toggleUserSetting(" + userSetting.id + ")"
							});
							label.appendChild(checkbox);
							var sliderSpan = createSpan({
								class: "slider"
							});
							label.appendChild(sliderSpan);
							var checked = false;
							if (userSettingTag !== null && userSettingTag.data == 1) {
								checked = true;
							}
							if (checked) {
								checkbox.setAttribute('checked', '');
							}
							break;
					}
				}				
			}
		}
		
		function displayUserCollection() {
			var terrainCollectionDiv = document.getElementById("UserCollectionTerrainSet");
			
			if (loggedInUserName == userName) {
				document.getElementById("UserCollectionDiv").style.display = "block";
			} else {
				return;
			}
			
			for (let i = 0; i < HeroscapeSet.list.length; i++) {
				const heroscapeSet = HeroscapeSet.list[i];
				var setDiv = createDiv({class: "userCollectionTerrainSet"});
				terrainCollectionDiv.appendChild(setDiv);
				
				var inputValue = 0;
				for (let j = 0; j < UserCollectionHeroscapeSet.list.length; j++) {
					const userCollectionEntry = UserCollectionHeroscapeSet.list[j];
					if (userCollectionEntry.heroscapeSet.id == heroscapeSet.id) {
						inputValue = userCollectionEntry.quantity;
					}
				}
				
				setDiv.appendChild(createInput({
					type: "number",
					value: inputValue,
					min: 0,
					onchange: "updateUserCollectionHeroscapeSet(this,"+heroscapeSet.id+")"
				}));
				setDiv.appendChild(createText(heroscapeSet.name));
			}
		}
		
		function updateUserCollectionHeroscapeSet(refThis, heroscapeSetId) {
			const newQuantity = refThis.value;
			
			socket.emit("updateUserCollectionHeroscapeSet", JSON.stringify({
				heroscapeSet: {
					id: heroscapeSetId
				},
				quantity: newQuantity
			}));
		}
		
		function toggleUserSetting(userSettingId) {
			var inputElem = document.getElementById("UserSetting_" + userSettingId);
			
			var userSetting = null;
			for (let i = 0; i < UserSetting.list.length; i++) {
				if (userSettingId == UserSetting.list[i].id) {
					userSetting = UserSetting.list[i];
					break;
				}
			}
			if (userSetting != null) {
				var userSettingTag = null;
				for (let i = 0; i < UserSettingTag.list.length; i++) {
					if (UserSettingTag.list[i].userSetting.id == userSetting.id) {
						userSettingTag = UserSettingTag.list[i];
						break;
					}
				}
				if (userSettingTag === null) {
					userSettingTag = new UserSettingTag();
					userSettingTag.user = User.list[0];
					userSettingTag.userSetting = userSetting;
				}
				
				switch (userSetting.dataType) {
					case "string":
						
						break;
					case "list{string}":
						var selectedOption = inputElem.options[inputElem.selectedIndex];
						userSettingTag.data = selectedOption.value;
						break;
					case "boolean":
						userSettingTag.data = inputElem.checked
							? 1
							: 0;
						break;
				}
				
				if (userSettingTag.id === null) {
					userSettingTag._serverCreate({}, function(serverObj) {
						// Do Nothing
					});
				} else {
					userSettingTag._serverUpdate();
				}
			}
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>	
		<h1 id='h1'></h1>
		<article>	
			<div id='User'>
				<div class='column'>
					<h2>Current Games</h2>
					<div id='CurrentGamesDiv'></div>
					
					<h2>Tournaments</h2>
					<div id='TournamentsDiv'>
						<div id='RecordDiv'></div>
						<h3>Current</h3>
						<div id='CurrentTournamentsDiv'></div>
						<h3>Upcoming</h3>
						<div id='UpcomingTournamentsDiv'></div>
						<h3>Past</h3>
						<div id='PastTournamentsDiv'></div>
					</div>
				</div>
				<div class='column'>
					<h2>Maps</h2>
					<div id='MapsDiv'></div>
					<div id='CreateMapDiv'></div>
					<div id='UserCollectionDiv'>
						<h2>My Collection</h2>
						<div id='UserCollectionTerrainSet'></div>
					</div>
					<div id='UserSettingsDiv'>
						<h2>User Settings</h2>
						<p>Note: You must log out and log back in for any user settings changes to take effect.</p>
						<div id='DisplayUserSettingsDiv'></div>
					</div>
				</div>
			</div>
			
			<script>	
				HeroscapeSet.load(
					{},
					null,
					{joins: {}}
				);
				HeroscapeMapTag.load(
					{},
					null,
					{joins: {}}
				);
				UserSetting.load(
					{},
					function() {
						displayUserSettings();
					},
					{joins: {
						"UserSettingOption.userSettingID": {}
					}}
				);
			
				var loggedInUserName = null;
				if (loggedIn()) {
					loggedInUserName = decodeURIComponent(getCookieValue("hs_username"));
				}
			
				var userName = findGetParameter("userName");
				if (userName !== undefined && userName !== null) {
					User.load(
						{userName: userName},
						function (users) {
							if (users.length == 1) {
								const user = users[0];
								
								document.getElementById("h1").innerHTML = user.userName;
								
								var wins = 0;
								var losses = 0;
								var ties = 0;
								for (let i = 0; i < user.players.length; i++) {
									const player = user.players[i];
									const tournament = player.tournament;
									for (let j = 0; j < player.heroscapeGamePlayers.length; j++) {
										const gamePlayer = player.heroscapeGamePlayers[j];
												
										if (tournament.maxNumPlayersPerGame == 2) {
											if (gamePlayer.result == 2) {
												wins++;
											} else if (gamePlayer.result == 0) {
												losses++;
											} else if (gamePlayer.result == 1) {
												ties++;
											}
										} else {
											// TODO - handle multiplayer
										}
									}	
								}			
								
								var currentGamesDiv = document.getElementById("CurrentGamesDiv");
								var currentTournamentsDiv = document.getElementById("CurrentTournamentsDiv");
								var upcomingTournamentsDiv = document.getElementById("UpcomingTournamentsDiv");
								var pastTournamentsDiv = document.getElementById("PastTournamentsDiv");
								document.getElementById("RecordDiv").appendChild(createP({id: "Record", innerHTML: "Record: " + wins + "-" + losses + "-" + ties}));
								
								for (let i = 0; i < Tournament.list.length; i++) {
									const tournament = Tournament.list[i];
									
									var tournamentDiv = createDiv({});
									if (tournament.finished) {
										pastTournamentsDiv.prepend(tournamentDiv);
									} else if ( ! tournament.started) {
										upcomingTournamentsDiv.appendChild(tournamentDiv);
									} else {
										currentTournamentsDiv.appendChild(tournamentDiv);
										
										if (tournament.rounds.length > 0) {
											tournament.rounds.sort(function (a, b) {
												if (a.order < b.order) {
													return -1;
												} else if (a.order > b.order) {
													return 1;
												}
												return 0;
											});
											const round = tournament.rounds[tournament.rounds.length-1];
											const game = round.games[0];
											
											var gameDiv = createDiv({});
											gameDiv.appendChild(createDiv({
												class: "gameTournamentName",
												innerHTML: tournament.name}));
											var opponentsDiv = createDiv({
												class: "gameOpponents"
											});
											gameDiv.appendChild(opponentsDiv);
											var opponents = "Opponent(s): ";
											for (let j = 0; j < game.heroscapeGamePlayers.length; j++) {
												const gamePlayer = game.heroscapeGamePlayers[j];
												const player = gamePlayer.player;
												if (player.name != userName) {
													if (opponents.length > 13) {
														opponents += ", ";
													}
													opponents += player.name
												}
											}
											opponentsDiv.appendChild(createText(opponents));
											if (game.map != null) {
												var mapDiv = createDiv({
													class: "gameMap"
												});
												gameDiv.appendChild(mapDiv);
												mapDiv.appendChild(createText("Map: " + game.map.name));
											}
											if (game.onlineUrl != null) {
												var urlDiv = createDiv({
													class: "gameLink"
												});
												gameDiv.appendChild(urlDiv);
												urlDiv.appendChild(createA({
													href: game.onlineUrl,
													target: "_blank",
													innerHTML: "Online Game Link"
												}));
											}
											currentGamesDiv.appendChild(gameDiv);
										}
									}
									
									tournamentDiv.appendChild(createA({
										href: "/events/tournament/?Tournament="+tournament.id,
										innerHTML: tournament.fullDisplayName()
									}));
								}
								
								if (userName == loggedInUserName) {
									document.getElementById("UserSettingsDiv").style.display = "block";
									displayUserSettings();
								}
								
								displayUserCollection();
								
							} else {
								document.getElementById("TournamentsDiv").innerHTML = 
									"No account found for that name";
							}
						},
						{joins: {
							"Player.userID": {
								"tournamentID": {
									"conventionID": {},
									"TournamentSeasonLink.tournamentID": {
										"seasonID": {
											"leagueID": {}
										}
									}
								},
								"HeroscapeGamePlayer.playerID": {
									"gameID": {
										"roundID": {
											"tournamentID": {
												
											}
										},
										"HeroscapeGamePlayer.gameID": {
											"playerID": {}
										},
										"mapID": {}
									}
								},
								"PlayerArmy.playerID": {}
							},
							"UserSettingTag.userID": {
								"userSettingID": {
									"UserSettingOption.userSettingID": {}
								}
							},
							"UserCollectionHeroscapeSet.userID": {
								"heroscapeSetID": {}
							}
					}});
					HeroscapeMap.load(
						{authorName: userName},
						function (maps) {							
							var parentElem = document.getElementById("MapsDiv");
							
							for (let i = 0; i < maps.length; i++) {
								const map = maps[i];
								
								var mapDiv = createDiv({
									class: "mapDiv"
								});
								parentElem.appendChild(mapDiv);
								
								mapDiv.appendChild(createA({
									href: "/map/view?HeroscapeMap="+map.id,
									target: "_blank",
									innerHTML: map.name
								}));
								
								mapDiv.appendChild(createImg({
									src: map.imageUrl,
									class: "mapImg"
								}));
							}
							
							// TODO
						},
						{joins: {
							"HeroscapeMapTagLink.mapID": {
								"tagID": {}
							},
							"HeroscapeMapSet.mapID": {
								"terrainSetID": {}
							}
						}});
						
					if (loggedInUserName === userName) {
						HeroscapeMap.createAddSection(
							"CreateMapDiv", 
							{});
					}
				} else {
					document.getElementById("User").innerHTML = "No user specified in URL.";
				}
			</script>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>