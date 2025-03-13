<?php
// Include the database connection
include('includes/config.php');
// Initialize variables
$beneficiary = null;
$beneficiaryId = "";

// Check if a Beneficiary ID is provided via GET or POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for Beneficiary ID input
    $beneficiaryId = mysqli_real_escape_string($conn, $_POST['beneficiary_id']);

    // Validate and fetch beneficiary details
    $sql = "SELECT * FROM personal_info WHERE Local_BeneficiaryID = '$beneficiaryId'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $beneficiary = $result->fetch_assoc();
    } else {
        $error = "Beneficiary not found. Please provide a valid Beneficiary ID.";
    }
} elseif (isset($_GET['id'])) {
    // Fetch beneficiary details if Beneficiary ID is provided in the URL
    $beneficiaryId = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM personal_info WHERE Local_BeneficiaryID = '$beneficiaryId'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $beneficiary = $result->fetch_assoc();
    } else {
        $error = "Beneficiary not found. Please provide a valid Beneficiary ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Report</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 26px;
            color: #3a87ad;
            margin-bottom: 25px;
            font-weight: 600;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        input[type="text"]:focus, textarea:focus {
            border-color: #4CAF50;
            background-color: #fff;
        }

        button {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: center;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background-color: #3a87ad;
            color: white;
            font-size: 14px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer a {
            color: white;
            text-decoration: none;
            margin-left: 5px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .back-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }

        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <a href="prjreport1.php" class="back-button">Back</a> <!-- Back Button -->
        
        <h1>Generate Report</h1>

        <?php if (!$beneficiary): ?>
            <!-- Form to enter Beneficiary ID -->
            <form method="POST" action="generate_report.php">
                <label for="beneficiary_id">Enter Beneficiary ID</label>
                <input type="text" name="beneficiary_id" id="beneficiary_id" placeholder="Enter Local Beneficiary ID" required>
                
                <?php if (isset($error)): ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <button type="submit">Submit</button>
            </form>
        <?php else: ?>  
            <!-- Form to generate the report -->
            <form method="POST" action="save_report.php">
                <label>Beneficiary ID</label>
                <input type="text" name="beneficiary_id" value="<?= htmlspecialchars($beneficiary['Local_BeneficiaryID']) ?>" readonly>

                <label>Full Name</label>
                <input type="text" name="full_name" value="<?= htmlspecialchars($beneficiary['FName'] . " " . $beneficiary['LName']) ?>" readonly>

                <label>Report Details</label>
                <textarea name="report_details" placeholder="Enter report details..." required></textarea>

                <button type="submit">Save Report</button>
            </form>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>&copy; 2025 Compassion International | <a href="privacy-policy.php">Privacy Policy</a> | <a href="terms-of-service.php">Terms of Service</a></p>
    </div>

</body>
</html>
