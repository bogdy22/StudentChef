<?php
	require_once('config.php');

	$conn = mysqli_connect($database_host, $database_username, $database_password);

	if (!$conn) {
		die("Connection Error: " . mysqli_connect_error());
	}

	function doSQL($sql) {
		global $conn;

		echo("<p>$sql");

		if ($result = mysqli_query($conn, $sql)) {
			echo(" - OK</p>");
		}
		else {
			die(mysqli_error($conn));
		}
		return $result;
	}

	echo("<p>Connection Successful</p>");
?>