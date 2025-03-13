<?php
// Database configuration
$host = "localhost";        // usichange hapa
$username = "root";         // usichange hapa
$password = "";             // ibaki ivo empty
$database = "healthyscreening";  // Database yako

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
// Retrieve form data
$countryCode = $_POST['countrycode'];
$branchCode = $_POST['branchcode'];
$localbeneficiaryId = $_POST['beneficiaryid'];

// Combine the three parts of the Local Beneficiary ID
$localBeneficiaryId = $countryCode . "-" . $branchCode . "-" . $localbeneficiaryId;

// Data for personal_info table
$FName = $_POST['fname'];
$LName = $_POST['lname'];
$birthdate = $_POST['birthdate'];
$dateOfScreening = $_POST['dateofscreening'];
$gender = $_POST['gender'];

// Data for vital_sign table
$weight = $_POST['weight'];
$height = $_POST['height'];
$bmi = $_POST['bmi'];
$circumference = $_POST['circumference'];
$malnutritionStatus = $_POST['malnutrition-status'];
$temperature = $_POST['temperature'];
$pulse = $_POST['pulse'];
$respiration = $_POST['respiration'];
$bloodPressure = $_POST['blood-pressure'];
//$comments = $_POST['comments'];

// Start transaction
$conn->begin_transaction();

try {
    // Insert into personal_info table
    $sqlPersonalInfo = "INSERT INTO personal_info (
                            Local_BeneficiaryID, FName, LName, birthdate, date_of_screening, gender
                        ) VALUES (
                            '$localBeneficiaryId', '$FName', '$LName', '$birthdate', '$dateOfScreening', '$gender'
                        )";

    if (!$conn->query($sqlPersonalInfo)) {
        throw new Exception("Error inserting into personal_info: " . $conn->error);
    }

    // Insert into vital_sign table
    $sqlVitalSign = "INSERT INTO vital_sign (
                          weight, height, bmi, head_circumference, malnutrition_status, 
                         temperature, pulse, respiration, blood_pressure
                     ) VALUES (
                          '$weight', '$height', '$bmi', '$circumference', '$malnutritionStatus', 
                         '$temperature', '$pulse', '$respiration', '$bloodPressure'
                     )";

    if (!$conn->query($sqlVitalSign)) {
        throw new Exception("Error inserting into vital_sign: " . $conn->error);
    }

    // Commit the transaction
    $conn->commit();
    echo "Record saved successfully.Local_BeneficiaryID: $localBeneficiaryId";

} catch (Exception $e) {
    // Rollback the transaction on error
    $conn->rollback();
    echo "Transaction failed: " . $e->getMessage();
}

// Close connection
$conn->close();
?>
