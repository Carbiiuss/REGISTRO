import products from './products.js';
import cart from './cart.js';

let app = document.getElementById('app');
let temporaryContent = document.getElementById('temporaryContent');

// load layout file
const loadTemplate = () => {
    fetch('/template.html')
    .then(response => response.text())
    .then(html => {
        app.innerHTML = html;
        let contentTab = document.getElementById('contentTab');
        contentTab.innerHTML = temporaryContent.innerHTML;
        temporaryContent.innerHTML = null;
        cart();
        initApp();
    })
}
loadTemplate();

const initApp = () => {
    const imageSize = "100px";

    // load list product
    let listProductHTML = document.querySelector('.listProduct');
    listProductHTML.innerHTML = null;

    // Modificación: Dividir productos en categorías
    const categories = {};

    products.forEach(product => {
        if (!categories[product.category]) {
            categories[product.category] = [];
        }
        categories[product.category].push(product);
    });

    for (const category in categories) {
        let categoryContainer = document.createElement('div');
        categoryContainer.classList.add('category-container');
        categoryContainer.innerHTML = `<h2>${category}</h2>`;
        app.appendChild(categoryContainer);

        let listProductHTML = document.createElement('div');
        listProductHTML.classList.add('listProduct');
        categoryContainer.appendChild(listProductHTML);

        categories[category].forEach(product => {
            let newProduct = document.createElement('div');
            newProduct.classList.add('item');
            newProduct.innerHTML = 
            `<a href="/detail.html?id=${product.id}">
                <img src="${product.image}" style="width: ${imageSize}; height: ${imageSize}">
            </a>
            <h2>${product.name}</h2>
            <div class="price">$${product.price}</div>
            <button 
                class="addCart" 
                data-id='${product.id}'>
                    Add To Cart
            </button>`;
            listProductHTML.appendChild(newProduct);
        });
    }
}


