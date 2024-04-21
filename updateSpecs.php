<?php
    session_start();
    include 'php/config/config.php';
    $conn = getConnection();

    if(isset($_SESSION['loggedin']) && isset($_SESSION['username'])) {
        $loggedInUsername = $_SESSION['username'];

        if(isset($_POST['CPU']) && isset($_POST['GPU']) && isset($_POST['MEMORY']) && isset($_POST['OPSYSTEM']))
        {
            $CPU = $_POST['CPU'];
            $GPU = $_POST['GPU'];
            $MEMORY = $_POST['MEMORY'];
            $OPSYSTEM = $_POST['OPSYSTEM'];

            $sql_update_user = "UPDATE users SET CPU = ?, GPU = ?, MEMORY = ?, OPSYSTEM = ? WHERE username = ?";
            $stmt_update_user = $conn->prepare($sql_update_user);
            $stmt_update_user->bind_param('dddds', $CPU, $GPU, $MEMORY, $OPSYSTEM, $_SESSION['username']);
            $stmt_update_user->execute();

            echo "<script>window.location.href = 'profil.php';</script>";
            exit();
        } else {
            echo "<script>alert('Hiányzó POST adatok!'); window.location.href = 'profil.php';</script>";
        }
    } else {
        echo "<script>alert('Nincs bejelentkezve!'); window.location.href = 'login.php';</script>";
    }

    $conn->close();
?>
