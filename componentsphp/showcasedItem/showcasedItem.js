function generateShowcasedItem()
{
    const img = "assets/avatar.jpg";
    const title = "Avatar Frontiers of Pandora (Standard edition) - PS5";
    const price = "27,490 Ft";

    return (
        `<div class="showcasedItem">
            <a href="productDetails.html" class="showcasedItemImgContainer">
                <img class="showcasedItemImg" src="${img}" />
            </a>
            <div class="showcasedItemDataContainer">
                <div class="showcasedItemTitle">${title}</div>
                <div class="showcasedItemCartButtonContainer">
                    <a class="showcasedItemCartButton">
                        Kosárba
                    </a>
                    <div class="showcasedItemPrice">${price}</div>
                </div>
            </div>
        </div>`
    )
}

function generateShowcasedItems()
{
    let element1 =
    `<div class="showcasedContainer">
            <div class="showcasedItemsListContainer">`;

    let element2 = ``;


    Array.from({length: 4}, (_, i) => i).forEach(() =>
       element2 = element2.concat(generateShowcasedItem())
    );

    let element3 =
    `</div>
    </div>`;

    element1 = element1.concat(element2, element3);

    document.getElementById('showcasedItems').innerHTML = element1;
}

$(document).ready(function()
{
    generateShowcasedItems(4);
})