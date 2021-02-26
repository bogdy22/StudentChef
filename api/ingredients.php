<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createIngredient($Name, $Measure) {
		$sql = "INSERT INTO `Ingredients` (`ID`, `Name`, `Measure`) VALUES (NULL, '$Name', '$Measure')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [201, mysqli_insert_id(getConn())];
		} else {
			return [400];
		}
	}

	function getAllIngredients() {
		$sql = "SELECT * FROM `Ingredients`";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	};

	function getIngredientByID($ID) {
		$sql = "SELECT * FROM `Ingredients` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, mysqli_fetch_array($res[1], MYSQLI_ASSOC)];
		} else {
			return [400];
		}
	}

	function searchIngredients($Name) {
		$sql = "SELECT * FROM `Ingredients` WHERE `Name` LIKE '%$Name%'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}

	function updateIngredients($ID, $Name, $Measure) {
		$sql = "UPDATE `Ingredients` SET `Name` = '$Name', `Measure` = '$Measure' WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function deleteIngredients($ID) {
		$sql = "DELETE FROM `Ingredients` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>