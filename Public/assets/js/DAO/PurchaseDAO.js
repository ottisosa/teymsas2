import server from './server.js';

export default class PurchaseDAO{

    async createPurchase(id_provider,date_purchase_order,total_purchase_order,id_payment_method,products){
        let url = server + '/PurchaseController.php?function=create'
        let formData = new FormData();
        
        formData.append('id_provider', id_provider);
        formData.append('date_purchase_order', date_purchase_order);
        formData.append('total_purchase_order', total_purchase_order);
        formData.append('id_payment_method', id_payment_method);
        formData.append('products', products);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async getById(purchaseOrderId){
        let url =   server + '/PurchaseController.php?function=getById&purchaseOrderId=' + purchaseOrderId;

        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async getAll(){
        let url =   server + '/PurchaseController.php?function=getAll';
        let response = await fetch(url);
        let data = await response.json();
        
        return data;
    }

    async updatePurchase(id_purchase_order,id_provider,date_purchase_order,total_purchase_order,id_payment_method){
        let url =   server + '/PurchaseController.php?function=update';
        formData.append('id_purchase_order', id_purchase_order);
        formData.append('id_provider', id_provider);
        formData.append('date_purchase_order', date_purchase_order);
        formData.append('total_purchase_order', total_purchase_order);
        formData.append('id_payment_method', id_payment_method);


        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async deletePurchase(id_purchase_order){
        let url =   server + '/PurchaseController.php?function=delete';
        formData.append('id_purchase_order', id_purchase_order);

        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

}