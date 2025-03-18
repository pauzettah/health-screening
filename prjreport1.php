<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Director Dashboard</title>
  <style>
    /* Global Styles */
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      height: 100%;
      overflow: hidden; /* Prevent body from scrolling */
    }

    .container {
      display: flex;
      height: 100vh;
    }

    /* Sidebar Styles */
    .sidebar {
      width: 250px;
      background-color: #3a87ad;
      color: white;
      padding-top: 20px;
      position: fixed;
      height: 100%;
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

    /* Main Dashboard Styles */
    .main-content {
      margin-left: 250px;
      flex-grow: 1;
      background-color: #f4f7fa;
      padding: 20px;
      overflow-y: auto;
      margin-top: 60px; /* Adjust for fixed header */
      margin-bottom: 50px; /* Adjust for fixed footer */
    }

    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 10px 20px;
      border-bottom: 1px solid #ddd;
      position: fixed;
      width: calc(100% - 250px);
      top: 0;
      left: 250px;
      z-index: 1000;
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

    /* Content Adjustments for Fixed Header */
    .content-wrapper {
      padding-top: 60px;
    }

    /* Card layout for different sections */
    .card-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      margin-top: 20px;
    }

    .card {
      background-color: #fff;
      padding: 20px;
      width: 30%;
      margin-bottom: 20px;
      border-radius: 8px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .card h3 {
      margin: 0;
      font-size: 28px;
      color: #34495e;
    }

    .card p {
      font-size: 16px;
      color: #7f8c8d;
      margin-top: 10px;
    }

    .card button {
      padding: 10px 20px;
      margin-top: 15px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .card button:hover {
      background-color: #2980b9;
    }

    /* Footer */
    .footer {
      text-align: center;
      background-color: #3a87ad;
      color: white;
      padding: 10px 0;
      width: calc(100% - 250px); /* Adjust for sidebar width */
      position: fixed;
      bottom: 0;
      left: 250px; /* Adjust for sidebar width */
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">
        <img src="images/logo.png" alt="Logo">
      </div>
      <a href="doctordash.php">Dashboard</a>
      <a href="managebnr.php">Manage Beneficiaries</a>
      <a href="viewgeneralreport1.php">General Report</a>
      <hr>
      <a href="dashboard.php">Back to beneficiaries filling</a>
      <hr>
      <a href="index.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Header -->
      <div class="header">
        <div class="user-profile">
          <img src="images/admin.png" alt="User Profile">
        </div>
      </div>

      <div class="content-wrapper">
        <!-- Reports Section -->
        <div class="section">
          <h2>Reports</h2>
          <div class="card-container">
            <div class="card">
              <h3>Generate Report</h3>
              <p>Generate a detailed report for screenings, beneficiaries, and attendance.</p>
              <a href="generate_report.php"><button>Generate</button></a>
            </div>
            <div class="card">
              <h3>View Past Reports</h3>
              <p>Access historical reports related to the project and screenings.</p>
              <a href="view_reports1.php"><button>View</button></a>
            </div>
          </div>
        </div>
        <!-- Summary Section -->
        <div class="section">
          <h2>Edit</h2>
          <div class="card">
            <h3>Edit report</h3>
            <p>Edit the report of a beneficiary if necessary.</p>
            <button onclick="location.href='edit.php'">Edit Report</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    &copy; <span id="year"></span> Healthy Project. All rights reserved.
  </div>

<script>
  document.getElementById("year").textContent = new Date().getFullYear();
</script>
</body>
</html>