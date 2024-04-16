<?php
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['token'])) {
        $emailtoken = $_POST['token'];
        
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE emailtoken=?");
        $stmt->bind_param("s", $emailtoken);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
                
                if ($new_password === $confirm_password) {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE users SET hashed_password=? WHERE emailtoken=?");
                    $stmt->bind_param("ss", $hashed_password, $emailtoken);
                    $stmt->execute();
					echo "<script>alert('A jelszavad sikeresen frissítve lett!'); window.location.href = 'forgot_password.php'; </script>";
                } else {
					echo "<script>alert('A jelszavak nem egyeznek!'); window.location.href = 'reset_password.php'; </script>";
                }
            }
        } else {
			echo "<script>alert('Érvénytelen vagy lejárt link!'); window.location.href = 'reset_password.php'; </script>";
        }
    } else {
		echo "<script>alert('Hibás kérés!'); window.location.href = 'reset_password.php'; </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelszó visszaállítása</title>
</head>
<body>
    <h2>Jelszó visszaállítása</h2>
    <form action="reset_password.php" method="post">
        <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? $_GET['token'] : '' ?>">
        <label for="new_password">Új jelszó:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <label for="confirm_password">Jelszó megerősítése:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <input type="submit" value="Jelszó frissítése">
    </form>
</body>
</html>
