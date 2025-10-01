<?php
echo "
<script>
	createNavBar([
			/*{text: 'Players', url: '/data/players'},*/
			{text: 'Delta', url: '/data/delta'},
			{text: 'Figures', url: '/data/figures'},
			{text: 'Players', url: '/data/players'},
			{text: 'Historical', url: '/data/historical'}
		], ['setWidth',  'subNavBar']);
	//hideNonRelevantNavItems();
</script>
";
?>