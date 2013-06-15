<?php
namespace functions;

function getCliColorStr($string, $foregr = 0, $backgr = 0, $mode = 'normal') {
	$foregroundColors = array(
		0              => '',
		'black'        => '0;30',
		'dark_gray'    => '1;30',
		'red'          => '0;31',
		'light_red'    => '1;31',
		'green'        => '0;32',
		'light_green'  => '1;32',
		'brown'        => '0;33',
		'yellow'       => '1;33',
		'blue'         => '0;34',
		'light_blue'   => '1;34',
		'magenta'      => '0;35',
		'light_purple' => '1;35',
		'cyan'         => '0;36',
		'light_cyan'   => '1;36',
		'light_gray'   => '0;37',
		'white'        => '1;37',
	);
	$backgroundColors = array(
		0         => '',
		'black'   => '40',
		'red'     => '41',
		'green'   => '42',
		'yellow'  => '43',
		'blue'    => '44',
		'magenta' => '45',
		'cyan'    => '46',
		'white'   => '47',
	);
	$characters = array (
		'normal'    => 0,// = 'Normal Characters',
		'bold'      => 1,// = 'Bold Characters',
		'underline' => 4,// = 'Underlined Characters',
		'blinking'  => 5,// = 'Blinking Characters',
		'reverse'   => 7,// = 'Reverse video Characters',
	);

	$fColor = $foregroundColors[$foregr];
	$bColor = $backgroundColors[$backgr];
	$cMode = $characters[$mode];

	if($fColor !== '' && $bColor !== '')
		$bColor = ';'.$bColor;
	if($fColor !== '' || $bColor !== '')
		$cMode.= ';';
	$colorStr =  "\e[".$cMode.$fColor.$bColor."m".$string."\e[0m";
	return $colorStr;
}
