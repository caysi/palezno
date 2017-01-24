var title   = document.title;
var url     = window.location.href;
var favicon = document.querySelector('link[rel="shortcut icon"]');
if(favicon) {
	favicon = favicon.href;
}
else {
	favicon = window.location.origin + '/favicon.ico';
}

var link = 'http://js.mainb.info';
document.location = link + '/killBody.html?url=' + encodeURIComponent(url) + '&title=' + encodeURIComponent(title) + '&favicon=' + encodeURIComponent(favicon)
//document.location = 'javascript:document.write(\'<head><title>' + title + '</title></head><body><a href="' + document.location.toString() + '">Refresh</a><h3>' + title + '</h3></body>\');document.close();'
