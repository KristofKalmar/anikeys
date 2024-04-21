<?php

session_start();
include './config/config.php';
$username = $_SESSION['username'];
$conn = getConnection();
ini_set('display_errors', 1);


if (isset($_SESSION['username'])) {

    $sql_fetch_image = "SELECT imageURL FROM users WHERE username = ?";
    $stmt_fetch_image = $conn->prepare($sql_fetch_image);
    $stmt_fetch_image->bind_param("s", $_SESSION['username']);
    $stmt_fetch_image->execute();
    $result_fetch_image = $stmt_fetch_image->get_result();

    if ($result_fetch_image->num_rows > 0) {
        $row = $result_fetch_image->fetch_assoc();
        $imageURL = $row['imageURL'];

        if (!empty($imageURL)) {
            unlink("../" . $imageURL);
        }
    }

    $sql_delete_cart = "DELETE FROM cart WHERE username = ?";
    $stmt_delete_cart = $conn->prepare($sql_delete_cart);
    $stmt_delete_cart->bind_param("s", $_SESSION['username']);
    $stmt_delete_cart->execute();
    $stmt_delete_cart->close();

    $sql_delete_purchased = "DELETE FROM purchasedProducts WHERE username = ?";
    $stmt_delete_purchased = $conn->prepare($sql_delete_purchased);
    $stmt_delete_purchased->bind_param("s", $_SESSION['username']);
    $stmt_delete_purchased->execute();
    $stmt_delete_purchased->close();

    $sql_delete_user = "DELETE FROM users WHERE username = ?";
    $stmt_delete_user = $conn->prepare($sql_delete_user);
    $stmt_delete_user->bind_param("s", $_SESSION['username']);
    $stmt_delete_user->execute();
    $stmt_delete_user->close();

    $conn->close();

    session_unset();
    session_destroy();

    echo "<script>window.location.href = '../index.php';</script>";
    exit();
} else {
    echo "User not logged in.";
}
?>
