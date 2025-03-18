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
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden; /* Prevent body from scrolling */
        }

        .header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 75px; /* Adjust the height as needed */
            background-color: #3a87ad;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1000;
        }

        .header img {
            height: 30px; /* Adjust the height of the logo */
            margin-right: 10px;
        }

        .header .title {
            font-size: 18px; /* Adjust the font size as needed */
        }

        .container {
            max-width: 600px;
            margin: 80px auto 50px; /* Adjust margin to account for header and footer */
            background: white;
            overflow-y: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-height: calc(100vh - 160px); /* Adjust height to account for header and footer */
        }

        h2 {
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
            background-color: #3a87ad;
            color: white;
            padding: 10px 0;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            height: 50px; /* Adjust the height as needed */
            line-height: 50px; /* Vertically center the text */
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

        .logo {
            display: block;
            margin: 0 auto;
            max-width: 150px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="images/logo.png" alt="Logo">
        <div class="title">Healthy Project</div>
    </div>

    <div class="container">
        <a href="prjreport1.php" class="back-button">Back</a> <!-- Back Button -->
        
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

    <div class="footer">
        &copy; <span id="year"></span> Healthy Project. All rights reserved.
    </div>

<script>
  document.getElementById("year").textContent = new Date().getFullYear();
</script>
</body>
</html>