import reviewDAO from './ReviewDAO';

window.onload = () => {
    obtainReviews();

}


async function obtainReviews() {
    const result = await new reviewtDAODAO().getAll();
    showReview(result.data);
}

async function showReview(review) {

    let tbodyElement = document.querySelector("#mostrarReview");
    tbodyElement.innerHTML = "";
    for (let i = 0; i < review.length; i++) {
        tbodyElement.innerHTML += `               
                <tr>
                <td>${review[i].id_review}</td>
                <td>${review[i].nombre}</td>
                <td>${review[i].nombre}</td>
                <td>${review[i].rating_review}</td>    
                <td>${review[i].comment_review}</td>
                <td>${review[i].created_at_review}</td>
                <td>
                    <button onclick="eliminarProducto(${review[i].id_review})">Eliminar</button>
                </td>   
                </tr>`;
    }
}
window.eliminarReview = async function (id_review) {

    const result = await new reviewDAO().deleteProduct(id_review);

    console.log(result);

    if (result.success) {
        alert(result.message);

        obtainReviews();

    } else {
        alert(result.message);
    }


};
