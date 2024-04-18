<?php
    session_start();
    include 'php/config/config.php';


    $username = $_SESSION['username'];
    $conn = getConnection();


    $sql_delete_cart = "DELETE * FROM cart WHERE username = ?";
    $stmt_delete_cart = $conn->prepare($sql_delete_cart);
    $stmt_delete_cart->bind_param('s', $username);

    if ($stmt_delete_cart->execute()) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php?error=" . urlencode("Hiba történt a kosár törlése közben: " . $conn->error));
        exit();
    }

    $stmt_delete_cart->close();
    $conn->close();
?>
