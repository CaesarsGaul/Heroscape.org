<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Glyph</title>
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/glyph.css">
	<style>
		
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/glyph.js"></script>
	<script>		
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(MapNav); ?>
	
	<div id='pageContent'>
		<article>
			<h1 id='h1'></h1>
			<div id='Glyph'></div>
			
			
			<script>
				var glyphName = findGetParameter('glyph');
				if (glyphName != null) {
					Glyph.load(
						{name: glyphName}, 
						function (g) {	
							g = g[0];
							document.getElementById('h1').innerHTML = g.name + " (" + g.abbreviation + ")";
							displayGlyph(g, document.getElementById('Glyph'), true);
						}, 
						{joins: {
							"GlyphTagLink.glyphID": {
								"tagID": {}
							},
							"authorID": {}
						}}
					);
				}
			</script>
			
		</article>
	</div>

	<?php include(Footer); ?>

</div></body>
</html>