<?php
$hide_home = true;
include("includes/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Screening Login</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        /* Header */
        .header {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header img {
            height: 60px;
        }

        .header nav a {
            text-decoration: none;
            color: #333;
            margin: 0 15px;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .header nav a:hover {
            color: #007bff;
        }

        /* Main Section */
        .main {
            text-align: center;
            padding: 50px 20px;
        }

        .main h1 {
            font-size: 2.8rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .main p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 40px;
        }

        /* Login Section Styles */
        .login-sections {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .login-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 25px;
            width: 320px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .login-card img {
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
        }

        .login-card h3 {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .login-card p {
            font-size: 1rem;
            color: #777;
            margin-bottom: 20px;
        }

        /* Dropdown Styles */
        .dropdown {
            display: inline-block;
            position: relative;
        }

        .dropdown button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dropdown button:hover {
            background-color: #0056b3;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #ffffff;
            min-width: 200px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown-content a {
            text-decoration: none;
            color: #333;
            padding: 12px 16px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-content a:hover {
            background-color: #f4f4f4;
        }

        /* Show dropdown when active */
        .dropdown.active .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>

    <!-- Main Section -->
    <main class="main">
        <h1>Welcome to the Health Screening Portal</h1>
        <p>Please select your login section below to proceed.</p>

        <!-- Login Sections -->
        <div class="login-sections">
            <div class="login-card">
                <img src="images/admin.png" alt="Admin Icon">
                <h3>LOGIN</h3>
                <div class="dropdown">
                    <button onclick="toggleDropdown()">Select Role</button>
                    <div class="dropdown-content" id="dropdownMenu">
                        <a href="admin/adminlogin.php">Admin</a>
                        <a href="doctorlogin.php">Doctor</a>
                        <a href="projectdirectorlogin.php">Project Director</a>
                    </div>
                </div>
                <p>Access reports, manage beneficiaries, and oversee screening activities.</p>
            </div>
        </div>
    </main>

    <script>
        function toggleDropdown() {
            document.querySelector(".dropdown").classList.toggle("active");
        }

        // Close dropdown if clicked outside
        document.addEventListener("click", function(event) {
            const dropdown = document.querySelector(".dropdown");
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove("active");
            }
        });
    </script>

    <?php include("includes/footer.php"); ?>

</body>
</html>
