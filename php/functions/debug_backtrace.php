<?php
function caysi_debug_backtrace() {
	$debug_backtrace_content = '';
	$backtrace = debug_backtrace();
	$debug_backtrace_content.= F::_call('renderBacktrace', array($backtrace));

	if(defined('NSD')){
		$GLOBALS['debug_info'].= $debug_backtrace_content;
	}
	else{
		echo $debug_backtrace_content;
	}
	unset($debug_backtrace_content);
}
