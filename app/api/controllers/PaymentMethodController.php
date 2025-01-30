<?php

require_once "../../core/Response.php";
require_once "../models/PaymentMethod.php";

$function = $_GET['function'];

switch ($function) {

    case "create":

        createPaymentMethod();

        break;


    case "getAll":

        getAllPaymentMethods();

        break;

    case "getById":

        getByIdPaymentMethod();

        break;

    case "update":

        updatePaymentMethod();

        break;

    case "delete":

        deletePaymentMethod();

        break;
}


function createPaymentMethod()
{

    try {

        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['name_payment_method']) && !empty($_POST['name_payment_method'])) {


            $PaymentMethod = [
                "name_payment_method" => $_POST['name_payment_method']
            ];

            $paymentMethodCreated = (new PaymentMethod())->create($PaymentMethod['name_payment_method']);


            if ($paymentMethodCreated == true) {
                // Responder con success true si todo sale bien
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => "Metodo de pago agregado exitosamente"
                ]);
            } else {

                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'error' => "No se pudo agregar el metodo de pago."
                ]);
            }
        } else {
            // Responder con error si el nombre del producto está vacío
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => "Todos los campos son obligatorios."
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

function getAllPaymentMethods()
{

    try {

        $response = new Response;

        $PaymentMethods = (new PaymentMethod())->getAll();


        // Responder con los productos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Metodos de pago obtenidos exitosamente.',
            'Metodos de pago:' => $PaymentMethods
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

function getByIdPaymentMethod()
{


    try {
        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_GET['paymentMethodId']) && !empty($_GET['paymentMethodId'])) {


            $PaymentMethod = [
                "paymentMethodId" => $_GET['paymentMethodId']
            ];
            $paymentMethodById = (new PaymentMethod())->getById($PaymentMethod['paymentMethodId']);


            if ($paymentMethodById) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'metodo de pago encontrado',
                    'Metodo de pago:' => $paymentMethodById
                ]);
            } else {

                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Metodo de pago no encontrado"
                ]);
            }
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

function updatePaymentMethod()
{
    try {
        $response = new Response;

        // para evitar enviar datos vacios a la base de datos



        if (isset($_POST['name_payment_method']) && isset($_POST['id_payment_method']) && !empty($_POST['name_payment_method']) && !empty($_POST['id_payment_method'])) {

            $PaymentMethod = [
                "name_payment_method" => $_POST['name_payment_method'],
                "id_payment_method" => $_POST['id_payment_method']
            ];


            $paymentMethodUpdated = (new PaymentMethod())->update($PaymentMethod['name_payment_method'], $PaymentMethod['id_payment_method']);

            if ($paymentMethodUpdated == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Metodo de pago actualizado exitosamente'
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'error' => 'No se pudo actualizar'
                ]);
            }
        } else {

            // Responder con error si el nombre del producto está vacío
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => "Todos los campos son obligatorios."
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
}

function deletePaymentMethod()
{

    try {
        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_payment_method']) && !empty($_POST['id_payment_method'])) {

            

        $PaymentMethod = [
            "id_payment_method" => $_POST['id_payment_method']
        ];

        $paymentMethodDeleted = (new PaymentMethod())->delete($PaymentMethod['id_payment_method']);


        if ($paymentMethodDeleted == true) {
            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Metodo de pago eliminado exitosamente.'
            ]);
        }else{
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'El Metodo de pago no existe.'
            ]);
        }
        }
    } catch (Exception $e) {

        // Responder con un error

        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
}
