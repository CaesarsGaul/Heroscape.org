<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title id='Title'>Card</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<!--<link rel="stylesheet" href="/css/about.css">-->
	<style>
		h2, h3 {
			text-align: center;
			margin-left: 0;
			margin-right: 0;
		}
		
		#CardDiv {
			display: flex;
			max-width: 500px;
			margin: auto;
			margin-top: 10px;
			color: white;
			min-height: 370px;
			/*clip-path: polygon(
				33.3% 0%,
				50% 10%,
				66.6% 0%,
				83.2% 10%,
				83.2% 33.3%,
				100% 40%,
				100% 60%, 
				83.2% 66.6%,
				83.2% 90%,
				66.6% 100%,
				50% 90%,
				33.3% 100%,
				16.8% 90%,
				16.8% 66.6%,
				0% 60%,
				0% 40%,
				16.8% 33.3%,
				16.8% 10%
			);*/
		}
		
		.cardColumn {
			display: inline-block;
			/*max-width: 150px;*/
			vertical-align: top;
			/*height: 300px;*/
			flex: 1;
		}
		
		#CardLHS ul {
			list-style-type:none;
			padding: 0px;
			margin: 0px;
			text-align: right;
		}
		
		#CardLHS ul li {
			border-top: 1px solid white;
			padding: 0;
		}
		
		#Column1, #Column4/*, #Column2, #Column3*/ {
			display: flex;
			align-items: center;
			/*flex-direction: column;*/
		}
		
		#Column2, #Column 3 {
			
		}
		
		#CardLHS {
			margin: 0 auto;
			font-size: 12px;
			width: 80%;
		}
		
		#Column2 {
			padding-top: 5px;
			padding-bottom: 5px;
		}
		
		#GeneralImage {
			width: 20px;
			-webkit-filter: invert(100%); /* Safari/Chrome */
			filter: invert(100%);
		}
		
		h1 {
			margin-top: 0;
			margin-bottom: 0;
			font-size: 14px;
		}
		
		#CardGeneral {
			font-size: 10px;
		}
		
		#CardPowers {
			text-align: left;
			color: black;
			background-color: white;
			/*margin-bottom: 5px;*/
			z-index: 5;
			position: relative;
		}
		
		.cardPower {
			margin-top: 10px;
		}
		
		.powerName {
			font-size: 12px;
			font-weight: bold;
		}
		
		.powerText {
			font-size: 10px;
			
		}
		
		
		#Column3 {
			position: relative;
		}
		
		
		#CardImage {
			padding-top: 30px;
			width: 130%;
			margin-left: -15%;
		}
		
		#CardStatsDiv {
			background-color: black; 
			padding: 2px;
			position: absolute;
			width: calc(100% - 14px);
			margin: 5px;
			bottom: 20px;
			clip-path: polygon(50% 0%, 100% 10%, 100% 90%, 50% 100%, 0% 90%, 0% 10%);
			<!-- TODO - get this from opposite-general -->
		}
		
		.cardStatsDivTopRow {
			background-color: red;
			border-radius: 10px;
			width: 30px;
			margin-left: auto;
			margin-right: auto;
		}
		
		.cardStatsDivRow {
			margin-top: 3px;
			margin-bottom: 3px;
			/*margin-left: 3px;
			margin-right: 3px;*/
		}
		
		.cardStatsRowLabel1 {
			display: inline-block;
			text-align: center;
			width: calc(100% - 35px);
			line-height: 100%;
			padding-top: 8px;
			padding-bottom: 8px;
			font-size: 12px;
			vertical-align: top;
		}
		
		.cardStatsDivRowRHS {
			display: inline-block;
			width: 30px;
		}
		
		.cardStatsRowValue {
			font-size: 12px;
		}
		
		.cardStatsRowLabel2 {
			font-size: 8px;
		}
		
		#CardLife, #CardPoints {
			font-size: 12px;
		}
		
		#CardLifeLabel, #CardPointsLabel {
			font-size: 8px;
		}
		
		#MoveRow {
			background-color: darkgreen;
		}
		
		#RangeRow {
			background-color: grey;
		}
		
		#AttackRow {
			background-color: red;
		}
		
		#DefenseRow {
			background-color: blue;
		}
		
		#TopUsageUsersTable {
			display: inline-block;
		}
	</style>
	
	<!-- Internal Files -->
	<script src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/deltaPriceGraph.js"></script>
	<script>
		DeltaUpdate.load({}, function() {}, {});
		
		//var vcInclusive = false;
		google.charts.load('current', {packages: ['corechart', 'line']});
		
		var card = null;
		var cardWinRateDelta = null;
		var cardWinRateStandard = null;
		
		function displayCard() {
			document.getElementById('Title').innerHTML = card.name;
			document.getElementById("H1").innerHTML = card.name.toUpperCase();
			document.getElementById("CardGeneral").innerHTML = card.general.name.toUpperCase();
			document.getElementById("GeneralImage").src = "/images/symbols/" + card.general.name + ".png";
			document.getElementById('CardDiv').style['background-color'] = Unit.getBackgroundColor(card.general.name);
			
			document.getElementById("CardSpecies").innerHTML = card.species.name.toUpperCase()
			document.getElementById("CardStatus").innerHTML = card.commonality.toUpperCase() + " " + (card.hero ? "HERO" : "SQUAD");
			document.getElementById("CardClass").innerHTML = card.class.name.toUpperCase();
			document.getElementById("CardPersonality").innerHTML = card.personality.name.toUpperCase();
			document.getElementById("CardSize").innerHTML = card.size.name.toUpperCase() + " " + card.height;
			
			var powersDiv = document.getElementById("CardPowers");
			for (let i = 0; i < card.cardPowers.length; i++) {
				const power = card.cardPowers[i];
				var powerDiv = createDiv({class: "cardPower"});
				powerDiv.appendChild(createDiv({class: "powerName", innerHTML: power.name.toUpperCase()}));
				powerDiv.appendChild(createDiv({class: "powerText", innerHTML: power.description}));
				powersDiv.appendChild(powerDiv);
			}
			
			document.getElementById("CardImage").src = card.imageLink;
			
			document.getElementById("CardLife").innerHTML = card.life;
			document.getElementById("CardMove").innerHTML = card.move;
			document.getElementById("CardRange").innerHTML = card.range;
			document.getElementById("CardAttack").innerHTML = card.attack;
			document.getElementById("CardDefense").innerHTML = card.defense;
			document.getElementById("CardPoints").innerHTML = card.points;
			
			document.getElementById("ReleaseSetDiv").innerHTML = card.releaseSet.name + " (" + card.releaseSet.releaseDate.substr(0, 7) + ")";
			
			if (card.cardPowerRankings.length > 1) {
				const powerRankingClassic = 
					card.cardPowerRankings[0].powerRankingList.name == "Classic Power Rankings"
						? card.cardPowerRankings[0].ranking
						: card.cardPowerRankings[1].ranking;
				document.getElementById("PowerRanking_Classic").innerHTML = "Power Ranking Classic (Mike) : " + powerRankingClassic;
			}
			const powerRankingVc = 
				card.cardPowerRankings[0].powerRankingList.name == "VC-Inclusive Power Rankings"
					? card.cardPowerRankings[0].ranking
					: card.cardPowerRankings[1].ranking;
			document.getElementById("PowerRanking_VC").innerHTML = "Power Ranking VC (Dok) : " + powerRankingVc;
			
			drawDeltaPriceGraph({height: 300}, [card]);
		}
		
		function displayWinRateData() {
			if (cardWinRateDelta == null || cardWinRateStandard == null) {
				return;
			}
			
			var standardDiv = document.getElementById("WinRateStandard");
			var deltaDiv = document.getElementById("WinRateDelta");
			
			standardDiv.innerHTML = cardWinRateStandard.W + "-" + cardWinRateStandard.L + " (" + cardWinRateStandard.WinPercent + ")";
			deltaDiv.innerHTML = cardWinRateDelta.W + "-" + cardWinRateDelta.L + " (" + cardWinRateDelta.WinPercent + ")";
			
		}
		
		function displayUserUsageData(viewRows) {
			var table = document.getElementById("TopUsageUsersTable");
			
			viewRows.sort(function(a, b) {
				if (a.count > b.count) {
					return -1;
				} else if (a.count < b.count) {
					return 1;
				} else {
					if (a.userName.toLowerCase() > b.userName.toLowerCase()) {
						return 1;
					} else if (a.userName.toLowerCase() < b.userName.toLowerCase()) {
						return -1;
					} else {
						return 0;
					}
				}
			});
			
			var standardPoints = [];
			var deltaPoints = [];
			for (let i = 0; i < viewRows.length; i++) {
				const row = viewRows[i];
				var entry = {
					userName: row.userName,
					count: row.count
				};
				if (row.delta) {
					deltaPoints.push(entry);
				} else {
					standardPoints.push(entry);
				}
			}
			
			for (let i = 1; i <= 5; i++) {
				var tr = createTr({});
				table.appendChild(tr);
				
				tr.appendChild(createTd({innerHTML: i}));
				tr.appendChild(createTd({innerHTML: standardPoints.length >= i
					? standardPoints[i-1].count
					: ""}));
				tr.appendChild(createTd({innerHTML: standardPoints.length >= i
					? standardPoints[i-1].userName
					: ""}));
				tr.appendChild(createTd({innerHTML: deltaPoints.length >= i
					? deltaPoints[i-1].count
					: ""}));
				tr.appendChild(createTd({innerHTML: deltaPoints.length >= i
					? deltaPoints[i-1].userName
					: ""}));
			}			
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(DataNav); ?>
	
	<div id='pageContent'>
		<article>						
			<div id='CardDiv'>
				<div id='Column1' class='cardColumn'>
					<div id='CardLHS'>
						<ul>
							<li id='CardSpecies'></li>
							<li id='CardStatus'></li>
							<li id='CardClass'></li>
							<li id='CardPersonality'></li>
							<li id='CardSize'></li>
						</ul>
					</div>
				</div>
				<div id='Column2' class='cardColumn'>
					<img id='GeneralImage' src='' />
					<h1 id='H1'></h1>
					<div id='CardGeneral'></div>
					<div id='CardPowers'></div>
				</div>
				<div id='Column3' class='cardColumn'>
					<img id='CardImage' src='' />
					<div id='CardStatsDiv'>
						<div class='cardStatsDivTopRow'>
							<div id='CardLife'></div>
							<div id='CardLifeLabel'>LIFE</div>
						</div>
						<div class='cardStatsDivRow' id='MoveRow'>
							<div class='cardStatsRowLabel1'>MOVE</div>
							<div class='cardStatsDivRowRHS'>
								<div id='CardMove' class='cardStatsRowValue'></div>
								<div class='cardStatsRowLabel2'>SPACES</div>
							</div>
						</div>
						<div class='cardStatsDivRow' id='RangeRow'>
							<div class='cardStatsRowLabel1'>RANGE</div>
							<div class='cardStatsDivRowRHS'>
								<div id='CardRange' class='cardStatsRowValue'></div>
								<div class='cardStatsRowLabel2'>SPACES</div>
							</div>
						</div>
						<div class='cardStatsDivRow' id='AttackRow'>
							<div class='cardStatsRowLabel1'>ATTACK</div>
							<div class='cardStatsDivRowRHS'>
								<div id='CardAttack' class='cardStatsRowValue'></div>
								<div class='cardStatsRowLabel2'>DIE</div>
							</div>
						</div>
						<div class='cardStatsDivRow' id='DefenseRow'>
							<div class='cardStatsRowLabel1'>DEFENSE</div>
							<div class='cardStatsDivRowRHS'>
								<div id='CardDefense' class='cardStatsRowValue'></div>
								<div class='cardStatsRowLabel2'>DIE</div>
							</div>
						</div>
						<div class='cardStatsDivBottomRow'>
							<div id='CardPoints'></div>
							<div id='CardPointsLabel'>POINTS</div>
						</div>
					</div>
				</div>
				<div id='Column4' class='cardColumn'>
				
				</div>
			</div>
			
			<div>
				<div id='ReleaseSetDiv'></div>
				<div id='PowerRankingDiv'>
					<div id='PowerRanking_Classic'></div>
					<div id='PowerRanking_VC'></div>
				</div>
			</div>
			
			<h2>Win Rate Data</h2>
			<h3>Standard Points</h3>
			<div id='WinRateStandard'></div>
			<h3>Delta Points</h3>
			<div id='WinRateDelta'></div>
			
			<h2>Most Usage</h2>
			<table id='TopUsageUsersTable'>
				<tr>
					<th></th>
					<th colspan="2">Classic Points</th>
					<th colspan="2">Delta Points</th>
				</tr>
				<tr>
					<th></th>
					<th>Count</th>
					<th>User</th>
					<th>Count</th>
					<th>User</th>
				</tr>
			</table>
			
			<h2>Delta Price History (Classic Only)</h2>
			<div id='DeltaPriceGraph'></div>
		</article>
		
		<script>		
			var cardName = findGetParameter("name");
			if (cardName == null) {
				
				// TODO 
				
			} else {
				Card.load(
					{name: cardName},
					function (figures) {
						card = figures[0];
						displayCard();
					},
					{joins: {
						"generalID": {},
						"homeworldID": {},
						"speciesID": {},
						"classID": {},
						"personalityID": {},
						"sizeID": {},
						"releaseSetID": {
							"figureSubSetGroupID": {
								"figureSetID": {}
							}
						},
						"CardPower.cardID": {},
						"DeltaUpdateCost.cardID": {
							"deltaUpdateID" : {} 
						},
						"CardPowerRanking.cardID": {
							"powerRankingListID": {}
						}
					}}
				);
				
				UnitWinRateDeltaView.load(
					{name: cardName},
					function (units) {
						cardWinRateDelta = units[0];
						displayWinRateData();
					},
					{joins: {}}
				);
				UnitWinRateStandardView.load(
					{name: cardName},
					function (units) {
						cardWinRateStandard = units[0];
						displayWinRateData();
					},
					{joins: {}}
				);
				
				CardUsageByUserView.load(
					{cardName: cardName},
					function (rows) {
						displayUserUsageData(rows);
					},
					{joins: {}}
				);
				
				/*FigureUsageView.load(
					{Card_name: cardName,
						Tournament_started: true,
						HeroscapeTournament_useDeltaPricing: true,
						Tournament_maxNumPlayersPerGame: 2,
						Tournament_figureSetID: 1,
						HeroscapeTournament_numArmies: 1},
					function (viewEntries) {
						DatabaseObject.extractView(FigureUsageView.list);			
						displayWinRateData();
					},
					{joins: {}}
				);*/
			}
			
			
		</script>
	</div>
	<?php include(Footer); ?>
</div></body>
</html>