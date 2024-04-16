<?php

define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "anikeys");

ini_set('display_errors', 1);

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}

$table_name = 'products';
$sql = "SELECT table_name
        FROM information_schema.tables
        WHERE table_name = '$table_name'
        LIMIT 1";
$table_result = $conn->query($sql);

$product_id = $_GET['id'];

if ($table_result->num_rows > 0)
{
    // Table found, download its contents
    $sql = "SELECT * FROM products WHERE id = {$_GET['id']}";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
} else
{
    $result = NULL;
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
    <link rel="stylesheet" href="css/productDetails.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <script src="js/jquery-3.7.1.min.js"></script>
  </head>
  <body>
	  <script src="./components/header/header.js"></script>
	  <script src="./components/footer/footer.js"></script>
	  <script src="./components/rowList/rowList.js"></script>
    <div id="header"></div>
    <div class="productDetailsContainer">
        <img src="<?php echo $product['imageURL'] ?>" alt="Avatar" class="productDetailsHeroBackgroundImage" />
        <img src="<?php echo $product['imageURL'] ?>" alt="Herosimg" class="productDetailsHeroImage" />
        <div class="productDetailsContentContainer">
            <p class="productDetailsTitle"><?php echo $product['name'] ?></p>
            <p class="productDetailsDescriptionText">
                Termékleírás:
            </p>
            <p class="productDetailsDescriptionHTMLCode">
                <?php echo $product['description'] ?>
            </p>
        </div>
    </div>
    <div data-title="Kiemelt ajánlatok" data-logo="sale.svg" id="rowList"></div>
    <div id="footer"></div>
    <div class="productDetailsBuyContainer">
        <div class="productDetailsBuyContentContainer">
            <button class="productDetailsPurchaseButton">Kosárba</button>
            <p class="productDetailsPrice"><?php echo $product['price'] ?> Ft</p>
        </div>
    </div>
  </body>
</html>