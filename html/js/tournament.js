function writeTournamentInfo(tournament, showName=true, showDateAndAddress=true, army=null) {
	var parentElem = document.getElementById("TournamentInfoDiv");		
	parentElem.innerHTML = "";
	
	if (showName) {
		parentElem.appendChild(createH1({innerHTML: tournament.fullDisplayName()}));
	}
	if (showDateAndAddress) {
		const startTime = createDate(tournament.startTime);		
		parentElem.appendChild(
			createP({
				innerHTML: 
					startTime.toLocaleDateString() + " " + 
					startTime.toLocaleTimeString()}));
					
		if (tournament.address != null) {
			parentElem.appendChild(createDiv({
				innerHTML: tournament.address
			}));
		}
	}
	
	_writeTournamentMaxesP(parentElem, tournament, army);
	_writeTournamentTagsP(parentElem, tournament);
	_writeTournamentFieldData(parentElem, tournament);
	
	if (tournament.description != null && tournament.description.length > 0) {
		parentElem.appendChild(createP({innerHTML: tournament.description.replaceAll("\n", "<br>")}));
	}
	
	if (typeof armies !== 'undefined' && armies !== null) {
		if (armies.length > 0) {
			var armiesDiv = createDiv({});
			parentElem.appendChild(armiesDiv);
			for (let i = 0; i < armies.length; i++) {
				var armyP = createP({innerHTML: "Army #"+(i+1) + " " + armies[i].toString(false, true)});
				armiesDiv.appendChild(armyP);
			}
		}
	}
}

function _writeTournamentMaxesP(parentElem, tournament, army) {
	var maxesP = createP({
		id: 'TournamentMaxesP',
		class: 'tournamentDescriptionP'
	});
	parentElem.appendChild(maxesP);
	
	const pointsLeft = army != null
		? tournament.pointLimit - army.getPoints()
		: tournament.pointLimit;
	const pointsClasses = "maxElem" + (pointsLeft == 0 ? " maxElemFull" : "");
	maxesP.appendChild(createSpan({
		class: pointsClasses, 
		innerHTML: pointsLeft + " Points (" + (tournament.useDeltaPricing ? "Delta" : "Standard") +  ")"}));

	if (tournament.hexLimit != null) {
		const hexesLeft = army != null
			? tournament.hexLimit - army.getHexes()
			: tournament.hexLimit;
		const hexesClasses = "maxElem" + (hexesLeft <= 0 ? " maxElemFull" : "");
		maxesP.appendChild(createSpan({class: hexesClasses, innerHTML: hexesLeft + " Hexes"}));
	}
	
	if (tournament.figureLimit != null) {
		const figuresLeft = army != null
			? tournament.figureLimit - army.getFigures()
			: tournament.figureLimit;
		const figuresClasses = "maxElem" + (figuresLeft <= 0 ? " maxElemFull" : "");
		maxesP.appendChild(createSpan({class: figuresClasses, innerHTML: figuresLeft + " Figures"}));
	}
}

function _writeTournamentTagsP(parentElem, tournament) {
	if (tournament.tournamentFormatTags.length > 0) {
		var tagsP = createP({
			id: 'TournamentTagsP',
			class: 'tournamentDescriptionP'
		});
		parentElem.appendChild(tagsP);
		for (let i = 0; i < tournament.tournamentFormatTags.length; i++) {
			const tag = tournament.tournamentFormatTags[i];
			var tagText = tag.format.name;
			if (tag.data != null) {
				switch (tag.format.name) {
					case "Ban List":
						break; // Do Nothing
					case "YxZ (i.e. 4x400)":
						const dataArray = tag.data.split(";");
						tagText = dataArray[0] + "x" + dataArray[1];
						break;
					case "X(+/-) & Under":
						tagText = tagText.replace("(+/-)", "");
					case "Rule of X":
					case "X Card Draft":
					case "X Pod Draft":
					case "Max X Copies - Squads":
					case "Max X Copies - Heroes":
						tagText = tagText.replace("X", tag.data);
						break;
					default:
						tagText = tagText + " (" + tag.data + ")";
						break
				}
			}
			
			var tagSpan = createSpan({
				class: "tournamentTag",
				innerHTML: tagText
			});
			tagsP.appendChild(tagSpan);
			
			if (tag.format.description != null) {
				tagSpan.appendChild(createA({
					class: "tagInfo",
					innerHTML: "?",
					href: "/events/tournament/format-glossary/#TournamentFormat_"+tag.format.id,
					target: "_blank"
				}));
				tagSpan.appendChild(createSpan({
					class: "tagHoverDescription",
					innerHTML: tag.format.description
				}));
			}
		}
	}
}

function _writeTournamentFieldData(parentElem, tournament) {
	var fieldDataP = createP({
		id: 'TournamentFieldDataP',
		class: 'tournamentDescriptionP'
	});
	parentElem.appendChild(fieldDataP);
	
	if (tournament.maxNumPlayersPerGame > 2) {
		fieldDataP.appendChild(createSpan({
			class: "maxElem",
			innerHTML: "Multiplayer (" + tournament.maxNumPlayersPerGame + ")"
		}));
	}
	
	if (tournament.roundLengthMinutes != null) {
		fieldDataP.appendChild(createSpan({
			class: "maxElem",
			innerHTML: tournament.roundLengthMinutes + " Minute Rounds"
		}));
	}
	
	if (tournament.includeVC) {
		fieldDataP.appendChild(createSpan({
			class: "maxElem",
			innerHTML: "VC"
		}));
	}
	
	if (tournament.includeMarvel) {
		fieldDataP.appendChild(createSpan({
			class: "maxElem",
			innerHTML: "Marvel"
		}));
	}
}