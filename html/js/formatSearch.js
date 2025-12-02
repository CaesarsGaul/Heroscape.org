function createTags() {
	var parentElem = document.getElementById('Formats');
	for (let i = 0; i < TournamentFormat.list.length; i++) {
		const format = TournamentFormat.list[i];
		var formatDiv = createDiv({
			class: 'formatTagDiv'
		});
		parentElem.appendChild(formatDiv);
		
		var formatLabel = createLabel({});
		formatDiv.appendChild(formatLabel);
		formatLabel.appendChild(createInput({
			class: 'formatTagInput',
			type: 'checkbox',
			value: format.id,
			onchange: 'formatSearch()'
		}));
		formatLabel.appendChild(createText(format.name));
	}			
}

function _toggleFigureSetCheckbox() {
	formatSearch();
}

var matchingFormats = [];

function filterFormats() {
	matchingFormats = [];
	
	for (let i = 0; i < Tournament.list.length; i++) {
		const tournament = Tournament.list[i];
		var matchesSearch = true;
		
		// Check FigureSetSubGroups
		var figureSubGroupInputs = document.getElementsByClassName('figureSetSubGroupCheckbox');
		var selectedFigureSubGroups = [];
		for (let i = 0; i < figureSubGroupInputs.length; i++) {
			if (figureSubGroupInputs[i].checked) {
				selectedFigureSubGroups.push(figureSubGroupInputs[i].id.split("_")[0]);
			}
		}
		if (selectedFigureSubGroups.length > 0) {
			for (let i = 0; i < selectedFigureSubGroups.length; i++) {
				const figureSubGroupName = selectedFigureSubGroups[i];
				var formatMatch = false;
				for (let j = 0; j < tournament.tournamentIncludesFigureSetSubGroups.length; j++) {
					const figureSubGroup = tournament.tournamentIncludesFigureSetSubGroups[j].figureSetSubGroup;
					if (figureSubGroup.name == figureSubGroupName) {
						formatMatch = true;
						break;
					}
				}
				if ( ! formatMatch) {
					matchesSearch = false;
				}
			}
		}
		
		// Date Range 
		const startDate = document.getElementById('StartDate').value; 
		if (startDate.length > 0) {
			if (tournament.startTime < startDate) {
				matchesSearch = false;
			}
		}
		const endDate = document.getElementById('EndDate').value
		if (endDate.length > 0) {
			if (tournament.startTime > endDate) {
				matchesSearch = false;
			}
		}				
		
		// Check Point Systems
		if ((tournament.useDeltaPricing && ! document.getElementById('DeltaPricing').checked) || 
				( ! tournament.useDeltaPricing && ! document.getElementById('StandardPricing').checked)) {
			matchesSearch = false;
		}
		
		// Check Min/Maxes
		const pointMinValue = document.getElementById('PointMin').value;
		const pointMaxValue = document.getElementById('PointMax').value;
		const figureMinValue = document.getElementById('FigureMin').value;
		const figureMaxValue = document.getElementById('FigureMax').value;
		const hexMinValue = document.getElementById('HexMin').value;
		const hexMaxValue = document.getElementById('HexMax').value;
		if (pointMinValue.length > 0 && tournament.pointLimit < pointMinValue) {
			matchesSearch = false;
		}
		if (pointMaxValue.length > 0 && tournament.pointLimit > pointMaxValue) {
			matchesSearch = false;
		}
		if (figureMinValue.length > 0 && (tournament.figureLimit == null || tournament.figureLimit < figureMinValue)) {
			matchesSearch = false;
		}
		if (figureMaxValue.length > 0 && (tournament.figureLimit == null || tournament.figureLimit > figureMaxValue)) {
			matchesSearch = false;
		}
		if (hexMinValue.length > 0 && (tournament.hexLimit == null || tournament.hexLimit < hexMinValue)) {
			matchesSearch = false;
		}
		if (hexMaxValue.length > 0 && (tournament.hexLimit == null || tournament.hexLimit > hexMaxValue)) {
			matchesSearch = false;
		}
		
		// Live v. Online 
		var liveInput = document.getElementById('Live');
		var onlineInput = document.getElementById('Online');
		if (( ! liveInput.checked && ! tournament.online) || ( ! onlineInput.checked && tournament.online)) {
			matchesSearch = false;
		}
						
		// Check # Players
		if ((tournament.maxNumPlayersPerGame == 2 && ! document.getElementById("2Player").checked) || 
				(tournament.maxNumPlayersPerGame > 2 && ! document.getElementById("MultiPlayer").checked)) {
			matchesSearch = false;
		}
		
		// Check # Armies 
		const numArmiesInput = document.getElementById("NumArmies");
		if (numArmiesInput.value.length > 0 && tournament.numArmies != numArmiesInput.value) {
			matchesSearch = false;
		}
		
		// Check FormatTags 
		var formatInputs = document.getElementsByClassName('formatTagInput');
		var selectedFormats = [];
		for (let i = 0; i < formatInputs.length; i++) {
			if (formatInputs[i].checked) {
				selectedFormats.push(formatInputs[i].value);
			}
		}
		if (selectedFormats.length > 0) {
			for (let i = 0; i < selectedFormats.length; i++) {
				const formatId = selectedFormats[i];
				var formatMatch = false;
				for (let j = 0; j < tournament.tournamentFormatTags.length; j++) {
					const tag = tournament.tournamentFormatTags[j];
					if (tag.format.id == formatId) {
						formatMatch = true;
						break;
					}
				}
				if ( ! formatMatch) {
					matchesSearch = false;
				}
			}
		}
		
		if (matchesSearch) {
			matchingFormats.push(tournament);
		}
	}
}

function formatSearch() {
	var parentElem = document.getElementById("ResultsDivInner");
	parentElem.innerHTML = "";
	
	filterFormats();
	
	for (let i = 0; i < matchingFormats.length; i++) {
		const tournament = matchingFormats[i];
		var tournamentDiv = createDiv({
			class: 'tournamentDiv'
		});
		parentElem.appendChild(tournamentDiv);
		tournamentDiv.appendChild(createA({
			href: "/events/tournament/?Tournament="+tournament.id,
			innerHTML: tournament.fullDisplayName(),
			target: "_blank"
		}));
	}
}

