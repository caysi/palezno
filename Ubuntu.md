###Disable guest session
Insertin file `/etc/lightdm/lightdm.conf` `allow-guest=false`
***

###X11 Forvarding
######Server

	sudo apt-get install openssh-server

Change `/etc/ssh/sshd_config`

	X11Forwarding yes

######Client
Change `/etc/ssh/ssh_config`

	ForwardX11 yes
	ForwardX11Trusted yes
***

###Return scroll bar in 12.04

	sudo apt-get remove overlay-scrollbar liboverlay-scrollbar3-0.2-0 liboverlay-scrollbar-0.2-0

#####New scroll bar:

	sudo apt-get install overlay-scrollbar liboverlay-scrollbar3-0.2-0 liboverlay-scrollbar-0.2-0
***

###Russian letters tty

	sudo dpkg-reconfigure console-setup

- Choosing UTF-8 -> VGA  
- Insert `/etc/rc.local` before `exit 0` `setupcon`
***

###Change layout XFCE

	apt-get istall xfce4-xkb-plugin

- Add to panel
- Select Russial(DOS)
***

###Time in Windows and Linux
Change `/etc/default/rcS` `UTC=no`
***

###Proxy
`/etc/bash.bashrc`

	export http_proxy=http://[username]:[password]@[proxyserver.net]:[port]/
	export ftp_proxy=http://[username]:[password]@[proxyserver.net]:[port]/
***

###LAMP

	sudo apt-get install lamp-server^
	sudo a2enmod rewrite
	
	cd /etc/apache2/sites-available/[yourhost]

	<VirtualHost *:80>
		DocumentRoot /var/www/[yourhost]/trunk
		ServerName [yourhost].local
		ServerAlias www.[yourhost].local
		ErrorLog /var/www/[yourhost]/logs/error_log
		TransferLog /var/www/[yourhost]/logs/access_log
		<Directory "/var/www/[yourhost]/trunk">
			allow from all 
			Options +Indexes
		</Directory>
	</VirtualHost>

	/etc/hosts
	sudo a2ensite [yourhost]
	sudo /etc/init.d/apache2 reload
	
####Mod Rewrite

	sudo ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
	sudo /etc/init.d/apache2 restart

####PHP cURL

	sudo apt-get install curl libcurl3 libcurl3-dev php5-curl php5-mcrypt
	sudo /etc/init.d/apache2 restart

####Nginx + Apache or PHP-FPM
	sudo apt-get install nginx php5-fpm
`/etc/apache2/ports.conf`
######Change ports
	80  => 8080
	433 => 8433
######Nginx one config to many proects
	server_name _;  # хитрый ключик, обозначающий, что этот конфиг применим для любого сайта
	set $vhost $host;  # В sathost будет лежать имя сайта. Так же должна называться директрия с сайтом
	# убираем www
	if ( $host ~ ^(www\.)?(.+)\.local$ ) {
		set $vhost $2;
	}
	root   /var/www/all/$vhost; # конень сайта определяем автоматически
	index index.php index.html index.htm; # в каком порядке искать индексные файлы
######PHP-FPM
`/etc/php5/fpm/php.ini` `cgi.fix_pathinfo = 0`  
`/etc/php5/fpm/pool.d/www.conf` `security.limit_extensions = .php .php3 .php4 .php5`

- change users if need
- reboot services

***

###Skype [bug](https://help.ubuntu.com/community/Skype)

	sudo add-apt-repository "deb http://archive.canonical.com/ $(lsb_release -sc) partner"
	sudo apt-get update && sudo apt-get install skype
***

###Need Insall
- git-core
- vim
- vim-gnome
- chromium-browser
- Libre
- gimp
- samba
- vbox
- wine
- network-manager-openvpn
- htop

***

###Create a hidden super user [1](http://archlinux.org.ru/forum/topic/4414/?page=1) [2] (http://myubuntu.ru/faq/kak-sozdat-sudo-polzovatelya-v-ubuntu)

	useradd -d /home/[HIDDEN_USER] -m [HIDDEN_USER]
	passwd [HIDDEN_USER]
	usermod -u 999 [HIDDEN_USER]

	adduser [HIDDEN_USER] sudo
***

###disable powersave in tty

	setterm -powersave off -blank 0
***

###sshfs

	apt-get install sshfs
	usermod -a -G fuse [user_name]
	sshfs -o workaround=rename -p [port] [user]@[server]:[foldeer_on_server] [folder_to_mount]
	ssh -p [port] -l [user] [server]
	fusermount -u [folder_to_mount]
***

###[xfce two monitors](http://www.prolinux.org/node/172) [Xfce>4.11](http://vasilisc.com/multiple-monitors-xfce)

	xrandr --output HDMI1 --right-of VGA1 --primary
***

###[AutoMoutn ntfs](http://ubuntolog.ru/avtomaticheskoe-montirovanie-razdelov-s-ntfs-pri-zagruzke-ubuntu.html)

	sudo blkid
edit `/etc/fstab`:

	UUID=<uuid>           <mount_path>    <type>  <options> <dump> <pass>
	UUID=363C991F3C98DAE7 /media/windows/ ntfs-3g users,defaults 0 0
***

###[VBox boot from usb](http://www.upubuntu.com/2012/11/how-to-configure-virtualbox-42x-to-boot.html)
	VBoxManage internalcommands createrawvmdk -filename ~/.VirtualBox/usb.vmdk -rawdisk /dev/sdb1
