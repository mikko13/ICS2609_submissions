<?php
// Start the session
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Between</title>
    <link rel="stylesheet" href="gamestylessampu.css">
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <embed name="hell" src="hell.mp3" loop="true" hidden="true" autostart="true">
    <style>
        .dark-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .jackpot-image {
            display: none;
            max-width: 100%;
            max-height: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000; /* Make sure it's above other elements */
            border: 5px solid gold; /* Add a border with gold color and 5px width */
        }

        .leftnumber,
.rightnumber,
.middle {
    position: relative;
    z-index: 1000; /* Set the z-index of the numbers to be below the jackpot image */
}
    </style>

</head>

<body>

    <div class="loading-overlay" id="loadingOverlay">
        <img src="loading.gif" alt="Loading..." class="loading-message" draggable="false">
    </div>

    <?php
    $points = isset($_GET['points']) ? $_GET['points'] : 1;
    $round = isset($_GET['round']) ? $_GET['round'] : 1;

    // Check if the round parameter is not set, then reset round to 1
    if (!isset($_GET['round'])) {
        $round = 1;
    }

    if (!isset($_GET['points'])) {
        $points = 0;
    }

    // Generate two random numbers
    $leftnumber = rand(1, 13);
    $rightnumber = rand(1, 13);
    $middlenumber = rand(1, 20);

    $_SESSION['points'] = $points;
    $_SESSION['round'] = $round;
    ?>

    <div class="container" id="container">
        <p id="leftNumber">
        <div class="leftnumber">
            <?php echo $leftnumber; ?>
        </div>
        </p>
        <p id="rightNumber">
        <div class="rightnumber">
            <?php echo $rightnumber; ?>
        </div>
        </p>

        <div class="middle">
            <h2 id="middleNumber" class="hiddenmiddle">
                <?php echo $middlenumber; ?>
            </h2>
        </div>

        <div class="result">
            <div class="info-container">
                <div class="points">
                    <p id="points">Points:
                        <?php echo $points; ?>
                    </p>
                </div>
                <div class="round">
                    <p id="round">Round:
                        <?php echo $round; ?>
                    </p>
                </div>
                </p>
            </div>

            </p>

            <div class="button-container">
                <?php if ($leftnumber != $rightnumber): ?>
                    <div class="button-container">
                        <?php for ($i = 0; $i < 2; $i++): ?>
                            <button class="comic-button"
                                onclick="revealMiddleNumber('<?php echo ($i == 0) ? 'deal' : 'noDeal'; ?>')">
                                <?php echo ($i == 0) ? 'Deal' : 'No Deal'; ?>
                            </button>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($leftnumber == $rightnumber): ?>
    <div class="button-container2">
        <?php for ($i = 0; $i < 2; $i++): ?>
            <?php if ($i == 0): ?>
                <div class="higher">
                    <button class="comic-button" onclick="revealMiddleNumber('higher')" id="higherBtn">Higher</button>
                </div>
            <?php else: ?>
                <div class="lower">
                    <button class="comic-button" onclick="revealMiddleNumber('lower')" id="lowerBtn">Lower</button>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>


            <div class="button-container">
                <p id="result"></p>
                <button id="nextRoundBtn" class="hidden" onclick="nextRound()">Next Round</button>
            </div>
        </div>
    </div>

            <!-- Dark overlay and jackpot image -->
            <div class="dark-overlay" id="darkOverlay">
    </div>

    <img src="jackpot.gif" alt="Jackpot" class="jackpot-image">

    <script>
        var points = <?php echo $points; ?>;
        var round = <?php echo $round; ?>;
        var maxRounds = 10;
        var leftNumber = <?php echo $leftnumber; ?>;
        var rightNumber = <?php echo $rightnumber; ?>;
        var buttons = document.querySelectorAll("button:not(#nextRoundBtn)");
        var higherBtn = document.getElementById('higherBtn');
        var lowerBtn = document.getElementById('lowerBtn');
        var nextRoundBtn = document.getElementById("nextRoundBtn");
        var jackpotImage = document.querySelector(".jackpot-image");
        var jackpotSound = new Audio('jackpot.mp3');


        function nextRound() {
            round++;
            document.getElementById('round').innerText = "Round: " + round;
            window.location.href = "game10.php?round=" + round + "&points=" + points;
            resetGame();

            // Hide Higher and Lower buttons if left and right numbers are different
            if (leftNumber !== rightNumber) {
                higherBtn.classList.add("hidden");
                lowerBtn.classList.add("hidden");
            } else {
                higherBtn.classList.remove("hidden");
                lowerBtn.classList.remove("hidden");
            }

        }

        function revealMiddleNumber(choice) {
            var middleNumber = <?php echo $middlenumber; ?>;
            var middleNumberDisplay = document.getElementById("middleNumber");
            var resultDisplay = document.getElementById("result");

            middleNumberDisplay.classList.remove("hiddenmiddle");

            buttons.forEach(function (button) {
                button.disabled = true;
            });

            if (choice === 'deal' || choice === 'noDeal' || choice === 'higher' || choice === 'lower') {
                // Show the Next Round button if it's not the last round, otherwise show "See Results"
                if (round < maxRounds) {
                    nextRoundBtn.classList.remove("hidden");
                } else {
                    nextRoundBtn.classList.add("hidden");
                    var seeResultsBtn = document.createElement("button");
                    seeResultsBtn.innerText = "See Results";
                    seeResultsBtn.classList.add("see-results-button"); // Add the CSS class
                    seeResultsBtn.onclick = function () {
                        window.location.href = "results.php?points=" + points + "&round=" + round;
                    };
                    var seeResultsContainer = document.createElement("div");
                    seeResultsContainer.classList.add("see-results-container");
                    seeResultsContainer.appendChild(seeResultsBtn);
                    document.body.appendChild(seeResultsContainer);
                }
            }

            // Game logic
            if (choice === 'deal') {
                if ((leftNumber < middleNumber && middleNumber < rightNumber) || (leftNumber > middleNumber && middleNumber > rightNumber)) {
                    points += 5;
                } else {
                    points -= 5;
                }
            } else if (choice === 'noDeal') {
                if (!((leftNumber < middleNumber && middleNumber < rightNumber) || (leftNumber > middleNumber && middleNumber > rightNumber)) || leftNumber === middleNumber || rightNumber === middleNumber) {
                    points += 5;
                } else {
                    points -= 5;
                }
            }

            if (choice === 'higher') {
                if (leftNumber < middleNumber && rightNumber < middleNumber) {
                    points += 5;
                } else {
                    points -= 5;
                }
            } else if (choice === 'lower') {
                if (leftNumber > middleNumber && rightNumber > middleNumber) {
                    points += 5;
                } else {
                    points -= 5;
                }
            }

            if (leftNumber === middleNumber && middleNumber === rightNumber) {
                points += 55;
                darkOverlay.style.display = "flex";
                jackpotImage.style.display = "block";
                jackpotSound.play(); // Play the jackpot sound
                setTimeout(function () {
                    // Hide the jackpot animation after 3 seconds
                    darkOverlay.style.display = "none";
                    jackpotImage.style.display = "none";
                }, 3000);
            }

            // Ensure points are not negative
            points = Math.max(points, 0);

            // Display points
            document.getElementById("points").innerText = "Points: " + points;
        }
    </script>

    <script>
        // Wait for the page to load
        window.addEventListener('load', function () {
            var container = document.getElementById('container');
            container.style.transition = 'opacity 0.5s ease'; // Adjust transition duration to 3 seconds
            container.style.opacity = '1'; // Set opacity to 1 for fade-in effect

            // Hide loading overlay when page is fully loaded
            var loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.style.transition = 'opacity 0.5s ease'; // Adjust transition duration to 3 seconds
            loadingOverlay.style.opacity = '0'; // Set opacity to 0 to fade out
            setTimeout(function () {
                loadingOverlay.style.display = 'none'; // Hide the loading overlay after fade out
            }, 3000); // Wait for 3000 milliseconds (same duration as the transition)
        });

        function fadeAndRedirect(destination) {
            var container = document.getElementById('container');
            container.style.transition = 'opacity 0.5s ease'; // Adjust transition duration to 3 seconds
            container.style.opacity = '0'; // Set opacity to 0 for fade-out effect

            var loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.style.transition = 'opacity 0.5s ease'; // Adjust transition duration to 3 seconds
            loadingOverlay.style.opacity = '1'; // Set opacity to 1 to fade in

            setTimeout(function () {
                window.location.href = destination; // Redirect to the destination after the animation completes
            }, 500); // Wait for 3000 milliseconds (same duration as the transition)
        }
    </script>
</body>

<footer>
    <h1>IN BETWEEN</h1>
</footer>

</html>