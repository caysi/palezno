var hostName = location.protocol+'//'+location.host;
var playList = FS_APLAYER_CONFIG.playlist;

var content = '<table>'
content+= '<tr><td>'+'#EXTM3U'+'</td></tr>';
content+= '<tr><td>'+'#PLAYLIST:'+document.title+'</td></tr>';

for(var i in playList) {
	content+= '<tr><td>'+'#EXTINF:'+playList[i].duration+','+playList[i].fsData.file_name+'</td></tr>';
	content+= '<tr><td>'+hostName+playList[i].url+'</td></tr>';
}
content+= '</table>';

document.body.innerHTML = content;
document.head.innerHTML = '';
