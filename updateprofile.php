<?php
    session_start();
    include 'php/config/config.php';
    $conn = getConnection();

    if(isset($_SESSION['loggedin']) && isset($_SESSION['username'])) {
        $loggedInUsername = $_SESSION['username'];

        if(isset($_POST['name']) && isset($_POST['newUsername']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['birthday'])) {
            $name = $_POST['name'];
            $newUsername = $_POST['newUsername'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $birthday = $_POST['birthday'];

            $checkQuery = "SELECT * FROM users WHERE (username='$newUsername' OR email='$email') AND NOT username='$loggedInUsername'";
            $checkResult = $conn->query($checkQuery);
            if ($checkResult->num_rows > 0) {
                echo "<script>alert('A megadott felhasználónév vagy email már foglalt!'); window.location.href = 'profil.php';</script>";
                exit();
            }

            $sql = "UPDATE users SET name=?, username=?, email=?, address=?, phone=?, birthday=? WHERE username=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssss', $name, $newUsername, $email, $address, $phone, $birthday, $loggedInUsername);
            if ($stmt->execute()) {
                $_SESSION['username'] = $newUsername;
                echo "<script>window.location.href = 'profil.php';</script>";
                exit();
            } else {
                echo "<script>alert('Hiba az adatbázis frissítése közben: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Hiányzó POST adatok!'); window.location.href = 'profil.php';</script>";
        }
    } else {
        echo "<script>alert('Nincs bejelentkezve!'); window.location.href = 'login.php';</script>";
    }

    $conn->close();
?>
