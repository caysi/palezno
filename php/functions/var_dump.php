<?php
function caysi_var_dump() {
	$var_dump_content = '';
	$args = func_get_args();

	if(ENVIRONMENT === 'cli') {
		foreach($args as &$var) {
			$var_dump_content.= "\n\033[37m" . '---------------------------' . "\033[0m\n";
			$var_dump_content.= F::_call('color_cli_var_dump', array($var));
		}
		$var_dump_content.= "\n\033[30;47m" . '===========================' . "\033[0m\n";
	}
	else {
		foreach($args as &$var) {
			$var_dump_content.= '<hr>' . "\n";
			$var_dump_content.= F::_call('color_var_dump', array($var));
		}
		$var_dump_content.= '<hr class="block">' . "\n";
	}

	if(defined('NSD')){
		$GLOBALS['debug_info'].= $var_dump_content;
	}
	else{
		echo $var_dump_content;
	}
	unset($var_dump_content);
}
