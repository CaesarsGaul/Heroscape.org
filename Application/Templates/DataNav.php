<?php
echo "
<script>
	createNavBar([
			/*{text: 'Players', url: '/data/players'},*/
			{text: 'Delta', url: '/data/delta'},
			{text: 'Figures', url: '/data/figures'},
			{text: 'Formats', url: '/data/formats'},
			{text: 'Players', url: '/data/players'},
			{text: 'Historical', url: '/data/historical'}
		], ['setWidth',  'subNavBar']);
	//hideNonRelevantNavItems();
</script>
";
?>