<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Forgot Password | Heroscape.org</title>
	
	
	
	<!-- JavaScript -->
	<script>
		hidePageUntilLoaded = false;
		allLoadingRequestsSent = true;
		
		function forgotPassword (refThis, refEvent) {
			// Do not submit form normally, use Ajax instead
			refEvent.preventDefault();
			
			var formElem = $(refThis);
			var formData = formElem.serialize();
			var url = formElem.attr('action');
						
			var successFcn = function(responseData) {
				if (responseData.success) {
					alert("Login instructions have been emailed to you.");	
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
		<h1>I Forgot My Password</h1>
		
		<form method="post" action="/php/account/forgotPassword.php" onsubmit="forgotPassword(this, event)">
			<label for='email'>
				Enter your Email Address, and instructions to reset your password will be sent to your email:
				<input type="email" name="email" id='emailInput' required>
			</label>
			<button type="submit" id="loginButton" name="save">Recover Password</button>
		</form>
	</article></div>
	<?php include(Footer); ?>
</div></body>
</html>