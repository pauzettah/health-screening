<?php
include("includes/config.php");

// Validate input data
$username = $_POST['username'] ?? null;
$firstname = $_POST['firstname'] ?? null;
$lastname = $_POST['lastname'] ?? null;
$mobile = $_POST['mobile'] ?? null;
$password = $_POST['password'] ?? null;

// Ensure required fields are provided
if (!$username || !$firstname || !$lastname || !$mobile || !$password) {
    die("All fields are required.");
}



// Start transaction
$conn->begin_transaction();

try {
    // Use a prepared statement to insert data
    $stmt = $conn->prepare("INSERT INTO users (username, firstname, lastname, mobile, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $firstname, $lastname, $mobile, $password);

    if (!$stmt->execute()) {
        throw new Exception("Error inserting into users: " . $stmt->error);
    }

  // Display message and redirect using JavaScript
  echo "Records inserted successfully. You can now login...";
  echo '<script>
      setTimeout(function() {
          window.location.href = "index.php";
      }, 4000); // Redirect after 4 seconds
  </script>';

    // Commit the transaction
    $conn->commit();

} catch (Exception $e) {
    // Rollback the transaction on error
    $conn->rollback();
    echo "Transaction failed: " . $e->getMessage();
}

// Close connection
$conn->close();
?>
