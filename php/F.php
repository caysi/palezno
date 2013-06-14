<?php
define('PALEZNO_PATH', __DIR__);
define('FUNCTIONS_PATH', PALEZNO_PATH.'/functions');
define('FUNCTIONS_NAMESPACE', '\\functions\\');
// определяем скрит запущет из терминала или нет
if(PHP_SAPI == 'cli'){ define('THIS_TERMINAL', TRUE); } else { define('THIS_TERMINAL', FALSE); }

/**
* Класс для автоматического подключения файлов с функциями
*
* \F::[functionName]($arg[, $arg2....]);
*/
class F {
	static function __callStatic($name, $args) {
		require_once(FUNCTIONS_PATH.'/'.$name.'.php');
		$name = FUNCTIONS_NAMESPACE.$name;
		return eval(self::evalStr($name, $args));
	}
	/**
	* Подготовка строки для eval
	*/
	static function evalStr($name, &$args, $argsName = 'args') {
		$evalStr = $name.'($'.$argsName.'['.implode('], $'.$argsName.'[', array_keys($args)).']);';
		return $evalStr;
	}
}
?>
