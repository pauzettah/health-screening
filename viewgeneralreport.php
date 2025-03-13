<?php
// Include the database connection (config.php)
include('includes/config.php');

// Fetch Beneficiary Data
$sql = "SELECT 
            countrycode, 
            branchcode, 
            Local_BeneficiaryID, 
            FName, 
            LName, 
            Birthdate, 
            Date_of_Screening, 
            Gender, 
            weight, 
            height, 
            bmi, 
            head_circumference, 
            malnutrition_status, 
            temperature, 
            pulse, 
            respiration, 
            blood_pressure, 
            immunization_given 
        FROM personal_info";
$result = $conn->query($sql);
$beneficiaries = $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Director Dashboard</title>
  <style>
    /* General body and container */
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .container {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar styles */
    .sidebar {
      position: fixed;
      width: 250px;
      background-color: #3a87ad;
      color: white;
      height: 100%;
      padding-top: 20px;
    }

    .sidebar a {
      text-decoration: none;
      color: white;
      padding: 12px 20px;
      display: block;
      font-size: 16px;
      border-bottom: 1px solid #3e4a64;
    }

    .sidebar a:hover {
      background-color: #3e4a64;
    }

    .sidebar .logo {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar .logo img {
      width: 50%;
    }

    /* Main content area */
    .main-content {
      margin-left: 250px; /* To account for the sidebar */
      flex-grow: 1;
      background-color: #f4f7fa;
      padding: 20px;
    }

    /* Header styles */
    .header {
      position: fixed;
      top: 0;
      left: 250px; /* To keep it after the sidebar */
      right: 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 10px 20px;
      border-bottom: 1px solid #ddd;
      z-index: 10;
    }

    .header .search-bar {
      width: 300px;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .header .user-profile {
      display: flex;
      align-items: center;
    }

    .header .user-profile img {
      width: 35px;
      border-radius: 50%;
      margin-right: 10px;
    }

    /* Section styles */
    .section {
      margin-top: 70px; /* Account for fixed header */
    }

    .section h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    /* Table styles */
    .table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
    }

    .table th, .table td {
      padding: 12px;
      text-align: left;
    }

    .table th {
      background-color: #f5f5f5;
      font-weight: bold;
    }

    .table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .table tr:hover {
      background-color: #f1f1f1;
    }

    .table td {
      border-top: 1px solid #ddd;
    }

    /* Print button styles */
    .print-btn {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }

    .print-btn:hover {
      background-color: #45a049;
    }
  </style>

  <script>
    function printSection(sectionId) {
      const printContent = document.getElementById(sectionId).innerHTML;
      const originalContent = document.body.innerHTML;

      document.body.innerHTML = printContent;
      window.print();
      document.body.innerHTML = originalContent;
      location.reload(); // Reload the page to restore functionality
    }
  </script>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">
        <img src="images/logo.png" alt="Logo">
      </div>
      <a href="projectdirectordash.php">Dashboard</a>
      <a href="attendscr.php">Beneficiaries (Attended)</a>
      <a href="notattendscr.php">Beneficiaries (Failed to Attend)</a>
      <a href="sickbnr.php"> Sick Beneficiaries</a>
      <a href="notsick.php">Not Sick</a>
      <a href="users1.php">Users</a>
      <a href="prjreport.php">Reports</a>
      <hr>
      <a href="index.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Header -->
      <div class="header">
        <input type="text" class="search-bar" placeholder="Search...">
        <div class="user-profile">
          <img src="images/admin.png" alt="User Profile">
        </div>
      </div>

      <!-- Beneficiaries Section -->
      <div class="section" id="report-section">
        <h2>General Report</h2>
        <table class="table">
          <thead>
            <tr>
              <th>Country Code</th>
              <th>Branch Code</th>
              <th>Beneficiary ID</th>
              <th>Full Name</th>
              <th>Birthdate</th>
              <th>Screening Date</th>
              <th>Gender</th>
              <th>Weight</th>
              <th>Height</th>
              <th>BMI</th>
              <th>Head Circumference</th>
              <th>Malnutrition Status</th>
              <th>Temperature</th>
              <th>Pulse</th>
              <th>Respiration</th>
              <th>Blood Pressure</th>
              <th>Immunization Given</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($beneficiaries): ?>
              <?php foreach ($beneficiaries as $beneficiary): ?>
                <tr>
                  <td><?= htmlspecialchars($beneficiary['countrycode']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['branchcode']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['Local_BeneficiaryID']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['FName'] . ' ' . $beneficiary['LName']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['Birthdate']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['Date_of_Screening'] ?? 'Not Attended') ?></td>
                  <td><?= htmlspecialchars($beneficiary['Gender']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['weight']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['height']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['bmi']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['head_circumference']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['malnutrition_status']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['temperature']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['pulse']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['respiration']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['blood_pressure']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['immunization_given']) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="17">No beneficiaries found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <!-- Print Button -->
      <button class="print-btn" onclick="printSection('report-section')">Print Report</button>
    </div>
      <?php 
      include("includes/footer.php"); 
      ?>
  </body>
  </html>
