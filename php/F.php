<?php
class F {
	const rootPath = __DIR__;

	static function __callStatic($name, $arguments) {
		require_once(self::rootPath.'/functions/'.$name.'.php');
		$name = '\\functions\\'.$name;
		return $name($arguments);
	}
}
?>
