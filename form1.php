 <!-- Form Section -->
 <form action="processdata.php" method="post">
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
                        <img src="images/QR.png" alt="Scan me">
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
                                    <td><input type="checkbox"></td>
                                    <td>BCG</td>
                                    <td>Bacillus Calmette-Guérin</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>DPT</td>
                                    <td>Diphtheria, Pertussis, Tetanus</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>DT</td>
                                    <td>Diphtheria, Tetanus</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>FLU</td>
                                    <td>Influenza</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>HEA</td>
                                    <td>Hepatitis A</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>HEB</td>
                                    <td>Hepatitis B</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>HIB</td>
                                    <td>H. Influenza Type B</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>HPV</td>
                                    <td>Human Papilloma Virus</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>JAP</td>
                                    <td>Japanese Encephalitis</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>MEA</td>
                                    <td>Measles</td>
                                    <td>NONE</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                                    <td><input type="checkbox"></td>
                                    <td>MEN</td>
                                    <td>Meningitis</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>MMR</td>
                                    <td>Measles, Mumps, Rubella</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>PCV</td>
                                    <td>Pneumococcal Conjugate Vaccine</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>POL</td>
                                    <td>Polio</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>ROD</td>
                                    <td>Rotavirus</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>TT</td>
                                    <td>Tetanus Toxoid</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>TYP</td>
                                    <td>Typhoid</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>VAR</td>
                                    <td>Varicella</td>
                                    <td>NONE</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>YEL</td>
                                    <td>Yellow fever</td>
                                    <td>NONE</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="healthform2.html"><button class="next" type="submit">Next</button></a>
            </div>
        </div>
    </form>