function drawDeltaPriceGraph(_options={}, cards=null) {
	var parentElement = document.getElementById("DeltaPriceGraph");
	parentElement.innerHTML = "";
	
	if (google === undefined || 
			google.visualization === undefined || 
			google.visualization.DataTable === undefined || 
			google.visualization.LineChart === undefined) {
		setTimeout(
			function() {
				drawDeltaPriceGraph(cards);
			}, 
			100); // 1/10 of a second
		return;
	}
	
	var data = new google.visualization.DataTable();
	
	if (cards == null) {
		cards = _findSelectedCards();
	}
	
	data.addColumn('string', 'X');
	for (let i = 0; i < cards.length; i++) {
		const card = cards[i];
	//for (let i = 0; i < selectedCheckboxes.length; i++) {
		//const card = $(selectedCheckboxes[i]).data("card");
		data.addColumn('number', card.name);
	}
	if (cards.length == 0) {
	//if (selectedCheckboxes.length == 0) {
		data.addColumn('number', 'Placeholder');
	}
	
	// Add Printed Cost to Graph ? 
	
	var dataRows = [];
	
	if (cards.length > 0) {
	//if (selectedCheckboxes.length > 0) {
		var firstRow = ["Printed"];
		for (let i = 0; i < cards.length; i++) {
		//for (let i = 0; i < selectedCheckboxes.length; i++) {
			const card = cards[i];
			//const card = $(selectedCheckboxes[i]).data("card");
			firstRow.push(card.points);
		}
		dataRows.push(firstRow);
	}
	
	
	
	DeltaUpdate.list.sort(function(a,b) {
		if (a.date < b.date) {
			return -1;
		}
		if (a.date > b.date) {
			return 1;
		}
		return 0;
	});
	for (let i = 0; i < DeltaUpdate.list.length; i++) {
		const deltaUpdate = DeltaUpdate.list[i];

		var dataRow = [deltaUpdate.date.substr(0, 7)];
		for (let i = 0; i < cards.length; i++) {
		//for (let i = 0; i < selectedCheckboxes.length; i++) {
			//const card = $(selectedCheckboxes[i]).data("card");
			const card = cards[i];
			dataRow.push(_findDeltaCost(card, deltaUpdate));
		}
		if (cards.length == 0) {
		//if (selectedCheckboxes.length == 0) {
			dataRow.push(0);
		}
		dataRows.push(dataRow);
	}
	data.addRows(dataRows);

	var options = {
		hAxis: {
			title: 'Date'
		},
		vAxis: {
			title: 'Cost'
		},
		series: {
			1: {}
		},
		/*width: ,*/
		height: _options.hasOwnProperty('height') ? _options.height : 500
	};

	var chart = new google.visualization.LineChart(parentElement);
	chart.draw(data, options);
}

function _findDeltaCost(card, deltaUpdate) {
	var cost = null;
	for (let i = 0; i < DeltaUpdate.list.length; i++) {
		const dUpdate = DeltaUpdate.list[i];
		for (let j = 0; j < dUpdate.deltaUpdateCosts.length; j++) {
			const deltaUpdateCost = dUpdate.deltaUpdateCosts[j];
			if (deltaUpdateCost.card.id == card.id) {
				var newCost = vcInclusive()
					? deltaUpdateCost.vcPoints
					: deltaUpdateCost.points;
				if (newCost != null) {
					cost = newCost;
				}
			}
		}
		if (dUpdate.id == deltaUpdate.id) {
			break;
		}
	}
	return cost;
}

function _findSelectedCards() {
	cards = [];
	
	var selectedCheckboxes = $('.cardInput:checkbox:checked');
	for (let i = 0; i < selectedCheckboxes.length; i++) {
		const card = $(selectedCheckboxes[i]).data("card");
		cards.push(card);
	}

	return cards;
}