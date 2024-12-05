<?php

require_once("/var/www/Application/Templates/ajaxHead.php");

$output = array();
$output['success'] = false;

if (isset($_POST['email']) && isset($_POST['password']) && 
		isset($_POST['confirmPassword']) && isset($_POST['resetKey'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];
	$resetKey = $_POST['resetKey'];
	
	if ($password == $confirmPassword) {
		$userResults = User::fetch(array("email" => $email));
		if (count($userResults) > 0) {
			$user = $userResults[0];
			
			$passwordResetResults = UserPasswordReset::fetch(array("user" => $user));
			if (count($passwordResetResults) > 0) {
				$passwordResetObj = $passwordResetResults[0];
								
				$loginCredentials = LoginCredentials::fromDB_userID($user->id);
				
				$loginCredentials->updatePassword($password);
				
				$passwordResetObj->deleteInDB();	
				$output['success'] = true;
			} else {
				$output['errorMsg'] = "The private reset key you provided was not valid. Make sure you clicked a valid link sent by Heroscape.org to reach this page.";
			}
		} else {
			$output['errorMsg'] = "No account exists for that email address.";
		}
	} else {
		$output['errorMsg'] = "Your passwords did not match.";
	}
}

// Send Results Back to Client
header('Content-Type: application/json');
echo json_encode($output);

?>