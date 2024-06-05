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
        .table {
            color: yellow;
        }
        .videos {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
        }
        .video-container {
            width: 30%; /* Adjust as needed */
            margin-bottom: 20px; /* Adjust spacing between videos */
            text-align: center;
        }
        .video-container iframe {
            width: 100%;
            height: 250px; /* Adjust the height as needed */
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
            <div class="videos">
                <div class="video-container">
                    <p>Full body workout</p>
                    <iframe width="420" height="315" src="https://www.youtube.com/embed/4sUGg9mcMGU"></iframe>
                </div>
                <div class="video-container">
                    <p>Upper body workout</p>
                    <iframe width="420" height="315" src="https://www.youtube.com/embed/RPbscYct3I4"></iframe>
                </div>
                <div class="video-container">
                    <p>Lower body workout</p>
                    <iframe width="420" height="315" src="https://www.youtube.com/embed/_PRk8DH2_mY"></iframe>
                </div>
                <div class="video-container">
                    <p>Core workout</p>
                    <iframe width="420" height="315" src="https://www.youtube.com/embed/g2jocInockU"></iframe>
                </div>
                <div class="video-container">
                    <p>Arms workout</p>
                    <iframe width="420" height="315" src="https://www.youtube.com/embed/rK0coo_v3A0"></iframe>
                </div>
                <!-- Add more video containers here if needed -->
            </div>
        </div>
    </div>
</body>
</html>
