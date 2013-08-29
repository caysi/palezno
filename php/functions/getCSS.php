<?php
function caysi_getCSS ($fileName) {
	return '<style type="text/css">'.F::_call('minifyFile', array(STATIC_PATH.'/css/'.$fileName.'.css')).'</style>';
}
