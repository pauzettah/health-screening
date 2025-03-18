<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acknowledgment Received</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(21, 159, 30);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 50%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        h3 {
            color: green;
        }
        .handshake-icon {
            margin-top: 20px;
        }
        .handshake-icon img {
            width: 80px;
            height: 80px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Acknowledgment Received</h2>
        <h3>Your acknowledgment has been received successfully!</h3>
        <div class="handshake-icon">
            <img src="images/download.png" alt="Handshake Icon">
        </div>
        <p>Thank you for acknowledging the information. Your submission has been processed successfully.</p>
    </div>
    <script>
        // Redirect to dashboard.php after 2 seconds
        setTimeout(function() {
            console.log("Redirecting to dashboard.php...");
            window.location.href = "dashboard.php";
        }, 2000); // Redirect after 2 seconds
    </script>
</body>
</html>