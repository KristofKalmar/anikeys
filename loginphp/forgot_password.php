<?php
include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Generate a unique token for password reset
        $token = bin2hex(random_bytes(32));

        // Update the user's token in the database
        $sql_update_token = "UPDATE users SET token = ? WHERE email = ?";
        $stmt_update_token = $conn->prepare($sql_update_token);
        $stmt_update_token->bind_param('ss', $token, $email);
        $stmt_update_token->execute();

        // Send password reset email
        $to = $email;
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: http://yourwebsite.com/reset_password.php?token=$token";
        $headers = "From: kraphexe@gmail.com";

        // Send email
        if (mail($to, $subject, $message, $headers)) {
            echo "Password reset link has been sent to your email address.";
        } else {
            echo "Failed to send password reset email.";
        }
    } else {
        echo "Email not found in the database.";
    }

    $stmt->close();
}
?>