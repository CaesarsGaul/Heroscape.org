<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>

	<title>OHS Link Generator</title>
	
	<!-- CSS -->
	<style>
		#createDiv {
			text-align: center;
		}
	
		#createDiv label {
			display: block;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	
		#waitDiv {
			display: none;
		}
		
		#loadedDiv {
			display: none;
		}
		
		.centerP {
			text-align: center;
		}
	</style>
	
	<!-- JS -->
	<script src="/connect/socket.io/socket.io.js"></script>
	<script>
		function createSocket() {
			socket = io.connect("/", {path: "/connect/socket.io"});
			
			socket.on('ohsGameCreated', function(objStr) {
				var responseObj = JSON.parse(objStr);
				
				document.getElementById('waitDiv').style.display = "none";
				
				var loadedDiv = document.getElementById('loadedDiv');
				loadedDiv.style.display = "block";
				loadedDiv.innerHTML = "Game Link : " + responseObj.gameUrl;
				
				window.open(responseObj.gameUrl, '_blank');
			});
			
			socket.on('ohsGameCreationError', function(objStr) {
				alert("An Error Occurred: " + JSON.parse(objStr).msg);
				
				document.getElementById('waitDiv').style.display = "none";
				
				var loadedDiv = document.getElementById('loadedDiv');
				loadedDiv.style.display = "block";
				loadedDiv.innerHTML = "An Error Occurred: " + JSON.parse(objStr).msg;
			});
		}
		createSocket();
		
		function generateGameLink() {
			//const gameName = document.getElementById('gameNameInput').value;
			const gameName = datetimeToString(new Date());
			
			var mapSelect = document.getElementById('mapSelect');
			var selectedOption = mapSelect.options[mapSelect.selectedIndex];
			if (selectedOption.value.length < 2) {
				alert('You must choose a map');
				return;
			}
			const mapGdocId = selectedOption.value;
			
			socket.emit("createOhsGame", JSON.stringify({
				gameName: gameName,
				mapGdocId: mapGdocId
			}));
			
			document.getElementById('createDiv').style.display = "none";
			document.getElementById('waitDiv').style.display = "block";
		}
		
		function showMap() {
			var mapSelect = document.getElementById('mapSelect');
			var selectedOption = mapSelect.options[mapSelect.selectedIndex];
			var parentElem = document.getElementById("MapImgDiv");
			parentElem.innerHTML = "";
			if (selectedOption.value.length >= 2) {
				parentElem.appendChild(createImg({
					src: $(selectedOption).data("object").imageUrl,
					width: 300
				}));
			}
			
		}
	</script>
</head>
<body><div id='content'>

	<?php include(Nav); ?>

	<div id='pageContent'>
		<h1>OHS Link Generator</h1>
		
		<div id='createDiv'>
		
			<label>
				Map:
				<select id='mapSelect' onchange='showMap()' name='map'>
					<option value=''>-- Choose --</option>
				</select>
			</label>
			
			<div id='MapImgDiv'></div>
			
			<script>
				HeroscapeMap.load(
					{},
					function(maps) {
						const selectedMapId = findGetParameter("HeroscapeMap");
						
						var select = document.getElementById('mapSelect');
						for (let i = 0; i < maps.length; i++) {
							const map = maps[i];
							if (map.ohsGdocId != null) {
								var option = createOption({
									innerHTML: map.name,
									value: map.ohsGdocId
								});
								$(option).data("object", map);
								select.appendChild(option);
								if (selectedMapId != null && selectedMapId == map.id) {
									select.selectedIndex = select.options.length-1;
								}
							}
						}
						
						if (selectedMapId != null) {
							const createMap = findGetParameter("create");
							if (createMap != null && createMap.toLowerCase() == "y") {
								generateGameLink();
							}
						}
					},
					{joins: {}});
			</script>	
			
			<!--<label>
				Matchup Title: 
				<input type='text' id='gameNameInput' name='gameName' />
			<label>-->
			
			<button onclick='generateGameLink()'>Generate New Game Link</button>
		</div>
		
		<div id='waitDiv'>
			Working on it...
		</div>
		
		<div id='loadedDiv'></div>
		
		<div>
			<p class='centerP'>
				<a 
						href='https://drive.google.com/drive/u/0/folders/0B00MqW_GiE1BM3FGeHA2U0VIZk0?ddrp=1&resourcekey=0-BCby39W5ZfToidLd6KMiXg'
						target='_blank'>
					Figures (& Maps)
				</a>
			</p>
		</div>
		
	</div>
	
	<?php include(Footer); ?>
</div></body>
</html>