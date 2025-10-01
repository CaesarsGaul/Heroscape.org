// Hex math defined here: http://blog.ruslans.com/2011/02/hexagonal-grid-math.html

// Lava Field, Snow, Swamp. Dungeon
// Swamp Water, Molten Lava, Ice, Shadow
// Tree(s), Glacier(s), Jungle Tree(s), Jungle Bush(s), Rock Outcrop(s)
class TileType {
	constructor(name, imgSrc, color) {
		this.name = name;
		this.imgSrc = imgSrc;
		this.color = color;
	}
}
const grass = new TileType("Grass", "/images/tiles/grass2.png", "lightgreen");
const rock = new TileType("Rock", null, "grey");
const sand = new TileType("Sand", null, "beige");
const water = new TileType("Water", "/images/tiles/water2.png", "lightblue");
const road = new TileType("Road", null, "lightgrey");
const tree = new TileType("Tree", null, "darkgreen");

class Tile {
	// height=int, type=TileType, row=int, col=int, selected=boolean
	
	constructor(type, col, row, height) {
		this.type = type;
		this.height = height;
		this.row = row;
		this.col = col;
		this.selected = false;
		this.validTarget = false;
	}
}

class HsGame {
	// Must talk to Database
	
	constructor(onlineGame) {
		this.onlineGame = onlineGame;
		this.map = new HsMap(this);
		
		
		
		//this.palyers = players;
		//this.rounds = [];
		
		this.createWoundBox();
	}
	
	getCurrentGameState() {
		var idx = 0;
		for (let i = 1; i < OnlineGameState.list.length; i++) {
			if (OnlineGameState.list[i].timestamp > OnlineGameState.list[idx].timestamp) {
				idx = i;
			}
		}
		return OnlineGameState.list[idx];		
	}
	
	createWoundBox() {
		var parentElem = document.getElementById("WoundDiv");
		const gameState = this.getCurrentGameState();
		
		gameState.onlineGameStateFigures.sort(function(a, b) {
			if (a.figure.figure.card.name > b.figure.figure.card.name) {
				return 1;
			} else {
				return -1;
			}
		});
			
		for (let i = 0; i < this.onlineGame.onlineGamePlayers.length; i++) {
			const player = this.onlineGame.onlineGamePlayers[i];
			
			var playerWoundDiv = createDiv({
				class: "playerWoundDiv"
			});
			parentElem.appendChild(playerWoundDiv);
			playerWoundDiv.appendChild(createH3({
				innerHTML: player.name
			}));
			
			for (let j = 0; j < gameState.onlineGameStateFigures.length; j++) {
				const gameStateFigure = gameState.onlineGameStateFigures[j];
				const playerFigure = gameStateFigure.figure;
				const figure = playerFigure.figure;
				const card = figure.card;
				if (card.hero && playerFigure.player.id == player.id) {
					var figureWoundDiv = createDiv({
						class: "figureWoundDiv"
					});
					playerWoundDiv.appendChild(figureWoundDiv);
					
					figureWoundDiv.appendChild(createSpan({
						class: "figureWoundName",
						innerHTML: card.name
					}));
					figureWoundDiv.appendChild(createInput({
						id: "figureWoundInput_"+figure.id,
						class: "figureWoundInput",
						type: "number",
						min: 0,
						max: card.life,
						step: 1,
						value: gameStateFigure.wounds
					}));
					figureWoundDiv.appendChild(createSpan({
						class: "figureWoundTotal",
						innerHTML: "/ " + card.life
					}));
				}
			}
		}
	}
	
	createOrderMarkerBox() {
		
	}
	
}

class HsMapOld {
	// tiles=[][Tile], grid=HexGrid
	
	constructor(hsGame) {
		this.hsGame = hsGame;
		this.onlineGame = hsGame.onlineGame;
		this.grid = new HexGrid(this);
		this.tiles = [];
		for (const [col, rowData] of Object.entries(JSON.parse(this.onlineGame.map.tiles))) {
			this.tiles[col] = [];
			for (let i = 0; i < rowData.length; i++) {
				this.tiles[col][rowData[i].row] = new Tile(rowData[i].type, col, rowData[i].row, rowData[i].height);
			}
		}
		this.glyphs = this.onlineGame.glyphLocations;
		//this.players = this.onlineGame.onlineGamePlayers;
		this.draw();
	}
	
	draw() {		
		this._drawTiles();
		this._drawGlyphs();
		this._drawFigures();
	}
	
	_drawTiles() {
		for (let i = 0; i < this.tiles.length; i++) {
			if (this.tiles[i] !== undefined && this.tiles[i] !== null) {
				for (let j = 0; j < this.tiles[i].length; j++) {
					if (this.tiles[i][j] !== undefined && this.tiles[i][j] !== null) {
						if ( ! this.tiles[i][j].selected && ! this.tiles[i][j].validTarget) {
							this.grid.drawTile(this.tiles[i][j]);
						}
					}
				}
			}
		}
		for (let i = 0; i < this.tiles.length; i++) {
			if (this.tiles[i] !== undefined && this.tiles[i] !== null) {
				for (let j = 0; j < this.tiles[i].length; j++) {
					if (this.tiles[i][j] !== undefined && this.tiles[i][j] !== null) {
						if (this.tiles[i][j].selected) {
							this.grid.drawTile(this.tiles[i][j]);
						}
					}
				}
			}
		}
		for (let i = 0; i < this.tiles.length; i++) {
			if (this.tiles[i] !== undefined && this.tiles[i] !== null) {
				for (let j = 0; j < this.tiles[i].length; j++) {
					if (this.tiles[i][j] !== undefined && this.tiles[i][j] !== null) {
						if (this.tiles[i][j].validTarget) {
							this.grid.drawTile(this.tiles[i][j]);
						}
					}
				}
			}
		}
	}
	
	_drawGlyphs() {
		for (let i = 0; i < this.glyphs.length; i++) {
			this.grid.drawGlyph(this.glyphs[i]);
		}
	}
	
	_drawFigures() {
		const gameState = this.hsGame.getCurrentGameState();
		for (let j = 0; j < gameState.onlineGameStateFigures.length; j++) {
			const gameStateFigure = gameState.onlineGameStateFigures[j];
			this.grid.drawFigure(gameStateFigure);
		}
	}
	
	getGlyph(col, row) {
		for (let i = 0; i < this.glyphs.length; i++) {
			const glyph = this.glyphs[i];
			if (glyph.col == col && glyph.row == row) {
				return glyph;
			}
		}
		return null;
	}
	
	getFigure(col, row) {
		for (let i = 0; i < this.players.length; i++) {
			const player = this.players[i];
			for (let j = 0; j < player.army.length; j++) {
				const figure = player.army[j];
				if (figure.row == row && figure.col == col) {
					return figure;
				}
			}
		}
		return null;
	}
	
	hexExists(col, row) {
		if (this.tiles[col] !== undefined && this.tiles[col] !== null) {
			if (this.tiles[col][row] !== undefined && this.tiles[col][row] !== null) {
				return true;
			}
		}
		return false;
	}
	
	getHex(col, row) {
		if (this.hexExists(col, row)) {
			return this.tiles[col][row];
		}
		return null;
	}
	
	markHexTargetable(col, row) {
		if (this.hexExists(col, row)) {
			this.tiles[col][row].validTarget = true;
		}
	}
	
	targetableHex(col, row) {
		if (this.hexExists(col, row)) {
			if (this.tiles[col][row].validTarget == true) {
				return true;
			}
		}
	}
	
	setHighlightedFigure(figure) {
		this.highlightedFigure = figure;
	}
	
	getHighlightedFigure() {
		return this.highlightedFigure;
	}
	
	highlightHex(col, row) {
		this.tiles[col][row].selected = true;
	}
	
	clearAllHighlight() {
		for (let i = 0; i < this.tiles.length; i++) {
			if (this.tiles[i] !== undefined && this.tiles[i] !== null) {
				for (let j = 0; j < this.tiles[i].length; j++) {
					if (this.tiles[i][j] !== undefined && this.tiles[i][j] !== null) {
						this.tiles[i][j].selected = false;
						this.tiles[i][j].validTarget = false;
					}
				}
			}
		}
	}
	
	toggleHexHighlight(col, row) {
		for (let i = 0; i < this.tiles.length; i++) {
			if (this.tiles[i] !== undefined && this.tiles[i] !== null) {
				for (let j = 0; j < this.tiles[i].length; j++) {
					if (this.tiles[i][j] !== undefined && this.tiles[i][j] !== null) {
						if (i == col && j == row) {
							this.tiles[i][j].selected = !this.tiles[i][j].selected;
							break;
						}
					}
				}
			}
		}
	}
}

// OLD STUFF ABOVE THIS LINE

// NEW STUFF BELOW THIS LINE 

class OnlineMapBuilder {
	constructor(onlineMap=null) {
		this.grid = new HexGrid(this);
		
		this.levels = [];
		this.levels[1] = new OnlineMapLevel(this, 1);
		this.currentLevel = 1;
		
		if (onlineMap != null) { // Loading Saved Map
			this.onlineMap = onlineMap; 
			
			for (let i = 0; i < onlineMap.onlineMapTerrainPieces.length; i++) {
				const onlineMapTerrainPiece = onlineMap.onlineMapTerrainPieces[i];
				while (onlineMapTerrainPiece.level >= this.levels.length) {
					this.levels[this.levels.length] = new OnlineMapLevel(this, this.levels.length);
				}
				this.addTerrainPiece(onlineMapTerrainPiece); 
			}
			
		} else { // New Map
			this.onlineMap = new OnlineMap();
		}
				
		this.reDraw();
	}
	
	clear() {
		this.grid.clear();
	}
	
	reDraw() {		
		this.grid.clear();
		for (let i = 1; i <= this.currentLevel; i++) {
			this.levels[i].clear();
			var opacity = null;
			if (i == this.currentLevel-1) {
				opacity = 0.75;
			} else if (i == this.currentLevel-2) {
				opacity = 0.625;
			} else if (i < this.currentLevel) {
				opacity = 0.5;
			}
			this.levels[i].reDraw(opacity);
		}
		
		var selectedHexes = false;
		for (let i = 0; i < this.onlineMap.onlineMapTerrainPieces.length; i++) {
			if (this.onlineMap.onlineMapTerrainPieces[i].selected) {
				selectedHexes = true;
				break;
			}
		}
		if (selectedHexes) {
			document.getElementById("HighlightTerrainTopRowOption").style.visibility = "visible";
		} else {
			document.getElementById("HighlightTerrainTopRowOption").style.visibility = "hidden";
		}
	}
	
	save() {
		const nameInput = document.getElementById("MapNameInput");
		if ( ! nameInput.reportValidity()) {
			return;
		}
		const newName = nameInput.value;
		
		if (newName != this.onlineMap.name && this.onlineMap.id !== null) {
			this.onlineMap = new OnlineMap();
		}
		this.onlineMap.name = newName;
		
		if (this.onlineMap.id !== null) {
			this.onlineMap._serverUpdate();
		} else {
			this.onlineMap._serverCreate();
		}		
	}
	
	addTerrainPiece(terrainPiece, column=null, row=null) {
		this.deSelectAllTerrain();
		var level = null;
		if (terrainPiece instanceof TerrainPiece) {
			level = this.currentLevel;
			var onlineMapTerrainPiece = new OnlineMapTerrainPiece();
			onlineMapTerrainPiece.onlineMap = this.onlineMap;			
			onlineMapTerrainPiece.terrainPiece = terrainPiece;
			onlineMapTerrainPiece.level = level;
			onlineMapTerrainPiece.column = column;
			onlineMapTerrainPiece.row = row;
			onlineMapTerrainPiece.direction = 1;
			onlineMapTerrainPiece.selected = true;
			this.onlineMap.onlineMapTerrainPieces.push(onlineMapTerrainPiece);
			terrainPiece = onlineMapTerrainPiece;
		} else if (terrainPiece instanceof OnlineMapTerrainPiece) {
			column = terrainPiece.column;
			row = terrainPiece.row;
			level = terrainPiece.level;
			terrainPiece.selected = false;
		}
		
		
		this.levels[level].addTerrainPiece(terrainPiece, column, row);
		
		this.reDraw();
	}
	
	moveTerrainPiece(prevColumn, prevRow, newColumn, newRow) {
		const level = this.levels[this.currentLevel];
		var onlineMapTerrainPiece = level.getHex(prevColumn, prevRow);
		if (onlineMapTerrainPiece != null) {
			onlineMapTerrainPiece.column = newColumn;
			onlineMapTerrainPiece.row = newRow;
			
			level.terrain[prevColumn][prevRow] = undefined;
			level.addTerrainPiece(onlineMapTerrainPiece, newColumn, newRow);
			
			this.reDraw();
		}
	}
	
	deSelectAllTerrain() {
		for (let i = 0; i < this.onlineMap.onlineMapTerrainPieces.length; i++) {
			this.onlineMap.onlineMapTerrainPieces[i].selected = false;
		}
	}
	
	levelUp() {
		this.currentLevel++;
		if (this.levels.length <= this.currentLevel) {
			this.levels[this.currentLevel] = new OnlineMapLevel(this, this.currentLevel);
		}
		this.reDraw();
	}
	
	levelDown() {
		if (this.currentLevel > 1) {
			this.currentLevel--;
			this.reDraw();
		}
	}
	
	getGlyph(level, col, row) {
		return this.levels[level].getGlyph(col, row);
	}
	
	getFigure(level, col, row) {
		return this.levels[level].getFigure(col, row);
	}
	
	hexExists(level, col, row) {
		return this.levels[level].hexExists(col, row);
	}
	
	getHex(level, col, row) {
		return this.levels[level].getHex(col, row);
	}
	
	deleteSelectedTiles() {
		for (let i = 1; i < this.levels.length; i++) {
			this.levels[i].deleteSelectedTiles();
		}
		this.reDraw();
	}
	
	rotateSelectedTilesLeft() {
		for (let i = 1; i < this.levels.length; i++) {
			this.levels[i].rotateSelectedTilesLeft();
		}
		this.reDraw();
	}
	
	rotateSelectedTilesRight() {
		for (let i = 1; i < this.levels.length; i++) {
			this.levels[i].rotateSelectedTilesRight();
		}
		this.reDraw();
	}
}

class OnlineMapLevel {
	
	constructor(hsMap, level) {
		this.map = hsMap;
		this.grid = this.map.grid;
		this.level = level;
		
		this.terrain = [];
		this.glyphs = [];
		this.figures = [];
		
		this.grid.addLevel(level);
	}
	
	clear() {
		this.grid.clear(this.level); 
	}
	
	reDraw(opacity=null) {
		this._drawTerrain(opacity);
		this._drawGlyphs(opacity);
		this._drawFigures(opacity);
	}
	
	addTerrainPiece(onlineMapTerrainPiece, colNum, rowNum) {
		if (this.terrain[colNum] === undefined || this.terrain[colNum] === null) {
			this.terrain[colNum] = [];
		}
		this.terrain[colNum][rowNum] = onlineMapTerrainPiece;
	}
	
	_drawTerrain(opacity=null) {
		for (let i = 1; i < this.terrain.length; i++) {
			if (this.terrain[i] !== undefined && this.terrain[i] !== null) {
				for (let j = 1; j < this.terrain[i].length; j++) {
					if (this.terrain[i][j] !== undefined && this.terrain[i][j] !== null) {
						if ( ! this.terrain[i][j].selected) {
							this.grid.drawTerrain(this.terrain[i][j], opacity);
						}
					}
				}
			}
		}
		for (let i = 1; i < this.terrain.length; i++) {
			if (this.terrain[i] !== undefined && this.terrain[i] !== null) {
				for (let j = 1; j < this.terrain[i].length; j++) {
					if (this.terrain[i][j] !== undefined && this.terrain[i][j] !== null) {
						if (this.terrain[i][j].selected) {
							this.grid.drawTerrain(this.terrain[i][j], opacity);
						}
					}
				}
			}
		}
	}
	
	_drawGlyphs(opacity=null) {
		for (let i = 0; i < this.glyphs.length; i++) {
			this.grid.drawGlyph(this.glyphs[i]);
		}
	}
	
	_drawFigures(opacity=null) {
		/*const gameState = this.hsGame.getCurrentGameState();
		for (let j = 0; j < gameState.onlineGameStateFigures.length; j++) {
			const gameStateFigure = gameState.onlineGameStateFigures[j];
			this.grid.drawFigure(gameStateFigure);
		}*/
	}
	
	getGlyph(col, row) {
		for (let i = 0; i < this.glyphs.length; i++) {
			const glyph = this.glyphs[i];
			if (glyph.col == col && glyph.row == row) {
				return glyph;
			}
		}
		return null;
	}
	
	getFigure(col, row) {
		/*for (let i = 0; i < this.players.length; i++) {
			const player = this.players[i];
			for (let j = 0; j < player.army.length; j++) {
				const figure = player.army[j];
				if (figure.row == row && figure.col == col) {
					return figure;
				}
			}
		}
		return null;*/
	}
	
	hexExists(col, row) {
		return this.getHex(col, row) != null;
	}
	
	getHex(col, row) {
		if (this.terrain[col] != undefined && this.terrain[col] != null) {
			if (this.terrain[col][row] != undefined && this.terrain[col][row] != null) {
				return this.terrain[col][row];
			}
		}
		
		for (let x = 1; x < this.terrain.length; x++) {
			if (this.terrain[x] == undefined || this.terrain[x] == null) {
				continue;
			}
			for (let y = 1; y < this.terrain[x].length; y++) {
				const onlineMapTerrainPiece = this.terrain[x][y];
				if (onlineMapTerrainPiece == undefined || onlineMapTerrainPiece == null) {
					continue;
				}
				const terrainPiece = onlineMapTerrainPiece.terrainPiece;
				
				if (terrainPiece.terrainSize.size == 2 || terrainPiece.terrainSize.size == 3 || terrainPiece.terrainSize.size == 7) {
					switch (onlineMapTerrainPiece.direction) {
						case 1:
							if (onlineMapTerrainPiece.column == col && onlineMapTerrainPiece.row == row-1) {
								return onlineMapTerrainPiece;
							}
							break;
						case 2:
							if (onlineMapTerrainPiece.column == col+1 && onlineMapTerrainPiece.row == (col%2==0 ? row : row-1)) {
								return onlineMapTerrainPiece;
							}
							break;
						case 3:
							if (onlineMapTerrainPiece.column == col+1 && onlineMapTerrainPiece.row == (col%2==0 ? row+1 : row)) {
								return onlineMapTerrainPiece;
							}
							break;
						case 4:
							if (onlineMapTerrainPiece.column == col && onlineMapTerrainPiece.row == row+1) {
								return onlineMapTerrainPiece;
							}
							break;
						case 5:
							if (onlineMapTerrainPiece.column == col-1 && onlineMapTerrainPiece.row == (col%2==0 ? row+1 : row)) {
								return onlineMapTerrainPiece;
							}
							break;
						case 6:
							if (onlineMapTerrainPiece.column == col-1 && onlineMapTerrainPiece.row == (col%2==0 ? row : row-1)) {
								return onlineMapTerrainPiece;
							}
							break;
					}
				}
				if (terrainPiece.terrainSize.size == 3 || terrainPiece.terrainSize.size == 7) {
					switch (onlineMapTerrainPiece.direction) {
						case 1:
							if (onlineMapTerrainPiece.column == col-1 && onlineMapTerrainPiece.row == (col%2==0 ? row : row-1)) {
								return onlineMapTerrainPiece;
							}
							break;
						case 2:
							if (onlineMapTerrainPiece.column == col && onlineMapTerrainPiece.row == row-1) {
								return onlineMapTerrainPiece;
							}
							break;
						case 3:
							if (onlineMapTerrainPiece.column == col+1 && onlineMapTerrainPiece.row == (col%2==0 ? row : row-1)) {
								return onlineMapTerrainPiece;
							}
							break;
						case 4:
							if (onlineMapTerrainPiece.column == col+1 && onlineMapTerrainPiece.row == (col%2==0 ? row+1 : row)) {
								return onlineMapTerrainPiece;
							}
							break;
						case 5:
							if (onlineMapTerrainPiece.column == col && onlineMapTerrainPiece.row == row+1) {
								return onlineMapTerrainPiece;
							}
							break;
						case 6:
							if (onlineMapTerrainPiece.column == col-1 && onlineMapTerrainPiece.row == (col%2==0 ? row+1 : row)) {
								return onlineMapTerrainPiece;
							}
							break;
					}
				}
				if (terrainPiece.terrainSize.size == 7) {
					switch (onlineMapTerrainPiece.direction) {
						case 1:
							if ((onlineMapTerrainPiece.column == col-1 && onlineMapTerrainPiece.row == (col%2==0 ? row+1 : row)) ||
								(onlineMapTerrainPiece.column == col-2 && onlineMapTerrainPiece.row == row) ||
								(onlineMapTerrainPiece.column == col-2 && onlineMapTerrainPiece.row == row-1) ||
								(onlineMapTerrainPiece.column == col-1 && onlineMapTerrainPiece.row == (col%2==0 ? row-1 : row-2))) {
								return onlineMapTerrainPiece;
							}
							break;
						case 2:
							if ((onlineMapTerrainPiece.column == col-1 && onlineMapTerrainPiece.row == (col%2==0 ? row : row-1)) || 
								(onlineMapTerrainPiece.column == col-1 && onlineMapTerrainPiece.row == (col%2==0 ? row-1 : row-2)) ||
								(onlineMapTerrainPiece.column == col && onlineMapTerrainPiece.row == row-2) ||
								(onlineMapTerrainPiece.column == col+1 && onlineMapTerrainPiece.row == (col%2==0 ? row-1 : row-2))) {
								return onlineMapTerrainPiece;
							}
							break;
						case 3:
							if ((onlineMapTerrainPiece.column == col && onlineMapTerrainPiece.row == row-1) ||
								(onlineMapTerrainPiece.column == col+1 && onlineMapTerrainPiece.row == (col%2==0 ? row-1 : row-2)) ||
								(onlineMapTerrainPiece.column == col+2 && onlineMapTerrainPiece.row == row-1) ||
								(onlineMapTerrainPiece.column == col+2 && onlineMapTerrainPiece.row == row)) {
								return onlineMapTerrainPiece;
							}
							break;
						case 4:
							if ((onlineMapTerrainPiece.column == col+1 && onlineMapTerrainPiece.row == (col%2==0 ? row : row-1)) ||
								(onlineMapTerrainPiece.column == col+2 && onlineMapTerrainPiece.row == row) ||
								(onlineMapTerrainPiece.column == col+2 && onlineMapTerrainPiece.row == row+1) ||
								(onlineMapTerrainPiece.column == col+1 && onlineMapTerrainPiece.row == (col%2==0 ? row+2 : row+1))) {
								return onlineMapTerrainPiece;
							}
							break;
						case 5:
							if ((onlineMapTerrainPiece.column == col+1 && onlineMapTerrainPiece.row == (col%2==0 ? row+1 : row)) ||
								(onlineMapTerrainPiece.column == col+1 && onlineMapTerrainPiece.row == (col%2==0 ? row+2 : row+1)) ||
								(onlineMapTerrainPiece.column == col && onlineMapTerrainPiece.row == row+2) ||
								(onlineMapTerrainPiece.column == col-1 && onlineMapTerrainPiece.row == (col%2==0 ? row+2 : row+1))) {
								return onlineMapTerrainPiece;
							}
							break;
						case 6:
							if ((onlineMapTerrainPiece.column == col && onlineMapTerrainPiece.row == row+1) || 
								(onlineMapTerrainPiece.column == col-1 && onlineMapTerrainPiece.row == (col%2==0 ? row+2 : row+1)) ||
								(onlineMapTerrainPiece.column == col-2 && onlineMapTerrainPiece.row == row+1) ||
								(onlineMapTerrainPiece.column == col-2 && onlineMapTerrainPiece.row == row)) {
								return onlineMapTerrainPiece;
							}
							break;
					}
				}
			}
		}
		
		// TODO - need to find out if spot is covered by a hex of > 1 size
		
		return null;
	}
	
	deleteSelectedTiles() {
		for (let i = 1; i < this.terrain.length; i++) {
			if (this.terrain[i] !== undefined && this.terrain[i] !== null) {
				for (let j = 1; j < this.terrain[i].length; j++) {
					if (this.terrain[i][j] !== undefined && this.terrain[i][j] !== null && this.terrain[i][j].selected) {
						for (let k = 0; k < this.map.onlineMap.onlineMapTerrainPieces.length; k++) {
							if (this.map.onlineMap.onlineMapTerrainPieces[k] == this.terrain[i][j]) {
								this.map.onlineMap.onlineMapTerrainPieces.splice(k, 1);
								break;
							}
						}
						this.terrain[i][j] = undefined;
					}
				}
			}
		}
	}
	
	rotateSelectedTilesLeft() {
		for (let i = 1; i < this.terrain.length; i++) {
			if (this.terrain[i] !== undefined && this.terrain[i] !== null) {
				for (let j = 1; j < this.terrain[i].length; j++) {
					if (this.terrain[i][j] !== undefined && this.terrain[i][j] !== null && this.terrain[i][j].selected) {
						this.terrain[i][j].direction += 1;
						if (this.terrain[i][j].direction > 6) {
							this.terrain[i][j].direction = 1;
						}
					}
				}
			}
		}
	}
	
	rotateSelectedTilesRight() {
		for (let i = 1; i < this.terrain.length; i++) {
			if (this.terrain[i] !== undefined && this.terrain[i] !== null) {
				for (let j = 1; j < this.terrain[i].length; j++) {
					if (this.terrain[i][j] !== undefined && this.terrain[i][j] !== null && this.terrain[i][j].selected) {
						this.terrain[i][j].direction -= 1;
						if (this.terrain[i][j].direction < 1) {
							this.terrain[i][j].direction = 6;
						}
						
					}
				}
			}
		}
	}
}

const svgId = "SvgHexGrid";
const svgNs = "http://www.w3.org/2000/svg";
const hexRadius = 25;

class HexGrid {
	
	constructor(map) {
		this.map = map;
		
		this.hexRadius = hexRadius;
		this.hexHeight = Math.sqrt(3) * hexRadius;
		this.hexWidth = 2 * hexRadius;
		this.hexSideLength = (3 / 2) * hexRadius;
		
		this.glyphRadius = hexRadius-5;
		this.glyphHeight = Math.sqrt(3) * this.glyphRadius;
		this.glyphWidth = 2 * this.glyphRadius;
		this.glyphSideLength = (3 / 2) * this.glyphRadius;
		
		this.figureRadius = hexRadius-5;
		this.figureHeight = Math.sqrt(3) * this.figureRadius;
		this.figureWidth = this.figureHeight;
		
		this.columnOffset = this.hexWidth - .57735 * this.hexHeight / 2;

		this.svg = document.getElementById(svgId);
		this.emptyGrid = document.getElementById("SvgEmptyGrid");
		
		this.tileGrids = [];
		this.glyphGrids = [];
		this.szGrids = [];
		this.figureGrids = [];
		
		this.fillEmptyGrid();
	}
	
	fillEmptyGrid() {
		var colNum = 1;
		for (let x = 0; x < 1400; x+= this.columnOffset) {
			var y = colNum%2 == 1
				? this.hexHeight
				: this.hexHeight/2;
			var rowNum = colNum%2 == 1
				? 2
				: 1;
			for (; y < 1400; y+= this.hexHeight) {
				var hex = this.drawHex(x, y, this.hexWidth, this.hexHeight, this.hexSideLength, "white", "black", this.emptyGrid);
				hex.setAttribute("rowNum", rowNum);
				hex.setAttribute("colNum", colNum);
				hex.setAttribute("onmouseup", "dropExistingTerrain(this)");
				rowNum++;
			}
			colNum++;
		}
	}
	
	clear(level=null) {
		if (level !== null) {
			$(this.tileGrids[level]).empty();
			$(this.glyphGrids[level]).empty();
			$(this.szGrids[level]).empty();
			$(this.figureGrids[level]).empty();
		} else {
			for (let i = 1; i < this.tileGrids.length; i++) {
				$(this.tileGrids[i]).empty();
				$(this.glyphGrids[i]).empty();
				$(this.szGrids[i]).empty();
				$(this.figureGrids[i]).empty();
			}
		}
	}
	
	addLevel(level) {
		var levelG = document.createElementNS(svgNs, "g");
		levelG.setAttribute('id', 'SvgGrid_Level'+level);
		this.svg.appendChild(levelG);
		
		var tileGrid = document.createElementNS(svgNs, "g");
		tileGrid.setAttribute('id', 'SvgTileGrid_Level'+level);
		levelG.appendChild(tileGrid);
		this.tileGrids[level] = tileGrid;
		
		var glyphGrid = document.createElementNS(svgNs, "g");
		glyphGrid.setAttribute('id', 'SvgGlyphGrid_Level'+level);
		levelG.appendChild(glyphGrid);
		this.glyphGrids[level] = glyphGrid;
		
		var szGrid = document.createElementNS(svgNs, "g");
		szGrid.setAttribute('id', 'SvgSzGrid_Level'+level);
		levelG.appendChild(szGrid);
		this.szGrids[level] = szGrid;
		
		var figureGrid = document.createElementNS(svgNs, "g");
		figureGrid.setAttribute('id', 'SvgFigureGrid_Level'+level);
		levelG.appendChild(figureGrid);
		this.figureGrids[level] = figureGrid;
	}
	
	drawGlyph(glyph) {
		const x0 = this.columnOffset*glyph.col+5;
		const y0 = (this.hexHeight * (glyph.col%2==0 ? glyph.row : glyph.row+0.5))+5;
		this.drawHex(
			x0, 
			y0, 
			this.glyphWidth,
			this.glyphHeight,
			this.glyphSideLength,
			"darkred",
			"black",
			this.svgGlyphGrid); 
		this.drawText(
			x0 + (this.glyphWidth / 2) - 5,
			y0 + (this.glyphHeight / 2) + 5,
			glyph.glyph.abbreviation,
			28,
			"white",
			this.svgGlyphGrid);
		this.drawText(
			x0 + (this.glyphWidth / 2) - 2,
			y0 + (this.glyphHeight / 2) + 15,
			this.map.tiles[glyph.col][glyph.row].height,
			18,
			"white",
			this.svgGlyphGrid);
	}
	
	drawTerrain(onlineMapTerrainPiece, opacity=null) {
		const terrainPiece = onlineMapTerrainPiece.terrainPiece;
		const column = parseInt(onlineMapTerrainPiece.column)
		const row = parseInt(onlineMapTerrainPiece.row);
		const level = onlineMapTerrainPiece.level;
		const direction = onlineMapTerrainPiece.direction;
		
		const x0 = this.columnOffset*(column-1);
		const y0 = this.hexHeight * ((column-1)%2==0 ? (row-1) : (row-1)+0.5);
		const hexGrid = this;
		
		var height = this.hexHeight;
		var width = this.hexWidth;
		switch (terrainPiece.terrainSize.size) {
			case 1:
				// Do Nothing
				break;
			case 2:
				height *= 2;
				break;
			case 3:
				height *= 2;
				width += this.columnOffset;
				break;
			case 7:
				height *= 3;
				width += 2*this.columnOffset;
				break;
		}
		
		if (terrainPiece.image != null) {
			var imageX0 = x0;
			var imageY0 = y0;
			switch (terrainPiece.terrainSize.size) {
				case 1:
				case 2:
				case 3:
					// No Change
					break;
				case 7:
					imageY0 -= this.hexHeight / 2;
			}
			
			var img = this.drawImage(
				imageX0,
				imageY0,
				height,
				width, 
				terrainPiece.image,
				this.tileGrids[level],
				onlineMapTerrainPiece.direction,
				onlineMapTerrainPiece.selected,
				opacity,
				x0,
				y0);
			img.setAttribute("id", "OnlineMapTerrainPiece_"+onlineMapTerrainPiece.id);
			img.setAttribute("anchorColumn", onlineMapTerrainPiece.column);
			img.setAttribute("anchorRow", onlineMapTerrainPiece.row);
			if (opacity != null && opacity < 1) {
				/*img.setAttribute("ondrop", "dropTerrain(event, this)");
				img.setAttribute("ondragover", "allowTerrainDrop(event, this)");*/
				img.style["pointer-events"] = "none";
			}
			if (level == this.map.currentLevel) {
				/*img.setAttribute("draggable", "true");
				img.setAttribute("ondragstart", "dragExistingTerrain(event,this)");*/
				img.classList.add("draggable");
				img.setAttribute("onmousedown", "dragExistingTerrain(event,this)");
			}
		} else {
			this.drawHex(
				x0, 
				y0, 
				width,
				height,
				this.hexSideLength,
				terrainPiece.terrainType.color, 
				"black",
				this.tileGrids[level]);
		}
		
		var hexLevelIndicatorPreference = document.querySelector('input[name="hexLevelIndicatorInput"]:checked').value;
		switch (hexLevelIndicatorPreference) {
			case "none":
				return;
			case "allButLevel1":
				if (level + terrainPiece.terrainType.height == 2) {
					return;
				}
			case "all":
			default:
				// Do Nothing
				break;
		}
		if (terrainPiece.terrainType.height > 1) {
			return;
		}
				
		for (let l = level+1; l < this.map.levels.length; l++) {
			const higherLevel = this.map.levels[l];
			if (higherLevel == null) {
				continue;
			}
			if (higherLevel.hexExists(column, row)) {
				return;
			}
		}
		
		this.drawTerrainLevel(column, row, level, terrainPiece);
		
		if (terrainPiece.terrainSize.size == 2 || terrainPiece.terrainSize.size == 3 || terrainPiece.terrainSize.size == 7) {
			switch (onlineMapTerrainPiece.direction) {
				case 1:
					this.drawTerrainLevel(column, row+1, level, terrainPiece);
					break;
				case 2:
					this.drawTerrainLevel(column-1, column % 2 == 0 ? row+1 : row+0, level, terrainPiece);
					break;
				case 3:
					this.drawTerrainLevel(column-1, column % 2 == 0 ? row-0 : row-1, level, terrainPiece);
					break;
				case 4:
					this.drawTerrainLevel(column, row-1, level, terrainPiece);
					break;
				case 5:
					this.drawTerrainLevel(column+1, column % 2 == 0 ? row-0 : row-1, level, terrainPiece);
					break;
				case 6:
					this.drawTerrainLevel(column+1, column % 2 == 0 ? row+1 : row+0, level, terrainPiece);						
					break;
			}
		}
		if (terrainPiece.terrainSize.size == 3 || terrainPiece.terrainSize.size == 7) {
			switch (onlineMapTerrainPiece.direction) {
				case 1:
					this.drawTerrainLevel(column+1, column % 2 == 0 ? row+1 : row+0, level, terrainPiece);	
					break;
				case 2:
					this.drawTerrainLevel(column, row+1, level, terrainPiece);
					break;
				case 3:
					this.drawTerrainLevel(column-1, column % 2 == 0 ? row+1 : row+0, level, terrainPiece);
					break;
				case 4:
					this.drawTerrainLevel(column-1, column % 2 == 0 ? row-0 : row-1, level, terrainPiece);
					break;
				case 5:
					this.drawTerrainLevel(column, row-1, level, terrainPiece);
					break;
				case 6:
					this.drawTerrainLevel(column+1, column % 2 == 0 ? row-0 : row-1, level, terrainPiece);
					break;
			}
		}
		if (terrainPiece.terrainSize.size == 7) {
			switch (onlineMapTerrainPiece.direction) {
				case 1:
					this.drawTerrainLevel(column+1, column % 2 == 0 ? row : row-1, level, terrainPiece);	
					this.drawTerrainLevel(column+2, row, level, terrainPiece);	
					this.drawTerrainLevel(column+2, row+1, level, terrainPiece);	
					this.drawTerrainLevel(column+1, column % 2 == 0 ? row+2 : row+1, level, terrainPiece);	
					break;
				case 2:
					this.drawTerrainLevel(column+1, column % 2 == 0 ? row+1 : row, level, terrainPiece);	
					this.drawTerrainLevel(column+1, column % 2 == 0 ? row+2 : row+1, level, terrainPiece);	
					this.drawTerrainLevel(column, row+2, level, terrainPiece);	
					this.drawTerrainLevel(column-1, column % 2 == 0 ? row+2 : row+1, level, terrainPiece);	
					break;
				case 3:
					this.drawTerrainLevel(column, row+1, level, terrainPiece);	
					this.drawTerrainLevel(column-1, column % 2 == 0 ? row+2 : row+1, level, terrainPiece);	
					this.drawTerrainLevel(column-2, row+1, level, terrainPiece);	
					this.drawTerrainLevel(column-2, row, level, terrainPiece);
					break;
				case 4:
					this.drawTerrainLevel(column-1, column % 2 == 0 ? row+1 : row, level, terrainPiece);	
					this.drawTerrainLevel(column-2, row, level, terrainPiece);	
					this.drawTerrainLevel(column-2, row-1, level, terrainPiece);	
					this.drawTerrainLevel(column-1, column % 2 == 0 ? row-1 : row-2, level, terrainPiece);
					break;
				case 5:
					this.drawTerrainLevel(column-1, column % 2 == 0 ? row : row-1, level, terrainPiece);	
					this.drawTerrainLevel(column-1, column % 2 == 0 ? row-1 : row-2, level, terrainPiece);	
					this.drawTerrainLevel(column, row-2, level, terrainPiece);	
					this.drawTerrainLevel(column+1, column % 2 == 0 ? row-1 : row-2, level, terrainPiece);
					break;
				case 6:
					this.drawTerrainLevel(column, row-1, level, terrainPiece);	
					this.drawTerrainLevel(column+1, column % 2 == 0 ? row-1 : row-2, level, terrainPiece);	
					this.drawTerrainLevel(column+2, row-1, level, terrainPiece);	
					this.drawTerrainLevel(column+2, row, level, terrainPiece);
					break;
			}
		}
	}
	
	drawTerrainLevel(column, row, level, terrainPiece) {
		const x0 = this.columnOffset*(column-1);
		const y0 = this.hexHeight * ((column-1)%2==0 ? (row-1) : (row-1)+0.5);
		var text = this.drawText(
			x0 + (this.hexWidth / 2) - 7,
			y0 + (this.hexHeight / 2) + 7,
			terrainPiece.terrainType.height + (level-1),
			28,
			this.textColorForTerrainType(terrainPiece),
			this.tileGrids[level]);
		text.style["pointer-events"] = "none";
	}
	
	textColorForTerrainType(terrainPiece) {
		switch (terrainPiece.terrainType.name.toLowerCase()) {
			case "grass":
			case "rock":
			case "water":
				return "white"
			case "sand":
				return "black";
			default:
				return "black";
		}
	}
	
	drawFigure(gameStateFigure) {
		const playerFigure = gameStateFigure.figure;
		const figure = playerFigure.figure;
		const card = figure.card;
		
		const figureHexCount = card.hexCount / card.figureCount;
		
		
		
		console.log(card.name);
		console.log(card.hexCount / card.figureCount);
		console.log(gameStateFigure.facingDirection);
		
		const width = figureHexCount == 1
			? this.figureWidth
			: this.figureWidth * 2; // TODO : need to account for Hive also
		
		// TODO - use gameStateFigure.facingDirection
		// TODO - use card.hexCount / card.figureCount
		
		const x0 = this.columnOffset*gameStateFigure.colNum+5;
		const y0 = this.hexHeight * (gameStateFigure.colNum%2==0 ? gameStateFigure.rowNum : gameStateFigure.rowNum+0.5)+5;
		console.log(figure.imageData);
		this.drawImage(
			x0,
			y0,
			/*this.figureHeight*/null, 
			/*width*/null,
			figure.imageData,
			this.svgFigureGrid,
			gameStateFigure.facingDirection);
	}
	
	drawHex(x0, y0, width, height, sideLength, fillColor, borderColor, parentElem) {
		var hex = document.createElementNS(svgNs, "polygon");
		var points = "";
		points += (x0+width-sideLength) + " " + (y0);
		points += "," + (x0+sideLength) + " " + (y0);
		points += "," + (x0+width) + " " + (y0+(height/2));
		points += "," + (x0+sideLength) + " " + (y0+height);
		points += "," + (x0+width-sideLength) + " " + (y0+height);
		points += "," + (x0) + " " + (y0+(height/2));
		hex.setAttribute("points", points);
		hex.setAttribute("stroke", borderColor);
		hex.setAttribute("fill", fillColor);
		hex.setAttribute("stroke-width", 1);
		parentElem.appendChild(hex);
		
		hex.setAttribute("ondrop", "dropTerrain(event, this)");
		hex.setAttribute("ondragover", "allowTerrainDrop(event, this)");
		return hex;
	}
	
	drawText(x, y, text, textSize, textColor, parentElem, opacity=null) {
		var txt = document.createElementNS(svgNs, "text");
		txt.setAttribute("x", x);
		txt.setAttribute("y", y);
		txt.setAttribute("font-size", textSize);
		txt.setAttribute("font-family", "Calibri");
		//txt.setAttribute("font-weight", "Bold");
		txt.setAttribute("fill", textColor);
		if (opacity != null) {
			txt.setAttribute("opacity", opacity);
		}
		txt.innerHTML = text;
		parentElem.appendChild(txt);
		return txt;
	}
	
	drawImage(x0, y0, height, width, imgSrc, parentElem, direction=null, selected=null, opacity=null, rotationX0=null, rotationY0=null) {
		var img = document.createElementNS(svgNs, "image");
		img.setAttribute("x", x0);
		img.setAttribute("y", y0);
		if (opacity != null) {
			img.setAttribute("opacity", opacity);
		}
		if (height != null) {
			img.setAttribute("height", height);
		}
		if (width != null) {
			img.setAttribute("width",  width);
		}
		if (selected != null && selected) {
			img.classList.add("selectedTile");
		}
		
				
		if (direction != null) {
			
			var rotationDegree = 0;
			switch (direction) {
				case 1:
					rotationDegree = 0;
					break;
				case 2:
					rotationDegree = 60;
					break;
				case 3:
					rotationDegree = 120;
					break;
				case 4:
					rotationDegree =180;
					break;
				case 5:
					rotationDegree = 240;
					break;
				case 6:
					rotationDegree = 300;
					break;
			}
			
			$(img).css("transform", "rotate("+rotationDegree+"deg)");
			
			if (rotationX0 == null) {
				rotationX0 = x0;
			}
			if (rotationY0 == null) {
				rotationY0 = y0;
			}
			$(img).css("transform-origin", (rotationX0+(this.hexWidth/2))+"px " + (rotationY0+(this.hexHeight/2))+"px");
			
		
			
		}

		img.setAttribute("href", imgSrc);
		img.setAttribute("crossOrigin", "anonymous");
		parentElem.appendChild(img);
		
		return img;
	}
	
	getSelectedTile(mouseX, mouseY) {
		var column = Math.floor((mouseX) / this.hexSideLength);
		var row = Math.floor(
			column % 2 == 0
				? Math.floor((mouseY) / this.hexHeight)
				: Math.floor(((mouseY + (this.hexHeight * 0.5)) / this.hexHeight)) - 1);


		//Test if on left side of frame            
		if (mouseX > (column * this.hexSideLength) && mouseX < (column * this.hexSideLength) + this.hexWidth - this.hexSideLength) {


			//Now test which of the two triangles we are in 
			//Top left triangle points
			var p1 = new Object();
			p1.x = column * this.hexSideLength;
			p1.y = column % 2 == 0
				? row * this.hexHeight
				: (row * this.hexHeight) + (this.hexHeight / 2);

			var p2 = new Object();
			p2.x = p1.x;
			p2.y = p1.y + (this.hexHeight / 2);

			var p3 = new Object();
			p3.x = p1.x + this.hexWidth - this.hexSideLength;
			p3.y = p1.y;

			var mousePoint = new Object();
			mousePoint.x = mouseX;
			mousePoint.y = mouseY;

			if (this.isPointInTriangle(mousePoint, p1, p2, p3)) {
				column--;

				if (column % 2 != 0) {
					row--;
				}
			}

			//Bottom left triangle points
			var p4 = new Object();
			p4 = p2;

			var p5 = new Object();
			p5.x = p4.x;
			p5.y = p4.y + (this.hexHeight / 2);

			var p6 = new Object();
			p6.x = p5.x + (this.hexWidth - this.hexSideLength);
			p6.y = p5.y;

			if (this.isPointInTriangle(mousePoint, p4, p5, p6)) {
				column--;

				if (column % 2 == 0) {
					row++;
				}
			}
		}

		return {
			row: row+1, 
			column: column+1
		};
	}
	
	sign(p1, p2, p3) {
		return (p1.x - p3.x) * (p2.y - p3.y) - (p2.x - p3.x) * (p1.y - p3.y);
	}
	
	isPointInTriangle(pt, v1, v2, v3) {
		var b1, b2, b3;

		b1 = this.sign(pt, v1, v2) < 0.0;
		b2 = this.sign(pt, v2, v3) < 0.0;
		b3 = this.sign(pt, v3, v1) < 0.0;

		return ((b1 == b2) && (b2 == b3));
	}
	
	clickEvent(e) {
		var mouseX = e.pageX;
		var mouseY = e.pageY;
		var localX = mouseX - this.svg.getBoundingClientRect().x;
		var localY = mouseY - this.svg.getBoundingClientRect().y;
		var hexLocation = this.getSelectedTile(localX, localY);
				
		if (hexLocation.column >= 1 && hexLocation.row >= 1) {
			if (this.map.levels[this.map.currentLevel].hexExists(hexLocation.column, hexLocation.row)) {
				if ( ! e.ctrlKey) {
					this.map.deSelectAllTerrain();
				}
				var tile = this.map.levels[this.map.currentLevel].getHex(hexLocation.column, hexLocation.row);
				tile.selected = ! tile.selected;
				this.map.reDraw();
			} else {
				this.map.deSelectAllTerrain();
				this.map.reDraw();
			}
			
			
			/*const figure = this.map.getFigure(this.map.currentLevel, hexLocation.column, hexLocation.row);
			if (figure != null) {
				if (this.map.targetableHex(hexLocation.column, hexLocation.row)) {
					const attackingFigure = this.map.getHighlightedFigure();
					
					var numAttackDice = attackingFigure.unit.attack;
					var numDefenseDice = figure.unit.defense;
					
					const attackingHex = this.map.getHex(attackingFigure.col, attackingFigure.row);
					const defendingHex = this.map.getHex(hexLocation.column, hexLocation.row);
					if (attackingHex.height > defendingHex.height) {
						numAttackDice++;
					} else if (attackingHex.height < defendingHex.height) {
						numDefenseDice++;
					}
					
					document.getElementById("AttackDiceInput").value = numAttackDice;
					document.getElementById("DefenseDiceInput").value = numDefenseDice;
				} else {
					this.map.clearAllHighlight();
					this.map.setHighlightedFigure(figure);
					this.markValidMoveHexes(figure.unit.move, hexLocation.column, hexLocation.row, true, true);
					this.markValidTargetHexes(figure.unit.range, hexLocation.column, hexLocation.row, hexLocation.column, hexLocation.row);
				}
			} else {
				//this.map.toggleHexHighlight(hexLocation.column, hexLocation.row); // TODO - re-implement this 
			}
			//this.map.draw(); // TODO - re-implement this */
		} 
	}
	
	/*markValidMoveHexes(moveLeft, col, row, allRoad=false, notYetMoved=false) {
		const currHex = this.map.getHex(col, row);
		allRoad = allRoad && currHex.type == road;
		
		// Conditions Where Figure Cannot Advance Onto Hex
		if ( (! allRoad && moveLeft < 0) || (allRoad && moveLeft < -3)) {
			return;
		}
		if (this.map.getFigure(col, row) != null && ! notYetMoved) {
			return;
		}
		
		this.map.highlightHex(col, row);
		
		// Conditions Where Figure Cannot Advance Beyond Hex
		if ( ( ! allRoad && moveLeft == 0) || (allRoad && moveLeft == -3)) {
			return;
		}
		if (currHex.type == water && ! notYetMoved) {
			return;
		}
		if (this.map.getGlyph(col, row) !== null && ! notYetMoved) {
			return;
		}
		
		// Above 
		if (this.map.hexExists(col, row-1)) {
			const newHex = this.map.getHex(col, row-1);
			this.markValidMoveHexes(moveLeft-1+Math.min(0, currHex.height-newHex.height), col, row-1, allRoad && newHex.type == road);
		}
		
		// Below 
		if (this.map.hexExists(col, row+1)) {
			const newHex = this.map.getHex(col, row+1);
			this.markValidMoveHexes(moveLeft-1+Math.min(0, currHex.height-newHex.height), col, row+1, allRoad && newHex.type == road);
		}
		
		// Above Right 
		const arRow = col%2==0 ? row-1 : row;
		if (this.map.hexExists(col+1, arRow)) {
			const newHex = this.map.getHex(col+1, arRow);
			this.markValidMoveHexes(moveLeft-1+Math.min(0, currHex.height-newHex.height), col+1, arRow, allRoad && newHex.type == road);
		}
		
		// Below Right 
		const brRow = col%2==0 ? row : row+1;
		if (this.map.hexExists(col+1, brRow)) {
			const newHex = this.map.getHex(col+1, brRow);
			this.markValidMoveHexes(moveLeft-1+Math.min(0, currHex.height-newHex.height), col+1, brRow, allRoad && newHex.type == road);
		}
		
		// Above Left
		const alRow = col%2==0 ? row-1 : row;
		if (this.map.hexExists(col-1, alRow)) {
			const newHex = this.map.getHex(col-1, alRow);
			this.markValidMoveHexes(moveLeft-1+Math.min(0, currHex.height-newHex.height), col-1, alRow, allRoad && newHex.type == road);
		}
		
		// Below Left
		const blRow = col%2==0 ? row : row+1;
		if (this.map.hexExists(col-1, blRow)) {
			const newHex = this.map.getHex(col-1, blRow);
			this.markValidMoveHexes(moveLeft-1+Math.min(0, currHex.height-newHex.height), col-1, blRow, allRoad && newHex.type == road);
		}
		
	}	*/

	/*markValidTargetHexes(rangeLeft, startCol, startRow, col, row) {
		const currHex = this.map.getHex(col, row);
				
		// Conditions Where Figure Cannot Target Hex
		if (rangeLeft < 0) {
			return;
		}
		
		const figure = this.map.getFigure(col, row);
		if (figure !== null && (startCol != col || startRow != row)) {
			this.map.markHexTargetable(col, row);
		}
		
		// Conditions Where Figure Cannot Advance Beyond Hex
		if (rangeLeft == 0) {
			return;
		}
		
		// Above 
		if (this.map.hexExists(col, row-1)) {
			const newHex = this.map.getHex(col, row-1);
			this.markValidTargetHexes(rangeLeft-1, startCol, startRow, col, row-1);
		}
		
		// Below 
		if (this.map.hexExists(col, row+1)) {
			const newHex = this.map.getHex(col, row+1);
			this.markValidTargetHexes(rangeLeft-1, startCol, startRow, col, row+1);
		}
		
		// Above Right 
		const arRow = col%2==0 ? row-1 : row;
		if (this.map.hexExists(col+1, arRow)) {
			const newHex = this.map.getHex(col+1, arRow);
			this.markValidTargetHexes(rangeLeft-1, startCol, startRow, col+1, arRow);
		}
		
		// Below Right 
		const brRow = col%2==0 ? row : row+1;
		if (this.map.hexExists(col+1, brRow)) {
			const newHex = this.map.getHex(col+1, brRow);
			this.markValidTargetHexes(rangeLeft-1, startCol, startRow, col+1, brRow);
		}
		
		// Above Left
		const alRow = col%2==0 ? row-1 : row;
		if (this.map.hexExists(col-1, alRow)) {
			const newHex = this.map.getHex(col-1, alRow);
			this.markValidTargetHexes(rangeLeft-1, startCol, startRow, col-1, alRow);
		}
		
		// Below Left
		const blRow = col%2==0 ? row : row+1;
		if (this.map.hexExists(col-1, blRow)) {
			const newHex = this.map.getHex(col-1, blRow);
			this.markValidTargetHexes(rangeLeft-1, startCol, startRow, col-1, blRow);
		}
		
	}*/
	
}



