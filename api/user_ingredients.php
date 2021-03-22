<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createUserIngredient($UserID, $IngredientID, $Excess) {
		$sql = "INSERT INTO `User_Ingredients` (`ID`, `UserID`, `IngredientID`, `Excess`) VALUES (NULL, '$UserID', '$IngredientID', '$Excess')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [201, mysqli_insert_id(getConn())];
		} else {
			return [400];
		}
	}

	function getAllUserIngredients() {
		$sql = "SELECT * FROM `User_Ingredients`";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	};

	function getUserIngredientByID($ID) {
		$sql = "SELECT * FROM `User_Ingredients` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, mysqli_fetch_array($res[1], MYSQLI_ASSOC)];
		} else {
			return [400];
		}
	}

	function updateUserIngredients($ID, $UserID, $IngredientID, $Excess) {
		$sql = "UPDATE `User_Ingredients` SET `UserID` = '$UserID', `IngredientID` = '$IngredientID', `Excess` = '$Excess', WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function deleteUserIngredients($ID) {
		$sql = "DELETE FROM `User_Ingredients` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
	
	function getIngredientsByUserID($UserID) {
		$sql = "SELECT * FROM User_Ingredients JOIN Ingredients ON User_Ingredients.IngredientID = Ingredients.ID WHERE User_Ingredients.UserID = $UserID";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}
	function getUsersByIngredientID($IngredientID) {
		$sql = "SELECT * FROM User_Ingredients JOIN Users ON User_Ingredients.UserID = Users.ID WHERE User_Ingredients.IngredientID = $IngredientID";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}
?>
