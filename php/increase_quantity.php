<?php
include './config/config.php';
$conn = getConnection();


if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $conn = getConnection();
    $updateSql = "UPDATE cart SET quantity = quantity + 1 WHERE id = $id";
    $conn->query($updateSql);
}

$conn->close();
