<?php

require_once "../../core/Response.php";
require_once "../models/Department.php";

$function = $_GET['function'];

switch ($function) {
    case "create":
        createDepartment();
        break;

    case "getAll":
        getAllDepartments();
        break;

    case "getById":
        getByIdDepartment();
        break;

    case "update":
        updateDepartment();
        break;

    case "delete":
        deleteDepartment();
        break;
}

function createDepartment()
{
    try {
        $response = new Response;

        if (isset($_POST['name_department']) && !empty($_POST['name_department'])) {

            $Department = [
                "name_department" => $_POST['name_department']
            ];

            $departmentCreated = (new Department())->create($Department['name_department']);

            if ($departmentCreated) {
                $response->setStatusCode(201);
                $response->setBody([
                    'success' => true,
                    'message' => 'Departamento creado exitosamente.'
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => 'No se pudo crear el departamento.'
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

function getAllDepartments()
{
    try {
        $response = new Response;

        $Departments = (new Department())->getAll();

        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'departamentos obtenidos exitosamente.',
            'data' => $Departments
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

function getByIdDepartment()
{
    try {
        $response = new Response;

        if (isset($_GET['departmentId']) && !empty($_GET['departmentId'])) {

            $Department = [
                "id_department" => $_GET['departmentId']
            ];

            $departmentById = (new Department())->getById($Department['id_department']);

            if (!empty($departmentById)) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'encontrado existosamente.',
                    'data:' => $departmentById
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => "Departamento no encontrado"
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

function updateDepartment()
{
    try {
        $response = new Response;

        if (isset($_POST['name_department']) && isset($_POST['id_department']) && !empty($_POST['name_department']) && !empty($_POST['id_department'])) {

            $department = [
                "name_department" => $_POST['name_department'],
                "id_department" => $_POST['id_department']
            ];

            $departmentUpdated = (new Department())->update($department['name_department'], $department['id_department']);


            if ($departmentUpdated) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'departamento actualizado exitosamente'
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => 'no se pudo actualizar'
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

function deleteDepartment()
{
    try {
        $response = new Response;

        if (isset($_POST['id_department']) && !empty($_POST['id_department'])) {

            $department = [
                "id_department" => $_POST['id_department']
            ];

            $departmentDeleted = (new Department())->delete($department['id_department']);

            if ($departmentDeleted) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'departamento eliminado exitosamente'
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => 'no se pudo eliminar nada, departamento no existente'
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