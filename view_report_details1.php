<?php
// Include necessary files
include('includes/config.php');
$hide_home = true;
include("includes/header.php");

// Get the ReportID from the URL
$reportID = isset($_GET['ReportID']) ? mysqli_real_escape_string($conn, $_GET['ReportID']) : null;

// Fetch the report details
if ($reportID) {
    $sql = "SELECT ReportID, BeneficiaryID, FullName, ReportDetails, CreatedAt FROM reports WHERE ReportID = '$reportID'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $report = $result->fetch_assoc();
    } else {
        $error = "Report not found.";
    }
} else {
    $error = "Invalid Report ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Details</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f7fa;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 50px auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #3a87ad;
      font-size: 22px;
      margin-bottom: 15px;
    }

    p {
      font-size: 16px;
      line-height: 1.6;
      color: #333;
    }

    .error {
      color: red;
      text-align: center;
    }

    .back-button {
      display: block;
      width: 150px;
      margin: 20px auto;
      padding: 10px;
      text-align: center;
      background: #3a87ad;
      color: white;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }

    .back-button:hover {
      background: #306f92;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php if (isset($report)): ?>
      <h1>Report Details</h1>
      <p><strong>Report ID:</strong> <?= htmlspecialchars($report['ReportID']) ?></p>
      <p><strong>Beneficiary ID:</strong> <?= htmlspecialchars($report['BeneficiaryID']) ?></p>
      <p><strong>Full Name:</strong> <?= htmlspecialchars($report['FullName']) ?></p>
      <p><strong>Report Details:</strong> <?= nl2br(htmlspecialchars($report['ReportDetails'])) ?></p>
      <p><strong>Date Created:</strong> <?= htmlspecialchars($report['CreatedAt']) ?></p>
      <a href="view_reports1.php" class="back-button">Back to Reports</a>
    <?php else: ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
  </div>

<?php include('includes/footer.php'); ?>
</body>
</html>
