function acceptRequest(requestID) {
	// console.log(requestID + " accepted");
	/*
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'phpToExecute.php', true);
	xhr.onreadystatechange = function () {
		var DONE = 4; // readyState 4 means the request is done.
		var OK = 200; // status 200 is a successful return.
	  	if (xhr.readyState === DONE) {
		  	if (xhr.status === OK) {
			  	element = document.getElementById("textField"); // 'This is the returned text.'
			  	element.innerText = xhr.responseText
			} else {
			  	console.log('Error: ' + xhr.status); // An error occurred during the request.
			}
	  	}
	};
	data = {id: 1};
	xhr.setRequestHeader("Content-Type", "application/json");
	xhr.send(JSON.stringify(data));
	*/
}

function denyRequest(requestID, resultID) {
	// console.log(requestID + " denied");
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'denyRequest.php', true);
	xhr.onreadystatechange = function () {
		var DONE = 4; // readyState 4 means the request is done.
		var OK = 200; // status 200 is a successful return.
	  	if (xhr.readyState === DONE) {
		  	if (xhr.status != OK) {
			  	console.log('Error: ' + xhr.status); // An error occurred during the request.
			} else if (xhr.responseText == 1) {
			  	alert("Request denied successfully.");
			  	document.getElementById(resultID).style.display = "none";
			} else {
				alert("A problem occurred - request not denied. Please contact site admins about this!");
			}
			
	  	}
	};
	data = {id: requestID};
	xhr.setRequestHeader("Content-Type", "application/json");
	xhr.send(JSON.stringify(data));
}

function cancelRequest(requestID, resultID) {
	// console.log(requestID + " cancelled");
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'cancelRequest.php', true);
	xhr.onreadystatechange = function () {
		var DONE = 4; // readyState 4 means the request is done.
		var OK = 200; // status 200 is a successful return.
	  	if (xhr.readyState === DONE) {
		  	if (xhr.status != OK) {
			  	console.log('Error: ' + xhr.status); // An error occurred during the request.
			} else if (xhr.responseText == 1) {
			  	alert("Request deleted successfully.");
			  	document.getElementById(resultID).style.display = "none";
			} else {
				alert("A problem occurred - request not deleted. Please contact site admins about this!");
			}
			
	  	}
	};
	data = {id: requestID};
	xhr.setRequestHeader("Content-Type", "application/json");
	xhr.send(JSON.stringify(data));
}

function dismissRequest(requestID, resultID) {
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'dismissRequest.php', true);
	xhr.onreadystatechange = function () {
		var DONE = 4; // readyState 4 means the request is done.
		var OK = 200; // status 200 is a successful return.
	  	if (xhr.readyState === DONE) {
		  	if (xhr.status != OK) {
			  	console.log('Error: ' + xhr.status); // An error occurred during the request.
			} else if (xhr.responseText == 1) {
			  	alert("Request dismissed successfully.");
			  	document.getElementById(resultID).style.display = "none";
			} else {
				alert("A problem occurred - request not dismissed. Please contact site admins about this!");
			}
			
	  	}
	};
	data = {id: requestID};
	xhr.setRequestHeader("Content-Type", "application/json");
	xhr.send(JSON.stringify(data));
}
