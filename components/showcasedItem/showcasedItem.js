let prevSize = 0;

window.addEventListener('resize', () =>
{
    if (window.innerWidth >= 1280 && prevSize !== 0)
    {
        prevSize = 0;

        showNumberOfElements(4);
    } else if (window.innerWidth < 1280 && window.innerWidth >= 960 && prevSize !== 1)
    {
        prevSize = 1;

        showNumberOfElements(3);
    } else if (window.innerWidth < 960 && window.innerWidth >= 640 && prevSize !== 2)
    {
        prevSize = 2;

        showNumberOfElements(2);
    } else if (window.innerWidth < 640 && prevSize !== 3)
    {
        prevSize = 3;

        showNumberOfElements(1);
    }
});

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

function showNumberOfElements(number)
{
    let element1 =
    `<div class="showcasedContainer">
            <div class="showcasedItemsListContainer">`;

    let element2 = ``;


    Array.from({length: number}, (_, i) => i).forEach(() =>
       element2 = element2.concat(generateItem())
    );

    let element3 =
    `</div>
    </div>`;

    element1 = element1.concat(element2, element3);

    document.getElementById('showcasedItems').innerHTML = element1;
}

$(document).ready(function()
{
    showNumberOfElements(4);
})