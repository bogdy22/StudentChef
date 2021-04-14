<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createRequest($IngredientID, $RequestedUserID, $RequestCreatorID) {
		$sql = "INSERT INTO `Requests` (`ID`, `IngredientID`, `RequestedUserID`, `RequestCreatorID`, `TimeCreated`, `IsCompleted`, `IsDenied`) VALUES (NULL, '$IngredientID', '$RequestedUserID', '$RequestCreatorID', NULL, 0, 0)";
		$res = doSQL($sql);

		if ($res[0]) {
			return [201, mysqli_insert_id(getConn())];
		} else {
			return [400];
		}
	}
	
	function getAllRequests() {
		$sql = "SELECT * FROM `Requests`";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}	
	
	function getRequestByID($ID) {
		$sql = "SELECT * FROM `Requests` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, mysqli_fetch_array($res[1], MYSQLI_ASSOC)];
		} else {
			return [400];
		}
	}
	
	function getRequestsByIngredientID($IngredientID) {
		$sql = "SELECT * FROM `Requests` WHERE `IngredientID` = '$IngredientID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}
	
	function getRequestsByCreatorID($RequestCreatorID) {
		$sql = "SELECT * FROM `Requests` WHERE `RequestCreatorID` = '$RequestCreatorID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}
	
	function getRequestsByRequestedUserID($RequestedUserID) {
		$sql = "SELECT * FROM `Requests` WHERE `RequestedUserID` = '$RequestedUserID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}
	
	function updateRequest($ID, $IngredientID, $RequestedUserID, $RequestCreatorID, $IsCompleted, $IsDenied) {
		$sql = "UPDATE `Requests` SET `IngredientID` = '$IngredientID', `RequestedUserID` = '$RequestedUserID', `RequestCreatorID` = '$RequestCreatorID', `IsCompleted` = '$IsCompleted', `IsDenied` = '$IsDenied' WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
	
	function closeRequest($ID) {
		$sql = "UPDATE `Requests` SET `IsCompleted` = 1 WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
	
	function denyRequest($ID) {
		$sql = "UPDATE `Requests` SET `IsDenied` = 1 WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
	
	function deleteRequest($ID) {
		$sql = "DELETE FROM `Requests` WHERE `ID` = '$ID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
	
?>
