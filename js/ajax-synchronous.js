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

