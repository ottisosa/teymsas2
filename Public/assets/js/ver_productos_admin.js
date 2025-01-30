import productDAO from "../js/DAO/productDAO.js";

window.onload = () => {
    obtainProducts();

}



async function obtainProducts() {
    const result = await new productDAO().getAll();
    showProducts(result.data);
}

async function showProducts(product) {

    let tbodyElement = document.querySelector("#mostrarProducto");
    tbodyElement.innerHTML = "";
    for (let i = 0; i < product.length; i++) {
        tbodyElement.innerHTML += `               
                <tr>
                <td>${product[i].id_product}</td>
                <td>${product[i].description_product}</td>    
                <td>${product[i].details_product}</td>
                <td>${product[i].price_product}</td>
                <td>${product[i].stock_product}</td>    
                <td>${product[i].measures_product}</td>    
                <td>${product[i].description_category}</td>    
                <td>
                    <button onclick=window.location.href="product.html?productId=${product[i].id_product}">Editar</button>
                    <button onclick="eliminarProducto(${product[i].id_product})">Eliminar</button>
                </td>   
                </tr>`;


    }



}

window.eliminarProducto = async function (id_product) {

    const result = await new productDAO().deleteProduct(id_product);

    console.log(result);

    if (result.success) {
        alert(result.message);

        obtainProducts();

    } else {
        alert(result.message);
    }


};



