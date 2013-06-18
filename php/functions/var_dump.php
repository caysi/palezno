<?php
namespace functions;

function var_dump() {
	$args = func_get_args();
	foreach($args as &$var) {
		echo '<hr>';
		echo my_var_dump($var);
	}
	echo '<hr style="color: red;">';
}
function my_var_dump(&$var, $tag = 'pre', $indent=0) {
	// Params
	//$preStyle = ' margin: 1px 0;';
	$indentType = '    '; // 4 пробела
	$boolean  = array('name' => 'boolean',  'colorT' => 'green', 'colorF' => 'red');
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
			$printString.= '<'.$tag.' style="color: '.$boolean['colorT'].';">TRUE</'.$tag.'>';
		else
			$printString.= '<'.$tag.' style="color: '.$boolean['colorF'].';">FALSE</'.$tag.'>';
	}
	elseif($type === $integer['name']) {
		$printString.= '<'.$tag.' style="color: '.$integer['color'].';">'.$var.'</'.$tag.'>';
	}
	elseif($type === $float['name']) {
		$printString.= '<'.$tag.' style="color: '.$float['color'].';">'.$var.'</'.$tag.'>';
	}
	elseif($type === $integer['name']) {
		$printString.= '<'.$tag.' style="color: '.$integer['color'].';">'.$var.'</'.$tag.'>';
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

		foreach($var as $key=>&$value) {
			$printString.= str_repeat($indentType, $indent+1).my_var_dump($key, 'span').' => ';
			$printString.= my_var_dump($value, 'span', $indent+1);
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
				$visibility = '<b>protected</b>';
				$key = str_replace('*', '', $key);
			}
			elseif(strpos($key, $className) === 1) { //TODO тут есть не печатный 2 пробела
				$visibility = '<b>private</b>  ';
				$key = str_replace($className, '', $key);
			}
			else
				$visibility = '<b>public</b>   ';

			$printString.= ''.str_repeat($indentType, $indent+1).$visibility.' '.'$'.$key.' = ';
			$printString.= my_var_dump($value, 'span', $indent+1);
			$printString.= ';'."\n";
		}

		$printString.= ''.str_repeat($indentType, $indent).'}</'.$tag.'>';
	}
	elseif($type === $NULL['name']) {
		$printString.= '<'.$tag.' style="color: '.$NULL['color'].';"><b>NULL</b></'.$tag.'>';
	}
	return $printString;
}
