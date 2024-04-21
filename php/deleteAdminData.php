<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "anikeys");

ini_set('display_errors', 1);

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}

if ($_POST['oldImagePath'] != '') {
    unlink('../' . $_POST['oldImagePath']);
}

$query = "DELETE FROM products
WHERE id = {$_POST['id']};";


if (mysqli_query($conn, $query)) {
    echo "Product deleted successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}


mysqli_close($conn);
