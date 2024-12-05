<?php
echo "
<script>
	createNavBar([
			{image: '/images/favicon.png', alt: 'Heroscape.org', title: true, url: '/', class: 'showOnMobile'},
			{text: 'Builder', url: '/builder'},
			{text: 'Events', url: '/events'},
			{text: 'Maps', url: '/map'},
			{text: 'Tools', url: '/tools'},
			{text: 'Data', url: '/data'},
			{text: 'Play', url: '/ohs'},
			
			/*{text: 'Scoring', url: '/scoring'},
			{text: 'Damage', url: '/damage'},*/
			
			/*{text: 'Tournaments', url: '/tournament/list'},
			{text: 'Conventions', url: '/convention/list'},
			{text: 'Leagues', url: '/league'},*/
			
			{text: 'Me', url: 'javascript:redirectToUserPage()', class: 'logged-in-nav-item'},
			{text: 'Login', url: '/account/login', class: 'logged-out-nav-item'},
			{text: 'Logout', url: 'javascript:logout()', class: 'logged-in-nav-item'}
		], ['setWidth']);
	hideNonRelevantNavItems();
</script>
";
?>