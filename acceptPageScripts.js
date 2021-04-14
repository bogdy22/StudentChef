var marker = null;

function initMap() {
	const map = new google.maps.Map(document.getElementById("map"), {
		zoom: 15,
		center: { lat: 53.483959, lng:  -2.244644 },
	});
	const geocoder = new google.maps.Geocoder();
	
	google.maps.event.addListener(map, 'click', function(event) {
		if (marker != null) {
			marker.setMap(null);
		}
		marker = new google.maps.Marker({
			position: event.latLng,
			map: map
		});
	});
}

function submitLocation(requestID) {
	if (marker != null) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'acceptRequest.php', true);
		xhr.onreadystatechange = function () {
			var DONE = 4; // readyState 4 means the request is done.
			var OK = 200; // status 200 is a successful return.
		  	if (xhr.readyState === DONE) {
			  	if (xhr.status != OK) {
				  	console.log('Error: ' + xhr.status); // An error occurred during the request.
				} else if (xhr.responseText == 1) {
					alert("The request was accepted successfully.");
				  	window.location.href = "requestsPage.php";
				} else {
					alert("A problem occurred - location not updated. Please contact site admins about this!");
				}
				
		  	}
		};
		data = {id: requestID, lat: marker.position.lat(), lng: marker.position.lng()};
		xhr.setRequestHeader("Content-Type", "application/json");
		xhr.send(JSON.stringify(data));
	} else {
		alert("Please add a pin to the map.");
	}
}
