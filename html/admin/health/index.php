<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Admin | Site Health</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/standings.css">
	<style>
		
	</style>

	<!-- Internal Files -->
	
	<script src="/connect/socket.io/socket.io.js"></script>
		
	<script>
		socket = null;
		isAdmin = false;
		
		function createSocket() {
			socket = io.connect("/", {path: "/connect/socket.io"});
			
			socket.emit("requestNumberOfOpenSockets", 
				JSON.stringify({}), 
				function (err, responseData) {
					if (err) {
						alert("There was an unknown error loading the number of sockets.");
					}
			});
			
			socket.emit("requestAvailableDiskSpace",
				JSON.stringify({}),
				function (err, responseData) {
					if (err) {
						alert("There was an unknown error loading the available disk space.");
					}
			});
						
			socket.on('numberOfOpenSockets', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				var parentDiv = document.getElementById("OpenSocketConnectionsDiv");
				parentDiv.appendChild(createP({
					innerHTML: "# Currently Open Sockets: " + jsonObj.numberOfOpenSockets
				}));
			});
			
			socket.on('availableDiskSpace', function(objStr) {
				var jsonObj = JSON.parse(objStr);
				var parentDiv = document.getElementById("AvailableDiskSpaceDiv");
				console.log(jsonObj);
				parentDiv.appendChild(createP({
					innerHTML: "Available Disk Space: " + jsonObj
				}));
			});
		}
		createSocket();
		
		
		
		function _checkAdmin() {
			if (loggedIn()) {
				const userName = decodeURIComponent(getCookieValue("hs_username"));
				// TODO 
			}
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1>Site Health</h1>
			
			<h2>Stats</h2>
			<div id='OpenSocketConnectionsDiv'></div>
			<div id='AvailableDiskSpaceDiv'></div>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>