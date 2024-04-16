<?php
include ('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
            
        // Ellenőrizd, hogy a felhasználónév már létezik-e az adatbázisban
        $sql_check_username = "SELECT * FROM users WHERE username = ?";
        $stmt_check_username = $conn->prepare($sql_check_username);
        $stmt_check_username->bind_param('s', $username);
        $stmt_check_username->execute();
        $result_check_username = $stmt_check_username->get_result();
        
        if ($result_check_username->num_rows > 0) {
            echo "<script>alert('Felhasználó foglalt!');</script>";
        } else {
            if ($password === $confirm_password) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                $sql = "INSERT INTO users (username, email, hashed_password) VALUES (?, ?, ?)";
                
                // Prepared statement előkészítése
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sss', $username, $email, $hashed_password);
                
                // Lekérdezés végrehajtása
                if ($stmt->execute()) {
                    $success = "Sikeres regisztráció! Most már bejelentkezhetsz.";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<script>alert('Hiba történt a regisztráció során. Kérlek próbáld újra később!');</script>";
                }
                
                $stmt->close(); 
            } else {
                echo "<script>alert('A jelszavak nem egyeznek!');</script>";
            }
        }
        
        $stmt_check_username->close(); // Bezárjuk a prepared statementet a felhasználónév ellenőrzéséhez
    } else {
        echo "<script>alert('Kérlek töltsd ki az összes mezőt!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <meta name="theme-color" content="#00243D">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" href="logreg.css">

    <title>ANI KEYS - Regisztráció</title>
</head>
<body>
    <div class="header">
        <object data="assets/logo.svg"></object>
    </div>
    <div class="container">
        <div class="form-box">
            <form action="register.php" method="post" class="LoginForm">
                <h2>Regisztráció</h2>
                <?php if(isset($error)) { ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php } ?>
                <?php if(isset($success)) { ?>
                    <div class="success"><?php echo $success; ?></div>
                <?php } ?>
                <div class="input-box">
                    <input type="text" name="username" id="username" maxlength="25" required>
                    <label for="username">Felhasználónév</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="email" maxlength="50" required>
                    <label for="email">E-mail cím</label>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" id="reg-pass" name="password" required>
                    <label for="reg-pass">Jelszó</label>
                    <i class='bx bxs-lock-alt reg__eye' id="reg-eye"></i>
                </div>
                <div class="input-box">
                    <input type="password" id="reg-pass2" name="confirm_password" required>
                    <label for="reg-pass2">Jelszó mégegyszer</label>
                    <i class='bx bxs-lock-alt reg__eye' id="reg-eye2"></i>
                </div>
                <button class="btn" name="register">Regisztráció</button>
                <div class="account-creation">
                    <span>Van már fiókod? <a href="login.php" class="LoginLink">Bejelentkezés</a></span>
                </div>
            </form>
        </div>
    </div>
    <script src="logreg.js"></script>
</body>
</html>