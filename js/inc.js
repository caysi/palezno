var scriptName = 'dev';
var scriptPath = 'raw.githubusercontent.com/caysi/palezno/master/js';
var tagId = 'include_script';
var head = document.getElementsByTagName('HEAD')[0];
var nevJs = document.createElement('script');

nevJs.src = location.protocol+'//'+scriptPath+'/'+scriptName+'.js?time='+(new Date().getTime());
nevJs.id = tagId;
head.appendChild(nevJs);

var killElemnt = document.getElementById(tagId);
killElemnt.parentElement.removeChild(killElemnt);

delete tagId; delete head; delete nevJs; delete killElemnt;
