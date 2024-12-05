class Unit {
	constructor (row) {
		this.name = row[0];
		this.cost = {
			classic: parseInt(row[1]),
			delta: row[2].toString().trim().length > 0 ? parseInt(row[2]) : null, 
			deltaVC: parseInt(row[4])};
		this.deltaClassicChangeDate = row[3];
		this.deltaVcChangeDate = row[5];
		this.figures = parseInt(row[6]);
		this.hexes = parseInt(row[7]);
		this.uniqueness = row[8];
		this.squad = row[9] == "Squad" ? true : false;
		this.vc = row[10].toString().trim().toLowerCase() == "c3v" ||
				row[10].toString().trim().toLowerCase() == "sov";
		this.marvel = row[10].toString().trim().toLowerCase() == "marvel";
		this.homeworld = row[11];
		this.species = row[12];
		this.class = row[13];
		this.personality = row[14];
		this.powers = [];
		if (row[15].toString().trim().length > 0) {
			this.powers.push({
				name: row[15],
				text: row[16]});
		}
		if (row[17].toString().trim().length > 0) {
			this.powers.push({
				name: row[17],
				text: row[18]});
		}
		if (row[19].toString().trim().length > 0) {
			this.powers.push({
				name: row[19],
				text: row[20]});
		}
		if (row[21].toString().trim().length > 0) {
			this.powers.push({
				name: row[21],
				text: row[22]});
		}
		this.life = parseInt(row[23]);
		this.move = parseInt(row[24]);
		this.range = parseInt(row[25]);
		this.attack = parseInt(row[26]);
		this.defense = parseInt(row[27]);
		this.image = row[28];
		this.general = row[29];
		this.size = row[30];
		this.height = parseInt(row[31]);
		this.bookUrl = row[32];
		this.powerRankings = {
			OEAO: row[33],
			Dok: row[34]};
		if (row.length > 35) {
			this.releaseSet = row[35];
			this.releaseDate = row[36];
		}
		if (row.length > 36) {
			this.nickname = row[37]
		}
	}
	
	getCost() {
		if (deltaPoints) {
			if (vcInclusive) {
				return this.cost.deltaVC;
			} else {
				return this.cost.delta;
			}
		} else {
			return this.cost.classic;
		}
	}
	
	getPartialCost() {
		const cost = this.getCost();
		var partialCost = null;
		switch (this.uniqueness.toLowerCase()) {
			case "common":
				partialCost = cost / (this.figures * this.life);
				break;
			case "uncommon":
				partialCost = cost / (this.figures * this.life);
				break;
			case "unique":
				if (this.squad) {
					partialCost = cost / (this.figures * this.life);
				} else {
					partialCost = cost / this.life;
				}
				break;
		}
		return Math.round(partialCost * 100) / 100;
	}
	
	getGeneral() {
		if (this.general === undefined) {
			return "Z";
		} else if (this.general.length == 0) {
			return "Z";
		} else {
			return this.general;
		}
	}
	
	getHomeworld() {
		if (this.homeworld === undefined) {
			return "Z";
		} else if (this.homeworld.length == 0) {
			return "Z";
		} else {
			return this.homeworld;
		}
	}
	
	getSpecies() {
		if (this.species === undefined) {
			return "Z";
		} else if (this.species.length == 0) {
			return "Z";
		} else {
			return this.species;
		}
	}
	
	getPersonality() {
		if (this.personality === undefined) {
			return "Z";
		} else if (this.personality.length == 0) {
			return "Z";
		} else {
			return this.personality;
		}
	}
	
	getClass() {
		if (this.class === undefined) {
			return "Z";
		} else if (this.class.length == 0) {
			return "Z";
		} else {
			return this.class;
		}
	}
	
	getBackgroundColor() {
		switch (this.general) {
			case "Jandar":
				return "#4287f5";
			case "Ullar":
				return "#357854";
			case "Einar":
				return "#e6aa12";
			case "Vydar":
				return "#7f95e6";
			case "Utgar":
				return "#e30b00";
			case "Aquilla":
				return "#b473f5";
			case "Valkrill":
				return "#d9b800";
			case "Revna":
				return "#b39674";
			case "Marvel":
				return "#F1E5AC";
			
			// HoSS
			case "Galactic Empire":
				return "#FF8065"; // Red
			case "Rebel Alliance":
				return "#68B46B"; // Green
			case "Independent":
				return "#FFEB90"; // Tan
			case "Separatist Alliance":
				return "#FEBB00"; // Orange/Yellow
			case "Galactic Republic":
				return "#70A8FF"; // Blue
		}
		return "white";
	}
	
	getTextColor() {
		switch (this.general) {
			case "Utgar":
				return "white";
			default:
				return "black";
		}
		return "black";
	}
}

var units = [];
var unitsMap = {};

var unitsSpecies = [];
var unitsClasses = [];
var unitsPersonalities = [];
// .species, .class, .personality 

function loadUnits(tournament=null) {
	units = [];
	unitsMap = {};
	
	unitsSpecies = [];
	unitsClasses = [];
	unitsPersonalities = [];
	
	return new Promise(function(resolve, reject) {
		FigureSet.load(
			{},
			function (figureSets) {
				var baseFigureSet = null;
				var currFigureSet = null;
				const sDomain = getSubdomain();
				for (let i = 0; i < figureSets.length; i++) {
					const figureSet = figureSets[i];
					if (tournament != null) {
						if (figureSet.id == tournament.figureSet.id) {
							currFigureSet = figureSet; 
						}
					} else if (figureSet.sDomain == sDomain) {
						currFigureSet = figureSet;
					} 
					if (figureSet.sDomain.length == 0) {
						baseFigureSet = figureSet;
					}  
				}
				
				var unitDataSheetURL = "https://sheets.googleapis.com/v4/spreadsheets/"+currFigureSet.googleDocId+"/values/ArmyBuilder!A:AZ?key="+googleAPIsKey;
				_loadUnits(unitDataSheetURL, resolve, reject);
				
				if (currFigureSet.includeBase) {
					unitDataSheetURL = "https://sheets.googleapis.com/v4/spreadsheets/"+baseFigureSet.googleDocId+"/values/ArmyBuilder!A:AZ?key="+googleAPIsKey;
					_loadUnits(unitDataSheetURL, resolve, reject);
				}
			},
			{joins: {
				
			}}
		);
	});
}

function _loadUnits(googleUrl, resolve, reject) {
	$.ajax({
		url: googleUrl,
		success: function(data) {
			for (let i = 1; i < data.values.length; i++) {
				var unit = new Unit(data.values[i]);
				units.push(unit);
				unitsMap[unit.name] = unit;
				
				if ( ! unitsSpecies.includes(unit.species)) {
					unitsSpecies.push(unit.species);
				}
				if ( ! unitsClasses.includes(unit.class)) {
					unitsClasses.push(unit.class);
				}
				if ( ! unitsPersonalities.includes(unit.personality)) {
					unitsPersonalities.push(unit.personality);
				}
			}
			
			unitsSpecies.sort();
			unitsClasses.sort();
			unitsPersonalities.sort();
			
			if (typeof setupPage != 'undefined') {
				setupPage();
			}
			resolve();
		}
	});
}