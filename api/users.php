<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createUsers($PreferredName, $CASName) {
		$sql = "INSERT INTO `Users` (`ID`, `PreferredName`, `CASName`, `Admin`, `Postcode`, `Latitude`, `Longitude`) VALUES (NULL, '$PreferredName', '$CASName', 0, 'NULL', NULL, NULL)";
		$res = doSQL($sql);

		if ($res[0]) {
			return [201, mysqli_insert_id(getConn())];
		} else {
			return [400];
		}
	}

	function getAllUsers() {
		$sql = "SELECT * FROM `Users`";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	};

	function getUserByID($ID) {
		$sql = "SELECT * FROM `Users` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, mysqli_fetch_array($res[1], MYSQLI_ASSOC)];
		} else {
			return [400];
		}
	}

	function getUserByCASName($CASName) {
		$sql = "SELECT * FROM `Users` WHERE `CASName` = '$CASName'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, mysqli_fetch_array($res[1], MYSQLI_ASSOC)];
		} else {
			return [400];
		}
	}

	function searchUsers($PreferredName) {
		$sql = "SELECT * FROM `Users` WHERE `Name` LIKE '%$PreferredName%'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}

	function updateUser($ID, $PreferredName, $CASName, $Postcode) {
		$sql = "UPDATE `Users` SET `PreferredName` = '$PreferredName', `CASName` = '$CASName', `Postcode` = '$Postcode' WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
	
	function updateUserNoPostcode($ID, $PreferredName, $CASName) {
		$sql = "UPDATE `Users` SET `PreferredName` = '$PreferredName', `CASName` = '$CASName', `Postcode` = NULL WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
	
	function updateUserLocation($ID, $Latitude, $Longitude) {
		$sql = "UPDATE `Users` SET `Latitude` = '$Latitude', `Longitude` = '$Longitude' WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
	
	function deleteUser($ID) {
		$sql = "DELETE FROM `Users` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>
