<?php
include("includes/config.php");

// Retrieve form data from POST request
$beneficiaryId = $_POST['beneficiary_id'] ?? '';  // Assuming 'beneficiary_id' is passed from previous form
$immunizations = $_POST['immunizations'] ?? '';  // Immunization Yes/No
$other_immunizations = $_POST['other_immunizations'] ?? '';
$vitaminA = $_POST['vitaminA'] ?? '';
$deworm = $_POST['deworm'] ?? '';
$medhistory = $_POST['medhistory'] ?? '';
$head = $_POST['head'] ?? '';
$chest = $_POST['chest'] ?? '';
$abdomen = $_POST['abdomen'] ?? '';
$genitourinary = $_POST['genitourinary'] ?? '';
$extremity = $_POST['extremity'] ?? '';
$se = $_POST['se'] ?? '';
$ie = $_POST['ie'] ?? '';
$mhs = $_POST['mhs'] ?? '';
$soa = $_POST['soa'] ?? '';

// Handling physical appearance checkboxes, including "Other"
$physicalappearance = isset($_POST['physicalappearance']) ? $_POST['physicalappearance'] : [];

// Check if "Other" is selected and replace it with the user's input
if (in_array("Other", $physicalappearance) && !empty($_POST['appearance_text'])) {
    $otherValue = trim($_POST['appearance_text']);
    
    // Remove "Other" from array and add the user-defined value
    $physicalappearance = array_diff($physicalappearance, ["Other"]);
    $physicalappearance[] = $otherValue;
}

// Convert array to string for database storage
$physicalappearanceString = implode(", ", $physicalappearance);

// Prepare SQL statement to insert the data into the `physical_info` table
$stmt = $conn->prepare("INSERT INTO physical_info (
    `child_immunization_completed`, 
    `other_immunizations`, 
    `vitamins_lastly_received`, 
    `deworming_lastly_received`, 
    `past_medical_history`, 
    `head_description`, 
    `chest_description`, 
    `abdomen_description`, 
    `genitourinary_description`, 
    `extremity_description`, 
    `superior_extremities_description`, 
    `inferior_extremities_description`, 
    `mental_health_status_description`, 
    `signs_of_abuse_neglect_description`, 
    `pysicalappearance`
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters to the statement
$stmt->bind_param("sssssssssssssss", 
    $immunizations,
    $other_immunizations,
    $vitaminA,
    $deworm,
    $medhistory,
    $head,
    $chest,
    $abdomen,
    $genitourinary,
    $extremity,
    $se,
    $ie,
    $mhs,
    $soa,
    $physicalappearanceString
);

// Execute the statement and check for success
if ($stmt->execute()) {
    echo "Data was saved successfully. Continue filling the form in the next fields!";
    echo '<script>
        setTimeout(function() {
            window.location.href = "healthform3.php"; // Redirect to healthform3.php
        }, 2000); // Redirect after 2 seconds
    </script>';
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
