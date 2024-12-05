<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Support the Site</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		.costTable {
			display: inline-block;
			margin: auto;
		}
		
		.costTable {
			border-collapse: collapse;
		}
		.costTable th, .costTable td {
			border: 1px solid black;
			padding: 5px;
		}
		
		.cost:before {
			content: "$"
		}
	</style>

	<!-- Internal Files -->
	<script src="/js/scripts.js"></script>
		
	<script>
		function annualCost() {
			var annualTDs = document.getElementsByClassName("annual");
			var annualCost = 0;
			for (let i = 0; i < annualTDs.length; i++) {
				annualCost += parseFloat(annualTDs[i].innerHTML);
			}
			
			var monthlyTDs = document.getElementsByClassName("monthly");
			var monthlyCost = 0;
			for (let i = 0; i < monthlyTDs.length; i++) {
				monthlyCost += parseFloat(monthlyTDs[i].innerHTML);
			}
			
			return annualCost + monthlyCost * 12;
		}
		
		function monthlyCost() {
			return (annualCost() / 12).toFixed(2);
		}
	</script>
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
	
		<article>	
			<h1>Support the Site</h1>
						
			<h3>Total Cost</h3>
			<div>Per Year : $<span id='totalCostPerYear'></span></div>
			<div>Per Month : $<span id='totalCostPerMonth'></span></div>
			<br>
			<div>In operation since August 2022</div>
			<div>Lifetime Cost : $<span id='totalCostToDate'></span></div>
			
			<div id='CostsDiv'>
				<h3>Annual Costs</h3>
				<table class='costTable'>
					<tr>
						<th>Cost</th>
						<th>Description</th>
						<th>Provider</th>
					</tr>
					<tr>
						<td class='cost annual'>22.99</td>
						<td>Domain Renewal</td>
						<td>GoDaddy</td>
					</tr>
					<tr>
						<td class='cost annual'>9.99</td>
						<td>Domain Privacy Protection</td>
						<td>GoDaddy</td>
					</tr>
				</table>
				
				<h3>Monthly Costs</h3>
				<table class='costTable'>
					<tr>
						<th>Cost</th>
						<th>Description</th>
						<th>Provider</th>
					</tr>
					<tr>
						<td class='cost monthly'>15.00</td>
						<td>Database</td>
						<td>AWS | Lightsail</td>
					</tr>
					<tr>
						<td class='cost monthly'>0.50</td>
						<td>Hosted Zone</td>
						<td>AWS | Hosted Zone</td>
					</tr>
					<tr>
						<td class='cost monthly'>8.25</td>
						<td>Web Server Hosting</td>
						<td>AWS | EC2</td>
					</tr>
				</table>
				
				<script>
					document.getElementById('totalCostPerYear').innerHTML = annualCost();
					document.getElementById('totalCostPerMonth').innerHTML = monthlyCost();
					
					var totalCost = 0;
					var today = new Date();
					for (let month = today.getMonth(); month >= 0; month--) {
						totalCost += parseFloat(monthlyCost());
					}
					for (let year = today.getFullYear()-1; year > 2022; year--) {
						totalCost += parseFloat(annualCost());
					}
					for (let month = 7; month < 12; month++) {
						totalCost += parseFloat(monthlyCost());
					}
					document.getElementById('totalCostToDate').innerHTML = totalCost;
				</script>
			</div>
			
			<!-- $34.65 in payments from Renegade Affiliate Sales -->
			
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>