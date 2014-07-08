<?php

DEFINE('ROOT_DIR', dirname(__FILE__));
DEFINE('JS_DIR',   dirname(ROOT_DIR).'/js');

require_once('F.php');

if(isset($_GET['file'])) {
}

$jsFiles = scandir(JS_DIR);
foreach ($jsFiles as $jsFile) {
	if(
		$jsFile == '.'
		|| $jsFile == '..'
	) {
		continue;
	}
	echo jsLink($jsFile);
}


function jsLink($link) {
	return '<a href="#">'.$link.'</a><br/>';
}

F::var_dump(JS_DIR, scandir(JS_DIR)); //TODO DELETE
?>
