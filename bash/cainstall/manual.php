#!/usr/bin/env php
<?php

#$programs = array();


$testError = '';




# http://www.linuxrussia.com/touchpad-settings-ubuntu.html
# https://wiki.archlinux.org/index.php/Touchpad_Synaptics_(%D0%A0%D1%83%D1%81%D1%81%D0%BA%D0%B8%D0%B9)
cmdOutTest('cat /usr/share/X11/xorg.conf.d/*synaptics.conf | grep \'Option "PalmDetect"\'', ' "1"');
cmdOutTest('cat /usr/share/X11/xorg.conf.d/*synaptics.conf | grep \'Option "PalmMinWidth"\'', ' "1"');
cmdOutTest('cat /usr/share/X11/xorg.conf.d/*synaptics.conf | grep \'Option "PalmMinZ"\'', ' "70"');

cmdOutTest('cat /usr/share/X11/xorg.conf.d/*synaptics.conf | grep \'Option "TouchpadOff"\'', ' "1"');



cmdOutTest('cat ~/.bashrc | grep \'^export PATH=$PATH:/var/www/palezno/bash/\'', 'export PATH=$PATH:/var/www/palezno/bash/');

# http://practicalrambler.blogspot.com/2017/02/xfce-how-to-execute-shell-scripts-from.html
cmdOutTest('cat ~/.config/xfce4/xfconf/xfce-perchannel-xml/thunar.xml | grep \'misc-exec-shell-scripts-by-default\'', 'true');

installedTest('git');
isLinkTest($_SERVER['HOME'] . '/.gitconfig',     '/var/www/palezno/git/.gitconfig');
isFileTest($_SERVER['HOME'] . '/.gitconfiguser');

installedTest('vim');
installedTest('vim-gnome');
isLinkTest($_SERVER['HOME'] . '/.vim', '/var/www/palezno/vim/.vim');
isLinkTest($_SERVER['HOME'] . '/.vimrc', '/var/www/palezno/vim/.vimrc');

installedTest('php');
installedTest('php7.0-cli');
cmdOutTest('cat /etc/php/7.0/cli/php.ini | grep \'^auto_prepend_file\'', '/var/www/palezno/php/F.php');

installedTest('openssh-server');
installedTest('sshfs');
isDirTest($_SERVER['HOME'] . '/sshfs');
installedTest('htop');
installedTest('atop');
installedTest('traceroute');
installedTest('screen');
installedTest('curl');








installedTest('apache2');
installedTest('libapache2-mod-php');
cmdOutTest('cat /etc/php/7.0/apache2/php.ini | grep \'^auto_prepend_file\'', '/var/www/palezno/php/F.php');
cmdOutTest('cat /etc/apache2/ports.conf | grep \'^Listen\'',      'Listen 8080');
cmdOutTest('cat /etc/apache2/ports.conf | grep ssl_modul -A1',    "\n\t" . 'Listen 8443');
cmdOutTest('cat /etc/apache2/ports.conf | grep mod_gnutls.c -A1', "\n\t" . 'Listen 8443');

isLinkTest('/etc/apache2/mods-enabled/rewrite.load', '../mods-available/rewrite.load');
isLinkTest('/etc/apache2/mods-enabled/vhost_alias.load', '../mods-available/vhost_alias.load');

isLinkTest('/etc/apache2/sites-enabled/multi_default.conf', '/var/www/palezno/apache/multi_default.conf');
cmdOutTest('ls /etc/apache2/sites-enabled', 'multi_default.conf');




installedTest('nginx');
installedTest('php-fpm');
# change user in /etc/nginx/nginx.conf
# change user in /etc/php/7.0/fpm/pool.d/www.conf
cmdOutTest('cat /etc/php/7.0/fpm/php.ini | grep \'^auto_prepend_file\'', '/var/www/palezno/php/F.php');
isLinkTest('/etc/nginx/sites-enabled/multi_default.conf', '/var/www/palezno/nginx/multi_default.conf');
cmdOutTest('ls /etc/nginx/sites-enabled', 'multi_default.conf');

#installedTest('dnsmasq');
installedTest('bind9');
isFileTest('/etc/bind/ll.empty');
cmdOutTest('cat /etc/bind/ll.empty | grep \'^\*	IN\'', '*	IN	A	127.0.0.1');
cmdOutTest('cat /etc/bind/ll.empty | grep  \'^@	IN\'', '@	IN	A	127.0.0.1');
cmdOutTest('cat /etc/bind/named.conf.default-zones | grep -A3 \'^zone "ll"\'',  'zone "ll" {' . "\n\t" . 'type master;' . "\n\t" . 'file "/etc/bind/ll.empty";' . "\n" . '};');
cmdOutTest('cat /etc/bind/named.conf.options | grep  \'	forwarders\'',  'forwarders ');
cmdOutTest('cat /etc/resolvconf/resolv.conf.d/head | grep  \'^nameserver 127.0.0.1\'',  '127.0.0.1');
cmdOutTest('cat /etc/resolv.conf | grep  \'^nameserver 127.0.0.1\'',  '127.0.0.1');
cmdOutTest('cat /etc/dhcp/dhclient.conf | grep  \'^prepend domain-name-servers \'',  '127.0.0.1');


installedTest('mysql-server');

installedTest('php-mysql');
installedTest('php-xml');
installedTest('php-gd');
installedTest('php-curl');
installedTest('php-geoip');
#installedTest('php-mcrypt');
installedTest('php-xdebug');
installedTest('php-xhprof');







installedTest('chromium-browser');
installedTest('libreoffice');
installedTest('gimp');
installedTest('wine');
installedTest('network-manager-openvpn');
installedTest('network-manager-openvpn-gnome');
installedTest('xscreensaver');
installedTest('smplayer');
installedTest('vlc');

installedTest('baobab');
installedTest('gnome-disk-utility');
installedTest('unar');
installedTest('openjdk-7-jre');
installedTest('virtualbox');
installedTest('skype');
installedTest('tree');









echo "\n\n\n" . $testError;


/*
* TESTS
*/

function isLinkTest($link, $target) {
	global $testError;
	if(is_link($link)) {
		if(($t = readlink($link)) === $target) {
			echo '.';
		}
		else {
			echo 'F';
			$testError.= 'Wron Target: "' . $target . '" != "' . $t . '"' . "\n";
		}
	}
	else {
		echo 'F';
		$testError.= 'Is NOT Link: "' . $link . '"' . "\n";
	}
}

function isDirTest($path) {
	global $testError;
	if(is_dir($path)) {
		echo '.';
	}
	else {
		echo 'F';
		$testError.= 'Is NOT Dir: "' . $path . '"' . "\n";
	}
}

function isFileTest($path) {
	global $testError;
	if(is_file($path)) {
		echo '.';
	}
	else {
		echo 'F';
		$testError.= 'Is NOT File: "' . $path . '"' . "\n";
	}
}

function cmdOutTest($cmd, $needle, $regexp=false) {
	global $testError;

	$commandOut = caexec($cmd)[0];

	if(!$regexp && strpos($commandOut, $needle) !== false) {
		echo '.';
	}
	elseif($regexp && preg_match('/' . $needle . '/', $commandOut)) {
		echo '.';
	}
	else {
		echo 'F';
		$testError.= 'Grep fail: "' . $cmd . '" "' . $commandOut . '" != "' . $needle . '"' . "\n";
	}
}

function installedTest($program) {
	global $testError;
	if(installed($program)) {
		echo '.';
	}
	else {
		echo 'F';
		$testError.= 'Not instaled: "' . $program . '"' . "\n";
	}
}




function installed($programm) {
	if(caexec('dpkg -s ' . $programm )[1] === 0) {
		return true;
	}
	else {
		return false;
	}
}

function caexec($cmd) {
	$cmd = str_replace('|', ' 2>&1 |', $cmd);
	$cmd.= ' 2>&1';

	exec($cmd, $out, $code);
	$out = implode("\n", $out);

	return array($out, $code);
}
