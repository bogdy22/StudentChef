<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createRecipeIngredient($RecipeID, $IngredientID, $Quantity) {
		$sql = "INSERT INTO `Recipe_Ingredients` (`RecipeID`, `IngredientID`, `Quantity`) VALUES ($RecipeID, '$IngredientID', '$Quantity')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function getRecipeIngredients($RecipeID) {
		$sql = "SELECT * FROM `Recipe_Ingredients` WHERE `RecipeID` = '$RecipeID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}

	function deleteRecipeIngredient($RecipeID, $IngredientID) {
		$sql = "DELETE FROM `Recipe_Ingredients` WHERE `RecipeID` = '$RecipeID' AND `IngredientID` = '$IngredientID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>