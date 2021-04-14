<html lang="en">
<head>
  <?php 
  		include("head.html");
  		require_once("api/users.php");
  		require_once("api/ingredients.php");
  		require_once("api/requests.php");
  		session_start();
		$_SESSION["returnPath"] = "../requestsPage.php";
  ?>
	<title>StudentChef</title>
	<meta charset="utf-8">
   
    <link href="acceptPageStyles.css" rel="stylesheet" >
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="acceptPageScripts.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
</head>
<body>
   	<?php include("nav.php"); ?>
   	<?php
	echo('<div class="s003">');
	if(isset($_POST['btn'])) {
		echo('<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1OUr6frf_S2gQHnE0Gq1fZuyGbKjK4tM&callback=initMap" async></script>');
		echo('<div id="map" style="height: 400px; width: 100%;"></div>');
		echo('<div class="mainContent">');
		echo('<button onclick="submitLocation('.$_POST["btn"].')">Submit Location</button>');
		echo('</div>');
	} else {
		echo("<p>Whoops, you should't be here. Click <a href='home.php'>here</a> to go back home.</p>");
	}
	echo('</div>');
	?>
</body>
</html>
