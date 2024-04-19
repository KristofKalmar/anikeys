<?php
   ini_set('display_errors', 1);
   include 'php/config/config.php';
   $conn = getConnection();

   $table_exists_sql = "SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'products'";
   $table_exists_result = $conn->query($table_exists_sql);

    if ($table_exists_result && $table_exists_result->num_rows > 0)
        {
        $sql = "SELECT * FROM products ORDER BY creationDate DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0)
        {
        $product_data = $result->fetch_assoc();

        $product = (object) $product_data;
        $productBGImage = $product->imageURL;
        $rowListImageBGBool = true;
        $rowListImageBG = $product->imageURL;

        $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
        // Sanitize and validate $category_id if needed

        // Retrieving name from URL
        $name = isset($_GET['name']) ? trim($_GET['name']) : null;
        // Sanitize and validate $name if needed

        // Add % symbols around the name for LIKE comparison and convert both sides to lowercase
        $search_term = '%' . strtolower($name) . '%';

        // Now you can use these variables in your SQL query
        $sql2 = "SELECT * FROM products WHERE category_id = ? OR LOWER(name) LIKE ? ORDER BY name ASC";
        $stmt = $conn->prepare($sql2);

        // Bind parameters
        $stmt->bind_param("is", $category_id, $search_term);

        // Execute query
        $stmt->execute();

        // Get result
        $result_rowList = $stmt->get_result();
    } else
    {
    }
    } else
        {
        // HA nem létezik -->
        $create_table_sql = "CREATE TABLE `products` (
        `id` int(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `price` int(11) NOT NULL,
        `description` text NOT NULL,
        `sale` int(11) NOT NULL,
        `category_id` int(11) NOT NULL,
        `creationDate` datetime NOT NULL DEFAULT current_timestamp(),
        `imageURL` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

        if ($conn->query($create_table_sql) === TRUE) {
        } else {
        }
    }
    $conn->close();

    $multiLine = true;
    $titleText = "Keresés eredménye";
    $rowListImage = "assets/searchResult.svg";
    $rowListHideTitleBar = true;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#00243D">
    <title>Összes termék</title>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="stylesheet" href="css/allProducts.css">
    <link rel="stylesheet" href="css/components/header.css">
    <link rel="stylesheet" href="css/components/footer.css">
    <link rel="stylesheet" href="css/components/rowList.css">
    <link rel="stylesheet" href="css/components/showcasedItem.css">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <script src="js/jquery-3.7.1.min.js"></script>
  </head>
  <body>
  <?php include 'php/components/header.php'; ?>
    <div class="hl_textbox">
        <div class="hl_img_bg"></div>
        <img src="<?php echo $productBGImage ?>" alt="h1" class="hl_img" />
        <div class="hl_textbox_contentContainer">
            <h1 class="hl_titleText">Keresés eredménye</h1>
        </div>
    </div>
    <?php include 'php/components/rowlist.php'; ?>
    <?php include 'php/components/deals.php'; ?>
    <?php include 'php/components/footer.php'; ?>
  </body>
</html>