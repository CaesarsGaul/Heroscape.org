<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Admin Actions</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		

	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/connect/socket.io/socket.io.js"></script>
		
	<script>
		socket = null;
		function createSocket() {
			if (socket != null) {
				return;
			}
			
			socket = io.connect("/", {path: "/connect/socket.io"});
			
			socket.on("nodeServerRestarted", function(objStr) {
				
				alert("Server restarted successfully");
			});
		}
		createSocket();
		socket.emit('checkSiteAdmin', JSON.stringify({}));
		
		/*function _restartServer(refThis, refEvent) {
			// Do not submit form normally, use Ajax instead
			refEvent.preventDefault();
			
			var formElem = $(refThis);
			var formData = formElem.serialize();
			var url = formElem.attr('action');
			
			var successFcn = function(responseData) {
				alert("Server re-started successfully.");	
			};
			var errorFcn = function(err) {				
				alert("There was an unknown error.");
			};		
			
			submitAjaxRequest(url, formData, successFcn, errorFcn);
		}*/
		
		function updatePlayerRankings() {
			socket.emit('updatePlayerRankings', JSON.stringify({}));
		}
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
	
		<article>	
			<h1>Site Admin Actions</h1>
			
			<!--<form method="POST" action="/php/restartServer.php" onsubmit="_restartServer(this, event)">
				<button type='submit'>Restart Server</button>
			</form>-->
			
			<button onclick='updatePlayerRankings()'>Update Player Rankings</button>
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>