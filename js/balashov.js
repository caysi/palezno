var content = '';

function getUrlsFromPage(page) {
	var response = sendAjax('http://business.ubg.ua/balasovshou/0/p'+page+'/');
	var re = /topic\_f?point.*\r\n.*src=\"([^\"]*)\".*\r\n.*href=\"([^\"]*)\" >([^><]*)</g;
	while ( (found = re.exec(response)) != null) {
		var text = '<br>';
		/*text+= '<b>Name:</b> '+found[3];*/
		text+= '<img src="'+found[1]+'" alt="" width="130" height="87" />';
		text+= '<a onclick="getVideoUrl(\''+found[2]+'\', this)">SHOW URL</a>';
		content = text+content;
	}
content = '<hr>'+content;
}
function getVideoUrl(videoPageUrl, obj) {
	var response = sendAjax(videoPageUrl);
	var re = /video_desc.*\r\n.*src=\"([^\"]*)\"/g;
	var found = re.exec(response);
	obj.innerHTML = '<a href="'+found[1]+'">URL</a>';
}

for (var i = 1; i <= 4; i++) {
	getUrlsFromPage(i);
}

var body = document.getElementsByTagName('BODY')[0];
body.innerHTML = content;
body.style.backgroundColor = "#DDD";
body.style.backgroundImage = "none";
