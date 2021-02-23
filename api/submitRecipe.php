<?php
	$host = "dbhost.cs.man.ac.uk";
	$un = "f77885sh";
	$pw = "COMP10120";

	$conn = mysqli_connect($host, $un, $pw);

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