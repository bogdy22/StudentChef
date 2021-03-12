<?php
session_start();
define("DEVELOPER_URL", "http://localhost/studentchef/auth/login.php");
define("AUTHENTICATION_SERVICE_URL", "http://studentnet.cs.manchester.ac.uk/authenticate/");
require_once("Authenticator.php");
Authenticator::validateUser();
$_SESSION["authTime"] = Authenticator::getTimeAuthenticated();
$_SESSION["username"] = Authenticator::getUsername();
$_SESSION["fullName"] = Authenticator::getFullName();
header("Location: $_SESSION[returnPath]");
die();
?>
