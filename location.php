<html lang="en">
<head>
  	<?php 
  		include("head.html");
  		require_once("api/users.php");
  		require_once("api/ingredients.php");
  		require_once("api/user_ingredients.php");
  		session_start();
        $_SESSION["returnPath"] = "../location.php";
  	?>
	<link href="locationStyles.css" rel="stylesheet" >
</head>
<body>
   	<?php include("nav.php"); ?>
   
	<div class="s003">
		<div class="left">
			<div class="topcontent">
			   	<?php 
				    if (!isset($_SESSION["authTime"]) || !isset($_SESSION["username"])){
				        echo("<p>You are not logged in. Please <a href='auth/login.php'>log in</a> to continue.</p>");
				    }else{
				    	$username = $_SESSION["username"];
		  				$result = getUserByCASName($username);
				        echo("<p>Logged in as ".$result[1]["PreferredName"].".<br/>What do you need?</p>");
				        $result = getAllIngredients();
				        $ingredients = array();
				        if($result[0] == 200) {
						    for($x = 0; $x < count($result[1]); $x++) {
						    	$ingredients += [$result[1][$x]["ID"] => $result[1][$x]["Name"]];
							}
						}
				    }
				?>
				<form action="location.php" method="post">
				  	<select data-trigger="" name="choices-single-defaul">
						<option placeholder="">Ingredient</option>
						<?php
							for($i = 0; $i < count($ingredients); $i++) {
								echo("<option>".$ingredients[$i]."</option>");
							}
						?>
				  	</select>
				  	<button class="btn-search" type="submit" name="submit">
						<svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
							<path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
						</svg>
					</button>
				</form>
			</div>
		    <?php
		    	function showUsers($IngredientID) {
		            $users = getUsersByIngredientID($IngredientID);
		            $username = $_SESSION["username"];
		            $currentUser = getUserByCASName($username);
		            if($users[0] == 200) {
		            	if(count($users[1]) != 0) {
		            		echo("<p>Here are the users with that ingredient.<br/>Check the map for where they are:</p>");
						    $keys = array_keys($users[1][0]);
						    for($x = 0; $x < count($users[1]); $x++) {
						    	/*
								foreach($keys as $key)  {
									echo($key.": ");
									echo($users[1][$x][$key]."<br />");
								}
								*/
								if(!($currentUser[1]["ID"] == $users[1][$x]["ID"])) {
									echo("<div class='userResult'><p>");
									echo("Name: ".$users[1][$x]["PreferredName"]);
									echo("<br/>Quantity: ".$users[1][$x]["Excess"]);
									echo("<br/>Postcode: ".$users[1][$x]["Postcode"]);
									echo("</p><button class='resultButton'>Request Location</button></div>");
									echo("<p class='postcodefield'>".$users[1][$x]["Postcode"]."</p>");
								}
							}
						}
						else {
							echo("<p>Sorry, we've found no one in our database with that ingredient.</p>");
						}
					}
					else {
						echo("Oops, something went wrong with the SQL");
					}
		            //echo("<p>User ".$result[1]["PreferredName"]." has ".$result[1]["Excess"]." ".$result[1]["Measure"]." of ".$result[1]["Name"].".<br/></p>");
		        }
		        if(isset($_POST['submit'])) {
		        	$choice = $_POST['choices-single-defaul'];
		        	$id = array_search($choice, $ingredients);
		        	//echo($choice." ".$id);
		       		showUsers($id);
		        }
		    ?>
		</div>
		<div class="right">
			<!-- <p id="permissionText">Please allow location access so that we can find other users near you.</p> -->
			<script
			  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1OUr6frf_S2gQHnE0Gq1fZuyGbKjK4tM&callback=initMap"
			  async
			></script>
			<div id="map" style="height: 400px; width: 100%;">
			</div>
		</div>
    </div>
    <!-- <script src="js/extention/choices.js"></script>
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script> -->
    
	<script src="locationScripts.js"></script>
 
</body>
</html>
