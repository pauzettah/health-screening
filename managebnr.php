<?php
// Include the database connection
include('includes/config.php');

// Initialize the search term
$searchTerm = "";

// Check if a search term is provided and sanitize it
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
}

// Fetch Beneficiary Data with search functionality
$sql = "SELECT * FROM personal_info 
        WHERE FName LIKE '%$searchTerm%' 
        OR LName LIKE '%$searchTerm%' 
        OR Local_BeneficiaryID LIKE '%$searchTerm%'";
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
            $beneficiary['Date_of_Screening'] ?? 'Not Attended',
            $beneficiary['Date_of_Screening'] ? 'Attended' : 'Missed'
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
    <title>Manage Beneficiaries</title>
    <style>
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

        .sidebar {
            width: 250px;
            background-color: #3a87ad;
            color: white;
            padding-top: 20px;
            height: 100%;
            position: fixed;
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

        .main-content {
            margin-left: 250px;
            flex-grow: 1;
            background-color: #f4f7fa;
            padding: 20px;
            overflow-y: auto;
            margin-top: 120px; /* Adjust for fixed header */
            margin-bottom: 50px; /* Adjust for fixed footer */
        }

        .header {
            position: fixed;
            top: 0;
            left: 250px; /* To keep it after the sidebar */
            right: 0;
            background-color: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            z-index: 10;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #3a87ad;
        }

        .filter {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .filter input {
            padding: 8px;
            width: 300px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .filter button {
            padding: 8px 16px;
            background-color: #3a87ad;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .filter button:hover {
            background-color: #2f3b52;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .back-btn {
            margin-top: 20px;
        }

        .back-btn a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }

        .back-btn a:hover {
            background-color: #0056b3;
        }

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
            <a href="prjreport1.php">Reports</a>
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
                <h1>Manage Beneficiaries</h1>
                <!-- Filter/Search Beneficiaries -->
                <form method="GET" class="filter">
                    <input type="text" name="search" placeholder="Search by name or ID..." value="<?= htmlspecialchars($searchTerm) ?>">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>

            <!-- Beneficiaries Section -->
            <div class="section">
                <!-- Show Back Button only when there is a search term -->
                <?php if (!empty($searchTerm)): ?>
                    <div class="back-btn">
                        <a href="managebnr.php">Back to Manage Beneficiaries</a>
                    </div>
                <?php endif; ?>

                <!-- Beneficiaries Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Beneficiary ID</th>
                            <th>Full Name</th>
                            <th>Birthdate</th>
                            <th>Gender</th>
                            <th>Screening Date</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                    <td><?= htmlspecialchars($beneficiary['Date_of_Screening'] ?? 'Not Attended') ?></td>
                                    <td><?= $beneficiary['Date_of_Screening'] ? 'Attended' : 'Missed' ?></td>
                                    <td>
                                        <a href="generate_report.php?id=<?= urlencode($beneficiary['Local_BeneficiaryID']) ?>" class="btn">Generate Report</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No beneficiaries found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Export to CSV Button -->
                <form method="POST">
                    <button type="submit" name="export_csv" class="btn">Export to CSV</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2025 Healthy Project. All rights reserved.
    </div>
</body>
</html>