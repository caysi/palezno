<?php
function caysi_var_dump() {
	$var_dump_content = '';
	$args = func_get_args();
	foreach($args as &$var) {
		$GLOBALS['debug_info'].= '<hr>';
		$GLOBALS['debug_info'].= F::_call('color_var_dump', array($var));
	}
	$GLOBALS['debug_info'].= '<hr style="color: red;">';

	if(defined('NSD')){
		$GLOBALS['debug_info'].= $var_dump_content;
	}
	else{
		echo $var_dump_content;
	}
	unset($var_dump_content);
}
