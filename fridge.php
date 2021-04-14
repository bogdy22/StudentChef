<?php

require_once('api/ingredients.php');
require_once('api/user_ingredients.php');
require_once('api/users.php');


session_start();
$_SESSION["returnPath"] = "../fridge.php";

$userID = getUserByCASName($_SESSION['username'])[1]["ID"];


if (isset($_POST['submit'])){
    if (getUserIngredients($userID)[1]!=0){
        deleteUserIngredient($userID);
    }
    if (isset($_POST['ingredients'])){
        $ingredients = $_POST['ingredients'];
        $excess = $_POST['excess'];
        foreach($ingredients as $i =>$ingredient){
            $ingredientID = searchIngredients($ingredient)[1][0]["ID"];
            createUserIngredient($userID, $ingredientID, $excess[$i]);
            
        }
    }
}


?>

<!DOCTYPE html>
    <html lang='en'>
        <head>
        <?php 	include("head.html");
                require_once("api/user_ingredients.php");
                require_once("api/ingredients.php")
				
		?>
            <link rel='stylesheet' type='text/css' href='fridgeStyles.css'>
        </head>
        <body>
        <?php include('nav.php') ?>
        <div class='container'>
            <div class='row'>
                <div class="col p-3">
					<header >
						<h1 style="text-align: center" class = "contain" >My Fridge </h1><button type='button' onclick="window.location.href='fridgeRecipes.php';" class="btn btn-primary btn-lg float-right" style="display:inline;">View Recipes</button>
                    </header>
				</div>
			</div>
            <div class="row">
                <div class="col p-3">
                    <main>
                    <div class="square">
                    <button type="button" id="edit" onclick="window.location.href='editFridge.php';" class="btn btn-primary btn-lg float-right" style=" position: absolute; top: 10px; right: 15px; width:150px;" >Edit</button></h3>
                    <div id="recipeIngredients">
						<ul>
							<?php
                                if (count(getUserIngredients($userID)[1]) != 0){
                                    foreach(getUserIngredients($userID)[1] as $record){  
                                        $ingredientID = $record['IngredientID'];
                                        $ingredient = getIngredientByID($ingredientID)[1]["Name"];  
                                        echo "<li class='mb-3'>
                                                <h3 style='text-align: center;' class='ingr'>". $ingredient . "</h3>
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
		<script src="fridgejs.js"></script>
        </body>
    </html>