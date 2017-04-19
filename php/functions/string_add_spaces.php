<?php
function caysi_string_add_spaces($string, $needLength) {
	$needSpaces = $needLength - strlen($string);
	$spaces = '';
	for($i = 0; $i < $needSpaces; $i++) {
		$spaces.= ' ';
	}

	return $spaces;
}
