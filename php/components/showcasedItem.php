<div class="showcasedContainer">
    <div class="showcasedItemsListContainer">
        <?php

            function generateShowcasedItem($img, $title, $price)
            {
                return '
                    <div class="showcasedItem">
                        <a href="productDetails.html" class="showcasedItemImgContainer">
                            <img class="showcasedItemImg" src="' . $img . '" />
                        </a>
                        <div class="showcasedItemDataContainer">
                            <div class="showcasedItemTitle">' . $title . '</div>
                            <div class="showcasedItemCartButtonContainer">
                            <button class="showcasedItemCartButton" onclick="addToCart(\'' . $title . '\', \'' . $price . '\')">  
                            Kosárba
                            </button>
                                <div class="showcasedItemPrice">' . $price . '</div>
                            </div>
                        </div>
                    </div>';
            }

            for ($i = 0; $i < 4; $i++) {
                echo generateShowcasedItem("assets/avatar.jpg", "Avatar Frontiers of Pandora (Standard edition) - PS5", "27490 Ft");
            }

        ?>
    </div>
    <style>
        <?php include 'css/components/showcasedItem.css' ?>
    </style>
</div>