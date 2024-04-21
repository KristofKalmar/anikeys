<?php
// Start the session
session_start();
include 'php/config/config.php';
$username = $_SESSION['username'];
$conn = getConnection();
ini_set('display_errors', 1);

// Check if the user is logged in
if (isset($_SESSION['username'])) {

    // Delete records from the "cart" table where username matches
    $sql = "DELETE FROM cart WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $stmt->close();

    // Delete records from the "purchasedProducts" table where username matches
    $sql = "DELETE FROM purchasedProducts WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $stmt->close();

    // Delete user from the "users" table if username matches
    $sql = "DELETE FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $stmt->close();

    // Close connection
    $conn->close();

    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to index.php
    echo "<script>window.location.href = 'index.php';</script>";
    exit();
} else {
    echo "User not logged in.";
}
?>
