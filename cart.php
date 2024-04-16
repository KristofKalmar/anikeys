<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="img/pngwing.com.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="./componentsphp/header/header.css">
    <link rel="stylesheet" href="./componentsphp/footer/footer.css">
    <link rel="stylesheet" href="./componentsphp/rowList/rowList.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Kosár</title>
</head>
<script>
    function removeFromCart(productId = null) {
            $.ajax({
                type: 'POST',
                url: 'remove_from_cart.php',
                data: { id: productId },
                success: function(response) {
                    // Frissítsd a kosár tartalmát
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
    function completePurchase() {
            $.ajax({
                type: 'POST',
                url: 'complete_purchase.php', 
                success: function(response) {
                    removeFromCart();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Hiba történt a fizetés közben.');
                 }
            });
        }    
</script>
<body>
<?php include './componentsphp/header/header.php'; ?>
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
                            <th>Műveletek</th> 
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        include_once 'config.php';
                        $conn = getConnection();

                        $sql = "SELECT * FROM cart";
                        $result = $conn->query($sql);

                        $totalPrice = 0;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><img class='tableImg' alt='Avatar' src='assets/avatar.jpg' /></td>";
                                echo "<td><div>" . $row['name'] . "</div></td>";
                                echo "<td><div>" . $row['price'] * $row['quantity'] . " Ft</div></td>";
                                echo "<td><div><button onclick='decreaseQuantity(" . $row['id'] . ")'>-</button>" . $row['quantity'] . "<button onclick='increaseQuantity(" . $row['id'] . ")'>+</button></div></td>"; 
                                echo "<td><div><button onclick='removeFromCart(" . $row['id'] . ")'>Törlés</button></div></td>"; 
                                echo "</tr>";

                                $totalPrice += $row['price'] * $row['quantity'];
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nincs elem a kosárban.</td></tr>";
                        }

                    $conn->close(); 
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="buttonsContainer">
                <div class="finalPrice">
                    Végösszeg: <?php echo number_format($totalPrice, 0, ',', ' '); ?> Ft 
                </div>
                <button class="payButton" onclick="completePurchase(); alert('Sikeres fizetés, hamarosan felvesszük Önnel a kapcsolatot! By AniKeys')">
                    Fizetés
                </button>
            </div>
        </div>
    </div>
    <?php include './componentsphp/rowList/rowList.php'; ?>
    <div data-title="Kiemelt ajánlatok" data-logo="sale.svg" id="rowList"></div>
    <?php include './componentsphp/footer/footer.php'; ?>
</body>
</html>