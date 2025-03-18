<?php
// Include database connection file
include("includes/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize form data safely
    $selected_id = isset($_POST['selected_id']) ? htmlspecialchars($_POST['selected_id'], ENT_QUOTES) : '';
    $major_findings = isset($_POST['major_findings']) ? htmlspecialchars($_POST['major_findings'], ENT_QUOTES) : '';
    $diagnosis_and_ICDnumber_ifknown = isset($_POST['diagnosis_and_ICDnumber_ifknown']) ? htmlspecialchars($_POST['diagnosis_and_ICDnumber_ifknown'], ENT_QUOTES) : '';
    $therapy_and_recommendation = isset($_POST['therapy_and_recommendation']) ? htmlspecialchars($_POST['therapy_and_recommendation'], ENT_QUOTES) : '';
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES) : '';
    $qualification = isset($_POST['qualification']) ? htmlspecialchars($_POST['qualification'], ENT_QUOTES) : '';
    $date = isset($_POST['date']) ? htmlspecialchars($_POST['date'], ENT_QUOTES) : '';
    $signature = isset($_POST['signature']) ? $_POST['signature'] : ''; // Signature is already Base64 encoded
    $health_status = isset($_POST['health_status']) ? htmlspecialchars($_POST['health_status'], ENT_QUOTES) : '';

    // Validate required fields
    if (empty($selected_id)) {
        die("Beneficiary ID is required.");
    }

    // Validate major findings only if health status is "sick"
    if ($health_status === 'sick' && empty($major_findings)) {
        die("Major findings are required if health status is 'Sick'.");
    }

    if (empty($diagnosis_and_ICDnumber_ifknown)) {
        die("Diagnosis and ICD number are required.");
    }

    if (empty($therapy_and_recommendation)) {
        die("Therapy and recommendation are required.");
    }

    if (empty($name)) {
        die("Name is required.");
    }

    if (empty($qualification)) {
        die("Qualification is required.");
    }

    if (empty($date)) {
        die("Date is required.");
    }

    if (empty($signature)) {
        die("Signature is required.");
    }

    // Validate the signature format (Base64-encoded image)
    if (!str_starts_with($signature, "data:image/")) {
        die("Invalid signature format.");
    }

    // SQL Query for inserting data
    $sql = "INSERT INTO recommendation (
                selected_id, 
                major_findings, 
                diagnosis_and_ICDnumber_ifknown, 
                therapy_and_recommendation, 
                name, 
                qualification, 
                date, 
                signature, 
                health_status
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters for the prepared statement
        $stmt->bind_param(
            "sssssssss", // All fields are strings
            $selected_id,
            $major_findings,
            $diagnosis_and_ICDnumber_ifknown,
            $therapy_and_recommendation,
            $name,
            $qualification,
            $date,
            $signature,
            $health_status
        );

        // Execute the query
        if ($stmt->execute()) {
            echo "Data saved successfully! This was the last form for this beneficiary...";
            echo '<script>
                setTimeout(function() {
                    window.location.href = "final.php"; // Redirect to the next form
                }, 2000);
            </script>';
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>