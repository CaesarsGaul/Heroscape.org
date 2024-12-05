<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Reset Password | Heroscape.org</title>
	
	<style>
		label {
			display: block;
			text-align: left;
			margin: 10px;
		}
	</style>
	
	<!-- JavaScript -->
	<script>
		hidePageUntilLoaded = false;
		allLoadingRequestsSent = true;
		
		function resetPassword (refThis, refEvent) {
			// Do not submit form normally, use Ajax instead
			refEvent.preventDefault();
			
			var formElem = $(refThis);
			var formData = formElem.serialize();
			var url = formElem.attr('action');
						
			var successFcn = function(responseData) {
				if (responseData.success) {
					alert("Your password was re-set successfully. Logging you in now.");	
					window.location.replace("/");
				} else {
					alert(responseData.errorMsg);
				}
			};
			var errorFcn = function() {				
				alert("An error occurred. Contact Heroscape.org if this error persists.");
			};		
			
			submitAjaxRequest(url, formData, successFcn, errorFcn);
		}
	</script>
</head>
<body><div id="content" class="content">
	<?php include(Nav); ?>
	<div id='pageContent'><article>
		<h1>Reset Password</h1>
		
		<form id="loginForm" method="post" action="/php/account/resetPassword.php" onsubmit="resetPassword(this, event)">
			<label>Email Address: <span class='requiredField'>*</span> 
				<input type="email" name="email" id='emailInput' required>
			</label>
			
			<label>Password: <span class='requiredField'>*</span> 
				<input type="password" name="password" id='passwordInput' required>
			</label>
			
			<label>Confirm Password: <span class='requiredField'>*</span> 
				<input type="password" name="confirmPassword" id='confirmPasswordInput' required>
			</label>
			
			<label>Private Reset Key: <span class='requiredField'>*</span> 
				<input type="text" name="resetKey" id='resetKeyInput' required readonly>
			</label>
			
			<br>
			<button type="submit" id="loginButton" name="save">Reset Password</button>
		</form>
		
		<?php
			if (isset($_GET["email"])) {
				echo "
					<script>
						document.getElementById('emailInput').value = '{$_GET['email']}';
					</script>
				";
			}
			if (isset($_GET["resetKey"])) {
				echo "
					<script>
						document.getElementById('resetKeyInput').value = '{$_GET['resetKey']}';
					</script>
				";
			}
		?>
	</article></div>
	<?php include(Footer); ?>
</div></body>
</html>