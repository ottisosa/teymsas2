<?php
require_once "../../core/Response.php";
require_once "../models/Category.php";

$function = $_GET['function'];

switch ($function) {
    case "create":
        createCategory();
        break;

    case "getById":
        getByIdCategory();
        break;

    case "getAll":
        getAllCategories();
        break;

    case "update":
        updateCategory();
        break;

    case "delete":
        deleteCategory();
        break;
}

function createCategory()
{
    try {
        $response = new Response;

        if (isset($_POST['description_category']) && !empty($_POST['description_category'])) {

            $category = [
                "description_category" => $_POST['description_category']
            ];

            $categoryCreated = (new Category())->create($category['description_category']);

            if ($categoryCreated) {
                $response->setStatusCode(201);
                $response->setBody([
                    'success' => true,
                    'message' => 'Categoria creada con exito'
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => true,
                    'message' => 'No se pudo crear la categoría'
                ]);
            }
        } else {
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'message' => 'Todos los campos son obligatorios'
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

function getByIdCategory()
{
    try {
        $response = new Response;

        if (isset($_GET['categoryId']) && !empty($_GET['categoryId'])) {

            $id_category = $_GET['categoryId'];

            $categoryById = (new Category)->getById($id_category);

            if (!empty($categoryById)) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Categoria encontrada exitosamente.',
                    'data' => $categoryById
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'message' => "Categoria no encontrada"
                ]);
            }
        } else {
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'message' => 'Todos los campos son obligatorios'
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

function getAllCategories()
{
    try {
        $response = new Response;

        $categories = (new Category)->getAll();

        if (!empty($categories)) {
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Categorias encontradas exitosamente.',
                'data' => $categories
            ]);
        } else {
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'message' => 'No se encontraron categorias.',
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

function updateCategory()
{
    try {
        $response = new Response;

        if (isset($_POST['description_category']) && isset($_POST['id_category']) && !empty($_POST['description_category']) && !empty($_POST['id_category'])) {

            $category = [
                "description_category" => $_POST['description_category'],
                "id_category" => $_POST['id_category']
            ];

            $categoryUpdated = (new Category())->update($category['description_category'], $category['id_category']);

            if ($categoryUpdated) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Categoria actualizada exitosamente.'
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'message' => "No se encontró la categoría"
                ]);
            }
        } else {
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'message' => 'Todos los campos son obligatorios'
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

function deleteCategory()
{
    try {
        $response = new Response;

        if (isset($_POST['id_category']) && !empty($_POST['id_category'])) {

            $id_category = $_POST['id_category'];

            $categoryDeleted = (new Category)->delete($id_category);

            if ($categoryDeleted == true) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Categoria eliminada exitosamente.'
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'message' => "No se encontró la categoría"
                ]);
            }
        } else {
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'message' => 'Todos los campos son obligatorios'
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
