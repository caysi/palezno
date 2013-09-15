var body = document.getElementsByTagName('BODY')[0];
/*var body = document.getElementsByClassName('l-header__bg-c')[0];/**/

var hostName = location.protocol+'//'+location.host;
var playList = FS_FLOWPLAYER_CONFIG.playlist;
var content = '';
for(var i in playList) {
    content+= '<h1>'+i+') '+hostName+playList[i].url+'</h1>';
}
body.innerHTML = content;
body.style.backgroundColor = "white";
body.style.backgroundImage = "none";
