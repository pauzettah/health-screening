<?php
// Include the database connection
include('includes/config.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form data
    $beneficiaryId = mysqli_real_escape_string($conn, $_POST['beneficiary_id']);
    $fullName = mysqli_real_escape_string($conn, $_POST['full_name']);
    $reportDetails = mysqli_real_escape_string($conn, $_POST['report_details']);

    // Insert the report into the `reports` table
    $sql = "INSERT INTO reports (BeneficiaryID, FullName, ReportDetails, CreatedAt) 
            VALUES ('$beneficiaryId', '$fullName', '$reportDetails', NOW())";

    if ($conn->query($sql) === TRUE) {
        // Success message with modal popup
        echo "
        <div class='modal'>
            <div class='modal-content'>
                <h2>Report Saved Successfully</h2>
                <p>Report for Beneficiary ID: $beneficiaryId has been successfully saved.</p>
                <p>You will be redirected shortly...</p>
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = 'managebnr.php';
            }, 2000);
        </script>";

    } else {
        // Error message
        echo "<p>Error saving report: " . $conn->error . "</p>";
        echo "<a href='managebnr.php'>Back to Manage Beneficiaries</a>";
    }
} else {
    // Redirect if accessed directly
    header("Location: managebnr.php");
    exit;
}
?>

<style>
    /* Modal Styles */
    .modal {
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        width: 400px;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .modal h2 {
        font-size: 24px;
        color: #2ecc71;
        margin-bottom: 15px;
    }

    .modal p {
        font-size: 16px;
        color: #7f8c8d;
        margin-bottom: 20px;
    }

    .modal-content p {
        font-size: 16px;
        color: #7f8c8d;
    }
</style>
