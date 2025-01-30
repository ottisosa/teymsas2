<?php
require_once "../../core/Response.php";
require_once "../models/User.php";


$function = $_GET['function'];



switch ($function) {

    case "login":

        login();

        break;


    case "register":

        registerUser();

        break;

    case "getAll":

        getAllUsers();

        break;

    case "getById":

        getUserById();

        break;

    case "updateWithoutPassword":

        updateWithoutPasswordUser();

        break;

    case "updatePassword":

        updatePasswordUser();

        break;

    case "logout": 

        logout();
        break;

    case "getSession": 
        getSession();
        break;

        case "getSessionAdmin": 
            getSessionAdmin();
            break;
    }





function login()
{
    try {

        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['email_user']) && isset($_POST['password_user']) && !empty($_POST['email_user']) && !empty($_POST['password_user'])) {


            $user = [
                "email_user" => $_POST['email_user'],
                "password_user" => $_POST['password_user']
            ];

            $user = (new User())->login($user['email_user'], $user['password_user']);

            if (!empty($user)) {
                // Responder con el usuario logueado
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Usuario logueado exitosamente.',
                    'data' => $user
                ]);
            } else {
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => 'No se pudo loguear al usuario.'
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



function registerUser()
{
    try {

        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['complete_name_user']) && isset($_POST['email_user']) && isset($_POST['password_user'])  && isset($_POST['phone_user']) && isset($_POST['complete_name_user']) && isset($_POST['role_user']) && !empty($_POST['email_user']) && !empty($_POST['password_user'])  && !empty($_POST['phone_user']) && !empty($_POST['role_user'])) {


            $user = [
                "complete_name_user" => $_POST['complete_name_user'],
                "email_user" => $_POST['email_user'],
                "password_user" => $_POST['password_user'],
                "phone_user" => $_POST['phone_user'],
                "role_user" => $_POST['role_user']

            ];

            (new User())->create($user['complete_name_user'], $user['email_user'], $user['password_user'], $user['phone_user'], $user['role_user']);


            // Responder con el usuario registrado
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Usuario registrado exitosamente.',
            ]);
        } else {

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


function getAllUsers()
{

    try {

        $response = new Response;

        $users = (new User())->getAll();


        // Responder con los usuarios obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Usuarios obtenidos exitosamente.',
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

function getUserById()
{

    try {

        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_GET['userId']) && !empty($_GET['userId'])) {

            $id_user = $_GET['userId'];


            $user = (new User())->getById($id_user);


            // Responder con los usuarios obtenidos
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Usuario obtenido exitosamente.',
                'user' => $user
            ]);

            if ($user == null) {

                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Usuario no encontrado"
                ]);
            }
        } else {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'Debe ingresar el id del usuario.'
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

function updateWithoutPasswordUser()
{

    try {

        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['complete_name_user']) && isset($_POST['email_user']) && isset($_POST['phone_user']) && !empty($_POST['complete_name_user']) && !empty($_POST['email_user']) && !empty($_POST['phone_user'])) {

            $user = [
                "complete_name_user" => $_POST['complete_name_user'],
                "email_user" => $_POST['email_user'],
                "phone_user" => $_POST['phone_user']

            ];

            $userUpdated = (new User())->updateWithoutPassword($user['complete_name_user'], $user['email_user'], $user['phone_user']);


            if ($userUpdated == true) {

                // Responder con el usuario actualizado
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Usuario actualizado exitosamente.'
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
                'error' => 'Los campos no pueden estar vacios.'
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

function updatePasswordUser()
{

    try {

        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['current_password']) && isset($_POST['new_password']) && !empty($_POST['current_password']) && !empty($_POST['new_password'])) {


            $password = [
                "current_password" => $_POST['current_password'],
                "new_password" => $_POST['new_password']

            ];


            $passwordUpdated = (new User())->updatePassword($password['current_password'], $password['new_password']);



            if ($passwordUpdated === true) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Contraseña actualizada exitosamente.'
                ]);
            } else {

                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => 'no se pudo actualizar la contraseña'
                ]);
            }
        } else {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'Los campos no pueden estar vacios.'
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


function logout()
{

    try {

        $response = new Response;


        $logout = (new User())->logout();



        if (!$logout) {
            throw new Errorexception("Ocurrio un error");
        }

        // Responder con el usuario deslogueado
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Usuario deslogueado exitosamente.'
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

function getSession()
{
    $response = new Response;

    if (isset($_SESSION['id_user'])) {
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Existe sesión de usuario.'
        ]);
    } else {
        $response->setStatusCode(200);
        $response->setBody([
            'success' => false,
            'message' => 'No existe sesión de usuario.'
        ]);
    }
    $response->send();
}
function getSessionAdmin()
{
    $response = new Response;

    if ((isset($_SESSION['id_user'])) && (isset($_SESSION['role_user'])) && ($_SESSION['role_user'] === "A")) {
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Existe sesión de admin.'
        ]);
    } else {
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'message' => 'No existe sesión de admin.'
        ]);
    }
    $response->send();
}
