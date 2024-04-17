<?php
include ('config.php');
$conn = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register']))
{
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $create_users_table_sql = "CREATE TABLE IF NOT EXISTS users (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `token` varchar(1000),
            `role` varchar(255),
            `name` varchar(255),
            `username` varchar(50) NOT NULL,
            `email` varchar(100) NOT NULL,
            `emailtoken` varchar(255),
            `hashed_password` varchar(255) NOT NULL,
            `address` text,
            `phone` varchar(255),
            `birthday` date,
            `created_at` datetime DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
          );";

        if ($conn->query($create_users_table_sql) === TRUE)
        {
            // Ellenőrizd, hogy a felhasználónév már létezik-e az adatbázisban
            $sql_check_username = "SELECT * FROM users WHERE username = ?";
            $stmt_check_username = $conn->prepare($sql_check_username);
            $stmt_check_username->bind_param('s', $username);
            $stmt_check_username->execute();
            $result_check_username = $stmt_check_username->get_result();

            // Ellenőrizd, hogy az e-mail cím már létezik-e az adatbázisban
            $sql_check_email = "SELECT * FROM users WHERE email = ?";
            $stmt_check_email = $conn->prepare($sql_check_email);
            $stmt_check_email->bind_param('s', $email);
            $stmt_check_email->execute();
            $result_check_email = $stmt_check_email->get_result();

            if ($result_check_username->num_rows > 0)
            {
                $error = "A felhasználónév már foglalt!";
            } elseif ($result_check_email->num_rows > 0)
            {
                $error = "Az e-mail cím már regisztrálva van!";
            } else {
                if ($password === $confirm_password) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users (username, email, hashed_password) VALUES (?, ?, ?)";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('sss', $username, $email, $hashed_password);

                    if ($stmt->execute()) {
                        $success = "Sikeres regisztráció! Most már bejelentkezhetsz.";
                        header("Location: login.php");
                        exit();

                        $user_id = $conn->insert_id; //
                    } else {
                        $error = "Hiba történt a regisztráció során. Kérlek próbáld újra később.";
                    }

                    $stmt->close();
                } else {
                    $error = "A jelszavak nem egyeznek!";
                }
            }
        } else
        {
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $stmt_check_username->close();
        $stmt_check_email->close();
    } else {
        $error = "Kérlek töltsd ki az összes mezőt!";
    }

    $create_users_table_sql->close();
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
    <link rel="stylesheet" href="css/logreg.css">
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
                    <input type="password" id="password" name="password" required>
                    <label for="password">Jelszó</label>
                    <i class='bx bxs-lock-alt reg__eye' id="reg-eye"></i>
                </div>
                <div class="input-box">
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <label for="confirm_password">Jelszó mégegyszer</label>
                    <i class='bx bxs-lock-alt reg__eye' id="reg-eye2"></i>
                </div>
                <?php if(isset($error)) { ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php } ?>
                <button class="btn" name="register">Regisztráció</button>
                <div class="account-creation">
                    <span>Van már fiókod? <a href="login.php" class="LoginLink">Bejelentkezés</a></span>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="logreg.js"></script>
</html>