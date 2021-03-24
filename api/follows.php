<?php 
	require_once("utils.php");
	require_once("connection.php");

	function createFollow($FollowerID, $FollowingID) {
		$sql = "INSERT INTO `Follows` (`ID`, `FollowerID`, `FollowingID`) VALUES (NULL, $FollowerID, '$FollowingID')";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}

	function getUserFollowing($FollowerID) {
		$sql = "SELECT * FROM `Follows` WHERE `FollowerID` = '$FollowerID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}

	function getUserFollowers($FollowingID) {
		$sql = "SELECT * FROM `Follows` WHERE `FollowingID` = '$FollowingID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [200, toArray($res[1])];
		} else {
			return [400];
		}
	}

	function deleteFollow($FollowerID, $FollowingID) {
		$sql = "DELETE FROM `Follows` WHERE `FollowerID` = '$FollowerID' AND `FollowingID` = '$FollowingID'";
		$res = doSQL($sql);

		if ($res[0]) {
			return [204];
		} else {
			return [400];
		}
	}
?>