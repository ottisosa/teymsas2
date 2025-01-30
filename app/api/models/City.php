<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class City
{

    public function create($name_city, $id_department)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO cities (name_city, id_department) VALUES (?, ?)");
            $stmt->bind_param("si", $name_city, $id_department);
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al crear la ciudad: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Hubo un error en la solicitud: " . $e->getMessage());
        }
    }

    public static function getAll()
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM cities");
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $cities = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener las ciudades: " . $stmt->error);
            }
            return $cities;
        } catch (Exception $e) {
            throw new Exception("Hubo un error en la solicitud: " . $e->getMessage());
        }
    }

    public function getById($id_city)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM cities WHERE id_city = ?");
            $stmt->bind_param("i", $id_city);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                return $id_city = $result->fetch_assoc();
            } else {
                throw new Exception("Error al obtener la ciudad: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Hubo un error en la solicitud: " . $e->getMessage());
        }
    }

    public function update($name_city, $id_department, $id_city)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("UPDATE cities SET name_city = ?, id_department = ? WHERE id_city = ?");
            $stmt->bind_param("sii", $name_city, $id_department, $id_city);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            throw new Exception("Hubo un error en la solicitud: " . $e->getMessage());
        }
    }

    public function delete($id_city)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("DELETE FROM cities WHERE id_city = ?");
            $stmt->bind_param("i", $id_city);
            if ($stmt->execute()) {

                if ($stmt->affected_rows > 0) {

                    return true;
                } else {

                    return false;
                }
            }
        } catch (Exception $e) {
            throw new Exception("Hubo un error en la solicitud: " . $e->getMessage());
        }
    }
}
