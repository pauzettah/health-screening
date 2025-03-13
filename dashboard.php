<?php 
include("includes/config.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: index.php");
    exit();
}

// Assuming the user's name is stored in the session after they log in
$username = $_SESSION['username'] ?? 'Guest'; // Default to 'Guest' if no user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Health Screening Form</title>
    <style>
        /* General body styling */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Header Section Styling */
       /* Fixed Header */
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #3a87ad;
    color: #fff;
    padding: 20px 0;
    z-index: 1000;
   margin-top: 0;
    }

    /* Fixed Footer */
    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #3a87ad;
        color: #fff;
        text-align: center;
        padding: 20px;
        z-index: 1000;
    }

    /* Ensure main content is visible and scrollable */
    main {
        margin-top: 80px; /* Adjust according to the header height */
        margin-bottom: 80px; /* Adjust according to the footer height */
        padding: 20px;
        overflow-y: auto;
    }


        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        header .logo img {
            margin-right: 10px;
        }

        header .logo h1 {
            margin: 0;
            font-size: 24px;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        header nav ul li {
            display: inline;
            margin-right: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        /* Main content section */
        main {
            padding: 20px;
        }

        .content-section {
            margin-bottom: 40px;
        }

        .content-section h2 {
            font-size: 24px;
            color: #3a87ad;
        }

        .content-section p {
            font-size: 16px;
            line-height: 1.5;
        }

        .content-section img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }

        /* Footer Section Styling */
        footer {
            background-color: #3a87ad;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer .footer-content {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        footer .footer-content p {
            margin: 5px;
        }

        footer .footer-content a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        footer .footer-content a:hover {
            text-decoration: underline;
        }

        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            header .container {
                flex-direction: column;
                align-items: flex-start;
            }

            header .logo h1 {
                font-size: 20px;
            }

            header nav ul {
                padding-left: 0;
                margin-top: 10px;
            }

            header nav ul li {
                display: block;
                margin-right: 0;
                margin-bottom: 10px;
            }

            .content-section h2 {
                font-size: 20px;
            }

            .content-section p {
                font-size: 14px;
            }

            footer .footer-content {
                flex-direction: column;
                text-align: center;
            }

            footer .footer-content p {
                margin: 10px 0;
            }

            footer .footer-content a {
                margin-top: 5px;
            }
        }

        @media (max-width: 480px) {
            header .logo h1 {
                font-size: 18px;
            }

            .content-section h2 {
                font-size: 18px;
            }

            .content-section p {
                font-size: 12px;
            }

            footer .footer-content a {
                font-size: 14px;
            }

            marquee {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <div class="logo">
                <img src="images/logo.png" alt="Health Screening System Logo" height="50">
                <h1>Health Screening System</h1>
            </div>
            <nav>
                <ul>
                    <!-- Added links to form pages -->
                    <li><a href="#">Contact</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <!-- Main Content Section -->
    <main>
        <marquee style="color: lime; font-size: 18px;">WELCOME, FILL IN YOUR DATA CORRECTLY</marquee>
        <hr>

        <!-- Health Screening Information Section -->
        <div class="content-section">
            <h2>Understanding Health Screenings</h2>
            <p>Health screenings are essential to detect potential health conditions before they become more serious. Early detection allows for better treatment and management of medical issues.</p>
            <img src="images/child.jpg" alt="Health Screening" />
        </div>

        <!-- Screening Types Section -->
        <div class="content-section">
            <h2>Common Types of Health Screenings</h2>
            <ul>
                <li><strong>Blood Pressure Screening</strong>: Detects hypertension (high blood pressure), which can lead to serious conditions like heart disease and stroke.</li>
                <li><strong>Cholesterol Screening</strong>: Monitors cholesterol levels to help assess the risk of heart disease.</li>
                <li><strong>Diabetes Screening</strong>: Helps identify individuals at risk for diabetes or those already diagnosed.</li>
                <li><strong>Cancer Screenings</strong>: Includes screenings like mammograms, colonoscopies, and skin exams to detect various cancers early.</li>
                <li><strong>Vision and Hearing Screenings</strong>: Tests to ensure that your senses are functioning properly, particularly as you age.</li>
            </ul>
        </div>

        <!-- Immunization Information Section -->
        <div class="content-section">
            <h2>Vaccinations and Immunizations</h2>
            <p>Vaccines are crucial in protecting against diseases. Here are some of the key vaccines that should be part of your health screening:</p>
            <img src="images/child.jpg" alt="Vaccines" />
            <ul>
                <li><strong>BCG Vaccine</strong>: Protects against tuberculosis.</li>
                <li><strong>Hepatitis B Vaccine</strong>: Helps prevent Hepatitis B, a liver infection.</li>
                <li><strong>Influenza Vaccine</strong>: Annual flu shot to reduce the risk of flu outbreaks.</li>
                <li><strong>Pneumococcal Vaccine</strong>: Protects against pneumonia, meningitis, and other infections caused by pneumococcal bacteria.</li>
                <li><strong>HPV Vaccine</strong>: Prevents human papillomavirus, which can lead to cervical cancer and other health problems.</li>
            </ul>
            <hr>
            <hr>

            <div>
                <a href="healthform1.php">
                    <button class="#" type="submit">Click Next to Start Filling Student Data</button>
                </a><hr>
                <hr>
                <a href="doctordash.php"><button>Go to Dashboard</button></a>
            </div>
        </div>

        
    </main>
    

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Health Screening System | All rights reserved</p>
            <p><a href="https://www.compassion.com/contact/">Contact Us</a> | <a href="privacy.php">Privacy Policy</a></p>
        </div>
    </footer>
</body>
</html>
