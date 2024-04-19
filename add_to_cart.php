<?php

if (!isset($_SESSION['username']))
{
    session_start();
}

if(isset($_SESSION['username']) && isset($_POST['product_id'])) {
    include 'php/config/config.php';
    $conn3 = getConnection();

    $name = mysqli_real_escape_string($conn3, $_POST['name']);
    $product_id = mysqli_real_escape_string($conn3, $_POST['product_id']);
    $username = $_SESSION['username'];

    $create_cart_table_sql = "CREATE TABLE IF NOT EXISTS cart (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `product_id` INT NOT NULL,
        `quantity` INT NOT NULL,
        `username` varchar(255) NOT NULL,
        `added_at` datetime DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
      );";

    if ($conn3->query($create_cart_table_sql) === TRUE)
    {
        $sql_check_pair = "SELECT COUNT(*) as pair_exists
                    FROM cart
                    WHERE product_id = ? AND username = ?";
        $stmt3 = $conn3->prepare($sql_check_pair);
        $stmt3->bind_param("is", $product_id, $username);
        $stmt3->execute();
        $result_asd = $stmt3->get_result();
        $row321 = $result_asd->fetch_assoc();
        $pair_exists = $row321['pair_exists'];

        if ($pair_exists > 0)
        {
            $sql_increment_quantity = "UPDATE cart
            SET quantity = quantity + 1
            WHERE product_id = '$product_id' AND username = '$username';
            ";

            if ($conn3->query($sql_increment_quantity) === TRUE)
            {
                echo '';
            } else
            {
                echo "Hiba történt a kosárhoz adás közben: " . $conn3->error;
            }
        } else
        {
            $sql_insert_new_entry = "INSERT INTO cart (product_id, quantity, username)
                                VALUES ('$product_id', 1, '$username');";

            if ($conn3->query($sql_insert_new_entry) === TRUE)
            {
                echo 'dsa';
            } else
            {
                echo "Hiba történt a kosárhoz adás közben: " . $conn3->error;
            }
        }
    } else
    {
        echo "Error creating table: " . $conn3->error . "<br>";
    }

    $conn3->close();
} else {
    echo "Hiányzó adatok a kosárhoz adáshoz vagy a felhasználó nincs bejelentkezve.";
}
?>