<?php 
	require_once("connection.php");

	function toArray($sql) {
		$data = [];
		while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
			$payload = array();
			foreach(array_keys($row) as $key) {
				$payload[$key] = $row[$key];
			}
			array_push($data, $payload);
		}
		return $data;
	}
?>