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
   
    <link href="requestsPageStyles.css" rel="stylesheet" >
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="requestPageScripts.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
</head>
<body>
   	<?php include("nav.php"); ?>
   
	<div class="s003">
		<?php
			if (!isset($_SESSION["authTime"]) || !isset($_SESSION["username"])) {
				echo("<p>You are not logged in. Please <a href='auth/login.php'>log in</a> to continue.</p>");
			} else {
				$username = $_SESSION["username"];
		  		$currentUser = getUserByCASName($username)[1]["ID"];
		  		
		  		$outboundRequests = getRequestsByCreatorID($currentUser);
		  		$incomingRequests = getRequestsByRequestedUserID($currentUser);
		  		
		  		if ($outboundRequests[0] != 200 || $incomingRequests[0] != 200) {
		  			echo("<p>Something went wrong with the SQL (outboundRequests).</p>");
		  		} else {
		  			$outboundRequests = $outboundRequests[1];
		  			$incomingRequests = $incomingRequests[1];
		  			
		  			# right content (outbound requests)
		  			echo("<div class='topContent'><div class='right'>");
		  			echo("<h1>Outgoing Requests</h1>");
		  			$completedRequests = array();
		  			for ($x = 0; $x < count($outboundRequests); $x++) {
		  				if($outboundRequests[$x]["IsCompleted"] != 1) {
		  					$ingredientName = getIngredientByID($outboundRequests[$x]["IngredientID"])[1]["Name"];
		  					$requestedUser = getUserByID($outboundRequests[$x]["RequestedUserID"]);
		  					$reqUserName = $requestedUser[1]["PreferredName"]; # not "username", "user name"
			  				echo("<div id='outRequest$x' class='requestResult'><div class='textContent'><p>Ingredient Requested: $ingredientName");
							echo("<br/>Name of User: ".$reqUserName);
							echo("</p></div><button class='resultButton' onclick='cancelRequest(".$outboundRequests[$x]["ID"].", \"outRequest$x\")'>Cancel request</button></div>");
						} else {
							$completedRequests[] = $outboundRequests[$x];
						}
		  			}
		  			echo("</div>");
		  			
		  			# left content (incoming requests)
		  			echo("<div class='left'>");
		  			echo("<h1>Incoming Requests</h1>");
		  			for ($x = 0; $x < count($incomingRequests); $x++) {
		  				if($incomingRequests[$x]["IsCompleted"] != 1) {
		  					$ingredientName = getIngredientByID($incomingRequests[$x]["IngredientID"])[1]["Name"];
		  					$requestCreator = getUserByID($incomingRequests[$x]["RequestCreatorID"]);
		  					$reqCreatorName = $requestCreator[1]["PreferredName"]; # not "username", "user name"
			  				echo("<div id='inRequest$x' class='requestResult'><p>Ingredient Requested: $ingredientName");
							echo("<br/>Name of User: ".$reqCreatorName);
							//echo("</p><div class='buttonBox'><form><button class='acceptDenyButton' onclick='acceptRequest(".$incomingRequests[$x]["ID"].")'>Accept request</button></form>");
							echo("</p><form method='post' id='acceptForm$x' action='acceptPage.php'></form>");
							echo("<div class='buttonBox'><button class='acceptDenyButton' form='acceptForm$x' type='submit' name='btn' value='".$incomingRequests[$x]["ID"]."'>Accept request</button>");
							echo("<button class='acceptDenyButton' onclick='denyRequest(".$incomingRequests[$x]["ID"].", \"inRequest$x\")'>Deny request</button></div></div>");
						}
		  			}
		  			echo("</div></div>");
		  			
		  			# bottom content (completed requests)
		  			
		  			echo("<div class='bottomContent'><h1>Completed Requests</h1><p style='text-align: center; margin: 5px;'>Requests that you have sent that have received a response will be shown here. Dismiss requests once you have received the ingredient.</p>");
		  			for ($x = 0; $x < count($completedRequests); $x++) {
		  				$ingredientName = getIngredientByID($completedRequests[$x]["IngredientID"])[1]["Name"];
	  					$requestedUser = getUserByID($completedRequests[$x]["RequestedUserID"]);
	  					$reqUserName = $requestedUser[1]["PreferredName"]; # not "username", "user name"
	  					if($completedRequests[$x]["IsDenied"] == 0) {
	  						$outcome = "Request Accepted";
	  					} else {
	  						$outcome = "Request Denied";
	  					}
		  				echo("<div id='compRequest$x' class='requestResult'><div class='textContent'><p>Ingredient Requested: $ingredientName");
						echo("<br/>Name of User: ".$reqUserName);
						echo("<br/>Outcome: ".$outcome);
						$lat = $requestedUser[1]["Latitude"];
						$lng = $requestedUser[1]["Longitude"];
						$url = "https://www.google.com/maps/search/?api=1&query=$lat,$lng";
						echo("<br/>Location: <a href='$url' target='_blank'>Click Here</a>");
						echo("</p></div><button class='resultButton' onclick='dismissRequest(".$completedRequests[$x]["ID"].", \"compRequest$x\")'>Dismiss</button></div>");
		  			}
		  			echo("</div>");
		  		}

			}
		?>
	</div>
</body>
</html>
