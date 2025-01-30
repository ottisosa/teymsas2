import server from './server.js';

export default class categoryDAO{

    async create(description_category){
        let url = server + '/CategoryController.php?function=create'
        let formData = new FormData();
        
        formData.append('description_category', description_category);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async getById(id_category){
        let url =   server + '/CategoryController.php?function=getById&categoryId=' + id_category;

        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async getAll(){
        let url =   server + '/CategoryController.php?function=getAll';
        let response = await fetch(url);
        let data = await response.json();
        
        return data;
    }

    async update(description_category, id_category){
        let url =   server + '/CategoryController.php?function=update';
        formData.append('description_category', description_category);
        formData.append('id_category', id_category);


        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async delete(){
        let url =   server + '/CategoryController.php?function=delete';
        formData.append('id_category', id_category);

        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

}