<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Convention</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/standings.css">
	<link rel="stylesheet" href="/css/announcement.css">
	<style>
		article {
			text-align: left;
			margin: 10px;
		}
		
		.conventionSection {
			display: inline-block;
			vertical-align: top;
			min-width: 200px;
			/*max-width: 200px;*/
			padding-left: 10px;
			padding-right: 10px;
		}
		
		#Tournaments {
			/*min-width: 300px;*/
		}
		
		.buttonA {
			display: inline-block;
			border: 1px solid black;
			border-radius: 5px;
			background-color: var(--primary_color);
			padding: 5px;
			color: inherit;
			text-decoration: none;
		}
		
		.infoP {
			text-align: center;
		}
		
		.tournamentLink {
			/*color: inherit;*/
			color: blue;
			text-decoration: none;
		}
		
		#Attendees {
			max-width: 250px;
		}
		
		.tournamentLink:before {
			color: black;
			 content: " • ";
		}
		
		#SoftCapDiv {
			border-top: 1px solid red;
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
		
		ConventionMap.options.fieldsToInclude = ["map", "quantity"];
		ConventionMap.options.linksToInclude = [];
		ConventionMap.options.labelsToIgnore = ["map"];
		
		HeroscapeMap.load(
			{},
			null,
			{joins: {}}
		);
		
		function createSocket() {
			socket = io.connect("/", {path: "/connect/socket.io"});
			
			// Sign-up Success Conditions
			socket.on('signedUpConvention', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				
				console.log(jsonObj);
				var attendee = new Attendee(jsonObj.attendee);
				console.log(attendee);
				
				_displayAttendeesSection();
			});
			
			// De-Register Success Condition
			socket.on('deRegisteredConvention', function(objStr) {
				location.reload();
			});
			
			// Sign-up Error Conditions
			socket.on('conventionFull', function(objStr) {
				alert("I'm sorry, but all spots for the convention have been taken already. " +
					"Contact the organizer of the convention if you feel this is an error.");
			});
			socket.on('invalidSignupKey', function(objStr) {
				alert("The sign-up key provided is incorrect. " +
					"Contact the organizer of the convention if you feel this is an error.");
			});
			socket.on('notLoggedIn', function(objStr) {
				alert("You must sign-in to sign-up for a convention.");
			});
			socket.on('alreadySignedUpForConvention', function(objStr) {
				alert("You're already signed-up for this convention; no need to do it again.");
			});
			socket.on('signUpConventionError', function(objStr) {
				alert("There was an unknown error signing up for the convention. " +
					"Contact Heroscape.org if the error persists.");
			});
			
			// De-Register Error Condition
			socket.on('deRegisterConventionError', function(objStr) {
				alert("There was an unknown error de-registering for the convention. " +
					"Contact Heroscape.org if the error persists.");
			});
			
			socket.on('dropUserFromConventionError', function(objStr) {
				alert('Unknown Error');
			});
			
			socket.on('userDropped', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				const removedUser = jsonObj.user;
				
				for (let i = 0; i < currentConvention.attendees.length; i++) {
					const attendee = currentConvention.attendees[i];
					const user = attendee.user;
					
					if (user.id == removedUser.id) {
						currentConvention.attendees.splice(i,1);
						break;
					}
				}
				displayConvention();
			});
		}

		currentConvention = null;
		isAdmin = false;
		function displayConvention(convention=null) {
			if (convention != null) {
				currentConvention = convention;
			}
			
			document.getElementById("h1").innerHTML = convention.name;

			document.getElementsByTagName("title")[0].innerHTML = currentConvention.name;
			
			_checkAdmin();
			
			createSocket();
			socket.emit("loadConvention", JSON.stringify({convention: {id: currentConvention.id}}));
			
			if (isAdmin) {
				_displayAnnouncementSection();
			}
			_displayInfoSection();
			_displayAttendeesSection();
			_displayTournamentsSection();
			_displayStandingsSection();
			_displayMapsSection();
		}
		
		function _checkAdmin() {
			if (loggedIn()) {
				const userName = decodeURIComponent(getCookieValue("hs_username"));
				for (let i = 0; i < currentConvention.admins.length; i++) {
					const adminUser = currentConvention.admins[i].user;
					if (adminUser.userName == userName) {
						isAdmin = true;
						return;
					}
				}
			}
		}
		
		function _displayInfoSection() {
			var infoDiv = document.getElementById("Info");
			infoDiv.innerHTML = "";
			
			var startDateParts = currentConvention.startDate.split("-");
			var endDateParts = currentConvention.endDate.split("-");
			var dateStr = "";
			dateStr += months[parseInt(startDateParts[1])-1] + " " + parseInt(startDateParts[2]) + ", " + startDateParts[0];
			dateStr += " - ";
			dateStr += months[parseInt(endDateParts[1])-1] + " " + parseInt(endDateParts[2]) + ", " + endDateParts[0];
			infoDiv.appendChild(createP({class: "infoP", innerHTML: dateStr}));
			
			if (currentConvention.address != null) {
				infoDiv.appendChild(createP({class: "infoP", innerHTML: currentConvention.address}));
			}
			
			if (currentConvention.description != null) {
				infoDiv.appendChild(createDiv({
					class: "infoP",
					innerHTML: currentConvention.description
				}));
			}
			
			/*if (currentConvention.conventionSeries != null) {
				infoDiv.appendChild(createP({class: "infoP", innerHTML: "Convention Series : " + currentConvention.conventionSeries.name}));
			}*/
			if (currentConvention.signupKey !== undefined && currentConvention.signupKey !== null) {
				infoDiv.appendChild(createP({class: "infoP", innerHTML: "Sign-up Key : " + currentConvention.signupKey}));
			}
		}
		
		function _displayAttendeesSection() {
			var attendeesDiv = document.getElementById("Attendees");
			attendeesDiv.innerHTML = "";
			attendeesDiv.appendChild(createH2({innerHTML: "Attendees"}));
			
			if (currentConvention.hardPlayerCap != null) {
				attendeesDiv.appendChild(createP({innerHTML: "Max " + currentConvention.hardPlayerCap + " Attendees"}))
			} else if (currentConvention.softPlayerCap != null) {
				attendeesDiv.appendChild(createP({innerHTML: "Max " + currentConvention.softPlayerCap + " Attendees (Plus Waitlist)"}))
			}
			
			if (loggedIn()) {
				var signedUp = false;
				var loggedInUserName = decodeURIComponent(getCookieValue("hs_username"));
				//var loggedInUserName = getCookieValue("hs_username").replaceAll("%20", " ").replaceAll("%2C", ",");
				for (let i = 0; i < currentConvention.attendees.length; i++) {
					const attendee = currentConvention.attendees[i];
					const user = attendee.user;
					if (loggedInUserName != null && loggedInUserName == user.userName) {
						signedUp = true;
					}
				}
				if (signedUp) {
					attendeesDiv.appendChild(createButton({
						innerHTML: "De-Register",
						onclick: "_deRegister();"
					}));
				} else {
					if (currentConvention.signupKey !== null) {
						var signupKeyLabelElem = createLabel({innerHTML: "Signup Key: "});
						signupKeyLabelElem.appendChild(createInput({
							id: "signupKeyInput",
							type: "text",
							required: "",
						}));
						attendeesDiv.appendChild(signupKeyLabelElem);
					}
					attendeesDiv.appendChild(createButton({
						innerHTML: "Signup",
						onclick: "_signup();"
					}));
					attendeesDiv.appendChild(createDiv({id: "signupFormDiv"}));
				}
			}
			for (let i = 0; i < currentConvention.attendees.length; i++) {
				var listNum = (i+1);
				if (currentConvention.softPlayerCap != null && i >= currentConvention.softPlayerCap) {
					if (i == currentConvention.softPlayerCap) {
						var softCapDiv = createDiv({
							id: "SoftCapDiv"
						});
						attendeesDiv.appendChild(softCapDiv);
						softCapDiv.appendChild(createH3({innerHTML: "Waitlist"}))
					}
					listNum = i - currentConvention.softPlayerCap + 1;
				}
				
				const attendee = currentConvention.attendees[i];
				const user = attendee.user;
				var attendeeP = createP({innerHTML: listNum+". "+user.userName});
				attendeesDiv.appendChild(attendeeP);
				if (isAdmin) {
					attendeeP.appendChild(createButton({
						innerHTML: "Drop",
						onclick: "_dropUser("+user.id+")"
					}))
				}
			}
		}
		
		function _dropUser(userID) {
			var user = null;
			for (let i = 0; i < User.list.length; i++) {
				if (User.list[i].id == userID) {
					user = User.list[i];
					break;
				}
			}
			if (confirm("Are you sure you want to remove '"+user.userName+"' from the Attendee list?")) {
				socket.emit("dropUserFromConvention", JSON.stringify({
					convention: {
						id: currentConvention.id,
						name: currentConvention.name
					},
					user: {
						id: userID,
						userName: user.userName
					}
				}));
			}
		}
		
		function _displayTournamentsSection() {
			var tournamentsDiv = document.getElementById("Tournaments");
			tournamentsDiv.innerHTML = "";
			tournamentsDiv.appendChild(createH2({innerHTML: "Tournaments"}));
			if (isAdmin) {
				tournamentsDiv.appendChild(createA({
					innerHTML: "Create Tournament",
					href: "/events/tournament/create/?Convention="+currentConvention.name+"&ConventionID="+currentConvention.id,
					class: "buttonA"
				}));
			}
			
			tournamentsDiv.appendChild(createP({innerHTML: "(All times are your local time)"}));
						
			currentConvention.tournaments = currentConvention.tournaments.sort( compareTourneys );
			var prevStartTime = null;
			for (let i = 0; i < currentConvention.tournaments.length; i++) {
				const tournament = currentConvention.tournaments[i];
				const startTimeStr = createDisplayDateStr(createDate(tournament.startTime));
				if (prevStartTime == null || prevStartTime != startTimeStr) {
					tournamentsDiv.appendChild(createH3({innerHTML: startTimeStr}));	
				}
				prevStartTime = startTimeStr;
				
				tournamentsDiv.appendChild(createA({
					innerHTML: tournament.name + " (" + tournament.players.length + ")" , 
					class: "tournamentLink",
					style: "display: block;",
					target: "_blank", 
					href: "/events/tournament/?Tournament="+tournament.id}));
			}
		}
		
		const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		function createDisplayDateStr(startTime) {
			var displayStr = "";
			displayStr += days[startTime.getDay()]; // Day of week
			displayStr += " ";
			displayStr += startTime.getHours() % 12 == 0
				? 12
				: startTime.getHours() % 12;
			if (startTime.getMinutes() > 0) {
				displayStr += ":";
				displayStr += startTime.getMinutes();
				if (startTime.getMinutes() <= 9) {
					displayStr += "0";
				}
			}
			displayStr += " ";
			displayStr += startTime.getHours() >= 12 
				? "PM" 
				: "AM";
			return displayStr;
		}
		
		function compareTourneys(a, b) {
			if ( a.startTime < b.startTime ){
				return -1;
			}
			if ( a.startTime > b.startTime ){
				return 1;
			}
			return 0;
		}

		function _displayStandingsSection() {
			var standingsDiv = document.getElementById("Standings");
			standingsDiv.innerHTML = "";
			standingsDiv.appendChild(createH2({innerHTML: "Standings"}));
						
			/*var playersObj = {};
			
			for (let i = 0; i < currentConvention.attendees.length; i++) {
				const attendee = currentConvention.attendees[i];
				const user = attendee.user;
				playersObj[user.userName] = {
					player: {
						user: user
					}, 
					wins: 0, 
					losses: 0, 
					ties: 0};
			}*/
			
			for (let i = 0; i < currentConvention.tournaments.length; i++) {
				// TODO - update player wins/losses/ties here 
			}
			
			//displayStandings(playersObj, standingsDiv);
			
			displayStandings(currentConvention.tournaments, standingsDiv);
		}
		
		function _displayMapsSection() {
			var mapsDiv = document.getElementById("Maps");
			mapsDiv.innerHTML = "";
			mapsDiv.appendChild(createH2({innerHTML: "Maps"}));
			
			var mapsGroupDiv = createDiv({id: "MapsGroup"});
			mapsDiv.appendChild(mapsGroupDiv);
			
			for (let i = 0; i < currentConvention.conventionMaps.length; i++) {
				const map = currentConvention.conventionMaps[i];
				var mapDiv = createDiv({id: "ConventionMap_"+map.id});
				mapsGroupDiv.appendChild(mapDiv);
				if (isAdmin) {
					map._displayObject("ConventionMap_"+map.id);
				} else {
					mapDiv.appendChild(createA({
						href: "https://heroscape.org/map/view/?HeroscapeMap="+map.map.id,
						target: "_blank",
						innerHTML: map.map.name
					}));
					mapDiv.appendChild(createText(" x"+map.quantity));
				}
			}
			
			if (isAdmin) {
				mapsDiv.appendChild(createDiv({id: "CreateMapDiv"}));
				ConventionMap.createAddSection(
					"CreateMapDiv", 
					{implicitClasses: {
						convention: currentConvention
					}/*,
					targetDivID: "MapsGroup"*/});
				
			}
		}
		
		function _signup() {
			var signupKey = null;
			var signupKeyInput = document.getElementById("signupKeyInput");
			if (signupKeyInput !== undefined && signupKeyInput !== null) {
				if ( ! signupKeyInput.checkValidity()) {
					signupKeyInput.reportValidity();
					return;
				}
				signupKey = signupKeyInput.value;
			}
			socket.emit("signupConvention", JSON.stringify({
				convention: {
					id: currentConvention.id
				},
				signupKey: signupKey}));
		}
		
		function _deRegister() {
			if (confirm("Are you sure you want to de-register from this convention?")) {
				socket.emit("deRegisterConvention", JSON.stringify({
					convention: {
						id: currentConvention.id
					}
				}));
			}
		}
		
		function _emitAnnouncement(announcement) {
			socket.emit("conventionAnnouncement",
				JSON.stringify({
					convention: {
						id: currentConvention.id,
						name: currentConvention.name
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
		<article>	
			<h1 id='h1'>Loading...</h1>
			<div id='Convention'></div>
			<div id='Info'></div>
			<div id='Announcement'></div>
			<div id='DisplayConvention'>
				<div class='conventionSection' id='Tournaments'></div>
				<div class='conventionSection' id='Maps'></div>
				<div class='conventionSection' id='Attendees'></div>
				<div class='conventionSection' id='Standings'></div>
			</div>
			
			<script>
				var responses = 0;
				const conventionID = findGetParameter("Convention");
				if (conventionID != null) {
					ConventionTournamentResultsView.load(
						{Convention_id: conventionID},
						function (viewRows) {
							DatabaseObject.extractView(ConventionTournamentResultsView.list);
							if (++responses >= 2) {
								displayConvention(Convention.list[0]);
							}
						},
						{joins: {}}
					);
					
					Convention.load(
						{id: conventionID},
						function (conventions) {
							if (conventions.length == 1) {
								if (++responses >= 2) {
									displayConvention(conventions[0]);
								}
							} else {
								document.getElementById("Convention").appendChild(
									createP({
										innerHTML: "There was an error loading this page; " +
											"make sure you used a valid link to reach this page."}));
							}
						},
						{joins: {
							"conventionSeriesID": {},
							"HeroscapeTournament.conventionID": { // This was failing with the old (current) DB library when this was 'Tournament.conventionID'
								"Player.tournamentID": {
									"userID": {}
								}/*,
								"Round.tournamentID": {
									"HeroscapeGame.roundID": {
										"HeroscapeGamePlayer.gameID": {
											"playerID": {
												"userID": {}
											}
										}
									}
								}*/
							},
							"Attendee.conventionID": {
								"userID": {}
							},
							"Admin.conventionID": {
								"userID": {}
							},
							"ConventionMap.conventionID": {
								"mapID": {}
							}
					}});
				} else {
					document.getElementById("Convention").appendChild(
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