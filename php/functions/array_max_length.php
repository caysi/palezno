<?php
function caysi_array_max_length(array $array) {
	$max = 0;
	for($i = 0, $count = count($array); $i < $count; $i++) {
		if(($length = strlen($array[$i])) > $max) {
			$max = $length;
		}
	}

	return $max;
}
