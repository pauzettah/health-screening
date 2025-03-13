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
    }

    .container {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar Styles */
    .sidebar {
      width: 250px;
      background-color:#3a87ad;
      color: white;
      padding-top: 20px;
      height: 100%;
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
      flex-grow: 1;
      background-color: #f4f7fa;
      padding: 20px;
    }

    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 10px 20px;
      border-bottom: 1px solid #ddd;
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
      margin-left: 1150px;
    }

    .header .user-profile img {
      width: 35px;
      border-radius: 50%;
      margin-right: 10px;
    }

    /* Section Styling */
    .section {
      margin-top: 30px;
    }

    .section h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    /* Card layout for different sections */
    .card-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
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

    /* Table Layout for Beneficiaries */
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

    /* Footer */
    .footer {
      text-align: center;
      background-color: #2f3b52;
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
      <a href="viewgeneralreport.php">General report</a>
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

      <!-- Reports Section -->
      <div class="section">
        <h2>Reports</h2>
        <div class="card-container">
       <!--   <div class="card">
            <h3>Generate Report</h3>
            <p>Generate a detailed report for screenings, beneficiaries, and attendance.</p>
            <a href="generate_report.php"><button>Generate</button></a>
          </div>-->
          <div class="card">
            <h3>View Past Reports</h3>
            <p>Access historical reports related to the project and screenings.</p>
            <a href="view_reports.php"><button>View</button></a>
          </div>
        </div>
      </div>

      <!-- Summary Section -->
      <div class="section">
        <h2>Summary</h2>
        <div class="card">
          <h3>Overall Progress</h3>
          <p>View the overall status of the project, including screenings, beneficiary involvement, and attendance rates.</p>
          <button onclick="location.href='summary.php'">View Summary</button>
        </div>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <div>
    <?php include("includes/footer.php"); ?>
  </div>

</body>
</html>
