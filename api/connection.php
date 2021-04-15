<?php
	require_once('../config.inc.php');

	$conn = mysqli_connect($database_host, $database_user, $database_pass, "2020_comp10120_y16");

	if (!$conn) {
		die();
	}

	function doSQL($sql) {
		global $conn;

		// [OK, data]
		if ($result = mysqli_query($conn, $sql)) {
			return [true, $result];
		}
		else {
			return [false, $result];
		}
	}

	function getConn() {
		global $conn;
		return $conn;
	}
?>