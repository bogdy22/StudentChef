<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createIngredientDietType($IngredientID, $DietTypeID) {
		$sql = "INSERT INTO `Ingredient_Diet_Types` (`IngredientID`, `DietTypeID`) VALUES ($IngredientID, '$DietTypeID')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function deleteIngredientDietTypes($IngredientID, $DietTypeID) {
		$sql = "DELETE FROM `Ingredient_Diet_Types` WHERE `IngredientID` = '$IngredientID' AND `DietTypeID` = '$DietTypeID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>