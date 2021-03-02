<?php 
define("AUTHENTICATION_LOGOUT_URL", "http://studentnet.cs.manchester.ac.uk/systemlogout.php");
require_once("Authenticator.php");
session_start();
session_destroy();
Authenticator::invalidateUser();
?>