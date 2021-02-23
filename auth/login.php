<?php
define("DEVELOPER_URL", "http://localhost/cas-test/auth/login.php");
define("AUTHENTICATION_SERVICE_URL", "http://studentnet.cs.manchester.ac.uk/authenticate/");
require_once("Authenticator.php");
session_start();
Authenticator::validateUser();
$_SESSION["authTime"] = Authenticator::getTimeAuthenticated();
$_SESSION["username"] = Authenticator::getUsername();
$_SESSION["fullName"] = Authenticator::getFullName();
header("Location: ../index.php");
die();
?>
