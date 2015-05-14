function addLoadEvent(func) {
	var oldonload = window.onload;
	if (typeof window.onload != 'function') {
		window.onload = func;
	} else {
		window.onload = function() {
			oldonload();
			func();
		}
	}
}

document.getElementsByClassName = function(name) {
	var results = new Array();
	var elems = document.getElementsByTagName("*");
	for (var i=0; i<elems.length; i++) {
		if (elems[i].className.indexOf(name) != -1) {
			results[results.length] = elems[i];
		}
	}
	return results;
};

function fadeUp(element,red,green,blue) {
	if (element.fade) {
		clearTimeout(element.fade);
	}
	if (red == 255 && green == 255 && blue == 255) {
		element.style.backgroundColor = "transparent";
		return;
	}
	var newred = red + Math.ceil((255 - red)/10);
	var newgreen = green + Math.ceil((255 - green)/10);
	var newblue = blue + Math.ceil((255 - blue)/10);
	element.style.backgroundColor = "rgb("+newred+","+newgreen+","+newblue+")";
	element.fade = setTimeout(function() { fadeUp(element,newred,newgreen,newblue) },100);
}

function fadeUpErrors() {
	var errors = document.getElementsByClassName("error");
	for (var i=0 ; i<errors.length; i++) {
		fadeUp(errors[i],221,136,0);
	}
}

addLoadEvent(fadeUpErrors);

function fadeUpFeedback() {
	var feedback = document.getElementsByClassName("feedback");
	for (var i=0 ; i<feedback.length; i++) {
		fadeUp(feedback[i],136,170,17);
	}
}

addLoadEvent(fadeUpFeedback);