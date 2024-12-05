<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Contact Heroscape.org</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		label {
			display: block;
			font-family: var(--sans_serif_regular);
			margin: 10px;
		}
		
		.labelText {
			display: block;
			margin: 10px;
		}
		
		input[type=text], input[type=email] {
			display: block !important;
			margin: auto !important;
			padding: 10px !important;
			width: 230px !important;
		}
		
		textarea {
			display: block;
			margin: auto;
			padding: 10px;
		}
		
		input[type=submit] {
			border: 2px solid #ccc;
			padding: 10px;
			border-radius: 5px;
		}
		
		input[type=submit]:focus {
			border: 2px solid black;
			outline: none;
		}
		
		#dogsPlayingPokerImg {
			height: 190px;
		}
		
		#labelDiv, #imgDiv {
			display: inline-block;
			vertical-align: top;
		}
		
		@media only screen and (max-width: 600px) {
			textarea {
				width: 450px;
			}
		}
		
		@media only screen and (max-width: 500px) {
			textarea {
				width: 350px;
			}
		}
		
		@media only screen and (max-width: 400px) {
			textarea {
				width: 250px;
			}
		}
		
		@media only screen and (max-width: 300px) {
			textarea {
				width: 200px;
			}
		}
		
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	<script src="/js/Unit.js"></script>
	<script src="/js/Army.js"></script>
	<script src='/js/armyBuilder.js'></script>
	
	<script>
		function contactUs (refThis, refEvent) {
			// Do not submit form normally, use Ajax instead
			refEvent.preventDefault();
			
			var formElem = $(refThis);
			var formData = formElem.serialize();
			var url = formElem.attr('action');
			
			if ( ! loggedIn()) {
				var challengeInput = document.getElementById('challengeQuestionInput');
				var challengeAnswer = challengeInput.value;
				if (challengeAnswer != 4) {
					alert("Incorrect answer to the challenge question");
					return;
				}
			}
			
			var successFcn = function(responseData) {
				alert("Thank you for your question.\nSomeone from Heroscape.org will be in touch.");	
			};
			var errorFcn = function() {				
				alert("Unable to submit the query. Please try again later.");
			};		
			
			submitAjaxRequest(url, formData, successFcn, errorFcn);
		}
		
		hidePageUntilLoaded = false;
		allLoadingRequestsSent = true;
	</script>
	
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>
		<article>
			<h1>Contact Heroscape.org</h1>
			<form method="POST" action="/php/contactUs.php" onsubmit="contactUs(this, event)">
				<div id='labelDiv'>
					<label for='name'>
						<span class='labelText'>Name</span>
						<input type='text' id='name' name='name' placeholder='Name' required>
					</label>
					
					<label for='email'>
						<span class='labelText'>Email</span>
						<input type='email' id='email' name='email' placeholder='Email' required>
					</label>
				</div>
				
				<label for='subject'>
					<span class='labelText'>Send Us a Message</span>			
					<textarea id='subject' name='subject' placeholder='Questions, comments, or concerns...' rows='10' cols='80'></textarea>
				</label>
				
				<input type='hidden' id='referrerPage' name='referrerPage' />
				
				<label id='challengeQuestionLabel' for='challengeQuestionInput'>
					<span class='labelText'>How many lives does the Hydra have?</span>
					<input type='number' id='challengeQuestionInput' name='challengeQuestion' />
				</label>
				<script>
					if (loggedIn()) {
						document.getElementById('challengeQuestionLabel').style.display = "none";
					}
				</script>
				
				<input type='submit' value='Submit Question'>
			</form>
		</article>
	</div>

	<?php include(Footer); ?>

</div></body>
</html>