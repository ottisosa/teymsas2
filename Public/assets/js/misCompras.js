import orderDAO from "../js/DAO/orderDAO.js";

window.obtainOrders = async () => {

    const result = await new orderDAO().getByCustomer();
    showOrders(result.Orden);
   // console.log("hola");
    
}
window.showOrders = async (order) => {

    let tbodyElement = document.querySelector("#mostrarCompras");
    console.log(order);
    tbodyElement.innerHTML = "";
    for (let i = 0; i < order.length; i++){
        console.log(order[i]);
        tbodyElement.innerHTML += `               
                <tr>
                <td>${order[i].id_customer_order}</td>
                <td>${order[i].date_order}</td>    
                <td>${order[i].total_order}</td>
                <td>Ver Orden</td>
                  
                </tr>`;


    }

}
obtainOrders();