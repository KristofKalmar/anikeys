<?php

if (!isset($_SESSION['username'])) {
    session_start();
}
include 'php/config/config.php';
$conn = getConnection();

$table_exists_sql = "SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'products'";
$table_exists_result = $conn->query($table_exists_sql);

if ($table_exists_result && $table_exists_result->num_rows > 0) {
    $sql = "SELECT * FROM products ORDER BY creationDate DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $product_data = $result->fetch_assoc();

        $product = (object) $product_data;
    } else {
        $product = NULL;
    }
} else {
    $create_table_sql = "CREATE TABLE `products` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `price` int(11) NOT NULL,
            `description` text NOT NULL,
            `sale` int(11) NOT NULL,
            `category_id` int(11) NOT NULL,
            `CPU` INT DEFAULT 0,
            `GPU` INT DEFAULT 0,
            `MEMORY` INT DEFAULT 0,
            `OPSYSTEM` INT DEFAULT 0,
            `STORAGE_GB` INT DEFAULT 0,
            `creationDate` datetime NOT NULL DEFAULT current_timestamp(),
            `imageURL` varchar(255) DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

    if ($conn->query($create_table_sql) === TRUE) {
    } else {
    }
}

$table_exists_sqlUser = "SHOW TABLES LIKE 'users'";
$table_exists_resultUser = $conn->query($table_exists_sqlUser);

if ($table_exists_resultUser && $table_exists_resultUser->num_rows > 0) {
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();

        $user = new stdClass();
        foreach ($user_data as $key => $value) {
            $user->$key = $value;
        }
    } else {
        $user = NULL;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#00243D">
    <title>ANI KEYS</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/index.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <?php include 'php/components/header.php'; ?>
    <div class="hl_textbox">
        <div class="hl_img_bg"></div>
        <img src="<?php if ($product != NULL && $product->imageURL != NULL) {
                        echo $product->imageURL;
                    } else {
                        echo "assets/placeholder_larger.svg";
                    } ?>" alt="h1" class="hl_img" />
        <div class="hl_textbox_contentContainer">
            <h1 class="hl_titleText"><?php if ($product != NULL) {
                                            echo $product->name;
                                        } else {
                                            echo "TERMÉK_NEVE";
                                        } ?></h1>
            <div class="hl_buttonContainer">
                <a href="productDetails.php?id=<?php if ($product != NULL) {
                                                    echo $product->id;
                                                } ?>" class="hl_button <?php if ($product == NULL) {
                                                                        echo "disabled";
                                                                    } ?>">Megtekintés</a>
                <button class="hl_button <?php if ($product == NULL) {
                                                echo "disabled";
                                            } ?>" onclick="addToCart(<?php if ($product != NULL) {
                                                                    echo $product->id;
                                                                } ?>)">Kosárba</button>
            </div>
        </div>
    </div>
    <?php include 'php/components/showcasedItem.php'; ?>
    <?php include 'php/components/deals.php'; ?>
    <?php include 'php/components/footer.php'; ?>
</body>

</html>