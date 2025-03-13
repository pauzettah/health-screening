<?php
include("includes/config.php");

// Start the session
session_start();

// Get input data from the URL
$username = $_GET['username'] ?? null;
$password = $_GET['password'] ?? null;

// Ensure required fields are provided
if (!$username || !$password) {
    die("All fields are required.");
}

try {
    // Start transaction
    $conn->begin_transaction();

    // Use a prepared statement to fetch user data and role
    $stmt = $conn->prepare("SELECT username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    if (!$stmt->execute()) {
        throw new Exception("Error fetching user data: " . $stmt->error);
    }

    // Fetch the result
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        throw new Exception("User not found.");
    }

    $userData = $result->fetch_assoc();
    $storedUsername = $userData['username'];
    $storedPassword = $userData['password'];
    $role = $userData['role']; // Fetch the role of the user

    // Compare the passwords (Plain text comparison)
    if ($password !== $storedPassword) {
        throw new Exception("Invalid username or password.");
    }

    // Successful login
    echo "Welcome, " . htmlspecialchars($storedUsername) . "!";

    // Store session variables
    $_SESSION['username'] = $storedUsername;
    $_SESSION['role'] = $role;

    // Redirect based on the role
    if ($role == 'doctor') {
        echo '<script>
            setTimeout(function() {
                window.location.href = "dashboard.php"; // Redirect to dashboard for doctors
            }, 1000); // Redirect after 1 second
        </script>';
    } else {
        throw new Exception("Unauthorized user role.");
    }

    // Commit the transaction
    $conn->commit();
} catch (Exception $e) {
    // Rollback the transaction on error
    $conn->rollback();
    echo "Login failed: " . $e->getMessage();
}

// Close connection
$conn->close();
?>
