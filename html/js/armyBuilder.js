var builder = window.location.href.includes("builder");
var partialScoring = window.location.href.includes("scoring");
var tournamentSignup = window.location.href.includes("tournament");

var armyMin = 1;

var deltaPoints = false;

function changeArmyMin() {
	var checked = document.getElementById("armyMinCheckbox").checked;
	if (checked) {
		armyMin = 0;
	} else {
		armyMin = 1;
	}
}

var firstTimeDisplayingUnits = true;
function displayUnits() {	
	var tableElem;
	
	var builderSort1Cookie = getCookieValue("hs_setting_Builder_Sort_1");
	var builderSort2Cookie = getCookieValue("hs_setting_Builder_Sort_2");
	if (builderSort1Cookie !== null && firstTimeDisplayingUnits) {
		builderSort1Cookie = decodeURI(builderSort1Cookie);
		var sortElem = document.getElementById("sort1");
		for (let i = 0; i < sortElem.options.length; i++) {
			if (sortElem.options[i].innerHTML == builderSort1Cookie) {
				sortElem.selectedIndex = i;
				sortOption1 = sortElem.options[i].value;
				break;
			}
		}
	}
	if (builderSort2Cookie !== null && firstTimeDisplayingUnits) {
		builderSort2Cookie = decodeURI(builderSort2Cookie);
		var sortElem = document.getElementById("sort2");
		for (let i = 0; i < sortElem.options.length; i++) {
			if (sortElem.options[i].innerHTML == builderSort2Cookie) {
				sortElem.selectedIndex = i;
				sortOption2 = sortElem.options[i].value;
				break;
			}
		}
	}
	firstTimeDisplayingUnits = false;
	
	if (builder || tournamentSignup) {
		var parentElem = document.getElementById('Figures');
		tableElem = createTable({id: "unitTable"});
		if (parentElem !== undefined && parentElem !== null) {
			parentElem.innerHTML = "";
			parentElem.appendChild(tableElem);
		}
		
		var headerRowElem = createTr({class: "unitTableHeaderRow"});
		tableElem.appendChild(headerRowElem);
		headerRowElem.appendChild(createTh({id: "unitTableHeader1", innerHTML: "Unit"}));
		headerRowElem.appendChild(createTh({id: "unitTableHeader2", innerHTML: "Points"}));
		headerRowElem.appendChild(createTh({id: "unitTableHeader3", innerHTML: "Quantity"}));
	}
	
	if (partialScoring) {
		var partialCardScoringModeParentElem = document.getElementById("FiguresPartialCardScoring");
		partialCardScoringModeParentElem.innerHTML = "";
		tableElem = createTable({id: "partialCardScoringUnitTable"});
		partialCardScoringModeParentElem.appendChild(tableElem);
	
		var headerRowElemPartialCard = createTr({class: "unitTableHeaderRow"});
		tableElem.appendChild(headerRowElemPartialCard);
		headerRowElemPartialCard.appendChild(createTh({id: "unitTablePartialHeader1", innerHTML: "Unit"}));
		headerRowElemPartialCard.appendChild(createTh({id: "unitTablePartialHeader2", innerHTML: "Points"}));
		headerRowElemPartialCard.appendChild(createTh({id: "unitTablePartialHeader3", innerHTML: "Army 1"}));
		headerRowElemPartialCard.appendChild(createTh({id: "unitTablePartialHeader4", innerHTML: "Army 2"}));
	}
	
	units.sort(_compareUnits);
	
	var previousSortValue = null;
	for (let i = 0; i < units.length; i++) {
		const unit = units[i];
		
		if (typeof tournament == "object") { // Tournament Builder or Army Submission
			var tourneyAllows = false;
			for (let j = 0; j < tournament.tournamentIncludesFigureSetSubGroups.length; j++) {
				const subGroupLink = tournament.tournamentIncludesFigureSetSubGroups[j];
				if (subGroupLink.figureSetSubGroup.name == unit.subGroup && subGroupLink.include) {
					tourneyAllows = true;
					break;
				}
			}
			if ( ! tourneyAllows) {
				if (army.containsUnit(unit)) {
					army.removeUnit(unit, true);
				}
				continue;
			}
		} else { // Main Builder or PCS Page
			var checkboxElem = document.getElementById(unit.subGroup + "_checkbox");
			if (checkboxElem != null && ! checkboxElem.checked) {
				if (builder) {
					if (army.containsUnit(unit)) {
						army.removeUnit(unit, true);
					}
				}
				if (partialScoring) {
					if (partialScoringArmy1.containsUnit(unit)) {
						partialScoringArmy1.removeUnit(unit, true);
					}
					if (partialScoringArmy2.containsUnit(unit)) {
						partialScoringArmy2.removeUnit(unit, true);
					}
				}
				continue;
			}
		}
		
		if (tournamentSignup) {
			if (tournament.allowedPointOverlap == 0) {
				// TODO : this only works for a ZERO point overlap currently 
				for (let j = 0; j < armies.length; j++) {
					if (armies[j].containsUnit(unit)) {
						continue;
					}
				}
			}
		}
				
		if (typeof tournament !== 'undefined') {
			var ineligibleUnit = false;
			for (let j = 0; j < tournament.tournamentFormatTags.length; j++) {
				const tag = tournament.tournamentFormatTags[j];
				const format = tag.format;
				
				switch (format.name) {
					case "Assasination":
					case "Bring-2":
					case "Chaos of Battle":
					case "Cheese":
					case "Control Points":
					case "General Wars":
					case "Heat of Battle":
					case "Insanity of Battle":
					case "Monster Mash":
					case "Rainbow Wars":
					case "Reverse the Whip":
					case "Rule of X":
					case "Sideboards":
					case "Singleton":
					case "X Card Draft":
					case "X Pod Draft":
					case "YxZ (i.e. 4x400)":
						// Do Nothing
						break;
					case "Ban List":
						const banListFigures = tag.data.split(";");
						for (var figureName of tag.data.split(";")) {
							figureName = figureName.trim();
							if (figureName.toLowerCase() == unit.name.toLowerCase()) {
								ineligibleUnit = true;
								break;
							}
						}
						/*if (tag.data.split(";").includes(unit.name)) {
							ineligibleUnit = true;
						}*/
						break;
					case "Commons Only":
						if (unit.uniqueness.toLowerCase() != "common") {
							ineligibleUnit = true;
						}
						break;
					case "Heroes Only":
						if (unit.squad) {
							ineligibleUnit = true;
						}
						break;
					case "Restricted List":
						// TODO
						break;
					case "Squads Only":
						if ( ! unit.squad) {
							ineligibleUnit = true;
						}
						break;
					case "Uniques Only":
						if (unit.uniqueness.toLowerCase() == "common") {
							ineligibleUnit = true;
						}
						break;
					case "X(+/-) & Under":
						var powerRank = vcInclusive()
							? unit.powerRankings.VC
							: unit.powerRankings.Classic;
						if (powerRank !== undefined) {
							powerRank = powerRank.replace("+", "a");
							powerRank = powerRank.replace("-", "c");
							if (powerRank.length == 1) {
								powerRank = powerRank + "b";
							}
							var comparison = tag.data;
							comparison = comparison.replace("+", "a");
							comparison = comparison.replace("-", "c");
							if (comparison.length == 1) {
								comparison = comparison + "b";
							}
							if (powerRank < comparison) {
								ineligibleUnit = true;
							}
						}
						break;
				}
			}
			if (ineligibleUnit) {
				continue;
			}
		}
		
		var ineligibleUnit = false;
		for (let j = 0; j < filters.length; j++) {
			const filter = filters[j];
			switch (filter) {
				case "filter_common":
					if (unit.uniqueness != 'Common') {
						ineligibleUnit = true;
					}
					break;
				case "filter_unique":
					if (unit.uniqueness == 'Common') {
						ineligibleUnit = true;
					}
					break;
				case "filter_squad":
					if (unit.squad == false) {
						ineligibleUnit = true;
					}
					break;
				case "filter_hero":
					if (unit.squad == true) {
						ineligibleUnit = true;
					}
					break;
			}
		}
		if (filtersSpecies.length > 0) {
			var match = false;
			for (let j = 0; j < filtersSpecies.length; j++) {
				if (unit.species == filtersSpecies[j]) {
					match = true;
					break;
				}
			}
			if ( ! match) {
				ineligibleUnit = true;
			}
		}
		if (filtersClass.length > 0) {
			var match = false;
			for (let j = 0; j < filtersClass.length; j++) {
				if (unit.class == filtersClass[j]) {
					match = true;
					break;
				}
			}
			if ( ! match) {
				ineligibleUnit = true;
			}
		}
		if (filtersPersonality.length > 0) {
			var match = false;
			for (let j = 0; j < filtersPersonality.length; j++) {
				if (unit.personality == filtersPersonality[j]) {
					match = true;
					break;
				}
			}
			if ( ! match) {
				ineligibleUnit = true;
			}
		}
		if (ineligibleUnit) {
			continue;
		}
		
		
		if (searchText != null && searchText.length > 0) {			
			if (unit.name.toLowerCase().includes(searchText.toLowerCase()) && ((document.getElementById("filter_search_name") == null) || document.getElementById("filter_search_name").checked)) {
				// Do Nothing
			} else if ((unit.nickname !== undefined && unit.nickname !== null && unit.nickname.toLowerCase().includes(searchText.toLowerCase())) && ((document.getElementById("filter_search_nickname") == null) || document.getElementById("filter_search_nickname").checked)) { // nickname
				// Do Nothing
			} else if (unit.species.toLowerCase().includes(searchText.toLowerCase()) && ((document.getElementById("filter_search_species") == null) || document.getElementById("filter_search_species").checked)) {
				// Do Nothing
			} else if (unit.class.toLowerCase().includes(searchText.toLowerCase()) && ((document.getElementById("filter_search_class") == null) || document.getElementById("filter_search_class").checked)) {
				// Do Nothing
			} else if (unit.personality.toLowerCase().includes(searchText.toLowerCase()) && ((document.getElementById("filter_search_personality") == null) || document.getElementById("filter_search_personality").checked)) {
				// Do Nothing
			} else {
				var powerContains = false;
				for (let j = 0; j < unit.powers.length; j++) {
					const power = unit.powers[j];
					if (power.name.toLowerCase().includes(searchText.toLowerCase()) && ((document.getElementById("filter_search_powerNames") == null) || document.getElementById("filter_search_powerNames").checked)) {
						powerContains = true;
						break;
					} else if (power.text.toLowerCase().includes(searchText.toLowerCase()) && ((document.getElementById("filter_search_powerText") == null) || document.getElementById("filter_search_powerText").checked)) {
						powerContains = true;
						break;
					}
				}
				if ( ! powerContains) {
					continue;
				}
			}
			
			/*if ( ! unit.name.toLowerCase().includes(searchText.toLowerCase()) && 
					! unit.species.toLowerCase().includes(searchText.toLowerCase()) &&
					! unit.class.toLowerCase().includes(searchText.toLowerCase()) &&
					! unit.personality.toLowerCase().includes(searchText.toLowerCase()) && 
					(unit.nickname === undefined || unit.nickname === null || ! unit.nickname.toLowerCase().includes(searchText.toLowerCase()))) {
				var powerContains = false;
				for (let j = 0; j < unit.powers.length; j++) {
					const power = unit.powers[j];
					if (power.name.toLowerCase().includes(searchText.toLowerCase()) ||
							power.text.toLowerCase().includes(searchText.toLowerCase())) {
						powerContains = true;
						break;
					}
				}
				if ( ! powerContains) {
					continue;
				}
			}*/
		}
		
		var sortHeaderRow = createTr({class: "labelRow"});
		switch (sortOption1) {
			case "general":
				if (unit.general != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.general}));
					previousSortValue = unit.general;
				}
				break;
			case "homeworld":
				if (unit.homeworld != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.homeworld}));
					previousSortValue = unit.homeworld;
				}
				break;
			case "species":
				if (unit.species != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.species}));
					previousSortValue = unit.species;
				}
				break;
			case "personality":
				if (unit.personality != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.personality}));
					previousSortValue = unit.personality;
				}
				break;
			case "class":
				if (unit.class != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.class}));
					previousSortValue = unit.class;
				}
				break;
			case "size":
				const tempSize = unit.size;
				if (tempSize != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: tempSize}));
					previousSortValue = tempSize;
				}
				break;
			case "height":
				const tempHeight = unit.height;
				if (tempHeight != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: tempHeight}));
					previousSortValue = tempHeight;
				}
				break;
			case "size+height":
				const tempSizeHeight = unit.size + " " + unit.height;
				if (tempSizeHeight != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: tempSizeHeight}));
					previousSortValue = tempSizeHeight;
				}
				break;
			case "uniqueness":
				if (unit.uniqueness != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.uniqueness}));
					previousSortValue = unit.uniqueness;
				}
				break;
			case "squadOrHero":
				const tempVal = unit.squad ? "Squad" : "Hero";
				if (tempVal != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: tempVal}));
					previousSortValue = tempVal;
				}
				break;
			/*case "hexes":
				if ((unit.hexes / unit.figures) != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: (unit.hexes / unit.figures)}));
					previousSortValue = (unit.hexes / unit.figures);
				}
				break;*/
			case "hexes":
				if ((unit.hexes) != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: (unit.hexes)}));
					previousSortValue = (unit.hexes);
				}
				break;
			case "figures":
				if (unit.figures != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.figures}));
					previousSortValue = unit.figures;
				}
				break;
			case "move":
				if (unit.move != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.move}));
					previousSortValue = unit.move;
				}
				break;
			case "range":
				if (unit.range != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.range}));
					previousSortValue = unit.range;
				}
				break;
			case "attack":
				if (unit.attack != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.attack}));
					previousSortValue = unit.attack;
				}
				break;
			case "defense":
				if (unit.defense != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.defense}));
					previousSortValue = unit.defense;
				}
				break;
			case "life":
				if (unit.life != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.life}));
					previousSortValue = unit.life;
				}
				break;
			case "releaseSet":
				if (unit.releaseSet != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: unit.releaseSet}));
					previousSortValue = unit.releaseSet;
				}
				break;
			case "powerRanking":
				var powerRankingValue = vcInclusive()
						? unit.powerRankings.VC
						: unit.powerRankings.Classic;
				if (powerRankingValue == undefined) {
					if (unit.marvel) {
						powerRankingValue = "N/A";
					} else {
						powerRankingValue = "TBD";
					}	
				}
				if (powerRankingValue != previousSortValue) {
					tableElem.appendChild(sortHeaderRow);
					sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: powerRankingValue}));
					previousSortValue = powerRankingValue;
				}
				break;
			case "deltaUpdateDate":
				if (vcInclusive()) {
					const newVal = unit.deltaVcChangeDate.length > 0
						? unit.deltaVcChangeDate
						: "[Unknown]";
					if (newVal != previousSortValue) {
						tableElem.appendChild(sortHeaderRow);
						sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: newVal}));
						previousSortValue = newVal;
					}
				} else {
					const newVal = unit.deltaClassicChangeDate.length > 0
						? unit.deltaClassicChangeDate
						: "[Unknown]";
					if (newVal != previousSortValue) {
						tableElem.appendChild(sortHeaderRow);
						sortHeaderRow.appendChild(createTd({class: "labelCell", colspan: 3, innerHTML: newVal}));
						previousSortValue = newVal;
					}
				}
				break;
		}
		
		var rowElem;
		if (builder || tournamentSignup) {
			rowElem = createTr({
				id: "unitRow_"+i,
				class: "unitDiv" + (unit.vc ? " vcUnitDiv" : "")});
			tableElem.appendChild(rowElem);
		}
		
		if (partialScoring) {
			rowElem = createTr({
				id: "unitRowPartial_"+i,
				class: "unitDiv" + (unit.vc ? " vcUnitDiv": "")});
			tableElem.appendChild(rowElem);
		}
					
		if (builder || tournamentSignup) {
			rowElem.appendChild(createTd({class: "unitDivName", innerHTML: unit.name, onclick: "_toggleActiveUnit("+i+")"}));
			rowElem.appendChild(createTd({class: "unitDataCell", innerHTML: unit.getCost()}));
		}
		
		if (partialScoring) {
			rowElem.appendChild(createTd({class: "unitDivName", innerHTML: unit.name}));
			rowElem.appendChild(createTd({class: "unitDataCell", innerHTML: unit.getPartialCost(true)}));
		}
		
		$(rowElem).data("unit", unit);
		
		if (builder || tournamentSignup) {
			var includedCellElem = createTd({class: "centerTd"});
			rowElem.appendChild(includedCellElem);
		
			var numIncluded = army.unitQuantity(unit);
			
			_createLeftArrow(includedCellElem, unit, numIncluded, 1, i);
			includedCellElem.appendChild(createSpan({
				id: "numInArmy_"+i,
				class: "arrowValue",
				innerHTML: numIncluded}));
			_createRightArrow(includedCellElem, unit, numIncluded, 1, i);	
		}		
		
		if (partialScoring) {
			var partialIncludedCellElem1 = createTd({class: "centerTd"});
			rowElem.appendChild(partialIncludedCellElem1);
		
			var numIncludedPartial1 = partialScoringArmy1.unitQuantity(unit);
			_createLeftArrow(partialIncludedCellElem1, unit, numIncludedPartial1, 2, i);
			partialIncludedCellElem1.appendChild(createSpan({
				id: "numInArmyPartial1_"+i,
				class: "arrowValue",
				innerHTML: numIncludedPartial1}));
			_createRightArrow(partialIncludedCellElem1, unit, numIncludedPartial1, 2, i);
			var partialIncludedCellElem2 = createTd({class: "centerTd"});
			rowElem.appendChild(partialIncludedCellElem2);
			
			var numIncludedPartial2 = partialScoringArmy2.unitQuantity(unit);
			_createLeftArrow(partialIncludedCellElem2, unit, numIncludedPartial2, 3, i);
			partialIncludedCellElem2.appendChild(createSpan({
				id: "numInArmyPartial2_"+i,
				class: "arrowValue",
				innerHTML: numIncludedPartial2}));
			_createRightArrow(partialIncludedCellElem2, unit, numIncludedPartial2, 3, i);
		}
	}
}

function _createLeftArrow(parentCellElem, unit, numIncluded, caseNum, rowIdx, idAddition=null) {
	var imgId = caseNum == 1
		? "leftArrow_"
		: caseNum == 2
			? "leftArrowPartial1_"
			: "leftArrowPartial2_";
	if (idAddition != null) {
		imgId += idAddition;
	}
	var onclickFcn = caseNum == 1
		? "updateArmy("+rowIdx+", 'left')"
		: caseNum == 2 
			? "updatePartialArmy("+rowIdx+", 'left', 1)"
			: "updatePartialArmy("+rowIdx+", 'left', 2)";
	const minusSignSrc = _darkMode
		? "/images/minusSign-darkMode.png"
		: "/images/minusSign.png";
	var leftArrowImg = createImg({
		src: minusSignSrc,
		id: imgId+rowIdx,
		class: "arrow leftArrow",
		onclick: onclickFcn});
	parentCellElem.appendChild(leftArrowImg);
	if (idAddition != null && numIncluded < armyMin) {
		leftArrowImg.classList.add("arrowNoClick");
	}
	if (idAddition == null && numIncluded </*=*/ armyMin) {
		leftArrowImg.classList.add("arrowNoClick");
	}
}

function _createRightArrow(parentCellElem, unit, numIncluded, caseNum, rowIdx, idAddition=null) {
	var imgId = caseNum == 1
		? "rightArrow_"
		: caseNum == 2
			? "rightArrowPartial1_"
			: "rightArrowPartial2_";
	if (idAddition != null) {
		imgId += idAddition;
	}
	var onclickFcn = caseNum == 1
		? "updateArmy("+rowIdx+", 'right')"
		: caseNum == 2 
			? "updatePartialArmy("+rowIdx+", 'right', 1)"
			: "updatePartialArmy("+rowIdx+", 'right', 2)";
	var rightArrowImg = createImg({
		src: "/images/plusSign.png",
		id: imgId+rowIdx,
		class: "arrow rightArrow",
		onclick: onclickFcn});
	parentCellElem.appendChild(rightArrowImg);
	if (unit.uniqueness == "Unique") {
		if (caseNum == 1) {
			if (numIncluded == 1) {
				rightArrowImg.classList.add("arrowNoClick");
			}
		} else {
			if ((unit.squad && numIncluded == unit.figures) ||
					! unit.squad && numIncluded == unit.life) {
				rightArrowImg.classList.add("arrowNoClick");
			}				
		}
	}
	if (tournamentSignup && unit.getCost() + army.getPoints() > tournament.pointLimit) {
		rightArrowImg.classList.add("arrowNoClick");
	}
	if (tournamentSignup) {
		var arrowNoClick = false;
		for (let j = 0; j < tournament.tournamentFormatTags.length; j++) {
			const tag = tournament.tournamentFormatTags[j];
			const format = tag.format;
			
			switch (format.name) {
				case "Assasination":
				case "Ban List":
				case "Bring-2":
				case "Chaos of Battle":
				case "Cheese":
				case "Commons Only":
				case "Control Points":
				case "General Wars":
				case "Heat of Battle":
				case "Heroes Only":
				case "Insanity of Battle":
				case "Monster Mash":
				case "Rainbow Wars":
				case "Reverse the Whip":
				case "Sideboards":
				case "Squads Only":
				case "Uniques Only":
				case "X(+/-) & Under":
				case "X Pod Draft":
				case "YxZ (i.e. 4x400)":
					// Do Nothing
					break;
				case "Singleton":
					if (army.containsUnit(unit)) {
						arrowNoClick = true;
					}
					break;
				case "Restricted List":
					// TODO
					break;
				case "Rule of X":
					if (army.containsUnit(unit)) {
						const numInArmy = army.units[unit.name] * unit.figures;
						if (numInArmy >= tag.data) {
							arrowNoClick = true;
						}
					}
					break;
				case "Max X Copies - Squads":
					if (army.containsUnit(unit) && unit.squad) {
						const numInArmy = army.units[unit.name];
						if (numInArmy >= tag.data) {
							arrowNoClick = true;
						}
					}
					break;
				case "Max X Copies - Heroes":
					if (army.containsUnit(unit) && ! unit.squad && (unit.uniqueness.toLowerCase() == "common" || unit.uniqueness.toLowerCase() == "uncommon")) {
						const numInArmy = army.units[unit.name];
						if (numInArmy >= tag.data) {
							arrowNoClick = true;
						}
					}
					break;
				case "X Card Draft":
					if (Object.keys(army.units).length >= tag.data) {
						arrowNoClick = true;
					}
					break;
			}
		}
		if (arrowNoClick) {
			rightArrowImg.classList.add("arrowNoClick");
		}
	}
}

function updateArmy(unitId, leftOrRight) {
	const rowDiv = document.getElementById("unitRow_"+unitId);
	//const unit = $(rowDiv).data("unit");
	const unit = units[unitId];
	
	// leftArrow_top_0
	
	var imgElem = leftOrRight == "left"
		? document.getElementById("leftArrow_"+unitId)
		: document.getElementById("rightArrow_"+unitId);
	if (imgElem != null) {
		if (imgElem.classList.contains("arrowNoClick")) {
			return;
		}
	}
	
	var numInArmyDiv = document.getElementById("numInArmy_"+unitId);
	if (numInArmyDiv !== null) {
		var numInArmy = numInArmyDiv.innerHTML;
		if (leftOrRight == "left") {
			numInArmy--;
		} else {
			numInArmy++;
		}
		if (numInArmy < 0) {
			numInArmyDiv.innerHTML = 0;
		} else {
			numInArmyDiv.innerHTML = numInArmy;
		}
		
		var leftArrowImg = document.getElementById("leftArrow_"+unitId);
		if (numInArmy < armyMin) {
			leftArrowImg.classList.add("arrowNoClick");
		} else {
			leftArrowImg.classList.remove("arrowNoClick");
		}
		
		var rightArrowImg = document.getElementById("rightArrow_"+unitId);
		if (numInArmy == 1 && unit.uniqueness == "Unique") {
			rightArrowImg.classList.add("arrowNoClick");
		} else {
			rightArrowImg.classList.remove("arrowNoClick");
		}
	
	}
	
	if (leftOrRight == "left") {
		army.removeUnit(unit);
	} else { // leftOrRight == "right"
		army.addUnit(unit);
	}
	
	if (typeof currentTournament !== 'undefined' && currentTournament != null) {
		var currentArmyPoints = army.getPoints();
		var parentTable = document.getElementById("unitTable");
		for (let i = 1; i < parentTable.children.length; i++) {
			var rowElem = parentTable.children[i];
			const currUnit = $(rowElem).data("unit");
			const currUnitId = rowElem.id.split("_")[1];
			if (currUnit.getCost() + currentArmyPoints > currentTournament.points) {
				var currRightArrowImg = document.getElementById("rightArrow_"+currUnitId);
				if ( ! currRightArrowImg.classList.contains("arrowNoClick")) {
					currRightArrowImg.classList.add("arrowNoClick");
				}
			} else {
				// TODO - might need to make some right arrows visible that were previously hidden...
				// TODO - also need to re-evaluate everything on a 'clear' command 
			}
		}
		
		// TODO - Mark Hexes or Figures in red if you go over the point total...
		
	}
	
	updateArmyDisplay();
	
	if (tournamentSignup) {
		displayUnits();
		writeTournamentInfo(tournament, window.location.href.includes("/events/tournament/signup"), false, army);
	}
}

function updateArmyDisplay(partial=false, partialNum=null) {
	var armyVar = ! partial
		? army
		: partialNum == 1
			? partialScoringArmy1
			: partialScoringArmy2;
	var parentElemIdMiddle = ! partial
		? ""
		: "Partial"+partialNum;
	var parentElem = document.getElementById("army" + parentElemIdMiddle + "List");
	
	parentElem.innerHTML = "";
	const fullArmyStr = armyVar.toString(partial);
	if (fullArmyStr.length == 0) {
		parentElem.innerHTML = 
			"No figures selected. Choose a figure from the box to add it to your army.";
	} else {
		var armyStrs = fullArmyStr.split("<br>");
		const pattern = /.* x[0-9]+/;
		for (let i = 0; i < armyStrs.length; i++) {
			const unitStr = armyStrs[i];
			
			var unitRowDiv = createDiv({});
			parentElem.appendChild(unitRowDiv);
			
			const caseNum = ! partial
				? 1
				: partialNum+1;
			
			var unitName = null;
			var unit = null;
			if (pattern.test(unitStr)) {
				unitName = unitStr.substr(0, unitStr.lastIndexOf(" x"));
				unit = unitsMap[unitName];
			} else {
				unitName = unitStr;
				unit = unitsMap[unitName];
			}
			
			var unitNum = null;			
			for (let k = 0; k < units.length; k++) {
				if (units[k].name == unit.name) {
					unitNum = k;
					break;
				}
			}
			
			var unitDisplayCost = unit.getCost();
			if (partial) {
				unitDisplayCost = unit.getPartialCost();
			}
				
			if (pattern.test(unitStr)) {
				const numIncluded = unitStr.substr(unitStr.lastIndexOf(" x")+2).trim();
				var rowIdx = -1;
				for (let j = 0; j < units.length; j++) {
					if (units[j].name == unitName) {
						rowIdx = j;
						break;
					}
				}
				_createLeftArrow(unitRowDiv, unit, numIncluded, caseNum, rowIdx, "top_", partial, partialNum);
				//unitRowDiv.appendChild(createText(unitStr));
				unitRowDiv.appendChild(createSpan({
					innerHTML: unitStr,
					onclick: "_toggleActiveUnit(" + unitNum + ")"
				}));
				unitRowDiv.appendChild(createSpan({innerHTML: " "+(unitDisplayCost * numIncluded), class: "armyDisplayCost"}));
				_createRightArrow(unitRowDiv, unit, numIncluded, caseNum, rowIdx, "top_");
			} else {
				const numIncluded = 1;
				var rowIdx = -1;
				for (let j = 0; j < units.length; j++) {
					if (units[j].name == unitName) {
						rowIdx = j;
						break;
					}
				}
				_createLeftArrow(unitRowDiv, unit, numIncluded, caseNum, rowIdx, "top_", partial, partialNum);
				//unitRowDiv.appendChild(createText(unitStr));
				unitRowDiv.appendChild(createSpan({
					innerHTML: unitStr,
					onclick: "_toggleActiveUnit(" + unitNum + ")"
				}));
				unitRowDiv.appendChild(createSpan({innerHTML: " "+(unitDisplayCost * numIncluded), class: "armyDisplayCost"}));
			}
		}
	}
	
	/*var armyString = army.toString();
	if (armyString.length == 0) {
		armyString = "No figures selected. Choose a figure from the box to add it to your army.";
	} 
	document.getElementById("armyList").innerHTML = armyString;*/
	
	const prefix = partial 
		? "armyPartial"+partialNum
		: "army";
	
	var armyPoints = armyVar.getPoints(partial);
	if (partial) {
		armyPoints = armyPoints.toFixed(2);
	}
	
	document.getElementById(prefix+"Points").innerHTML = armyPoints;
	document.getElementById(prefix+"Figures").innerHTML = armyVar.getFigures(partial);
	document.getElementById(prefix+"Hexes").innerHTML = armyVar.getHexes(partial);
	
	if (typeof updateURL == 'function') {
		updateURL();
	}
	
	adjustBodyTopMargin();
}

function adjustBodyTopMargin() {
	var bodyElem = document.getElementsByTagName("body")[0];
	if (window.innerWidth <= 800) {
		bodyElem.style["margin-top"] = 
			document.getElementById("ArmyStatsDiv").offsetHeight + 10;
	}
}

function _displayActiveUnit(unitIdx) {
	activeUnitIdx = unitIdx;
	const unit = units[unitIdx]; 
	
	var parentDiv = document.getElementById("UnitStatsDiv");
	parentDiv.style.display = "block";
	parentDiv.style["background-color"] = unit.getBackgroundColor();
	parentDiv.style["color"] = unit.getTextColor();
	
	var unitRow = document.getElementById("unitRow_"+unitIdx);
	if (unitRow != null) {
		unitRow.classList.add("activeUnit");
	}
	
	var unitNameDiv = document.getElementById("UnitName");
	unitNameDiv.innerHTML = "";
	unitNameDiv.appendChild(createA({
		innerHTML: unit.name,
		href: unit.bookUrl,
		target: "_blank"}));
	
	document.getElementById("UnitImg").src = unit.image;
	
	document.getElementById("UnitHomeworld").innerHTML = unit.homeworld;
	document.getElementById("UnitSpecies").innerHTML = unit.species;
	document.getElementById("UnitCommonality").innerHTML = unit.uniqueness + " " + (unit.squad ? "Squad" : "Hero");
	document.getElementById("UnitClass").innerHTML = unit.class;
	document.getElementById("UnitPersonality").innerHTML = unit.personality;
	document.getElementById("UnitSize").innerHTML = unit.size + " " + unit.height;
	
	document.getElementById("UnitGeneral").innerHTML = unit.general;
	document.getElementById("UnitFigures").innerHTML = unit.figures;
	document.getElementById("UnitHexes").innerHTML = unit.hexes;
	
	document.getElementById("UnitLife").innerHTML = unit.life;
	document.getElementById("UnitMove").innerHTML = unit.move;
	document.getElementById("UnitRange").innerHTML = unit.range;
	document.getElementById("UnitAttack").innerHTML = unit.attack;
	document.getElementById("UnitDefense").innerHTML = unit.defense;
	document.getElementById("UnitPoints").innerHTML = unit.getCost();
	
	if (getSubdomain().length == 0) {
		document.getElementById("UnitReleaseSet").innerHTML = unit.releaseSet + " (" + unit.releaseDate +  ")";
	}
	document.getElementById("DeltaUpdate").innerHTML = "";
	if (deltaPoints) {
		if (vcInclusive()) {
			if (unit.deltaVcChangeDate.length > 0) {
				document.getElementById("DeltaUpdate").innerHTML = 
					"Delta Points Last Updated: " + unit.deltaVcChangeDate;
			}
		} else {
			if (unit.deltaClassicChangeDate.length > 0) {
				document.getElementById("DeltaUpdate").innerHTML = 
					"Delta Points Last Updated: " + unit.deltaClassicChangeDate;
			}
		}
	}
	
	var powersDiv = document.getElementById("UnitPowers");
	powersDiv.innerHTML = "";
	for (let i = 0; i < unit.powers.length; i++) {
		const power = unit.powers[i];
		powersDiv.appendChild(createDiv({
			class: "unitPowerName",
			innerHTML: power.name}));
		powersDiv.appendChild(createDiv({
			class: "unitPowerText",
			innerHTML: power.text}));
	}

	//if ( ! c3g /*&& ! aoa*/) {
		var powerRankingsDiv = document.getElementById("UnitPowerRankings");
		powerRankingsDiv.innerHTML = "";
		if ( ! deltaPoints) {
			var includePowerRankings = false;
			for (let key in unit.powerRankings) {
				if (unit.powerRankings[key] !== undefined && unit.powerRankings[key].length > 0) {
					includePowerRankings = true;
					break;
				}
			}
			if (includePowerRankings) {
				powerRankingsDiv.appendChild(createH3({innerHTML: "Power Rankings"}));
				for (let key in unit.powerRankings) {
					if (unit.powerRankings[key] !== undefined && unit.powerRankings[key].length > 0) {
						powerRankingsDiv.appendChild(createDiv({innerHTML: key + " : " + unit.powerRankings[key]}));
					}
				}
			}
		}
	//}
}

function _displayUnit(unit, unitDiv) {
	
	unitDiv.style["background-color"] = unit.getBackgroundColor();
	unitDiv.style["color"] = unit.getTextColor();
	
	unitDiv.appendChild(createButton({
		class: "unitStatsDivX",
		onclick: "_closeUnit",
		innerHTML: "X"
	}));
	
	var h2 = createH2({class: "unitName"});
	h2.appendChild(createA({
		innerHTML: unit.name,
		href: unit.bookUrl,
		target: "_blank"}));
	unitDiv.appendChild(h2);
	
	var statsColumn = createDiv({
		class: "UnitStatsColumn"
	});
	unitDiv.appendChild(statsColumn);
	statsColumn.appendChild(createDiv({
		class: "UnitStat",
		style: 'color: white; background-color: red',
		innerHTML: unit.life + " Life"
	}));
	statsColumn.appendChild(createDiv({
		class: "UnitStat",
		style: 'color: white; background-color: green',
		innerHTML: unit.move + " Move"
	}));
	statsColumn.appendChild(createDiv({
		class: "UnitStat",
		style: 'color: white; background-color: grey',
		innerHTML: unit.range + " Range"
	}));
	statsColumn.appendChild(createDiv({
		class: "UnitStat",
		style: 'color: white; background-color: red',
		innerHTML: unit.attack + " Attack"
	}));
	statsColumn.appendChild(createDiv({
		class: "UnitStat",
		style: 'color: white; background-color: blue',
		innerHTML: unit.defense + " Defense"
	}));
	
	unitDiv.appendChild(createImg({
		class: 'unitImg',
		src: unit.image
	}));
	
	/*unitDiv.appendChild(createDiv({
		class: 'deltaUpdate',
		innerHTML: ''
	}));*/
	
	var statsCol1 = createDiv({
		class: 'UnitStatsColumn'
	});
	unitDiv.appendChild(statsCol1);
	statsCol1.appendChild(createDiv({
		class: "UnitStat",
		innerHTML: unit.species
	}));
	statsCol1.appendChild(createDiv({
		class: "UnitStat",
		innerHTML: unit.uniqueness + " " + (unit.squad ? "Squad" : "Hero")
	}));
	statsCol1.appendChild(createDiv({
		class: "UnitStat",
		innerHTML: unit.class
	}));
	statsCol1.appendChild(createDiv({
		class: "UnitStat",
		innerHTML: unit.personality
	}));
	statsCol1.appendChild(createDiv({
		class: "UnitStat",
		innerHTML: unit.size + " " + unit.height
	}));
	
	var statsCol2 = createDiv({
		class: 'UnitStatsColumn'
	});
	unitDiv.appendChild(statsCol2);
	statsCol2.appendChild(createDiv({
		class: "UnitStat",
		innerHTML: unit.general
	}));
	statsCol2.appendChild(createDiv({
		class: "UnitStat",
		innerHTML: unit.homeworld
	}));
	statsCol2.appendChild(createDiv({
		class: "UnitStat",
		innerHTML: unit.figures + " Figures"
	}));
	statsCol2.appendChild(createDiv({
		class: "UnitStat",
		innerHTML: unit.hexes + " Hexes"
	}));
	statsCol2.appendChild(createDiv({
		class: "UnitStat",
		innerHTML: unit.getCost() + " Points"
	}));
	
	var powersDiv = createDiv({
		class: "unitPowers"
	});
	unitDiv.appendChild(powersDiv);
	for (let i = 0; i < unit.powers.length; i++) {
		const power = unit.powers[i];
		powersDiv.appendChild(createDiv({
			class: "unitPowerName",
			innerHTML: power.name}));
		powersDiv.appendChild(createDiv({
			class: "unitPowerText",
			innerHTML: power.text}));
	}
	
}

var activeUnitIdx = null;
function _toggleActiveUnit(unitIdx = activeUnitIdx) {
	var parentDiv = document.getElementById("UnitStatsDiv");
	
	if (activeUnitIdx != null) {
		var rowElem = document.getElementById("unitRow_"+activeUnitIdx);
		if (rowElem != null) {
			rowElem.classList.remove("activeUnit");
		}
		parentDiv.style.display = "none";
		
		if (activeUnitIdx != unitIdx) {
			_displayActiveUnit(unitIdx);
		} else {
			activeUnitIdx = null;
		}
	} else { // Write Box from Scratch
		_displayActiveUnit(unitIdx);
	}
}

function _clearArmy(armyNum) {
	if (armyNum === undefined || armyNum == null) {
		army.clear();
		updateArmyDisplay();
	} else if (armyNum == 1) {
		partialScoringArmy1.clear();
		updateArmyDisplayPartialScoring()
	} else if (armyNum == 2) {
		partialScoringArmy2.clear();
		updateArmyDisplayPartialScoring()
	}
	redrawPage();
}

function createFigureSetCheckboxes(figureSetSubGroups, checkDefaults=true) {
	var tier1Group = document.getElementById('Tier1SubGroups');
	var tier2Group = document.getElementById('Tier2SubGroups');
	for (let i = 0; i < figureSetSubGroups.length; i++) {
		const subGroup = figureSetSubGroups[i];
		var subGroupDiv = createDiv({
			class: "figureSetSubGroup"
		});
		if (subGroup.tier == 1) {
			tier1Group.appendChild(subGroupDiv);
		} else {
			tier2Group.appendChild(subGroupDiv);
		}
		var labelElem = createLabel({});
		subGroupDiv.appendChild(labelElem);
		var inputElem = createInput({
			type: "checkbox",
			id: subGroup.name + "_checkbox",
			class: "figureSetSubGroupCheckbox",
			onchange: "_toggleFigureSetCheckbox()"
		});
		if (checkDefaults) {
			const cookieValue = 
				getCookieValue("hs_setting_Default_Builder_Display_-_"+subGroup.name.replaceAll(" ", "_"));
			if (cookieValue != null) {
				if (cookieValue == "1") {
					inputElem.checked = true;
				}
			} else if (subGroup.selectedByDefault) {
				inputElem.checked = true;
			}
		}
		labelElem.appendChild(inputElem);
		labelElem.appendChild(createText(subGroup.name));
	}
	/*updateURL();
	if (typeof redrawPage == 'function') {
		redrawPage();
	}*/
}

function _toggleFigureSetCheckbox() {
	updateURL();
	if (typeof redrawPage == 'function') {
		redrawPage();
	}
}

function updateURL() {
	if (window.location.origin.includes("c3g")) {
		return;
	}
	
	const deltaStr = deltaPoints ? "true" : "false";
	
	var figureSetStr = "";
	figureSetCheckboxes = document.getElementsByClassName('figureSetSubGroupCheckbox');
	for (let i = 0; i < figureSetCheckboxes.length; i++) {
		const checkbox = figureSetCheckboxes[i];
		if (figureSetStr.length > 0) {
			figureSetStr += ",";
		}
		figureSetStr += checkbox.id.split("_")[0] + "_" + checkbox.checked; 
	}
	
	var newurl = window.location.origin + 
		window.location.pathname + 
		"?" + 
			'delta='+deltaStr+
			'&figureSet='+figureSetStr+
			'&search='+searchText+
			'&sort1='+sortOption1+
			'&sort2='+sortOption2;
			
	if (typeof updateUrlPageSpecific == 'function') {
		newurl += updateUrlPageSpecific();
	}
	
	window.history.pushState({path:newurl},'',newurl);
}

function switchClassicDelta(refThis) {
	deltaPoints = refThis.checked;
	if (deltaPoints) {
		document.getElementById("standardToggle").classList.remove("toggleSwitchSelected");
		document.getElementById("deltaToggle").classList.add("toggleSwitchSelected");
	} else {
		document.getElementById("standardToggle").classList.add("toggleSwitchSelected");
		document.getElementById("deltaToggle").classList.remove("toggleSwitchSelected");
	}
	redrawPage();
	updateURL();
}

function checkUrlParameters() {
	if (window.location.origin.includes("c3g")) {
		return;
	}
	var url = new URL(window.location.href);
	
	var figureSetCheckboxes = document.getElementsByClassName('figureSetSubGroupCheckbox');
	for (let i = 0; i < figureSetCheckboxes.length; i++) {
		const checkbox = figureSetCheckboxes[i];
		if (findGetParameter('figureSet') != null) {
			var figureSetUrlParams = findGetParameter('figureSet').split(",");
			for (let j = 0; j < figureSetUrlParams.length; j++) {
				const param = figureSetUrlParams[j].split("_");
				if (param[0] == checkbox.id.split("_")[0]) {
					if (param[1] == 'false') {
						checkbox.checked = false;
					} else if (param[1] == 'true') {
						checkbox.checked = true;
					}
					break;
				}
			}
		}
	}
	
	var searchParam = url.searchParams.get("search");
	if (searchParam !== undefined && searchParam !== null && searchParam != "null"){
		document.getElementById("searchInput").value = searchParam;
		searchText = searchParam;
	}
	
	var sort1Param = url.searchParams.get("sort1");
	if (sort1Param !== undefined && sort1Param !== null && sort1Param != "null"){
		document.getElementById("sort1").value = sort1Param;
		sortOption1 = sort1Param;
	}
	
	var sort2Param = url.searchParams.get("sort2");
	if (sort2Param !== undefined && sort2Param !== null && sort2Param != "null"){
		document.getElementById("sort2").value = sort2Param;
		sortOption2 = sort2Param;
	}
	
	if (typeof checkUrlParametersPageSpecific == 'function') {
		checkUrlParametersPageSpecific();
	}
	
	redrawPage();
}


/** Search **/

var searchText = null;
function _search(refThis) {
	if (refThis !== undefined && refThis !== null) {
		searchText = refThis.value;
	}
	redrawPage();
	if (typeof updateURL !== 'undefined') {
		updateURL();
	}
}

function displayFilters() {
	var selectElem = document.getElementById("SpeciesFiltersSelect");
	for (let i = 0; i < unitsSpecies.length; i++) {
		const species = unitsSpecies[i];
		selectElem.appendChild(createOption({
			value: species,
			class: "filterSpecies",
			innerHTML: species
		}));
	}
	
	selectElem = document.getElementById("ClassFiltersSelect");
	for (let i = 0; i < unitsClasses.length; i++) {
		const clas = unitsClasses[i];
		selectElem.appendChild(createOption({
			value: clas,
			class: "filterClass",
			innerHTML: clas
		}));
	}
	
	selectElem = document.getElementById("PersonalityFiltersSelect");
	for (let i = 0; i < unitsPersonalities.length; i++) {
		const personality = unitsPersonalities[i];
		selectElem.appendChild(createOption({
			value: personality,
			class: "filterPersonality",
			innerHTML: personality
		}));
	}	
}

function _toggleFilters() {
	var elem = document.getElementById("FiltersDiv");
	if (elem.style.display == "block") {
		elem.style.display = "none";
	} else {
		elem.style.display = "block";
	}
}

function _toggleFiltersSpecies() {
	var elem = document.getElementById("SpeciesFiltersDiv");
	if (elem.style.display == "none") {
		elem.style.display = "block";
	} else {
		elem.style.display = "none";
	}
}

function _toggleFiltersClass() {
	var elem = document.getElementById("ClassFiltersDiv");
	if (elem.style.display == "none") {
		elem.style.display = "block";
	} else {
		elem.style.display = "none";
	}
}

function _toggleFiltersPersonality() {
	var elem = document.getElementById("PersonalityFiltersDiv");
	if (elem.style.display == "none") {
		elem.style.display = "block";
	} else {
		elem.style.display = "none";
	}
}

var filters = [];
var filtersSpecies = [];
var filtersClass = [];
var filtersPersonality = [];
function _updateFilters(refThis) { // refThis = checkbox
	filters = [];
	var filterElems = document.getElementsByClassName("filterCheckbox");
	for (let i = 0; i < filterElems.length; i++) {
		const filterElem = filterElems[i];
		if (filterElem.checked) {
			filters.push(filterElem.id);
		}
	}
	filtersSpecies = [];
	var speciesElems = document.getElementsByClassName("filterSpecies");
	for (let i = 0; i < speciesElems.length; i++) {
		const optionElem = speciesElems[i];
		if (optionElem.selected) {
			filtersSpecies.push(optionElem.value);
		}
	}
	filtersClass = [];
	var classElem = document.getElementsByClassName("filterClass");
	for (let i = 0; i < classElem.length; i++) {
		const optionElem = classElem[i];
		if (optionElem.selected) {
			filtersClass.push(optionElem.value);
		}
	}
	filtersPersonality = [];
	var personalityElems = document.getElementsByClassName("filterPersonality");
	for (let i = 0; i < personalityElems.length; i++) {
		const optionElem = personalityElems[i];
		if (optionElem.selected) {
			filtersPersonality.push(optionElem.value);
		}
	}
	redrawPage();
}

/** Sort **/

var sortOption1 = "alphabetical";
var sortOption2 = null;
function _sort1(refThis) {
	var selectedOption = refThis.options[refThis.selectedIndex];
	sortOption1 = selectedOption.value;
	redrawPage();
	if (updateURL !== undefined) {
		updateURL();
	}
}
function _sort2(refThis) {
	var selectedOption = refThis.options[refThis.selectedIndex];
	sortOption2 = selectedOption.value;
	redrawPage();
	if (updateURL !== undefined) {
		updateURL();
	}
}

function _compareUnits(a, b) {
	var result = _compareUnitsOnce(a, b, sortOption1);
	if (result != 0) {
		const invertSort1Checkbox = document.getElementById('sort1Invert');
		if (invertSort1Checkbox !== null && invertSort1Checkbox.checked) {
			result *= -1;
		}
		//return result;
	} else {
		result = _compareUnitsOnce(a, b, sortOption2);
		const invertSort2Checkbox = document.getElementById('sort2Invert');
		if (invertSort2Checkbox !== null && invertSort2Checkbox.checked) {
			result *= -1;
		}
	}
	return result;
}

function _compareUnitsOnce(a, b, sortOption) {
	switch (sortOption) {
		case "alphabetical":
		case "none":
			if (a.name < b.name){
				return -1;
			}
			if (a.name > b.name){
				return 1;
			}
			break;
		case "pointsHighToLow":
			if (a.getCost() > b.getCost()){
				return -1;
			}
			if (a.getCost() < b.getCost()){
				return 1;
			}
			break;
		case "pointsLowToHigh":
			if (a.getCost() < b.getCost()){
				return -1;
			}
			if (a.getCost() > b.getCost()){
				return 1;
			}
			break;
		case "general":
			if (a.getGeneral() < b.getGeneral()){
				return -1;
			}
			if (a.getGeneral() > b.getGeneral()){
				return 1;
			}
			break;
		case "homeworld":
			if (a.getHomeworld() < b.getHomeworld()){
				return -1;
			}
			if (a.getHomeworld() > b.getHomeworld()){
				return 1;
			}
			break;
		case "species":
			if (a.getSpecies() < b.getSpecies()){
				return -1;
			}
			if (a.getSpecies() > b.getSpecies()){
				return 1;
			}
			break;
		case "personality":
			if (a.getPersonality() < b.getPersonality()){
				return -1;
			}
			if (a.getPersonality() > b.getPersonality()){
				return 1;
			}
			break;
		case "class":
			if (a.getClass() < b.getClass()){
				return -1;
			}
			if (a.getClass() > b.getClass()){
				return 1;
			}
			break;
		case "size":
			// Huge, Large, Medium, Small
			// Cheating by noticing H->L->M->S is alphabetical order
			if (a.size < b.size){
				return -1;
			}
			if (a.size > b.size){
				return 1;
			}
			break;
		case "height":
			if (a.height > b.height) {
				return -1;
			}
			if (a.height < b.height) {
				return 1;
			}
			break;
		case "size+height":
			// Huge, Large, Medium, Small
			// Cheating by noticing H->L->M->S is alphabetical order
			if (a.size < b.size){
				return -1;
			}
			if (a.size > b.size){
				return 1;
			}
			if (a.height > b.height) {
				return -1;
			}
			if (a.height < b.height) {
				return 1;
			}
			break;
		case "uniqueness":
			// Unique, Uncommon, Common
			// Cheating by noticing Uni <- Unc <- C
			if (a.uniqueness > b.uniqueness){
				return -1;
			}
			if (a.uniqueness < b.uniqueness){
				return 1;
			}
			break;
		case "squadOrHero":
			if (a.squad && ! b.squad) {
				return 1;
			} 
			if ( ! a.squad && b.squad) {
				return -1;
			}
			break;
		/*case "hexes":
			if ((a.hexes / a.figures) < (b.hexes / b.figures)) {
				return 1;
			}
			if ((a.hexes / a.figures) > (b.hexes / b.figures)) {
				return -1;
			}
			break;*/
		case "hexes":
			if ((a.hexes) < (b.hexes)) {
				return 1;
			}
			if ((a.hexes) > (b.hexes)) {
				return -1;
			}
			break;
		case "figures":
			if ((a.figures) < (b.figures)) {
				return 1;
			}
			if ((a.figures) > (b.figures)) {
				return -1;
			}
			break;
		case "move":
			if (a.move > b.move){
				return -1;
			}
			if (a.move < b.move){
				return 1;
			}
			break;
		case "range":
			if (a.range > b.range){
				return -1;
			}
			if (a.range < b.range){
				return 1;
			}
			break;
		case "attack":
			if (a.attack > b.attack){
				return -1;
			}
			if (a.attack < b.attack){
				return 1;
			}
			break;
		case "defense":
			if (a.defense > b.defense){
				return -1;
			}
			if (a.defense < b.defense){
				return 1;
			}
			break;
		case "life":
			if (a.life > b.life){
				return -1;
			}
			if (a.life < b.life){
				return 1;
			}
			break;
		case "releaseSet":
			if (a.releaseDate > b.releaseDate) {
				return 1;
			} 
			if (a.releaseDate < b.releaseDate) {
				return -1;
			}
			if (a.releaseSet > b.releaseSet) {
				return 1;
			}
			if (a.releaseSet < b.releaseSet) {
				return -1;
			}
			break;
		case "powerRanking":
			var aVal = vcInclusive()
				? a.powerRankings.VC
				: a.powerRankings.Classic;
			var bVal = vcInclusive()
				? b.powerRankings.VC
				: b.powerRankings.Classic;
			if (aVal == undefined) {
				aVal = "Z";
			}
			if (aVal.length == 1) {
				aVal += "b";
			} else {
				aVal = aVal.replace("+", "a");
				aVal = aVal.replace("-", "c");
			}
			if (bVal == undefined) {
				bVal = "Z";
			}
			if (bVal.length == 1) {
				bVal += "b";
			} else {
				bVal = bVal.replace("+", "a");
				bVal = bVal.replace("-", "c");
			}
			if (aVal < bVal) {
				return -1;
			} else if (aVal > bVal) {
				return 1;
			} else {
				return 0;
			}
			break;
		case "deltaUpdateDate":
			if (vcInclusive()) {
				if (a.deltaVcChangeDate == b.deltaVcChangeDate) {
					return 0;
				}
				if (a.deltaVcChangeDate.length > 0) {
					if (a.deltaVcChangeDate > b.deltaVcChangeDate) {
						return -1;
					} else {
						return 1;
					}
				} else { // b.deltaVcChangeDate.length > 0
					return 1; 
				}
			} else {
				if (a.deltaClassicChangeDate == b.deltaClassicChangeDate) {
					return 0;
				}
				if (a.deltaClassicChangeDate.length > 0) {
					if (a.deltaClassicChangeDate > b.deltaClassicChangeDate) {
						return -1;
					} else {
						return 1;
					}
				} else { // b.deltaClassicChangeDate.length > 0
					return 1; 
				}
			}
			break;
	}
	return 0;
}

function _copyArmy(lineDelimeter="\n", figuresOnly=false) {
	var armyText = "";
	
	if (typeof tournament == "object" && ! figuresOnly) {
		armyText += tournament.fullDisplayName() + lineDelimeter;
	}
	
	armyText += army.toString(false, false, true).replaceAll("<br>", lineDelimeter);
	
	if ( ! figuresOnly) {
		
		armyText += lineDelimeter + army.getPoints() + " Points, " + 
			army.getFigures() + " Figures";
		
		if (typeof tournament == "object" && tournament.figureLimit != null && army.getFigures() > tournament.figureLimit) {
			armyText += " (Drop " + (army.getFigures() - tournament.figureLimit) + ")";
		}
		
		armyText += ", " + army.getHexes() + " Hexes";
		
		if (typeof tournament == "object" && tournament.hexLimit != null && army.getHexes() > tournament.hexLimit) {
			armyText += " (Drop " + (army.getHexes() - tournament.hexLimit) + ")";
		}
			
		var standardPointsStr = "Standard Points";
		switch (subdomainFigureSet.name) {
			case "Renegade Points":
				standardPointsStr = "Renegade Points";
				break;
		}
			
		armyText += lineDelimeter+"Settings: " + 
			(vcInclusive() ? "VC" : "Classic") + ", " + 
			(deltaPoints ? "Delta Points " : standardPointsStr);
		
		switch (subdomainFigureSet.name) {
			case "Renegade Contemporary":
				armyText += ", " + "Renegade Contemporary";
				break;
		}
	}
	
	copyTextToClipboard(armyText);
}

function _copyUrl() {
	var urlText = window.location.href;
	copyTextToClipboard(urlText);
}

function copyTextToClipboard(text) {
	var dummy = document.createElement("textarea");
	document.body.appendChild(dummy);
	dummy.value = text;
	dummy.select();
	document.execCommand("copy");
	document.body.removeChild(dummy);
}

function _viewArmy() {
	window.open("/builder/view?army="+encodeURI(JSON.stringify(army)), '_blank').focus();
}
