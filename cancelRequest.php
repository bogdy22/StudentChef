<?php
	session_start();
	require("api/importer.php");

	$data = json_decode(file_get_contents("php://input"));
	$requestID = $data->id;

	$status = deleteRequest($requestID)[0];
	if($status == 204) {
		echo(1);
	} else {
		echo(0);
	}
?>
