<?php 
if (!isset($_SESSION["authTime"]) || !isset($_SESSION["username"]) || !isset($_SESSION["fullName"])) {
	header("Location: auth/login.php");
	die();
}
?>