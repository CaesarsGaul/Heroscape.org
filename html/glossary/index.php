<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Glossary</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		h2 {
			text-align: center;
			max-width: 950px;
			margin: auto;
		}
		
		.glossaryTermP {
			text-align: left;
		}
		
		.glossaryTermName {
			display: inline-block;
			font-weight: bold;
		}
		
		.glossaryTermMidSpacing {
			display: inline-block;
			width: 20px;
		}
		
		.glossaryTermDefinition {
			display: inline;
		}
		
		.highlightedFormat {
			background-color: yellow;
		}
		
		.noBuilderEffect {
			display: inline-block;
			color: red;
			margin-left: 20px;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script>
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<h1>Glossary</h1>
	
	<h2>General Terms</h2>
	
	<article>
		<div id='GeneralTermsList'>
		
		</div>
	</article>
	
	
	<h2>Formats</h2>
	
	<article>
		<div id='FormatGlossaryListBasic'>
			<p class='glossaryTermP'>
				<span class='glossaryTermName'>X Points (Standard / Delta)</span>
				<span class='glossaryTermMidSpacing'></span>
				<span class='glossaryTermDefinition'>Your army cannot contain more than X points (either in Standard or Delta points, as specified).</span>
			</p>
			<p class='glossaryTermP'>
				<span class='glossaryTermName'>X Figures</span>
				<span class='glossaryTermMidSpacing'></span>
				<span class='glossaryTermDefinition'>If your army contains more than X figures, you must sit however many figures you have > X.</span>
			</p>
			<p class='glossaryTermP'>
				<span class='glossaryTermName'>X Hexes</span>
				<span class='glossaryTermMidSpacing'></span>
				<span class='glossaryTermDefinition'>If your army contains more than X hexes, you must sit however many hexes you have > X.</span>
			</p>
		</div>
		<hr>
		<div id='FormatGlossaryListDiv'></div>
	</article>
	
	<h2>Figure Nicknames</h2>
	
	<article>
		<div id='FigureNicknameList'>
			
		</div>
	</article>
	
	
	<script>
	
		Term.load(
			{},
			function (terms) {
				var parentElem = document.getElementById("GeneralTermsList");
				for (let i = 0; i < terms.length; i++) {
					const term = terms[i];
					
					var pElem = createP({
						class: "glossaryTermP",
						id: "Term_"+term.id
					});
					parentElem.appendChild(pElem);
					
					pElem.appendChild(createSpan({
						class: "glossaryTermName",
						innerHTML: term.name
					}));
					
					pElem.appendChild(createSpan({
						class: "glossaryTermMidSpacing",
						innerHTML: ""
					}));
					
					pElem.appendChild(createSpan({
						class: "glossaryTermDefinition",
						innerHTML: term.definition
					}));
				}
			},
			{joins: {}}
		);
		
		TournamentFormat.load(
			{}, // TODO : filter by start/end 
			function(formats) {
				var parentElem = document.getElementById("FormatGlossaryListDiv");
				var requestedId = null;
				if (window.location.hash.length > 0) {
					requestedId = window.location.hash.split("_")[1];
				}
				for (let i = 0; i < formats.length; i++) {
					const format = formats[i];
					
					var formatPElem = createP({
						class: "glossaryTermP",
						id: "TournamentFormat_"+format.id
					});
					parentElem.appendChild(formatPElem);
					
					if (requestedId != null && requestedId == format.id) {
						formatPElem.classList.add("highlightedFormat");
					}
					
					formatPElem.appendChild(createSpan({
						class: "glossaryTermName",
						innerHTML: format.name
					}));
					
					if (format.description != null) {
						formatPElem.appendChild(createSpan({
							class: "glossaryTermMidSpacing",
							innerHTML: ""
						}));
						
						formatPElem.appendChild(createSpan({
							class: "glossaryTermDefinition",
							innerHTML: format.description
						}));
					}
				}
				
				if (requestedId != null) {
					document.getElementById(window.location.hash.substr(1)).scrollIntoView(true);
				}
			},
			{joins: {
				
			}}
		);
		
		FigureNickname.load(
			{},
			function (nicknames) {
				var parentElem = document.getElementById("FigureNicknameList");
				for (let i = 0; i < nicknames.length; i++) {
					const nickname = nicknames[i];
					
					var pElem = createP({
						class: "glossaryTermP",
						id: "FigureNickname_"+nickname.id
					});
					parentElem.appendChild(pElem);
					
					pElem.appendChild(createSpan({
						class: "glossaryTermName",
						innerHTML: nickname.nickname
					}));
					
					pElem.appendChild(createSpan({
						class: "glossaryTermMidSpacing",
						innerHTML: ""
					}));
					
					pElem.appendChild(createSpan({
						class: "glossaryTermDefinition",
						innerHTML: nickname.name
					}));
				}
			},
			{joins: {}}
		);
	</script>

	<?php include(Footer); ?>

</div></body>
</html>