<?php
 
require_once("/var/www/Application/Templates/ajaxHead.php");

$responseToClient = [];
$sendNormalResponseToClient = true;
 
$responseToClient['object'] = null;
$responseToClient['message'] = "";
if (isset($_POST['actionType']) && isset($_POST['className']) && isset($_POST['values'])) {
	$actionType = $_POST['actionType'];
	$className = $_POST['className'];
	$values = json_decode($_POST['values']);
	$toArrayParameters = null;
	if (isset($_POST['toArrayParameters'])) {
		$toArrayParameters = json_decode($_POST['toArrayParameters'], true);
	}
	
	$className = str_replace("\\", "", $className);
	$className = str_replace("/", "", $className);
	require_once(Model . "{$className}.php");
	 
	switch ($actionType) {
		 case "fetch":
			$responseToClient = $className::fetchFromClient($values, $toArrayParameters);
			break;
		case "fetchDatalist":
			$responseToClient = $className::fetchDatalistFromClient($values);
			break;
		case "fetchFile":
			if (method_exists($className, "fetchFile")) {
				$fileLocation = $className::fetchFile($values);
				ob_clean();
				ob_end_flush(); 
				header('Content-Type: application/octet-stream');
				header("Content-Transfer-Encoding: Binary"); 
				header("Content-disposition: attachment; filename=\"". basename($fileLocation) ."\""); 
				readfile($fileLocation); 
				$sendNormalResponseToClient = false;
			}	
			break;
		case "create":
			$responseToClient = $className::createFromClient($values, $toArrayParameters);
			break;
		case "update":
			$responseToClient = $className::updateFromClient($values, $toArrayParameters); // that class needs to be the one that checks permissions
			break;
		case "delete":
			$responseToClient = $className::deleteFromClient($values);
			break;
		case "action":
			$responseToClient = $className::performActionFromClient($values, $_POST['action']);
			break;
		case "canAdd":
			$responseToClient = $className::userCanCreate($values->implicitClasses);
			break;
		default:
			$responseToClient['message'] = "The request was malformed. Contact Heroscape.org if you believe this is in error.";
			break;
	}          
} else {
	$responseToClient['message'] = "The request was malformed. Contact Heroscape.org if you believe this is in error.";
}

if ($sendNormalResponseToClient) { 
	header_remove('Set-Cookie');
	header('Content-Type: application/json');
	echo json_encode($responseToClient);
}
 
?>