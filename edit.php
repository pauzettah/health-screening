<?php
// Include the database connection
include('includes/config.php');

// Step 1: Ask for Local Beneficiary ID if not provided
if (!isset($_GET['Local_BeneficiaryID']) && $_SERVER["REQUEST_METHOD"] != "POST") {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enter Beneficiary ID</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f7fa;
                padding: 20px;
                text-align: center;
            }
            .container {
                max-width: 400px;
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
                margin: auto;
            }
            input {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            button {
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                border: none;
                cursor: pointer;
                border-radius: 5px;
            }
            button:hover {
                background-color: #45a049;
            }
            .error {
                color: red;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Enter Local Beneficiary ID</h2>
            <form method="GET">
                <input type="text" name="Local_BeneficiaryID" placeholder="Enter Local Beneficiary ID" required>
                <button type="submit">Continue</button>
            </form>
        </div>
    </body>
    </html>
<?php
    exit;
}

// Step 2: Fetch Report Data
$localBeneficiaryID = mysqli_real_escape_string($conn, $_GET['Local_BeneficiaryID']);
$sql = "SELECT * FROM reports WHERE BeneficiaryID = '$localBeneficiaryID'";
$result = $conn->query($sql);

// If no report found, show error
if ($result->num_rows == 0) {
    echo "<p class='error' style='text-align:center;'>No report found for this Beneficiary ID.</p>";
    exit;
}

$report = $result->fetch_assoc();

// Step 3: Show Edit Form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = mysqli_real_escape_string($conn, $_POST['FullName']);
    $reportDetails = mysqli_real_escape_string($conn, $_POST['ReportDetails']);

    // Update query
    $updateSQL = "UPDATE reports SET 
                  FullName = '$fullName', 
                  ReportDetails = '$reportDetails' 
                  WHERE BeneficiaryID = '$localBeneficiaryID'";
    
    if ($conn->query($updateSQL) === TRUE) {
        header("Location: prjreport1.php?success=Report updated successfully");
        exit;
    } else {
        echo "<p class='error'>Error updating report: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Report</h2>

    <form method="POST">
        <label>Full Name</label>
        <input type="text" name="FullName" value="<?= htmlspecialchars($report['FullName']) ?>">

        <label>Report Details</label>
        <textarea name="ReportDetails" rows="5"><?= htmlspecialchars($report['ReportDetails']) ?></textarea>

        <button type="submit">Update Report</button>
    </form>

    <br>
    <button onclick="window.location.href='prjreport1.php';">Cancel</button>
</div>

</body>
</html>
