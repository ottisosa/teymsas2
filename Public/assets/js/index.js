// Función para cargar contenido dinámico
import productDAO from '../js/DAO/productDAO.js';
window.loadContent = function (page) {
    if (page.includes("productId=")) {
        var regex = /(\d+)/g;
        const productId = page.match(regex)
        history.pushState(null, "", `product.html?productId=${productId}`);
    } else {
        history.pushState(null, "", './');
    }

    fetch(page)
        .then(response => response.text())
        .then(data => {
            const mainContent = document.getElementById('main-content');
            mainContent.innerHTML = data;

            // Buscar y ejecutar todos los scripts dentro del contenido dinámico
            const scripts = mainContent.querySelectorAll('script[type="module"]');
            scripts.forEach(script => {
                if (script.src) {
                    const newScript = document.createElement('script');
                    newScript.type = 'module';
                    newScript.src = `${script.src}?t=${new Date().getTime()}`; // Forzar recarga

                    // Agregar el nuevo script al DOM
                    document.body.appendChild(newScript);
                }
            });
        })
        .catch(error => {
            console.error('Error cargando contenido:', error);
        });
};

import userDAO from "./DAO/userDAO.js";

window.onload = () => {
    const session = new userDAO().getSession();

    loadContent('../user/PaginaPrincipal.html');

    let searchForm = document.querySelector('.search-form');

    document.querySelector('#search-btn').onclick = () => {
        searchForm.classList.toggle('active');
        shoppingCart.classList.remove('active');
        loginForm.classList.remove('active');
        navbar.classList.remove('active');

    }

    let shoppingCart = document.querySelector('.shopping-cart');

    document.querySelector('#cart-btn').onclick = () => {
        shoppingCart.classList.toggle('active');
        searchForm.classList.remove('active');
        loginForm.classList.remove('active');
        navbar.classList.remove('active');

        getCart();
    }




    let loginForm = document.querySelector('.login-form');

    document.querySelector('#login-btn').onclick = () => {
        const session = new userDAO().getLocalSession();
        if (session) {
            loadContent('../user/usuario.html');
        } else {
            loginForm.classList.toggle('active');
            searchForm.classList.remove('active');
            shoppingCart.classList.remove('active');
            navbar.classList.remove('active');
        }
    }

    loginForm.onsubmit = async (e) => {
        e.preventDefault();
        const email = loginForm.elements['email'].value;
        const password = loginForm.elements['password'].value;
        const respuesta = await new userDAO().login(email, password);

        if (respuesta.success) {
            alert("Bienvenido.")
            location.reload()
        } else {
            alert(respuesta.message);
        }
    }

    let navbar = document.querySelector('.navbar');

    document.querySelector('#menu-btn').onclick = () => {
        navbar.classList.toggle('active');
        searchForm.classList.remove('active');
        shoppingCart.classList.remove('active');
        loginForm.classList.remove('active');
    }

}




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


window.removeFromCart = function (productId){

    let cart = JSON.parse(localStorage.getItem("cart"));

    cart = cart.filter(item => item.id !== productId);

    localStorage.setItem("cart", JSON.stringify(cart));
    alert("Producto eliminado del carrito");

    getCart();
 
}




