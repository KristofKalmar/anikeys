<?php

    ini_set('display_errors', 1);
    include 'php/config/config.php';
    $conn = getConnection();

    // SQL query to check if the products table exists
    $table_exists_sql = "SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'products'";
    $table_exists_result = $conn->query($table_exists_sql);

    if ($table_exists_result && $table_exists_result->num_rows > 0)
    {
    // SQL query to retrieve the most recent product
    $sql = "SELECT * FROM products
    ORDER BY creationDate DESC
    LIMIT 4;";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0)
    {
        // Create an empty array to store products
        $products = array();
    } else
    {
    }
    } else
    {
    }

    $conn->close();

?>

<div class="showcasedContainer">
    <div class="showcasedItemsListContainer">
    <?php

            $numItems = $result->num_rows;

            while($row = $result->fetch_assoc())
            {
                $listItemImage = $row['imageURL'];
                $listItemName = $row['name'];
                $listItemPrice = $row['price'];
                $listItemSale = $row['sale'];
                $listItemId = $row['id'];
                $listItemDarkMode = true;

                include 'php/components/listItem.php';
            }

            if ($numItems < 4)
            {
                $loopCount = 4 - $numItems;
                $listItemDarkMode = true;

                for ($i = 0; $i < $loopCount; $i++)
                {
                    include 'php/components/listItemGhost.php';
                }
            }

    ?>
    </div>
    <style>
        <?php include 'css/components/showcasedItem.css' ?>
    </style>
</div>