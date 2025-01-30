import productDAO from  './DAO/productDAO.js';

const result = await new productDAO().getAll();

const arrayProducts = result.data;

const containerProducts = document.querySelector('#container-products');

arrayProducts.forEach(product => {
    containerProducts.innerHTML += `
                    <div class="producto">
                    <img class="imgProducto" src="../storage/imgproductos/${product.thumbnail_product}" alt="">
                    <div class="info">
                <h2 class="title">${product.description_product}</h2>
                <p class="price">U$S ${product.price_product}</p>
                    <a href="#" onclick='loadContent("../user/product.html?productId=${product.id_product}")';>Ver Producto</a>
            </div>
            </div>
    `;
});

