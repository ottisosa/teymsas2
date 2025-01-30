import productDAO from '../js/DAO/productDAO.js';
import orderDAO from '../js/DAO/orderDAO.js';

window.onload = async () => {




    // let micaja = document.querySelector("#micaja");
    // console.log(datos.Departamentos)
    // datos.Departamentos.forEach(departamento => {
    //     micaja.innerHTML += departamento.name_department;
    // });

}
obtenerProductos();

async function obtenerProductos() {

    document.querySelector("#contenedor-carrito").innerHTML = "";


    let cart = JSON.parse(localStorage.getItem("cart"));


    if (cart && cart.length > 0) {

        cart.forEach(async item => {

            const result = await new productDAO().getById(item.id);

            if (result.success) {

                document.querySelector("#contenedor-carrito").innerHTML += `

                <div id="cart-item" class="cart-item">
                <img src="../storage/imgproductos/${result.producto.thumbnail_product}" alt="Producto" class="product-image">
                <div class="product-info">
                    <h2 class="product-title">${result.producto.description_product}</h2>
                    <div class="quantity-controls">
                        <p>Cantidad:</p>
                        <button class="btn-decrease" onclick="restarCantidad(${item.id})">-</button>
                        <span class="quantity">${item.cant}</span>
                        <button class="btn-increase"  onclick="sumarCantidad(${item.id})">+</button>
                        <button class="btn-delete" onclick="eliminarproductocarrito(${item.id})">X</button>
                    </div>
                </div>
            </div>
                 `
            }



        });


    } else {


        localStorage.removeItem('cart');

        document.querySelector("#contenedor-carrito").innerHTML += `

        <div class="carrito-container">
        <div class="mensaje">
            <h1>¡Hay un carrito que llenar!</h1>
            <p><strong>Actualmente no tenés productos en tu carrito.</strong></p>
            <a href="#"onclick="loadContent('../user/productList.html')" class="boton">Ver productos</a>
        </div>
        `
    }



}




window.eliminarproductocarrito = (productId) => {

    let cart = JSON.parse(localStorage.getItem("cart"));

    cart = cart.filter(item => item.id !== productId);

    localStorage.setItem("cart", JSON.stringify(cart));
    alert("Producto eliminado del carrito");

    obtenerProductos();
}


window.sumarCantidad = (productId) => {


    if (localStorage.getItem("cart")) {

        let cart = JSON.parse(localStorage.getItem("cart"));



        cart = cart.map(item => {
            if (item.id === productId) {
                item.cant++;
            }
            return item;
        });


        localStorage.setItem("cart", JSON.stringify(cart));

        obtenerProductos();

    } else {

        alert("Ocurrio un error inesperado");
    }


}




window.restarCantidad = (productId) => {


    if (localStorage.getItem("cart")) {

        let cart = JSON.parse(localStorage.getItem("cart"));



        cart = cart.map(item => {
            if (item.id === productId) {
                item.cant--;

                if (item.cant < 1) {



                    item.cant = 1;

                }
            }
            return item;
        });


        localStorage.setItem("cart", JSON.stringify(cart));

        obtenerProductos();

    } else {

        alert("Ocurrio un error inesperado");
    }


}


window.enviarOrden = async () => {



    let cartSend = JSON.parse(localStorage.getItem("cart"));

    let total_order = 0;

    if (cartSend && cartSend.length > 0) {

        const updatedCartSend = await Promise.all(cartSend.map(async item => {
            const result = await new productDAO().getById(item.id);

            if (result.success) {
                item.precioUnitario = result.producto.price_product;
                item.subtotal = item.precioUnitario * item.cant;
            }

            total_order += item.subtotal

            return item;
        }));



        let date_order = "";
        let id_payment_method = "";
        let id_order_status = "";

        const enviar = await new orderDAO().createOrder(date_order, total_order, id_payment_method, id_order_status, cartSend);


        if(enviar.success){

            alert("Checkout exitoso");

            localStorage.removeItem('cart');

        }
        obtenerProductos();
    }
}