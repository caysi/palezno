function showBacktraceVars(obj) {
	var backtraceContent = obj.parentNode.nextSibling.getElementsByTagName('div')[0];
	if(backtraceContent.style.display == 'none') {
		backtraceContent.style.display = 'block';
	}
	else {
		backtraceContent.style.display = 'none';
	}
}
