<?php
// Start the session
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In - Between</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link your custom stylesheet -->
    <link rel="stylesheet" href="index2-styles.css">
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <embed name="lobby" src="beach.mp3" loop="true" hidden="true" autostart="true">

</head>

<body>
    <!-- Loading screen -->
    <div class="loading-overlay" id="loadingOverlay">
        <img src="loading.gif" alt="Loading..." class="loading-message" draggable="false">
    </div>

    <div class="container" id="container"> <!-- Added id attribute -->

        <div class="gamemode">
            <h1> Pick Game Mode </h1>
        </div>

        <div class="cards">
            <a href="game3.php" class="card red">
                <p class="tip">3 rounds</p>
            </a>
            <a href="game5.php" class="card blue">
                <p class="tip">5 rounds</p>
            </a>
            <a href="game10.php" class="card green">
                <p class="tip">10 rounds</p>
            </a>
            <div class="cardbutton">
                <button onclick="fadeAndRedirect('index.php')" class="comic-button">Return</button>
            </div>
        </div>


        <script>
            // Wait for the page to load
            window.addEventListener('load', function () {
                var container = document.getElementById('container');
                container.style.transition = 'opacity 0.5s ease'; // Apply CSS transition for opacity change
                container.style.opacity = '1'; // Set opacity to 1 for fade-in effect

                // Hide loading overlay when page is fully loaded
                var loadingOverlay = document.getElementById('loadingOverlay');
                loadingOverlay.classList.add('hidden');
            });

            function fadeAndRedirect(destination) {
                var container = document.getElementById('container');
                container.style.transition = 'opacity 0.5s ease'; // Apply CSS transition for opacity change
                container.style.opacity = '0'; // Set opacity to 0 for fade-out effect
                var loadingOverlay = document.getElementById('loadingOverlay');
                loadingOverlay.classList.remove('hidden'); // Show loading overlay
                setTimeout(function () {
                    window.location.href = destination; // Redirect to the destination after the animation completes
                }, 500); // Wait for 500 milliseconds (same duration as the transition)
            }
        </script>
        <!-- Add Bootstrap's JavaScript (optional) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>