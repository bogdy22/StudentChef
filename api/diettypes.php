<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createDietType($Name) {
		$sql = "INSERT INTO `Diet_Types` (`ID`, `Name`) VALUES (NULL, '$Name')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [201, mysqli_insert_id(getConn())];
		} else {
			return [400];
		}
	}

	function getAllDietTypes() {
		$sql = "SELECT * FROM `Diet_Types`";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	};

	function getDietTypeByID($ID) {
		$sql = "SELECT * FROM `Diet_Types` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, mysqli_fetch_array($res[1], MYSQLI_ASSOC)];
		} else {
			return [400];
		}
	}

	function updateDietTypes($ID, $Name) {
		$sql = "UPDATE `Diet_Types` SET `Name` = '$Name' WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function deleteDietTypes($ID) {
		$sql = "DELETE FROM `Diet_Types` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>