<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Login</title>

	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		article {
			text-align: left;
			max-width: 263px;
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
			width: 80px;
			display: inline-block;
		}
		
		.centerText {
			text-align: center;
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
		$failedLogIn = false;

		if (isset($_POST['email']) && isset($_POST['password'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			if (LoginCredentials::validCredentials($email, $password)) {
				$user = User::fromDB_email($email);
				if ($user->verificationKey == null) {
					LoginCredentials::fromDB_userID($user->id)->createLoginCookie();
				} else {
					alertUser("Your account is not yet verified; check your email for a link to verify it (check your spam folder if you don\'t see it).");
					$failedLogIn = true;
				}
			} else {
				$failedLogIn = true;
			}
			
			if ( ! $failedLogIn) {
				if (isset($_POST['redirectToPage'])) {
					phpRedirect(urldecode($_POST['redirectToPage']));
				} else {
					phpRedirect("/");
				} 
			}
		}
	?>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>
		<article>
			<h1>Login</h1>
			
			<form method="POST"> 
				<p>
					<span class='labelSpan'>Email: </span>
					<input type="email" name="email" id='email' required />
				</p>
				<p>
					<span class='labelSpan'>Password: </span>
					<input type="password" name="password" id='passwordInput' required />
				</p>
				
				<?php
					// Set page to re-direct to, if appropriate
					if (isset($_POST['redirectToPage'])) {
						echo "
							<input type='hidden' name='redirectToPage' value='{$_GET['redirectToPage']}' />
						";
					}
				?>
				
				<button id='submitInput'>Login</button>
			</form>
			<p class='centerText'>
				<a href="/account/forgot-password/">
					I forgot my password
				</a>
			</p>
			<p class='centerText'>
				<a href='/account/create'>
					Create new account
				</a>
			</p>
		</article>
		<?php
			// Set email if failed login before
			if ($failedLogIn) {
				$email = str_replace('\'', '\\\'', $_POST['email']);
				echo "
					<script>
						document.getElementById('email').value = '$email';
					</script>
				";
			}
		?>
	</div>

	<?php include(Footer); ?>

</div></body>
</html>