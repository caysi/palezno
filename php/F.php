<?php
define('PALEZNO_PATH', __DIR__);
define('FUNCTIONS_PATH', PALEZNO_PATH.'/functions');
// определяем скрит запущет из терминала или нет
if(PHP_SAPI == 'cli'){ define('THIS_TERMINAL', TRUE); } else { define('THIS_TERMINAL', FALSE); }

/**
* Класс для автоматического подключения файлов с функциями
*
* \F::[functionName]($arg[, $arg2....]);
*/
class F {
	static function __callStatic($name, $arguments) {
		require_once(FUNCTIONS_PATH.'/'.$name.'.php');
		$name = '\\functions\\'.$name;
		return $name($arguments);
	}
}
?>
