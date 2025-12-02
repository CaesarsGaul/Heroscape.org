<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>Figure Data</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<!--<link rel="stylesheet" href="/css/about.css">-->
	<style>
		#DataLinks {
			
		}
		
		#DataLinks a {
			margin-left: 20px;
			margin-right: 20px;
		}
		
		#FigureList {
			text-align: center;
		}
		
		h2 {
			text-align: center;
		}
		
		#FigureList li {
			list-style: none;
		}
		
		#FigureList li a {
			text-decoration: none;
			color: inherit;
		}
		
		#FigureList li a:visited {
			color: inherit;
		}
	</style>
	
	<!-- Internal Files -->
	<script>
		function displayCardList() {
			var parentElem = document.getElementById("FigureList");
			for (let i = 0; i < Card.list.length; i++) {
				const card = Card.list[i];
				if (card.figureSet.id > 3) {
					continue;
				}
				var liElem = createLi({});
				liElem.appendChild(createA({
					innerHTML: card.name,
					href: "/data/figures/card?name="+card.name
				}));
				parentElem.appendChild(liElem);
			}
		}
	</script>
	
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	<?php include(DataNav); ?>
	
	<div id='pageContent'>
		<h1>Figure Data</h1>
		<article>	
			<div id='DataLinks'>
				<a href='/data/figures/army-search'>Army Search</a>
				<a href='/data/figures/release-set'>Release Sets</a>
				<a href='/data/figures/win-rate'>Win Rates</a>
			</div>
			
			<div id='FigureList'>
				<h2>Figures</h2>
				<ul id='FigureList'>
				
				</ul>
			</div>
			
			<script>
				Card.load(
					{},
					function (figures) {
						displayCardList();
					},
					{joins: {
						"figureSetID": {}
					}}
				);
			</script>
		</article>
		
	</div>
	<?php include(Footer); ?>
</div></body>
</html>