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
			class: 'glyph'/*,
			onclick: "_toggleGlyph("+glyph.id+")"*/
		});
		parentElem.appendChild(glyphDiv);
		
		var glyphLink = createA({
			href: "/map/glyph/view/?glyph="+glyph.name,
			target: "_blank",
			class: "glyphLink"
		});
		glyphDiv.appendChild(glyphLink);
		
		glyphLink.appendChild(createText(glyph.name));
		
		if (glyph.author != null) {
			glyphLink.appendChild(createSpan({
				class: "authorName",
				innerHTML: " [" + glyph.author.userName + "]"
			}));
		}
	}
}

function displayGlyph(glyph, parentElem, skipName=false) {
	var group1 = createDiv({
		class: "glyphLeft"
	});
	var group2 = createDiv({
		class: "glyphRight"
	});
	parentElem.appendChild(group1);
	parentElem.appendChild(group2);
	
	if ( ! skipName) {
		group1.appendChild(createDiv({
			class: "glyphName",
			innerHTML: glyph.name + " (" + glyph.abbreviation + ")"
		}));
	}
	group1.appendChild(createDiv({
		class: "glyphSummary",
		innerHTML: glyph.summary
	}));
	
	if (glyph.author != null) {
		var authorDiv = createDiv({
			class: "glyphAuthor",
			innerHTML: "Author: "
		});
		authorDiv.appendChild(createA({
			href: "https://heroscape.org/user/?userName="+glyph.author.userName,
			target: "_blank",
			innerHTML: glyph.author.userName
		}));
		group1.appendChild(authorDiv);
	}
	
	var typesDiv = createDiv({
		class: "glyphTypeGroup"
	});
	group1.appendChild(typesDiv);
	typesDiv.appendChild(createDiv({
		class: "glyphType",
		innerHTML: glyph.powerGlyph ? "Power" : "Treasure"
	}));
	typesDiv.appendChild(createDiv({
		class: "glyphType",
		innerHTML: glyph.temporaryGlyph ? "Temporary" : "Permanent"
	}));
	for (let i = 0; i < glyph.tags.length; i++) {
		const tag = glyph.tags[i];
		typesDiv.appendChild(createDiv({
			class: "glyphType",
			innerHTML: tag.name
		}));
	}
	
	if (glyph.imageUrl != null) {
		group2.appendChild(createImg({
			class: "glyphImage",
			src: glyph.imageUrl
		}));
	}
	
	parentElem.appendChild(createDiv({
		class: "glyphDescription",
		innerHTML: glyph.description
	}));				

}

/*selectedGlyph = null;
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
		
		displayGlyph(selectedGlyph, parentElem);
	}
}*/

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