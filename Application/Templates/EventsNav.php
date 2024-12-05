<?php
echo "
<script>
	createNavBar([
			{text: 'Tournaments', url: '/events/tournament/list'},
			{text: 'Conventions', url: '/events/convention/list'},
			{text: 'Leagues', url: '/events/league'}
		], ['setWidth',  'subNavBar']);
	//hideNonRelevantNavItems();
</script>
";
?>