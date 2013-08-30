<?php
function caysi_minifyFile($path) {
	$content = file_get_contents($path);
	$search = array(
		"\r\n" => "\n",
		";\n"  => '; ',
		"{\n"  => '{ ',
		"}\n"  => '} ',
		"\t"   => ' ',

	);
	$content = str_replace(array_keys($search), array_values($search), $content);
	return $content;
}
