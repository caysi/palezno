<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

$GLOBALS['errorNames'] = require(FUNCTIONS_PATH.'/errorNames.php');

function caysi_renderErrorMessage(&$error) {
	return '<b>'.$GLOBALS['errorNames'][$error['type']].':</b> '.$error['message'].' <b>'.$error['file'].'</b> <b>'.$error['line'].'</b><br />'."\n";
}

/*
* Handler amost all errors
*/
function caysi_error_handler(&$errno, &$errstr, &$errfile, &$errline, &$errcontext) {
	if(!(error_reporting() & $errno)) {
		// Этот код ошибки не включен в error_reporting
		return;
	}
	$error = array(
		'type'    => &$errno,
		'message' => &$errstr,
		'file'    => &$errfile,
		'line'    => &$errline,
	);
	echo caysi_renderErrorMessage($error);
	$backtrace = debug_backtrace();
	echo F::_call('renderBacktrace', array($backtrace, __FUNCTION__));

	/* Не запускаем внутренний обработчик ошибок PHP */
	return true;
}
set_error_handler('caysi_error_handler');

/*
* To handle fatal errors and some more
*/
declare(ticks=1);
function caysi_register_tick_function(){
	$GLOBALS['backtrace'] = debug_backtrace();
}
register_tick_function('caysi_register_tick_function');
function caysi_register_shutdown_function() {
	$lastError = error_get_last();
	$errno = &$lastError['type'];
	if($errno !== E_ERROR
		&& $errno !== E_PARSE
		&& $errno !== E_CORE_ERROR
		&& $errno !== E_CORE_WARNING
		&& $errno !== E_COMPILE_ERROR
		&& $errno !== E_COMPILE_WARNING
		&& $errno !== E_STRICT
	) {
		return;
	}

	echo caysi_renderErrorMessage($lastError);
	echo F::_call('renderBacktrace', array($GLOBALS['backtrace'], 'caysi_register_tick_function'));
}
register_shutdown_function('caysi_register_shutdown_function');


?>
