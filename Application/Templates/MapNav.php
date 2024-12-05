<?php
echo "
<script>
	createNavBar([
			{text: 'Maps', url: '/map'},
			/*{text: 'Build', url: '/map/build'},*/
			{text: 'Terrain', url: '/map/terrain'},
			{text: 'Glyphs', url: '/map/glyph'}
		], ['setWidth',  'subNavBar']);
	//hideNonRelevantNavItems();
</script>
";
?>