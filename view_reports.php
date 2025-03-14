<?php
// Include the database configuration
include('includes/config.php');
$hide_home = true;

// Modify the Home link to point to projectdirectordash.php instead of index
echo '<script>
  document.addEventListener("DOMContentLoaded", function() {
    if (homeLink) {
      homeLink.setAttribute("href", "projectdirectordash.php");
    }
  });
</script>';

// Fetch reports from the database
$sql = "SELECT ReportID, BeneficiaryID, FullName, ReportDetails, CreatedAt FROM reports ORDER BY CreatedAt DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Reports</title>
</head>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fa;
    margin: 0;
    padding: 20px;
    min-height: 100vh;
  }

  .view-reports {
    max-width: 100%;
    margin: 0 auto;
    padding: 20px 0 55px 0;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    max-height: calc(100vh - 160px); /* Adjust height to fit between header and footer */
  }

  .header{
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    background-color: #3a87ad;
    color: white;
    text-align: center;
    text-align: center;
    height: 45px;
  }

  .footer {
    text-align: center;
    background-color: #3a87ad;
    color: white;
    padding: 0;
    width: 100%;
    position: fixed;
    bottom: 0;
    margin-bottom: 0;
    height: auto;
    line-height: 60px; /* Vertically center the text */
  }
</style>
<body style="font-family: Arial, sans-serif; background-color: #f4f7fa; margin: 0; padding: 20px;">
<div class="header">  <?php include("includes/header.php"); ?>

  <div class="view-reports">
    
    <h1 style="text-align: center; color: #333; padding: 15px; border-bottom: 3px solid #4CAF50;">Past Reports</h1>
    
    <?php if ($result && $result->num_rows > 0): ?>
      <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
          <tr style="background-color: #4CAF50; color: black;">
            <th style="padding: 12px; border: 1px solid #ddd;">Report ID</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Beneficiary ID</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Full Name</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Report Details</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Date Created</th>
            <th style="padding: 12px; border: 1px solid #ddd;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr style="background-color: #f9f9f9; border-bottom: 1px solid #ddd; text-align: center;">
              <td style="padding: 10px;"> <?= htmlspecialchars($row['ReportID']) ?> </td>
              <td style="padding: 10px;"> <?= htmlspecialchars($row['BeneficiaryID']) ?> </td>
              <td style="padding: 10px;"> <?= htmlspecialchars($row['FullName']) ?> </td>
              <td style="padding: 10px;"> <?= htmlspecialchars(substr($row['ReportDetails'], 0, 50)) ?>... </td>
              <td style="padding: 10px;"> <?= htmlspecialchars($row['CreatedAt']) ?> </td>
              <td style="padding: 10px;">
                <a href="view_report_details.php?ReportID=<?= htmlspecialchars($row['ReportID']) ?>" style="background: #4CAF50; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none;">View</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p style="text-align: center; color: #888;">No reports found.</p>
    <?php endif; ?>
    
    <div style="text-align: center; margin-top: 20px;">
  <button onclick="window.location.href='prjreport.php';" style="background: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Back</button>
</div>

  </div>

  <div class="footer">© 2025 Health Screening System | All rights reserved
  </div>
</body>
</html>
