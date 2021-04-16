<?php
require_once('api/recipes.php');
require_once('api/ingredients.php');
require_once('api/recipes_ingredients.php');
require_once('api/measures.php');
require_once('api/users.php');

session_start();
require("api/importer.php");
 
if (isset($_POST['submit'])){
    $recipeTitle = $_POST['recipeTitle']; 
    $description = $_POST['recipeTagline']; 
    $instructionlist = $_POST['instructions'];
    $instructions = implode('|', $instructionlist);
    $ingredientlist = $_POST['ingredients'];
    $amountlist = $_POST['amount'];
    $measurelist = $_POST['measure'];
    $difficulty = $_POST['difficulty'];
    $duration = $_POST['duration'];
    $recipe = createRecipe($recipeTitle, $description, $instructions, $duration , $difficulty, getUserByCASName($_SESSION["username"])[1]["ID"]);
    foreach ($ingredientlist as $i => $ingredient){
        if (count(searchIngredient($ingredientlist[$i], $measurelist[$i])[1])==0){
            $ing = createIngredient($ingredientlist[$i], $measurelist[$i])[1];
            createRecipeIngredient($recipe[1], $ing, $amountlist[$i]);
        }else{
            $ing = searchIngredients($ingredientlist[$i])[1][0];
            createRecipeIngredient($recipe[1], $ing["ID"], $amountlist[$i]);
        }


    }

   
 }    
?>

<!DOCTYPE html>
    <html lang='en'>
        <head>
            <?php include('head.html') ?>
            <link rel='stylesheet' type='text/css' href='submitRecipeStyles.css'>
        </head>
        <body>
        <?php include('nav.php') ?>
        <div class='container'>
            <h1 style='text-align: center;'> Your recipe has been submitted</h1>
            <img src='img\check-mark-8-256.png' class='center' style='width:100px'>
        </div>
        </body>
    </html>

