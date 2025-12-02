<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Army Search</title>
	
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/builder.css">
	<link rel="stylesheet" href="/css/formatSearch.css">
	<style>
		article {
			max-width: 1050px !important;
		}
		
		#CardsDivInner {
			/*text-align: left;*/
		}
		
		.cardDiv {
			display: inline-block;
			width: 350px;
			text-align: left;
			padding-top: 2px;
			padding-bottom: 2px;
		}
		
		
		
		.cardQuantityInput {
			width: 25px !important;
			margin-left: 5px;
		}
		
		#ResultsDivInner {
			text-align: left;
		}
		
		.armyDiv {
			margin-bottom: 5px;
		}
		
		.armyResultPart:not(:last-child) {
			/*padding-left: 5px;*/
			padding-right: 5px;
		}
		
		.triStateButton {
			width: 25px;
			height: 25px;
			vertical-align: top;
			padding: 0;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/armyBuilder.js"></script>
	<script src="/js/formatSearch.js"></script>
	<script src="/connect/socket.io/socket.io.js"></script>
	<script>
		
		socket = null;
		function createSocket() {
			if (socket != null) {
				return;
			}
			
			socket = io.connect("/", {path: "/connect/socket.io"});
			
			socket.on("armySearchResult", function(objStr) {
				const response = JSON.parse(objStr);
				console.log(response);
				
				var parentElem = document.getElementById('ResultsDivInner');
				parentElem.innerHTML = "";
				
				for (let i = 0; i < response.length; i++) {
					PlayerArmy.load(
						{id: response[i].id},
						function (playerArmies) {		
							const playerArmy = playerArmies[0];
							var tournamentMatch = false;
							if ( ! playerArmy.player.tournament.started) {
								return;
							}
							for (let i = 0; i < matchingFormats.length; i++) {
								if (matchingFormats[i].id == playerArmy.player.tournament.id) {
									tournamentMatch = true;
									break;
								}
							}
							if (tournamentMatch) {
								var excludeCardMatch = true;
								
								for (let i = 0; i < Card.list.length; i++) {
									const card = Card.list[i];
									const button = document.getElementById("CardCheckboxButton_"+card.id);
									if (button.innerHTML == "X") {
										for (let j = 0; j < playerArmy.playerArmyCards.length; j++) {
											const playerArmyCard = playerArmy.playerArmyCards[j];
											if (card.id == playerArmyCard.card.id) {
												excludeCardMatch = false;
												break;
											}
										}
									}
								}
								
								if (excludeCardMatch) {
									var armyDiv = createDiv({
										class: "armyDiv"
									});
									parentElem.appendChild(armyDiv);
									
									const tournament = playerArmy.player.tournament;
									
									armyDiv.appendChild(createA({
										innerHTML: tournament.fullDisplayName(),
										class: "armyResultPart",
										href: "/events/tournament/?Tournament="+tournament.id,
										target: "_blank"
									}));
									/*armyDiv.appendChild(createSpan({
										innerHTML: playerArmy.player.wins() + "-" + playerArmy.player.losses(),
										class: "armyResultPart"}));*/
									if (playerArmy.player.user != null) {
										armyDiv.appendChild(createA({
											innerHTML: playerArmy.player.user.userName,
											class: "armyResultPart",
											href: "/user/?" + playerArmy.player.user.userName,
											target: "_blank"
										}));
									} else {
										armyDiv.appendChild(createSpan({
											innerHTML: playerArmy.player.name,
											class: "armyResultPart"}));
									}
									armyDiv.appendChild(createSpan({
										innerHTML: playerArmy.toDisplayString(true),
										class: "armyResultPart"}));
								}
							}
						},
						{joins: {
							"playerID": {
								"tournamentID": {},
								"userID": {}
							},
							"PlayerArmyCard.playerArmyID": {
								"cardID": {}
							}
						}}
					
					);
				}
			});
		}
		createSocket();
			
			
		function displayCards() {
			var parentElem = document.getElementById('CardsDivInner');
			for (let i = 0; i < Card.list.length; i++) {
				const card = Card.list[i];
				
				var cardDiv = createDiv({
					class: "cardDiv"
				});
				parentElem.appendChild(cardDiv);
				
				var labelElem = createLabel({});
				cardDiv.appendChild(labelElem);
				/*labelElem.appendChild(createInput({
					class: "cardCheckbox",
					id: "CardCheckbox_"+card.id,
					type: "checkbox"
				}));*/
				
				
				labelElem.appendChild(createButton({
					innerHTML: "",
					id: "CardCheckboxButton_"+card.id,
					class: "triStateButton",
					onclick: "_toggleCheckboxButton("+card.id+")"
				}));
				labelElem.appendChild(createText(card.name));
				
				
				if (card.commonality.toLowerCase() != "unique") {
					cardDiv.appendChild(createInput({
						class: "cardQuantityInput",
						id: "CardQuantityInput_"+card.id,
						type: "number",
						value: 0,
						step: 1,
						min: 0
					}));
				}
			}
		}
		
		function _toggleCheckboxButton(cardID) {
			var button = document.getElementById("CardCheckboxButton_"+cardID);
			switch (button.innerHTML) {
				case "":
					button.innerHTML = "✓";
					break;
				case "✓":
					button.innerHTML = "X";
					break;
				case "X":
					button.innerHTML = "";
					break;
			}
		}
		
		function armySearch() {
			var searchParams = {};
			
			for (let i = 0; i < Card.list.length; i++) {
				const card = Card.list[i];
				const button = document.getElementById("CardCheckboxButton_"+card.id);
				if (button.innerHTML == "✓") {
					var quantityInput = document.getElementById('CardQuantityInput_'+card.id);
					searchParams[card.name] = quantityInput != null
						? quantityInput.value
						: 1;
				}
			}
			
			/*var checkboxes = document.getElementsByClassName('cardCheckbox');
			for (let i = 0; i < checkboxes.length; i++) {
				const checkbox = checkboxes[i];
				if (checkbox.checked) {
					const cardID = checkbox.id.split("_")[1];
					const card = findCard(cardID);
					searchParams[card.name] = document.getElementById('CardQuantityInput_'+cardID).value;
				}
			}*/
			
			if (Object.keys(searchParams).length > 0 && Object.keys(searchParams).length <= 10) {
				socket.emit("armySearch", JSON.stringify(searchParams));					
			}
		}
		
		function findCard(cardID) {
			for (let i = 0; i < Card.list.length; i++) {
				if (Card.list[i].id == cardID) {
					return Card.list[i];
				}
			}
			return null;
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(DataNav); ?>
	
	<div id='pageContent'>	
		<h1>Army Search</h1>
		<article>
			<div id='SearchDiv'>
			
				<div id='Row1' class='row'>
					<div class='rowCol searchGroup'>
						<div id='Tier1SubGroups' class='row1Group tierSubGroup'></div>
						<div id='Tier2SubGroups' class='row1Group tierSubGroup'></div>
						<script>
							FigureSetSubGroup.load(
								{},
								function (groups) {
									createFigureSetCheckboxes(groups, false);
								},
								{joins: {
									
								}}
							);
						</script>
					</div>
					<div class='rowCol searchGroup'>
						<div>
							Points System
						</div>
						<div id='PointsSystemOptions'>
							<label>
								<input id='StandardPricing' type='checkbox' checked onchange='filterFormats()' />
								Standard
							</label>
							<label>
								<input id='DeltaPricing' type='checkbox' checked onchange='filterFormats()' />
								Delta
							</label>
						</div>
					</div>
				</div>
				<div id='Row2' class='row'>
					<div class='searchGroup'>
						<div>
							Start Date
						</div>
						<div>
							<label>
								After 
								<input id='StartDate' type='date' onchange='filterFormats()' />
							</label>
							<label>
								Before 
								<input id='EndDate' type='date' onchange='filterFormats()' />
							</label>
						</div>
					</div>
				</div>				
				<div id='Row3' class='row'>
					<div class='rowCol  searchGroup'>
						<div class='minMaxGroup'>
							<div class='minMaxGroupTitle'>
								Points
							</div>
							<div class='minMaxGroupBody'>
								<label>
									Min: 
									<input id='PointMin' type='number' value=400 step=5 min=0 onchange='filterFormats()' />
								</label>
								<label>
									Max:
									<input id='PointMax' type='number' value=600 step=5 min=0 onchange='filterFormats()' />
								</label>
							</div>
						</div>
						<div class='minMaxGroup'>
							<div class='minMaxGroupTitle'>
								Figures
							</div>
							<div class='minMaxGroupBody'>
								<label>
									Min: 
									<input id='FigureMin' type='number' step=1 min=0 onchange='filterFormats()' />
								</label>
								<label>
									Max:
									<input id='FigureMax' type='number' step=1 min=0 onchange='filterFormats()' />
								</label>
							</div>
						</div>
						<div class='minMaxGroup'>
							<div class='minMaxGroupTitle'>
								Hexes
							</div>
							<div class='minMaxGroupBody'>
								<label>
									Min: 
									<input id='HexMin' type='number' step=1 min=0 onchange='filterFormats()' />
								</label>
								<label>
									Max:
									<input id='HexMax' type='number' step=1 min=0 onchange='filterFormats()' />
								</label>
							</div>
						</div>
					</div>
					<div class='rowCol'>
						<div id='LiveOnlineType' class='searchGroup'>
							Type
							<label>
								<input id='Live' type='checkbox' checked onchange='filterFormats()' />
								Live
							</label>
							<label>
								<input id='Online' type='checkbox' checked onchange='filterFormats()' />
								Online
							</label>
						</div>
					
						<div id='NumPlayers' class='searchGroup'>
							# Players
							<label>
								<input id='2Player' type='checkbox' checked onchange='filterFormats()' />
								2-Player
							</label>
							<label>
								<input id='MultiPlayer' type='checkbox' onchange='filterFormats()' />
								Multi-Player
							</label>
						</div>
						
						<div class='searchGroup'>
							<label>
								# Armies: 
								<input id='NumArmies' type='number' step=1 min=0 onchange='filterFormats()' />
							</label>
						</div>
					</div>
				</div>
			
				<div id='Row4' class='row'>
					<div id='Formats' class='searchGroup'></div>
					<div>
						<a href='https://heroscape.org/glossary/#FormatGlossaryListDiv' target='_blank'>Format Glossary</a>
					</div>
					<script>
						TournamentFormat.load(
							{},
							function (tags) {
								createTags();
							},
							{joins: {
								
							}}
						);
					</script>
				</div>				
				
			</div>
			
			<div id='CardsDiv'>
				<h2>Army Cards</h2>
				<div id='CardsDivInner'></div>
				<button onclick='armySearch()'>Search</button>
				<script>
					Card.load(
						{},
						function (cards) {
							displayCards();
						},
						{joins: {
							
						}}
					);
				</script>
			</div>
			
			<div id='ResultsDiv'>
				<h2>Results</h2>
				<div id='ResultsDivInner'></div>
			</div>
			
			<script>			
				TournamentOverviewView.load(
					{},
					function (viewEntries) {
						var tournaments = DatabaseObject.extractView(TournamentOverviewView.list, HeroscapeTournament);
						filterFormats();
					},
					{joins: {
						
					}}
				
				);
			</script>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>