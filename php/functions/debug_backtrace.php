<?php
namespace functions;

function debug_backtrace() {
	$trace = \debug_backtrace();
	unset($trace[0], $trace[1], $trace[2], $trace[3]);
	echo '<table border="1">';
	foreach($trace as $t) {
		echo '<tr>';
		echo '<td>'.$t['file'].'</td>';
		echo '<td>'.$t['line'].'</td>';
		echo '<td>'.$t['function'].'</td>';
		//echo '<td>'; var_dump($t['args']); echo '</td>';
		echo '</tr>';
	}
	echo '</table>';/**/
}
