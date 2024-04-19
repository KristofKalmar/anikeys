<?php
    session_start();
    include 'php/config/config.php';
    $username = $_SESSION['username'];
    $conn = getConnection();
    ini_set('display_errors', 1);

    function uuidv4()
    {
        $data = random_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    $sql_delete_cart = "DELETE FROM cart WHERE username = ?";
    $stmt_delete_cart = $conn->prepare($sql_delete_cart);
    $stmt_delete_cart->bind_param('s', $username);

    $sql_fetch_cart = "SELECT * FROM cart WHERE username = '$username'";

    $result = $conn->query($sql_fetch_cart);

    if ($result->num_rows > 0)
    {
        if ($stmt_delete_cart->execute())
        {
            $create_pproducts_table_sql = "CREATE TABLE IF NOT EXISTS purchasedProducts (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `product_id` INT NOT NULL,
                `username` varchar(255) NOT NULL,
                `added_at` datetime DEFAULT current_timestamp(),
                `code` varchar(255) NOT NULL,
                `revealed` INT NOT NULL,
                PRIMARY KEY (`id`)
            );";

            if ($conn->query($create_pproducts_table_sql) === TRUE)
            {
                while ($row = $result->fetch_assoc())
                {
                    for ($i = 0; $i < $row['quantity']; $i++)
                    {
                        $product_id = $row['product_id'];
                        $username_product = $row['username'];

                        $update_pproducts_table_sql = "INSERT INTO purchasedProducts (product_id, username, code, revealed)
                        VALUES ('$product_id', '$username_product', '".uuidv4()."', 0);
                        ";

                        if ($conn->query($update_pproducts_table_sql) === TRUE)
                        {
                        }
                    }
                }

                header("Location: profil.php");
                exit();
            } else
            {
                header("Location: index.php?error=" . urlencode("Hiba történt a kosár törlése közben: " . $conn->error));
                exit();
            }
        } else {
            header("Location: index.php?error=" . urlencode("Hiba történt a kosár törlése közben: " . $conn->error));
            exit();
        }
    } else {
        header("Location: index.php?error=" . urlencode("Hiba történt a kosár törlése közben: " . $conn->error));
        exit();
    }

    $stmt_delete_cart->close();
    $conn->close();
?>