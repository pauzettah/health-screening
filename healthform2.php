<?php
include("includes/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Quicksand:wght@300..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Child Health Form</title>
    <style>
        /* General styling for form and layout */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #3a87ad; /* Blue background */
            color: #fff;
            padding: 20px 0;
            position: fixed;
            top: 0;
            left:0;
            width: 100%;
            height: 20vh;
            z-index: 1000;
            margin-top: 0px;
        }

        .form {
            width: 100%;
            max-width: 100%;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        hr {
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        .heading h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #3a87ad;
        }

        .label1 {
            display: block;
            margin-bottom: 10px;
        }

        .input1 {
            margin-bottom: 15px;
        }

        input[type="text"], input[type="date"], textarea {
            width: 100%;
            max-width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
        }

        .d-left, .middle, .d-right {
            display: inline-block;
            width: 30%;
            vertical-align: top;
            padding: 5px;
        }

        .d-other {
            display: none;
            width: 100%;
            margin-top: 5px;
        }

        button {
            background-color: #3a87ad;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: auto;
        }

        button:hover {
            background-color: #276b8f;
        }

        .form input[type="checkbox"] {
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .d-left, .middle, .d-right {
                width: 100%;
                display: block;
            }

            button {
                width: 100%;
                font-size: 14px;
                padding: 12px;
            }

            textarea {
                width: 100%;
            }

            .input1 input {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .form {
                padding: 15px;
            }

            button {
                font-size: 14px;
                padding: 10px 15px;
            }

            .d-other {
                width: 100%;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
<form action="formtwoprocessdata.php" method="post">
    <div class="container">
        <div class="form">
            <div class="ke">
                <div class="bl"></div>
            </div>
            <hr>
            <div class="immunizations">
                <label>Childhood Immunizations Completed:</label><br>
                <input type="radio" id="immunizations_yes" name="immunizations" value="Yes" required>
                <label for="immunizations_yes">Yes</label>
                <input type="radio" id="immunizations_no" name="immunizations" value="No" required>
                <label for="immunizations_no">No</label>
                <br><br>
                <label for="other_immunizations">Other <i>[Write any other immunizations received by the child and when]</i></label><br>
                <textarea id="other_immunizations" name="other_immunizations" rows="7" placeholder="Please explain in less than 1000 characters" required></textarea>
            </div>
            <div class="heading">
                <h3>Vitamin and Deworming Received</h3>
            </div>
            <div class="vdr">
                <label for="vitaminA">019 Vitamin A - Last Dose Received</label>
                <input type="date" id="vitaminA" name="vitaminA" required><br><br>
                <label for="deworm">020 Deworming - Last Dose Received</label>
                <input type="date" id="deworm" name="deworm" required>
            </div>
            <div class="heading">
                <h3>Past Medical / Surgical History</h3>
            </div>
            <div class="history">
                <label for="medhistory">021 <i>[Anything relevant, including but not limited to hereditary/congenital conditions, disabilities, serious/chronic diseases, accidents, surgical operations, hospitalizations, skin infections, family illnesses that might influence the child's health]</i></label><br>
                <textarea id="medhistory" name="medhistory" rows="7" placeholder="Please explain in less than 1000 characters"></textarea>
            </div>
            <div class="heading">
                <h3>Physical Examination</h3>
            </div>
            <div class="pe">
                <div class="pe-left">
                    <div class="label1">
                        <label for="head">028 Head</label><br><br>
                        <label for="chest">029 Chest</label><br><br>
                        <label for="abdomen">030 Abdomen</label><br><br>
                        <label for="genitourinary">031 Genitourinary</label><br><br>
                        <label for="extremity">032 Extremity</label>
                    </div>
                    <div class="input1">
                        <input type="text" id="head" name="head" required><br>
                        <input type="text" id="chest" name="chest" required><br>
                        <input type="text" id="abdomen" name="abdomen" required><br>
                        <input type="text" id="genitourinary" name="genitourinary" required><br>
                        <input type="text" id="extremity" name="extremity" required>
                    </div>
                </div>
                <div class="pe-right">
                    <div class="label1">
                        <label for="se">033 Superior Extremities</label><br><br>
                        <label for="ie">034 Inferior Extremities</label><br><br>
                        <label for="mhs">035 Mental Health Status</label><br><br>
                        <label for="soa">036 Signs of Abuse / Neglect</label>
                    </div>
                    <div class="input1">
                        <input type="text" id="se" name="se" required><br>
                        <input type="text" id="ie" name="ie" required><br>
                        <input type="text" id="mhs" name="mhs" required><br>
                        <input type="text" id="soa" name="soa" required>
                    </div>
                </div>
            </div>
            <div class="heading">
                <h3>Physical Appearance</h3>
            </div>
            <div class="data">
                <div class="d-left">
                    <input type="checkbox" id="edema" name="physicalappearance[]" value="Edema/Swelling">
                    <label for="edema">022 Edema / Swelling</label><br><br>
                    <input type="checkbox" id="jaundice" name="physicalappearance[]" value="Jaundice">
                    <label for="jaundice">023 Jaundice</label>
                </div>
                <div class="middle">
                    <input type="checkbox" id="lethargic" name="physicalappearance[]" value="Lethargic">
                    <label for="lethargic">024 Lethargic</label><br><br>
                    <input type="checkbox" id="appearance_other" name="physicalappearance[]" value="Other">
                    <label for="appearance_other">025 Other</label><br><br>
                    <input type="text" id="appearance_text" name="appearance_text" class="d-other" placeholder="Please specify">
                </div>
                <div class="d-right">
                    <input type="checkbox" id="dehydration" name="physicalappearance[]" value="Dehydration">
                    <label for="dehydration">026 Dehydration</label><br><br>
                    <input type="checkbox" id="distention" name="physicalappearance[]" value="Distention">
                    <label for="distention">027 Distention</label>
                </div>
            </div>
            <div class="form-buttons">
                <button type="button" onclick="window.location.href='healthform1.php';">Previous</button>
                <button type="submit">Next</button>
            </div>
        </div>
    </div>
</form>
<?php
include("includes/footer.php");
?>

<script>
    // Prevent future dates selection for Vitamin A and Deworming fields
    document.addEventListener("DOMContentLoaded", function() {
        var today = new Date().toISOString().split("T")[0];
        document.getElementById("vitaminA").setAttribute("max", today);
        document.getElementById("deworm").setAttribute("max", today);
    });

    // Toggle the appearance other input field when the "Other" checkbox is selected
    document.getElementById('appearance_other').addEventListener('change', function() {
        document.getElementById('appearance_text').style.display = this.checked ? 'block' : 'none';
    });
</script>
</body>
</html>
