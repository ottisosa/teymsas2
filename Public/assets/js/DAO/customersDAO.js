import server from './server.js';

export default class customerDAO {

    async createCustomer(complete_name_user,phone_user,email_user,password_user,document_customer, address_customer, business_name_customer,rut_customer, id_city) {
        let url = server + '/CustomersController.php?function=create';
        let formData = new FormData();
        formData.append('document_customer',complete_name_user);
        formData.append('document_customer',phone_user);
        formData.append('document_customer',email_user);
        formData.append('document_customer',password_user);
        formData.append('document_customer', document_customer);
        formData.append('address_customer', address_customer);
        formData.append('business_name_customer', business_name_customer);
        formData.append('rut_customer', rut_customer);
        formData.append('id_city', id_city);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async getAll() {
        let url = server + '/CustomersController.php?function=getAll';
        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async getById(id_user) {
        let url = server + '/CustomersController.php?function=getByid&userId' + id_user;
        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async UpdateCustomer(document_customer, address_customer, businessName_customer, rut_customer, id_city_customer, id_user) {
        let url = server + '/CustomersController.php?function=update';
        let formData = new FormData();
        formData.append('document_customer', document_customer);
        formData.append('address_customer', address_customer);
        formData.append('businessName_customer', businessName_customer);
        formData.append('rut_customer', rut_customer);
        formData.append('id_city_customer', id_city_customer);
        formData.append('id_user', id_user);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async deleteCustomer(id_user) {
        let url = server + '/CustomersController.php?function=delete';
        let formData = new FormData();
        formData.append('id_user', id_user);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }
}