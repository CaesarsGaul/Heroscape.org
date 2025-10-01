<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Historical Data</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
	
		
	<script>
		
		
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(DataNav); ?>
	
	<div id='pageContent'>		
		<h1>Historical Data</h1>
		<article>	
			<p>These pages are meant to house data that is not present in .org's database (for various reasons) as plain text webpages.</p>
			<p><a href='/data/historical/gencon'>GenCon</a></p>
			<p><a href='/data/historical/onlinecon'>OnlineCon</a></p>
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>