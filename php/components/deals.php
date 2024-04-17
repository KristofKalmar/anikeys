<?php

    ini_set('display_errors', 1);

    $conn = getConnection();

    // SQL query to check if the products table exists
    $table_exists_sql = "SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'products'";
    $table_exists_result = $conn->query($table_exists_sql);

    if ($table_exists_result && $table_exists_result->num_rows > 0)
    {
    // SQL query to retrieve the most recent product
    $sql = "SELECT * FROM products
    WHERE sale > 0
    ORDER BY sale DESC
    LIMIT 4;";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0)
    {
        // Create an empty array to store products
        $products = array();
    } else
    {
        echo "No product found.";
    }
    } else
    {
    echo "Table 'products' does not exist.";
    }

    $conn->close();

?>

<div class="rowListContainer">
    <div class="rowListVerticalContainer">
        <div class="contentVerticalContainer">
            <div class="contentTitleContainer">
                <object class="rowListTitleLogo" data="assets/sale.svg"></object>
                Kiemelt ajánlatok
                <div class="rowListDivider"></div>
            </div>
            <div class="contentItemsContainer">
                <?php
                    while ($row = $result->fetch_assoc())
                    {
                        $listItemImage = $row['imageURL'];
                        $listItemName = $row['name'];
                        $listItemPrice = $row['price'];
                        $listItemSale = $row['sale'];
                        $listItemId = $row['id'];

                        include 'php/components/listItem.php';
                    }
                ?>
            </div>
        </div>
    </div>
    <style>
        <?php include 'css/components/rowList.css' ?>
    </style>
</div>