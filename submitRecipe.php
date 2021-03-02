<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("head.html") ?>
		<link rel="stylesheet" type="text/css" href="submitRecipeStyles.css">
	</head>
	<body>
	

		<?php include("nav.php") ?>
		<div class="container">
			<div class="row">
				<div class="col p-3">
					<header>
						<h1>Submit new recipe  <button type="button" id="submit" class="btn btn-primary btn-lg float-right">Submit Recipe</button></h1>
						<p>Please simply fill in the below fields</p>
					</header>
				</div>
			</div>
			<div class="row">
				<div class="col p-3">
					<main>
						<div id="alert" class="alert alert-danger" role="alert" style="display: none;"></div>
						<form>
							<fieldset class="form-group">
								<h3>Basic Information</h3>
								<div class="mb-3">
									<label for="recipeTitle" class="form-label">Recipe Title</label>
									<input type="text" class="form-control" id="recipeTitle" name="recipeTitle">
								</div>
								<div class="mb-3">
									<label for="recipeTagline" class="form-label">Recipe Tagline</label>
									<input type="text" class="form-control" id="recipeTagline" name="recipeTagline">
								</div>
							</fieldset>
							<fieldset class="form-group">
								<h3>Ingredients  <button type="button" id="newIngredient" class="btn btn-success">+</button></h3>
								<div id="recipeIngredients">
									<ul>
										<em class="initial-text">Nothing</em>
									</ul>
								</div>
							</fieldset>
							<fieldset class="form-group">
								<h3>Instructions <button type="button" id="newInstruction" class="btn btn-success">+</button></h3>
								<div id="recipeInstructions">
									<ol>
										<em class="initial-text">Nothing</em>
									</ol>
								</div>
							</fieldset>
						</form>
					</main>
				</div>
			</div>
		</div>
		<div style="display: none;">
			<div id="ingredientTemplate">
				<li class="mb-3">
					<input type="text" class="form-control"><button type="button" class="btn btn-danger delete">x</button>
				</li>
			</div>
			<div id="instructionTemplate">
				<li class="mb-3">
					<input type="text" class="form-control"><button type="button" class="btn btn-danger delete">x</button>
				</li>
			</div>
		</div>
		<script src="scripts.js"></script>
		<script src="submitRecipeScripts.js"></script>
	</body>
</html>