if(window.getSelection().toString() === '') {
	alert('Select text');
}
else {
	var qrCode = document.createElement('div');
	document.body.appendChild(qrCode);
	qrCode.outerHTML = '<div id="qrCode" style="background-color: rgba(0,0,0,0.7); width: 100%; height: 100%; position: fixed; top: 0; left: 0; z-index: 999999; padding: 20px;" onClick="this.parentNode.removeChild(this)"><div style=" padding: 15px; background-color: grey; border-radius: 10px; display: inline-block;"><img src="https://api.qrserver.com/v1/create-qr-code/?data='+encodeURIComponent(window.getSelection().toString())+'&size=220x220&margin=10" /></div></div>';
}
