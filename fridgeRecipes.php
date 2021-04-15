<?php

require_once('api/ingredients.php');
require_once('api/user_ingredients.php');
require_once('api/users.php');
require_once('api/recipes.php');
require_once('api/recipes_ingredients.php');


session_start();
$_SESSION["returnPath"] = "../fridgeRecipes.php";
?>

<?php 
     if (!isset($_SESSION["authTime"]) || !isset($_SESSION["username"]) || !isset($_SESSION["fullName"])) {
        header("Location: auth/login.php");
        die();
    }        
?>


<?php
$userID = getUserByCASName($_SESSION['username'])[1]["ID"];

$ingredientsInFridge = getUserIngredients($userID)[1];

$ingredientIDList = array();

foreach ($ingredientsInFridge as $ingredientInFridge){
    array_push($ingredientIDList, $ingredientInFridge["IngredientID"]);
}

$possibleRecipes = array();


foreach ($ingredientIDList as $ingredientID){
    $ingredientList = array();
    $ingredientName = getIngredientByID($ingredientID)[1]["Name"];
    $ingredients = searchIngredients($ingredientName)[1];
    foreach ($ingredients as $ing){
        array_push($ingredientList, $ing["ID"]);
    }
    foreach ($ingredientList as $ing){
        $records = getRecipeFromIngredient($ing)[1];
        foreach ($records as $record){
            array_push($possibleRecipes, $record["RecipeID"]);
        }
    }
    
}
$possibleRecipes = array_unique($possibleRecipes);
$values = array_count_values($possibleRecipes);
arsort($values);
$popular = array_slice(array_keys($values), 0, 10, true);


?>

<!DOCTYPE html>
    <html lang='en'>
        <head>
        <?php 	include("head.html");
                require_once("api/user_ingredients.php");
                require_once("api/ingredients.php")
				
		?>
            <link rel='stylesheet' type='text/css' href='recipeResults.css'>
        </head>
        <body>
        <?php include('nav.php') ?>
        <div class='container'>
            <div class='row'>
                <div class="col p-3">
					<header >
						<h1 style="text-align: center" class = "contain" >Recipes from Fridge </h1><button type='button' onclick="window.location.href='fridge.php';" class="btn btn-primary btn-lg float-right" style="display:inline;">View Fridge</button>
                    </header>
				</div>
			</div>
            <div class="row">
                <div class="col p-3">
                    <main>
                    <div class="square">
                    <div id="recipes">
						<ul>
							<?php
                                if (count($popular) != 0){
                                    foreach ($popular as $id){  
                                       $recipeName = getRecipeByID($id)[1]["Name"];
                                       $recipeDescription = getRecipeByID($id)[1]["Description"];
                                       $recipeDifficulty = getRecipeByID($id)[1]["Difficulty"];
                                       $Difstars = ""; 
                                       switch ($recipeDifficulty){
                                            case 1:
                                                $Difstars = "★";
                                                break;
                                            case 2:
                                                $Difstars = "★★";
                                                break;
                                            case 3:
                                                $Difstars = "★★★";
                                                break;
                                            case 4:
                                                $Difstars = "★★★★";
                                                break;
                                            case 5:
                                                $Difstars = "★★★★★";
                                                break;
                                        }
                                       $recipeDuration = getRecipeByID($id)[1]["Duration"];

                                        $recipeIngredients = getRecipeIngredients($id)[1];
                                        $ingredients = array();

                                        foreach ($recipeIngredients as $ing){
                                            array_push($ingredients, $ing["IngredientID"]);
                                        }

                                        $diff = array_diff($ingredients, $ingredientIDList);

                                        $dont = count($diff);
                                        $have = count($ingredients) - $dont;


                                        echo "<li class='mb-3 ingr'>
                                                <form method='get' action='recipe.php'>
                                                <button class='but' name = 'id' value = '". $id . "'>
                                                <h3 style='text-align: center;'>". $recipeName . "</h3>
                                                <p style = 'text-align: center;'>" . $recipeDescription . "</p>
                                                <div class='row'>
                                                <div class='col-md-6'>
                                                <h4 style='text-align: center;;'>Difficulty</h4>
                                                <h4 style='text-align: center;'>" . $Difstars . "</h4>
                                                </div>
                                                
                                                <div class='col-md-6'>
                                                <h4 style='text-align: center;;'>Duration</h4>
                                                <h5 style='text-align: center; font-weight:normal'>" . $recipeDuration . " minutes</h5>
                                                </div>
                                                </div>
                                                <div class='row'>
                                                <div class='col-md-6'>
                                                <h4 style='text-align: center;;'>Ingredients in Fridge</h4>
                                                <h4 style='text-align: center; color: green;'>" . $have . "</h4>
                                                </div>
                                                
                                                <div class='col-md-6'>
                                                <h4 style='text-align: center;;'>Additional Ingredients Needed</h4>
                                                <h5 style='text-align: center; color: red;'>" . $dont . "</h5>
                                                </div>
                                                </div>
                                                </button>
                                                </form>
                                            </li>";
                                    }        
                                }
                            ?>
						</ul>
					</div>
                    </fieldset>
                    </form>
                    </div>
                </div>
        </div>
        <script src="scripts.js"></script>
        </body>
    </html>