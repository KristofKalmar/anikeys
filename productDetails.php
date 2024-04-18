<?php
    ini_set('display_errors', 1);
    include 'php/config/config.php';
    $conn = getConnection();

    // Check if the 'id' parameter exists in the URL
    if(isset($_GET['id'])) {
        // Sanitize the input to prevent SQL injection
        $product_id = $conn->real_escape_string($_GET['id']);
        // SQL query to retrieve the product with the specified ID
        $sql = "SELECT * FROM products WHERE id = '$product_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Fetch the result as an associative array
            $product_data = $result->fetch_assoc();
            // Create an object to match the retrieved data
            $product = (object) $product_data;
        } else {
            echo "No product found with ID: $product_id";
        }
    } else {
        echo "No ID parameter provided.";
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
    <?php include 'php/components/header.php'; ?>
    <div class="productDetailsContainer">
        <img src="<?php if($product->imageURL !== ""){echo $product->imageURL;} else {echo "assets/placeholder_larger.svg";} ?>" alt="Avatar" class="productDetailsHeroBackgroundImage" />
        <img src="<?php if($product->imageURL !== ""){echo $product->imageURL;} else {echo "assets/placeholder_larger.svg";} ?>" alt="Herosimg" class="productDetailsHeroImage" />
        <div class="productDetailsContentContainer">
            <p class="productDetailsTitle"><?php echo $product->name ?></p>
            <p class="productDetailsDescriptionText">
                Termékleírás:
            </p>
            <p class="productDescriptionText">
                <?php echo $product->description ?>
            </p>
        </div>
    </div>
    <div class="productDetailsBuyContainer">
        <div class="productDetailsBuyContentContainer">
            <a href="javascript:addToCart(<?php echo "$product->id" ?>)" class="productDetailsPurchaseButton">Kosárba</a>
            <p class="productDetailsPrice" ><?php echo number_format(($product->price * (1 - ($product->sale) / 100)), 0, ',', ' ') ?> Ft<?php if($product->sale > 0){ echo "<p class='productSaleText'> -$product->sale%</p>"; } ?></p>
        </div>
    </div>
    <?php include 'php/components/deals.php'; ?>
    <?php include 'php/components/footer.php'; ?>
    <script>
        function addToCart(id)
        {
            $.ajax({
                type: 'POST',
                url: 'add_to_cart.php',
                data: { product_id: id },
                success: function(response)
                {
                    location.reload();
                },
                error: function(xhr, status, error)
                {
                    console.error(xhr.responseText);
                    alert('Hiba történt a kosárhoz adás közben.');
                }
            });
        }
    </script>
  </body>
</html>