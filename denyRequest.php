<?php
	require_once("api/requests.php");
	$data = json_decode(file_get_contents("php://input"));
	$requestID = $data->id;
	
	$status = array(0, 0);
	$status[0] = denyRequest($requestID)[0];
	$status[1] = closeRequest($requestID)[0];
	if($status[0] == 204 && $status[1] == 204) {
		echo(1);
	} else {
		echo(0);
	}
?>
