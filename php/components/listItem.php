<div class="rowListItem <?php if ($listItemDarkMode == true) {
                            echo "rowListItemDarkMode";
                        } ?>">
    <a href="productDetails.php?id=<?php echo $listItemId ?>" class="rowListItemImageContainer">
        <img class="rowListItemImg" src="<?php if ($listItemImage !== "") {
                                                echo $listItemImage;
                                            } else {
                                                echo "assets/placeholder_large.svg";
                                            } ?>" />
                                            <?php
        if (isset($_SESSION['username']) && (
            ($user->CPU > 0 && $product->CPU > 0 && $user->CPU < $product->CPU) ||
            ($user->GPU > 0 && $product->GPU > 0 && $user->GPU < $product->GPU) ||
            ($user->MEMORY > 0 && $product->MEMORY > 0 && $user->MEMORY < $product->MEMORY) ||
            ($user->OPSYSTEM > 0 && $product->OPSYSTEM > 0 && $user->OPSYSTEM < $product->OPSYSTEM)
        )) {
        ?><div class="rowListWarning">Figyelem! A megadott specifikációkkal nem fog futni a játék a gépeden!</div><?php
    }
    ?>
    </a>
    <div class="rowListItemSale <?php if ($listItemSale <= 0) {
                                    echo "hidden";
                                } ?>">-<?php echo $listItemSale ?>%</div>
    <div class="rowListItemDataContainer">
        <div class="rowListItemTitle"><?php echo $listItemName ?></div>
        <div class="rowListItemCartButtonContainer">
            <a href="javascript:addToCart(<?php echo "$listItemId" ?>)" class="rowListItemCartButton">
                Kosárba
            </a>
            <div class="rowListItemPrice"><?php echo number_format(($listItemPrice * (1 - ($listItemSale) / 100)), 0, ',', ' ') ?> Ft</div>
        </div>
    </div>
    <script>
        function addToCart(id) {
            $.ajax({
                type: 'POST',
                url: 'php/add_to_cart.php',
                data: {
                    product_id: id
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Hiba történt a kosárhoz adás közben.');
                }
            });
        }
    </script>
</div>