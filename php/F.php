<?php
/**
* Класс для автоматического подключения файлов с функциями
* 
* \F::[functionName]($arg[, $arg2....]);
*/
class F {
	const rootPath = __DIR__;
	const functionsPath = __DIR__.'/functions';

	static function __callStatic($name, $arguments) {
		require_once(self::functionsPath.'/'.$name.'.php');
		$name = '\\functions\\'.$name;
		return $name($arguments);
	}
}
?>
