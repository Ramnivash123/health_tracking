<html>
<head>
	<title>health monitor</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
				<li><a href="dash2.php">Dashboard</a></li>
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

						// Modify the weight, o2, and bp sections accordingly
						if (mysqli_num_rows($qry) > 0) {
							echo "<div class='user-info'>";
							$userSql = "SELECT name FROM `user` WHERE id = $selectedUserId";
							$userQry = mysqli_query($conn, $userSql);
							$userRow = mysqli_fetch_assoc($userQry);
							echo "<h2>User: " . $userRow['name'] . "</h2>";
							echo "</div>";

							// Chart container
							echo "<div class='chart-container'>";
							echo "<canvas id='myChart'></canvas>";
							echo "</div>";

							// JavaScript to create the chart
							echo "<script>";
							echo "var ctx = document.getElementById('myChart').getContext('2d');";
							echo "var myChart = new Chart(ctx, {";
							echo "type: 'line',";
							echo "data: {";
							echo "labels: [";

							// Populate labels with dates
							$labels = [];
							while ($row = mysqli_fetch_assoc($qry)) {
								$labels[] = "'" . $row['cdate'] . "'";
							}
							echo implode(',', $labels);

							echo "],";
							echo "datasets: [{";
							echo "label: 'Weight (kg)',";
							echo "data: [";

							// Populate data with weight values
							$weights = [];
							mysqli_data_seek($qry, 0);
							while ($row = mysqli_fetch_assoc($qry)) {
								$weights[] = $row['weight'];
							}
							echo implode(',', $weights);

							echo "],";
							echo "backgroundColor: 'rgba(75, 192, 192, 0.2)',";
							echo "borderColor: 'rgba(75, 192, 192, 1)',";
							echo "borderWidth: 1";
							echo "}]}";
							echo "});";
							echo "</script>";
						}

						// Fetch o2 records for the selected user
						// Fetch o2 records for the selected user
						$sql = "SELECT * FROM `o2` WHERE user_id = $selectedUserId";
						$qry = mysqli_query($conn, $sql);

						// Modify the weight, o2, and bp sections accordingly
						if (mysqli_num_rows($qry) > 0) {
						echo "<div class='user-info'>";
						$userSql = "SELECT name FROM `user` WHERE id = $selectedUserId";
						$userQry = mysqli_query($conn, $userSql);
						$userRow = mysqli_fetch_assoc($userQry);
						echo "<h2>User: " . $userRow['name'] . "</h2>";
						echo "</div>";

						// Chart container
						echo "<div class='chart-container'>";
						echo "<canvas id='o2Chart'></canvas>";
						echo "</div>";

						// JavaScript to create the O2 chart
						echo "<script>";
						echo "var ctxO2 = document.getElementById('o2Chart').getContext('2d');";
						echo "var o2Chart = new Chart(ctxO2, {";
						echo "type: 'line',";
						echo "data: {";
						echo "labels: [";

						// Populate labels with dates
						$labels = [];
						$o2 = [];
						while ($row = mysqli_fetch_assoc($qry)) {
							$labels[] = "'" . $row['cdate'] . "'";
							$o2[] = $row['o2'];
						}
						echo implode(',', $labels);

						echo "],";
						echo "datasets: [{";
						echo "label: 'O2 levels',";
						echo "data: [" . implode(',', $o2) . "],";
						echo "backgroundColor: 'rgba(75, 192, 192, 0.2)',";
						echo "borderColor: 'rgba(75, 192, 192, 1)',";
						echo "borderWidth: 1";
						echo "}]}";
						echo "});";
						echo "</script>";
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

						// Chart container for BP
						echo "<div class='chart-container'>";
						echo "<canvas id='bpChart'></canvas>";
						echo "</div>";

						// JavaScript to create the BP chart
						echo "<script>";
						echo "var ctxBP = document.getElementById('bpChart').getContext('2d');";
						echo "var bpChart = new Chart(ctxBP, {";
						echo "type: 'line',";
						echo "data: {";
						echo "labels: [";

						// Populate labels with dates for BP
						$bpLabels = [];
						$systolicValues = [];
						$diastolicValues = [];

						while ($row = mysqli_fetch_assoc($qry)) {
							$bpLabels[] = "'" . $row['cdate'] . "'";
							$systolicValues[] = $row['systolic'];
							$diastolicValues[] = $row['diastolic'];
						}

						echo implode(',', $bpLabels);

						echo "],";
						echo "datasets: [";
						echo "{";
						echo "label: 'Systolic',";
						echo "data: [" . implode(',', $systolicValues) . "],";
						echo "backgroundColor: 'rgba(54, 162, 235, 0.2)',";
						echo "borderColor: 'rgba(54, 162, 235, 1)',";
						echo "borderWidth: 1";
						echo "},";
						echo "{";
						echo "label: 'Diastolic',";
						echo "data: [" . implode(',', $diastolicValues) . "],";
						echo "backgroundColor: 'rgba(255, 206, 86, 0.2)',";
						echo "borderColor: 'rgba(255, 206, 86, 1)',";
						echo "borderWidth: 1";
						echo "}";
						echo "]";
						echo "}";
						echo "});";
						echo "</script>";
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
