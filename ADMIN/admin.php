<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
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
      background-color: #2f3b52;
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
      position: relative;
    }

    .header .search-bar {
      width: 300px;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .header .user-profile {
      position: relative;
      display: flex;
      align-items: center;
      cursor: pointer;
    }

    .header .user-profile img {
      width: 35px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .header .user-profile span {
      font-weight: bold;
    }

    /* Dropdown Content Styling */
    .header .dropdown-content {
      display: none;
      position: absolute;
      top: 50px;
      right: 20px;
      background-color: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border: 1px solid #ddd;
      border-radius: 5px;
      z-index: 1000;
    }

    .header .dropdown-content a {
      text-decoration: none;
      color: #333;
      padding: 10px;
      display: block;
    }

    .header .dropdown-content a:hover {
      background-color: #f4f4f4;
    }

    /* Overview Metrics */
    .overview {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .overview .card {
      background-color: #fff;
      padding: 20px;
      width: 18%;
      border-radius: 6px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .overview .card h3 {
      margin: 0;
      font-size: 24px;
    }

    .overview .card p {
      font-size: 14px;
      color: #777;
    }

    /* Graphs Section */
    .graphs {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    .graphs .graph {
      width: 48%;
      background-color: #fff;
      padding: 20px;
      border-radius: 6px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .graphs .graph h3 {
      margin: 0;
      font-size: 18px;
      margin-bottom: 15px;
    }

    /* Recent Activities Section */
    .activities {
      margin-top: 30px;
      background-color: #fff;
      padding: 20px;
      border-radius: 6px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .activities h3 {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .activities ul {
      list-style-type: none;
      padding: 0;
    }

    .activities ul li {
      padding: 10px;
      border-bottom: 1px solid #eee;
    }

    .activities ul li:last-child {
      border-bottom: none;
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
     <!-- <a href="#">Dashboard</a>-->
      <a href="#">Projects</a>
      <a href="#">Project Directors</a>
      <!--<a href="managebnr.php">Beneficiaries</a>-->
     <!-- <a href="users.php">Users</a>-->
      <a href="admin/prjreport.php">Reports</a>
      <a href="#">Developer profile</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Header -->
      <div class="header">
        <input type="text" class="search-bar" placeholder="Search...">
        <div class="user-profile" id="userProfile">
          <img src="images/Admin.png" alt="User Profile">
          <span>Admin</span>
          <div class="dropdown-content" id="dropdownContent">
            <a href="index.php">Logout</a>
          </div>
        </div>
      </div>
      <!-- Overview Section -->
      <div class="overview">
        <div class="card">
          <h3>123</h3>
          <p>Total Projects</p>
        </div>
        <div class="card">
          <h3>45</h3>
          <p>Active Directors</p>
        </div>
        <div class="card">
          <h3>678</h3>
          <p>Total Beneficiaries</p>
        </div>
        <div class="card">
          <h3>200</h3>
          <p>Total Users</p>
        </div>
      </div>

      <!-- Graphs Section -->
      <div class="graphs">
        <div class="graph">
          <h3>Project Progress</h3>
          <div id="chart1" style="height: 200px; background-color: #eee;"></div>
        </div>
        <div class="graph">
          <h3>Beneficiary Distribution</h3>
          <div id="chart2" style="height: 200px; background-color: #eee;"></div>
        </div>
      </div>

      <!-- Recent Activities Section -->
      <div class="activities">
        <h3>Recent Activities</h3>
        <ul>
          <li>Added new Project Director: John Doe</li>
          <li>New Beneficiary: Mary Smith</li>
          <li>Generated Report for Project #45</li>
          <li>Updated user profile for Jane Doe</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div>
    <?php include("includes/footer.php"); ?>
  </div>

  <script>
    // JavaScript for Dropdown
    document.getElementById("userProfile").addEventListener("click", function () {
      const dropdown = document.getElementById("dropdownContent");
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (event) {
      const userProfile = document.getElementById("userProfile");
      const dropdown = document.getElementById("dropdownContent");
      if (!userProfile.contains(event.target)) {
        dropdown.style.display = "none";
      }
    });
  </script>

</body>
</html>
