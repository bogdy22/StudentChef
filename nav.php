<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="home.php">StudentChef</a>
	<div class="collapse navbar-collapse">
		<div class="navbar-nav ml-auto">
			<a class="nav-link" href="location.php">Ingredient Sharing</a>
			<a class="nav-link" href="submitRecipe.php">Submit Recipe</a>
			<?php 
            if (!isset($_SESSION["authTime"]) || !isset($_SESSION["username"])){
                echo "<a class='nav-link' href='auth/login.php'>Login/Signup</a>";
            }else{
				$apiUser = getUserByCASName($_SESSION["username"])[1];
				if ($apiUser["Admin"]) {
					echo "<a class='nav-link' href='reports.php'>Reports</a>";
				}
				echo "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle' href='profile.php?id=$apiUser[ID]' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>My Profile</a>
					<div class='dropdown-menu' aria-labelledby='navbarDropdown' style='margin-left: -42px;'>
						<a class='dropdown-item' href='profile.php?id=$apiUser[ID]'>Profile Page</a>
						<a class='dropdown-item' href='fridge.php'>My Fridge</a>
						<a class='dropdown-item' href='auth/logout.php'>Log out</a>
					</div></li>";            }
            ?>
		</div>
	</div>
</nav>
