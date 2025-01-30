import server from './server.js';

export default class OrderStatusDAO{

    async createOrderStatus(description_status){
        let url= server + '/OrderStatusController.php?function=create';
        let formdata = new FormData();
        formdata.append('description_status', description_status);
        let config = {
            method: 'POST',
            body: formData
        };
    
        let response = await fetch(url, config);
        let data = await response.json();
        return data;
        }

        async getAll(){
            let url =   server + '/OrderStatusController.php?function=getAll';
            let response = await fetch(url);
            let data = await response.json();
            return data;
        }

        async getById(id_order_status){
            let url =   server + '/OrderStatusController.php?function=getByid&order_statusId'+ id_order_status;
           
            let response = await fetch(url);
            let data = await response.json();
            return data;
    
        } 

        async UpdateOrderStatus(description_status,id_order_status){
            let url= server + '/OrderStatusController.php?function=update';
            let formdata = new FormData();
            formdata.append('description_status', description_status);
            formdata.append('id_order_status', id_order_status);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        }

        async deleteOrderStatus(id_order_status){
            let url= server + '/OrderStatusController.php?function=delete';
            let formdata = new FormData();
            formdata.append('id_order_status', id_order_status);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        } 







}