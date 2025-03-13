<?php
// Include the database connection file
include("includes/config.php"); // Ensure this file contains the correct database connection details

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize the form inputs
    $body_systems = isset($_POST['body_systems']) ? implode(", ", $_POST['body_systems']) : NULL; // Combine checkbox values
    $explanation = isset($_POST['explanation']) ? htmlspecialchars($_POST['explanation'], ENT_QUOTES) : NULL;

    // Override explanation with "Normal" if "Normal State" is selected
    if (isset($_POST['normal']) && $_POST['normal'] == 'on') {
        $explanation = "Normal";
    }

    // Collect developmental information (if any)
    $gross_motor = isset($_POST['gross_motor']) ? htmlspecialchars($_POST['gross_motor'], ENT_QUOTES) : NULL;
    $fine_motor = isset($_POST['fine_motor']) ? htmlspecialchars($_POST['fine_motor'], ENT_QUOTES) : NULL;
    $language = isset($_POST['language']) ? htmlspecialchars($_POST['language'], ENT_QUOTES) : NULL;
    $personal_social = isset($_POST['personal_social']) ? htmlspecialchars($_POST['personal_social'], ENT_QUOTES) : NULL;

    // Collect laboratory tests information
    $lab_tests = isset($_POST['lab_tests']) ? $_POST['lab_tests'] : []; // Keep as array
    $other_details = isset($_POST['other_details']) ? htmlspecialchars($_POST['other_details'], ENT_QUOTES) : NULL;

    // If "060 Other" is selected, replace it with the specified details
    if ($other_details && in_array("060 Other", $lab_tests)) {
        // Remove "060 Other" and add only the specified details
        $lab_tests = array_diff($lab_tests, ["060 Other"]);
        $lab_tests[] = $other_details;
    }

    // Convert array to string for database storage
    $lab_tests = !empty($lab_tests) ? implode(", ", $lab_tests) : NULL;

    // Collect findings
    $findings = isset($_POST['findings']) ? htmlspecialchars($_POST['findings'], ENT_QUOTES) : NULL;

    // Insert data into the database
    $sql = "INSERT INTO bodysystem (
        bodysystemdisturbance,
        explanation_body_systemdisturbance,
        gross_motor,
        fine_motor,
        languange,
        personal_social,
        laboratory_test,
        findings_for_labtest
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the statement
        $stmt->bind_param(
            "ssssssss",
            $body_systems,
            $explanation,
            $gross_motor,
            $fine_motor,
            $language,
            $personal_social,
            $lab_tests,
            $findings
        );

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            // Display the success message
            echo "Data was saved successfully. Continue filling the form in the next fields!";
            
            // Redirect after 2 seconds using JavaScript
            echo '<script>
                setTimeout(function() {
                    window.location.href = "healthform4.php"; // Redirect to the next form
                }, 2000); // Redirect after 2 seconds
            </script>';
        } else {
            // Error handling: Display the error message from the statement
            echo "Error: " . $stmt->error;
            // Log this error for debugging purposes
            error_log("SQL Error: " . $stmt->error);
        }

        // Close the statement
        $stmt->close();
    } else {
        // If the prepare statement fails, display the error
        echo "Error preparing statement: " . $conn->error;
        // Log the error for further debugging
        error_log("SQL Prepare Error: " . $conn->error);
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
