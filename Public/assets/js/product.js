
window.onload = () => {

}
import productDAO from "./DAO/productDAO.js";
const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('productId');


const response = await new productDAO().getById(productId);
const product = response.producto;



// Mostrar los detalles del producto en la página
const producto = document.querySelector('#producto');

producto.innerHTML = `
     <div class="doblecolumna">
        <div class="imgproducto">
            <img src="../storage/imgproductos/${product.thumbnail_product}" class="product-image">
        </div>

        <div class="contenidoproducto" id="container-product">
            
            <h2 class="product-title">${product.description_product}</h2>
           <p class="product-description">${product.details_product} 
            </p>
            <p class="product-medidas">${product.measures_product}</p>
            <p class="product-price">Precio $:${product.price_product}</p>
            <p class="product-stock">Stock:${product.stock_product}</p>
        </div>
       
    </div>
    `;


let cart = [];

const addToCartbuton = document.querySelector('#add-to-cart');
addToCartbuton.onclick = (evento) => {
    evento.preventDefault();
    let cantidad = document.querySelector("#cantidadProducto").value;
    if (cantidad >= 1) {
        if (localStorage.getItem("cart")) {

            cart = JSON.parse(localStorage.getItem("cart"));

            let productSelected = {
                id: product.id_product,
                cant: parseInt(cantidad)
            }


            let productExists = false;

            cart = cart.map(item => {
                if (item.id === productSelected.id) {
                    item.cant += productSelected.cant;
                    productExists = true;
                }
                return item;
            });

            if (!productExists) {
                cart.push(productSelected);
            }


            localStorage.setItem("cart", JSON.stringify(cart));
            alert("Producto agregado al carrito");

        } else {
            let productSelected = {
                id: product.id_product,
                cant: parseInt(cantidad)
            }

            cart.push(productSelected);
            localStorage.setItem("cart", JSON.stringify(cart));
            alert("Producto agregado al carrito");
        }

    }
    else {
        alert("agregar una cantidad al producto")
    }
getCart();
};




async function getCart() {

    document.querySelector("#cart").innerHTML = "";

    let cart = JSON.parse(localStorage.getItem("cart"));
    let total = 0;
    if (cart != null) {
       

       await Promise.all(cart.map(async item => {

            const result = await new productDAO().getById(item.id);

            if (result.success) {


                document.querySelector("#cart").innerHTML += `

                <div class="box">
                <span class="material-symbols-outlined" onclick=removeFromCart(${result.producto.id_product})>
                delete
                </span>
                <img src="../storage/imgproductos/Pro1.png" alt="">
                <div class="box-content">
                <h3>${result.producto.description_product}</h3>
                <span class="price">$ ${result.producto.price_product}</span>
                <span class="quantity">cant : ${item.cant}</span>
                </div>
                </div>
                 `
            }


            total += parseInt(result.producto.price_product) * item.cant;

        }));
        document.querySelector("#total").innerText = total;


    } else {
        document.querySelector("#total").innerText = 0;
    }


}
