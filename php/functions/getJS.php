<?php
function caysi_getJS ($fileName) {
	return '<script type="text/javascript">'.F::_call('minifyFile', array(STATIC_PATH.'/js/'.$fileName.'.js')).'</script>';
}
