const openShopping = document.querySelector(".shopping");
const closeShopping = document.querySelector(".closeShopping");
const list = document.querySelector(".list");
const listCard = document.querySelector(".listCard");
const total = document.querySelector(".total");
const body = document.querySelector("body");
const quantity = document.querySelector(".quantity");

openShopping.addEventListener("click", () => {
    body.classList.add("active");
});
closeShopping.addEventListener("click", () => {
    body.classList.remove("active");
});

let products = [
    {
        id: 1,
        name: "Hogwarts Legacy",
        images: "4.jpg",
        price: 2000
    },
    {
        id: 2,
        name: "Hogwarts Legacy",
        images: "4.jpg",
        price: 2000
    },
    {
        id: 3,
        name: "Hogwarts Legacy",
        images: "4.jpg",
        price: 2000
    },
    {
        id: 4,
        name: "Hogwarts Legacy",
        images: "4.jpg",
        price: 2000
    },
    {
        id: 5,
        name: "Hogwarts Legacy",
        images: "4.jpg",
        price: 2000
    },
    {
        id: 6,
        name: "Hogwarts Legacy",
        images: "4.jpg",
        price: 2000
    },
    {
        id: 7,
        name: "Hogwarts Legacy",
        images: "4.jpg",
        price: 2000
    },
    {
        id: 8,
        name: "Hogwarts Legacy",
        images: "4.jpg",
        price: 2000
    },
    {
        id: 9,
        name: "Hogwarts Legacy",
        images: "4.jpg",
        price: 2000
    }
];

let listCards = [];

const addToCart = (key) => {
    if (listCards[key] == null) {
        listCards[key] = JSON.parse(JSON.stringify(products[key]));
        listCards[key].quantity = 1;
    }

    reloadCard();
};

const reloadCard = () => {
    listCard.innerHTML = "";
    let count = 0;
    let totalPrice = 0;

    listCards.forEach((value, key) => {
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;

        if (value != null) {
            let newDiv = document.createElement("li");
            newDiv.innerHTML = `
                <div><img src="assets/${value.images}"></div>
                <div class="cardTitle" style="font-weight: bolder">${value.name}</div>
                <div class="cardPrice" style="font-weight: bolder">${value.price.toLocaleString()}</div>
                <div>
                    <button style="background-color: #00243D"
                    class="cardButton" onclick="changeQuantity(${key},
                    ${value.quantity - 1})">-</button>
                    <div class="count" style="font-weight: bolder">${value.quantity}</div>
                    <button style="background-color: #00243D"
                    class="cardButton" onclick="changeQuantity(${key},
                    ${value.quantity + 1})">+</button>
                </div>
            `;
            listCard.appendChild(newDiv);
        }
        total.innerText = totalPrice.toLocaleString() + " Ft";
        quantity.innerText = count;
    });
};

const changeQuantity = (key, quantity) => {
    if (quantity == 0) {
        delete listCards[key];
    } else {
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * products[key].price;
    }
    reloadCard();
};


const magnifyProduct = (productId) => {

    const product = document.querySelector(`.item[data-product-id="${productId}"]`);

    document.querySelectorAll('.item').forEach(item => {
        if (item !== product) {
            item.style.transform = 'scale(1)';
        }
    });

    product.style.transform = 'scale(1.1)';
};

const initApp = () => {
    products.forEach((value, key) => {
        let newDiv = document.createElement("div");
        newDiv.classList.add("item");
        newDiv.setAttribute("data-product-id", value.id); // Új attribútum hozzáadása az azonosítóhoz
        newDiv.innerHTML = `
            <img src="assets/${value.images}">
            <div class="title">${value.name}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCart(${key})">Kosárba helyezés</button>
        `;
        list.appendChild(newDiv);


        const productId = value.id;
        newDiv.addEventListener("mouseenter", () => {
            magnifyProduct(productId);
        });
        newDiv.addEventListener("mouseleave", () => {
            newDiv.style.transform = "scale(1)";
        });
    });
};

initApp();
