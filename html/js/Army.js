class Army {
	constructor (armyStr=null) {
		this.units = {};
		if (armyStr != null) {
			var unitStrs = armyStr.split(",");
			for (let i = 0; i < unitStrs.length; i++) {
				const unitStr = unitStrs[i].trim();
				var unit = null;
				var numInArmy = null;
				if (unitsMap[unitStr] === undefined) {
					const idx = unitStr.lastIndexOf("x");
					unit = unitsMap[unitStr.substr(0, idx).trim()];
					numInArmy = parseInt(unitStr.substr(idx+1));
				} else {
					unit = unitsMap[unitStr];
					numInArmy = 1;
				}				
				for (let j = 0; j < numInArmy; j++) {
					this.addUnit(unit);
				}
			}
		}
	}
	
	addUnit(unit) {
		if (this.containsUnit(unit)) {
			this.units[unit.name] += 1;
		} else {
			this.units[unit.name] = 1;
		}
	}
	
	containsUnit(unit) {
		return this.units[unit.name] !== undefined && this.units[unit.name] !== null;
	}
	
	removeUnit(unit, removeAll=false) {
		if (this.units[unit.name] !== undefined && this.units[unit.name] !== null) {
			this.units[unit.name] -= 1;
			if (typeof _saveArmy == 'function') {
				if (this.units[unit.name] == 0 || removeAll) {
					delete this.units[unit.name];
				}
			} else {
				if (this.units[unit.name] <= armyMin-1 || removeAll) {
					delete this.units[unit.name];
				}
			}
		}
	}
	
	unitQuantity(unit) {
		if (this.containsUnit(unit)) {
			return this.units[unit.name];
		}
		return 0;
	}
	
	clear() {
		this.units = {};
	}
	
	getPoints(partial=false) {
		var points = 0;
		for (var unitName in this.units) {
			const numInArmy = this.units[unitName];
			const unit = unitsMap[unitName];
			if (partial) {
				points += unit.getPartialCost() * numInArmy;
			} else {
				points += unit.getCost() * numInArmy;
			}
		}
		return points;
	}
	
	includesRestrictedUnit() {
		if (restrictedList !== undefined) {
			for (var unitName in this.units) {
				if (restrictedList.includes(unitName)) {
					return true;
				}
			}
		}
		return false;
	}
	
	getFigures(partial=false) {
		var figures = 0;
		for (var unitName in this.units) {
			const numInArmy = this.units[unitName];
			const unit = unitsMap[unitName];
			if (partial) {
				switch (unit.uniqueness.toLowerCase()) {
					case "common":
						figures += numInArmy;
						break;
					case "uncommon":
						figures += Math.ceil(unit.figures * numInArmy / unit.lives);
						break;
					case "unique":
						if (unit.squad) {
							figures += numInArmy;
						} else {
							figures += unit.figures;
						}
						break;
				}
			} else {
				figures += unit.figures * numInArmy;
			}
		}
		return figures;
	}
	
	getHexes(partial=false) {
		var hexes = 0;
		for (var unitName in this.units) {
			const numInArmy = this.units[unitName];
			const unit = unitsMap[unitName];
			if (partial) {
				switch (unit.uniqueness.toLowerCase()) {
					case "common":
						if (unit.squad) {
							hexes += (unit.hexes / unit.figures) * numInArmy;
						} else {
							hexes += unit.hexes * numInArmy;
						}
						break;
					case "uncommon":
						hexes += Math.ceil(unit.hexes * numInArmy / unit.lives);
						break;
					case "unique":
						if (unit.squad) {
							hexes += unit.hexes / unit.figures * numInArmy;
						} else {
							hexes += unit.hexes;
						}
						break;
				}
			} else {
				hexes += unit.hexes * numInArmy;
			}
		}
		return hexes;
	}
	
	toString(partial=false, csv=false, skipZero=false) {
		var armyString = "";
		var armyObj = this;
		Object.keys(this.units)
			.sort()
			.forEach(function(unitName, i) {
				if ( ! skipZero || armyObj.units[unitName] > 0) {
					
					const numInArmy = armyObj.units[unitName];
					const unit = unitsMap[unitName];
					if (armyString.length > 0) {
						if (csv) {
							armyString += ",";
						} else {
							armyString += "<br>";
						}
					}
					armyString += unitName;
					if (partial) {
						if (unit.uniqueness != "Unique" || unit.squad) {
							//armyString += " x" + tempArmy[key];
							armyString += " x" + armyObj.units[unitName];
						} else {
							//armyString += " (" + tempArmy[key] + " life)";
							//armyString += " (" + armyObj.units[unitName] + " life)";
							armyString += " x" + armyObj.units[unitName];
						}
					} else {
						if (unit.uniqueness != "Unique") {
							armyString += " x" + armyObj.units[unitName];
						} else if (armyObj.units[unitName] == 0) {
							armyString += " x0";
						}
					}
				}
		});
		for (var unitName in this.units) {
			
		}
		return armyString;
	}
}