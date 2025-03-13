<?php
include("includes/config.php");

// Retrieve form data from POST request
$countrycode = $_POST['countrycode'] ?? '';
$branchcode = $_POST['branchcode'] ?? '';
$beneficiaryid = $_POST['beneficiaryid'] ?? '';
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$dateofscreening = $_POST['dateofscreening'] ?? '';
$gender = $_POST['gender'] ?? '';
$weight = $_POST['weight'] ?? '';
$height = $_POST['height'] ?? '';
$bmi = $_POST['bmi'] ?? '';
$circumference = $_POST['circumference'] ?? '';
$malnutrition_status = $_POST['malnutrition-status'] ?? '';
$temperature = $_POST['temperature'] ?? '';
$pulse = $_POST['pulse'] ?? '';
$respiration = $_POST['respiration'] ?? '';
$blood_pressure = $_POST['blood-pressure'] ?? '';

// Process immunizations
$immunizations = $_POST['vaccinations'] ?? []; // Array of selected vaccinations
$immunization_given = implode(", ", $immunizations); // Join selected immunizations into a string

// Prepare an SQL statement to insert the data into the table
$stmt = $conn->prepare("INSERT INTO personal_info (
    countrycode,
    branchcode,
    Local_BeneficiaryID,
    FName,
    LName,
    Birthdate,
    Date_of_Screening,
    Gender,
    weight,
    height,
    bmi,
    head_circumference,
    malnutrition_status,
    temperature,
    pulse,
    respiration,
    blood_pressure,
    immunization_given
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind the parameters to the statement
$stmt->bind_param("ssssssssssssssssss", 
    $countrycode,
    $branchcode,
    $beneficiaryid,
    $fname,
    $lname,
    $birthdate,
    $dateofscreening,
    $gender,
    $weight,
    $height,
    $bmi,
    $circumference,
    $malnutrition_status,
    $temperature,
    $pulse,
    $respiration,
    $blood_pressure,
    $immunization_given
);

// Execute the statement and check for errors
if ($stmt->execute()) {
    echo "Data was saved successfully. Continue filling the form in the next fields!";
    echo '<script>
        setTimeout(function() {
            window.location.href = "healthform2.php";
        }, 2000); // Redirect after 2 seconds
    </script>';
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
