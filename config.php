<?php
if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME')) define('DB_NAME', 'anikeys');

if (!function_exists('getConnection')) {
    function getConnection()
    {
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
        }

        return $conn;
    }
} else {
    return $conn;
}
