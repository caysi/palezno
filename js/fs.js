function getXmlHttpRequest() {
	/*Для оперы, firefox'a, хрома*/
	if (window.XMLHttpRequest) { /*Стандартная функция*/
		try {
			return new XMLHttpRequest();
		}
		catch (e){}
	}
	/*Для ie*/
	else if (window.ActiveXObject) {
		try {
			return new ActiveXObject('Msxml2.XMLHTTP'); /* Поверка IE 5*/
		}
		catch (e){}
		try {
		return new ActiveXObject('Microsoft.XMLHTTP'); /* Провкерка IE 6*/
		}
		catch (e){}
	}
	return null;
}

function sendAjax(url/*, asinhron*/) { //TODO asinhron
	var asinhron = false; //TODO asinhron
	var req;

	req = getXmlHttpRequest();
	req.open('GET', url, asinhron);
	req.send(null);
	if (req.readyState == 4) {
		var response = req.responseText;
		return response;
	}
	return false;
}

var item_id = eval("("+document.getElementById('page-item-file-list').firstElementChild.rel+")").item_id;

function getFolderContent(folder) {
	var url = '/item/i'+item_id+'?ajax&id='+item_id+'&download=1&view=1&blocked=0&folder='+folder;
	var response = sendAjax(url);
	var folders = '';
	//alert(response);
	var re  = /parent_id: \'?(\w*)\'?[\s\S]*?\>(.*)\<\//g;
	var re2 = /a href=\"(.[^ ]*play\&file[^ ]*)\"[\s\S]*?\>(.*)\<\/[\s\S]*?\>(.* .*)\<\/[\s\S]*?/g;
	var reD = /\<.*href=\"([^\"]*)\".*b-file-new__link-material-download/g;
	var found;

	if(re.test(response)) {
		re.lastIndex = 0;
		while ( (found = re.exec(response)) != null) {
			folders+= '<br>-<b>'+found[2]+'</b>';//+found[2];
			folders+= getFolderContent(found[1]);
			//break; //TODO DELETE
		}
	}

	if(re2.test(response)){
		re2.lastIndex = 0;
		while ( (found = re2.exec(response)) != null) {
			download = reD.exec(response)[1];
			folders+= '<br>--<a href='+found[1]+'>V</a>'; // ссылка на страницу
			folders+= ' <a href='+download+'>D</a>'; // Download
			folders+= ' <b>'+found[2]+'</b>'; // название
			folders+= ' '+found[3]; // объем
			folders+= '<br>--'+getFileContent(found[1]); // FLV
		}
	}
	return folders;
}
function getFileContent(url) {
	var response = sendAjax(url);
	var file = new Array();
	var re = /url: \'(.*)\',/;
	var found = re.exec(response);
	return found[1];
}

var HTML = getFolderContent('0');
var body = document.getElementsByTagName('BODY')[0];
body.innerHTML = HTML;
body.style.backgroundColor = "white";
body.style.backgroundImage = "none";
