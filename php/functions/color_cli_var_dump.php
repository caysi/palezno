<?php

function caysi_color_cli_var_dump(&$var, $tag = 'pre', $indent=0) { //TODO color_...
	if($indent > 5)
		return "\033[31m{...}\033[0m";

	$funcName = __FUNCTION__;
	// Params
	//$preStyle = ' margin: 1px 0;';
	$indentType = "\033[30;47m" . ' ' . "\033[0m" . '   '; // 4 пробела
	$boolean  = array('name' => 'boolean',  'colorT' => 'black', 'colorF' => 'black');
	$integer  = array('name' => 'integer',  'color' => 'blue');
	$float    = array('name' => 'double',   'color' => 'grey');
	$string   = array('name' => 'string',   'color' => 'green');
	$array    = array('name' => 'array',    'color' => 'blue');
	$object   = array('name' => 'object',   'color' => 'blue');
	$resource = array('name' => 'resource', 'color' => 'blue');
	$NULL     = array('name' => 'NULL',     'color' => 'black');
	// END Params

	$printString = '';
	$type = gettype($var);
	if($type === $boolean['name']) {
		if($var === TRUE)
			$printString.= "\033[1;37m" . 'TRUE' . "\033[0m";
		else
			$printString.= "\033[1;37m" . 'FALSE' . "\033[0m";
	}
	elseif($type === $integer['name']) {
		$printString.= "\033[1;34m" . $var . "\033[0m";
	}
	elseif($type === $float['name']) {
			$printString.= "\033[1;30m" . $var . "\033[0m";
	}
	elseif($type === $string['name']) {
		$printString.= "\033[1;32m'" . $var . "'\033[0m";
	}
	elseif($type === $array['name']) {
		if(empty($var)) {
			$printString.= 'array()';
		}
		else {
		$printString.= 'array('."\n";

		$nameMaxLength = F::_call('array_max_length', array(array_keys($var)));
		foreach($var as $key=>&$value) {
			$printString.= str_repeat($indentType, $indent+1) . $funcName($key, 'span');
			if($nameMaxLength !== null) {
				if(strlen($key) < $nameMaxLength) {
					$printString.= F::_call('string_add_spaces', array($key, $nameMaxLength));
				}
			}
			$printString.= ' => ';
			$printString.= $funcName($value, 'span', $indent+1);
			$printString.= ','."\n";
		}

		$printString.= str_repeat($indentType, $indent).')';
		}
	}
	elseif($type === $object['name']) {
		$className = get_class($var);
		$printString.= "\033[1;37m" . 'class ' . "\033[0m" . $className.' {'."\n";

		foreach((array)$var as $key=>$value) {
			if(strpos($key, '*') === 1) { //TODO тут есть не печатный 2 пробела
				$visibility = "\033[1;37m" . '#' . "\033[0m";
				$key = str_replace('*', '', $key);
			}
			elseif(strpos($key, $className) === 1) { //TODO тут есть не печатный 2 пробела
				$visibility = "\033[1;37m" . '-' . "\033[0m";
				$key = str_replace($className, '', $key);
			}
			else
				$visibility = "\033[1;37m" . '+' . "\033[0m";

			$printString.= ''.str_repeat($indentType, $indent+1).$visibility.' '.'$'.$key.' = ';
			$printString.= $funcName($value, 'span', $indent+1);
			$printString.= ';'."\n";
		}

		$printString.= ''.str_repeat($indentType, $indent).'}';
	}
	elseif($type === $NULL['name']) {
		$printString.= "\033[1;37mNULL\033[0m";
	}
	return $printString;
}
