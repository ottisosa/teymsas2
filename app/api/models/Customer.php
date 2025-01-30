<?php
require_once "../../core/Database.php";
require_once "User.php";

class Customer
{
    function register($complete_name_user, $email_user, $password_user, $phone_user, $document_customer, $address_customer, $business_name_customer,    $rut_customer, $id_city)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $user = (new User())->create($complete_name_user, $email_user, $password_user, $phone_user, 'C');

            $id_user_customer = $user;  // retorna el id_user para insertar foreign key id_user_customer

            $stmt = $conn->prepare("INSERT INTO customers (id_user_customer, document_customer,	address_customer, business_name_customer,	rut_customer, id_city	) VALUES(? ,? , ? , ? , ? ,?);");
            $stmt->bind_param("issssi", $id_user_customer, $document_customer,    $address_customer, $business_name_customer,    $rut_customer, $id_city);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al crear el usuario: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    public function getAll()
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM customers");
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $customers = $result->fetch_all();
            } else {
                throw new Exception("Error al obtener los clientes: " . $stmt->error);
            }
            return $customers;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public static function getById($id_user)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM customers WHERE id_user_customer = ?");
            $stmt->bind_param("i", $id_user);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $id_user = $result->fetch_assoc();
            } else {
                throw new Exception("Cliente no encontrado" . $stmt->error);
            }
            return $id_user;
        } catch (Exception $e) {
            throw new Exception("Error al obtener el cliente:" . $e->getMessage());
        }
    }

    public function update($document_customer, $address_customer, $businessName_customer, $rut_customer, $id_city_customer, $id_user)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("UPDATE customers SET document_customer = ?, address_customer = ?, business_name_customer = ?, rut_customer = ?, id_city = ? WHERE id_user_customer = ?");
            $stmt->bind_param("ssssii", $document_customer, $address_customer, $businessName_customer, $rut_customer, $id_city_customer, $id_user);

            if ($stmt->execute()) {

                if ($stmt->affected_rows > 0) {

                    return true;
                } else {

                    return false;
                }
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public static function delete($id_user_customer)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("DELETE FROM customers WHERE id_user_customer = ?");
            $stmt->bind_param("i", $id_user_customer);
            if ($stmt->execute()) {

                if ($stmt->affected_rows > 0) {

                    return true;
                } else {

                    return false;
                }
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}
