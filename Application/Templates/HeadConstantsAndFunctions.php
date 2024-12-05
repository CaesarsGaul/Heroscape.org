<?php

/* Define Paths to All Relevant Folders */
	
define("AboveWebRoot", "/var/www/");
define("WebRoot", AboveWebRoot . "html/");

define("Application", AboveWebRoot . "Application/");
define("Model", Application . "Model/");
define("Templates", Application . "Templates/");
define("Nav", Templates . "Nav.php");
define("MapNav", Templates . "MapNav.php");
define("DataNav", Templates . "DataNav.php");
define("ToolsNav", Templates . "ToolsNav.php");
define("EventsNav", Templates . "EventsNav.php");
define("NavDoc", Templates . "Nav-Doc.php");
define("Footer", Templates . "Footer.php");

define("Data", AboveWebRoot . "Data/");
// Future Data folders go here

define("Libraries", AboveWebRoot . "Libraries/");

require_once(Libraries . "Internal/Email/PHP/Email.php");

/* Define Core, Re-usable PHP Functions */

function alertUser($msg) {
	echo "
		<script type='text/javascript'>
			alert('{$msg}');
		</script>
	";
}

function jsRedirect($url) {
	echo "
		<script type='text/javascript'>
			window.location.replace('{$url}');
		</script>
	";
}

function phpRedirect($url) {
	header("Location: {$url}");
}

spl_autoload_register(function ($class_name) {
    require_once(Model . "{$class_name}.php");
});

/* Both arrays are passed by reference and modified in the method. Nothing is returned. */
function subtractOverlap(& $array1, & $array2, $fieldsToCheckEqivalence) {
	foreach ($array1 as $array1Obj) {
		foreach ($array2 as $array2Obj) {
			$equal = true;
			foreach ($fieldsToCheckEqivalence as $fieldToCheck) {
				if ($array1Obj->$fieldToCheck != $array2Obj->$fieldToCheck) {
					$equal = false;
					break;
				}
			}
			if ($equal) {
				if(($key = array_search($array1Obj, $array1)) !== FALSE) {
					unset($array1[$key]);
				}
				if(($key = array_search($array2Obj, $array2)) !== FALSE) {
					unset($array2[$key]);
				}
				break;
			}
		}
	}
}

?>