<?php
    include 'php/config/config.php';

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $conn = getConnection();
        $deleteSql = "UPDATE purchasedProducts SET revealed = 1 WHERE id = $id";
        $conn->query($deleteSql);
        $conn->close();
    }
?>