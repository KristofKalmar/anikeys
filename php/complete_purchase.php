<?php
session_start();
include './config/config.php';
$username = $_SESSION['username'];
$conn = getConnection();
ini_set('display_errors', 1);

function uuidv4()
{
    $data = random_bytes(16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

$sql_fetch_cart = "SELECT * FROM cart WHERE username = ?";
$stmt_fetch_cart = $conn->prepare($sql_fetch_cart);
$stmt_fetch_cart->bind_param('s', $username);
$stmt_fetch_cart->execute();
$result = $stmt_fetch_cart->get_result();

if ($result->num_rows > 0) {
    $create_pproducts_table_sql = "CREATE TABLE IF NOT EXISTS purchasedProducts (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `product_id` INT NOT NULL,
        `username` varchar(255) NOT NULL,
        `added_at` datetime DEFAULT current_timestamp(),
        `code` varchar(255) NOT NULL,
        `revealed` INT NOT NULL,
        PRIMARY KEY (`id`)
    );";

    if ($conn->query($create_pproducts_table_sql) === TRUE) {
        $sql_insert_product = "INSERT INTO purchasedProducts (product_id, username, code, revealed) VALUES (?, ?, ?, 0)";
        $stmt_insert_product = $conn->prepare($sql_insert_product);

        while ($row = $result->fetch_assoc()) {
            for ($i = 0; $i < $row['quantity']; $i++) {
                $product_id = $row['product_id'];
                $username_product = $row['username'];
                $code = uuidv4();

                $stmt_insert_product->bind_param('iss', $product_id, $username_product, $code);
                if ($stmt_insert_product->execute()) {

                } else {

                    header("Location: ../index.php?error=" . urlencode("Hiba történt a termék beszúrása közben: " . $conn->error));
                    exit();
                }
            }
        }


        $sql_delete_cart = "DELETE FROM cart WHERE username = ?";
        $stmt_delete_cart = $conn->prepare($sql_delete_cart);
        $stmt_delete_cart->bind_param('s', $username);
        $stmt_delete_cart->execute();
        $stmt_delete_cart->close();


        header("Location: ../profil.php");
        exit();
    } else {

        header("Location: ../index.php?error=" . urlencode("Hiba történt a tábla létrehozása közben: " . $conn->error));
        exit();
    }
} else {

    header("Location: ../index.php?error=" . urlencode("A kosár üres."));
    exit();
}

$stmt_fetch_cart->close();
$conn->close();
