<?php
include("includes/header.php");
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
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1em;
        }
        
        .form {
            background: #f9f9f9;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
         .button-container {
            display: flex;
            flex-direction: column; /* Stack buttons vertically */
            align-items: flex-start !important; /* Force align to the left */
            margin-top: 20px;
            gap: 10px; /* Adds space between buttons */
        }

        .button-container button {
            width: 150px; /* Set a fixed width */
            text-align: center;
        }


         header {
            background-color: #3a87ad; /* Blue background */
            color: #fff;
            padding: 10px 0; /* Reduce padding */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 15vh; /* Reduce height */
            z-index: 1000;
            margin-top: 0;
            align-items: center; /* Align content vertically */
            justify-content: center; /* Center content */
        }

        header h1, 
        header h2, 
        header h3, 
        header p {
            font-size: 14px; /* Reduce text size */
        }

        header img {
            height: 40px; /* Reduce image/logo size */
        }

        .heading h3 {
            font-size: 1.5em;
            text-align: center;
            margin-bottom: 1em;
        }
        .columns {
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
            justify-content: space-between;
        }
        .col1, .col2, .col3, .col4 {
            flex: 1 1 30%;
            min-width: 200px;
        }
        .explanation textarea,
        #findings {
            width: 100%;
            padding: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 0.5em;
        }
        .children {
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
        }
        .children div {
            flex: 1 1 45%;
            min-width: 250px;
        }
        .children input {
            width: 100%;
            padding: 0.8em;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 1em;
        }
        button {
            padding: 0.8em 1.5em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .previous {
            background: #6c757d;
            color: white;
        }
        .next {
            background: #007bff;
            color: white;
        }
        #other-specify {
            display: none;
            margin-top: 10px;
        }
        @media (max-width: 768px) {
            .col1, .col2, .col3, .col4 {
                flex: 1 1 100%;
            }
            .children div {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <form action="formthreeprocessdata.php" method="POST">
        <div class="container">
            <div class="form">
                <hr>
                <div class="heading">
                    <h4>Body Systems Disturbance</h4>
                </div>
                <div class="dsd">
                    <div class="columns">
                        <?php
                        $body_systems = [
                            "038 Auditory", "039 Circulatory System", "040 Digestive System", "041 Endocrine System",
                            "042 Lymphatic System", "043 Musculoskeletal System", "044 Nervous System", "045 Reproduction System",
                            "046 Respiratory System", "047 Skin", "048 Urinary System", "049 Vision", "50 Normal"
                        ];
                        foreach ($body_systems as $index => $system) {
                            echo "<div class='col" . (($index % 3) + 1) . "'>";
                            echo "<input type='checkbox' name='body_systems[]' value='$system' id='system$index'>";
                            echo "<label for='system$index'>$system</label><br><br>";
                            echo "</div>";
                        }
                        ?>
                    </div>
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
                        echo "<label for='$name'>$label</label><br>";
                        echo "<input type='text' id='$name' name='$name'>";
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
                            echo "<div class='col" . (($index % 4) + 1) . "'>";
                            echo "<input type='checkbox' name='lab_tests[]' value='$test' id='labtest$index'>";
                            echo "<label for='labtest$index'>$test</label><br><br>";
                            echo "</div>";
                        }
                        ?>
                    
                    <!-- Corrected "Other" Placement -->
                    <div class="col4">
                            <input type="checkbox" name="lab_tests[]" value="060 Other" id="other">
                            <label for="other">060 Other</label><br>
                            <div id="other-specify" style="display: none; margin-top: 5px;">
                                <label for="other_details">Please specify:</label>
                                <input type="text" id="other_details" name="other_details" placeholder="Specify other lab test">
                        </div>
                    </div>
                </div>

                <br>
                <label for="findings">061 Findings</label>
                <textarea name="findings" id="findings" rows="6" placeholder="Please explain in less than 1000 characters"></textarea>
                <br><br>
                <div class="button-container">
                    <button type="button" class="previous" onclick="goToPrevious()">Previous</button>
                    <button type="submit" class="next">Next</button>
                </div>
             </div>
            </form>
           
        </div>
    </form>

    <script>
                document.addEventListener("DOMContentLoaded", function () {
                const otherCheckbox = document.getElementById('other');
                const otherInput = document.getElementById('other-specify');

                function toggleOtherInput() {
                    otherInput.style.display = otherCheckbox.checked ? 'block' : 'none';
                }

                otherCheckbox.addEventListener("change", toggleOtherInput);
            });

    </script>

<?php
include("includes/footer.php");
?>
    <script>
    function goToPrevious() {
        window.location.href = "healthform2.php"; // Redirects to healthform2.php
    }
</script>

</body>
</html>
