import productDAO from "./DAO/productDAO.js";

const productos = await new productDAO().getAll();

const containerProducts = document.querySelector('#container-products');
const containerProducts2 = document.querySelector('#container-products2');

if (containerProducts) {
    productos.data.forEach(product => {
        containerProducts.innerHTML += `
                <div class="producto">
                <img class="imgProducto" src="../storage/imgproductos/${product.thumbnail_product}" alt="">
                <div class="info">
                    <h2 class="title">${product.description_product}</h2>
                    <p class="price">U$S ${product.price_product}</p>
                    <a href="#" onclick='loadContent("../user/product.html?productId=${product.id_product}")';>Ver Producto</a>
                </div>
                </div>
        `
    });
}
if (containerProducts2) {

    productos.data.forEach(product => {
        containerProducts2.innerHTML += `
                <div class="producto">
                <img class="imgProducto" src="../storage/imgproductos/${product.thumbnail_product}" alt="">
                <div class="info">
                    <h2 class="title">${product.description_product}</h2>
                    <p class="price">U$S ${product.price_product}</p>
                    <a href="#" onclick='loadContent("../user/product.html?productId=${product.id_product}")';>Ver Producto</a>
                </div>
                </div>
        `
    });
}