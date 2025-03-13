<?php
// Include the database connection (config.php)
include('includes/config.php');

// Initialize search term
$searchTerm = "";

// Check if a search term is provided and sanitize it
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
}

// Query to fetch beneficiaries who didn't attend screening with search functionality
$sql = "SELECT * FROM personal_info WHERE Date_of_Screening IS NULL";

// If a search term is provided, add it to the query
if (!empty($searchTerm)) {
    $sql .= " AND (FName LIKE '%$searchTerm%' OR LName LIKE '%$searchTerm%' OR Local_BeneficiaryID LIKE '%$searchTerm%')";
}

$result = $conn->query($sql);

// Check if the query returned any results
$beneficiaries = $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];

$conn->close(); // Close the connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beneficiaries Who Didn't Attend Screening</title>
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
      position: static;
      height: 100vh;
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
      overflow-y: auto;
      margin-top: 30px;
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

    .header .search-btn {
      padding: 8px 16px;
      border: 1px solid #ccc;
      background-color: #2f3b52;
      color: white;
      border-radius: 4px;
      cursor: pointer;
    }

    .header .search-btn:hover {
      background-color: #3e4a64;
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

    /* Section Styling */
    .section {
      margin-top: 20px; /* Adjust for fixed header */
    }

    .section h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    /* Table Layout */
    .table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    .table th {
      background-color: #3a87ad;
      color: white;
    }

    .table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .table tr:hover {
      background-color: #f1f1f1;
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

    /* Back Button */
    .back-btn {
      padding: 8px 16px;
      background-color: #2f3b52;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-bottom: 20px;
    }

    .back-btn:hover {
      background-color: #3e4a64;
    }

    .no-results {
      font-size: 18px;
      color: red;
      margin-top: 20px;
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
      <a href="sickbnr.php"> Sick Beneficiaries</a>
      <a href="notsick.php">Not Sick</a>
      <a href="users1.php">Users</a>
      <a href="prjreport.php">Reports</a>
      <a href="viewgeneralreport.php">General report</a>
      <hr>
      <a href="index.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Header -->
      <div class="header">
        <form method="GET" style="display: flex; align-items: center;">
          <input type="text" name="search" class="search-bar" placeholder="Search..." value="<?= htmlspecialchars($searchTerm) ?>">
          <button type="submit" class="search-btn">Search</button>
        </form>
      </div>

      <!-- Beneficiaries Section -->
      <div class="section">
        <h2>Beneficiaries Who Didn't Attend Screening</h2>

        <!-- Show Back Button if a search is performed -->
        <?php if (!empty($searchTerm)): ?>
          <a href="notattendscr.php"><button class="back-btn">Back to Full List</button></a>
        <?php endif; ?>

        <!-- If no results, display a message -->
        <?php if (empty($beneficiaries)): ?>
          <p class="no-results">No beneficiaries found.</p>
        <?php else: ?>
          <table class="table">
            <thead>
              <tr>
                <th>Beneficiary ID</th>
                <th>Full Name</th>
                <th>Birthdate</th>
                <th>Gender</th>
                <th>Screening Date</th>
                <th>Malnutrition Status</th>
                <th>Temperature</th>
                <th>Pulse</th>
                <th>Blood Pressure</th>
                <th>Immunization Given</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($beneficiaries as $beneficiary): ?>
                <tr>
                  <td><?= htmlspecialchars($beneficiary['Local_BeneficiaryID']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['FName'] . " " . $beneficiary['LName']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['Birthdate']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['Gender']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['Date_of_Screening']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['malnutrition_status']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['temperature']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['pulse']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['blood_pressure']) ?></td>
                  <td><?= htmlspecialchars($beneficiary['immunization_given']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    &copy; 2025 Healthy Project. All rights reserved.
  </div>

</body>
</html>