<?php
	require("api/recipes.php");
	require("api/users.php");
	require("api/reports.php")
?>

<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        echo("Uh oh!");
		die();
    }
	$apiUser = getUserByCASName($_SESSION["username"])[1];
    if (!$apiUser["Admin"]) {   
		echo("Uh oh!");
		die();
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
                                            <a href='#!' class='btn btn-success'>Ignore Report</a>
                                            <a href='#!' class='btn btn-danger'>Remove Recipe</a>
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