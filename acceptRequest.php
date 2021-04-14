<?php
	require_once("api/requests.php");
	require_once("api/users.php");
	session_start();
	
	$data = json_decode(file_get_contents("php://input"));
	$requestID = $data->id;
	$lat = $data->lat;
	$lng = $data->lng;
	
	$username = $_SESSION["username"];
	$currentUser = getUserByCASName($username)[1]["ID"];
	
	$status = updateUserLocation($currentUser, $lat, $lng);
	
	$status = closeRequest($requestID)[0];
	if($status == 204) {
		echo(1);
	} else {
		echo(0);
	}
?>
