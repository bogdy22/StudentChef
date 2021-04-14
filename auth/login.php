<?php
session_start();
define("DEVELOPER_URL", "http://localhost/studentchef/auth/login.php");
define("AUTHENTICATION_SERVICE_URL", "http://studentnet.cs.manchester.ac.uk/authenticate/");

require_once("Authenticator.php");
require_once("../api/users.php");
Authenticator::validateUser();

$_SESSION["authTime"] = Authenticator::getTimeAuthenticated();
$_SESSION["username"] = Authenticator::getUsername();
$_SESSION["fullName"] = Authenticator::getFullName();

$apiUser = getUserByCASName($_SESSION["username"])[1];
if (!empty($apiUser)) {
    $_SESSION["userID"] = $apiUser["ID"];
    if (!empty($_SESSION["returnPath"])) {
        header("Location: $_SESSION[returnPath]");
    } else {
        header("Location: /");
    }
} else {
    $_SESSION["userID"] = createUsers($_SESSION["fullName"], $_SESSION["username"])[1];
    header("Location: /profile?user=$_SESSION[userID]");
}

die();
?>
