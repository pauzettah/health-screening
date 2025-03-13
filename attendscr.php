<?php
// Include the database connection (config.php)
include('includes/config.php');

// Initialize the search term
$searchTerm = "";

// Check if a search term is provided and sanitize it
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
}

// Fetch Beneficiary Data with search functionality
$sql = "SELECT * FROM personal_info WHERE FName LIKE '%$searchTerm%' OR LName LIKE '%$searchTerm%' OR Local_BeneficiaryID LIKE '%$searchTerm%'";
$result = $conn->query($sql);
$beneficiaries = $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Export to CSV Functionality
if (isset($_POST['export_csv'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=beneficiaries.csv');

    $output = fopen("php://output", "w");
    fputcsv($output, ['Beneficiary ID', 'Full Name', 'Birthdate', 'Gender', 'Screening Date', 'Status']);
    
    foreach ($beneficiaries as $beneficiary) {
        fputcsv($output, [
            $beneficiary['Local_BeneficiaryID'],
            $beneficiary['FName'] . " " . $beneficiary['LName'],
            $beneficiary['Birthdate'],
            $beneficiary['Gender'],
            $beneficiary['Date_of_Screening'] ? 'Attended' : 'Missed',
            $beneficiary['malnutrition_status']
        ]);
    }
    fclose($output);
    exit;
}
?>
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
      background-color: #3a87ad;
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

    .header .search-btn {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .header .search-btn:hover {
      background-color: #0056b3;
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
      margin-top: 30px;
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

    /* Scrollable Table */
    .table-wrapper {
      max-height: 400px; /* You can adjust the height to fit your design */
      overflow-y: auto;
      display: block;
    }

    /* Container for the search form */
    .filter {
      margin-bottom: 20px;  /* Adds space below the search bar */
    }

    /* Back Button */
    .back-btn {
      background-color:lime;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      margin-top: 20px;  /* Adds space above the button */
    }

    .back-btn:hover {
      background-color: #5a6268;
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
      <a href="notattendscr.php">Beneficiaries (Failed to Attend)</a>
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
      <form method="GET" class="filter">
        <input type="text" name="search" placeholder="Search by name or ID..." style="padding: 8px; width: 300px;" value="<?= htmlspecialchars($searchTerm) ?>">
        <button type="submit" class="search-btn">Search</button>
      </form>

      <!-- Back Button -->
      <?php if ($searchTerm): ?>
        <a href="attendscr.php" class="back-btn">Back to Beneficiaries</a>
      <?php endif; ?>

      <!-- Beneficiaries (Attended) -->
      <div class="section">
        <h2>Beneficiaries Who Attended Screening</h2>
        <div class="table-wrapper">
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
              <?php if ($beneficiaries): ?>
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
              <?php else: ?>
                <tr>
                  <td colspan="10">No matching beneficiaries found for your search.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
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
