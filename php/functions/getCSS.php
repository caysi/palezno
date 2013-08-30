<?php
function caysi_getCSS ($fileName) {
	if(isset($GLOBALS['includeCSS'][$fileName]))
		return '';

	$GLOBALS['includeCSS'][$fileName] = 1;
	return '<style type="text/css">'.F::_call('minifyFile', array(STATIC_PATH.'/css/'.$fileName.'.css')).'</style>';
}
