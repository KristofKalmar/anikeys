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
                    <a class="showcasedItemCartButton">
                        Kosárba
                    </a>
                    <div class="showcasedItemPrice">' . $price . '</div>
                </div>
            </div>
        </div>';
}

function generateShowcasedItems($number)
{
    $element1 = '
    <div class="showcasedContainer">
        <div class="showcasedItemsListContainer">';

    $element2 = '';

    for ($i = 0; $i < $number; $i++) {
        $element2 .= generateShowcasedItem("assets/avatar.jpg", "Avatar Frontiers of Pandora (Standard edition) - PS5", "27,490 Ft");
    }

    $element3 = '
        </div>
    </div>';

    $element1 = $element1 . $element2 . $element3;

    echo $element1;
}

generateShowcasedItems(4);
?>