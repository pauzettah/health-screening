<?php
include("includes/config.php");

// Fetch IDs from the database
$sql = "SELECT Local_BeneficiaryID FROM personal_info";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Health Screening Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f7fa;
        }

        header {
            background-color: #3a87ad; /* Blue background */
            color: #fff;
            padding: 15px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            height: 80px;
        }

        header .logo {
            display: flex;
            align-items: center;
            margin-left: 10px;
        }

        header .logo img {
            height: 40px;
            margin-right: 10px;
        }

        header .logo h1 {
            font-size: 20px;
            margin: 0;
        }

        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }

        header nav ul li {
            display: inline;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            margin-right: 90px;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2em;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 70px; /* Add margin to prevent content from being covered by the header */
            margin-bottom: 60px; /* Add margin to prevent content from being covered by the footer */
        }

        .form {
            padding: 2em;
        }

        .heading h3, .heading h4 {
            text-align: center;
            margin-bottom: 1.5em;
            color: #3a87ad;
        }

        label {
            font-size: 1rem;
            font-weight: 500;
            display: block;
            margin-bottom: 0.5em;
        }

        textarea, input, select {
            width: 100%;
            max-width: 100%;
            padding: 0.8em;
            margin-bottom: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .signature-section {
            margin-top: 1em;
        }

        .signature-pad {
            border: 2px solid #000;
            width: 100%;
            max-width: 300px;
            height: 150px;
            border-radius: 5px;
            cursor: crosshair;
        }

        .buttons {
            margin-top: 0.5em;
            display: flex;
            gap: 1em;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0.7em 1.5em;
            cursor: pointer;
            font-size: 1rem;
        }

        button:hover {
            background-color: #0056b3;
        }

        .previous, .next {
            margin: 1em 0;
        }

        footer {
            background-color: #3a87ad;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            margin-bottom: 0;
        }

        footer span {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Health Screening System Logo">
            <h1>Health Screening System</h1>
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <!-- Form Section -->
    <form action="formfourprocessdata.php" method="POST">
        <div class="container">
            <div class="form">
                <hr>
                <div class="heading">
                    <h4>Select ID</h4>
                </div>
                <label for="select-id">ID</label>
                <select name="selected_id" id="select-id" required>
                    <option value="" disabled selected>-- Select an ID --</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['Local_BeneficiaryID']) . "'>" . htmlspecialchars($row['Local_BeneficiaryID']) . "</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No IDs available</option>";
                    }
                    ?>
                </select>

                <hr>
                <div class="heading">
                    <h3>Interpretation and Recommendation</h3>
                </div>
                <label for="health-status">Health Status:</label>
                <select id="health-status" name="health_status" onchange="toggleMajorFindings()" required>
                    <option value="">--Select--</option>
                    <option value="sick">Sick</option>
                    <option value="not-sick">Not Sick</option>
                </select>

                <div id="major-findings-div" style="display: none;">
                    <label for="major_findings">063 Major Findings</label>
                    <textarea name="major_findings" id="major_findings" rows="4" cols="30" placeholder="Enter major findings..."></textarea>
                </div>

                <script>
                    function toggleMajorFindings() {
                        var status = document.getElementById("health-status").value;
                        var majorFindingsDiv = document.getElementById("major-findings-div");
                        var majorFindingsTextarea = document.getElementById("major_findings");

                        if (status === "sick") {
                            majorFindingsDiv.style.display = "block";
                            majorFindingsTextarea.setAttribute("required", "required");
                        } else {
                            majorFindingsDiv.style.display = "none";
                            majorFindingsTextarea.removeAttribute("required");
                        }
                    }
                </script>

                <label for="diagnosis">064 Diagnosis and ICD Number if known</label>
                <textarea name="diagnosis_and_ICDnumber_ifknown" id="diagnosis" rows="6" placeholder="Please explain in less than 1000 characters" required></textarea>

                <label for="therapy">065 Therapy and Recommendation</label>
                <textarea name="therapy_and_recommendation" id="therapy" rows="6" placeholder="Please explain in less than 1000 characters" required></textarea>

                <div class="heading">
                    <h3>Credential of Examiner</h3>
                </div>
                <label for="name">066 Name</label>
                <input type="text" id="name" name="name" placeholder="Enter name" required>

                <label for="qualification">067 Qualification</label>
                <input type="text" id="qualification" name="qualification" placeholder="Enter qualification" required>

                <label for="date">068 Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="signature-section">
                <label for="signature">069 Signature</label>
                <canvas id="signature-pad" class="signature-pad"></canvas>
                <div class="buttons">
                    <button type="button" onclick="clearSignature()">Clear</button>
                    <button type="button" onclick="saveSignature()">Save</button>
                </div>
                <!-- Hidden input to store the Base64-encoded signature -->
                <input type="hidden" id="signature" name="signature">
            </div>
            <div>
                <a href="healthform3.php"><button type="button" class="previous">Previous</button></a>
                <button type="submit" class="next">Submit</button>
            </div>
        </div>
    </form>

    <footer>
        © <span id="year"></span> Health Screening System | All rights reserved
    </footer>
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    // Initialize the signature pad
    const canvas = document.getElementById('signature-pad');
    const signaturePad = new SignaturePad(canvas);

    // Clear the signature pad
    function clearSignature() {
        signaturePad.clear();
        document.getElementById('signature').value = ''; // Clear the hidden input
    }

    // Save the signature as a Base64 string
    function saveSignature() {
        if (signaturePad.isEmpty()) {
            alert('Please provide a signature first.');
        } else {
            const dataURL = signaturePad.toDataURL(); // Get the signature as a Base64 string
            document.getElementById('signature').value = dataURL; // Save it to the hidden input
            alert('Signature saved successfully!');
        }
    }

    // Resize the canvas to fit its container
    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext('2d').scale(ratio, ratio);
        signaturePad.clear(); // Clear the canvas after resizing
    }

    // Adjust the canvas size on window resize
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas(); // Initial resize
</script>

<?php
$conn->close();
?>
</html>