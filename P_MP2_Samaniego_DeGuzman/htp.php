<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In - Between</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link your custom stylesheet -->
    <link rel="stylesheet" href="htpstyles.css">
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <embed src="beach.mp3" loop="true" hidden="true" autoplay="true">

</head>

<body>

    <div class="loading-overlay" id="loadingOverlay">
        <img src="loading.gif" alt="Loading..." class="loading-message" draggable="false">
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

    <div class="blurred-container" id="container">
        <div class="message">
            <!-- Add your message here -->
            <h4>In-Between Game Mechanics</h4>
            <h5>• Two cards are randomly drawn and shown to the player.</h5>
            <h5>• The player must choose between "DEAL" or "NO DEAL".</h5>
            <h5>• After the choice, the hidden card is revealed.</h5>
            <h3>DEAL Option:</h3>
            <h5>• Player wins [5pts] if the third card is in-between the first two drawn cards.</h5>
            <h3>NO DEAL Option:</h3>
            <h5>• Player wins [5pts] if the third card is not in-between the first two drawn cards.</h5>
            <h3>Identical Cards:</h3>
            <h5>• Player chooses between "HIGHER" or "LOWER" to adjust the numbers.</h5>
            <h5>• Winning or losing mechanics are similar to the "DEAL" option.</h5>
            </ul>
        </div>
    </div>

    <div class="menu">
        <button onclick="fadeAndRedirect('index.php')" class="comic-button">Return</button>
    </div>



    <!-- Add Bootstrap's JavaScript (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>