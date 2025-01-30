import productDAO from "./DAO/productDAO.js";
import categoryDAO from "./DAO/categoryDAO.js";

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('productId');


const response = await new productDAO().getById(productId);
const product = response.producto;

const containerProduct = document.querySelector('#container-product');

const form = document.createElement('form');
form.setAttribute('method', 'POST');
form.setAttribute('enctype', 'multipart/form-data');
form.classList.add('profile-form');


{/* <img src="./../storage/thumbnails/${product.thumbnail_product}" alt="Miniatura del producto" style="max-width: 150px; height: auto; display: block; margin-bottom: 10px;"> */}

form.innerHTML = `
        <label for="description_product">Descripción del producto:</label>
        <input type="text" id="description_product" name="description_product" value="${product.description_product}" required>

        <label for="details_product">Detalles del producto:</label>
        <input type="text" id="details_product" name="details_product" value="${product.details_product}" required>

        <label for="price_product">Precio del producto:</label>
        <input type="number" min="1" id="price_product" name="price_product" value="${product.price_product}" required>

        <label for="thumbnail_product">Miniatura del producto actual:</label>
        <div style="margin-bottom: 15px;">
            <!-- Muestra la imagen actual -->
                
            <!-- Input para cargar una nueva imagen -->
            <label for="new_thumbnail_product">Subir nueva miniatura:</label>
            <input type="file" id="new_thumbnail_product" name="new_thumbnail_product" accept="image/*">
        </div>

        <label for="stock_product">Stock del producto:</label>
        <input type="number" id="stock_product" name="stock_product" value="${product.stock_product}" required>

        <label for="measures_product">Medidas del producto:</label>
        <input type="text" id="measures_product" name="measures_product" value="${product.measures_product}" required>


                            <label for="id_category">Categoria del producto:</label>
                    <select name="id_category" id="id_category" required>  </select>


        <button type="submit" class="btn">Actualizar Datos</button>
    `;

containerProduct.appendChild(form);


form.onsubmit = async (e) => {

    e.preventDefault();

    let description_product = document.querySelector('#description_product').value;
    let details_product = document.querySelector('#details_product').value;
    let price_product = document.querySelector('#price_product').value;
    // let thumbnail_product = document.querySelector('#thumbnail_product').value;
    let stock_product = document.querySelector('#stock_product').value;
    let measures_product = document.querySelector('#measures_product').value;
    let id_category = document.querySelector('#id_category').value;

let thumbnail_product = "";


    const result = await new productDAO().UpdateProduct(description_product, details_product, price_product, thumbnail_product, stock_product, measures_product, id_category, productId);

    console.log(result);

    if (result.success) {
        alert(result.message);

        location.href = "VerProducto.html";

    } else {
        alert(result.message);
    }

};



async function obtenerCategorias() {


    let categorias = await new categoryDAO().getAll();
    let selectCategorias = document.querySelector('#id_category');


    categorias.data.forEach(categoria => {
        let option = document.createElement('option');
        option.value = categoria.id_category;
        option.innerText = categoria.description_category;
        selectCategorias.appendChild(option);

    });

}



obtenerCategorias();
