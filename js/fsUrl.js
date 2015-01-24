var body = document.body;

var hostName = location.protocol+'//'+location.host;
var playList = FS_APLAYER_CONFIG.playlist;

var content = '<xmp>#EXTM3U'+"\n";
content+= '#PLAYLIST:'+document.title+"\n";

for(var i in playList) {
	content+= '#EXTINF:'+playList[i].duration+','+playList[i].fsData.file_name+"\n";
	content+= hostName+playList[i].url+"\n";
}
content+= '</xmp>';

body.innerHTML = content;

document.head.innerHTML = '';
