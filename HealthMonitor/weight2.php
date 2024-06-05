<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateButton'])) {
    // Check if selectedUserId is set and not empty
    if (isset($_POST['selectedUserId']) && !empty($_POST['selectedUserId'])) {
        $selectedUserId = $_POST['selectedUserId'];

        // Validate and sanitize the input data
        $newWeight = filter_input(INPUT_POST, 'newWeight', FILTER_VALIDATE_FLOAT);
        $newHeight = filter_input(INPUT_POST, 'newHeight', FILTER_VALIDATE_FLOAT);

        if ($newWeight !== false && $newHeight !== false) {
            // Check if weight is not null
            if ($newWeight !== null) {
                // Insert new weight and height into the weight table
                $sqlInsert = "INSERT INTO `weight` (user_id, weight, height, cdate) VALUES (?, ?, ?, NOW())";
                $stmt = mysqli_prepare($conn, $sqlInsert);
                mysqli_stmt_bind_param($stmt, "idd", $selectedUserId, $newWeight, $newHeight);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<p>Weight and height updated successfully!</p>";
                } else {
                    echo "<p>Error updating weight and height: " . mysqli_error($conn) . "</p>";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "<p>Weight cannot be null.</p>";
            }
        } else {
            echo "<p>Invalid input for weight or height.</p>";
        }
    } else {
        echo "<p>Invalid user ID.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Weight and Height</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
	
<body>
	<div class="banner">
	<div class="content">
        <h2>Update Weight and Height</h2>
        <form method="POST" action="">
            <input type="hidden" name="selectedUserId" value="<?php echo $selectedUserId; ?>">
			
            <label for="newWeight">New Weight (kg):</label>
            <input type="text" name="newWeight" required>
            <br>
            <label for="newHeight">New Height (cm):</label>
            <input type="text" name="newHeight" required>
			
            <br>
            <input type="submit" name="updateButton" value="Update Weight and Height">
        </form>
    </div>
</body>
</html>
