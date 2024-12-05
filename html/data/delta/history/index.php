<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Delta Pricing History</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/about.css">
	<style>
		#pageContent {
			max-width: 1500px
		}
		article {
			display: flex;
			flex-direction: row;
			max-width: 1400px;
		}
		
		#LeftColumn, #RightColumn {
			display: inline-block;
			vertical-align: top;
			margin-left: 5px;
			margin-right: 5px;
		}
		
		#LeftColumn {
			width: 325px;
		}
		
		#FigureList {
			max-height: calc(100vh - 250px);
			overflow: scroll;
			text-align: left;
		}
		
		#RightColumn {
			width: calc(100% - 350px);
		}
		
		@media only screen and (max-width: 950px) {
			article {
				flex-direction: column;
			}
			#LeftColumn {
				order: 2;
				width: calc(100% - 20px);
			}
			#RightColumn {
				order: 1;
				width: calc(100% - 20px);
			}
		}
		
		
	</style>
	
	<!-- Internal Files -->
	<script src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="/js/scripts.js"></script>
	<script>
		google.charts.load('current', {packages: ['corechart', 'line']});
		//google.charts.setOnLoadCallback(drawChart);
		
		function writeFigureList() {
			var parentElement = document.getElementById("FigureList");
			parentElement.innerHTML = "";
			
			for (let i = 0; i < Card.list.length; i++) {
				const card = Card.list[i];
				if ( ! vcInclusive && card.figureSetSubGroups[0].name == "Valhalla Customs (VC)") {
					continue;
				}
				
				var cardDiv = createDiv({
					class: "cardSelectDiv"
				});
				parentElement.appendChild(cardDiv);
				
				var cardLabel = createLabel({});
				cardDiv.appendChild(cardLabel);
				
				var inputElem = createInput({
					class: "cardInput",
					type: "checkbox",
					onchange: "_toggleCheckbox()"
				});
				$(inputElem).data("card", card);
				cardLabel.appendChild(inputElem);
				cardLabel.appendChild(createSpan({
					class: "cardName",
					innerHTML: card.name
				}));
			}
		}
		
		function _toggleCheckbox() {
			drawGraph();
		}
		
		var vcInclusive = false;
		function drawGraph() {
			var parentElement = document.getElementById("Graph");
			parentElement.innerHTML = "";
			
			var data = new google.visualization.DataTable();
			
			var selectedCheckboxes = $('.cardInput:checkbox:checked');
			
			data.addColumn('string', 'X');
			for (let i = 0; i < selectedCheckboxes.length; i++) {
				const card = $(selectedCheckboxes[i]).data("card");
				data.addColumn('number', card.name);
			}
			if (selectedCheckboxes.length == 0) {
				data.addColumn('number', 'Placeholder');
			}
			
			// Add Printed Cost to Graph ? 
			
			var dataRows = [];
			
			if (selectedCheckboxes.length > 0) {
				var firstRow = ["Printed"];
				for (let i = 0; i < selectedCheckboxes.length; i++) {
					const card = $(selectedCheckboxes[i]).data("card");
					firstRow.push(card.points);
				}
				dataRows.push(firstRow);
			}
			
			
			
			DeltaUpdate.list.sort(function(a,b) {
				if (a.date < b.date) {
					return -1;
				}
				if (a.date > b.date) {
					return 1;
				}
				return 0;
			});
			for (let i = 0; i < DeltaUpdate.list.length; i++) {
				const deltaUpdate = DeltaUpdate.list[i];

				var dataRow = [deltaUpdate.date.substr(0, 7)];
				for (let i = 0; i < selectedCheckboxes.length; i++) {
					const card = $(selectedCheckboxes[i]).data("card");
					dataRow.push(findCost(card, deltaUpdate));
				}
				if (selectedCheckboxes.length == 0) {
					dataRow.push(0);
				}
				dataRows.push(dataRow);
			}
			data.addRows(dataRows);

			var options = {
				hAxis: {
					title: 'Date'
				},
				vAxis: {
					title: 'Cost'
				},
				series: {
					1: {}
				},
				/*width: ,*/
				height: 500
			};

			var chart = new google.visualization.LineChart(parentElement);
			chart.draw(data, options);
		}
		
		function findCost(card, deltaUpdate) {
			var cost = null;
			for (let i = 0; i < DeltaUpdate.list.length; i++) {
				const dUpdate = DeltaUpdate.list[i];
				for (let j = 0; j < dUpdate.deltaUpdateCosts.length; j++) {
					const deltaUpdateCost = dUpdate.deltaUpdateCosts[j];
					if (deltaUpdateCost.card.id == card.id) {
						var newCost = vcInclusive
							? deltaUpdateCost.vcPoints
							: deltaUpdateCost.points;
						if (newCost != null) {
							cost = newCost;
						}
					}
				}
				if (dUpdate.id == deltaUpdate.id) {
					break;
				}
			}
			return cost;
		}
		
		function switchClassicVc(refThis) {
			vcInclusive = refThis.checked;
			if (vcInclusive) {
				document.getElementById("classicToggle").classList.remove("toggleSwitchSelected");
				document.getElementById("vcToggle").classList.add("toggleSwitchSelected");
			} else {
				document.getElementById("classicToggle").classList.add("toggleSwitchSelected");
				document.getElementById("vcToggle").classList.remove("toggleSwitchSelected");
			}
			writeFigureList();
			drawGraph();
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(DataNav); ?>
	
	<div id='pageContent'>
		<h1>Delta Pricing History</h1>
		<article>						
			<div id='LeftColumn'>
				<div id='VcToggle'>
					<span class="toggleSwitch"><!-- Classic / VC -->
						<span id="classicToggle" class="toggleSwitchString toggleSwitchSelected">Classic</span>
						<label class="switch"> 
							<input id="vcCheckbox" type="checkbox" onchange="switchClassicVc(this)">
							<span class="slider round"></span>
						</label>
						<span id="vcToggle" class="toggleSwitchString">VC</span>
					</span>
				</div>
				
				<div id='FigureList'></div>
			</div>
			
			<div id='RightColumn'>
				<div id='Graph'>Loading...</div>
			</div>
			
		</article>
		
		<script>
			//DeltaUpdate.load({}, function(){}, {}); // TODO - remove thhis 
			
			Card.load(
				{},
				function (cards) {
					
					// TODO 
					
					writeFigureList();
					
					drawGraph();
					
				},
				{joins: {
					"generalID": {},
					"homeworldID": {},
					"speciesID": {},
					"personalityID": {},
					"sizeID": {},
					"releaseSetID": {},
					"CardPower.cardID": {},
					"CardFigureSetSubGroupLink.cardID": {
						"figureSetSubGroupID": {
							"figureSetID": {}
						}
					},
					"CardPowerRanking.cardID": {
						"powerRankingListID": {}
					},
					"DeltaUpdateCost.cardID": {
						"deltaUpdateID": {}
					}
				}}
			);
		</script>
	</div>
	<?php include(Footer); ?>
</div></body>
</html>