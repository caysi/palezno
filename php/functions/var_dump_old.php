<?php
function caysi_var_dump_old() {
	$name = 'var_dump';
	$args = func_get_args();
	echo "\n".'<hr><xmp>'."\n";
	eval(F::_call('evalStr', array($name, $args)));
	echo '</xmp><hr style="color: red;">'."\n";
}
