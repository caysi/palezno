<?php
function caysi_var_dump() {
	$args = func_get_args();
	foreach($args as &$var) {
		echo '<hr>';
		echo F::_call('color_var_dump', array($var));
	}
	echo '<hr style="color: red;">';
}
