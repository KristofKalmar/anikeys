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
    const img = "assets/avatar.jpg";
    const title = "Avatar Frontiers of Pandora (Standard edition) - PS5";
    const price = "27,490 Ft";

    return (
        `<div class="rowListItem" style="background-color: ${element.getAttribute('data-themeColor')}">
            <div class="rowListItemImageContainer">
                <img class="rowListItemImg" src="${img}" />
            </div>
            <div class="rowListItemDataContainer">
                <div class="rowListItemTitle">${title}</div>
                <div class="rowListItemCartButtonContainer">
                    <button class="rowListItemCartButton">
                        Kosárba
                    </button>
                    <div class="rowListItemPrice">${price}</div>
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
                    <div class="contentVerticalContainer">
                        <div class="contentTitleContainer">
                            <object class="rowListTitleLogo" data="assets/${replaceElements[i].getAttribute('data-logo')}"></object>
                            ${replaceElements[i].getAttribute('data-title')}
                            <div class="rowListDivider"></div>
                        </div>
                        <div class="contentItemsContainer">`;

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