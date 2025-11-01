<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Delta Pricing History</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/about.css">
	<link rel="stylesheet" href="/css/builder.css">
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
	<script src="/js/deltaPriceGraph.js"></script>
	<script src='/js/armyBuilder.js'></script>
	<script>
		google.charts.load('current', {packages: ['corechart', 'line']});
		//google.charts.setOnLoadCallback(drawChart);
		
		function redrawPage() {
			var parentElement = document.getElementById("FigureList");
			parentElement.innerHTML = "";
			
			for (let i = 0; i < Card.list.length; i++) {
				const card = Card.list[i];
				if (card.figureSet.id != 1) {
					continue;
				}
				
				if ( ! document.getElementById(card.figureSetSubGroup.name + "_checkbox").checked) {
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
			drawDeltaPriceGraph();
		}
		
		//var vcInclusive = false;
		
		
		
		
		/*function switchClassicVc(refThis) {
			vcInclusive = refThis.checked;
			if (vcInclusive) {
				document.getElementById("classicToggle").classList.remove("toggleSwitchSelected");
				document.getElementById("vcToggle").classList.add("toggleSwitchSelected");
			} else {
				document.getElementById("classicToggle").classList.add("toggleSwitchSelected");
				document.getElementById("vcToggle").classList.remove("toggleSwitchSelected");
			}
			redrawPage();
			drawDeltaPriceGraph();
		}*/
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(DataNav); ?>
	
	<div id='pageContent'>
		<h1>Delta Pricing History</h1>
		<article>						
			<div id='LeftColumn'>
				<div id='Tier1SubGroups' class='row1Group tierSubGroup'></div>
				<div id='Tier2SubGroups' class='row1Group tierSubGroup'></div>
				<script>
					FigureSetSubGroup.load(
						{/*figureSet: */},
						function (figureSetSubGroups) {
							createFigureSetCheckboxes(figureSetSubGroups);
						}, 
						{joins: {}}
					);
				</script>
						
				<div id='FigureList'></div>
			</div>
			
			<div id='RightColumn'>
				<div id='DeltaPriceGraph'>Loading...</div>
			</div>
			
		</article>
		
		<script>
			//DeltaUpdate.load({}, function(){}, {}); // TODO - remove thhis 
			
			Card.load(
				{},
				function (cards) {
					
					// TODO 
					console.log(cards);
					redrawPage();
					
					drawDeltaPriceGraph();
					
				},
				{joins: {
					"generalID": {},
					"homeworldID": {},
					"speciesID": {},
					"personalityID": {},
					"sizeID": {},
					"releaseSetID": {},
					"CardPower.cardID": {},
					/*"CardFigureSetSubGroupLink.cardID": {
						"figureSetSubGroupID": {
							"figureSetID": {}
						}
					},*/
					"CardPowerRanking.cardID": {
						"powerRankingListID": {}
					},
					"DeltaUpdateCost.cardID": {
						"deltaUpdateID": {}
					},
					"figureSetID": {},
					"figureSetSubGroupID": {}
				}}
			);
		</script>
	</div>
	<?php include(Footer); ?>
</div></body>
</html>