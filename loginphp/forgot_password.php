<?php
require 'config.php'; 

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $result = mysqli_query($conn,"SELECT * FROM users where email='" . $email . "'");
    $row = mysqli_fetch_assoc($result);
  
    if($row){
        $emailtoken = bin2hex(random_bytes(50)); 
        $sql = "UPDATE users SET emailtoken='$emailtoken' WHERE email='$email'"; 

        if (mysqli_query($conn, $sql)) {
            $link = "http://yourwebsite.com/reset_password.php?token=$emailtoken";
            $message = "Kattints a következő linkre a jelszavad visszaállításához: $link";
            mail($email, 'Jelszó visszaállítása', $message); 
			echo "<script>alert('Egy emailt küldtünk a jelszavad visszaállításához!')</script>";
        } else {
			echo "<script>alert('Hiba történt, kérlek próbáld újra!'); window.location.href = 'forgot_password.php';</script>";
        }
    } else {
		echo "<script>alert('Nincs ilyen email cím az adatbázisban!'); window.location.href = 'forgot_password.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelszó visszaállítás</title>
</head>
<body>
    <h2>Jelszó visszaállítás</h2>
    <form action="" method="post">
        <label for="email">Email cím:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Küldés">
    </form>
</body>
</html>
