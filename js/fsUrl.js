var body = document.getElementsByTagName('BODY')[0];
/*var body = document.getElementsByClassName('l-header__bg-c')[0];/**/

var hostName = location.protocol+'//'+location.host;
var playList = FS_APLAYER_CONFIG.playlist;
var content = '';

content+= '<table>';
for(var i in playList) {
	content+= '<tr>';
	content+= '<td>'+hostName+playList[i].url+'</td>';
	content+= '</tr>';
}
content+= '</table>';
body.innerHTML = content;
body.style.backgroundColor = "white";
body.style.backgroundImage = "none";
