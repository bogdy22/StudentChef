<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createIngredientMeasure($Name, $Measure) {
		$sql = "INSERT INTO `Ingredient_Measure`  (`ID`, `Name`, `Measure`) VALUES (NULL, '$Name', '$Measure')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [201, mysqli_insert_id(getConn())];
		} else {
			return [400];
		}
	}

	function getAllIngredientMeasures() {
		$sql = "SELECT * FROM `Ingredient_Measure` ";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	};

	function getIngredientMeasureByID($ID) {
		$sql = "SELECT * FROM `Ingredient_Measure`  WHERE `Measure_ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, mysqli_fetch_array($res[1], MYSQLI_ASSOC)];
		} else {
			return [400];
		}
	}

	function updateIngredientMeasures($ID, $Name, $Measure) {
		$sql = "UPDATE `Ingredient_Measure`  SET `Name` = '$Name', `Measure` = '$Measure' WHERE `Measure_ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function deleteIngredients($ID) {
		$sql = "DELETE FROM `Ingredient_Measure` WHERE `Measure_ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>