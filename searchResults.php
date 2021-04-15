<?php
	session_start();
	$_SESSION["returnPath"] = "../searchResults.php?recipeName=$_GET[recipeName]";
	require("api/importer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.html");
  	    $name = $_GET['recipeName'];
  	    $query = "%" . $name . "%";
  	    $result = searchRecipes($query);
    ?>
    <link href="searchStyles.css" rel="stylesheet" >
</head>
<body>
   	<?php include("nav.php") ?>
   
	<div class="s003">
		
		<!--<div class="resultsTitle">
	   		<p>Search Results for: "<?php echo($name)?>"</p>
	   	</div> -->
	   	<div class="resultsTitle">
		   	<form action="searchResults.php" method="get" style="padding: 15px; ">
				<div class="inner-form">
				  	<div class="input-field second-wrap">
				    	<input id="search" name="recipeName" type="text" value="<?php echo $name; ?>" placeholder="Enter Keywords"/>
				  	</div>
				  	<div class="input-field third-wrap">
				    	<button class="btn-search" type="submit">
						  	<svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						    	<path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
						  	</svg>
				    	</button>
				  	</div>
		    	</div>
		  	</form>
		</div>
	   	<div class="results">
		<?php
			if(count($result[1]) > 0) {
				for($x = 0; $x < count($result[1]); $x++) {
					$keys = array_keys($result[1][$x]);
					/*
					0: ID (int)
					1: Name (String)
					2: Description (String)
					3: Instructions (String with pipes separating instructions)
					4: Timestamp (unsure of data type)
					5: Duration (int)
					6: Difficulty (int in range 1-5)
					7: UserID (int)
					
					foreach($keys as $key)  {
						echo($key.": ");
						echo($result[1][$x][$key]."<br />");
					}
					*/
					echo("<div class=\"searchResult\">");
					echo("<p>Name: ".$result[1][$x][$keys[1]]);
					echo("<br />Description: ".$result[1][$x][$keys[2]]);
					echo("</p><form id='result$x' method=\"post\" action=\"recipe.php\"></form><button form='result$x' class=\"submitButton\" type=\"submit\" formmethod=\"get\" value=\"".$result[1][$x][$keys[0]]."\" name=\"id\"/>See recipe</button>");
					echo("</div>");
				}
			}
			else {
				echo("<p>Sorry, there were no results for that term. Please try again with a different term, or create your own recipe <a href=\"submitRecipe.php\">here</a>.");
			}
		?>
		</div>
    </div>
    <script src="js/extention/choices.js"></script>
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script>
     
 
</body>
</html>
