<?php
function caysi_renderBacktrace(&$backtrace, $killFuncName=NULL) {
	$count = 0;
	$libDir = dirname(dirname(dirname(__FILE__)));
	foreach($backtrace as $key=>&$bt) {
		if(strpos($bt['file'], $libDir.'/') !== false) {
			$count++;
			if(isset($backtrace[$key+1]) && strpos($backtrace[$key+1]['file'], $libDir.'/') === false) {
				$nextF = &$backtrace[$key+1]['function'];
				if($nextF === '_call')
					$count++;
				elseif($nextF === '__call' || $nextF === '__callStatic')
					$count+= 2;
			}
		}
		if($killFuncName === $bt['function'])
			$count++;

		$bt['file'] = str_replace($_SERVER['DOCUMENT_ROOT'], '.', $bt['file']);
	}
	$backtrace = array_slice($backtrace, $count);
	unset($count, $key);

	$content = '<table border="1">';
	foreach($backtrace as $key=>&$bt) {
		$content.= '<tr>';
		$content.= '<td>'.$key.'</td>'; //todo delete
		$content.= '<td>'.$bt['file'].'</td>';
		$content.= '<td>'.$bt['line'].'</td>';
		$content.= '<td>'.$bt['function'].'</td>';
		/*
		if(isset($bt['args']))
			$content.= '<td><xmp>'.var_export($bt['args'], true).'</xmp></td>';
		else
			$content.= '<td>NULL</td>';/**/
		$content.= '</tr>';
	}
	$content.= '</table>';
	return $content;
}