<?php
// Include the database connection (config.php)
include('includes/config.php');

// Initialize search term
$searchTerm = "";

// Check if a search term is provided and sanitize it
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
}

// Query to fetch all users with the search functionality
$sql = "SELECT id, username, firstname, lastname, mobile, role 
        FROM users 
        WHERE LOWER(username) LIKE '%$searchTerm%' 
        OR LOWER(firstname) LIKE '%$searchTerm%' 
        OR LOWER(lastname) LIKE '%$searchTerm%' 
        OR mobile LIKE '%$searchTerm%'";

$result = $conn->query($sql);

// Check if the query returned any results
$users = $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];

$conn->close(); // Close the connection
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
      margin-top: 30px;
      max-height: 60vh;
      overflow-y: auto; /* Makes the table scrollable */
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

    /* Back Button Style */
    .back-btn {
      background-color: #2f3b52;
      color: white;
      padding: 8px 16px;
      border-radius: 4px;
      text-decoration: none;
      display: inline-block;
      margin-bottom: 20px;
    }

    .back-btn:hover {
      background-color: #3e4a64;
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

      <!-- Back Button (Only show if search term is present) -->
      <?php if (!empty($searchTerm)): ?>
        <a href="users1.php" class="back-btn">Back</a>
      <?php endif; ?>

      <!-- Users Section -->
      <div class="section">
        <h2>Users</h2>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Mobile</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($users): ?>
              <?php foreach ($users as $user): ?>
                <tr>
                  <td><?= htmlspecialchars($user['id']) ?></td>
                  <td><?= htmlspecialchars($user['username']) ?></td>
                  <td><?= htmlspecialchars($user['firstname']) ?></td>
                  <td><?= htmlspecialchars($user['lastname']) ?></td>
                  <td><?= htmlspecialchars($user['mobile']) ?></td>
                  <td><?= htmlspecialchars($user['role']) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6">No users found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    <?php include("includes/footer.php"); ?>
  </div>

</body>
</html>
