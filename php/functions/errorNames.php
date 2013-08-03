<?php
return array(
	1     => 'FATAL',
	2     => 'WARNING',
	4     => 'PARSE',
	8     => 'NOTICE',
	16    => 'CORERROR',
	32    => 'CORWARNING',
	64    => 'COMPILERROR',
	128   => 'COMPILWARNING',
	256   => 'USER_ERROR',
	512   => 'USER_WARNING',
	1024  => 'USER_NOTICE',
	2048  => 'STRICT',
	4096  => 'RECOVERABLERROR',
	8192  => 'DEPRECATED',
	16384 => 'USER_DEPRECATED',
	32767 => 'ALL',
);

/*$GLOBALS['errorNames'] = get_defined_constants(true);
$GLOBALS['errorNames'] = $GLOBALS['errorNames']['Core'];
foreach($GLOBALS['errorNames'] as $key=>$errorName) {
	if(strpos($key, 'E_') === 0) {
		$GLOBALS['errorNames'][$errorName] = str_replace('E_', '', $key);
	}
	unset($GLOBALS['errorNames'][$key], $key, $errorName);
}
$GLOBALS['errorNames'][1] = 'FATAL';
*/
