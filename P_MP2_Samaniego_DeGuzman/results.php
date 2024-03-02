<?php
session_start(); // Start the session to access session data

// Function to calculate and display results
function displayResults($points, $round)
{
    // Display the total points and round
    echo "<p>Total Points: $points</p>";
    echo "<p>Rounds: $round</p>";
}

// Retrieve points and round from URL parameters
$points = isset($_GET['points']) ? $_GET['points'] : 0;
$round = isset($_GET['round']) ? $_GET['round'] : 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Results</title>
    <link rel="stylesheet" href="results-styles.css">
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <embed name="unicorn" src="hollow.mp3" loop="true" hidden="true" autostart="true">
</head>

<body>

    <div class="container">
        <h1>Game Results</h1>

        <?php
        // Display the results
        displayResults($points, $round);
        ?>

        <a href="index.php"> <button class="lobby-button" onclick="goBackToGame()">Go Back to Lobby</button> </a>

    </div>

</body>

</html>
