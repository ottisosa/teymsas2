<?php

require_once "../../core/Response.php";
require_once "../models/Provider.php";


$function = $_GET['function'];

switch ($function) {

    case "create":

        addProvider();

        break;


    case "getAll":

        getAllProviders();

        break;
    case "getById":

        getByIdProvider();
        break;


    case "update":
        updateProvider();


        break;


    case "delete":

        deleteProvider();
        break;
}


function addProvider()
{

    try {

        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['name_provider']) && !empty($_POST['name_provider'])) {

            $provider = [
                "name_provider" => $_POST['name_provider']
            ];

            $providerAdded = (new Provider())->create($provider['name_provider']);


            if ($providerAdded == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'proveedor agregado exitosamente.',
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'error' => 'No se pudo agregar el proveedor.'
                ]);
            }
        } else {
            // Responder con un error
            $response->setStatusCode(400); // Código de estado para solicitud incorrecta
            $response->setBody([
                'success' => false,
                'error' => 'El nombre de el proveedor es obligatorio.'
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

function getAllProviders()
{
    try {

        $response = new Response;

        $users = (new Provider())->getAll();


        // Responder con los proveedores obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'proveedores obtenidos exitosamente.',
            'users' => $users
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

function getByIdProvider()
{


    try {
        $response = new Response;

        if (isset($_GET['providerId']) && !empty($_GET['providerId'])) {

            $provider = [
                "id_provider" => $_GET['providerId']
            ];

            $providerById = (new Provider())->getById($provider['id_provider']);


            if ($providerById) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Proveedor encontrado',
                    'Proveedor:' => $providerById
                ]);
            } else {
                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Proveedor no encontrado"
                ]);
            }
        } else {
            // Responder con un error
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'El ID del proveedor es obligatorio.'
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

function updateProvider()
{

    try {

        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['name_provider']) && isset($_POST['id_provider']) && !empty($_POST['name_provider']) && !empty($_POST['id_provider'])) {



            $provider = [
                "name_provider" => $_POST['name_provider'],
                "id_provider" => $_POST['id_provider']
            ];


            $providerUpdated = (new Provider())->update($provider['name_provider'], $provider['id_provider']);


            if ($providerUpdated == true) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'proveedor actualizado exitosamente.',
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'error' => 'Proveedor no encontrado.'
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

function deleteProvider()
{
    try {

        $response = new Response;

        if (isset($_POST['id_provider']) && !empty($_POST['id_provider'])) {


            $provider = [
                "id_provider" => $_POST['id_provider']
            ];

            $providerDeleted = (new Provider())->delete($provider['id_provider']);


            if ($providerDeleted == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'proveedor eliminado exitosamente.',
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => 'Proveedor no encontrado.'
                ]);
            }
        } else {
            // Responder con un error
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'El ID del proveedor es obligatorio.'
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
