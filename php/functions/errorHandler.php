<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

define('DEBUG_CONTENT_FILE_MODE', 0666);

$GLOBALS['errorNames'] = require(FUNCTIONS_PATH.'/errorNames.php');

function caysi_renderErrorMessage(&$error, $fatal=false) {
	$class = 'error_handler';
	if($fatal) $class.= '_fatal';
	return '<b class="'.$class.'">'.$GLOBALS['errorNames'][$error['type']].':</b> '.$error['message'].' <b>'.$error['file'].'</b> <b>'.$error['line'].'</b><br />'."\n";
}

/*
* Handler amost all errors
*/
function caysi_error_handler($errno, $errstr, $errfile, $errline, $errcontext) {
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
	$GLOBALS['debug_info'].= caysi_renderErrorMessage($error);
	$backtrace = debug_backtrace();
	$GLOBALS['debug_info'].= F::_call('renderBacktrace', array($backtrace, __FUNCTION__));

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
	if($errno === E_ERROR
		|| $errno === E_PARSE
		|| $errno === E_CORE_ERROR
		|| $errno === E_CORE_WARNING
		|| $errno === E_COMPILE_ERROR
		|| $errno === E_COMPILE_WARNING
		|| $errno === E_STRICT
	) {
		$GLOBALS['debug_info'].= caysi_renderErrorMessage($lastError, true);
		$GLOBALS['debug_info'].= F::_call('renderBacktrace', array($GLOBALS['backtrace'], 'caysi_register_tick_function'));
		$buttonClass = 'fatal';
	}

	$debugContent = '';

	if(ENVIRONMENT === 'html') {
		$debugContent.= F::_call('getCSS', array('shutdown'));
		if(empty($GLOBALS['debug_info'])) {
			$debugContent.= '<div id="shutdown_button" class="empty"></div>'."\n";
		}
		else {
			if(empty($buttonClass)) $buttonClass = 'notice';

			$displayContent = 'display:none;';
			if(defined('NSD') || $buttonClass === 'fatal') $displayContent = '';

			$debugContent.= F::_call('getJS', array('shutdown'))."\n";
			$debugContent.= '<div id="shutdown_content" style="'.$displayContent.'">'.$GLOBALS['debug_info'].'</div>'."\n";
			$debugContent.= '<div id="shutdown_button" class="'.$buttonClass.'" onclick="showContent()"></div>'."\n";
		}
	}

	// show or save in file debug and errors
	if(defined('NSD')) {
		file_put_contents(DEBUG_CONTENT_FILE, $debugContent);
		chmod(DEBUG_CONTENT_FILE, DEBUG_CONTENT_FILE_MODE);
	}
	else {
		echo $debugContent;
	}
}
//function caysi
/*PHP 5.0.4:
*  1. ob_callback
*  2. shutdown_func
* PHP 5.1.2:
*  1. shutdown_func
*  2. ob_callback
*/
register_shutdown_function('caysi_register_shutdown_function');


?>
