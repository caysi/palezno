###Ssl generate
	name='local'
	openssl genrsa -des3 -out ${name}.key 2048
	openssl req -new -key ${name}.key -out ${name}.csr
	# снять пароль
	#cp ${name}.key ${name}.key.pass
	#openssl rsa -in ${name}.key.pass -out ${name}.key
	openssl x509 -req -in ${name}.csr -signkey ${name}.key -out ${name}.crt

You are about to be asked to enter information that will be incorporated
into your certificate request.
What you are about to enter is what is called a Distinguished Name or a DN.
There are quite a few fields but you can leave some blank
For some fields there will be a default value,
If you enter '.', the field will be left blank.
-----
Country Name (2 letter code) [AU]:US
State or Province Name (full name) [Some-State]:New York
Locality Name (eg, city) []:NYC
Organization Name (eg, company) [Internet Widgits Pty Ltd]:Awesome Inc
Organizational Unit Name (eg, section) []:Dept of Merriment
Common Name (e.g. server FQDN or YOUR name) []:example.com
Email Address []:webmaster@awesomeinc.com
***

###[Enable in nginx config](https://www.digitalocean.com/community/tutorials/how-to-create-a-ssl-certificate-on-nginx-for-ubuntu-12-04)
	listen *:443 ssl;

	ssl on;
	ssl_certificate     /var/www/certs/local.crt;
	ssl_certificate_key /var/www/certs/local.key;


	fastcgi_param HTTPS on; # Для php-fpm

###[Enable in apache config](http://www.8host.com/blog/sozdanie-ssl-sertifikata-na-apache-v-ubuntu-14-04/)
a2enmod ssl
