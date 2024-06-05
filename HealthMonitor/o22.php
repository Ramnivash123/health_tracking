<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateButton'])) {
    // Check if selectedUserId is set and not empty
    if (isset($_POST['selectedUserId']) && !empty($_POST['selectedUserId'])) {
        $selectedUserId = $_POST['selectedUserId'];

        // Validate and sanitize the input data
        $newo2 = filter_input(INPUT_POST, 'newo2', FILTER_VALIDATE_FLOAT);

        if ($newo2 !== false) {
            // Check if o2 is not null
            if ($newo2 !== null) {
                // Insert new o2 into the o2 table
                $sqlInsert = "INSERT INTO `o2` (user_id, o2, cdate) VALUES (?, ?, NOW())";
                $stmt = mysqli_prepare($conn, $sqlInsert);
                mysqli_stmt_bind_param($stmt, "id", $selectedUserId, $newo2);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<p>o2 updated successfully!</p>";
                } else {
                    echo "<p>Error updating o2: " . mysqli_error($conn) . "</p>";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "<p>o2 cannot be null.</p>";
            }
        } else {
            echo "<p>Invalid input for o2.</p>";
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
    <title>Update o2</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="banner">
    <div class="content">
        <h2>Update o2</h2>
        <form method="POST" action="">
            <input type="hidden" name="selectedUserId" value="<?php echo $selectedUserId; ?>">
            <label for="newo2">New o2:</label>
            <input type="text" name="newo2" required>
            <br>
            
            <input type="submit" name="updateButton" value="Update o2">
        </form>
    </div>
</body>
</html>
