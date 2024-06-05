<html>
<head>
	<title>health monitor</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		.logo {
			width: 100px; /* Adjust the width as needed */
			height: auto; /* Maintain the aspect ratio */
		}
		.banner {
		  width: 100%; /* or set a specific width in pixels, like 1000px */
		  height: auto;
		  background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url("https://cdn.thewirecutter.com/wp-content/media/2023/06/fitnesstrackers-2048px-09826.jpg");
		  background-size: cover;
		  background-position: center;
		}
	</style>
</head>
<body>
	<div class="banner">
		<div class="navbar">
			<img src="https://assets.materialup.com/uploads/c23d0f70-c0db-4ab0-9a6a-ece0f8ce568b/preview.jpg" class="logo">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="dash.php">Dashboard</a></li>
				<li><a href="weight.php">Weight Tracking</a></li>
				<li><a href="bp.php">BP Tracking</a></li>
				<li><a href="o2.php">O2 Tracking</a></li>
				<li><a href="workout.php">Workouts</a></li>
			</ul>
		</div>
		<div class="c">
			<?php
				require_once("db.php");

				// Fetch user names for selection
				$sqlUsers = "SELECT * FROM `user`";
				$qryUsers = mysqli_query($conn, $sqlUsers);

				// Check if the form is submitted
				if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
					// Check if user_id is set and not empty
					if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
						// Get the selected user's ID
						$selectedUserId = $_POST['user_id'];

						// Fetch weight records for the selected user
						// Fetch weight records for the selected user
						$sql = "SELECT * FROM `weight` WHERE user_id = $selectedUserId";
						$qry = mysqli_query($conn, $sql);

						if (mysqli_num_rows($qry) > 0) {
							echo "<div class='user-info'>";
							$userSql = "SELECT name FROM `user` WHERE id = $selectedUserId";
							$userQry = mysqli_query($conn, $userSql);
							$userRow = mysqli_fetch_assoc($userQry);
							echo "<h2>User: " . $userRow['name'] . "</h2>";

							echo "</div>";

							echo "<div class='weight-info'>";
							echo "<h3>Weight Information:</h3>";
							echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered'>";
							echo "<thead class='thead-light'>";
							echo "<tr><th>Date</th><th>Weight (kg)</th><th>Height (cm)</th></tr>";
							echo "</thead>";
							echo "<tbody>";

							while ($row = mysqli_fetch_assoc($qry)) {
								echo "<tr>";
								echo "<td>" . $row['cdate'] . "</td>";
								echo "<td>" . $row['weight'] . "</td>";
								echo "<td>" . $row['height'] . "</td>";
								echo "</tr>";
							}

							echo "</tbody>";
							echo "</table>";
							echo "</div>";
							echo "</div>";
						}
						// Fetch o2 records for the selected user
						// Fetch o2 records for the selected user
						$sql = "SELECT * FROM `o2` WHERE user_id = $selectedUserId";
						$qry = mysqli_query($conn, $sql);

						if (mysqli_num_rows($qry) > 0) {
							echo "<div class='user-info'>";
							$userSql = "SELECT name FROM `user` WHERE id = $selectedUserId";
							$userQry = mysqli_query($conn, $userSql);
							$userRow = mysqli_fetch_assoc($userQry);
							echo "<h2>User: " . $userRow['name'] . "</h2>";

							echo "</div>";

							echo "<div class='o2-info'>";
							echo "<h3>o2 Information:</h3>";
							echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered'>";
							echo "<thead class='thead-light'>";
							echo "<tr><th>Date</th><th>o2</th></tr>";
							echo "</thead>";
							echo "<tbody>";

							while ($row = mysqli_fetch_assoc($qry)) {
								echo "<tr>";
								echo "<td>" . $row['cdate'] . "</td>";
								echo "<td>" . $row['o2'] . "</td>";
								echo "</tr>";
							}

							echo "</tbody>";
							echo "</table>";
							echo "</div>";
							echo "</div>";
						}
						// Fetch bp records for the selected user
						// Fetch bp records for the selected user
						$sql = "SELECT * FROM `bp` WHERE user_id = $selectedUserId";
						$qry = mysqli_query($conn, $sql);

						if (mysqli_num_rows($qry) > 0) {
							echo "<div class='user-info'>";
							$userSql = "SELECT name FROM `user` WHERE id = $selectedUserId";
							$userQry = mysqli_query($conn, $userSql);
							$userRow = mysqli_fetch_assoc($userQry);
							echo "<h2>User: " . $userRow['name'] . "</h2>";

							echo "</div>";

							echo "<div class='bp-info'>";
							echo "<h3>bp Information:</h3>";
							echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered'>";
							echo "<thead class='thead-light'>";
							echo "<tr><th>Date</th><th>systolic</th><th>diastolic</th></tr>";
							echo "</thead>";
							echo "<tbody>";

							while ($row = mysqli_fetch_assoc($qry)) {
								echo "<tr>";
								echo "<td>" . $row['cdate'] . "</td>";
								echo "<td>" . $row['systolic'] . "</td>";
								echo "<td>" . $row['diastolic'] . "</td>";
								echo "</tr>";
							}

							echo "</tbody>";
							echo "</table>";
							echo "</div>";
							echo "</div>";
						}
					}
				}
				// Display user selection form
				echo "<div class='content'>";
				echo "<form method='POST' action=''>";
				echo "<label for='user_id'>Select User:</label>";
				echo "<select name='user_id'>";
				while ($userRow = mysqli_fetch_assoc($qryUsers)) {
					echo "<option value='" . $userRow['id'] . "'>" . $userRow['name'] . "</option>";
				}
				echo "</select>";
				echo "<input type='submit' name='submit' value='Fetch'>";
				echo "</form>";
				echo "</div><br><br><br><br><br><br><br><br><br><br><br><br><br>";
			?>
			
		</div>
	</div>
</body>
</html>
