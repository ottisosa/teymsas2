import server from './server.js';

export default class productDAO {

    async createProduct(description_product,details_product,price_product,thumbnail_product,stock_product,measures_product,id_category) {
        let url = server + '/ProductController.php?function=create';
        let formData = new FormData();
        formData.append('description_product', description_product);
        formData.append('details_product', details_product);
        formData.append('price_product', price_product);
        formData.append('thumbnail_product', thumbnail_product);
        formData.append('stock_product', stock_product);
        formData.append('measures_product', measures_product);
        formData.append('id_category', id_category);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async getAll() {
        let url = server + '/ProductController.php?function=getAll';
        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async getById(productId) {
        let url = server + '/ProductController.php?function=getById&productId=' + productId;
        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async UpdateProduct(description_product,details_product,price_product,thumbnail_product,stock_product,measures_product,id_category,id_product) {
        let url = server + '/ProductController.php?function=update';
        let formData = new FormData();
        formData.append('description_product', description_product);
        formData.append('details_product', details_product);
        formData.append('price_product', price_product);
        formData.append('thumbnail_product', thumbnail_product);
        formData.append('stock_product', stock_product);
        formData.append('measures_product', measures_product);
        formData.append('id_category', id_category);
        formData.append('id_product', id_product);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async deleteProduct(id_product) {
        let url = server + '/ProductController.php?function=delete';
        let formData = new FormData();
        formData.append('id_product', id_product);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }
}