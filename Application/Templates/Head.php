<?php
// TODO: Remove Before Site Publication
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("/var/www/Application/Templates/HeadConstantsAndFunctions.php");

echo "
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta charset='UTF-8'>
<link id='favicon' rel='shortcut icon' href='/images/favicon.png'/>

<!-- JS -->
	<!-- AJAX -->
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
	<!-- Core Functions -->
	<script src='/js/scripts.js'></script>
	<!-- Libraries -->
	<!-- Database Object -->
	<script src='https://caesarsgaul.com/public-libraries/database-object/DatabaseObject.js'></script>
	<link rel='stylesheet' type='text/css' href='https://caesarsgaul.com/public-libraries/database-object/databaseObject.css'>
	<!-- Dynamic HTML -->
	<script src='https://caesarsgaul.com/public-libraries/dynamic-html/DynamicHTML.js'></script>
	<!-- General Layout -->
	<link rel='stylesheet' type='text/css' href='https://caesarsgaul.com/public-libraries/general-layout/generalLayout.css'>
	<!-- Navigation -->
	<script src='https://caesarsgaul.com/public-libraries/navigation/nav.js'></script>
	<link rel='stylesheet' type='text/css' href='https://caesarsgaul.com/public-libraries/navigation/nav.css'>
	<!-- Documentation -->
	<!--<script src='https://caesarsgaul.com/public-libraries/documentation/documentation.js'></script>
	<link rel='stylesheet' type='text/css' href='https://caesarsgaul.com/public-libraries/documentation/documentation.css'>-->
	
	<script src='/js/model/model.js'></script>
	
<link rel='stylesheet' href='/css/styles.css'>
<link rel='stylesheet' href='/css/dark-mode-implicit.css'>
";
if (isset($_COOKIE["hs_setting_Dark_Mode"])) {
	if ($_COOKIE["hs_setting_Dark_Mode"] == "1") {
		echo "<link rel='stylesheet' href='/css/dark-mode-please.css'>";
	} else if ($_COOKIE["hs_setting_Dark_Mode"] == "0") {
		echo "<link rel='stylesheet' href='/css/light-mode-please.css'>";
	}
}

// Redirect user to log in for some pages
if (! LoginCredentials::userLoggedIn()) { 
	$requestURI = $_SERVER['REQUEST_URI'];
	if (str_contains($requestURI, "/tournament/create/") || 
			str_contains($requestURI, "/tournament/signup/")) {
		$encodedRequestURI = urlencode($requestURI);
		phpRedirect("/account/login/?redirectToPage={$encodedRequestURI}");
		exit;
	}
}
?>