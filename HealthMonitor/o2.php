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
		.table{
			color:yellow;
		}

	</style>
</head>
<body>
	<div class="banner">
		<div class="navbar">
			<img src="https://assets.materialup.com/uploads/c23d0f70-c0db-4ab0-9a6a-ece0f8ce568b/preview.jpg" class="logo">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="dash2.php">Dashboard</a></li>
				<li><a href="weight.php">Weight Tracking</a></li>
				<li><a href="bp.php">BP Tracking</a></li>
				<li><a href="o2.php">O2 Tracking</a></li>
				<li><a href="workout.php">Workouts</a></li>
			</ul>
		</div>
		<div class="content">
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

						// Fetch o2 records for the selected user
						$sql = "SELECT * FROM `o2` WHERE user_id = $selectedUserId ORDER BY cdate DESC LIMIT 1";
						$qry = mysqli_query($conn, $sql);

						if (mysqli_num_rows($qry) > 0) {
							echo "<div class='user-info'>";
							echo "<h2>User: " . getUserName($conn, $selectedUserId) . "</h2>";
							echo "</div>";

							echo "<div class='o2-info'>";
							echo "<h3>O2 Information:</h3>";
							echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered'>";
							echo "<thead class='thead-light'>";
							echo "<tr><th>Date</th><th>O2</th></tr>";
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

							// Calculate o2 and display classification
							calculateAndDisplayo2($conn, $selectedUserId);
							// Add an update button that redirects to another page
							echo "<div class='content'>";
							echo "<form method='POST' action='o22.php'>";  // Replace 'update_page.php' with the actual filename of your update page
							echo "<input type='hidden' name='selectedUserId' value='$selectedUserId'><br><br><br>";
							echo "<input type='submit' name='updateButton' value='Update o2'>";
							echo "</form>";
							echo "</div>";
						} else {
							echo "<p>No O2 records found for the selected user.</p>";
						}

					} else {
						echo "<p>Please select a user.</p>";
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
				echo "<input type='submit' name='submit' value='Fetch o2'>";
				echo "</form>";
				echo "</div><br><br><br><br><br><br><br><br><br><br><br><br>";

				function calculateAndDisplayo2($conn, $userId) {
					// Fetch user's o2
					$sql = "SELECT o2 FROM `o2` WHERE user_id = $userId ORDER BY cdate DESC LIMIT 1";
					$qry = mysqli_query($conn, $sql);

					$o2 = [];
				

					while ($row = mysqli_fetch_assoc($qry)) {
						$o2[] = $row['o2'];
						
					}

					if (!empty($o2) ) {
						// Calculate o2
						$o2_value = array_map(function ($o2) {
							return $o2;
						}, $o2);

						// Display o2 classification
						echo "<div class='o2-info'>";
						echo "<h3>O2 Information:</h3>";
						echo "<div class='table-responsive'>";
						echo "<table class='table table-bordered'>";
						echo "<thead class='thead-light'>";
						echo "<tr><th>O2</th><th>Classification</th></tr>";
						echo "</thead>";
						echo "<tbody>";

						foreach ($o2_value as $index => $o2level) {
							$classification = geto2Classification($o2level);
							echo "<tr>";
							echo "<td>" . number_format($o2level, 1) . "</td>";
							echo "<td>" . $classification . "</td>";
							echo "</tr>";
						}

						echo "</tbody>";
						echo "</table>";
						echo "</div>";
						echo "</div>";

					}
				}

				function geto2Classification($o2level) {
					if ($o2level < 90) {
						return "low";
					} 
					else {
						return "normal";
					}
				}

				function getUserName($conn, $userId) {
					$sql = "SELECT name FROM `user` WHERE id = $userId";
					$qry = mysqli_query($conn, $sql);
					$userRow = mysqli_fetch_assoc($qry);
					return $userRow['name'];
				}
			?>
			
		</div>
	</div>
</body>
</html>
