<?php

function caysi_color_var_dump(&$var, $tag = 'pre', $indent=0) { //TODO color_...
	if($indent > 5)
		return '<'.$tag.' style="color: red;">{...}</'.$tag.'>';

	$funcName = __FUNCTION__;
	// Params
	//$preStyle = ' margin: 1px 0;';
	$indentType = '<span style="border-left: solid #ccc 1px;"> </span>   '; // 4 пробела
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
			$printString.= '<'.$tag.' style="color: '.$boolean['colorT'].';"><b>TRUE</b></'.$tag.'>';
		else
			$printString.= '<'.$tag.' style="color: '.$boolean['colorF'].';"><b>FALSE</b></'.$tag.'>';
	}
	elseif($type === $integer['name']) {
		$printString.= '<'.$tag.' style="color: '.$integer['color'].';">'.$var.'</'.$tag.'>';
	}
	elseif($type === $float['name']) {
		$printString.= '<'.$tag.' style="color: '.$float['color'].';">'.$var.'</'.$tag.'>';
	}
	elseif($type === $string['name']) {
		$printString.= '<'.$tag.' style="color: '.$string['color'].';">\''.htmlspecialchars($var).'\'</'.$tag.'>';
	}
	elseif($type === $array['name']) {
		if(empty($var)) {
			$printString.= '<'.$tag.'><b>array</b>()</'.$tag.'>';
		}
		else {
		$printString.= '<'.$tag.'><b>array</b>('."\n";

		$nameMaxLength = F::_call('array_max_length', array(array_keys($var)));
		foreach($var as $key=>&$value) {
			$printString.= str_repeat($indentType, $indent+1) . $funcName($key, 'span');
			if($nameMaxLength !== null) {
				if(strlen($key) < $nameMaxLength) {
					$printString.= '<span style="border-bottom: solid #ccc 1px;">' . F::_call('string_add_spaces', array($key, $nameMaxLength)) . '</span>';
				}
			}
			$printString.= ' => ';
			$printString.= $funcName($value, 'span', $indent+1);
			$printString.= ','."\n";
		}

		$printString.= str_repeat($indentType, $indent).')</'.$tag.'>';
		}
	}
	elseif($type === $object['name']) {
		$className = get_class($var);
		$printString.= '<'.$tag.'><b>class</b> '.$className.' {'."\n";

		foreach((array)$var as $key=>$value) {
			if(strpos($key, '*') === 1) { //TODO тут есть не печатный 2 пробела
				$visibility = '<b>#</b>';
				$key = str_replace('*', '', $key);
			}
			elseif(strpos($key, $className) === 1) { //TODO тут есть не печатный 2 пробела
				$visibility = '<b>-</b>';
				$key = str_replace($className, '', $key);
			}
			else
				$visibility = '<b>+</b>';

			$printString.= ''.str_repeat($indentType, $indent+1).$visibility.' '.'$'.$key.' = ';
			$printString.= $funcName($value, 'span', $indent+1);
			$printString.= ';'."\n";
		}

		$printString.= ''.str_repeat($indentType, $indent).'}</'.$tag.'>';
	}
	elseif($type === $NULL['name']) {
		$printString.= '<'.$tag.' style="color: '.$NULL['color'].';"><b>NULL</b></'.$tag.'>';
	}
	elseif($type === $resource['name']) {
		$printString.= '<'.$tag.' style="color: '.$resource['color'].';">'.$var.'</'.$tag.'>';
	}
	return $printString;
}
