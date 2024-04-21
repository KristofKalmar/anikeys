<?php
    if (!isset($_SESSION['username']))
    {
        session_start();
    }

    ini_set('display_errors', 1);
    include 'php/config/config.php';

    $conn = getConnection();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="img/pngwing.com.png">
      <meta name="theme-color" content="#00243D">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" href="css/cart.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Kosár</title>
</head>
<script>
        function completePurchase() {
            $.ajax({
                type: 'POST',
                url: 'complete_purchase.php',
                success: function(response) {
                    //alert('Sikeresen vásároltál! Hamarosan felvesszük Önnel a kapcsolatot!');
                    //removeFromCart();
                    window.location.href = 'profil.php#purchased-products';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Hiba történt a fizetés közben.');
                 }
            });
        }

        function removeFromCart(productId) {
                $.ajax({
                    type: 'POST',
                    url: 'remove_from_cart.php',
                    data: { id: productId },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Hiba történt a termék eltávolítása közben.');
                    }
                });
            }

        function decreaseQuantity(productId) {
                $.ajax({
                    type: 'POST',
                    url: 'decrease_quantity.php',
                    data: { id: productId },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Hiba történt a darabszám csökkentése közben.');
                    }
                });
            }

        function increaseQuantity(productId) {
                $.ajax({
                    type: 'POST',
                    url: 'increase_quantity.php',
                    data: { id: productId },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Hiba történt a darabszám növelése közben.');
                    }
                });
            }
</script>
<body>
    <?php include 'php/components/header.php'; ?>
    <div class="cardContainer">
        <div class="card">
            <div class="cardTitleContainer">
                <h1>Kosár</h1>
                <div class="cardTitleDivider"></div>
            </div>
            <div class="tableContainer">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Név</th>
                            <th>Bruttó ár</th>
                            <th>Mennyiség</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $username = $_SESSION['username'];

                        $create_cart_table_sql = "CREATE TABLE IF NOT EXISTS cart (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `product_id` INT NOT NULL,
                            `quantity` INT NOT NULL,
                            `username` varchar(255) NOT NULL,
                            `added_at` datetime DEFAULT current_timestamp(),
                            PRIMARY KEY (`id`)
                          );";

                        if ($conn->query($create_cart_table_sql) === TRUE)
                        {
                            $sql = "SELECT cart.*, cart.id AS id_cart, products.*
                                FROM cart
                                INNER JOIN products ON cart.product_id = products.id
                                WHERE cart.username = '$username'";
                            $result = $conn->query($sql);

                            $totalPrice = 0;

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc())
                                {
                                    $totalPrice += ($row['price'] * (1 - ($row['sale']) / 100)) * $row['quantity'];
                        ?>
                                    <tr>
                                    <td><img class='tableImg' alt='Avatar' src="<?php if($row['imageURL'] !== ""){ echo $row['imageURL'];} else {echo 'assets/placeholder_large.svg';} ?>" /></td>
                                    <td><div><?php echo $row['name'] ?></div></td>
                                    <td><div><?php echo number_format(($row['price'] * $row['quantity'] * (1 - ($row['sale']) / 100)), 0, ',', ' ')?> Ft</div></td>
                                    <td><div><button onclick="decreaseQuantity(<?php echo $row['id_cart'] ?>)">-</button><?php echo $row['quantity'] ?><button onclick="increaseQuantity(<?php echo $row['id_cart'] ?>)">+</button></div></td>
                                    <td><div><button class='deleteButton' onclick="removeFromCart(<?php echo $row['id_cart'] ?>)"><img class="deleteCartIcon" src="assets/delete_dark.svg" /></button></div></td>
                                    </tr>
                                    <tr class="separator"></tr>
                        <?php
                                }
                            } else {
                                ?><script>window.location.href = 'index.php';</script><?php
                            }

                            $conn->close();
                        } else
                        {
                            echo "Error creating table: " . $conn->error . "<br>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="buttonsContainer">
                <div class="finalPrice">
                    Végösszeg: <?php echo number_format($totalPrice, 0, ',', ' '); ?> Ft
                </div>
                <?php
                    echo "<button class='payButton' onclick=\"completePurchase();\">Fizetés</button>";
                ?>
            </div>
        </div>
    </div>
    <?php include 'php/components/deals.php'; ?>
    <?php include 'php/components/footer.php'; ?>
</body>
</html>