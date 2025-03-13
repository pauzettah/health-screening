<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Director Dashboard</title>
   
<?php
// Include database connection
include("includes/config.php");

// Query to get the total number of beneficiaries
$queryTotal = "SELECT COUNT(*) AS total FROM personal_info";
$resultTotal = mysqli_query($conn, $queryTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$totalBeneficiaries = $rowTotal['total'];

// Query to get the number of attended beneficiaries (Date_of_Screening is not NULL)
$queryAttended = "SELECT COUNT(*) AS attended FROM personal_info WHERE Date_of_Screening IS NOT NULL";
$resultAttended = mysqli_query($conn, $queryAttended);
$rowAttended = mysqli_fetch_assoc($resultAttended);
$attendedBeneficiaries = $rowAttended['attended'];

// Query to get the number of failed beneficiaries (Date_of_Screening is NULL)
$queryFailed = "SELECT COUNT(*) AS failed FROM personal_info WHERE Date_of_Screening IS NULL";
$resultFailed = mysqli_query($conn, $queryFailed);
$rowFailed = mysqli_fetch_assoc($resultFailed);
$failedBeneficiaries = $rowFailed['failed'];
?>

  <style>
    /* Global Styles */
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      height: 100%;
      overflow: hidden; /* Prevent body from scrolling */
    }

    .sidebar {
      width: 250px;
      background-color: #3a87ad;
      color: white;
      padding-top: 20px;
      position: fixed;
      top: 0;
      bottom: 0;
      overflow-y: auto;
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

    .container {
      display: flex;
      flex-direction: column;
      height: 100vh;
      margin-left: 250px; /* Adjust for sidebar width */
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 10px 20px;
      border-bottom: 1px solid #ddd;
      position: fixed;
      top: 0;
      left: 250px; /* Adjust for sidebar width */
      right: 0;
      z-index: 100;
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
      position: relative; /* To control the dropdown positioning */
    }

    .header .user-profile img {
      width: 35px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .dropdown-content {
      display: none; /* Hidden by default */
      position: absolute;
      top: 30px;
      right: 0;
      background-color: white;
      border: 1px solid #ccc;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      min-width: 160px;
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #ddd;
    }

    .dropdown-content.show {
      display: block;
    }

    main {
      flex-grow: 1;
      background-color: #f4f7fa;
      padding: 50px;
      overflow-y: auto;
      margin-top: 60px; /* Adjust for fixed header */
    }

    .section {
      margin-top: 30px;
    }

    .section h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .card-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 20px; /* Add gap between cards */
    }

    .card {
      background-color: #6fb854;
      padding: 20px;
      width: calc(33.333% - 20px); /* Adjust width to fit three cards in a row with gap */
      margin-bottom: 20px;
      border-radius: 6px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s; /* Add transition for hover effect */
    }

    .card:hover {
      transform: translateY(-10px); /* Lift the card on hover */
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Enhance shadow on hover */
    }

    .card h3 {
      margin: 0;
      font-size: 28px;
      color: white;
    }

    .card p {
      font-size: 16px;
      color: white;
    }

    .table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    .table th, .table td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    .table th {
      background-color: #f5f5f5;
    }

    .table tr:hover {
      background-color: #f1f1f1;
    }

    .footer {
      text-align: center;
      background-color: #3a87ad;
      color: white;
      padding: 10px 0;
      position: fixed;
      width: calc(100% - 250px); /* Adjust for sidebar width */
      bottom: 0;
      left: 250px; /* Adjust for sidebar width */
    }

    canvas {
      max-width: 400px;
      max-height: 300px;
      width: 100%;
      height: auto;
    }

    .charts-container {
      display: flex;
      justify-content: space-between;
      gap: 20px;
    }

    .chart-item {
      width: 48%; /* Each chart takes up 48% of the width */
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

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
    <a href="viewgeneralreport.php">General report</a>
    <hr>
    <a href="index.php">Logout</a>
  </div>

  <!-- Container -->
  <div class="container">
    <!-- Header -->
    <div class="header">
      <label style="font-weight: bolder; color:black; font-size:30px;">Project Director Dashboard</label>
      <div class="user-profile" id="userProfile">
        <img src="images/Admin.png" alt="User Profile">
        <span>Project Director</span>
        <div class="dropdown-content" id="dropdownContent">
          <a href="index.php">Logout</a>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <main>
      <!-- Overview Section -->
      <div class="section">
        <h2>Overview</h2>
        <div class="card-container">
          <div class="card">
            <h3><?php echo $totalBeneficiaries; ?></h3>
            <p>Total Beneficiaries</p>
          </div>
          <div class="card">
            <h3><?php echo $attendedBeneficiaries; ?></h3>
            <p>Attended Screening</p>
          </div>
          <div class="card">
            <h3><?php echo $failedBeneficiaries; ?></h3>
            <p>Failed to Attend</p>
          </div>
        </div>
      </div>

      <!-- Charts Section -->
      <div class="section">
        <h3>Beneficiary Attendance and Trends</h3>
        <div class="charts-container">
          <div class="chart-item">
            <h4>Attendance Distribution</h4>
            <canvas id="attendancePieChart"></canvas>
          </div>
          <div class="chart-item">
            <h4>Beneficiaries Over Time</h4>
            <canvas id="beneficiariesBarChart"></canvas>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Footer -->
  <div class="footer">
    &copy; 2025 Healthy Project. All rights reserved.
  </div>

  <!-- JavaScript to toggle the dropdown -->
  <script>
    // Get the user profile element and the dropdown content
    const userProfile = document.getElementById("userProfile");
    const dropdownContent = document.getElementById("dropdownContent");

    // Toggle dropdown visibility on click
    userProfile.addEventListener("click", function() {
      dropdownContent.classList.toggle("show");
    });

    // Pie chart for Attendance Distribution
    const ctxPie = document.getElementById('attendancePieChart').getContext('2d');
    const attendancePieChart = new Chart(ctxPie, {
      type: 'pie',
      data: {
        labels: ['Attended', 'Failed'],
        datasets: [{
          label: 'Beneficiaries Attendance',
          data: [<?php echo $attendedBeneficiaries; ?>, <?php echo $failedBeneficiaries; ?>],
          backgroundColor: ['#4CAF50', '#FF5733'],
        }]
      }
    });

    // Bar chart for Beneficiaries Over Time (example data)
    const ctxBar = document.getElementById('beneficiariesBarChart').getContext('2d');
    const beneficiariesBarChart = new Chart(ctxBar, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'], // Example labels
        datasets: [{
          label: 'Total Beneficiaries',
          data: [<?php echo $totalBeneficiaries; ?>, 200, 180, 220, 210], // Example data
          backgroundColor: '#218838',
          borderColor: '#218838',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

</body>
</html>