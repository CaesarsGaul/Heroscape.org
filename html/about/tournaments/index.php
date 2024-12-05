<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php require_once("/var/www/Application/Templates/Head.php"); ?>
	
	<title>About | Tournaments</title>
		
	<!-- CSS -->
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/about.css">
</head>
<body><div id='content'>
	
	<?php include(Nav); ?>
	
	<div id='pageContent'>		
		<article>	
			<h1>About | Tournaments</h1>
			
			<p>The <a href=''>Tournaments</a> page supports the logistics of running an individual 
			tournament, including creating pairings and allowing result submission.</p>
			
			<h2>As a Player</h2>
			
			<h3>Before the Tournament</h3>
			<p>The tournament director will provide you with a URL for that tournament.</p>
			<p>If you do not already have an account on Heroscape.org, 
			<a href='https://heroscape.org/account/create/'>create an account</a>. Note that new 
			accounts must have their email verified before they can be used (click a link in an 
			email that is sent to you upon account creation).<p>
			<p>Login to Heroscape.org.</p>
			<p>Go to the URL for the tournament, and click 'Sign-up'. You should then see your 
			username displayed in the standings below.</p>
			<p>Click 'Submit Army', and use the army builder tool to enter your army(s) and submit it. 
			Once this is done, you should see your army(s) displayed next to your name in the 
			standings on the main tournament page.</p>
			<p>You're all set! Wait for the tournament to begin.</p>
			
			<h3>During the Tournament</h3>
			<p>Each round, you will be sent an email when the round begins telling you your 
			matchup for that round. The email specifies your opponent, which map you are on, 
			and your opponent's army(s).</p>
			<p>After your game is done, one player from the game should submit the result via 
			the 'Report Result' button next to your game on the main tournament page.</p>
			<p>You're all set! Wait for the next round to start.</p>
			
			<h3>After the Tournament</h3>
			<p>The final standings will remain on the tournament page.</p>
			
			<h2 id='TD'>As a Tournament Director</h2>
			
			<h3>Before the Tournament</h3>
			<p><a href=''>Create the tournament.</a> You'll need to specify all of the details 
			of your tournament (see 'Tournament Settings' below).</p>
			<p>Share the URL of the tournament (generated once you create the tournament)
			with your players.</p>
			<p><span class='miniHeading'>Maps</span>Enter the maps the tournament will use. On the tournament page, under the 
			'Admin Actions' section, find the 'Maps' section, and click 'Add New Game Map' 
			for each map you'll be using. The software works to avoid map rematches, so if you have 
			multiple copies of the same map, make sure to give them different numbers by specifying
			both the map 'Name' and map 'Number'. The 'Active' option means a map will be used;
			if a map needs to be removed for some number of rounds, you can de-select the 'Active' 
			checkbox. The 'For Streaming' option means that the map will get one of the higher 
			ranked matchups assigned to it.</p>
			<p><span class='miniHeading'>Temp Users</span>If you have any users who do not have access to a WiFi device, or don't have an 
			email address to create an account with, you can add them as a temporary user and 
			enter their information for them. Under the 'Admin Actions' section, under 
			'Add (Non-User) Player', enter their name and army(s) and click 'Create'. They should 
			then appear in the standings list above. Note that this means they will NOT get 
			emailed their pairings, and will not be able to submit results themselves (their 
			opponent, or a TD, will have to enter the result of their game; a TD can enter the 
			result of any game).</p>
			<p><span class='miniHeading'>Announcements</span>If you need to make an announcement to the players (before, during, or after 
			the tournament), you can enter your announcement into the box under 'Make Announcement' 
			and click 'Announce!'. This will sent an email to each player containing the message.</p>
			
			<h3>During the Tournament</h3>
			<p>Once the scheduled start time for the tournament has passed, you'll be able to pair round 1.<p>
			<p><span class='miniHeading'>Create Pairings</span>For each round, click 'Pair Next Round'. The pairings will then display in a 
			table at the top of the page. If you need to make any changes, you can drag and 
			drop a player (or map) onto another spot in the table to switch them. 
			Players cannot yet see the pairings at this point. Pairings are created using swiss-style 
			power matchups while working to avoid rematches where possible. Pairings also work to 
			avoid map-rematches for the players (where possible).</p>
			<p><span class='miniHeading'>Edit Parings (if needed)</span>If you need to edit the parings, you can drag & drop a player 
			onto another player's spot in the pairings to switch them, or a map name into another map spot to switch the maps. Note that 
			a game that is a rematch between two players will have the row highlighted in red to alert you of the potential issue. 
			The software works to avoid re-matches where possible, but prioritizes swiss-style matches over re-match avoidance 
			where applicable.</p>
			<p><span class='miniHeading'>Publish Pairings</span>When you are happy with the pairings, and ready to start the round, click 
			'Publish & Start Round'. This will sent an email to each user with their pairings, display 
			the pairings publicly on the page, and start the round timer. Once the round has been started, 
			you can no longer edit the matchups.</p>
			<p><span class='miniHeading'>Cancel Round</span>If a round has been started and you notice something is wrong (player should have 
			been inactive, the wrong map is used, etc.), you can cancel that round by clicking 
			'Cancel Current Round' (under 'Admin Actions'). That will delete all data associated 
			with the current round and return the tournament to the state it was in before that 
			round was paired. You will then have to re-pair the round after fixing whatever was wrong.</p>
			<p><span class='miniHeading'>Inactive Player</span>If a player needs to drop the tournament, you can mark them 'inactive' by selecting 
			their name under 'Drop/Undrop Player' (below 'Admin Actions') and clicking 'Drop Player'. 
			You can re-activate them later, if needed, by selecting their name again and clicking 
			'Un-Drop Player'. An inactive player will remain in the standings, but will not be paired 
			into future rounds.</p> 
			<p><span class='miniHeading'>Edit Results</span>If a game result has been entered incorrectly, you can fix the result by going to 
			'Edit Game Result' (under 'Admin Actions'), choosing the round, choosing the game, 
			and then re-entering the correct result and clicking 'Submit'.</p>
			<p><span class='miniHeading'>Data Backup</span>If the software malfunctions, or you choose to switch away from using it 
			mid-tournament for any reason, data is being backed up to a Google Sheet that 
			you can access by clicking the 'Google Sheet' link directly under 'Admin Actions'.</p>
			
			<h3>After the Tournament</h3>
			<p>Get some well deserved rest.</p>
			
			<h2>Tournament Settings</h2>
			<p>There are a number of settings that can be specified when creating a tournament.</p>
			<p>Logistics:</p>
			<ul>
				<li>Start Time</li>
				<li>End Date</li>
				<li>Player Cap</li>
				<li>Round Length</li>
				<li>Allow Signups After (When Users Can Signup After)</li>
				<li>Allow Army Submission After (When Users Can Submit their Army(s) After)</li>
				<li>Late Signups Allowed (or not)</li>
			</ul>
			<p>Teams & Multiplayer:</p>
			<ul>
				<li>Team Size (1 = No Teams)</li>
				<li># Players Per Game (2 = Default)</li>
			</ul>
			<p>Elimination Structure:</p>
			<ul>
				<li># Losses to be Eliminated</li>
				<li>Pairing Players Who Have Been Eliminated</li>
			</ul>
			<p>Multiple Armies:</p>
			<ul>
				<li># Armies Per Player</li>
				<li>Points Shared Between Armies</li>
			</ul>
			<p>Core Army Restrictions:</p>
			<ul>
				<li>Point Limit</li>
				<li>Hex Limit</li>
				<li>Figure Limit</li>
			</ul>
			<p>Unit Pricing:</p>
			<ul>
				<li>Delta v. Standard Pricing</li>
			</ul>
			<p>Figure Restrictions:</p>
			<ul>
				<li>VC Included?</li>
				<li>Marvel Included?</li>
				<li>Uniques Only?</li>
				<li>Commons Only?</li>
				<li>Heroes Only?</li>
				<li>Squads Only?</li>
			</ul>
		</article>

	</div>
	<?php include(Footer); ?>

</div></body>
</html>