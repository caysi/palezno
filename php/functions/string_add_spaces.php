<?php
function caysi_string_add_spaces($string, $needLength) {
	$needSpaces = $needLength - strlen($string);
	if(gettype($string) === 'integer') {
		$needSpaces+= 2;
	}
	$spaces = '';
	for($i = 0; $i < $needSpaces; $i++) {
		$spaces.= ' ';
	}

	return $spaces;
}
