<?php

require_once "../../core/Response.php";
require_once "../models/OrderStatus.php";

$function = $_GET['function'];

switch ($function) {

    case "create":

        createOrder();

        break;


    case "getAll":

        getAllOrders();

        break;

    case "getById":

        getByIdOrderStatus();

        break;

    case "update":

        updateOrder();

        break;

    case "delete":

        deleteOrder();

        break;
}


function createOrder()
{

    try {

        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['description_status']) && !empty($_POST['description_status'])) {


            $order = [
                "description_status" => $_POST['description_status']
            ];


            $OrderCreated = (new OrderStatus())->create($order['description_status']);


            if ($OrderCreated == true) {
                // Responder con success true si todo sale bien
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true
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

function getAllOrders()
{

    try {

        $response = new Response;

        $Orders = (new OrderStatus())->getAll();


        // Responder con los productos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'ordenes obtenidas exitosamente.',
            'Ordenes:' => $Orders
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

function getByIdOrderStatus()
{


    try {
        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_GET['orderStatusId']) && !empty($_GET['orderStatusId'])) {

            $order = [
                "id_order_status" => $_GET['orderStatusId']
            ];

            $orderById = (new OrderStatus())->getById($order['id_order_status']);


            // Responder con OK
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'orden encontrada',
                'Orden:' => $orderById
            ]);


            if ($orderById == null) {

                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Orden no encontrada"
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

function updateOrder()
{
    try {
        $response = new Response;


        // para evitar enviar datos vacios a la base de datos


        if (isset($_POST['description_status']) && isset($_POST['id_order_status']) && !empty($_POST['description_status']) && !empty($_POST['id_order_status'])) {



            $order = [
                "description_status" => $_POST['description_status'],
                "id_order_status" => $_POST['id_order_status']
            ];

            $orderStatusUpdated = (new OrderStatus())->update($order['description_status'], $order['id_order_status']);


            if ($orderStatusUpdated == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'orden actualizada exitosamente'
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Orden no encontrada"
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

function deleteOrder()
{

    try {
        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_order_status']) && !empty($_POST['id_order_status'])) {


            $order = [
                "id_order_status" => $_POST['id_order_status']
            ];

            $orderStatusDeleted = (new OrderStatus())->delete($order['id_order_status']);


            if ($orderStatusDeleted == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Orden eliminada exitosamente.'
                ]);
            } else {

                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Orden no encontrada"
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
