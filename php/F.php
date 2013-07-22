<?php
define('PALEZNO_PATH', __DIR__);
define('FUNCTIONS_PATH', PALEZNO_PATH.'/functions');
define('FUNCTIONS_NAMESPACE', '\\functions\\'); //TODO типа немспейс, чтоб не было проблем со старыми версиями php
// определяем скрит запущет из терминала или нет
if(PHP_SAPI == 'cli'){ define('THIS_TERMINAL', TRUE); } else { define('THIS_TERMINAL', FALSE); }

/**
* Класс для автоматического подключения файлов с функциями
*
* \F::[functionName]($arg[, $arg2....]);
*/
class F {
	static function __callStatic($name, $args) {
		if(!file_exists(FUNCTIONS_PATH.'/'.$name.'.php')) {
			$alias = parse_ini_file(PALEZNO_PATH.'/F_alias.ini');
			if(isset($alias[$name])) {
				$name = $alias[$name];
			}
			else {
				return;
			}
		}
		if(!file_exists(FUNCTIONS_PATH.'/'.$name.'.php')) {
			return;
		}

		require_once(FUNCTIONS_PATH.'/'.$name.'.php');
		$name = FUNCTIONS_NAMESPACE.$name;
		return eval(self::evalStr($name, $args));
	}
	/**
	* Для версий ниже 5.3
	*/
	function __call($name, $args) {
		return self::__callStatic($name, $args);
	}
	/**
	* Подготовка строки для eval
	*/
	static function evalStr($name, &$args, $argsName = 'args') {
		if($args) {
			$evalStr = $name.'($'.$argsName.'['.implode('], $'.$argsName.'[', array_keys($args)).']);';
		}
		else {
			$evalStr = $name.'();';
		}
		return 'return '.$evalStr;
	}
}
?>
