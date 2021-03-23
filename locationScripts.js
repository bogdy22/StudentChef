/*
var map;
var geocoder;

function initialise() {
	geocoder = new google.maps.Geocoder();
	codeAddress();
}

function codeAddress() {
	var address = "AL1 4BQ";
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
}

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(updatePosition, errorCallback);
	} else {
		x = document.getElementById("permissionText");
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
}

function updatePosition(GeolocationObject) {
	//localStorage['authorisedGeolocation'] = 1;
	//x = document.getElementById("permissionText");
	//x.style.display = "none";
	pos = { lat: GeolocationObject.coords.latitude, lng: GeolocationObject.coords.longitude }
  	map.setCenter(pos);

  	new google.maps.Marker({
	    position: pos,
	    map,
	    title: "Your location",
  	});

}

function errorCallback(error) {
	if (error.code == error.PERMISSION_DENIED) {
        alert("We need your location to find other users. Please refresh and allow location permission.");
    }
    //localStorage['authorisedGeolocation'] = 0;
}


// Create the script tag, set the appropriate attributes
var script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA1OUr6frf_S2gQHnE0Gq1fZuyGbKjK4tM&callback=initMap';
script.defer = true;

window.initMap = function() {
  var position = { lat: 53.483959, lng:  -2.244644 };
  map = new google.maps.Map(document.getElementById("map"), {
    center: position,
    zoom: 15,
  });
};


// Append the 'script' element to 'head'
document.head.appendChild(script);
*/
function initMap() {
	const map = new google.maps.Map(document.getElementById("map"), {
		zoom: 15,
		center: { lat: 53.483959, lng:  -2.244644 },
	});
	const geocoder = new google.maps.Geocoder();
	geocodeAddress(geocoder, map);
}
/*
function createMarkersFromPostcodes() {
	var postcodeElements = document.getElementsByClassName("postcodefield");
	for(i = 0; i < postcodeElements.length; i++) {
		//console.log(postcodeElements[i].textContent);
		geocoder.geocode({ address: postcodeElements[i].textContent }, (results, status) => {
		if (status === "OK") {
		  	resultsMap.setCenter(results[0].geometry.location);
		  	new google.maps.Marker({
		    	map: resultsMap,
		    	position: results[0].geometry.location,
			});
		} else {
		  	alert("Geocode was not successful for the following reason: " + status);
		}
	  });
	}
}
*/

function geocodeAddress(geocoder, resultsMap) {
  	var postcodeElements = document.getElementsByClassName("postcodefield");
  	for(i = 0; i < postcodeElements.length; i++) {
		//console.log(postcodeElements[i].textContent);
		geocoder.geocode({ address: postcodeElements[i].textContent }, (results, status) => {
		if (status === "OK") {
		  	resultsMap.setCenter(results[0].geometry.location);
		  	new google.maps.Marker({
		    	map: resultsMap,
		    	position: results[0].geometry.location,
			});
		} else {
		  	alert("Geocode was not successful for the following reason: " + status);
		}
	  });
	}
}
