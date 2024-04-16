<?php include ('config.php'); ?>

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
    <link rel="stylesheet" href="css/logreg.css">

    <title>ANI KEYS</title>
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
                    <a href="#">Elfelejtetted a jelszavad?</a>
                </div>
                <button class="btn">Bejelentkezés</button>
                <div class="account-creation">
                    <span>Nincs fiókod? <a href="#" class="regLink">Regisztráció</a></span>
                </div>
            </form>

            <!--Regisztráció -->

            <form action="register.php" method="post" class="regForm">
			<h2>Regisztráció</h2>
				<div class="input-box">
					<input type="text" id="login-name" name="username" required>
					<label for="login-name">Felhasználónév</label>
						<i class='bx bxs-user'></i>
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
					<span>Van már fiókod? <a href="#" class="LoginLink">Bejelentkezés</a></span>
				</div>
			</form>
        </div>
    </div>
</body>
<script src="logreg.js"></script>
</html>