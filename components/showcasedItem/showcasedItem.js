function generateItem()
{
    return (
        `<div class="showcasedItem">
            <div class="itemImgContainer">
                <img class="itemImg" src="assets/game1.webp" />
            </div>
            <div class="dataContainer">
                <div class="shadow"></div>
                <div class="titleText">Hogwarts Legacy - Xbox One</div>
                <div class="cartButtonContainer">
                    <button class="cartButton">
                        Kosárba
                    </button>
                    <div class="price">27,490 Ft</div>
                </div>
            </div>
        </div>`
    )
}

$(document).ready(function()
{
    const element =
    `<div class="showcasedContainer">
            <div class="showcasedItemsListContainer">
            ${generateItem()}
            ${generateItem()}
            ${generateItem()}
            ${generateItem()}
        </div>
    </div>`;

    $("#showcasedItems").replaceWith(element);
})