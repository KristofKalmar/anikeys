<?php

ini_set('display_errors', 1);
if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME')) define('DB_NAME', 'anikeys');

$conn2 = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn2->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn2->connect_error);
}


if (session_status() == PHP_SESSION_ACTIVE) {
} else {
    session_start();
}

if (isset($_SESSION['username'])) {
    $username1 = $_SESSION['username'];

    $create_cart_table_sql = "CREATE TABLE IF NOT EXISTS cart (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `product_id` INT NOT NULL,
            `quantity` INT NOT NULL,
            `username` varchar(255) NOT NULL,
            `added_at` datetime DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
          );";

    if ($conn2->query($create_cart_table_sql) === TRUE) {
        $sql123 = "SELECT COALESCE(SUM(quantity), 0) AS total_quantity FROM cart WHERE username = '$username1'";
        $result1 = $conn2->query($sql123);
        $row1 = $result1->fetch_assoc();
        $itemCount = $row1['total_quantity'];
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
} else {
    $itemCount = 0;
}

$conn2->close();
?>

<header class="header">
    <div class="headerContentContainer">
        <div class="searchBarContainer">
            <div class="searchBar">
                <input id="searchInput" class="searchBarInput" placeholder="Fedezd fel kínálatunkat!">
                <a href="javascript:searchForProducts()" class="searchButton">
                    <object class="searchIcon" data="assets/search.svg"></object>
                </a>
            </div>
        </div>
        <div class="underContainer">
            <a class="headerLogoLink" href="index.php">
                <object class="logo" data="assets/logo.svg"></object>
            </a>
            <div class="headerButtonsContainer">
                <a href="profil.php" class="headerButton">
                    <object class="headerButtonIcon" data="assets/user.svg"></object>
                </a>
                <a href="cart.php" class="headerButton <?php if ($itemCount <= 0) {
                                                            echo "headerButtonDisabled";
                                                        } ?>">
                    <object class="headerButtonIcon" data="assets/cart.svg"></object>
                    <div class="headerCartButtonNumberIndicator">
                        <?php echo $itemCount; ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="linksContainer">
        <a href="allProducts.php?category_id=1" class="linkItem">
            <label class="linkItemText">PC</label>
        </a>
        <a href="allProducts.php?category_id=2" class="linkItem">
            <label class="linkItemText">Playstation</label>
        </a>
        <a href="allProducts.php?category_id=3" class="linkItem">
            <label class="linkItemText">Xbox</label>
        </a>
        <a href="allProducts.php?category_id=4" class="linkItem">
            <label class="linkItemText">Nintendo</label>
        </a>
    </div>
    <style>
        <?php include 'css/components/header.css' ?>
    </style>
    <script>
        function searchForProducts() {
            const name = document.getElementById("searchInput").value;

            window.location.href = `allProducts.php?name=${name}`;
        }
    </script>
</header>