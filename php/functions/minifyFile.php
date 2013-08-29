<?php
function caysi_minifyFile($path) {
	$content = file_get_contents($path);
	return $content;
}
