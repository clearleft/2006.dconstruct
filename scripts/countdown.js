function decrement(unit) {

	if (!document.getElementById && !document.getElementById(unit)) return;

	var amount = parseInt(document.getElementById(unit).lastChild.nodeValue,10);

	amount--;

	if (amount == -1) {
		
		switch(unit) {

			case "seconds":

				if (!blastOff()) {
					decrement("minutes");
					amount = 59;
				} else {
					amount = 0;
				}

			break;

			case "minutes":

				decrement("hours");
				amount = 59;

			break;

			case "hours":

				decrement("days");
				amount = 23;

			break;

			case "days":

				amount = 0;

			break;

		}
	}
	if (amount < 10 ) {
		amount = "0"+amount;
	}
	if (unit != "seconds") {
		amount+= ":";
	}
	document.getElementById(unit).lastChild.nodeValue = amount;

}

function blastOff() {
	var units = ["days","minutes","hours","seconds"];
	for (var i=0; i<units.length; i++) {
		if (!document.getElementById(units[i])) return false;
		var amount = parseInt(document.getElementById(units[i]).lastChild.nodeValue,10);
		if (amount>0) return false;
	}
	window.clearInterval(countdown.timer);
	return true;
}
	

function countdown() {
	this.timer = window.setInterval("decrement('seconds')",1000);
}

addLoadEvent(countdown);