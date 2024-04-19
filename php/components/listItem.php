<div class="rowListItem <?php if ($listItemDarkMode == true) {echo "rowListItemDarkMode";} ?>">
    <a href="productDetails.php?id=<?php echo $listItemId ?>" class="rowListItemImageContainer">
        <img class="rowListItemImg" src="<?php if($listItemImage !== ""){ echo $listItemImage;} else {echo "assets/placeholder_large.svg";} ?>" />
    </a>
    <div class="rowListItemSale">-<?php echo $listItemSale ?>%</div>
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
        function addToCart(id)
        {
            $.ajax({
                type: 'POST',
                url: 'add_to_cart.php',
                data: { product_id: id },
                success: function(response)
                {
                    location.reload();
                },
                error: function(xhr, status, error)
                {
                    console.error(xhr.responseText);
                    alert('Hiba történt a kosárhoz adás közben.');
                }
            });
        }
    </script>
</div>