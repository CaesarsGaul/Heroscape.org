<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Build New Map</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/dice.css">
	<style>
		#GridDiv, #TilesDiv {
			display: inline-block;
			vertical-align: top;
		}
		
		h2 {
			margin-top: 0;
			margin-bottom: 10px;
		}
		
		#TilesDiv {
			width: 200px;
			height: calc(100vh - 125px);
			overflow: auto;
		}
		
		#GridDiv {
			max-width: calc(100% - 210px);
			max-height: calc(100vh - 125px);
			overflow: auto;
		}
		
		.availableTerrainPiece {
			border: 1px solid white;
		}
		
		.availableTerrainPieceImage {
			
		}
		.availableTerrainPieceImage img {
			/*transform: scale(0.25)*/
		}
		
		.availableTerrainPieceLabel {
			
		}
		
		.availableTerrainPieceLabel span:not(:last-child) {
			margin-right: 10px;
		}
		
		#TopRowOptions {
			margin-bottom: 10px;
		}
		
		.topRowOption {
			display: inline-block;
			margin-left: 25px;
			margin-right: 25px;
			vertical-align: top;
		}
		
		.levelImg {
			width: 20px;
			vertical-align: middle;
		}
		
		#LevelIndicator {
			display: inline-block;
			vertical-align: top;
			height: 100%;
		}
		
		#DeleteTileButton {
			vertical-align: top;
		}
		.rotateArrowButton {
			padding-top: 0;
			padding-bottom: 0;
			padding-left: 10px;
			padding-right: 10px;
		}
		.rotateArrow {
			height: 25px;
		}
		
		#LoadMapDiv {
			display: none;
			position: absolute;
			top: 95px;
			left: 0;
			right: 0;
			/*max-width: 300px;
			min-width: 200px;*/
			background-color: tan;
			padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 20px;
			padding-right: 20px;
		}
		
		#LoadMapDivX {
			color: red;
			border: 1px solid black;
			width: 20px;
			float: right;
			margin-right: 5px;
			margin-top: 5px;
		}
		
		.selectedTile {
			outline: 1px solid red;
		}
		
		#HighlightTerrainTopRowOption {
			visibility: hidden;
		}
		
		#hiddenPdfDownloadA {
			display: none;
		}
		
		.draggable {
			cursor: move;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/hexagon.js"></script>
	<script src="/js/pdfkit/pdfkit.standalone.js"></script>
	<script src="/js/pdfkit/blob-stream.js"></script>
	<!--<script src="/connect/socket.io/socket.io.js"></script>-->
	<script>
		var map = null;
		function displayEmptyHexGrid() {
			map = new OnlineMapBuilder();
		}
		
		function displayAvailableTerrainPieces(terrainPieces) {
			var parentElem = document.getElementById("TilesDiv");
			
			for (let i = 0; i < terrainPieces.length; i++) {
				const terrainPiece = terrainPieces[i];
				
				var pieceDiv = createDiv({
					class: "availableTerrainPiece"
				});
				parentElem.appendChild(pieceDiv);
				
				var pieceImageDiv = createDiv({
					class: "availableTerrainPieceImage"
				});
				pieceDiv.appendChild(pieceImageDiv);
				if (terrainPiece.image != null) {
					var imgElem = createImage({
						id: "TerrainPieceImage_"+terrainPiece.id,
						src: terrainPiece.image,
						draggable: "true",
						ondragstart: "dragTerrain(event,this)"
					});
					pieceImageDiv.appendChild(imgElem);
					scaleImgHeight(imgElem);
				} else {
					
				}
				
				var pieceLabelDiv = createDiv({
					class: "availableTerrainPieceLabel"
				});
				pieceDiv.appendChild(pieceLabelDiv);
				pieceLabelDiv.appendChild(createSpan({
					class: "availableTerrainPieceLabelType",
					innerHTML: terrainPiece.terrainType.name
				}));
				pieceLabelDiv.appendChild(createSpan({
					class: "availableTerrainPieceLabelHex",
					innerHTML: terrainPiece.terrainSize.size
				}));
				pieceLabelDiv.appendChild(createSpan({
					class: "availableTerrainPieceLabelAvailable",
					innerHTML: "0/-"
				}));
			}
		}
		
		const terrainImgScaleFactor = 0.25;
		function scaleImgHeight(elem) {
			var img = new Image();
			img.onload = function() {
				var height = img.height;
				var width = img.width;
				elem.style.height = (height * terrainImgScaleFactor) + "px";
				elem.style.width = (width * terrainImgScaleFactor) + "px";
			}
			img.src = elem.src;
		}
		
		function dragTerrain(refEvent, refThis) {
			refEvent.dataTransfer.setData("text", refThis.id.split("_")[1]);
		}
		
		var _draggedImage = null;
		function dragExistingTerrain(refEvent, refThis) {
			/*const anchorColumn = refThis.getAttribute("anchorColumn");
			const anchorRow = refThis.getAttribute("anchorRow");*/
			_draggedImage = refThis;
			
			//refEvent.dataTransfer.setData("text", "OnlineMapTerrainPiece_"+refThis.anchorColumn + "_" + refThis.anchorRow);
		}
		function dropExistingTerrain(refThis) {
			if (_draggedImage != null) {
				const fromColumn = _draggedImage.getAttribute("anchorColumn");
				const fromRow = _draggedImage.getAttribute("anchorRow");
				const toColumn = refThis.getAttribute("colNum");
				const toRow = refThis.getAttribute("rowNum");
				
				map.moveTerrainPiece(fromColumn, fromRow, toColumn, toRow);
				
				_draggedImage = null;
			}
		}
		
		function dropTerrain(refEvent, refThis) {
			refEvent.preventDefault();
			
			const gridHex = refEvent.target;
			var gridRowNum = gridHex.getAttribute("rowNum");
			var gridColNum = gridHex.getAttribute("colNum");
			
			const transferData = refEvent.dataTransfer.getData("text");
			
			var terrainPieceId = transferData;
			var terrainPiece = null;
			for (let i = 0; i < TerrainPiece.list.length; i++) {
				if (TerrainPiece.list[i].id == terrainPieceId) {
					terrainPiece = TerrainPiece.list[i];
					break;
				}
			}
					
			map.addTerrainPiece(terrainPiece, gridColNum, gridRowNum);	
		}
		
		function allowTerrainDrop(refEvent, refThis) {
			refEvent.preventDefault()
		}
		
		function levelUp() {
			map.levelUp();
			_updateLevelLabel();
		}
		
		function levelDown() {
			if (map.currentLevel == 1) {
				return; 
			}
			map.levelDown();
			_updateLevelLabel();
		}
		
		function _updateLevelLabel() {
			document.getElementById("LevelIndicator").innerHTML = "Level " + map.currentLevel;
		}
		
		function saveMap() {
			map.save();
		}
		
		function loadMaps() {
			document.getElementById('LoadMapDiv').style.display = "block";
		}
		
		function downloadPDF() {
			const doc = new PDFDocument();
			const stream = doc.pipe(blobStream());
			
			_makePdfPage1(doc);
			_makePdfPage2(doc);

			// get a blob when you're done
			doc.end();
			
			let blob;
			var a = document.getElementById("hiddenPdfDownloadA");
			stream.on("finish", function() {
			  // get a blob you can do whatever you like with
			  blob = stream.toBlob("application/pdf");

			  if (!blob) return;
				  var url = window.URL.createObjectURL(blob);
				  a.href = url;
				  a.download = 'test.pdf';
				  a.click();
				  window.URL.revokeObjectURL(url);
			});
		}
		
		function _makePdfPage1(doc) {
			_makePdfMapName(doc);
			_makePdfAuthorName(doc);
			_makePdfMapImage(doc);
		}
		
		function _makePdfMapName(doc) {
			doc
				.fontSize(30)
				.text(map.onlineMap.name == null ? "[Untitled]" : map.onlineMap.name , {align: 'center'});
		}
		
		const _pdfMapImageStartX = 100;
		const _pdfMapImageStartY = 100;
		const _pdfMapImageScaleFactor = 2;
		
		function _makePdfMapImage(doc) {
			doc.fontSize(12);
			for (let l = 1; l < map.levels.length; l++) {
				const level = map.levels[l];
				if (level === undefined || level === null) {
					continue;
				}
				for (let x = 1; x < level.terrain.length; x++) {
					if (level.terrain[x] === undefined) {
						continue;
					}			
					for (let y = 1; y < level.terrain[x].length; y++) {
						if (level.terrain[x][y] === undefined) {
							continue;
						}
						const onlineMapTerrainPiece = level.terrain[x][y];
						const terrainPiece = onlineMapTerrainPiece.terrainPiece;						
						
						// Draw Tile - Step 1 : Rotate Document 
						var rotationAngle = 0;
						switch (onlineMapTerrainPiece.direction) {
							case 1:
								rotationAngle = 0;
								break;
							case 2:
								rotationAngle = 60;
								break;
							case 3:
								rotationAngle = 120;
								break;
							case 4:
								rotationAngle = 180;
								break;
							case 5:
								rotationAngle = 240;
								break;
							case 6:
								rotationAngle = 300;
								break;
						}
						doc.rotate(rotationAngle, {origin: [_getPdfImageXloc(x)+(map.grid.hexWidth / 2 / _pdfMapImageScaleFactor), _getPdfImageYloc(x,y+0.5)]}); 
						
						// Draw Tile - Step 2 : Scale Image Height
						var imageHeight = map.grid.hexHeight / _pdfMapImageScaleFactor;
						switch (terrainPiece.terrainSize.size) {
							case 1:
								// No Change
								break;
							case 2:
								imageHeight *= 2;
								break; 
							case 3:
								imageHeight *= 2;
								break;
							case 7:
								imageHeight *= 3;
								break;
							case 24:
								imageHeight *= 6;
								break;
						}
						
						// Draw Tile - Step 3 : Add Image to PDF
						var imgX = x;
						var imgY = terrainPiece.terrainSize.size == 7
							? y - 0.5
							: y;
						doc.image(terrainPiece.imageData, _getPdfImageXloc(imgX), _getPdfImageYloc(imgX,imgY), 
							{height: imageHeight});
						
						// Draw Tile - Step 4 : Re-Set Document Rotation 
						doc.rotate(360-rotationAngle, {origin: [_getPdfImageXloc(x)+(map.grid.hexWidth / 2 / _pdfMapImageScaleFactor), _getPdfImageYloc(x,y+0.5)]});
						
						// Draw Tile - Step 5 : Label Hexes with Height Numbers 
						var hexLevelIndicatorPreference = document.querySelector('input[name="hexLevelIndicatorInput"]:checked').value;
						switch (hexLevelIndicatorPreference) {
							case "none":
								continue;
							case "allButLevel1":
								if (l + terrainPiece.terrainType.height == 2) {
									continue;
								}
							case "all":
							default:
								// Do Nothing
								break;
						}
						if (terrainPiece.terrainType.height > 1) {
							continue;
						}
						_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x), _getPdfImageYloc(x,y));
						
						if (terrainPiece.terrainSize.size == 2 || terrainPiece.terrainSize.size == 3 || terrainPiece.terrainSize.size == 7) {
							switch (onlineMapTerrainPiece.direction) {
								case 1:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x), _getPdfImageYloc(x, y+1));
									break;
								case 2:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-1), _getPdfImageYloc(x-1, x%2==0 ? y+1 : y));
									break;
								case 3:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-1), _getPdfImageYloc(x-1, x%2==0 ? y : y-1));
									break;
								case 4:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x), _getPdfImageYloc(x, y-1));
									break;
								case 5:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+1), _getPdfImageYloc(x+1, x%2==0 ? y : y-1));
									break;
								case 6:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+1), _getPdfImageYloc(x+1, x%2==0 ? y+1 : y));
									break;
							}
						}
						if (terrainPiece.terrainSize.size == 3 || terrainPiece.terrainSize.size == 7) {
							switch (onlineMapTerrainPiece.direction) {
								case 1:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+1), _getPdfImageYloc(x+1, x%2==0 ? y+1 : y));
									break;
								case 2:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x), _getPdfImageYloc(x, y+1));
									break;
								case 3:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-1), _getPdfImageYloc(x-1, x%2==0 ? y+1 : y));
									break;
								case 4:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-1), _getPdfImageYloc(x-1, x%2==0 ? y : y-1));
									break;
								case 5:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x), _getPdfImageYloc(x, y-1));
									break;
								case 6:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+1), _getPdfImageYloc(x+1, x%2==0 ? y : y-1));
									break;
							}
						}
						if (terrainPiece.terrainSize.size == 7) {
							switch (onlineMapTerrainPiece.direction) {
								case 1:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+1), _getPdfImageYloc(x+1, x%2==0 ? y : y-1));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+2), _getPdfImageYloc(x+2, y));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+2), _getPdfImageYloc(x+2, y+1));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+1), _getPdfImageYloc(x+1, x%2==0 ? y+2 : y+1));
									break;
								case 2:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+1), _getPdfImageYloc(x+1, x%2==0 ? y+1 : y));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+1), _getPdfImageYloc(x+1, x%2==0 ? y+2 : y+1));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x), _getPdfImageYloc(x, y+2));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-1), _getPdfImageYloc(x-1, x%2==0 ? y+2 : y+1));
									break;
								case 3:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x), _getPdfImageYloc(x, y+1));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-1), _getPdfImageYloc(x-1, x%2==0 ? y+2 : y+1));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-2), _getPdfImageYloc(x-2, y+1));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-2), _getPdfImageYloc(x-2, y));
									break;
								case 4:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-1), _getPdfImageYloc(x-1, x%2==0 ? y+1 : y));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-2), _getPdfImageYloc(x-2, y));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-2), _getPdfImageYloc(x-2, y-1));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-1), _getPdfImageYloc(x-1, x%2==0 ? y-1 : y-2));
									break;
								case 5:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-1), _getPdfImageYloc(x-1, x%2==0 ? y : y-1));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x-1), _getPdfImageYloc(x-1, x%2==0 ? y-1 : y-2));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x), _getPdfImageYloc(x, y-2));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+1), _getPdfImageYloc(x+1, x%2==0 ? y-1 : y-2));
									break;
								case 6:
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x), _getPdfImageYloc(x, y-1));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+1), _getPdfImageYloc(x+1, x%2==0 ? y-1 : y-2));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+2), _getPdfImageYloc(x+2, y-1));
									_writeHexHeight(doc, terrainPiece, l, _getPdfImageXloc(x+2), _getPdfImageYloc(x+2, y));
									break;
							}							
						}
					}
				}				
			}			
		}
		
		function _getPdfImageXloc(x) {
			return _pdfMapImageStartX + (x - 1) * (map.grid.columnOffset / _pdfMapImageScaleFactor);
		}
		
		function _getPdfImageYloc(x,y) {
			var yLoc = _pdfMapImageStartY + (y) * (map.grid.hexHeight / _pdfMapImageScaleFactor);
			if ((x-1) % 2 == 1) { // Col 2, 4, 6, etc.
				yLoc += ((map.grid.hexHeight / _pdfMapImageScaleFactor) / 2);
			}
			return yLoc;
		}
		
		function _writeHexHeight(doc, terrainPiece, level, xLoc, yLoc) {
			doc
				.fillColor(map.grid.textColorForTerrainType(terrainPiece))
				.text(terrainPiece.terrainType.height + (level-1), xLoc+9, yLoc+6);
		}
		
		function _makePdfAuthorName(doc) {
			doc
				.moveDown(17)
				.fontSize(20)
				.text("Author : [Author Name]", {align: 'center'});
		}
		
		function _makePdfPage2(doc) {
			doc.fillColor("black");
			
			const levelScaleFactor = 4.3;
			points = [
				[12.5, 43.30127018922193],
				[37.5, 43.30127018922193],
				[50, 64.9519052838329],
				[37.5, 86.60254037844386],
				[12.5, 86.60254037844386],
				[0, 64.9519052838329]
			];
			for (let i = 0; i < points.length; i++) {
				for (let j = 0; j < points[i].length; j++) {
					points[i][j] = points[i][j] / levelScaleFactor;
				}
			}
			for (let l = 1; l < map.levels.length; l++) {
				const level = map.levels[l];
				if (l % 6 == 1) {
					doc.addPage();
				}
				var startX = 50;
				if (l % 6 > 3 || l % 6 == 0) {
					startX += 250;
				}
				var startY = 50;
				if (l % 6 == 2 || l % 6 == 5) {
					startY += 250;
				} else if (l % 6 == 3 || l % 6 == 0) {
					startY += 250 * 2;
				}
				doc
					.fontSize(12)
					.text("Level : " + l, startX, startY);
				
				// 20x20 Grid 
				for (let x = 0; x < 20; x++) { 
					for (let y = 0; y < 20; y++) {
						var tPoints = JSON.parse(JSON.stringify(points)); // Deep Copy
						for (let i = 0; i < tPoints.length; i++) {
							if (x % 2 == 1) { // Col 2, 4, 6, etc.
								tPoints[i][1] -= ((map.grid.hexHeight / levelScaleFactor) / 2);
							} else { // Col 1, 3, 5, etc.
								// Do Nothing - No Adjustment
							}
							tPoints[i][0] += startX + (map.grid.columnOffset / levelScaleFactor) * x;
							tPoints[i][1] += (startY+(map.grid.hexHeight / levelScaleFactor)) + (map.grid.hexHeight / levelScaleFactor) * y;
						}
						doc
							.polygon(...tPoints)
							.strokeColor("#b8bab9")
							.stroke();
					}
				}
				
				for (let l2 = 1; l2 <= l; l2++) {
					const level2 = map.levels[l2];
					if (level2 === undefined || level2 === null) {
						continue;
					}
					for (let x = 0; x < level2.terrain.length; x++) {
						if (level2.terrain[x] === undefined) {
							continue;
						}			
						for (let y = 0; y < level2.terrain[x].length; y++) {
							if (level2.terrain[x][y] === undefined) {
								continue;
							}
							const onlineMapTerrainPiece = level2.terrain[x][y];
							const terrainPiece = onlineMapTerrainPiece.terrainPiece;
							
							var tPoints = _makeTPoints(points, x, y, startX, startY, levelScaleFactor);
							switch (terrainPiece.terrainSize.size) {
								case 1:
									// No Change
									break;
								case 2:
									var addIndex = (onlineMapTerrainPiece.direction+3) % 6;
									var tPoints2StartIdx = (onlineMapTerrainPiece.direction + 1) % 6;
									var tPoints2 = null;
									switch (onlineMapTerrainPiece.direction) {
										case 1:
											tPoints2 = _makeTPoints(points, x, y+1, startX, startY, levelScaleFactor);
											break;
										case 2:
											tPoints2 = _makeTPoints(points, x-1, x%2==0 ? y+1 : y, startX, startY, levelScaleFactor);
											break;
										case 3:
											tPoints2 = _makeTPoints(points, x-1,  x%2==0 ? y : y-1, startX, startY, levelScaleFactor);
											break;
										case 4:
											tPoints2 = _makeTPoints(points, x, y-1, startX, startY, levelScaleFactor);
											break;
										case 5: 
											tPoints2 = _makeTPoints(points, x+1, x%2==0 ? y : y-1, startX, startY, levelScaleFactor);
											break;
										case 6:
											tPoints2 = _makeTPoints(points, x+1,  x%2==0 ? y+1 : y, startX, startY, levelScaleFactor);
											break;
									}
									for (let i = 0; i < 4; i++) {
										tPoints.splice(addIndex++, 0, tPoints2[(tPoints2StartIdx + i) % 6]);
									}
									break;
								case 3:
									var addIndex = (onlineMapTerrainPiece.direction+2) % 6;
									var tPoints2StartIdx = (onlineMapTerrainPiece.direction) % 6;
									var tPoints3StartIdx = (onlineMapTerrainPiece.direction + 2) % 6;
									var tPoints2 = null;
									var tPoints3 = null;
									switch (onlineMapTerrainPiece.direction) {
										case 1:
											tPoints2 = _makeTPoints(points, x+1, x%2==0 ? y+1 : y, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x, y+1, startX, startY, levelScaleFactor);
											break;
										case 2:
											tPoints2 = _makeTPoints(points, x, y+1, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x-1, x%2==0 ? y+1 : y, startX, startY, levelScaleFactor);
											break;
										case 3:
											tPoints2 = _makeTPoints(points, x-1, x%2==0 ? y+1 : y, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x-1,  x%2==0 ? y : y-1, startX, startY, levelScaleFactor);
											break;
										case 4:
											tPoints2 = _makeTPoints(points, x-1,  x%2==0 ? y : y-1, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x, y-1, startX, startY, levelScaleFactor);
											break;
										case 5:
											tPoints2 = _makeTPoints(points, x, y-1, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x+1, x%2==0 ? y : y-1, startX, startY, levelScaleFactor);
											break;
										case 6:
											tPoints2 = _makeTPoints(points, x+1, x%2==0 ? y : y-1, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x+1,  x%2==0 ? y+1 : y, startX, startY, levelScaleFactor);
											break;										
									}
									tPoints.splice(addIndex, 1);
									for (let i = 0; i < 4; i++) {
										tPoints.splice(addIndex++, 0, tPoints2[(tPoints2StartIdx + i) % 6]);
									}					
									for (let i = 0; i < 3; i++) {
										tPoints.splice(addIndex++, 0, tPoints3[(tPoints3StartIdx + i) % 6]);
									}
									break;
								case 7:
									var addIndex = (onlineMapTerrainPiece.direction+1) % 6;
									var tPoints2StartIdx = (onlineMapTerrainPiece.direction-1)%6;
									var tPoints3StartIdx = (onlineMapTerrainPiece.direction)%6;
									var tPoints4StartIdx = (onlineMapTerrainPiece.direction+1)%6;
									var tPoints5StartIdx = (onlineMapTerrainPiece.direction+2)%6;
									var tPoints6StartIdx = (onlineMapTerrainPiece.direction+3)%6;
									var tPoints2 = null;
									var tPoints3 = null;
									var tPoints4 = null;
									var tPoints5 = null;
									var tPoints6 = null;
									switch (onlineMapTerrainPiece.direction) {
										case 1:
											tPoints2 = _makeTPoints(points, x+1, x%2==0 ? y : y-1, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x+2, y, startX, startY, levelScaleFactor);
											tPoints4 = _makeTPoints(points, x+2, y+1, startX, startY, levelScaleFactor);
											tPoints5 = _makeTPoints(points, x+1, x%2==0 ? y+2 : y+1, startX, startY, levelScaleFactor);
											tPoints6 = _makeTPoints(points, x, y+1, startX, startY, levelScaleFactor);
											break;
										case 2:
											tPoints2 = _makeTPoints(points, x+1, x%2==0 ? y+1 : y, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x+1, x%2==0 ? y+2 : y+1, startX, startY, levelScaleFactor);
											tPoints4 = _makeTPoints(points, x, y+2, startX, startY, levelScaleFactor);
											tPoints5 = _makeTPoints(points, x-1, x%2==0 ? y+2 : y+1, startX, startY, levelScaleFactor);
											tPoints6 = _makeTPoints(points, x-1, x%2==0 ? y+1 : y, startX, startY, levelScaleFactor);
											break;
										case 3:
											tPoints2 = _makeTPoints(points, x, y+1, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x-1, x%2==0 ? y+2 : y+1, startX, startY, levelScaleFactor);
											tPoints4 = _makeTPoints(points, x-2, y+1, startX, startY, levelScaleFactor);
											tPoints5 = _makeTPoints(points, x-2, y, startX, startY, levelScaleFactor);
											tPoints6 = _makeTPoints(points, x-1, x%2==0 ? y : y-1, startX, startY, levelScaleFactor);
											break;
										case 4:
											tPoints2 = _makeTPoints(points, x-1, x%2==0 ? y+1 : y, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x-2, y, startX, startY, levelScaleFactor);
											tPoints4 = _makeTPoints(points, x-2, y-1, startX, startY, levelScaleFactor);
											tPoints5 = _makeTPoints(points, x-1, x%2==0 ? y-1 : y-2, startX, startY, levelScaleFactor);
											tPoints6 = _makeTPoints(points, x, y-1, startX, startY, levelScaleFactor);
											break;
										case 5:
											tPoints2 = _makeTPoints(points, x-1, x%2==0 ? y : y-1, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x-1, x%2==0 ? y-1 : y-2, startX, startY, levelScaleFactor);
											tPoints4 = _makeTPoints(points, x, y-2, startX, startY, levelScaleFactor);
											tPoints5 = _makeTPoints(points, x+1, x%2==0 ? y-1 : y-2, startX, startY, levelScaleFactor);
											tPoints6 = _makeTPoints(points, x+1, x%2==0 ? y : y-1, startX, startY, levelScaleFactor);
											break;
										case 6:
											tPoints2 = _makeTPoints(points, x, y-1, startX, startY, levelScaleFactor);
											tPoints3 = _makeTPoints(points, x+1, x%2==0 ? y-1 : y-2, startX, startY, levelScaleFactor);
											tPoints4 = _makeTPoints(points, x+2, y-1, startX, startY, levelScaleFactor);
											tPoints5 = _makeTPoints(points, x+2, y, startX, startY, levelScaleFactor);
											tPoints6 = _makeTPoints(points, x+1, x%2==0 ? y+1 : y, startX, startY, levelScaleFactor);
											break;
									}
									tPoints.splice(addIndex, 2);
									for (let i = 0; i < 3; i++) {
										tPoints.splice(addIndex++, 0, tPoints2[(tPoints2StartIdx + i) % 6]);
									}
									for (let i = 0; i < 3; i++) {
										tPoints.splice(addIndex++, 0, tPoints3[(tPoints3StartIdx + i) % 6]);
									}
									for (let i = 0; i < 3; i++) {
										tPoints.splice(addIndex++, 0, tPoints4[(tPoints4StartIdx + i) % 6]);
									}
									for (let i = 0; i < 3; i++) {
										tPoints.splice(addIndex++, 0, tPoints5[(tPoints5StartIdx + i) % 6]);
									}
									for (let i = 0; i < 2; i++) {
										tPoints.splice(addIndex++, 0, tPoints6[(tPoints6StartIdx + i) % 6]);
									}									
									break;
							}
							
							doc.polygon(...tPoints)
								.opacity((l == l2) ? 1.0 : 0.3)
								.fillAndStroke(terrainPiece.terrainType.color, "black");
							doc // Re-set colors 
								.opacity(1)
								.strokeColor("black")
								.fillColor("black");
							
							/*var xLoc = startX + (x - 1) * (map.grid.columnOffset / levelScaleFactor);
							var yLoc = startY + (y) * (map.grid.hexHeight / levelScaleFactor);
							if ((x-1) % 2 == 1) { // Col 2, 4, 6, etc.
								yLoc += ((map.grid.hexHeight / levelScaleFactor) / 2);
							} 
							doc.image(terrainPiece.imageData, xLoc, yLoc, 
								{height: (map.grid.hexHeight / levelScaleFactor), // TODO - need to adjust based on the tile size & orientation 	
								opacity: (l == l2) ? 1.0 : 0.5});*/
						}
					}	
				}				
			}
		}
		
		function _makeTPoints(points, x, y, startX, startY, levelScaleFactor) {
			var tPoints = JSON.parse(JSON.stringify(points)); // Deep Copy
			for (let i = 0; i < tPoints.length; i++) {
				if ((x-1) % 2 == 1) { // Col 2, 4, 6, etc.
					tPoints[i][1] += ((map.grid.hexHeight / levelScaleFactor) / 2);
				} else { // Col 1, 3, 5, etc.
					// Do Nothing - No Adjustment
				}
				tPoints[i][0] += startX + (map.grid.columnOffset / levelScaleFactor) * (x-1);
				tPoints[i][1] += (startY) + (map.grid.hexHeight / levelScaleFactor) * (y-1);
			}
			return tPoints;
		}
		
		function closeLoadMaps() {
			document.getElementById('LoadMapDiv').style.display = "none";
		}
		
		function loadMap(mapId) {
			OnlineMap.load(
				{id: mapId},
				function (maps) {
					if (maps.length != 1) {
						return; // Error 
					}
					
					// TODO - verify with user if they want to save progress first 
					map.clear();
					map = new OnlineMapBuilder(maps[0]);		
					document.getElementById("LevelIndicator").innerHTML = "Level 1";
					closeLoadMaps();
				},
				{joins: {
					"OnlineMapTerrainPiece.onlineMapID": {
						"terrainPieceID": {}
					}/*,
					"authorID": {}*/ // This caused a load error...why?
				}}
			); 
		}
		
		function onPageClick(e) {
			map.grid.clickEvent(e);
		}
		
		function deleteTiles() {
			map.deleteSelectedTiles();
		}
		
		function rotateLeft() {
			map.rotateSelectedTilesLeft();
		}
		
		function rotateRight() {
			map.rotateSelectedTilesRight();
		}
		
		function reDrawMap() {
			map.reDraw();
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(MapNav); ?>
	
	<div id='pageContent'>		
	
		<article>	
			<h1>Build New Map</h1>
			
			<div id='TopRowOptions'>
				<div class='topRowOption'>
					<input id='MapNameInput' type='text' placeholder='Map Name...' required />
					<button type='button' onclick='saveMap()'>Save</button>
				</div>
				<div class='topRowOption'>
					<button type='button' onclick='loadMaps()'>Load</button>
				</div>
				<div class='topRowOption'>
					<button type='button' onclick='downloadPDF()'>PDF</button>
					<a id='hiddenPdfDownloadA'>PDF Download</a>
				</div>
				<div class='topRowOption' id='HighlightTerrainTopRowOption'>
					<button type='button' id='DeleteTileButton' onclick='deleteTiles()'>Delete</button>
					<button type='button' class='rotateArrowButton' onclick='rotateLeft()'><img class='rotateArrow' src='/images/leftArrowRotate.png' /></button>
					<button type='button' class='rotateArrowButton' onclick='rotateRight()'><img class='rotateArrow' src='/images/rightArrowRotate.png' /></button>
				</div>
				<div class='topRowOption'>
					<img src='/images/minusSign.png' class='levelImg' onclick='levelDown()' />
					<span id='LevelIndicator'>Level 1</span>
					<img src='/images/plusSign.png' class='levelImg' onclick='levelUp()' />
				</div>
			</div>
			
			<div id='SecondRowOptions'>
				<span>Hex Level Indicators:</span>
				<label class='hexLevelIndicatorLabel'>
					<input type='radio' name='hexLevelIndicatorInput' onchange='reDrawMap()' value='all' />
					All
				</label>
				<label class='hexLevelIndicatorLabel'>
					<input type='radio' name='hexLevelIndicatorInput' onchange='reDrawMap()' value='none' />
					None
				</label>
				<label class='hexLevelIndicatorLabel'>
					<input type='radio' name='hexLevelIndicatorInput' onchange='reDrawMap()' value='allButLevel1' checked />
					All But Level 1
				</label>
			</div>
			
			<div id='TilesDiv'>
				<h2>Available Tiles</h2>
			</div>
			
			<div id='GridDiv'>
				<svg id='SvgHexGrid' width='1500' height='1500' onclick="onPageClick(event)">
					<g id='SvgEmptyGrid'></g>
				</svg>
			</div>
			
			<script>
				displayEmptyHexGrid();
			</script>
			
			<div id='LoadMapDiv'>
				<div id='LoadMapDivX' onclick='closeLoadMaps()'>X</div>
			
			</div>
			
		</article>
		
		<script>
			TerrainPiece.load(
				{},
				function (terrainPieces) {
					displayAvailableTerrainPieces(terrainPieces);
				},
				{joins: {
					"terrainTypeID": {},
					"terrainSizeID": {},
					"HeroscapeSetTerrainPieceQuantity.terrainPieceID": {
						"heroscapeSetID": {}
					}
				}}
			);
			
			OnlineMap.load(
				{currentUser: true},
				function (maps) {
					var parentElem = document.getElementById("LoadMapDiv");
					for (let i = 0; i < maps.length; i++) {
						const map = maps[i];
						var mapDiv = createDiv({
							class: 'loadMapDiv',
							onclick: 'loadMap('+map.id+')'});
						parentElem.appendChild(mapDiv);
						mapDiv.appendChild(createText(map.name));
					}
				},
				{joins: {
					/*"authorID": {}*/ // This caused a load error...why?
				}}
			);
		</script>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>