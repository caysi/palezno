<?php
function caysi_string_add_spaces($string, $needLength) {

	$length = strlen($string);
	if(gettype($string) === 'string') {
		$length+= 2;
	}

	$needSpaces = $needLength - $length;
	$spaces = '';


	for($i = 0; $i < $needSpaces; $i++) {
		$spaces.= ' ';
	}

	return $spaces;
}
