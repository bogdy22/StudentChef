<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createRecipe($Name, $Description, $Duration, $Difficulty, $UserID) {
		$sql = "INSERT INTO `Recipes` (`ID`, `Name`, `Description`, `Timestamp`, `Duration`, `Difficulty`, `UserID`) VALUES (NULL, '$Name', '$Description', CURRENT_TIMESTAMP, '$Duration', '$Difficulty', '$UserID')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [201, mysqli_insert_id(getConn())];
		} else {
			return [400];
		}
	}

	function getAllRecipes() {
		$sql = "SELECT * FROM `Recipes`";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	};

	function getRecipeByID($ID) {
		$sql = "SELECT * FROM `Recipes` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, mysqli_fetch_array($res[1], MYSQLI_ASSOC)];
		} else {
			return [400];
		}
	}

	function searchRecipes($Name) {
		$sql = "SELECT * FROM `Recipes` WHERE `Name` LIKE '%$Name%'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}

	function updateRecipe($ID, $Name, $Description, $Duration, $Difficulty) {
		$sql = "UPDATE `Recipes` SET `Name` = '$Name', `Description` = '$Description', `Duration` = '$Duration', `Difficulty` = '$Difficulty' WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function deleteRecipe($ID) {
		$sql = "DELETE FROM `Recipes` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>