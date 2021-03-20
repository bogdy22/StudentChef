<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createUserIngredient($UserID, $IngredientID, $Excess) {
		$sql = "INSERT INTO `User_Ingredients` (`UserID`, `IngredientID`, `Excess`) VALUES ($UserID, '$IngredientID', '$Excess')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function getUserIngredients($UserID) {
		$sql = "SELECT * FROM `User_Ingredients` WHERE `UserID` = '$UserID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}

	function deleteUserIngredient($UserID) {
		$sql = "DELETE FROM `User_Ingredients` WHERE `UserID` = '$UserID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>