<?php
include './config/config.php';
$conn = getConnection();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $conn = getConnection();
    $sql = "SELECT * FROM cart WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantity = $row['quantity'];

        if ($quantity > 1) {
            $newQuantity = $quantity - 1;
            $updateSql = "UPDATE cart SET quantity = $newQuantity WHERE id = $id";
            $conn->query($updateSql);
        } else {
            $deleteSql = "DELETE FROM cart WHERE id = $id";
            $conn->query($deleteSql);
        }
    }
}
$conn->close();
