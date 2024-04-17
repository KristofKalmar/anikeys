<?php
session_start();

if(isset($_SESSION['username']) && isset($_POST['name']) && isset($_POST['price'])) {
    include 'config.php';
    $conn = getConnection();

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $username = $_SESSION['username']; // Felhasználónév a bejelentkezett felhasználóból

    // Kosárba való beszúrás a felhasználónévvel
    $sql = "INSERT INTO cart (name, price, quantity, username) VALUES ('$name', '$price', 1, '$username')";
    if ($conn->query($sql) === TRUE) {
        echo "A termék sikeresen hozzá lett adva a kosárhoz.";
    } else {
        echo "Hiba történt a kosárhoz adás közben: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Hiányzó adatok a kosárhoz adáshoz vagy a felhasználó nincs bejelentkezve.";
}
?>