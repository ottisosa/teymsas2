import server from './server.js';

export default class PaymentMethodDAO{

    async createPaymentMethod(name_payment_method){
        let url= server + '/PaymentMethodController.php?function=create';
        let formdata = new FormData();
        formdata.append('name_payment_method', name_payment_method);
        let config = {
            method: 'POST',
            body: formData
        };
    
        let response = await fetch(url, config);
        let data = await response.json();
        return data;
        }

        async getAll(){
            let url =   server + '/PaymentMethodController.php?function=getAll';
            let response = await fetch(url);
            let data = await response.json();
            return data;
        }

        async getById(paymentMethodId){
            let url =   server + '/PaymentMethodController.php?function=getByid&paymentMethodId'+ paymentMethodId;
           
            let response = await fetch(url);
            let data = await response.json();
            return data;
    
        } 

        async UpdatePaymentMethod(name_payment_method,id_payment_method){
            let url= server + '/PaymentMethodController.php?function=update';
            let formdata = new FormData();
            formdata.append('name_payment_method', name_payment_method);
            formdata.append('id_payment_method', id_payment_method);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        }

        async deletePaymentMethod(id_payment_method){
            let url= server + '/PaymentMethodController.php?function=delete';
            let formdata = new FormData();
            formdata.append('id_payment_method', id_payment_method);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        } 







}