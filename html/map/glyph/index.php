<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Glyphs</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		#Glyphs, #GlyphSearch {
			display: inline-block;
			vertical-align: top;
			text-align: left;
			flex-grow: 1;
			max-width: 300px;
		}
	
		#GlyphSearch label {
			display: block;
			text-align: left;
		}
		
		.glyph {
			
		}
		
		#Glyph {
			border: 1px solid black;
			display: none;
			max-width: 400px;
			margin: auto;
		}
		
		.glyphLeft, .glyphRight {
			display: inline-block;
			vertical-align: top;
			text-align: left;
			flex-grow: 1;
		}
		
		.glyphLeft {
			text-align: center;
		}
		
		.glyphRight {
			
		}
		
		.glyphName {
			font-weight: bold;
		}
		
		.glyphSummary {
			
		}
		
		.glyphDescription {
			
		}
		
		.glyphTypeGroup {
			font-style: italic;
		}
		
		.glyphType {
			display: inline-block;
		}
		
		.glyphType:not(:first-child):before  {
			content: "|";
			margin-right: 5px;
			margin-left: 5px;
		}
		
		.glyphImage {
			width: 100px;
			margin-left: 10px;
		}
		
		.authorName {
			color: red;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script>
		glyphs = null;
		tags = null;
		
		function _displayGlyphs() {
			const parentElem = document.getElementById('Glyphs');
			parentElem.innerHTML = "";
			parentElem.appendChild(createH2({innerHTML: "Glyphs"}));
			
			const powerTreasureOption = 
				parseInt(document.querySelector('input[name="powerTreasure"]:checked').value);
			const permanentTemporaryOption = 
				parseInt(document.querySelector('input[name="permanentTemporary"]:checked').value);
			/*const classicVcOption = 
				parseInt(document.querySelector('input[name="classicVc"]:checked').value);*/
			
			const tagCheckboxes = document.getElementsByClassName("tagCheckbox");
			var selectedTagIDs = [];
			for (let i = 0; i < tagCheckboxes.length; i++) {
				const tagCheckbox = tagCheckboxes[i];
				if (tagCheckbox.checked) {
					const tagId = parseInt(tagCheckbox.id.split("_")[1]);
					selectedTagIDs.push(tagId);
				}
			}
			
			const searchText = document.getElementById("searchBarInput").value.toLowerCase();
			
			for (var i = 0; i < glyphs.length; i++) {
				const glyph = glyphs[i];
				
				if (searchText.length > 0) {
					if ( ! glyph.name.toLowerCase().includes(searchText) && 
							! glyph.summary.toLowerCase().includes(searchText) &&
							! glyph.description.toLowerCase().includes(searchText)) {
						continue;		
					}
				}
				
				switch (powerTreasureOption) {
					case 1:
						if ( ! glyph.powerGlyph) {
							continue;
						}
						break;
					case 2:
						if (glyph.powerGlyph) {
							continue;
						}
						break;
				}
				switch (permanentTemporaryOption) {
					case 1:
						if (glyph.temporaryGlyph) {
							continue;
						}
						break;
					case 2:
						if ( ! glyph.temporaryGlyph) {
							continue;
						}
						break;
				}
				/*switch (classicVcOption) {
					case 1:
						if (glyph.vcGlyph) {
							continue;
						}
						break;
					case 2:
						if ( ! glyph.vcGlyph) {
							continue;
						}
						break;
				}*/
				var tagSelected = false;
				for (let j = 0; j < glyph.tags.length; j++) {
					const tag = glyph.tags[j];
					if (selectedTagIDs.includes(tag.id)) {
						tagSelected = true;
						break;
					}
				}
				if ( ! tagSelected && glyph.tags.length > 0) {
					continue;
				}
				
				var glyphDiv = createDiv({
					class: 'glyph',
					onclick: "_toggleGlyph("+glyph.id+")"
				});
				parentElem.appendChild(glyphDiv);
				
				glyphDiv.appendChild(createText(glyph.name));
				
				if (glyph.author != null) {
					glyphDiv.appendChild(createSpan({
						class: "authorName",
						innerHTML: " [" + glyph.author.userName + "]"
					}));
				}
			}
		}
		
		selectedGlyph = null;
		function _toggleGlyph(glyphId) {
			const parentElem = document.getElementById('Glyph');
			parentElem.innerHTML = "";
			if (selectedGlyph != null && selectedGlyph.id == glyphId) {
				selectedGlyph = null;
				parentElem.style.display = "none";
			} else {
				parentElem.style.display = "block";
				for (let i = 0; i < glyphs.length; i++) {
					if (glyphs[i].id == glyphId) {
						selectedGlyph = glyphs[i];
						break;
					}
				}
				
				var group1 = createDiv({
					class: "glyphLeft"
				});
				var group2 = createDiv({
					class: "glyphRight"
				});
				parentElem.appendChild(group1);
				parentElem.appendChild(group2);
				
				group1.appendChild(createDiv({
					class: "glyphName",
					innerHTML: selectedGlyph.name + " (" + selectedGlyph.abbreviation + ")"
				}));
				group1.appendChild(createDiv({
					class: "glyphSummary",
					innerHTML: selectedGlyph.summary
				}));
				
				if (selectedGlyph.author != null) {
					var authorDiv = createDiv({
						class: "glyphAuthor",
						innerHTML: "Author: "
					});
					authorDiv.appendChild(createA({
						href: "https://heroscape.org/user/?userName="+selectedGlyph.author.userName,
						target: "_blank",
						innerHTML: selectedGlyph.author.userName
					}));
					group1.appendChild(authorDiv);
				}
				
				var typesDiv = createDiv({
					class: "glyphTypeGroup"
				});
				group1.appendChild(typesDiv);
				typesDiv.appendChild(createDiv({
					class: "glyphType",
					innerHTML: selectedGlyph.powerGlyph ? "Power" : "Treasure"
				}));
				typesDiv.appendChild(createDiv({
					class: "glyphType",
					innerHTML: selectedGlyph.temporaryGlyph ? "Temporary" : "Permanent"
				}));
				for (let i = 0; i < selectedGlyph.tags.length; i++) {
					const tag = selectedGlyph.tags[i];
					typesDiv.appendChild(createDiv({
						class: "glyphType",
						innerHTML: tag.name
					}));
				}
				/*if (selectedGlyph.vcGlyph) {
					typesDiv.appendChild(createDiv({
						class: "glyphType",
						innerHTML: "C3V"
					}));
				}*/
				
				if (selectedGlyph.imageUrl != null) {
					group2.appendChild(createImg({
						class: "glyphImage",
						src: selectedGlyph.imageUrl
					}));
				}
				
				parentElem.appendChild(createDiv({
					class: "glyphDescription",
					innerHTML: selectedGlyph.description
				}));				
			}
		}
		
		function _displayGlyphTags() {
			var parentElem = document.getElementById("GlyphTags");
			
			for (let i = 0; i < tags.length; i++) {
				const tag = tags[i];
				
				var label = createLabel({
					
				});
				parentElem.appendChild(label);
				
				var checkbox = createInput({
					id: "tag_"+tag.id,
					name: "tag_"+tag.id,
					class: "tagCheckbox",
					type: "checkbox",
					onchange: "_displayGlyphs()"
				});
				if (tag.id == 1 || tag.id == 3) {
					checkbox.checked = true;
				}
				label.appendChild(checkbox);
				label.appendChild(createText(tag.name));
			}			
			
			if (glyphs != null) {
				_displayGlyphs();
			}
		}
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