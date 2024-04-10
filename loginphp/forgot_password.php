<?php
// Az űrlap elküldése
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Gmail SMTP beállítások
    $smtpHost = 'smtp.gmail.com';
    $smtpUsername = 'info.anikeys@gmail.com';
    $smtpPassword = 'anikeys1234';
    $smtpPort = 587; // Alapértelmezett SMTP port

    $to = $email;
    $subject = "Jelszó emlékeztető";
    $message = "Kattints a linkre a jelszavad visszaállításához: http://www.example.com/reset_password.php?email=$email";
    $headers = "From: your@example.com" . "\r\n" .
               "Reply-To: your@example.com" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    ini_set("SMTP", $smtpHost);
    ini_set("smtp_port", $smtpPort);

    $smtpConnection = stream_socket_client("tcp://$smtpHost:$smtpPort", $errno, $errstr, 30);
    if ($smtpConnection) {
        fwrite($smtpConnection, "EHLO $smtpHost\r\n");
        fwrite($smtpConnection, "STARTTLS\r\n");
        fwrite($smtpConnection, "AUTH LOGIN\r\n");
        fwrite($smtpConnection, base64_encode($smtpUsername) . "\r\n");
        fwrite($smtpConnection, base64_encode($smtpPassword) . "\r\n");
        fwrite($smtpConnection, "MAIL FROM: $smtpUsername\r\n");
        fwrite($smtpConnection, "RCPT TO: $to\r\n");
        fwrite($smtpConnection, "DATA\r\n");
        fwrite($smtpConnection, "Subject: $subject\r\n");
        fwrite($smtpConnection, "From: your@example.com\r\n");
        fwrite($smtpConnection, "Content-Type: text/plain; charset=utf-8\r\n");
        fwrite($smtpConnection, "\r\n");
        fwrite($smtpConnection, "$message\r\n");
        fwrite($smtpConnection, ".\r\n");
        fwrite($smtpConnection, "QUIT\r\n");
        fclose($smtpConnection);

        echo "Az e-mail elküldve. Kérjük, ellenőrizze a postaládáját.";
    } else {
        echo "Hiba történt az e-mail küldése közben.";
    }
}
?>

<!DOCTYPE html>
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
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Jelszó emlékeztető</title>
</head>
<body>
    <h2>Jelszó emlékeztető</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="email">E-mail cím:</label><br>
        <input type="email" id="email" name="email"><br>
        <input type="submit" name="submit" value="Küldés">
    </form>
</body>
</html>