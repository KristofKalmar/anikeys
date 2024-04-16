<?php

session_start();
include 'config.php';
$conn = getConnection();

if(isset($_SESSION['loggedin']) && isset($_SESSION['username'])) {
    $username = $_SESSION['username']; 

    
    if(isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['birthday'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $birthday = $_POST['birthday'];

        $sql = "UPDATE users SET name='$name', address='$address', phone='$phone', birthday='$birthday' WHERE username='$username'";

        if ($conn->query($sql) === TRUE) {
			echo "<script>alert('Sikeresen frissítve!'); window.location.href = 'profil.php';</script>";
			exit();
        } else {
             echo "<script>alert('Hiba az adatbázis frissítése közben: " . $conn->error . "');</script>";
        }
    } else {
		echo "<script>alert('Hiányzó POST adatok!'); window.location.href = 'profil.php';</script>";
    }
} else {
	echo "<script>alert('Hibás jelszó vagy a megadott új jelszavak nem egyeznek meg!'); window.location.href = 'profil.php';</script>";
	
}

$conn->close();
?>
