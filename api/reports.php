<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createReport($RecipeID, $UserID) {
		$sql = "INSERT INTO `Reports` (`ID`, `RecipeID`, `UserID`, `Timestamp`, `Status`) VALUES (NULL, '$RecipeID', '$UserID', CURRENT_TIMESTAMP, 'Pending')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [201, mysqli_insert_id(getConn())];
		} else {
			return [400];
		}
	}

	function getAllReports() {
		$sql = "SELECT * FROM `Reports`";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	};

	function getReportsByRecipe($RecipeID) {
		$sql = "SELECT * FROM `Reports` WHERE `RecipeID` = '$RecipeID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, mysqli_fetch_array($res[1], MYSQLI_ASSOC)];
		} else {
			return [400];
		}
	}

	function getReportsByUser($UserID) {
		$sql = "SELECT * FROM `Reports` WHERE `UserID` = '$UserID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}

	function updateReports($ID, $Status) {
		$sql = "UPDATE `Reports` SET `Status` = '$Status' WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function deleteReports($ID) {
		$sql = "DELETE FROM `Reports` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>