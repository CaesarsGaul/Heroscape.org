<?php

require_once("/var/www/Application/Templates/ajaxHead.php");

$output = array();
$output['success'] = false;

if (isset($_POST['email'])) {
	$email = $_POST['email'];
	$userResults = User::fetch(array("email" => $email));
	if (count($userResults) > 0) {
		$user = $userResults[0];
		
		$resetObj = new stdClass();
		$resetObj->user = $user;
		
		if (UserPasswordReset::exists(array("userID" => $user->id))) {
			UserPasswordReset::fromDB_userID($user->id)->deleteInDB();
		}
		
		$resetPasswordObj = UserPasswordReset::create($resetObj);
		$output['success'] = true;
	} else {
		$output['errorMsg'] = "Sorry, we couldn't find an account associated with that email address. Make sure you entered your email correctly.";
	}
}

// Send Results Back to Client
header('Content-Type: application/json');
echo json_encode($output);

?>