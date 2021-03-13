<!DOCTYPE html>
<html lang="en">
	<head>
		<?php 	include("head.html");
				require_once('api\\measures.php');

				$measures = getAllIngredientMeasures()[1];
				$measuresAbr = [];
				$measureID = [];
				foreach ($measures as $measure){
					array_push($measuresAbr, $measure["Measure"]);
					array_push($measureID, $measure["Measure_ID"]);
				}

		
		?>
		<link rel="stylesheet" type="text/css" href="submitRecipeStyles.css">
	</head>
	<body>
	

		<?php include("nav.php") ?>
		<div class="container">
			<div class="row">
				<div class="col p-3">
					<header>
						<h1>Submit new recipe  <input type="submit" id="submit" name="submit" form="recipe" class="btn btn-primary btn-lg float-right"></h1>
						<p>Please simply fill in the below fields</p>
					</header>
				</div>
			</div>
			<div class="row">
				<div class="col p-3">
					<main>
						<div id="alert" class="alert alert-danger" role="alert" style="display: none;"></div>
						<form id="recipe"  method = "post" action="createRecipe.php">
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
							<h3>Difficulty</h3>
							<fieldset class="rating">
							
							<label>
								<input type="radio" name="difficulty" value="1" />
								<span class="icon">★</span>
							</label>
							<label>
								<input type="radio" name="difficulty" value="2" />
								<span class="icon">★</span>
								<span class="icon">★</span>
							</label>
							<label>
								<input type="radio" name="difficulty" value="3" />
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>   
							</label>
							<label>
								<input type="radio" name="difficulty" value="4" />
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
							</label>
							<label>
								<input type="radio" name="difficulty" value="5" />
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
							</label>
															
							</fieldset>
							<fieldset>
								<h3>Duration</h3>
								<input type="text" name="duration" class="form-control" style="width:30%;"><h6>minutes</h6></input>					
							</fieldset>
						</form>
					</main>
				</div>
			</div>
		</div>
		<div style="display: none;">
			<div id="ingredientTemplate">
				<li class="mb-3">
					<input type="text" class="form-control" style="display:inline-block; width:25%">
					<select class="form-control" style="display:inline-block; width:15%">
						<?php
							foreach ($measuresAbr as $i => $measure){
								echo '<option value="'.$measureID[$i].'">'.$measure.'</option>';
							}


						?>
					<input type="text" class="form-control" style="display:inline-block; width:50%">
					<button type="button" class="btn btn-danger delete">x</button>
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