<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateButton'])) {
    // Check if selectedUserId is set and not empty
    if (isset($_POST['selectedUserId']) && !empty($_POST['selectedUserId'])) {
        $selectedUserId = $_POST['selectedUserId'];

        // Validate and sanitize the input data
        $newsystolic = filter_input(INPUT_POST, 'newsystolic', FILTER_VALIDATE_FLOAT);
        $newdiastolic = filter_input(INPUT_POST, 'newdiastolic', FILTER_VALIDATE_FLOAT);

        if ($newsystolic !== false && $newdiastloic !== false) {
            // Check if weight is not null
            if ($newsystolic !== null) {
                // Insert new weight and height into the weight table
                $sqlInsert = "INSERT INTO `bp` (user_id, systolic, diastolic, cdate) VALUES (?, ?, ?, NOW())";
                $stmt = mysqli_prepare($conn, $sqlInsert);
                mysqli_stmt_bind_param($stmt, "idd", $selectedUserId, $newsystolic, $newdiastolic);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<p>bp updated successfully!</p>";
                } else {
                    echo "<p>Error updating bp: " . mysqli_error($conn) . "</p>";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "<p>bp cannot be null.</p>";
            }
        } else {
            echo "<p>Invalid input for bp.</p>";
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
    <div class="content">
    <div class="banner">
        <h2>Update Weight and Height</h2>
        <form method="POST" action="">
            <input type="hidden" name="selectedUserId" value="<?php echo $selectedUserId; ?>">
            <label for="newWeight">New systolic:</label>
            <input type="text" name="newsystolic" required>
            <br>
            <label for="newHeight">New diastolic:</label>
            <input type="text" name="newdiastolic" required>
            <br>
            <input type="submit" name="updateButton" value="Update bp">
        </form>
    </div>
</body>
</html>
