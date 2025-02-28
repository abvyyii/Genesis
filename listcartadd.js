let listProductHTML = document.getElementById('listProduct');
let products = [];
let cart = [];
let cartTab = document.getElementById('Cart');
let listCartHTML = document.querySelector('.listcart');
let iconCartSpan = document.querySelector('.icons span');

const addDataToHTML = () => {
    listProductHTML.innerHTML = '';
    if (products.length > 0) {
        products.forEach(product => {
            let newProduct = document.createElement('div');
            newProduct.classList.add('item');
            newProduct.dataset.id = product.id;
            newProduct.innerHTML = `
                <img src="${product.image}" alt="">
                <h3>${product.name}</h3>
                <p class="price">Rs.${product.price}</p>
                <button class="addCart">Add to Cart</button>
            `;
            listProductHTML.appendChild(newProduct);
        });
    }
};

listProductHTML.addEventListener('click', (event) => {
    let positionClick = event.target;
    if (positionClick.classList.contains('addCart')) {
        let product_id = positionClick.parentElement.dataset.id;
        addToCart(product_id);
    }
});

const addToCart = (product_id) => {
    let positionThisProductInCart = cart.findIndex(value => value.product_id == product_id);
    if (cart.length <= 0) {
        cart = [{ product_id: product_id, quantity: 1 }];
    } else if (positionThisProductInCart < 0) {
        cart.push({ product_id: product_id, quantity: 1 });
    } else {
        cart[positionThisProductInCart].quantity += 1;
    }
    addCartToHTML();
    addCartToMemory();
};

const addCartToMemory = () => {
    localStorage.setItem('cart', JSON.stringify(cart));
};

const loadCartFromMemory = () => {
    let storedCart = localStorage.getItem('cart');
    if (storedCart) {
        cart = JSON.parse(storedCart);
        addCartToHTML();
    }
};

const addCartToHTML = () => {
    listCartHTML.innerHTML = '';
    let totalQuantity = 0;

    if (cart.length > 0) {
        cart.forEach(item => {
            totalQuantity += item.quantity;
            let newItem = document.createElement('div');
            newItem.classList.add('item');
            newItem.dataset.id = item.product_id;

            let positionProduct = products.findIndex(value => value.id == item.product_id);
            let info = products[positionProduct];

            newItem.innerHTML = `
                <div class="image">
                    <img src="${info.image}" alt="${info.name}">
                </div>
                <div class="name">${info.name}</div>
                <div class="totalPrice">Rs.${info.price * item.quantity}</div>
                <div class="quantity">
                    <span class="minus">-</span>
                    <span class="qty">${item.quantity}</span>
                    <span class="plus">+</span>
                </div>
            `;
            listCartHTML.appendChild(newItem);
        });
    }

    iconCartSpan.innerText = totalQuantity;
};

listCartHTML.addEventListener('click', (event) => {
    let positionClick = event.target;
    if (positionClick.classList.contains('minus') || positionClick.classList.contains('plus')) {
        let itemElement = positionClick.closest('.item');
        if (!itemElement) return;
        let product_id = itemElement.dataset.id;
        let type = positionClick.classList.contains('plus') ? 'plus' : 'minus';
        changeQuantityCart(product_id, type);
    }
});

const changeQuantityCart = (product_id, type) => {
    let positionItemInCart = cart.findIndex(value => value.product_id == product_id);
    if (positionItemInCart >= 0) {
        if (type === 'plus') {
            cart[positionItemInCart].quantity += 1;
        } else {
            let newQuantity = cart[positionItemInCart].quantity - 1;
            if (newQuantity > 0) {
                cart[positionItemInCart].quantity = newQuantity;
            } else {
                cart.splice(positionItemInCart, 1);
            }
        }
    }
    addCartToHTML();
    addCartToMemory();
};

const initApp = () => {
    fetch("product.json")
        .then(response => response.json())
        .then(data => {
            products = data;
            addDataToHTML();
            loadCartFromMemory();
        });
};

initApp();
