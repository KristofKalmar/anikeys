const addProductButton = document.getElementById('addProductButton');
const table = document.getElementById('table');

var unsavedProductsList = [];
var unsavedProductsLastIndex = 0;

const uploadButton = document.getElementById('saveProductsButton');

const deleteButtons = document.querySelectorAll('#tableDeleteButton_final');
const nameInputs = document.getElementsByName('tableInputName');
const imageURLInputs = document.getElementsByName('tableInputFile');
const descriptionInputs = document.getElementsByName('tableInputDescription');
const priceInputs = document.getElementsByName('tableInputPrice');
const saleInputs = document.getElementsByName('tableInputSale');
const categoryInputs = document.getElementsByName('tableInputCategory');

var unsavedFinalProductIndexes = [];

var deleteFinalProductsIndexes = [];

for (var dbI = 0; dbI < deleteButtons.length; ++dbI)
{
    const currentIndex = dbI;

    deleteButtons[dbI].onclick = () =>
    {
        if (deleteFinalProductsIndexes.includes(currentIndex))
        {
            const tableRow = document.getElementById(`tableRow_final_${currentIndex}`);

            tableRow.classList.toggle('isBeingDeleted');
            uploadButton.disabled = false;
            deleteFinalProductsIndexes = deleteFinalProductsIndexes.filter((index) => index != currentIndex);
        } else
        {
            const tableRow = document.getElementById(`tableRow_final_${currentIndex}`);

            deleteFinalProductsIndexes.push(currentIndex)

            tableRow.classList.toggle('isBeingDeleted');
            uploadButton.disabled = false;
        }
    }
}

for (var nI = 0; nI < nameInputs.length; ++nI)
{
    const currentIndex = nI;

    nameInputs[nI].addEventListener('input', function (event)
    {
        if (!unsavedFinalProductIndexes.includes(currentIndex))
        {
            unsavedFinalProductIndexes.push(currentIndex);
            const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
            currentRow.classList.toggle('tableRowUnSaved');
        }
        const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
        uploadButton.disabled = false;
        currentRow.classList.remove('hasError');
    })
}

for (var iuI = 0; iuI < imageURLInputs.length; ++iuI)
{
    const currentIndex = iuI;

    imageURLInputs[iuI].addEventListener('input', function (event)
    {
        if (!unsavedFinalProductIndexes.includes(currentIndex))
        {
            unsavedFinalProductIndexes.push(currentIndex);
            const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
            currentRow.classList.toggle('tableRowUnSaved');
        }
        const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
        uploadButton.disabled = false;
        currentRow.classList.remove('hasError');

        const currentImage = document.getElementById(`tableRow_final_image_${currentIndex}`);

        currentImage.src = window.URL.createObjectURL(event.target.files[0]);
    })
}

for (var dI = 0; dI < descriptionInputs.length; ++dI)
{
    const currentIndex = dI;

    descriptionInputs[dI].addEventListener('input', function (event)
    {
        if (!unsavedFinalProductIndexes.includes(currentIndex))
        {
            unsavedFinalProductIndexes.push(currentIndex);
            const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
            currentRow.classList.toggle('tableRowUnSaved');
        }
        const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
        uploadButton.disabled = false;
        currentRow.classList.remove('hasError');
    })
}

for (var pI = 0; pI < priceInputs.length; ++pI)
{
    const currentIndex = pI;

    priceInputs[pI].addEventListener('input', function (event)
    {
        if (!unsavedFinalProductIndexes.includes(currentIndex))
        {
            unsavedFinalProductIndexes.push(currentIndex);
            const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
            currentRow.classList.toggle('tableRowUnSaved');
        }
        const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
        uploadButton.disabled = false;
        currentRow.classList.remove('hasError');
    })
}

for (var sI = 0; sI < saleInputs.length; ++sI)
{
    const currentIndex = sI;

    saleInputs[sI].addEventListener('input', function (event)
    {
        if (!unsavedFinalProductIndexes.includes(currentIndex))
        {
            unsavedFinalProductIndexes.push(currentIndex);
            const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
            currentRow.classList.toggle('tableRowUnSaved');
        }
        const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
        uploadButton.disabled = false;
        currentRow.classList.remove('hasError');
    })
}

for (var cI = 0; cI < categoryInputs.length; ++cI)
{
    const currentIndex = cI;

    categoryInputs[cI].addEventListener('input', function (event)
    {
        if (!unsavedFinalProductIndexes.includes(currentIndex))
        {
            unsavedFinalProductIndexes.push(currentIndex);
            const currentRow = document.getElementById(`tableRow_final_${currentIndex}`);
            currentRow.classList.toggle('tableRowUnSaved');
        }
        uploadButton.disabled = false;
        currentRow.classList.remove('hasError');
    })
}

uploadButton.onclick = () =>
{
    unsavedFinalProductIndexes.forEach((index) =>
    {
        var formData = new FormData();

        const nameField = nameInputs[index].value;
        const imageField = imageURLInputs[index];
        const descriptionField = descriptionInputs[index].value;
        const priceField = priceInputs[index].value;
        const saleField = saleInputs[index].value;
        const categoryField = categoryInputs[index].selectedIndex;

        const tableRow = document.getElementById(`tableRow_final_${index}`);
        const id = tableRow.getAttribute("name");

        const oldImagePath = document.getElementById(`tableRow_final_image_${index}`).getAttribute('alt');

        formData.append('name', nameField);

        if (imageField.files.length > 0)
        {
            formData.append('imageURL', imageField.files[0]);
        }
        if (oldImagePath !== 'assets/placeholder.svg')
        {
            formData.append('oldImagePath', oldImagePath);
        }
        formData.append('descriptionHTML', descriptionField);
        formData.append('priceVAT', priceField);
        formData.append('sale', saleField);
        formData.append('category', categoryField);
        formData.append('id', id);

        $.ajax({
            url: 'php/updateAdminData.php',
            type: "POST",
            data: formData,
            dataType: 'text',
            cache: false,
            processData: false,
            contentType: false,
            success:function(data) {
                const tableRow = document.getElementById(`tableRow_final_${index}`);

                tableRow.classList.toggle('tableRowUnSaved');

                unsavedFinalProductIndexes = unsavedFinalProductIndexes.filter((currentIndex) => index !== currentIndex);
            },
            error: function(error)
            {
                console.log(error);

                const tableRow = document.getElementById(`tableRow_final_${index}`);

                tableRow.classList.add('errorAnimation');
                tableRow.classList.add('hasError');

                setTimeout(() => {
                    tableRow.classList.remove('errorAnimation');
                }, 500);
            }
        });
    });

    deleteFinalProductsIndexes.forEach((index) =>
    {
        var formData = new FormData();

        const tableRow = document.getElementById(`tableRow_final_${index}`);
        const id = tableRow.getAttribute("name");

        const oldImagePath = document.getElementById(`tableRow_final_image_${index}`).getAttribute('alt');

        formData.append('oldImagePath', oldImagePath === 'assets/placeholder.svg' ? '' : oldImagePath);
        formData.append('id', id);

        $.ajax({
            url: 'php/deleteAdminData.php',
            type: "POST",
            data: formData,
            dataType: 'text',
            cache: false,
            processData: false,
            contentType: false,
            success:function(data) {

                console.log(data);

                const tableRow = document.getElementById(`tableRow_final_${index}`);

                tableRow.remove();

                deleteFinalProductsIndexes = unsavedFinalProductIndexes.filter((currentIndex) => index !== currentIndex);
            },
            error: function(error)
            {
                console.log(error);

                const tableRow = document.getElementById(`tableRow_final_${index}`);

                tableRow.classList.add('errorAnimation');
                tableRow.classList.add('hasError');

                setTimeout(() => {
                    tableRow.classList.remove('errorAnimation');
                }, 500);
            }
        });
    });

    unsavedProductsList.forEach((product, currentIndex) =>
    {
        var formData = new FormData();

        formData.append('name', product.name);
        formData.append('imageURL', product.imageURL);
        formData.append('descriptionHTML', product.descriptionHTML);
        formData.append('priceVAT', product.priceVAT);
        formData.append('sale', product.sale);
        formData.append('category', product.category);

        $.ajax({
            url: 'php/createAdminData.php',
            type: "POST",
            data: formData,
            dataType: 'text',
            cache: false,
            processData: false,
            contentType: false,
            success:function(data) {
                console.log(data)
                const tableRow = document.getElementById(`tableRow_${currentIndex}`);

                tableRow.classList.toggle('tableRowUnSaved');
            },
            error: function(error)
            {
                console.log(error)
                const tableRow = document.getElementById(`tableRow_${currentIndex}`);

                tableRow.classList.add('errorAnimation');
                tableRow.classList.add('hasError');

                setTimeout(() => {
                    tableRow.classList.remove('errorAnimation');
                }, 500);
            }
        });
    })
}

addProductButton.onclick = () =>
{
    uploadButton.disabled = false;

    const currentIndex = unsavedProductsLastIndex;

    var tableRow = table.insertRow(1);

    tableRow.id = `tableRow_${currentIndex}`;
    tableRow.classList.toggle('tableRowUnSaved');

    tableRow.innerHTML =
    `
    <td>
        <input id="tableInputName_${currentIndex}" class="tableInput" placeholder="Termék neve" value="">
    </td>
    <td>
        <div class="tableCheckboxContainer">
            <img id="tableRow_img_${currentIndex}" class="indexPic" alt="Avatar" name="indexPic" src="assets/placeholder.svg" />
            <input id="tableInputFile_${currentIndex}" name="image_${currentIndex}" type="file">
        </div>
    </td>
    <td>
        <input id="tableInputDescription_${currentIndex}" class="tableInput" placeholder="Leírás... (HTML5)" value="">
    </td>
    <td>
        <div class="tableInputContainer">
            <input id="tableInputPrice_${currentIndex}" placeholder="Bruttó ár" type="number" class="tableInput tableInputPrice" value="">
            <div class="tablePriceText">
                Ft
            </div>
        </div>
    </td>
    <td>
        <div class="tableInputContainer">
            <input id="tableInputSale_${currentIndex}" placeholder="Kedvezmény (%)" type="number" class="tableInput tableInputPrice" value="">
            <div class="tablePriceText">
                %
            </div>
        </div>
    </td>
    <td><select id="tableInputCategory_${currentIndex}" class="tableInput tableInputSelect">
        <option>...</option>
        <option>PC</option>
        <option>Playstation</option>
        <option>Xbox</option>
        <option>Nintendo</option>
    </select></td>
    <td>
        <button id="tableDeleteButton_${currentIndex}" class="tableDeleteIconContainer">
            <object class="tableDeleteIcon" data="assets/delete.svg"></object>
        </button>
    </td>`;

    unsavedProductsList.push({
        name: "",
        imageURL: {},
        descriptionHTML: "",
        priceVAT: 0,
        sale: 0,
        category: 0,
    });

    document.getElementById(`tableInputName_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].name = event.target.value;

        uploadButton.disabled = false;

        tableRow.classList.remove('hasError');
    });

    document.getElementById(`tableInputFile_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].imageURL = event.target.files[0];

        document.getElementById(`tableRow_img_${currentIndex}`).src = URL.createObjectURL(event.target.files[0]);

        uploadButton.disabled = false;

        tableRow.classList.remove('hasError');
    });

    document.getElementById(`tableInputDescription_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].descriptionHTML = event.target.value;

        uploadButton.disabled = false;

        tableRow.classList.remove('hasError');
    });

    document.getElementById(`tableInputPrice_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].priceVAT = Number(event.target.value);

        uploadButton.disabled = false;

        tableRow.classList.remove('hasError');
    });

    document.getElementById(`tableInputSale_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].sale = Number(event.target.value);

        uploadButton.disabled = false;

        tableRow.classList.remove('hasError');
    });

    document.getElementById(`tableInputCategory_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].category = event.target.selectedIndex;

        uploadButton.disabled = false;

        tableRow.classList.remove('hasError');
    });

    document.getElementById(`tableDeleteButton_${currentIndex}`).onclick = () =>
    {
        unsavedProductsList = unsavedProductsList.filter((_, index) => index !== currentIndex);
        document.getElementById(`tableRow_${currentIndex}`).remove();

        if (unsavedProductsList.length <= 0)
        {
            uploadButton.disabled = true;
        }

        tableRow.classList.remove('hasError');
    };

    unsavedProductsLastIndex++;
}