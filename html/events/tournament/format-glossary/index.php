<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Format Glossary</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		.formatP {
			text-align: left;
		}
		
		.formatName {
			display: inline-block;
			font-weight: bold;
		}
		
		.formatMidSpacing {
			display: inline-block;
			width: 20px;
		}
		
		.formatDescription {
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
	<?php include(EventsNav); ?>
	
	<h1>Format Glossary</h1>
	
	<article>
		<div id='FormatGlossaryListBasic'>
			<p class='formatP'>
				<span class='formatName'>X Points (Standard / Delta)</span>
				<span class='formatMidSpacing'></span>
				<span class='formatDescription'>Your army cannot contain more than X points (either in Standard or Delta points, as specified).</span>
			</p>
			<p class='formatP'>
				<span class='formatName'>X Figures</span>
				<span class='formatMidSpacing'></span>
				<span class='formatDescription'>If your army contains more than X figures, you must sit however many figures you have > X.</span>
			</p>
			<p class='formatP'>
				<span class='formatName'>X Hexes</span>
				<span class='formatMidSpacing'></span>
				<span class='formatDescription'>If your army contains more than X hexes, you must sit however many hexes you have > X.</span>
			</p>
		</div>
		<hr>
		<div id='FormatGlossaryListDiv'></div>
	</article>
	
	<script>
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
						class: "formatP",
						id: "TournamentFormat_"+format.id
					});
					parentElem.appendChild(formatPElem);
					
					if (requestedId != null && requestedId == format.id) {
						formatPElem.classList.add("highlightedFormat");
					}
					
					formatPElem.appendChild(createSpan({
						class: "formatName",
						innerHTML: format.name
					}));
					
					if (format.description != null) {
						formatPElem.appendChild(createSpan({
							class: "formatMidSpacing",
							innerHTML: ""
						}));
						
						formatPElem.appendChild(createSpan({
							class: "formatDescription",
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
	</script>

	<?php include(Footer); ?>

</div></body>
</html>