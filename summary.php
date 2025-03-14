<?php
// Include database connection
include('includes/config.php');

// Fetch summary data
$totalBeneficiaries = $conn->query("SELECT COUNT(*) AS total FROM personal_info")->fetch_assoc()['total'];
$attended = $conn->query("SELECT COUNT(*) AS total FROM personal_info WHERE Date_of_screening IS NOT NULL")->fetch_assoc()['total'];
$notAttended = $conn->query("SELECT COUNT(*) AS total FROM personal_info WHERE Date_of_screening IS NULL")->fetch_assoc()['total'];
$sickBeneficiaries = $conn->query("SELECT COUNT(*) AS total FROM recommendation WHERE major_findings NOT IN ('healthy', 'normal')")->fetch_assoc()['total'];
$healthy = $totalBeneficiaries - $sickBeneficiaries; // Healthy beneficiaries

// Calculate attendance rate
$attendanceRate = $attended > 0 ? round(($attended / $totalBeneficiaries) * 100, 2) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Summary</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      height: 100%;
      overflow: hidden; /* Prevent body from scrolling */
    }

    .header {
      position: fixed;
      top: 0;
      width: 100%;
      height: 100px; /* Adjust the height as needed */
      background-color: #3a87ad;
      color: white;
      display: flex;
      align-items: center;
      padding: 0 20px;
      z-index: 1000;
    }

    .header img {
      height: 50px; /* Adjust the height of the logo */
      margin-right: 10px;
    }

    .header .title {
      font-size: 20px; /* Adjust the font size as needed */
    }

    .content {
      margin-top: 50px; /* Adjust according to header height */
      margin-bottom: 50px; /* Adjust according to footer height */
      overflow-y: auto;
      height: calc(100vh - 100px); /* Adjust based on header and footer */
      padding: 20px;
    }

    .container {
      max-width: 1200px;
      margin: 80px auto 50px auto; /* Adjusted margins for header and footer */
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
      height: 50px; /* Adjust the height as needed */
      line-height: 50px; /* Vertically center the text */
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 32px;
      color: #2c3e50;
    }

    .summary {
      display: flex;
      justify-content: space-between;
      margin-bottom: 40px;
    }

    .summary-card {
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      text-align: center;
      width: 22%;
    }

    .summary-card h2 {
      font-size: 22px;
      margin-bottom: 10px;
      color: #34495e;
    }

    .summary-card p {
      font-size: 18px;
      color: #7f8c8d;
    }

    .chart-container {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .chart-box {
      width: 32%;
      padding: 10px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    canvas {
      width: 100%;
      max-width: 300px;
      height: auto;
    }

    .back-button {
      display: block;
      width: 150px;
      margin: 20px auto;
      padding: 10px;
      background-color: lime;
      color: white;
      text-align: center;
      border-radius: 5px;
      text-decoration: none;
      font-size: 18px;
    }

    .back-button:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <div class="header">
    <img src="images/logo.png" alt="Logo">
    <div class="title">Project Summary</div>
  </div>

  <div class="content">
    <div class="container">
      <!-- Summary Cards -->
      <div class="summary">
        <div class="summary-card">
          <h2>Total Beneficiaries</h2>
          <p><?= htmlspecialchars($totalBeneficiaries) ?></p>
        </div>
        <div class="summary-card">
          <h2>Total Attended</h2>
          <p><?= htmlspecialchars($attended) ?></p>
        </div>
        <div class="summary-card">
          <h2>Total Not Attended</h2>
          <p><?= htmlspecialchars($notAttended) ?></p>
        </div>
        <div class="summary-card">
          <h2>Sick Beneficiaries</h2>
          <p><?= htmlspecialchars($sickBeneficiaries) ?></p>
        </div>
      </div>

      <!-- Charts Section -->
      <div class="chart-container">
        <div class="chart-box">
          <h3>Attendance Overview</h3>
          <canvas id="attendanceChart"></canvas>
        </div>
        <div class="chart-box">
          <h3>Health Status</h3>
          <canvas id="sickChart"></canvas>
        </div>
        <div class="chart-box">
          <h3>General Overview</h3>
          <canvas id="generalChart"></canvas>
        </div>
      </div>

      <!-- Back Button -->
      <a href="prjreport.php" class="back-button">Back</a>
    </div>
  </div>

  <div class="footer">© <span id="year"></span> Health Screening System | All rights reserved</div>

  <script>
    const attendanceData = {
      labels: ['Attended', 'Not Attended'],
      datasets: [{ data: [<?= $attended ?>, <?= $notAttended ?>], backgroundColor: ['#3498db', '#e74c3c'] }]
    };
    new Chart(document.getElementById('attendanceChart').getContext('2d'), { type: 'pie', data: attendanceData });

    const sickData = {
      labels: ['Healthy/Normal', 'Sick'],
      datasets: [{ data: [<?= $healthy ?>, <?= $sickBeneficiaries ?>], backgroundColor: ['#2ecc71', '#e67e22'] }]
    };
    new Chart(document.getElementById('sickChart').getContext('2d'), { type: 'doughnut', data: sickData });

    const generalData = {
      labels: ['Attended', 'Not Attended', 'Sick'],
      datasets: [{ data: [<?= $attended ?>, <?= $notAttended ?>, <?= $sickBeneficiaries ?>], backgroundColor: ['#3498db', '#e74c3c', '#f39c12'] }]
    };
    new Chart(document.getElementById('generalChart').getContext('2d'), { type: 'pie', data: generalData });

    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>