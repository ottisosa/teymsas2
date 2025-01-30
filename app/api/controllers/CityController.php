<?php
require_once "../../core/Response.php";
require_once "../models/City.php";

$function = $_GET['function'];

switch ($function) {
    case "create":
        createCity();
        break;

    case "getById":
        getByIdCity();
        break;

    case "getAll":
        getAllCities();
        break;

    case "update":
        updateCity();
        break;

    case "delete":
        deleteCity();
        break;
}

function createCity()
{
    try {
        $response = new Response;

        if (isset($_POST['name_city']) && isset($_POST['id_department']) && !empty($_POST['name_city']) && !empty($_POST['id_department'])) {

            $City = [
                "name_city" => $_POST['name_city'],
                "id_department" => $_POST['id_department']
            ];

            $cityCreated = (new City())->create($City['name_city'], $City['id_department']);

            if ($cityCreated) {
                $response->setStatusCode(201);
                $response->setBody([
                    'success' => true,
                    'message' => 'Ciudad agregada con exito'
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => 'No se pudo agregar la ciudad'
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
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    $response->send();
}

function getByIdCity()
{
    try {
        $response = new Response;

        if (isset($_GET['cityId']) && !empty($_GET['cityId'])) {

            $id_city = $_GET['cityId'];

            $cityById = (new City)->getById($id_city);

            $response->setStatusCode(200);
            
            if (!empty($categoryById)) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Categoria encontrada exitosamente.',
                    'data' => $cityById
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => "Categoria no encontrada"
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
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    $response->send();
}

function getAllCities()
{
    try {
        $response = new Response;

        $cities = (new City())->getAll();

        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Ciudades encontradas exitosamente.',
            'data' => $cities
        ]);
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    $response->send();
}

function updateCity()
{
    try {
        $response = new Response;

        if (isset($_POST['name_city']) && isset($_POST['id_department']) && isset($_POST['id_city']) && !empty($_POST['name_city']) && !empty($_POST['id_department']) && !empty($_POST['id_city'])) {

            $City = [
                "name_city" => $_POST['name_city'],
                "id_department" => $_POST['id_department'],
                "id_city" => $_POST['id_city']
            ];

            $cityUpdated = (new City())->update($City['name_city'], $City['id_department'], $City['id_city']);
            
            if ($cityUpdated) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Ciudad actualizada exitosamente.'
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'message' => "No se encontró la ciudad"
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
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    $response->send();
}

function deleteCity()
{
    try {
        $response = new Response;

        if (isset($_POST['id_city']) && !empty($_POST['id_city'])) {

            $id_city = $_POST['id_city'];

            $CityDeleted = (new City)->delete($id_city);

            if ($CityDeleted == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Ciudad eliminada exitosamente.'
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'message' => "Ciudad no encontrada"
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
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    $response->send();
}