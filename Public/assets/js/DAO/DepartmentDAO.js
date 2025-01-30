import server from './server.js';

export default class departmentDAO{

    async createCity(name_department){
        let url= server + '/CustomersController.php?function=create';
        let formData = new FormData();
        formData.append('name_department', name_department);
        
        let config = {
            method: 'POST',
            body: formData
        };
    
        let response = await fetch(url, config);
        let data = await response.json();
        return data;
        }

        async getAll(){
            let url =   server + '/DepartmentController.php?function=getAll';
            let response = await fetch(url);
            let data = await response.json();
            return data;
        }

        async getById(id_department){
            let url =   server + '/DepartmentController.php?function=getByid&departmentId'+ id_department;
            let response = await fetch(url);
            let data = await response.json();
            return data;
        } 

        async updateDepartment(name_department,id_department){
            let url= server + '/DepartmentController.php?function=update';
            let formData = new FormData();
            formData.append('name_department', name_department);
            formData.append('id_department', id_department);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        }

        async deleteDepartment(id_department){
            let url= server + '/DepartmentController.php?function=delete';
            let formData = new FormData();
            formData.append('id_department', id_department);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        } 
}
