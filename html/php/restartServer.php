<?php

require_once("/var/www/Application/Templates/ajaxHead.php");
		
if (LoginCredentials::userLoggedIn()) {
	$user = LoginCredentials::getLoggedInUser();
	if ($user->siteAdmin) {
		$cmd = "cd /var/www/html/connect" . 
			" \ node secondaryServer.js &> output.log &" .
			" \ disown";
		//$output = shell_exec($cmd);
		$output = shell_exec('sh /var/www/html/connect/restartNodeServer.sh');
		
		$responseToClient = [];
		$responseToClient['output'] = $output;

		header('Content-Type: application/json');
		echo json_encode($responseToClient);
	}
}

?>