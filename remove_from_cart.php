<?php
    include 'php/config/config.php';
    $conn = getConnection();

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $conn = getConnection();
        $deleteSql = "DELETE FROM cart WHERE id = $id";
        $conn->query($deleteSql);
    }

    $conn->close();
?>