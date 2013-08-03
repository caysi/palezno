<?php
function caysi_debug_backtrace() {
	$backtrace = debug_backtrace();
	echo F::_call('renderBacktrace', array($backtrace));
}
