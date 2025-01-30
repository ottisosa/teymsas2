import productDAO from "./DAO/productDAO.js";
import categoryDAO from "./DAO/categoryDAO.js";

window.onload = () => {
obtenerCategorias();

}

let formAgregar = document.querySelector("#formAgregar");

formAgregar.onsubmit = async (e) => {

    e.preventDefault();
    let description_product = document.querySelector('#description_product').value;
    let details_product = document.querySelector('#details_product').value;
    let price_product = document.querySelector('#price_product').value;
    let thumbnail_product = "";
    // let thumbnail_product = document.querySelector('#thumbnail_product').value;
    let stock_product = document.querySelector('#stock_product').value;
    let measures_product = document.querySelector('#measures_product').value;
    let id_category = document.querySelector('#id_category').value;

    const response = await new productDAO().createProduct(description_product, details_product, price_product, thumbnail_product, stock_product, measures_product, id_category);
    alert(response.message);


}


async function obtenerCategorias(){


    let categorias = await new categoryDAO().getAll();
    let selectCategorias = document.querySelector('#id_category');

    
     categorias.data.forEach(categoria => {
        let option = document.createElement('option');
         option.value = categoria.id_category;
         option.innerText = categoria.description_category;
         selectCategorias.appendChild(option);
        
     });

}

