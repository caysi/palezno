var jsNames = [
	'killElements',
	'killBody',
	'urlQR',
	'textQR',
	'gmuiStyle',
	'view-source'
];

var jsLinks = document.createElement('div');
jsLinks.id = 'loadAllJs';
jsLinks.setAttribute('style', 'z-index: 2147483647; position: fixed; top: 0px; left: 0px; background-color: rgba(0, 0, 0, 0.6); width: 100%; height: 100%; padding: 20px; font: 15pt/1.1 Arial,sans-serif !important');
jsLinks.setAttribute('onClick', 'this.parentNode.removeChild(this)');

var jsLinksInnner = '<div style="background-color: white; border-radius: 10px; display: inline-block; padding: 20px;">';
jsLinksInnner+= '<ul style="list-style: outside none none; margin: 0px; padding: 0px;">';

for(var i in jsNames) {
	jsLinksInnner+= '<li><a href="#" onClick="loadNewJs(\'' + jsNames[i] + '\'); return false;">' + jsNames[i] + '</a></li>';
}

jsLinksInnner+= '</ul>'
jsLinksInnner+= '</div>';

jsLinks.innerHTML = jsLinksInnner;
delete(jsNames, jsLinksInnner, jsLinks);

document.body.appendChild(jsLinks);

function loadNewJs(name) {
	var sct = {
		'name': name,
		'dmn': 'js.mainb.info',
		'path': '',
		'head': document.getElementsByTagName('HEAD')[0],
		'nevJs': document.createElement('script')
	};

	sct.nevJs.src = location.protocol+'//'+sct.dmn+'/'+sct.path+'/'+sct.name+'.js';
	sct.head.appendChild(sct.nevJs);
	sct.head.removeChild(sct.nevJs);

	delete sct;
}

