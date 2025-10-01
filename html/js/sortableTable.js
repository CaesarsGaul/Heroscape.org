_sortableTableData = {};

function createSortableTable(tableID, headers=null, data=null) {
	if (! _sortableTableData.hasOwnProperty(tableID)) {
		_sortableTableData[tableID] = {};
		_sortableTableData[tableID].headers = headers;
		_sortableTableData[tableID].data = data;
		_sortableTableData[tableID].sortColumn = null;
		_sortableTableData[tableID].sortDirection = 1;
	}
	
	var table = document.getElementById(tableID);
	table.innerHTML = null;
	
	var tr = createTr({class: "sortableTableHeaderTr"});
	table.appendChild(tr);
	tr.appendChild(createTd({}));
	for (let i = 0; i < _sortableTableData[tableID].headers.length; i++) {
		tr.appendChild(createTh({
			innerHTML: _sortableTableData[tableID].headers[i],
			onclick: "_sortTable('"+tableID+"',"+i+")"
		}));
	}
	
	if (_sortableTableData[tableID].sortColumn != null) {		
		_sortableTableData[tableID].data.sort(function(a, b) {
			aValue = a[_sortableTableData[tableID].sortColumn];
			if (! isNaN(parseFloat(aValue))) {
				aValue = parseFloat(aValue);
			}
			bValue = b[_sortableTableData[tableID].sortColumn];
			if (! isNaN(parseFloat(bValue))) {
				bValue = parseFloat(bValue);	
			}
			if (aValue > bValue) {
				return -1 * _sortableTableData[tableID].sortDirection;
			} else if (aValue < bValue) {
				return 1 * _sortableTableData[tableID].sortDirection;
			} else {
				return 0;
			}
		});
	}
	
	for (let i = 0; i < _sortableTableData[tableID].data.length; i++) {
		const dataRow = _sortableTableData[tableID].data[i];
		var tr = createTr({class: "sortableTableRow"});
		tr.appendChild(createTd({innerHTML: (i+1)}));
		table.appendChild(tr);
		for (let j = 0; j < dataRow.length; j++) {
			const dataElem = dataRow[j];
			tr.appendChild(createTd({
				innerHTML: dataElem
			}));
		}
	}
}

function _sortTable(tableID, columnNum) {
	if (_sortableTableData[tableID].sortColumn == columnNum) {
		_sortableTableData[tableID].sortDirection *= -1;
	} else {
		_sortableTableData[tableID].sortDirection = 1;
	}
	_sortableTableData[tableID].sortColumn = columnNum;
	createSortableTable(tableID);
}