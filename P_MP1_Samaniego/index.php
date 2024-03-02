<?php
$salaryType = 'monthly'; // Initialize $salaryType with a default value
$error = false; // Initialize error flag

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data and calculate tax
    if (is_numeric($_POST['salary']) && $_POST['salary'] >= 0) {
        $salary = floatval($_POST['salary']);
        $salaryType = isset($_POST['salaryType']) ? $_POST['salaryType'] : 'monthly';

        $annualSalary = ($salaryType === 'monthly') ? $salary * 12 : $salary * 2 * 12;

        $annualTax = 0;
        $monthlyTax = 0;

        if ($annualSalary <= 250000) {
            $annualTax = 0;
        } elseif ($annualSalary <= 400000) {
            $annualTax = ($annualSalary - 250000) * 0.20;
        } elseif ($annualSalary <= 800000) {
            $annualTax = 22500 + ($annualSalary - 400000) * 0.25;
        } elseif ($annualSalary <= 2000000) {
            $annualTax = 102500 + ($annualSalary - 800000) * 0.30;
        } elseif ($annualSalary <= 8000000) {
            $annualTax = 402500 + ($annualSalary - 2000000) * 0.32;
        } else {
            $annualTax = 30000 + ($annualSalary - 400000) * 0.25;
        }

        $monthlyTax = $annualTax / 12;
    } else {
        $error = true; // Set error flag to true if salary is non-numeric
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxxy: A Tax Calculator</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
</head>

<header>
    Taxxy: A Tax Calculator
</header>

<body>
<div id="calculatorContainer">

<div id="logo">
    <img src="taxxy_logo.png" alt="taxxy_logo">
</div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div id="salarySection">
            <input type="text" name="salary" id="salary" placeholder="Enter salary (PHP)"
                   value="<?php echo isset($inputSalary) ? $inputSalary : ''; ?>">
        </div>

        <div id="salaryTypeRadio">
            <div class="radio-input">
                <label>
                    <input type="radio" name="salaryType" value="monthly"
                        <?php echo ($salaryType === 'monthly') ? 'checked' : ''; ?>> Monthly
                </label>
                <label>
                    <input type="radio" name="salaryType" value="biMonthly"
                        <?php echo ($salaryType === 'biMonthly') ? 'checked' : ''; ?>> Bi-Monthly
                </label>
            </div>
        </div>

        <button id="calculateTaxButton" type="submit" style="outline: none;">Compute</button>
    </form>

    <?php
    if ($error) {
        echo '<div id="result">';
        echo '<p style="color: red;">Error: Please enter a valid numeric salary.</p>';
        echo '</div>';
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '<div id="result">';
        echo '<hr>';
        echo '<p>Annual Salary (PHP): ' . number_format($annualSalary, 2) . '</p>';
        echo '<p>Est. Annual Tax (PHP): ' . number_format($annualTax, 2) . '</p>';
        echo '<p>Est. Monthly Tax (PHP): ' . number_format($monthlyTax, 2) . '</p>';
        echo '</div>';
    }
    ?>
</div>
</body>
</html>
