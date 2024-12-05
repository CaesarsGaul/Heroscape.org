<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Create New Tournament</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		label {
			display: block;
		}
		
		.fieldName {
			display: inline-block;
			min-width: 210px;
			vertical-align: top;
			padding-top: 10px;
			text-align: left;
		}
		
		#CreateTournamentForm {
			text-align: left;
			margin: auto;
			max-width: 540px;
			padding-left; 10px;
		}
		
		#CreateTournamentForm input, #CreateTournamentForm textarea {
			display: inline-block;
			margin-top: 10px;
			margin-bottom: 10px;
		}
		
		#CreateTournamentForm input[type='text'], #CreateTournamentForm textarea {
			width: 300px;
		}
		
		#CreateTournamentForm button {
			display: block;
			margin: auto;
			padding-left: 20px;
			padding-right: 20px;
			padding-top: 10px;
			padding-bottom: 10px;
			margin-top: 10px;
			margin-bottom: 10px;
		}
		
		.tagDiv {
			display: inline-block;
			margin-right: 20px;
		}
		
		.tagDiv label {
			display: inline-block;
		}
		
		.tagDivName {
			display: inline-block;
			vertical-align: top;
			padding-top: 3px;
		}
		
		.tagDiv input[type=number], .tagDiv input[type=text] {
			margin-top: 0px !important; 
			margin-bottom: 0px !important;
			vertical-align: top;
			margin-left: 5px;
		}
		
		.tagDiv input.short {
			width: 50px !important; 
		}
		
		.tagDiv input.long {
			width: 300px !important; 
		}
		
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	
	<script src="/connect/socket.io/socket.io.js"></script>
	
	<script>
		Season.load(
			{}, // TODO : filter by start/end 
			function(seasons) {
				var selectElem = document.getElementById("seasonSelect");
				for (let i = 0; i < seasons.length; i++) {
					const season = seasons[i];
					if (season.editableByUser) {
						var seasonOption = createOption({
							value: season.id,
							innerHTML: season.fullDisplayName()
						});
						$(seasonOption).data("object", season);
						selectElem.appendChild(seasonOption);
					}
				}
			},
			{joins: {
				"leagueID": {}
			}}
		);
		/*League.load(
			{},
			function(leagues) {
				
			},
			{joins: {}});*/
		FigureSet.load(
			{sDomain: getSubdomain()}
		);

	
		var socket = io.connect("/", {path: "/connect/socket.io"});
		
		socket.on('sheetCreationError', function(objStr) {
			alert("Uh oh, something went wrong. Ask Chris Perkins to investigate.");
		});
		
		socket.on('sheetCreated', function(objStr) {
			var obj = JSON.parse(objStr);
			window.location.href = 
				window.location.origin + "/events/tournament/?Tournament="+obj.tournament.id;
		});
		
		function createTournament(refThis, refEvent) {
			var tournament = new HeroscapeTournament();
			
			tournament.figureSet = FigureSet.list[0];
			
			var conventionID = findGetParameter('ConventionID');
			if (conventionName !== undefined && conventionName !== null) {
				tournament.convention = new Convention({id: conventionID});
			}
						
			var seasonSpan = document.getElementById('seasonSelect');
			var seasonOption = seasonSpan.options[seasonSpan.selectedIndex];
			var season = $(seasonOption).data("object");
			if (season != null) {
				tournament.seasons = [season];
			}
			
			tournament.name = document.getElementById("nameInput").value;
			tournament.description = document.getElementById("descriptionTextarea").value;
						
			var startTimeValue = document.getElementById("startTimeInput").value;
			tournament.startTime = new Date(startTimeValue).toISOString();
			tournament.endDate = document.getElementById("endDateInput").value;
			if (document.getElementById("maxEntriesInput").value.length > 0) {
				tournament.maxEntries = document.getElementById("maxEntriesInput").value;
			}
			
			var address = document.getElementById("addressInput").value;
			if (address.length > 0) {
				tournament.address = address;
			}
			
			if (document.getElementById("numLossesToBeEliminatedInput").value.length > 0) {
				tournament.numLossesToBeElimintated = document.getElementById("numLossesToBeEliminatedInput").value;
			}
			tournament.pairAfterEliminated = document.getElementById("pairAfterEliminatedInput").checked;
			if (document.getElementById("roundLengthMinutesInput").value.length > 0) {
				tournament.roundLengthMinutes = document.getElementById("roundLengthMinutesInput").value;
			}
			if (document.getElementById("allowSignupAfterInput").value.length > 0) {
				var timeValue = document.getElementById("allowSignupAfterInput").value;
				tournament.allowSignupAfter = new Date(timeValue).toISOString();
			}
			if (document.getElementById("allowArmySubmissionAfterInput").value.length > 0) {
				var timeValue = document.getElementById("allowArmySubmissionAfterInput").value;
				tournament.allowArmySubmissionAfter = new Date(timeValue).toISOString();
			}
			tournament.allowLateSignup = document.getElementById("allowLateSignupInput").checked;
			tournament.online = document.getElementById("onlineInput").checked;
			
			tournament.teamSize = document.getElementById("teamSizeInput").value;
			tournament.maxNumPlayersPerGame = document.getElementById("numPlayersPerGameInput").value;
			
			tournament.numArmies = document.getElementById("numArmiesInput").value;
			tournament.allowedPointOverlap = document.getElementById("allowedPointOverlapInput").value;
			
			tournament.pointLimit = document.getElementById("pointLimitInput").value;
			if (document.getElementById("hexLimitInput").value.length > 0) {
				tournament.hexLimit = document.getElementById("hexLimitInput").value;
			}
			if (document.getElementById("figureLimitInput").value.length > 0) {
				tournament.figureLimit = document.getElementById("figureLimitInput").value;
			}
			
			tournament.useDeltaPricing = document.getElementById("useDeltaPricingInput").checked;
			tournament.includeVC = document.getElementById("includeVCInput").checked;
			tournament.includeMarvel = document.getElementById("includeMarvelInput").checked;
			
			var allTags = document.getElementsByClassName("tagCheckbox");
			for (let i = 0; i < allTags.length; i++) {
				var tag = allTags[i];
				if (tag.checked) {
					const tagId = tag.name.split("_")[1];
					var tagFormat = null;
					for (let j = 0; j < TournamentFormat.list.length; j++) {
						const format = TournamentFormat.list[j];
						if (format.id == tagId) {
							tagFormat = format;
							break;
						}
					}
					var tagDataInputs = $(":input[name^='tag_"+tagId+"_data']");
					var tagData = null;
					if (tagDataInputs.length > 0) {
						tagData = "";
						for (let j = 0; j < tagDataInputs.length; j++) {
							if (j > 0) {
								tagData += ";";
							}
							tagData += tagDataInputs[j].value;
						}
					}
					
					var tournamentFormatTag = new TournamentFormatTag();
					tournamentFormatTag.tournament = tournament;
					tournamentFormatTag.format = tagFormat;
					tournamentFormatTag.data = tagData;
					tournament.tournamentFormatTags.push(tournamentFormatTag);
				}
			}
				
			var formElem = document.getElementById("CreateTournamentForm");
			formElem.innerHTML = "";
			formElem.appendChild(createH2({innerHTML: "Working on it..."}));
			
			tournament._serverCreate({}, function(tournament) {				
				socket.emit("createSheet", 
					JSON.stringify({
						tournament: {
							name: tournament.name,
							id: tournament.id, 
							maxNumPlayersPerGame: tournament.maxNumPlayersPerGame}}));
			});
			
			return false; // Do not submit normally 
		}
		
		function changeSeason() {
			/*var seasonSpan = document.getElementById('seasonSelect');
			var seasonOption = seasonSpan.options[seasonSpan.selectedIndex];
			var season = $(seasonOption).data("object");
			
			var seasonNameSpan = document.getElementById('leagueName');
			seasonNameSpan.innerHTML = season.fullDisplayName(); // TODO */
		}
		
		function displayTags() {
			var parentDiv = document.getElementById("TagsDiv");
			
			for (let i = 0; i < TournamentFormat.list.length; i++) {
				const tag = TournamentFormat.list[i];
				var tagDiv = createDiv({
					class: "tagDiv"
				});
				parentDiv.appendChild(tagDiv);
				var tagLabel = createLabel({});
				tagDiv.appendChild(tagLabel);
				tagLabel.appendChild(createInput({
					type: "checkbox",
					class: "tagCheckbox",
					name: "tag_"+tag.id
				}));
				tagLabel.appendChild(createSpan({
					class: "tagDivName",
					innerHTML: tag.name
				}));
				
				switch (tag.name) {
					case "Rule of X":
						tagDiv.appendChild(createInput({
							type: "number",
							min: 0,
							step: 1,
							name: "tag_"+tag.id+"_data"
						}));
						break;
					case "Ban List":
						tagDiv.appendChild(createInput({
							type: "text",
							class: "long",
							name: "tag_"+tag.id+"_data"
						}));
						break;
					case "X Card Draft":
						tagDiv.appendChild(createInput({
							type: "number",
							min: 0,
							step: 1,
							name: "tag_"+tag.id+"_data"
						}));
						break;
					case "X Pod Draft":
						tagDiv.appendChild(createInput({
							type: "number",
							min: 0,
							step: 1,
							name: "tag_"+tag.id+"_data"
						}));
						break;
					case "X(+/-) & Under":
						tagDiv.appendChild(createInput({
							type: "text",
							class: "short",
							name: "tag_"+tag.id+"_data"
						}));
						break;
					case "YxZ (i.e. 4x400)":
						tagDiv.appendChild(createInput({
							type: "number",
							min: 0,
							step: 1,
							name: "tag_"+tag.id+"_data_1"
						}));
						tagDiv.appendChild(createSpan({
							class: "tagDivName",
							innerHTML: "x"}));
						tagDiv.appendChild(createInput({
							type: "number",
							min: 0,
							step: 1,
							name: "tag_"+tag.id+"_data_2"
						}));
						break;
				}				
			}
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(EventsNav); ?>
	
	<h1>Create New Tournament</h1>
	
	<article>
		
		<form id='CreateTournamentForm' onsubmit='return createTournament(this, event);'>
			<label>
				<span class='fieldName'>Season: </span></span>
				<select id='seasonSelect' onchange='changeSeason()' />
					<option value='-1'>-- Select Season --</option>
				</select>
			</label>
		
			<label>
				<span class='fieldName'>Name: <span class='requiredField'>*</span></span>
				<span id='leagueName'></span>
				<input type='text' id='nameInput' required />
			</label>
			
			<label>
				<span class='fieldName'>Description: </span>
				<textarea id='descriptionTextarea' rows='5'></textarea>
			</label>
			
			<div>
				Convention: <span id='conventionName'></span>
			</div>
			<script>
				var conventionName = findGetParameter('Convention');
				document.getElementById("conventionName").innerHTML = 
					conventionName !== undefined && conventionName !== null
						? conventionName
						: "None";
			</script>
			
			<h2>Logistics</h2>
			
			<label>
				<span class='fieldName'>Start Time: <span class='requiredField'>*</span></span>
				<input type='datetime-local' id='startTimeInput' required />
			</label>
			
			<label>
				<span class='fieldName'>End Date: <span class='requiredField'>*</span></span>
				<input type='date' id='endDateInput' required />
			</label>
			
			<label>
				<span class='fieldName'>Location (Address): </span>
				<input type='text' id='addressInput' />
			</label>
		
			<label>
				<span class='fieldName'>Player Cap: </span>
				<input type='number' id='maxEntriesInput' />
			</label>
			
			<label>
				<span class='fieldName'>Round Length (Minutes): </span>
				<input type='number' min='1' step='1' id='roundLengthMinutesInput' />
			</label>
			
			<label>
				<span class='fieldName'>Allow Signups After: </span>
				<input type='datetime-local' id='allowSignupAfterInput' />
			</label>
			
			<label>
				<span class='fieldName'>Allow Army Submission After: </span>
				<input type='datetime-local' id='allowArmySubmissionAfterInput' />
			</label>
			
			<label>
				<span class='fieldName'>Allow Late Signups? </span>
				<input type='checkbox' id='allowLateSignupInput' />
			</label>
			
			<label>
				<span class='fieldName'>Online? </span>
				<input type='checkbox' id='onlineInput' />
			</label>
			
			<h2>Teams and Multiplayer</h2>
			
			<label>
				<span class='fieldName'>Team Size: <span class='requiredField'>*</span></span>
				<input type='number' min='1' step='1' id='teamSizeInput' value='1' required />
			</label>
			
			<label>
				<span class='fieldName'>Max # Players / Game: <span class='requiredField'>*</span></span>
				<input type='number' min='2' max='4' step='1' id='numPlayersPerGameInput' value='2' required />
			</label>
			
			<h2>Elimination Structure</h2>
			
			<label>
				<span class='fieldName'># Losses To Be Eliminated: </span>
				<input type='number' id='numLossesToBeEliminatedInput' />
			</label>
			
			<label>
				<span class='fieldName'>Pair After Eliminated? </span>
				<input type='checkbox' id='pairAfterEliminatedInput' checked />
			</label>
			
			<h2>Multiple Armies?</h2>
			
			<label>
				<span class='fieldName'># Armies per Player: <span class='requiredField'>*</span></span>
				<input type='number' id='numArmiesInput' value='1' required />
			</label>
			
			<label>
				<span class='fieldName'>How many points can be shared between armies? <span class='requiredField'>*</span></span>
				<input type='number' id='allowedPointOverlapInput' value='0' required />
			</label>
						
			<h2>Core Army Restrictions</h2>
			
			<label>
				<span class='fieldName'>Point Limit: <span class='requiredField'>*</span></span>
				<input type='number' id='pointLimitInput' required />
			</label>
			
			<label>
				<span class='fieldName'>Hex Limit: </span>
				<input type='number' id='hexLimitInput' />
			</label>
			
			<label>
				<span class='fieldName'>Figure Limit: </span>
				<input type='number' id='figureLimitInput' />
			</label>
			
			<h2>Unit Pricing</h2>
			
			<label>
				<span class='fieldName'>Use Delta Pricing? </span>
				<input type='checkbox' id='useDeltaPricingInput' />
			</label>
			
			<h2>Figure Restrictions</h2>
			
			<label>
				<span class='fieldName'>Include VC? </span>
				<input type='checkbox' id='includeVCInput' />
			</label>
			
			<label>
				<span class='fieldName'>Include Marvel? </span>
				<input type='checkbox' id='includeMarvelInput' />
			</label>
			
			<div id='TagsDiv'>
				<h2>Format Tags</h2>
				
				
			</div>
			<script>
				TournamentFormat.load(
					{},
					function (tags) {
						displayTags();
					},
					{joins: {
						
				}});
			</script>
			
			
			<!--<label>
				<span class='fieldName'>Uniques Only? </span>
				<input type='checkbox' id='uniquesOnlyInput' />
			</label>
			
			<label>
				<span class='fieldName'>Commons Only? </span>
				<input type='checkbox' id='commonsOnlyInput' />
			</label>
			
			<label>
				<span class='fieldName'>Heroes Only? </span>
				<input type='checkbox' id='heroesOnlyInput' />
			</label>
			
			<label>
				<span class='fieldName'>Squads Only? </span>
				<input type='checkbox' id='squadsOnlyInput' />
			</label>-->
					
			<button type='submit'>Create</button>
		</form>
		
	</article>

	<?php include(Footer); ?>

</div></body>
</html>