
import orderDAO from "./DAO/orderDAO.js";
window.onload = () => {
    obtainOrders();

}



async function obtainOrders() {
    const result = await new orderDAO().getAll();
    showOrders(result.Purchase);
}

async function showOrders(order) {

    let tbodyElement = document.querySelector("#mostrarorder");
    tbodyElement.innerHTML = "";
    for (let i = 0; i < product.length; i++) {
        tbodyElement.innerHTML += `               
                <tr>
                <td>${order[i].id_product}</td>
                <td>${order[i].description_product}</td>    
                <td>${order[i].details_product}</td>
                <td>${order[i].price_product}</td>
                <td>${order[i].stock_product}</td>    
                <td>${order[i].measures_product}</td>    
                <td>${order[i].description_category}</td>    
                <td>
                    
                </td>   
                </tr>`;


    }



}

window.denegarPedido = async function (id_product) {

    const result = await new productDAO().denegarProduct(id_product);

    console.log(result);

    if (result.success) {
        alert(result.message);

        obtainPurchase();

    } else {
        alert(result.message);
    }


};