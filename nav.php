<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="home.php">StudentChef</a>
	<div class="collapse navbar-collapse">
		<div class="navbar-nav ml-auto">
			<a class="nav-link" href="location.php">Ingredient Sharing</a>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Categories
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="#">Vegetarian</a>
				  <a class="dropdown-item" href="#">Halal</a>
				  <a class="dropdown-item" href="#">Vegan</a>
				  <a class="dropdown-item" href="#">Dessert</a>
				  <a class="dropdown-item" href="#">More</a>
				</div>
			  </li>
			<a class="nav-link" href="submitRecipe.php">Submit Recipe</a>
			<?php 
            if (!isset($_SESSION["authTime"]) || !isset($_SESSION["username"])){
                echo "<a class='nav-link' href='auth/login.php'>Login/Signup</a>";
            }else{
            	echo "<a class='nav-link' href='requestsPage.php'>Your Requests</a>";
                echo "<a class='nav-link' href='auth/logout.php'>Logout</a>";
            }
            ?>
		</div>
	</div>
</nav>
