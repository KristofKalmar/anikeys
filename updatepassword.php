<?php
session_start();
include('config.php');
$conn = getConnection();




if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $username = $_SESSION['username'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_new_password'];


    $sql_check_password = "SELECT hashed_password FROM users WHERE username = ?";
    $stmt_check_password = $conn->prepare($sql_check_password);
    $stmt_check_password->bind_param('s', $username);
    $stmt_check_password->execute();
    $result_check_password = $stmt_check_password->get_result();
    $row_check_password = $result_check_password->fetch_assoc();

    if ($row_check_password && password_verify($password, $row_check_password['hashed_password'])) {
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql_update_password = "UPDATE users SET hashed_password = ? WHERE username = ?";
        $stmt_update_password = $conn->prepare($sql_update_password);
        $stmt_update_password->bind_param('ss', $hashed_new_password, $username);
        $stmt_update_password->execute();

        echo "<script>alert('Sikeresen frissítve!'); window.location.href = 'profil.php';</script>";
        exit();
    } else {
        echo "<script>alert('Hibás felhasználónév vagy jelszó, vagy a megadott új jelszavak nem egyeznek meg!'); window.location.href = 'profil.php';</script>";
    }
}
?>