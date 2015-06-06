var sct = {
	'name': 'dev',
	'dmn': 'raw.githubusercontent.com',
	'path': 'caysi/palezno/master/js',
	'head': document.getElementsByTagName('HEAD')[0],
	'nevJs': document.createElement('script')
};

sct.nevJs.src = location.protocol+'//'+sct.dmn+'/'+sct.path+'/'+sct.name+'.js?time='+(new Date().getTime());
sct.head.appendChild(sct.nevJs);
sct.head.removeChild(sct.nevJs);

delete sct;

