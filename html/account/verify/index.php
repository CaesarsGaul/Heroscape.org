<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Verify Email</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	

</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>
		<article>
			<h1>Verify Email</h1>
			<?php 
				if (isset($_GET["email"]) && isset($_GET["verificationKey"])) {
					$email = $_GET["email"];
					$verificationKey = $_GET["verificationKey"];
					
					if (User::exists(array("email" => $email))) {
						$user = User::fromDB_email($email);
						if ($user->verificationKey == $verificationKey) {
							$user->verificationKey = null;
							
							// Log User In
							$loginCredentials = LoginCredentials::fromDB_userID($user->id);
							$loginCredentials->createLoginCookie();
							
							$user->updateInDB(); 
							
							echo "
								<p>Your new email address has been verified!</p>
								<p>You will be re-directed to the home page in 5 seconds.</p>
								
								<script>
									window.setTimeout(function() {
										window.location.href = '/';
									}, 5000);
								</script>
							";
							
						} else {
							echo "
								<p>The verification key is incorrect.</p>
							";
						}
					} else {
						echo "
							<p>No account exists for that email adddress.</p>
						";
					}
				} else {
					echo "
						<p>You appear to have reached this page in error. Make sure you followed a valid link sent by Heroscape.org to reach this page.</p>
					";
				}
			?>
		</article>
	</div>

	<?php include(Footer); ?>

</div></body>
</html>