<?php
require_once('api/recipes.php');

 
    $recipeTitle = $_POST['recipeTitle']; 
    $description = $_POST['recipeTagline']; 
    $instructionlist = $_POST['instructions'];
    $instructions = implode('|', $instructionlist);
    $ingredientlist = $_POST['ingredients'];
    $ingredient = implode('|',$ingredientlist);
    $difficulty = $_POST['difficulty'];
    $duration = $_POST['duration'];
    createRecipe($recipeTitle, $description, $instructions, $duration , $difficulty, 1);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("head.html") ?>
		<link rel="stylesheet" type="text/css" href="submitRecipeStyles.css">
	</head>
	<body>
	<?php include("nav.php") ?>
    <div class="container">
        <h1 style="text-align: center;"> Your recipe has been submitted</h1>
        <img src="img\check-mark-8-256.png" class="center" style="width:100px">
    </div>
    </body>
</html>
