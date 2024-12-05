<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Create Account</title>
	
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		article {
			text-align: left;
			max-width: 310px;
			min-width: 100px;
		}
		
		h1 {
			text-align: center;
		}
		
		#submitInput {
			margin: auto;
			text-align: center;
			display: block;
		}
		
		.labelSpan {
			width: 125px;
			display: inline-block;
		}
		
		.charosLabelSpan {
			width: 260px; 
		}
		
		#charosLives {
			width: 30px;
		}
		
		.centerText {
			text-align: center;
		}
		
		.hideMe {
			display: none;
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	
	<script>
		
		
	</script>
	
	<!-- PHP -->
	<?php		
		$failedCreate = false;

		if (isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['password']) && 
				isset($_POST["charosLives"]) && $_POST["charosLives"] == 9 &&
				empty($_POST["ImABot"])) {
			$userObj = new stdClass();
			$userObj->userName = $_POST['userName'];
			$userObj->email = $_POST['email'];
			if (isset($_POST['firstName'])) {
				$userObj->firstName = $_POST['firstName'];
			}
			if (isset($_POST['lastName'])) {
				$userObj->lastName = $_POST['lastName'];
			}
			if (isset($_POST['phoneNumber'])) {
				$userObj->phoneNumber = $_POST['phoneNumber'];
			}
			
			if ( ! User::exists(array("email" => $userObj->email))) {
				if ( ! User::exists(array("userName" => $userObj->userName))) {
					$user = User::create($userObj);
					
					$loginObj = new stdClass();
					$loginObj->user = $user;
					$loginObj->password = $_POST['password'];
					$loginCredentials = LoginCredentials::create($loginObj);
					//$loginCredentials->createLoginCookie(); // DO NOT LOG IN YET, BECAUSE NOT YET VERIFIED
					alertUser("Account Created! You\'ll need to verify your email address next; check your email for a link.");
					
					jsRedirect("/");
				} else {
					alertUser("That username is not available. Please pick another one.");
					$failedCreate = true;
				}
			} else {
				alertUser("An account already exists for that email address.");
				$failedCreate = true;
			}
		} else if (isset($_POST["charosLives"]) && $_POST["charosLives"] != 9) {
			alertUser("Sorry, that isnt the right answer for Charos");
			$failedCreate = true;
		}
	?>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>
		<article>
			<h1>Create Account</h1>
			
			<form method="POST"> 
				<p>
					<span class='labelSpan'>User Name: <span class='requiredField'>*</span></span>
					<input type="text" name="userName" id='userName' required />
				</p>
				<p>
					<span class='labelSpan'>Email: <span class='requiredField'>*</span></span>
					<input type="email" name="email" id='email' required />
				</p>
				<p>
					<span class='labelSpan'>Phone Number: </span>
					<input type="text" name="phoneNumber" id='phoneNumber' />
				</p>
				<p>
					<span class='labelSpan'>First Name: </span>
					<input type="text" name="firstName" id='firstName' />
				</p>
				<p>
					<span class='labelSpan'>Last Name: </span>
					<input type="text" name="lastName" id='lastName' />
				</p>
				<p>
					<span class='labelSpan'>Password: <span class='requiredField'>*</span></span>
					<input type="password" name="password" id='passwordInput' required />
				</p>
				
				<h2>Human Verification</h2>
				
				<p>
					<span class='labelSpan charosLabelSpan'>How many lives does Charos have? <span class='requiredField'>*</span></span>
					<input type='text' name='charosLives' id='charosLives' required />
				</p>
				
				<input class="hideMe" name="ImABot" type="text">
				
				<button id='submitInput'>Create</button>
			</form>
		</article>
		
		<?php
			// Set email if failed login before
			if ($failedCreate) {
				$userName = str_replace('\'', '\\\'', $_POST['userName']);
				$email = str_replace('\'', '\\\'', $_POST['email']);
				$phoneNumber = str_replace('\'', '\\\'', $_POST['phoneNumber']);
				$firstName = str_replace('\'', '\\\'', $_POST['firstName']);
				$lastName = str_replace('\'', '\\\'', $_POST['lastName']);
				$password = str_replace('\'', '\\\'', $_POST['password']);
				$charosLives = str_replace('\'', '\\\'', $_POST['charosLives']);
				
				echo "
					<script>
						document.getElementById('userName').value = '$userName';
						document.getElementById('email').value = '$email';
						document.getElementById('phoneNumber').value = '$phoneNumber';
						document.getElementById('firstName').value = '$firstName';
						document.getElementById('lastName').value = '$lastName';
						document.getElementById('password').value = '$password';
						document.getElementById('charosLives').value = '$charosLives';
					</script>
				";
			}
		?>
	</div>

	<?php include(Footer); ?>

</div></body>
</html>