var tagId = 'include_script';
var head = document.getElementsByTagName('HEAD')[0];
var nevJs = document.createElement('script');

nevJs.src = 'http://localhost/palezno/js/dev.js?time='+(new Date().getTime());
nevJs.id = tagId;
head.appendChild(nevJs);

var killElemnt = document.getElementById(tagId);
killElemnt.parentElement.removeChild(killElemnt);

delete tagId; delete head; delete nevJs; delete killElemnt;
