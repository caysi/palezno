<?php

function caysi_var_export() {
	$args = func_get_args();
	$result = '';
	foreach($args as &$var) {
		$result.= F::_call('color_var_dump', array($var));
	}
	return $result;
}
