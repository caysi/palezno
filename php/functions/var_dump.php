<?php
namespace functions;
function var_dump($arguments) {
	foreach($arguments as $argument) {
		echo '<hr><xmp>';
		\var_dump($argument);
		echo '</xmp><hr>';
	}
}
