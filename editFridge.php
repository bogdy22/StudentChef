<?php
	session_start();
	$_SESSION["returnPath"] = "../editFridge.php";
    require("auth/isAuth.php");
	require("api/importer.php");
?>

<!DOCTYPE html>
    <html lang='en'>
        <head>
        <?php 	include("head.html");
				$userID = getUserByCASName($_SESSION['username'])[1]["ID"];
		?>

        <?php 
        if (!isset($_SESSION["authTime"]) || !isset($_SESSION["username"]) || !isset($_SESSION["fullName"])) {
            header("Location: auth/login.php");
            die();
        }
        ?>
            <link rel='stylesheet' type='text/css' href='fridgeStyles.css'>
        </head>
        <body>
        <?php include('nav.php') ?>
        <div class='container'>
            <div class='row'>
                <div class="col p-3">
					<header>
						<h1 style="text-align: center" class="contain">My Fridge </h1><input type="submit" id="submit" name="submit" form="fridge" class="btn btn-primary btn-lg float-right">
                    </header>
				</div>
			</div>
            <div class="row">
                <div class="col p-3">
                    <main>
                    <div class="square">
                    <button type="button" id="newIngredient" class="btn btn-success" style=" position: absolute; top: 10px; right: 10px;">+</button></h3>
                    <form id="fridge"  method = "post" action="fridge.php">
                    <fieldset class="form-group">
                    <div id="recipeIngredients">
						<ul>
							<?php
                                if (count(getUserIngredients($userID)[1]) != 0){
                                    foreach(getUserIngredients($userID)[1] as $record){  
                                        $ingredientID = $record['IngredientID'];
                                        $ingredient = getIngredientByID($ingredientID)[1]["Name"];  
                                        if ($record['Excess']==0){
                                            echo "<li class='mb-3'>
                                                    <input type='text' class='form-control ingrEdit' style='display:inline-block; width:70%; margin-left:60px;' value = " .$ingredient.">
                                                    <input type='checkbox' class='form-control' value='1' style='display:inline-block; width: 35px;height:35px; vertical-align: middle;'>
                                                    <button type='button' class='btn btn-danger delete'>x</button>
                                                </li>";
                                        }else{
                                            echo "<li class='mb-3'>
                                                    <input type='text' class='form-control ingrEdit' style='display:inline-block; width:70%; margin-left:60px;' value = " .$ingredient.">
                                                    <input type='checkbox' class='form-control' value='1' style='display:inline-block; width: 35px;height:35px; vertical-align: middle;' checked>
                                                    <button type='button' class='btn btn-danger delete'>x</button>
                                                </li>";
                                        }        
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
        <div style="display: none;">
			<div id="ingredientTemplate">
				<li class="mb-3">
					<input type="text" class="form-control" style="display:inline-block; width:70%; margin-left:60px;">
                    <input type="checkbox" class="form-control" value="1" style="display:inline-block; width: 35px;height:35px; vertical-align: middle;">
					<button type="button" class="btn btn-danger delete">x</button>
				</li>
			</div>
        </div>
        <script src="scripts.js"></script>
		<script src="fridgejs.js"></script>
        </body>
    </html>