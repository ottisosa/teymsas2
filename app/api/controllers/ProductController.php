<?php

require_once "../../core/Response.php";
require_once "../models/Product.php";


$function = $_GET['function'];

switch ($function) {

    case "create":

        createProduct();

        break;


    case "getAll":

        getAllProducts();

        break;

    case "getById":

        getByIdProduct();

        break;

    case "update":

        updateProduct();

        break;

    case "delete":

        deleteProduct();

        break;
}




function createProduct()
{

    try {

        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['description_product'])  && isset($_POST['price_product']) && isset($_POST['id_category']) && !empty($_POST['price_product']) && !empty($_POST['id_category']) && !empty($_POST['description_product'])) {

            if (!isset($_POST['details_product']) && !isset($_POST['thumbnail_product']) && !isset($_POST['stock_product']) && !isset($_POST['measures_product'])) {

                $details_product = "";
                $thumbnail_product = "";
                $measures_product = "";
            } else {

                $details_product = $_POST["details_product"];
                $thumbnail_product = $_POST["thumbnail_product"];
                $stock_product = $_POST["stock_product"];
                $measures_product = $_POST["measures_product"];
            }

            $product = [
                "description_product" => $_POST['description_product'],
                "details_product" => $details_product,
                "price_product" => $_POST['price_product'],
                "thumbnail_product" => $thumbnail_product,
                "stock_product" => $stock_product,
                "measures_product" => $measures_product,
                "id_category" => $_POST['id_category']

            ];

            $productCreated = (new Product())->create($product['description_product'], $product['details_product'], $product['price_product'], $product['thumbnail_product'], $product['stock_product'], $product['measures_product'], $product['id_category']);


            if ($productCreated == true) {
                $response->setStatusCode(201);
                $response->setBody([
                    'success' => true,
                    'message' => 'Producto creado'

                ]);
            } else {
                $response->setStatusCode(400); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'message' => 'No se pudo crear el producto.'
                ]);
            }
        } else {

            $response->setStatusCode(400); // Código de estado para solicitud incorrecta
            $response->setBody([
                'success' => false,
                'message' => 'Todos los campos son obligatorios.'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error

        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }

    $response->send();
}

function getAllProducts()
{

    try {

        $response = new Response;

        $products = (new Product())->getAll();


        // Responder con los productos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'productos obtenidos exitosamente.',
            'data' => $products
        ]);
    } catch (Exception $e) {

        // Responder con un error
        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    $response->send();
}

function getByIdProduct()
{


    try {
        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_GET['productId']) && !empty($_GET['productId'])) {


            $product = [
                "productId" => $_GET['productId']
            ];


            $productById = (new Product())->getById($product['productId']);


            if ($productById) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'producto encontrado',
                    'producto' => $productById
                ]);
            } else {


                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'message' => "Producto no encontrado"
                ]);
            }
        } else {
            $response->setStatusCode(400); // Código de estado para solicitud incorrecta
            $response->setBody([
                'success' => false,
                'message' => 'El ID del producto es obligatorio.'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error
        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }

    $response->send();
}

function updateProduct()
{
    try {
        $response = new Response;


        // para evitar enviar datos vacios a la base de datos



        if (isset($_POST['description_product']) && isset($_POST['price_product'])  && isset($_POST['id_category']) && isset($_POST['id_product']) && !empty($_POST['description_product']) && !empty($_POST['price_product'])  && !empty($_POST['id_category']) && !empty($_POST['id_product'])) {


            if (!isset($_POST['details_product']) && !isset($_POST['thumbnail_product']) && !isset($_POST['stock_product']) && !isset($_POST['measures_product'])) {

                $details_product = "";
                $thumbnail_product = "";
                $measures_product = "";
            } else {

                $details_product = $_POST["details_product"];
                $thumbnail_product = $_POST["thumbnail_product"];
                $stock_product = $_POST["stock_product"];
                $measures_product = $_POST["measures_product"];
            }


            $product = [
                "description_product" => $_POST['description_product'],
                "details_product" => $details_product,
                "price_product" => $_POST['price_product'],
                "thumbnail_product" => $thumbnail_product,
                "stock_product" => $stock_product,
                "measures_product" => $measures_product,
                "id_category" => $_POST['id_category'],
                "id_product" => $_POST['id_product']
            ];

            $update = (new Product())->update($product['description_product'], $product['details_product'], $product['price_product'], $product['thumbnail_product'], $product['stock_product'], $product['measures_product'], $product['id_category'], $product['id_product']);



            if ($update == true) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'producto actualizado exitosamente'
                ]);
            } else {

                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => 'El producto no existe'
                ]);
            }
        } else {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'message' => 'Todos los campos son obligatorios.'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error

        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    $response->send();

}

function deleteProduct()
{

    try {
        $response = new Response;



        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_product']) && !empty($_POST['id_product'])) {

            $product = [
                "id_product" => $_POST['id_product']
            ];


            $productDeleted = (new Product())->delete($product['id_product']);

            if ($productDeleted == true) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Producto eliminado exitosamente.'
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'message' => 'Producto no encontrado.'
                ]);
            }
        } else {
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'message' => 'El ID del producto es obligatorio.'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error

        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    $response->send();

}
