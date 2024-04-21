<div class="rowListContainer <?php if ($rowListHideTitleBar == true) { echo "rowListHideTitleBar"; } ?> <?php if($multiLine == true) {echo "rowList_multiLine";} ?>">
    <div class="rowListVerticalContainer">
        <div class="contentVerticalContainer">
            <div class="contentTitleContainer">
                <object class="rowListTitleLogo" data="<?php echo $rowListImage ?>"></object>
                <?php echo $titleText ?>
                <div class="rowListDivider"></div>
            </div>
            <div class="contentItemsContainer">
                <?php

                    $numItems = isset($result_rowList) ? $result_rowList->num_rows : 0;

                    while ($row = isset($result_rowList) ? $result_rowList->fetch_assoc() : NULL)
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
</div>