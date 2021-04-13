<?php
	require("api/users.php");
	require("api/recipes.php");
	require("api/follows.php");
?>

<?php 
	session_start();
	$_SESSION["returnPath"] = "../profile.php?id=$_GET[id]";
?>

<?php
	if (!empty($_GET["id"])) {
		$user = getUserByID($_GET["id"])[1];
	}

	if (empty($user)) {
		echo("Uh oh!");
		die();
	}

	$recipes = getRecipeByUser($_GET["id"])[1];
	$followers = getUserFollowers($_GET["id"])[1];
	$follows = false;

	if (isset($_SESSION["userID"])) {
		foreach ($followers as $follow) {
			if ($follow["FollowerID"] == $_SESSION["userID"]) {
				$follows = true;
			}
		}
	}
?>

<?php
	if (!empty($_POST["detailsName"])) {
		if (isset($_SESSION["userID"]) && $_SESSION["userID"] == $_GET["id"]) {
			updateUser($_GET["id"], $_POST["detailsName"], $user["CASName"], $_POST["detailsPostcode"]);
			$user["PreferredName"] = $_POST["detailsName"];
			$user["Postcode"] = $_POST["detailsPostcode"];
		} else {
			echo("Uh oh!");
			die();
		}
	} else if (!empty($_POST["isFollow"])) {
		createFollow($_SESSION["userID"], $_GET["id"]);
		$follows = true;
	} else if (!empty($_POST["isUnfollow"])) {
		deleteFollow($_SESSION["userID"], $_GET["id"]);
		$follows = false;
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("head.html") ?>
		<link rel="stylesheet" href="recipeStyles.css">
	</head>
	<body>
	<?php include("nav.php") ?>
	<div class="container">
		<div class="row" id="title">
			<div class="col p-3">
				<header>
					<div class="row">
						<div class="col-10">
							<h1><?php echo($user["PreferredName"]); ?></h1>
							<p><?php echo(count($recipes)) ?> Recipes | <?php echo(count($followers)) ?> Followers</p>
						</div>
						<div class="col-s2">
							<?php
								if (isset($_SESSION["userID"]) && $_SESSION["userID"] != $_GET["id"]) {
									if ($follows == true) {
										echo("
											<form method='POST' action='profile.php?id=$_GET[id]'>
												<input type='text' style='display: none;' name='isUnfollow' value='unfollow'>
												<button class='btn btn-lg btn-danger' href='#!' type='submit'>Unfollow</button>
											</form>
										");
									} else {
										echo("
											<form method='POST' action='profile.php?id=$_GET[id]'>
												<input type='text' style='display: none;' name='isFollow' value='follow'>
												<button class='btn btn-lg btn-primary' href='#!' type='submit'>Follow</button>
											</form>
										");
									}
								} else if (isset($_SESSION["userID"])) {
									echo("<a href='#!' data-toggle='modal' data-target='#modal-change-details'>Change Details?</a>");
								}
							?>
						</div>
					</div>
				</header>
			</div>
		</div>
		<div class="row" id="main">
			<div class="col-12">
				<main>
					<section>
						<h2>User's Recipes</h2>
						<div id="recipes">
							<?php
								foreach ($recipes as $recipe) {
									echo("
										<div class='row'>
											<div class='col-10'>
												<h4>$recipe[Name]</h4>
												<p>$recipe[Description]</p>
											</div>
											<div class='col-2'>
												<a class='btn btn-primary right' href='recipe.php?id=$recipe[ID]'>View</a>
											</div>
										</div>
									");
								}
							?>
						</div>
					</section>
				</main>
			</div>	
		</div>
		<div id="modal-change-details" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Change Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="alert" class="alert alert-danger" role="alert" style="display: none;">Please provide a preferred name.</div>
						<?php echo("<form id='change-details-form' method='POST' action='profile.php?id=$_GET[id]'>"); ?>
						<div class="form-group">
							<label for="detailsName">Preferred Name</label>
							<?php echo("<input type='text' class='form-control' id='detailsName' name='detailsName' value='$user[PreferredName]'>"); ?>
						</div>
						<div class="form-group">
							<label for="detailsPostcode">Postcode (Optional)</label>
							<?php echo("<input type='text' class='form-control' id='detailsPostcode' name='detailsPostcode' value='$user[Postcode]'>"); ?>
							<small id="postcodeSubtext" class="form-text text-muted">This is used for the ingredient matching service.</small>
						</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="profile-submit">Submit</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
		<script src="scripts.js"></script>
		<script src="profileScripts.js"></script>
	</body>
</html>
