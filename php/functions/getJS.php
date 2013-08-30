<?php
function caysi_getJS ($fileName) {
	if(isset($GLOBALS['includeJS'][$fileName]))
		return '';

	$GLOBALS['includeJS'][$fileName] = 1;
	return '<script type="text/javascript">'.F::_call('minifyFile', array(STATIC_PATH.'/js/'.$fileName.'.js')).'</script>';
}
