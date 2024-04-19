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

                    $numItems = $result->num_rows;

                    while ($row = $result->fetch_assoc())
                    {
                        $listItemImage = $row['imageURL'];
                        $listItemName = $row['name'];
                        $listItemPrice = $row['price'];
                        $listItemSale = $row['sale'];
                        $listItemId = $row['id'];
                        $listItemDarkMode = false;

                        include 'php/components/listItem.php';
                    }

                    if ($numItems < 4)
                    {
                        $loopCount = 4 - $numItems;
                        $listItemDarkMode = false;

                        for ($i = 0; $i < $loopCount; $i++)
                        {
                            include 'php/components/listItemGhost.php';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <style>
        <?php include 'css/components/rowList.css' ?>
    </style>
</div>