<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Figures | Release Sets</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/about.css">
	<style>
		#ReleaseSets {
			max-width: 600px;
			margin: auto;
		}
		.releaseSet {
			text-align: left;
		}
		.releaseSet p {
			margin-top: 0;
			margin-bottom: 0;
			margin-left: 20px;
		}
		.releaseSet p a {
			color: inherit !important;
			text-decoration: none;
		}
		.releaseSet p a:visited {
			color: inherit !important;
		}
		
		
	</style>
	
	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script>
		function displayReleaseSets(releaseSets) {
			var parentElem = document.getElementById("ReleaseSets");
			
			for (let i = 0; i < releaseSets.length; i++) {
				const releaseSet = releaseSets[i];
				
				var setDiv = createDiv({
					class: "releaseSet"
				});
				parentElem.appendChild(setDiv);
				
				setDiv.appendChild(createText(releaseSet.name));
				
				if (releaseSet.figureSubSetGroup.name == "Valhalla Customs (VC)") {
					setDiv.appendChild(createText(" (VC)"));
				} else if (releaseSet.figureSubSetGroup.name == "Age of Annihilation (AoA)") {
					setDiv.appendChild(createText(" (AoA)"));
				} else if (releaseSet.figureSubSetGroup.name == "Marvel") {
					setDiv.appendChild(createText(" (Marvel)"));
				}
				
				setDiv.appendChild(createText(" [" + releaseSet.releaseDate + "]"));
				
				/*setDiv.appendChild(createP({
					innerHTML: releaseSet.releaseDate
				}));*/
				
				for (let j = 0; j < releaseSet.cards.length; j++) {
					const card = releaseSet.cards[j];
					var pElem = createP({})
					setDiv.appendChild(pElem);
					pElem.appendChild(createA({
						innerHTML: card.name,
						href: "/data/figures/card?name="+card.name
					}));
				}
			}
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(DataNav); ?>
	
	<div id='pageContent'>
		<h1>Release Sets</h1>
		<article>						
			<div id='ReleaseSets'></div>
		</article>
		
		<script>			
			ReleaseSet.load(
				{},
				function (releaseSets) {
					displayReleaseSets(releaseSets);
				},
				{joins: {
					"figureSubSetGroupID": {
						"figureSetID": {}
					},
					"Card.releaseSetID": {
						/*"generalID": {},
						"homeworldID": {},
						"speciesID": {},
						"personalityID": {},
						"sizeID": {},
						"CardPower.cardID": {},
						"CardFigureSetSubGroupLink.cardID": {
							"figureSetSubGroupID": {
								"figureSetID": {}
							}
						},
						"CardPowerRanking.cardID": {
							"powerRankingListID": {}
						}*/
					}
				}}
			);
		</script>
	</div>
	<?php include(Footer); ?>
</div></body>
</html>