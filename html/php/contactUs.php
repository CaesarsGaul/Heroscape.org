<?php

require_once("/var/www/Application/Templates/ajaxHead.php");

include_once(Libraries . '/Internal/Email/PHP/Email.php');
		
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject'])) {
	
	if (LoginCredentials::userLoggedIn() || 
			(isset($_POST['challengeQuestion']) && $_POST['challengeQuestion'] == 4)) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$userQuestion = nl2br($_POST['subject']);
		$recipients = array("chrisperkins.cp@gmail.com");
		$subject = "Contact Us Query from Heroscape.org";
		$referrerPage = isset($_POST['referrerPage'])
			? "<br>Referrer Page: ".$_POST['referrerPage']
			: "";
		$body = "
			{$userQuestion}
			<br><br><br>
			User's Information:
			<br>
			Name: {$name}
			<br>
			Email Address: {$email}
			{$referrerPage}
		";
		
		// Send Email
		new Email($recipients, $subject, $body);
		
		// Send Results Back to Client
		header('Content-Type: application/json');
		echo json_encode(array());
	} else {
		// Do Nothing
	}
}

?>