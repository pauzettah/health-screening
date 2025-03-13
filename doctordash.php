<?php
// Include database connection
include("includes/config.php");

// Query to get the total number of beneficiaries
$queryTotal = "SELECT COUNT(*) AS total FROM personal_info";
$resultTotal = mysqli_query($conn, $queryTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$totalBeneficiaries = $rowTotal['total'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Dashboard</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }
    .container {
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: 250px;
      background-color: #3a87ad;
      color: white;
      padding-top: 20px;
      height: 100vh;
      position: fixed;
    }
    .sidebar a {
      text-decoration: none;
      color: white;
      padding: 12px 20px;
      display: block;
      border-bottom: 1px solid #3e4a64;
    }
    .sidebar a:hover {
      background-color: #3e4a64;
    }
    .main-content {
      margin-left: 250px;
      flex-grow: 1;
      background-color: #f4f7fa;
      padding: 20px;
    }
    .footer {
      text-align: center;
      background-color: #3a87ad;
      color: white;
      padding: 10px 0;
      position: fixed;
      width: 100%;
      bottom: 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <h2 style="text-align:center;">Doctor Panel</h2>
      <!--<a href="doctordash.php">Dashboard</a>-->
      <a href="managebnr.php">Manage Beneficiaries</a>
      <a href="prjreport1.php">Reports</a>
      <a href="viewgeneralreport1.php">General Report</a>
      <hr>
      <a href="dashboard.php">Back to beneficiaries filling</a>
      <hr>
      <a href="index.php">Logout</a>
    </div>

    <div class="main-content">
      <h1>Welcome, Doctor</h1>
      <h2>Total Beneficiaries: <?php echo $totalBeneficiaries; ?></h2>
    </div>
  </div>

  <div class="footer">
    <p>&copy; 2025 Health System. All Rights Reserved.</p>
  </div>
</body>
</html>
