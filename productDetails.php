<?php
if (session_status() == PHP_SESSION_ACTIVE) {
} else {
    session_start();
}
ini_set('display_errors', 1);
include 'php/config/config.php';
$conn = getConnection();

if (isset($_GET['id'])) {
    $product_id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $product_data = $result->fetch_assoc();
        $product = (object) $product_data;

        if (isset($_SESSION['username'])) {
            $sql = "SELECT * FROM users products WHERE username = '{$_SESSION['username']}'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $user_data = $result->fetch_assoc();
                $user = (object) $user_data;
            } else {
            }
        }
    } else {
        echo "Nincs termék a következő azonosítóval: $product_id";
    }
} else {
    echo "Nincs azonosító paraméter megadva.";
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
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg">
    <script src="js/jquery-3.7.1.min.js"></script>
</head>

<body>
    <?php include 'php/components/header.php'; ?>
    <div class="productDetailsContainer">
        <img src="<?php if ($product->imageURL !== "") {
                        echo $product->imageURL;
                    } else {
                        echo "assets/placeholder_larger.svg";
                    } ?>" alt="Avatar" class="productDetailsHeroBackgroundImage" />
        <img src="<?php if ($product->imageURL !== "") {
                        echo $product->imageURL;
                    } else {
                        echo "assets/placeholder_larger.svg";
                    } ?>" alt="Herosimg" class="productDetailsHeroImage" />
        <?php
        if (isset($_SESSION['username']) && isset($user) && (
            ($user->CPU > 0 && $product->CPU > 0 && $user->CPU < $product->CPU) ||
            ($user->GPU > 0 && $product->GPU > 0 && $user->GPU < $product->GPU) ||
            ($user->MEMORY > 0 && $product->MEMORY > 0 && $user->MEMORY < $product->MEMORY) ||
            ($user->OPSYSTEM > 0 && $product->OPSYSTEM > 0 && $user->OPSYSTEM < $product->OPSYSTEM)
        )) {
        ?>
            <div class="weakSpecsWarning">
                Figyelem! A megadott specifikációkkal nem fog futni a játék a gépeden!
            </div>
        <?php
        }
        ?>
        <div class="productDetailsContentContainer">
            <p class="productDetailsTitle"><?php echo $product->name ?></p>
            <p class="productDetailsDescriptionText">
                Termékleírás:
            </p>
            <p class="productDescriptionText">
                <?php echo $product->description ?>
            </p>
            <?php
            $CPU = [
                0 => '-',
                1 => 'i3',
                2 => 'i5',
                3 => 'i7',
                4 => 'i9',
            ];

            $GPU = [
                0 => '-',
                1 => 'Nvidia GeForce RTX 3050',
                2 => 'Nvidia GeForce RTX 3060',
                3 => 'Nvidia GeForce RTX 3070',
                4 => 'Nvidia GeForce RTX 3080',
                5 => 'Nvidia GeForce RTX 3090',
                6 => 'Nvidia GeForce RTX 4060',
                7 => 'Nvidia GeForce RTX 4070',
                8 => 'Nvidia GeForce RTX 4080',
                9 => 'Nvidia GeForce RTX 4090',
            ];

            $MEMORY = [
                0 => '-',
                1 => '2 GB',
                2 => '4 GB',
                3 => '8 GB',
                4 => '16 GB',
                5 => '32 GB',
                6 => '64 GB',
            ];

            $OPSYSTEM = [
                0 => '-',
                1 => 'Windows 7 (64bit)',
                2 => 'Windows 10 (64bit)',
                3 => 'Windows 11 (64bit)',
            ];

            function getEnumValue($value, $enum)
            {
                return isset($enum[$value]) ? $enum[$value] : '-';
            }

            if ($product->category_id == 1) {
            ?>
                <p class="productTableTitle">
                    Minimum rendszerkövetelmények:
                </p>
                <table class="productDetailsTable">
                    <tbody>
                        <tr>
                            <td>CPU</td>
                            <td><?php echo getEnumValue($product->CPU, $CPU) ?></td>
                        </tr>
                        <tr>
                            <td>GPU</td>
                            <td><?php echo getEnumValue($product->GPU, $GPU) ?></td>
                        </tr>
                        <tr>
                            <td>Memória</td>
                            <td><?php echo getEnumValue($product->MEMORY, $MEMORY) ?></td>
                        </tr>
                        <tr>
                            <td>Operációs rendszer</td>
                            <td><?php echo getEnumValue($product->OPSYSTEM, $OPSYSTEM) ?></td>
                        </tr>
                        <tr>
                            <td>Minimum tárhely</td>
                            <td><?php echo $product->STORAGE_GB ?> GB</td>
                        </tr>
                    </tbody>
                </table>
            <?php
            }
            ?>
            <?php
            if ($product->category_id == 1 && isset($_SESSION['username']) && isset($user)) {
            ?>
                <p class="productTableTitle productsTableTitleSecond">
                    Te rendszered:
                </p>
                <table class="productDetailsTable">
                    <tbody>
                        <tr>
                            <td>CPU</td>
                            <td><?php echo getEnumValue($user->CPU, $CPU) ?></td>
                        </tr>
                        <tr>
                            <td>GPU</td>
                            <td><?php echo getEnumValue($user->GPU, $GPU) ?></td>
                        </tr>
                        <tr>
                            <td>Memória</td>
                            <td><?php echo getEnumValue($user->MEMORY, $MEMORY) ?></td>
                        </tr>
                        <tr>
                            <td>Operációs rendszer</td>
                            <td><?php echo getEnumValue($user->OPSYSTEM, $OPSYSTEM) ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="productDetailsBuyContainer">
        <div class="productDetailsBuyContentContainer">
            <a href="javascript:addToCart(<?php echo "$product->id" ?>)" class="productDetailsPurchaseButton">Kosárba</a>
            <div class="productDetailsPriceContainer">
                <p class="productDetailsPrice"><?php echo number_format(($product->price * (1 - ($product->sale) / 100)), 0, ',', ' ') ?> Ft<?php if ($product->sale > 0) {
                                                                                                                                                echo "<p class='productSaleText'>-$product->sale%</p>";
                                                                                                                                            } ?></p>
            </div>
        </div>
    </div>
    <?php include 'php/components/deals.php'; ?>
    <?php include 'php/components/footer.php'; ?>
    <script>
        function addToCart(id) {
            $.ajax({
                type: 'POST',
                url: 'php/add_to_cart.php',
                data: {
                    product_id: id
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Hiba történt a kosárhoz adás közben.');
                }
            });
        }
    </script>
</body>

</html>