<?php
namespace functions;

/*function var_dump() {
	$name = '\var_dump';
	$args = func_get_args();
	echo "\n".'<hr><xmp>';
	eval(\F::evalStr($name, $args));
	echo '</xmp><hr>'."\n";
}*/

function var_dump(&$var) { //TODO сделать много параметров
	echo my_var_dump($var);
}
function my_var_dump(&$var, $tag = 'pre', $indent=0) {
	// Params
	$indentType = '    ';
	$boolean  = array('name' => 'boolean',  'colorT' => 'green', 'colorF' => 'red');
	$integer  = array('name' => 'integer',  'color' => 'blue');
	$float    = array('name' => 'double',   'color' => 'grey');
	$string   = array('name' => 'string',   'color' => 'green');
	$array    = array('name' => 'array',    'color' => 'blue');
	$object   = array('name' => 'object',   'color' => 'blue');
	$resource = array('name' => 'resource', 'color' => 'blue');
	$NULL     = array('name' => 'NULL',     'color' => 'yellow');
	// END Params

	$indentPrint = '';
	for($i=0;$i<$indent;$i++) {
		$indentPrint.= $indentType;
	}

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
		$printString.= '<'.$tag.' style="color: '.$string['color'].';">\''.$var.'\'</'.$tag.'>';
	}
	elseif($type === $array['name']) {
		$printString.= '<'.$tag.'>array(</'.$tag.'>';
		foreach ($var as $key=>&$value) {
			$printString.= '<pre>'.$indentPrint.'['.my_var_dump($key, 'span').'] => ';
			$printString.= my_var_dump($value, 'span', $indent+1);
			$printString.= ',</pre>';
		}
		$printString.= '<pre>'.$indentPrint.')</pre>'; //FIX надо на 1 меньше отступ
	}
	elseif($type === $NULL['name']) {
		$printString.= '<'.$tag.' style="color: '.$NULL['color'].';">NULL</'.$tag.'>';
	}
	return $printString;
}/**/

/*echo '<style>pre {margin: 0;}</style>';
$bool= FALSE;
$true= TRUE;
$int = 1234;
$floa= 12.4;
$str = 'String';
$arr = array(
			'000',
			24=>'sdfasd',
			'green' => 12345,
			array(
				'bool'  => FALSE,
				'true'  => TRUE,
				'int'   => 1234,
				'floa'  => 12.4,
				'str'   => 'String',
				'arr'   => array(
							'000',
							24=>'sdfasd',
							'green' => 12345
						),
				'obj'   => new Exception('asdfasdfsad'),
				//$resource => array('name' => 'resource', 'color' => 'blue'),
				'null'  => NULL,
			)
		);
$obj = new Exception('asdfasdfsad');
//$resource = array('name' => 'resource', 'color' => 'blue');
$null= NULL;


F::var_dump($bool);
echo '<xmp>'; var_dump($bool); echo '</xmp><hr>';
F::var_dump($true);
echo '<xmp>'; var_dump($true); echo '</xmp><hr>';
F::var_dump($int);
echo '<xmp>'; var_dump($int); echo '</xmp><hr>';
F::var_dump($floa);
echo '<xmp>'; var_dump($floa); echo '</xmp><hr>';
F::var_dump($str);
echo '<xmp>'; var_dump($str); echo '</xmp><hr>';
F::var_dump($arr);
echo '<xmp>'; var_dump($arr); echo '</xmp><hr>';
F::var_dump($obj);
echo '<xmp>'; var_dump($obj); echo '</xmp><hr>';
F::var_dump($null);
echo '<xmp>'; var_dump($null); echo '</xmp><hr>';*/
