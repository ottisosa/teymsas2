<?php
require_once dirname(__DIR__) . '../../core/Database.php';
session_start();

class User
{

    //  Función para registro de usuarios

    function create($complete_name_user, $email_user, $password_user, $phone_user, $role_user)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO users (complete_name_user, email_user , password_user, phone_user, role_user) VALUES( ? , ? , ? , ? ,?);");
            $hashedPassword = password_hash($password_user, PASSWORD_BCRYPT);
            $stmt->bind_param("sssis", $complete_name_user, $email_user, $hashedPassword, $phone_user, $role_user);

            if ($stmt->execute()) {

                return $stmt->insert_id;
            } else {
                throw new Exception("Error al crear el usuario: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    //  Función para login de usuarios

    function login($email_user, $password_user)
    {

        $user = [];
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("SELECT * FROM users WHERE email_user= ? ;");
            $stmt->bind_param("s", $email_user);

            if ($stmt->execute()) {

                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                if ($user == NULL) {

                    return false;
                }

                if (!password_verify($password_user, $user['password_user'])) {
                    return false;
                }

                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['role_user'] = $user['role_user'];

            } else {

                return false;
            }

            $user = [
                'user_name' => $user['complete_name_user'],
                'user_email' => $user['email_user'],
                'user_phone' => $user['phone_user']
            ];

            return $user;

        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    //  Función para que devuelva la informacion de todos los usuarios

    function getAll()
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();


            $stmt = $conn->prepare("SELECT * FROM users;");

            if ($stmt->execute()) {


                $result = $stmt->get_result();
                $users = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener los usuarios: " . $stmt->error);
            }

            return $users;
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    //  Función para que devuelva la informacion de todos los usuarios por ID

    function getById($id_user)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("SELECT * FROM users WHERE id_user = ?;");
            $stmt->bind_param("i", $id_user);

            if ($stmt->execute()) {


                $result = $stmt->get_result();
                $users = $result->fetch_assoc();
            } else {
                throw new Exception("Error al obtener usuario: " . $stmt->error);
            }

            return $users;
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    //  Función para actualizar los usuarios sin la contraseña

    function updateWithoutPassword($complete_name_user, $email_user, $phone_user)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();


            $id_user = $_SESSION['id_user'];

            $stmt = $conn->prepare("UPDATE users SET complete_name_user = ?, email_user = ?,  phone_user = ? WHERE id_user = ? ;");
            $stmt->bind_param("ssii", $complete_name_user, $email_user, $phone_user, $id_user);

            if ($stmt->execute()) {

                if ($stmt->affected_rows > 0) {

                    return true;
                } else {

                    return false;
                }
            } else {
                throw new Exception("Error al actualizar usuario: " . $stmt->error);
            }
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    //  Función para actualizar la contraseña


    public function updatePassword($currentPassword, $newPassword)
    {

        try {
            $connection = new conn;
            $conn = $connection->connect();

            $id_user = $_SESSION['id_user'];

            $stmt = $conn->prepare("SELECT password_user FROM users WHERE id_user = ?");
            $stmt->bind_param("i", $id_user);

            if ($stmt->execute()) {

                $result = $stmt->get_result();
                $result = $result->fetch_assoc();


                if ($result == NULL) {
                    throw new Exception("No se encontro la contraseña del usuario");
                } else {
                    if (!password_verify($currentPassword, $result['password_user'])) {
                        throw new Exception("La contraseña actual no coincide");
                    }
                }
            }


            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT); // para hashear la contraseña 

            $stmt = $conn->prepare("UPDATE users SET password_user = ? WHERE id_user = ?");
            $stmt->bind_param("si", $hashedPassword, $id_user);

            $stmt->execute();

            if ($conn->affected_rows > 0) {

                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception("Error al actualizar la contraseña: " . $e->getMessage());
        }
    }



    // funcion para salir de la sesion

    function logout()
    {


        if (isset($_SESSION['id_user'])) {
            session_destroy();
        } else {

            return false;
        }

        return true;
    }
}
