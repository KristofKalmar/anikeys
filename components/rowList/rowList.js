let prevSizeNintendo = 0;

window.addEventListener('resize', () =>
{
    if (window.innerWidth >= 1280 && prevSizeNintendo !== 0)
    {
        prevSizeNintendo = 0;

        showNumberOfElements(4);
    } else if (window.innerWidth < 1280 && window.innerWidth >= 960 && prevSizeNintendo !== 1)
    {
        prevSizeNintendo = 1;

        showNumberOfElements(3);
    } else if (window.innerWidth < 960 && window.innerWidth >= 640 && prevSizeNintendo !== 2)
    {
        prevSizeNintendo = 2;

        showNumberOfElements(2);
    } else if (window.innerWidth < 640 && prevSizeNintendo !== 3)
    {
        prevSizeNintendo = 3;

        showNumberOfElements(1);
    }
});

function generateRowListItem(element)
{
    return (
        `<div class="nintendoItem" style="background-color: ${element.getAttribute('data-themeColor')}">
            <div class="nintendoImageItemContainer">
                <img class="itemImg" src="assets/avatar.jpg" />
            </div>
            <div class="nintendoDataContainer">
                <div class="nintendoTitleText">Hogwarts Legacy - Xbox One</div>
                <div class="nintendoCartButtonContainer">
                    <button class="cartButton">
                        Kosárba
                    </button>
                    <div class="price">27,490 Ft</div>
                </div>
            </div>
        </div>`
    )
}

function populateRowList(number)
{
    var replaceElements = document.querySelectorAll('[id="rowList"]');

    var finalElements = [];

    for(var i = 0; i < replaceElements.length; i++)
    {
        let element1 =
        `<div class="rowListContainer">
                <div class="rowListVerticalContainer">
                    <div class="nintendoVerticalContainer">
                        <div class="nintedoTitleContainer">
                            <object class="rowListTitleLogo" data="assets/${replaceElements[i].getAttribute('data-logo')}"></object>
                            ${replaceElements[i].getAttribute('data-title')}
                            <div class="rowListDivider"></div>
                        </div>
                        <div class="nintendoItemsContainer">`;

        let element2 = ``;


        Array.from({length: number}, (_, i) => i).forEach(() =>
           element2 = element2.concat(generateRowListItem(replaceElements[i]))
        );

        let element3 =
        `</div>
        </div>
        </div>`;

        element1 = element1.concat(element2, element3);

        finalElements.push(element1);
    }

    for(var i = 0; i < replaceElements.length; i++)
    {
        replaceElements[i].innerHTML = finalElements[i];
    }
}

$(document).ready(function()
{
    populateRowList(4);
})