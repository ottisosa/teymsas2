<?php


require_once "../../core/Response.php";
require_once "../models/Review.php";


$function = $_GET['function'];

switch ($function) {

    case "create":

        addReview();

        break;


    case "getAll":

        getAllReviews();

        break;
    case "getById":

        getByIdReview();
        break;


    case "update":
        updateReview();


        break;


    case "delete":

        deleteReview();

        break;
}


function addReview()
{


    try {

        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_customer_order']) && isset($_POST['id_product']) && isset($_POST['rating_review']) && isset($_POST['comment_review']) && isset($_POST['created_at_review']) && !empty($_POST['id_customer_order'] && !empty($_POST['id_product']) && !empty($_POST['rating_review']) && !empty($_POST['comment_review']) && !empty($_POST['created_at_review']))) {

            $review = [
                "id_customer_order" => $_POST['id_customer_order'],
                "id_product" => $_POST['id_product'],
                "rating_review" => $_POST['rating_review'],
                "comment_review" => $_POST['comment_review'],
                "created_at_review" => $_POST['created_at_review']
            ];

            $reviewAdded = (new Review())->create($review['id_customer_order'], $review['id_product'], $review['rating_review'], $review['comment_review'], $review['created_at_review']);


            if ($reviewAdded == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'reseña agregada exitosamente.',
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'error' => 'No se pudo agregar la reseña.'
                ]);
            }
        } else {
            // Responder con un error
            $response->setStatusCode(400); // Código de estado para solicitud incorrecta
            $response->setBody([
                'success' => false,
                'error' => 'Todos los campos son obligatorios.'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error
        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}

function getAllReviews()
{
    try {

        $response = new Response;

        $reviews = (new Review())->getAll();


        // Responder con los proveedores obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Reseñas obtenidas exitosamente.',
            'reviews' => $reviews
        ]);
    } catch (Exception $e) {

        // Responder con un error
        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
    $response->send();
}

function getByIdReview()
{


    try {
        $response = new Response;

        if (isset($_GET['reviewId']) && !empty($_GET['reviewId'])) {

            $review = [
                "id_review" => $_GET['reviewId']
            ];

            $reviewById = (new Review())->getById($review['id_review']);


            if ($reviewById) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Reseña encontrada',
                    'Reseña:' => $reviewById
                ]);
            } else {
                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Reseña no encontrada"
                ]);
            }
        } else {
            // Responder con un error
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'El ID de la Reseña es obligatorio.'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error
        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}

function updateReview()
{

    try {

        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['rating_review']) && isset($_POST['comment_review']) && isset($_POST['id_review']) && !empty($_POST['rating_review']) && !empty($_POST['comment_review']) && !empty($_POST['id_review'])) {



            $review = [
                "rating_review" => $_POST['rating_review'],
                "comment_review" => $_POST['comment_review'],
                "id_review" => $_POST['id_review']
            ];


            $reviewUpdated = (new Review())->update($review['rating_review'], $review['comment_review'], $review['id_review']);


            if ($reviewUpdated == true) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Reseña actualizada exitosamente.',
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'error' => 'Reseña no encontrada.'
                ]);
            }
        } else {
            // Responder con un error
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'Todos los campos son obligatorios.'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error
        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}

function deleteReview()
{
    try {

        $response = new Response;

        if (isset($_POST['id_review']) && !empty($_POST['id_review'])) {


            $review = [
                "id_review" => $_POST['id_review']
            ];

            $reviewDeleted = (new Review())->delete($review['id_review']);


            if ($reviewDeleted == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Reseña eliminada exitosamente.',
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => 'Reseña no encontrada.'
                ]);
            }
        } else {
            // Responder con un error
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'El ID de la reseña es obligatorio.'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error
        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}
