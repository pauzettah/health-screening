<?php
include("includes/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Health Screening Form</title>
    <style>
                body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensures the body takes the full height of the viewport */
        }

        .container {
            flex: 1; /* Pushes the footer to the bottom */
        }

        header {
            background-color: #3a87ad; /* Blue background */
            color: #fff;
            padding: 20px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            height: 80px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 0;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        header .logo img {
            margin-right: 10px;
            margin-top: -10px;
        }

        header .logo h1 {
            margin: 0;
            font-size: 24px;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            margin-top: -40px;
        }

        header nav ul li {
            display: inline;
            margin-right: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
          
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 70px; /* Add padding equal to header height */
        }

        .container {
            flex: 1; /* Pushes the footer to the bottom */
        }

        .footer {
            text-align: center;
            background-color: #3a87ad;
            color: white;
            padding: 0;
            width: 100%;
            position: fixed;
            bottom: 0;
            margin-bottom: 0;
            height: auto;
            line-height: 60px; /* Vertically center the text */
        }

        footer .footer-content {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        footer .footer-content p {
            margin: 5px;
        }

        footer .footer-content a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        footer .footer-content a:hover {
            text-decoration: underline;
        }
        </style>
    </head>
    <body>
        <!-- Header Section -->
        <header>
        <div class="container">
            <div class="logo">
            <img src="images/logo.png" alt="Health Screening System Logo" height="50">
            <h1>Health Screening System</h1>
            </div>
            <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
            </ul>
            </nav>
        </div>
        </header></ul></nav></div></header>

    <!-- Form Section -->
    <form action="formoneprocessdata.php" method="post">
        <div class="container">
            <div class="form">
                <div class="ke">
                    <div class="id">
                        <label for="beneficiaryid">001 Local Beneficiary ID</label>
                        <input type="text" class="l1" id="beneficiaryid" name="countrycode" required>
                        <input type="number" class="l2" id="beneficiaryid" name="branchcode" required>
                        <input type="number" class="l2" id="beneficiaryid" name="beneficiaryid" required>
                    </div>
                    <div class="bl">
                        <label for="serialno">BL-006-04</label>
                    </div>
                </div>
                <hr>
                <div class="titlespan">
                    <div class="title">
                        <h2>Health Screening Form</h2>
                    </div>
                    <div class="qrcode">
                        <img src="images/QR.PNG" alt="qrcode">
                    </div>
                </div>
                <hr>
                <div class="info">
                    <div class="name">
                        <label for="fname">002 First Name</label>
                        <input type="text" class="l3" id="fname" name="fname" required>
                        <br><br>
                        <label for="lname">003 Last Name</label>
                        <input type="text" class="l3" id="lname" name="lname" required>
                    </div>
                    <div class="date-info">
                     <div class="date">
                            <label for="birthdate">004 Birthdate</label>
                            <input type="date" name="birthdate" id="birthdate">
                       </div>

                        <div class="datescreening">
                            <label for="dateofscreening">005 Date of Screening</label>
                            <input type="date" name="dateofscreening" id="dateofscreening">
                       </div>
                        <div class="gender">
                            <div class="gender-details">
                                <label for="gender">006 Gender</label>
                            </div>
                            <div>
                                <input type="radio" id="male" name="gender" value="male">
                                <label for="male">Male</label>
                            </div>
                            <div>
                                <input type="radio" id="female" name="gender" value="female">
                                <label for="female">Female</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="heading">
                    <h3>Vital Sign</h3>
                </div>
                <div class="vital-sign">
                    <div class="right">
                        <div class="vs-right">
                            <div class="label">
                                <label for="weight" class="vs-label">007 Weight <i>(kg)</i></label><br><br>
                                <label for="height" class="vs-label">008 Height <i>(cm)</i></label><br><br>
                                <label for="bmi" class="vs-label">009 BMI <i>(5+ years)</i></label><br><br>
                                <label for="circumference" class="vs-label">010 Head circumference <i>(cm)</i></label>
                            </div>
                            <div class="input">
                                <input type="text" id="weight" name="weight" placeholder="Enter weight in kg"><br>
                                <input type="text" id="height" name="height" placeholder="Enter height in cm"><br>
                                <input type="text" id="bmi" name="bmi" placeholder="Enter BMI"><br>
                                <input type="text" id="circumference" name="circumference" placeholder="Enter head circumference in cm">
                            </div>
                        </div>
                        <div class="malnutrition">
                            <label for="malnutrition-status">011 Malnutrition Status</label>
                            <div class="ms1">
                                <input type="radio" id="malnutrition-status" name="malnutrition-status" value="No">
                                <label for="no">No</label>
    
                                <input type="radio" id="malnutrition-status" name="malnutrition-status" value="Moderate">
                                <label for="moderate">Moderate</label>
                            </div>
                            <div class="ms2">
                                <input type="radio" id="malnutrition-status" name="malnutrition-status" value="Mild">
                                <label for="mild">Mild</label>
                                <input type="radio" id="malnutrition-status" name="malnutrition-status" value="Severe">
                                <label for="severe">Severe</label>
                            </div>
                        </div>
                    </div>

                    <div class="left">
                        <div class="left-details">
                            <label for="temperature" class="vs-label">012 Temperature <i>(°C)</i></label>
                            <input type="text" id="temperature" name="temperature" placeholder="Enter temperature in °C">
                            <br>
                            <label for="Pulse" class="vs-label">013 Pulse <i>(bpm)</i></label>
                            <input type="text" id="pulse" name="pulse" placeholder="Enter pulse in bpm">
                            <br>
                            <label for="respiration" class="vs-label">014 Respiration</label>
                            <input type="text" id="respiration" name="respiration" placeholder="Enter respiration">
                            <br>
                            <label for="blood-pressure" class="vs-label">015 Blood Pressure</label>
                            <input type="text" id="blood-pressure" name="blood-pressure" placeholder="Enter BP">
                        </div>
                    </div>
                </div>

                <div class="heading">
                    <h3>Immunizations Given</h3>
                </div>
                <p>017 Please indicate all Vaccinations Given today if an Immunization Worksheet is not being Completed. Dose Number or B for Booster</p>
                <div class="table-container">
    <!-- Table 1 -->
    <div class="table1">
        <table>
            <thead>
                <tr>
                    <th class="checkbox-column">☑</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th class="none-column">NONE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="BCG"></td>
                    <td>BCG</td>
                    <td>Bacillus Calmette-Guérin</td>
                    <td><input type="checkbox" name="none[]" value="BCG"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="DPT"></td>
                    <td>DPT</td>
                    <td>Diphtheria, Pertussis, Tetanus</td>
                    <td><input type="checkbox" name="none[]" value="DPT"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="DT"></td>
                    <td>DT</td>
                    <td>Diphtheria, Tetanus</td>
                    <td><input type="checkbox" name="none[]" value="DT"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="FLU"></td>
                    <td>FLU</td>
                    <td>Influenza</td>
                    <td><input type="checkbox" name="none[]" value="FLU"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="HEA"></td>
                    <td>HEA</td>
                    <td>Hepatitis A</td>
                    <td><input type="checkbox" name="none[]" value="HEA"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="HEB"></td>
                    <td>HEB</td>
                    <td>Hepatitis B</td>
                    <td><input type="checkbox" name="none[]" value="HEB"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="HIB"></td>
                    <td>HIB</td>
                    <td>H. Influenza Type B</td>
                    <td><input type="checkbox" name="none[]" value="HIB"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="HPV"></td>
                    <td>HPV</td>
                    <td>Human Papilloma Virus</td>
                    <td><input type="checkbox" name="none[]" value="HPV"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="JAP"></td>
                    <td>JAP</td>
                    <td>Japanese Encephalitis</td>
                    <td><input type="checkbox" name="none[]" value="JAP"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="MEA"></td>
                    <td>MEA</td>
                    <td>Measles</td>
                    <td><input type="checkbox" name="none[]" value="MEA"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table 2 -->
    <div class="table2">
        <table>
            <thead>
                <tr>
                    <th class="checkbox-column">☑</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th class="none-column">NONE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="MEN"></td>
                    <td>MEN</td>
                    <td>Meningitis</td>
                    <td><input type="checkbox" name="none[]" value="MEN"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="MMR"></td>
                    <td>MMR</td>
                    <td>Measles, Mumps, Rubella</td>
                    <td><input type="checkbox" name="none[]" value="MMR"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="PCV"></td>
                    <td>PCV</td>
                    <td>Pneumococcal Conjugate Vaccine</td>
                    <td><input type="checkbox" name="none[]" value="PCV"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="POL"></td>
                    <td>POL</td>
                    <td>Polio</td>
                    <td><input type="checkbox" name="none[]" value="POL"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="ROD"></td>
                    <td>ROD</td>
                    <td>Rotavirus</td>
                    <td><input type="checkbox" name="none[]" value="ROD"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="TT"></td>
                    <td>TT</td>
                    <td>Tetanus Toxoid</td>
                    <td><input type="checkbox" name="none[]" value="TT"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="TYP"></td>
                    <td>TYP</td>
                    <td>Typhoid</td>
                    <td><input type="checkbox" name="none[]" value="TYP"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="VAR"></td>
                    <td>VAR</td>
                    <td>Varicella</td>
                    <td><input type="checkbox" name="none[]" value="VAR"></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="vaccinations[]" value="YEL"></td>
                    <td>YEL</td>
                    <td>Yellow fever</td>
                    <td><input type="checkbox" name="none[]" value="YEL"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<hr><hr>
<a href="healthform2.php"><button class="#" type="submit">Click Next to Continue</button></a>
<hr>
<button type="button" onclick="window.location.href='dashboard.php';">Previous</button><hr>

                
            </div>
        </div>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get today's date in YYYY-MM-DD format
            let today = new Date().toISOString().split("T")[0];

            // Set max attribute for both fields to prevent future dates
            document.getElementById("birthdate").setAttribute("max", today);
            document.getElementById("dateofscreening").setAttribute("max", today);
        });
    </script>

<div class="footer">© <span id="year"></span> Health Screening System | All rights reserved</div>
<script>
  document.getElementById("year").textContent = new Date().getFullYear();
</script>
</body>
</html>
