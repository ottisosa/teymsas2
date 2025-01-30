import server from './server.js';

export default class ProviderDAO{

    async createProvider(name_provider){
        let url= server + '/ProviderController.php?function=create';
        let formdata = new FormData();
        formdata.append('name_provider', name_provider);
        let config = {
            method: 'POST',
            body: formData
        };
    
        let response = await fetch(url, config);
        let data = await response.json();
        return data;
        }

        async getAll(){
            let url =   server + '/ProviderController.php?function=getAll';
            let response = await fetch(url);
            let data = await response.json();
            return data;
        }

        async getById(id_provider){
            let url =   server + '/ProviderController.php?function=getByid&providerId'+ id_provider;
           
            let response = await fetch(url);
            let data = await response.json();
            return data;
    
        } 

        async UpdateProvider(name_provider,id_provider){
            let url= server + '/CustomersController.php?function=update';
            let formdata = new FormData();
            formdata.append('name_provider', name_provider);
            formdata.append('id_provider', id_provider);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        }

        async deleteProvider(id_provider){
            let url= server + '/ProviderController.php?function=delete';
            let formdata = new FormData();
            formdata.append('id_provider', id_provider);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        } 


        







}