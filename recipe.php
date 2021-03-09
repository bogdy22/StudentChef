<?php 
session_start();
$_SESSION["returnPath"] = "../recipe.php?id=$_GET[id]";
?>

<?php
	require("api/recipes.php");
	require("api/recipes_ingredients.php");
	require("api/ingredients.php");
	require("api/measures.php");
	require("api/feedback.php");
	require("api/users.php");
?>

<?php
	if (!empty($_POST["recipeRating"]) && !empty($_POST["recipeDifficulty"]) && !empty($_POST["recipeDuration"])) {
		if (!empty($_SESSION["username"])) {
			$res = getUserByCASName($_SESSION["username"]);
			$UserID = $res[1]["ID"];
			createFeedback($_POST["recipeRating"], $_POST["recipeReview"], $_POST["recipeDuration"], $_POST["recipeDifficulty"], $_GET["id"], $UserID);
		}
	}
?>

<?php
	$recipe = getRecipeByID($_GET["id"])[1];
	$user = getUserByID($recipe["UserID"])[1];
	$feedback = getFeedbackByRecipe($_GET["id"])[1];

	// TODO: This is inefficient. Use SQL joins.
	$ingredients = [];
	$ingredientRecords = getRecipeIngredients($recipe["ID"])[1];
	$ingredientsList = getAllIngredients()[1];
	$meauresList = getAllIngredientMeasures()[1];
	foreach ($ingredientRecords as $record) {
		$ingredient = array();
		foreach ($ingredientsList as $ingredientsListItem) {
			if ($ingredientsListItem["ID"] == $record["IngredientID"]) {
				foreach ($meauresList as $meauresListItem) {
					if ($meauresListItem["Measure_ID"] == $ingredientsListItem["Measure"]) {
						$ingredient["Name"] = $ingredientsListItem["Name"];
						$ingredient["Quantity"] = $record["Quantity"];
						$ingredient["Measure"] = $meauresListItem["Measure"];
						array_push($ingredients, $ingredient);
					}
				}
			}
		}
	}
	// END TODO

	$rating = 0;
	foreach ($feedback as $review) {
		$rating += $review["Rating"];
	}
	$rating = round($rating / count($feedback));

	// BEGIN DEVTEST: Temporary Variables for Things Not Yet Implemented
	$userRecipes = 5;
	$userFollowers = 82;
	// END DEVTEST
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("head.html") ?>
		<link rel="stylesheet" type="text/css" href="recipeStyles.css">
	</head>
	<body>
	<?php include("nav.php") ?>
	<div class="container">
		<div class="row" id="title">
			<div class="col p-3">
				<header>
					<h1><?php echo($recipe["Name"]); ?></h1>
					<p><?php echo($recipe["Description"]); ?></p>
				</header>
			</div>
		</div>
		<div class="row" id="main">
			<div class="col-8 p-3" id="left-col">
				<main>
					<section>
						<h2>Instructions</h2>
						<ol id="instructions">
							<?php
								$instructions = explode("|", $recipe["Instructions"]);
								foreach ($instructions as $instruction) {
									echo("<li>$instruction</li>");
								}
							?>
						</ol>
					</section>
				</main>
				<footer>
					<div class="btn-group d-flex justify-content-center" role="actions" aria-label="More Actions">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-view-feedback">View Feedback</button>
						<?php
							if (isset($_SESSION["authTime"])) {
								echo('<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-write-feedback">Write Feedback</button>');
							} else {
								echo('<button type="button" class="btn btn-primary disabled" data-toggle="modal" data-target="#modal-write-feedback">Write Feedback</button>');
							}
						?>
						<button type="button" class="btn btn-primary">Find Ingredients</button>
						<button type="button" class="btn btn-danger disabled">Report Page</button>
					</div>
				</footer>
			</div>
			<div class="col-4 p-3" id="right-col">
				<aside>
					<section>
						<h2>Ingredients</h2>
						<ul id="ingredients">
							<?php
								foreach ($ingredients as $ingredient) {
									echo("<li>" . $ingredient["Quantity"] . $ingredient["Measure"] . " " . $ingredient["Name"] . "</li>");
								}
							?>
						</ul>
					</section>
					<section>
						<h2>Average Rating</h2>
						<p title="<?php echo($rating); ?> Stars" class="rating">
							<?php
								echo($rating >= 1 ? "★ " : "☆ ");
								echo($rating >= 2 ? "★ " : "☆ ");
								echo($rating >= 3 ? "★ " : "☆ ");
								echo($rating >= 4 ? "★ " : "☆ ");
								echo($rating >= 5 ? "★ " : "☆ ");
							?>
						</p>
					</section>
					<section>
						<h2>Average Difficulty</h2>
						<?php
							if ($recipe["Difficulty"] >= 5) {
								$difficulty = "Very Hard";
							} else if ($recipe["Difficulty"] >= 4) {
								$difficulty = "Hard";
							} else if ($recipe["Difficulty"] >= 3) {
								$difficulty = "Intermediate";
							} else if ($recipe["Difficulty"] >= 2) {
								$difficulty = "Easy";
							} else {
								$difficulty = "Very Easy";
							}
						?>
						<p title="<?php echo($recipe["Difficulty"]); ?>/5 - <?php echo($difficulty); ?>" class="difficulty difficulty-<?php echo($recipe["Difficulty"]); ?>">
							<?php
								echo($recipe["Difficulty"] >= 1 ? "● " : "○ ");
								echo($recipe["Difficulty"] >= 2 ? "● " : "○ ");
								echo($recipe["Difficulty"] >= 3 ? "● " : "○ ");
								echo($recipe["Difficulty"] >= 4 ? "● " : "○ ");
								echo($recipe["Difficulty"] >= 5 ? "● " : "○ ");
								echo("- $difficulty");
							?>
						</p>
					</section>
					<section>
						<h2>Author</h2>
						<div class="card">
							<div class="d-flex align-items-center">
								<div class="image"><img src="https://picsum.photos/112" class="rounded" width="112"></div>
								<div class="ml-3 w-100">
									<h4 class="mb-0 mt-0"><?php echo($user["PreferredName"]); ?></h4>
									<span><?php echo(date_format(date_create($recipe["Timestamp"]), "d/m/Y")); ?></span>
									<div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
										<div class="d-flex flex-column"> <span class="card-stat">Recipes</span> <span class="card-number">
											<?php echo($userRecipes); ?>
										</span></div>
										<div class="d-flex flex-column"> <span class="card-stat">Followers</span> <span class="card-number">
											<?php echo($userFollowers); ?>
										</span></div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</aside>
			</div>	
		</div>
		<div id="modal-view-feedback" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">View Recipe Feedback</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?php
							foreach ($feedback as $review) {
								echo("<div>");
								echo("<strong>Rating: </strong>");
								echo($review["Rating"] >= 1 ? "★ " : "☆ ");
								echo($review["Rating"] >= 2 ? "★ " : "☆ ");
								echo($review["Rating"] >= 3 ? "★ " : "☆ ");
								echo($review["Rating"] >= 4 ? "★ " : "☆ ");
								echo($review["Rating"] >= 5 ? "★ " : "☆ ");
								echo("</div>");
								echo("<div>");
								echo("<strong>Difficulty: </strong>");
								echo($review["Difficulty"] >= 1 ? "● " : "○ ");
								echo($review["Difficulty"] >= 2 ? "● " : "○ ");
								echo($review["Difficulty"] >= 3 ? "● " : "○ ");
								echo($review["Difficulty"] >= 4 ? "● " : "○ ");
								echo($review["Difficulty"] >= 5 ? "● " : "○ ");
								echo("</div>");
								echo("<div>");
								echo("<strong>Time Taken: </strong>");
								echo("$review[Duration] Minutes");
								echo("</div>");
								if (!empty($review["Comment"])) {
									echo("<div>");
									echo("<strong>Comment: </strong>");
									echo($review["Comment"]);
									echo("</div>");
								}
								echo("<hr>");
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="modal-write-feedback" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Write Recipe Feedback</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?php echo("<form id='write-feedback-form' method='POST' action='recipe.php?id=$_GET[id]'>"); ?>
							<fieldset class="form-group">
								<div class="mb-3">
									<label for="recipeReview" class="form-label">Review</label>
									<textarea class="form-control" id="recipeReview" name="recipeReview"></textarea>
								</div>
							</fieldset>
							<fieldset class="form-group">
								<div class="mb-3">
									<label for="recipeRating" class="form-label">Rating: <span id="recipeRatingLabel">3</span></label>
									<input type="range" class="form-control" id="recipeRating" name="recipeRating" min="1" max="5" value="3">
								</div>
							</fieldset>
							<fieldset class="form-group">
								<div class="mb-3">
									<label for="recipeDifficulty" class="form-label">Difficulty: <span id="recipeDifficultyLabel">3</span></label>
									<input type="range" class="form-control" id="recipeDifficulty" name="recipeDifficulty" min="1" max="5" value="3">
								</div>
							</fieldset>
							<fieldset class="form-group">
								<div class="mb-3">
									<label for="recipeDuration" class="form-label">Time Taken to Make (Minutes): <span id="recipeDurationLabel">60</span></label>
									<input type="range" class="form-control" id="recipeDuration" name="recipeDuration" min="15" max="180" step="15" value="60">
								</div>
							</fieldset>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="feedback-submit">Submit</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
		<script src="scripts.js"></script>
		<script src="recipeScripts.js"></script>
	</body>
</html>