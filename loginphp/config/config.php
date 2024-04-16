<?php


define('DB_SERVER', 'localhost'); // Adatbázis szerver elérési útja (általában localhost)
define('DB_USERNAME', 'root'); // Adatbázis felhasználónév
define('DB_PASSWORD', ''); // Adatbázis jelszó
define('DB_NAME', 'anikeys-logreg'); // Adatbázis neve


$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}
?>