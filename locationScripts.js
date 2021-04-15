const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
let labelIndex = 0;

function initMap() {
	const map = new google.maps.Map(document.getElementById("map"), {
		zoom: 15,
		center: { lat: 53.483959, lng:  -2.244644 },
	});
	const geocoder = new google.maps.Geocoder();
	geocodeAddress(geocoder, map);
}

function geocodeAddress(geocoder, resultsMap) {
  	var postcodeElements = document.getElementsByClassName("postcodefield");
  	for(i = 0; i < postcodeElements.length; i++) {
		//console.log(postcodeElements[i].textContent);
		geocoder.geocode({ address: postcodeElements[i].textContent }, (results, status) => {
		if (status === "OK") {
		  	resultsMap.setCenter(results[0].geometry.location);
		  	new google.maps.Marker({
		    	map: resultsMap,
		    	label: labels[labelIndex++ % labels.length],
		    	position: results[0].geometry.location,
			});
		} else {
		  	alert("Geocode was not successful for the following reason: " + status);
		}
	  });
	}
}
