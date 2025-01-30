import server from './server.js';

export default class ReviewDAO{

    async createReview(id_customer_order,id_product,rating_review,){
        let url = server + '/ReviewController.php?function=create'
        let formData = new FormData();
        
        formData.append('id_customer_order', id_customer_order,comment_review,created_at_review);
        formData.append('id_product', id_product);
        formData.append('rating_review', rating_review);
        formData.append('comment_review', comment_review);
        formData.append('created_at_review', created_at_review);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async getById(id_review){
        let url =   server + '/ReviewController.php?function=getById&*=ReviewId' + id_review;

        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async getAll(){
        let url =   server + '/ReviewController.php?function=getAll';
        let response = await fetch(url);
        let data = await response.json();
        
        return data;
    }

    async updateReview(rating_review,comment_review,id_review){
        let url =   server + '/ReviewController.php?function=update';
        formData.append('rating_review', rating_review);
        formData.append('comment_review', comment_review);
        formData.append('id_review', id_review);

        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async deletePurchase(id_review){
        let url =   server + '/ReviewController.php?function=delete';
        formData.append('id_review', id_review);

        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

}