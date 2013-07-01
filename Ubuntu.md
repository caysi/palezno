####Отключение гостевого сеанса
Дописать в фаил /etc/lightdm/lightdm.conf
	allow-guest=false

####Включение X11 Forvarding
######Серевер
	sudo apt-get install openssh-server
Изменить /etc/ssh/sshd_config   
	X11Forwarding yes
######Клиен
Изменить /etc/ssh/ssh_config   
	ForwardX11 yes
	ForwardX11Trusted yes


####Вернуть полосы прокрутки
sudo apt-get remove overlay-scrollbar liboverlay-scrollbar3-0.2-0 liboverlay-scrollbar-0.2-0
	Новые полосы прокрутки: 
sudo apt-get install overlay-scrollbar liboverlay-scrollbar3-0.2-0 liboverlay-scrollbar-0.2-0

####Русские буквы tty
sudo dpkg-reconfigure console-setup
Выбираем UTF-8 -> VGA
Дописать в /etc/rc.local перед exit 0
setupcon

####Change layout XFCE
apt-get istall xfce4-xkb-plugin
Add to panel
Select Russial(DOS)

####Не совпадение времени с Windows
Change /etc/default/rcS:
UTC=no

####Proxy
/etc/bash.bashrc
export http_proxy=http://username:password@proxyserver.net:port/
export ftp_proxy=http://username:password@proxyserver.net:port/

####Mod Rewrite
sudo ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
sudo /etc/init.d/apache2 restart

####PHP cURL
sudo apt-get install curl libcurl3 libcurl3-dev php5-curl php5-mcrypt
sudo /etc/init.d/apache2 restart

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



####Skype
[хз](https://help.ubuntu.com/community/Skype)
sudo add-apt-repository "deb http://archive.canonical.com/ $(lsb_release -sc) partner"
sudo apt-get update && sudo apt-get install skype

####phpStorn
http://www.jetbrains.com/phpstorm/
Disable autosave
settings / General / confirm application exit : checked
settings / General / confirm application exit : save file on frame deactivation : unchecked
settings / General / confirm application exit : save files automatically : unchecked
settings / Editor / Editor tabs / mark modified tabs with asterisk : checked
Crack
rm ~/.WebIde50/config/eval/PhpStorm5.evaluation.key
kill all "evl" in ~/.WebIde50/config/options/options.xml <property name="evlsprt3.5" value="13" />



git-core
crome


network-manager-openvpn

Libre
gimp
samba
vbox
wine



####Создание скрытого супер пользователя
http://archlinux.org.ru/forum/topic/4414/?page=1
http://myubuntu.ru/faq/kak-sozdat-sudo-polzovatelya-v-ubuntu

useradd -d /home/HIDDEN_USER -m HIDDEN_USER
passwd HIDDEN_USER
usermod -u 999 HIDDEN_USER

adduser HIDDEN_USER sudo

####disable powersave
setterm -powersave off -blank 0


####sshfs
apt-get install sshfs
usermod -a -G fuse [user_name]
sshfs -o workaround=rename -p 8022 baholdin@baholdin.dev.easydate.biz:/var/www/vhosts/baholdin.dev.easydate.biz/htdocs/ /mnt/cupid
ssh -p 8022 -l baholdin baholdin.dev.easydate.biz
fusermount -u /mnt/cupid

####xfce two monitors
http://www.prolinux.org/node/172
xrandr --output HDMI1 --right-of VGA1 --primary
http://vasilisc.com/multiple-monitors-xfce
