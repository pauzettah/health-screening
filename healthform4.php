<?php
include("includes/header.php");
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
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header {
            background-color: #3a87ad; /* Blue background */
            color: #fff;
            padding: 0px 0; /* Reduce padding */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 15vh; /* Reduce height */
            z-index: 1000;
            margin-top: 0;
            align-items: center; /* Align content vertically */
            justify-content: center; /* Center content */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1em;
          
        }

        .form {
            background: #f9f9f9;
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
           
        }

        .heading h3 {
            text-align: center;
            margin-bottom: 1.5em;
            font-size: 1.5rem;
        }
        .heading h4 {
            text-align: center;
            margin-bottom: 0;
            margin-bottom: 0.1em;
            font-size: 1.8rem;
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

        .credentials {
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
        }

        .signature-section {
            margin-top: 1em;
        }

        .signature-pad {
            border: 2px solid #000;
            width: 300px;
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
    </style>
</head>
<body>
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
                <textarea id="signature" name="signature" rows="4" readonly placeholder="Draw your signature above"></textarea>
            </div>
            <div>
                <a href="healthform3.php"><button type="button" class="previous">Previous</button></a>
                <button type="submit" class="next">Submit</button>
            </div>
        </div>
    </form>

    <script>
         // Get today's date in YYYY-MM-DD format
        const today = new Date().toISOString().split('T')[0];

        // Set the max attribute on the input field
        document.getElementById('date').setAttribute('max', today);
        const canvas = document.getElementById('signature-pad');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;

        function getEventPosition(event) {

            if (event.touches && event.touches[0]) {
                return { x: event.touches[0].clientX - canvas.getBoundingClientRect().left, 
                         y: event.touches[0].clientY - canvas.getBoundingClientRect().top };
            } else {
                return { x: event.offsetX, y: event.offsetY };
            }
        }

        function startDrawing(event) {
            isDrawing = true;
            const pos = getEventPosition(event);
            ctx.beginPath();
            ctx.moveTo(pos.x, pos.y);
        }

        function draw(event) {
            if (!isDrawing) return;
            const pos = getEventPosition(event);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
        }

        function stopDrawing() {
            isDrawing = false;
            ctx.closePath();
        }

        function clearSignature() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function saveSignature() {
            const dataURL = canvas.toDataURL();
            document.getElementById('signature').value = dataURL; // Ensure the input is updated
            console.log("Captured Base64 Signature:", dataURL); // Debugging output
            alert("Signature saved!");
        }

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        canvas.addEventListener('touchstart', (event) => {
            event.preventDefault();
            startDrawing(event);
        });
        canvas.addEventListener('touchmove', (event) => {
            event.preventDefault();
            draw(event);
        });
        canvas.addEventListener('touchend', (event) => {
            event.preventDefault();
            stopDrawing(event);
        });
    </script>
</body>

<?php
$conn->close();
include("includes/footer.php");
?>
</html>
