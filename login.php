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
    <title>ANI KEYS - Bejelentkezés</title>
</head>
<body>
    <div class="header">
        <object data="assets/logo.svg"></object>
    </div>
    <div class="container">
        <div class="form-box">
            <form action="login.php" method="post" class="LoginForm">
                <h2>Bejelentkezés</h2>
                <div class="input-box">
                    <input type="text" name="username" id="username" maxlength="25"  required>
                    <label for="username">Felhasználónév</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" id="login-pass" name="password" required>
                    <label for="login-pass">Jelszó</label>
                    <i class='bx bxs-lock-alt login__eye' id="login-eye"></i>
                </div>
                <div class="forget-section">
                    <p>
                        <input type="checkbox" name="save" id="passsave">
                        Jegyezz meg!
                    </p>
                    <a href="forgot_password.php">Elfelejtetted a jelszavad?</a>
                </div>
                <?php if(isset($error)) { ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php } ?>
                <button class="btn" name="login">Bejelentkezés</button>
                <div class="account-creation">
                    <span>Nincs fiókod? <a href="register.php" class="regLink">Regisztráció</a></span>
                </div>
            </form>
        </div>
    </div>
    <script src="logreg.js"></script>
</body>
</html>

<?php
session_start();
include ('config.php');
$conn = getConnection();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username = ?";
        
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Ellenőrzi, hogy a felhasználó létezik-e az adatbázisban
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password_from_database = $row['hashed_password'];
            
            
            if (password_verify($password, $hashed_password_from_database)) {
                
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                
                if(isset($_POST['save']) && $_POST['save'] == 'on') {
                    $token = bin2hex(random_bytes(32)); 
                    
                    // Elmentjük a token-t az adatbázisban
                    $sql = "UPDATE users SET token = ? WHERE username = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ss', $token, $username);
                    $stmt->execute();
                    
                    setcookie('remember_me', $token, time() + (30 * 24 * 60 * 60), '/'); // 30 napig
                }
                header("Location: index.php"); 
                exit();
            } else {
                echo "<script>alert('Hibás felhasználó név vagy jelszó!');</script>";
            }
        } else {
            echo "<script>alert('Hibás felhasználó név vagy jelszó!');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Kérlek add meg a felhasználóneved és a jelszavad!');</script>";
        
    }
}
?>