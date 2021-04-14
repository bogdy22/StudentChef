<html lang="en">
  <head>
  <?php 
  		include("head.html");
  		require_once("api/users.php");
  		require_once("api/requests.php");
  		require_once("api/ingredients.php");
  		session_start();
		
  ?>
  <title>StudentChef</title>
    <meta charset="utf-8">
   
    <link href="locationStyles.css" rel="stylesheet" >
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
  </head>
  <body>
  	<?php include("nav.php"); ?>
  	<div class="s003">
		<?php
			if(empty($_POST)) {
				echo("<p>Something's gone wrong - you shouldn't be here currently. Click <a href='home.php'>here</a> to go back home.</p>");
			} else {
				$_SESSION["returnPath"] = "../location.php";
				$username = $_SESSION["username"];
				$RequestCreatorID = getUserByCASName($username)[1]["ID"];
				foreach ($_POST as $key => $value) {
					$RequestedUserID = $key;
				}
				//echo("<p>key is -$key-</p>");
				$ingredient = $_SESSION["currentIngredient"];
				$IngredientID = searchIngredientsExact($ingredient)[1][0]["ID"];
				//echo("'$IngredientID' - '$RequestedUserID' - '$RequestCreatorID'");
				$res = createRequest($IngredientID, $RequestedUserID, $RequestCreatorID);
				if($res[0] == 201) {
					echo("<p>Request created successfully</p>");
				} else {
					echo("<p>Request creation failed spectacularly</p>");
				}
				$_SESSION["currentIngredient"] = "";
			}
			
		?>
 	</div>
</body>
</html>
