<?php
function caysi_array_max_length(array $array) {
	$max = 0;
	for($i = 0, $count = count($array); $i < $count; $i++) {
		$length = strlen($array[$i]);

		if(gettype($array[$i]) === 'string') {
			$length+= 2;
		}


		if($length > $max) {
			$max = $length;
		}
	}

	return $max;
}
