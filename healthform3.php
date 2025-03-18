<?php
include("includes/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Screening Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f7fa;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2em;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 100px; /* Add margin to prevent content from being covered by the header */
        }

        header {
            background-color: #3a87ad; /* Blue background */
            color: #fff;
            padding: 15px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header .logo {
            display: flex;
            align-items: center;
        }

        header .logo img {
            height: 40px;
            margin-right: 10px;
        }

        header .logo h1 {
            font-size: 20px;
            margin: 0;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }

        header nav ul li {
            display: inline;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        .form {
            padding: 2em;
        }

        .heading h3 {
            font-size: 1.8em;
            text-align: center;
            margin-bottom: 1em;
            color: #3a87ad;
        }

        .columns {
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
            justify-content: space-between;
        }

        .columns div {
            flex: 1 1 30%;
            min-width: 200px;
        }

        .columns input[type="checkbox"] {
            margin-right: 10px;
        }

        .explanation textarea,
        #findings {
            width: 100%;
            padding: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 0.5em;
            font-size: 1em;
        }

        .children {
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
        }

        .children div {
            flex: 1 1 45%; /* Ensure textboxes do not overlap */
            min-width: 250px;
            margin-bottom: 1em; /* Add spacing between inputs */
        }

        .children input {
            width: 90%; /* Reduce width to prevent overlapping */
            padding: 0.8em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 0.8em 1.5em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        .previous {
            background:#007bff;
            color: white;
        }

        .next {
            background: #007bff;
            color: white;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 2em;
        }

        .button-container button {
            width: 150px;
            text-align: center;
        }

        footer {
            background-color: #3a87ad;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            margin-bottom: 0;
        }

        footer span {
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .columns div {
                flex: 1 1 100%;
            }

            .children div {
                flex: 1 1 100%; /* Ensure proper spacing on smaller screens */
            }

            .button-container {
                flex-direction: column;
                gap: 1em;
            }

            .button-container button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Health Screening System Logo">
            <h1>Health Screening System</h1>
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <!-- Form Section -->
    <form action="formthreeprocessdata.php" method="POST">
        <div class="container">
            <div class="form">
                <div class="heading">
                    <h3>Body Systems Disturbance</h3>
                </div>
                <div class="columns">
                    <?php
                    $body_systems = [
                        "038 Auditory", "039 Circulatory System", "040 Digestive System", "041 Endocrine System",
                        "042 Lymphatic System", "043 Musculoskeletal System", "044 Nervous System", "045 Reproduction System",
                        "046 Respiratory System", "047 Skin", "048 Urinary System", "049 Vision", "050 Normal"
                    ];
                    foreach ($body_systems as $index => $system) {
                        echo "<div>";
                        echo "<input type='checkbox' name='body_systems[]' value='$system' id='system$index'>";
                        echo "<label for='system$index'>$system</label>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <br>
                <div class="explanation">
                    <label for="explanation">Explanation</label>
                    <textarea id="explanation" name="explanation" rows="6" placeholder="Please explain in less than 1000 characters" required></textarea>
                </div>
                <br>
                <div class="heading">
                    <h3>Developmental</h3>
                </div>
                <label><i>[Children under 5 years of age]</i></label>
                <div class="children">
                 <?php
                $developmental_fields = [
                    "050 Gross Motor" => "gross_motor",
                    "051 Fine Motor" => "fine_motor",
                    "052 Language" => "language",
                    "053 Personal - Social" => "personal_social"
                    ];
                    foreach ($developmental_fields as $label => $name) {
                        echo "<div>";
                        echo "<label for='$name'>$label</label>";
                        echo "<input type='text' id='$name' name='$name' style='width: 90%;'>"; // Reduced width to 90%
                        echo "</div>";
                    }
                    ?>
                </div>
                <br>
                <div class="heading">
                    <h3>Laboratory Test</h3>
                </div>
                <div class="columns">
                    <?php
                    $lab_tests = [
                        "054 Full Blood Count", "055 HIV Test", "056 Sputum Test", "057 Stool Analysis",
                        "058 Urinalysis", "059 X-ray"
                    ];
                    foreach ($lab_tests as $index => $test) {
                        echo "<div>";
                        echo "<input type='checkbox' name='lab_tests[]' value='$test' id='labtest$index'>";
                        echo "<label for='labtest$index'>$test</label>";
                        echo "</div>";
                    }
                    ?>
                    <div>
                        <input type="checkbox" name="lab_tests[]" value="060 Other" id="other">
                        <label for="other">060 Other</label>
                        <div id="other-specify" style="display: none; margin-top: 5px;">
                            <label for="other_details">Please specify:</label>
                            <input type="text" id="other_details" name="other_details" placeholder="Specify other lab test">
                        </div>
                    </div>
                </div>
                <br>
                <label for="findings">061 Findings</label>
                <textarea name="findings" id="findings" rows="6" placeholder="Please explain in less than 1000 characters"></textarea>
                <br>
                <div class="button-container">
                    <button type="button" class="previous" onclick="goToPrevious()">Previous</button>
                    <button type="submit" class="next">Next</button>
                </div>
            </div>
        </div>
    </form>

    <footer>
        © <span id="year"></span> Health Screening System | All rights reserved
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const otherCheckbox = document.getElementById('other');
            const otherInput = document.getElementById('other-specify');

            function toggleOtherInput() {
                otherInput.style.display = otherCheckbox.checked ? 'block' : 'none';
            }

            otherCheckbox.addEventListener("change", toggleOtherInput);

            document.getElementById("year").textContent = new Date().getFullYear();
        });

        function goToPrevious() {
            window.location.href = "healthform2.php"; // Redirects to healthform2.php
        }
    </script>
</body>
</html>