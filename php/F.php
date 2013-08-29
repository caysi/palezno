<?php
define('PALEZNO_PATH',      dirname(__FILE__));
define('FUNCTIONS_PATH',    PALEZNO_PATH.'/functions');
define('STATIC_PATH',       FUNCTIONS_PATH.'/static');
define('FUNCTIONS_PREFIX', 'caysi_');
// определяем скрит запущет из терминала или нет
if(PHP_SAPI == 'cli'){ define('THIS_TERMINAL', TRUE); } else { define('THIS_TERMINAL', FALSE); }

// Тут будет дебаг информация скрытая от пользователя
$GLOBALS['debug_info'] = '';

/**
* Класс для автоматического подключения файлов с функциями
*
* F::[functionName]([$arg, $arg2....]);
*/
class F {
	static function _call($name, $args = NULL) {
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
		$name = FUNCTIONS_PREFIX.$name;
		return eval(self::evalStr($name, $args));
	}
	static function __callStatic($name, $args) {
		return self::_call($name, $args);
	}
	/**
	* Для версий ниже 5.3
	*/
	function __call($name, $args) {
		return self::_call($name, $args);
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

require_once(FUNCTIONS_PATH.'/errorHandler.php');

?>
