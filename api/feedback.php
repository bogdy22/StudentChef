<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createFeedback($Rating, $Comment, $Duration, $Difficulty, $RecipeID, $UserID) {
		$sql = "INSERT INTO `Recipe_Feedback` (`ID`, `Rating`, `Comment`, `Timestamp`, `Duration`, `Difficulty`, `RecipeID`, `UserID`) VALUES (NULL, '$Rating', '$Comment', CURRENT_TIMESTAMP, '$Duration', '$Difficulty', '$RecipeID', '$UserID')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [201, mysqli_insert_id(getConn())];
		} else {
			return [400];
		}
	}

	function getAllFeedback() {
		$sql = "SELECT * FROM `Recipe_Feedback`";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	};

	function getFeedbackByID($ID) {
		$sql = "SELECT * FROM `Recipe_Feedback` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, mysqli_fetch_array($res[1], MYSQLI_ASSOC)];
		} else {
			return [400];
		}
	}

	function getFeedbackByRecipe($RecipeID) {
		$sql = "SELECT * FROM `Recipe_Feedback` WHERE `RecipeID` = '$RecipeID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}

	function getFeedbackByUser($UserID) {
		$sql = "SELECT * FROM `Recipe_Feedback` WHERE `UserID` = '$UserID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}

	function updateFeedback($ID, $Rating, $Comment, $Duration, $Difficulty) {
		$sql = "UPDATE `Recipe_Feedback` SET `Rating` = '$Rating', `Comment` = '$Comment', `Duration` = '$Duration', `Difficulty` = '$Difficulty' WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function deleteFeedback($ID) {
		$sql = "DELETE FROM `Recipe_Feedback` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>