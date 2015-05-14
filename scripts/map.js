var Micromap = function(containerId) {

	var self = this;

	this.init = function() {

		this.red	= this.red   || 255;
		this.green	= this.green || 255;
		this.blue	= this.blue  || 153;
		this.timer	= this.timer || 100;

		this.longitude	= this.longitude || -0.156019;
		this.latitude	= this.latitude  || 50.825891;
		this.zoom		= this.zoom	     || 15;

		if (GBrowserIsCompatible()) {

			this.createMap();
			this.geoHandler();

		}

	};

	this.createMap = function() {

		var mapdiv = document.createElement("div");
		mapdiv.setAttribute("id",containerId+"-map");
	
		var container = document.getElementById(containerId);
		container.parentNode.insertBefore(mapdiv,container);

		this.map = new GMap2(mapdiv);
		this.map.addControl(new GLargeMapControl());
	
		var point = new GLatLng(this.latitude,this.longitude);
		this.map.setCenter(point,this.zoom);

	};

	this.markStart = function() {
		var icon = new GIcon();
		icon.iconAnchor = new GPoint(9, 34);
		icon.infoWindowAnchor = new GPoint(9, 2);
		icon.image = "http://www.google.com/mapfiles/dd-start.png";
		icon.shadow = "http://www.google.com/mapfiles/shadow50.png";
		var point = new GLatLng(this.latitude,this.longitude);
		var starter = new GMarker(point, icon);
		GEvent.addListener(starter, "click", function() {
			starter.showMapBlowup(self.zoom>15 ? 17:self.zoom+2);
		});
		this.map.addOverlay(starter);
		this.map.panTo(point);
	};

	this.geoHandler = function() {
		var places = this.getElementsByClassName("vcard",document.getElementById(containerId));
		for (var i=0; i<places.length; i++) {

			var elems = this.getElementsByClassName("geo",places[i]);
			for (var j=0; j<elems.length; j++) {
				var degrees = elems[j].getAttribute("title").split(";");
				break;
			}
			elems = null;

			if (degrees) {

				places[i].coordlat = parseFloat(degrees[0]);
				places[i].coordlong = parseFloat(degrees[1]);
				places[i].style.cursor = "pointer";
				places[i].onclick = function() {

					self.chooseElement(this);

				};
			}
		}

		places = null;

	};

	this.chooseElement = function(element) {
		this.map.closeInfoWindow();
		if (this.marker) {
			this.map.removeOverlay(this.marker);
		}
		if (this.currentplace) {
			this.fadeOut(this.currentplace);
			if (element == this.currentplace) {
				this.map.removeOverlay(this.marker);
				this.currentplace = null;
				return;
			}
		}
		this.currentplace = element;
		var point = new GLatLng(element.coordlat,element.coordlong);
		this.marker = new GMarker(point);
		GEvent.addListener(this.marker, "click", function() {
//			self.marker.openInfoWindow(self.currentplace.cloneNode(true));
			self.marker.openInfoWindowHtml(self.currentplace.innerHTML);
		});
		this.map.addOverlay(this.marker);
		this.map.panTo(point);
		this.fadeIn(element);
	};

	this.fadeOut = function(element) {
		if (element.fade) {
			clearTimeout(element.fade);
		}
		var r = element.r || this.red;
		var g = element.g || this.green;
		var b = element.b || this.blue;
		if (r == 255 && g == 255 && b == 255) {
			element.style.backgroundColor = "transparent";
			return;
		}
		element.r = r + Math.ceil((255 - r)/10);
		element.g = g + Math.ceil((255 - g)/10);
		element.b = b + Math.ceil((255 - b)/10);
		element.style.backgroundColor = "rgb("+element.r+","+element.g+","+element.b+")";
		element.fade = setTimeout(function() {
			self.fadeOut(element);
		},this.timer);
	};

	this.fadeIn = function(element) {
		if (element.fade) {
			clearTimeout(element.fade);
		}
		var r = element.r || 255;
		var g = element.g || 255;
		var b = element.b || 255;
		if (r == this.red && g == this.green && b == this.blue) {
			return;
		}
		element.r = r - Math.ceil((r - this.red)/10);
		element.g = g - Math.ceil((g - this.green)/10);
		element.b = b - Math.ceil((b - this.blue)/10);
		element.style.backgroundColor = "rgb("+element.r+","+element.g+","+element.b+")";
		element.fade = setTimeout(function() {
			self.fadeIn(element);
		},this.timer);
	};

	this.getElementsByClassName = function(name,element) {
		var results = [];
		var elems = element.getElementsByTagName("*");
		for (var i=0; i<elems.length; i++) {
			if (elems[i].className.match(new RegExp("(^|\\s)"+name+"(\\s|$)"))) {
				results[results.length] = elems[i];
			}
		}
		elems = null;
		return results;
	};

};

function venueMap() {

	var venue = new Micromap("places");

	venue.red = 233;
	venue.green = 243;
	venue.blue = 217;
	venue.timer = 50;

	venue.longitude = -0.1386;
	venue.latitude = 50.8238;
	venue.zoom = 15;

	venue.init();
	venue.markStart();

}

addLoadEvent(venueMap);