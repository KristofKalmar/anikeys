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
const CPUInputs = document.getElementsByName('tableInputCPU');
const GPUInputs = document.getElementsByName('tableInputGPU');
const MEMORYInputs = document.getElementsByName('tableInputMEMORY');
const OPSYSTEMInputs = document.getElementsByName('tableInputOPSYSTEM');
const STORAGEInputs = document.getElementsByName('tableInputSTORAGE');
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

for (var CPUI = 0; CPUI < CPUInputs.length; ++CPUI)
{
    const currentIndex = CPUI;

    CPUInputs[CPUI].addEventListener('input', function (event)
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

for (var GPUI = 0; GPUI < GPUInputs.length; ++GPUI)
{
    const currentIndex = GPUI;

    GPUInputs[GPUI].addEventListener('input', function (event)
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

for (var MEMORYI = 0; MEMORYI < MEMORYInputs.length; ++MEMORYI)
{
    const currentIndex = MEMORYI;

    MEMORYInputs[MEMORYI].addEventListener('input', function (event)
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

for (var OPSYSTEMI = 0; OPSYSTEMI < OPSYSTEMInputs.length; ++OPSYSTEMI)
{
    const currentIndex = OPSYSTEMI;

    OPSYSTEMInputs[OPSYSTEMI].addEventListener('input', function (event)
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

for (var STORAGEI = 0; STORAGEI < STORAGEInputs.length; ++STORAGEI)
{
    const currentIndex = STORAGEI;

    STORAGEInputs[STORAGEI].addEventListener('input', function (event)
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
        const CPUField = CPUInputs[index].selectedIndex;
        const GPUField = GPUInputs[index].selectedIndex;
        const MEMORYField = MEMORYInputs[index].selectedIndex;
        const OPSYSTEMField = OPSYSTEMInputs[index].selectedIndex;
        const STORAGEField = STORAGEInputs[index].value;
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
        formData.append('CPU', CPUField);
        formData.append('GPU', GPUField);
        formData.append('MEMORY', MEMORYField);
        formData.append('OPSYSTEM', OPSYSTEMField);
        formData.append('STORAGE', STORAGEField);
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
        formData.append('CPU', product.CPU);
        formData.append('GPU', product.GPU);
        formData.append('MEMORY', product.MEMORY);
        formData.append('OPSYSTEM', product.OPSYSTEM);
        formData.append('STORAGE', product.STORAGE);
        formData.append('category', product.category);

        console.log(product);

        $.ajax({
            url: 'php/createAdminData.php',
            type: "POST",
            data: formData,
            dataType: 'text',
            cache: false,
            processData: false,
            contentType: false,
            success:function(data)
            {
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
    <td><select id="tableInputCPU_${currentIndex}" class="tableInput tableInputSelect">
        <option>...</option>
        <option>i3</option>
        <option>i5</option>
        <option>i7</option>
        <option>i9</option>
    </select></td>
    <td><select id="tableInputGPU_${currentIndex}" class="tableInput tableInputSelect">
        <option>...</option>
        <option>Nvidia GeForce RTX 3050</option>
        <option>Nvidia GeForce RTX 3060</option>
        <option>Nvidia GeForce RTX 3070</option>
        <option>Nvidia GeForce RTX 3080</option>
        <option>Nvidia GeForce RTX 3090</option>
        <option>Nvidia GeForce RTX 4060</option>
        <option>Nvidia GeForce RTX 4070</option>
        <option>Nvidia GeForce RTX 4080</option>
        <option>Nvidia GeForce RTX 4090</option>
    </select></td>
    <td><select id="tableInputMEMORY_${currentIndex}" class="tableInput tableInputSelect">
        <option>...</option>
        <option>2 GB</option>
        <option>4 GB</option>
        <option>8 GB</option>
        <option>16 GB</option>
        <option>32 GB</option>
        <option>64 GB</option>
    </select></td>
    <td><select id="tableInputOPSYSTEM_${currentIndex}" class="tableInput tableInputSelect">
        <option>...</option>
        <option>Windows 7 (64bit)</option>
        <option>Windows 10 (64bit)</option>
        <option>Windows 11 (64bit)</option>
    </select></td>
    <td>
        <div class="tableInputContainer">
            <input id="tableInputSTORAGE_${currentIndex}" placeholder="Minimum tárhely (GB)" type="number" class="tableInput tableInputPrice" value="">
            <div class="tablePriceText">
                GB
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

    document.getElementById(`tableInputCPU_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].CPU = event.target.selectedIndex;

        uploadButton.disabled = false;

        tableRow.classList.remove('hasError');
    });

    document.getElementById(`tableInputGPU_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].GPU = event.target.selectedIndex;

        uploadButton.disabled = false;

        tableRow.classList.remove('hasError');
    });

    document.getElementById(`tableInputMEMORY_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].MEMORY = event.target.selectedIndex;

        uploadButton.disabled = false;

        tableRow.classList.remove('hasError');
    });

    document.getElementById(`tableInputOPSYSTEM_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].OPSYSTEM = event.target.selectedIndex;

        uploadButton.disabled = false;

        tableRow.classList.remove('hasError');
    });

    document.getElementById(`tableInputSTORAGE_${currentIndex}`).addEventListener('input', event =>
    {
        unsavedProductsList[currentIndex].STORAGE = Number(event.target.value);

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