import server from './server.js';

export default class cityDAO{

    async createCity(id_city, name_city, id_department){
    let url= server + '/CityController.php?function=create';
    let formData = new FormData();
    formData.append('id_city', id_city);
    formData.append('name_city', name_city);
    formData.append('id_department', id_department);
    let config = {
        method: 'POST',
        body: formData
    };

    let response = await fetch(url, config);
    let data = await response.json();
    return data;
    }

    async getAll(){
        let url =   server + '/CityController.php?function=getAll';
        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async getById(id_city){
        let url =   server + '/CityController.php?function=getByid&cityId'+ id_city;
        let response = await fetch(url);
        let data = await response.json();
        return data;
}
    async UpdateCity(id_city, name_city, id_department){
        let url= server + '/CityController.php?function=update';
        let formData = new FormData();
        formData.append('id_city', id_city);
        formData.append('name_city', name_city);
        formData.append('id_department', id_department);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async deleteCity(id_city){
        let url= server + '/CityController.php?function=delete';
        let formData = new FormData();
        formData.append('id_city', id_city);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }
}