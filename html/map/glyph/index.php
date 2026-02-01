<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Glyphs</title>
		
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
			<div id='Glyphs'></div>
			<div id='GlyphSearch'>
				<h2>Search & Filter</h2>
				<div id='SearchBar'>
					<input 
						id='searchBarInput' 
						type='text' 
						placeholder='Search...'
						oninput='_displayGlyphs()' />
				</div>
				<div id='PowerTreasure'>
					<h3>Power / Treasure</h3>
					<label>
						<input id='powerAndTreasure' name='powerTreasure' value=0 type='radio' oninput='_displayGlyphs()' checked='checked'/>
						Both
					</label>
					<label>
						<input id='power' name='powerTreasure' value=1 type='radio' oninput='_displayGlyphs()'/>
						Power
					</label>
					<label>
						<input id='treasure' name='powerTreasure' value=2 type='radio' oninput='_displayGlyphs()'/>
						Treasure
					</label>
				</div>
				<div id='PermanentTemporary'>
					<h3>Permanent / Temporary</h3>
					<label>
						<input id='permanentAndTemporary' name='permanentTemporary' value=0 type='radio' oninput='_displayGlyphs()' checked='checked'/>
						Both
					</label>
					<label>
						<input id='permanent' name='permanentTemporary' value=1 type='radio' oninput='_displayGlyphs()'/>
						Permanent
					</label>
					<label>
						<input id='treasure' name='permanentTemporary' value=2 type='radio' oninput='_displayGlyphs()'/>
						Temporary
					</label>
				</div>
				<!--<div id='ClassicVc'>
					<h3>Classic / C3V</h3>
					<label>
						<input id='classicAndVC' name='classicVc' value=0 type='radio' oninput='_displayGlyphs()'/>
						Both
					</label>
					<label>
						<input id='classic' name='classicVc' value=1 type='radio' oninput='_displayGlyphs()' checked='checked'/>
						Classic
					</label>
					<label>
						<input id='vc' name='classicVc' value=2 type='radio' oninput='_displayGlyphs()'/>
						C3V
					</label>
				</div>-->
				<div id='GlyphTag'>
					<h3>Tags</h3>
					<div id='GlyphTags'></div>
				</div>
				
			</div>
			<div id='Glyph'></div>
			
			<script>
				
				
				Glyph.load(
					{}, 
					function (g) {	
						glyphs = g;
						if (tags != null) {
							_displayGlyphs();
						}
					}, 
					{joins: {
						"GlyphTagLink.glyphID": {
							"tagID": {}
						},
						"authorID": {}
					}}
				);
				
				GlyphTag.load(
					{}, 
					function (t) {
						tags = t;
						_displayGlyphTags();
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