<?php
	session_start();
	$_SESSION["returnPath"] = "../reportsList.php";
    require("auth/isAuth.php");
	require("api/importer.php");
?>

<?php
    if (!isset($_SESSION["username"])) {
        echo("Uh oh!");
		die();
    }
	$apiUser = getUserByCASName($_SESSION["username"])[1];
    if (!$apiUser["Admin"]) {   
		echo("Uh oh!");
		die();
	}

    if (!empty($_POST["ignoreReport"])) {
        updateReports($_POST["ignoreReport"], 'MarkedOK');
    } else if (!empty($_POST["removeRecipe"])) {
        updateReports($_POST["removeRecipe"], 'MarkedBad');
        deleteRecipe($_POST["removeRecipeID"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("head.html") ?>
        <link rel="stylesheet" type="text/css" href="reportsStyles.css">
	</head>
	<body>
        <?php include("nav.php") ?>
        <div class="container">
            <h1>Admin Panel</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Reported Recipe</th>
                        <th>Reporting User</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $reports = getAllReports()[1];
                        foreach($reports as $report) {
                            if ($report["Status"] == "Pending") {
                                echo("
                                    <tr>
                                        <td>
                                            <p style='margin-top: 8px;'>$report[Timestamp]</p>
                                        </td>
                                        <td>
                                            <a href='recipe.php?id=$report[RecipeID]' class='btn btn-primary' target='_blank'>View Recipe</a>
                                        </td>
                                        <td>
                                            <a href='profile.php?id=$report[UserID]' class='btn btn-secondary' target='_blank'>View Profile</a>
                                        </td>
                                        <td>
                                            <form method='POST' action='reports.php' style='display: inline-block;'>
                                                <input type='text' style='display: none;' name='ignoreReport' value='$report[ID]'>
                                                <button type='submit' class='btn btn-success'>Ignore Report</button>
                                            </form>
                                            <form method='POST' action='reports.php' style='display: inline-block;'>
                                                <input type='text' style='display: none;' name='removeRecipe' value='$report[ID]'>
                                                <input type='text' style='display: none;' name='removeRecipeID' value='$report[RecipeID]'>
                                                <button type='submit' class='btn btn-danger'>Remove Recipe</button>
                                            </form>
                                        </td>
                                    </tr>
                                ");
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>