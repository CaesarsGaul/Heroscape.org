<?php
echo "
<script>
	createNavBar([
			{text: 'Scoring', url: '/tools/scoring'},
			{text: 'Damage', url: '/tools/damage'},
			{text: 'Clock', url: '/tools/clock'}
		], ['setWidth',  'subNavBar']);
	//hideNonRelevantNavItems();
</script>
";
?>