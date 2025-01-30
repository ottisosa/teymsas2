<?php
require_once "../../core/Response.php";
require_once "../models/Delivery.php";

$function = $_GET['function'];

switch ($function) {
    case "create":
        createDelivery();
        break;
    case "getById":
        getByIdDelivery();
        break;
    case "getAll":
        getAllDeliveries();
        break;
    case "update":
        updateDelivery();
        break;
    case "delete":
        deleteDelivery();
        break;
}

function createDelivery()
{
    $response = new Response;

    try {

        if (isset($_POST['id_customer_order']) && isset($_POST['address_delivery']) && isset($_POST['date_delivery']) && !empty($_POST['id_customer_order']) && !empty($_POST['address_delivery']) && !empty($_POST['date_delivery'])) {

            $Delivery = [
                "id_customer_order" => $_POST['id_customer_order'],
                "address_delivery" => $_POST['address_delivery'],
                "date_delivery" => $_POST['date_delivery']
            ];
            // Crear una nueva entrega en la base de datos
            $DeliveryCreated = (new Delivery())->create($Delivery['id_customer_order'], $Delivery['address_delivery'], $Delivery['date_delivery']);

            if ($DeliveryCreated == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Entrega agregada con éxito',
                    'data' => $DeliveryCreated
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'error' => 'El delivery ya existe.'
                ]);
            }
        } else {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'Todos los campos son obligatorios.'
            ]);
        }
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}

function getByIdDelivery()
{


    try {
        $response = new Response;

        // Validar que no esté vacío
        if (isset($_GET['deliveryId']) && !empty($_GET['deliveryId'])) {

            $id_delivery = $_GET['deliveryId'];


            $deliveryById = (new Delivery)->getById($id_delivery);

            // Responder con los datos obtenidos
            if ($deliveryById) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Entrega encontrada exitosamente.',
                    'entrega' => $deliveryById
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Entrega no encontrada"
                ]);
            }
        } else {
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'ID de entrega requerido.'
            ]);
        }
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}

function getAllDeliveries()
{


    try {

        $response = new Response;

        $deliveries = (new Delivery())->getAll();

        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Entregas encontradas exitosamente.',
            'entregas' => $deliveries
        ]);
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}

function updateDelivery()
{
    $response = new Response;

    try {


        // Validar que los campos no estén vacíos
        if (isset($_POST['id_delivery']) && isset($_POST['address_delivery']) && isset($_POST['date_delivery']) && isset($_POST['status']) && isset($_POST['id_customer_order']) && isset($_POST['id_delivery']) && !empty($_POST['address_delivery']) && !empty($_POST['date_delivery']) && !empty($_POST['status'] && !empty($_POST['id_customer_order']))) {

            $Delivery = [
                "id_delivery" => $_POST['id_delivery'],
                "address_delivery" => $_POST['address_delivery'],
                "date_delivery" => $_POST['date_delivery'],
                "status" => $_POST['status'],
                "id_customer_order" => $_POST['id_customer_order']
            ];

            $DeliveryUpdated  = (new Delivery())->update($Delivery['id_customer_order'], $Delivery['address_delivery'], $Delivery['status'], $Delivery['date_delivery'], $Delivery['id_delivery']);

            if ($DeliveryUpdated == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Entrega actualizada exitosamente.'
                ]);
            } else {

                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'error' => 'La entrega no existe.'
                ]);
            }
        } else {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'Todos los campos son obligatorios.'
            ]);
        }
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}

function deleteDelivery()
{


    try {

        $response = new Response;

        if (isset($_POST['id_delivery']) && !empty($_POST['id_delivery'])) {

            $id_delivery = $_POST['id_delivery'];
            $DeliveryDeleted = (new Delivery)->delete($id_delivery);

            if ($DeliveryDeleted == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Entrega eliminada exitosamente.'
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Entrega no encontrada"
                ]);
            }
        } else {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'ID de entrega requerido.'
            ]);
        }
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}
