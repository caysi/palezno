button = null;

document.onmouseover = function(e){
	targ = getTarget(e);
	targ.style.boxShadow = '0 0 10px #00FF00';

	var position = getPosition(targ);

	button = document.createElement('DIV');

	button.style.position = 'absolute';
	button.style.top = (position.top-20)+'px';
	button.style.left = position.left+'px';

	button.style.color = 'red';
	button.style.backgroundColor = 'green';
	button.innerHTML = 'kill_X';
	button.style.zIndex = '9999';

	//targ.insertBefore(button, targ.firstChild);
};
document.onmouseout = function(e){

	targ = getTarget(e);
	targ.style.boxShadow = 'none';

//	targ.removeChild(button);
};
document.onclick = function(e) {
	var element = getTarget(e);
	killAllNotElement(element);
	document.onmouseout = null;
	document.onmouseover = null;
	document.onclick = null;
	getTarget(e).style.boxShadow = 'none';
//	element.removeChild(button);
	return false;
}

function getPosition(element) {
	var top = 0, left = 0;
	do {
		top += element.offsetTop  || 0;
		left += element.offsetLeft || 0;
		element = element.offsetParent;
	} while(element);

	return {
		top: top,
		left: left
	};
};

function killElement(element) {
	element.parentNode.removeChild(element);
}
function killAllNotElement(element) {
	while(element.previousElementSibling) {
		killElement(element.previousElementSibling);
	}
	while(element.nextElementSibling) {
		killElement(element.nextElementSibling);
	}
	if(element.parentNode.nodeName != 'BODY') {
		killAllNotElement(element.parentNode);
	}
}


function getTarget(e){
//console.log(e);
	if (e.target) { return e.target; }
	else if (e.srcElement) { return e.srcElement; }
}
