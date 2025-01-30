<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class Department
{
    public function create($name_department)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO departments (name_department) VALUES (?)");
            $stmt->bind_param("s", $name_department);
            if ($stmt->execute()) {
                return $name_department;
            } else {
                throw new Exception("Error al crear el departamento: " . $stmt->error);
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
            $stmt = $conn->prepare("SELECT * FROM departments");
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $departments = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener los departamentos: " . $stmt->error);
            }
            return $departments;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public function getById($id_department)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM departments WHERE id_department = ?");
            $stmt->bind_param("i", $id_department);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $departments = $result->fetch_assoc();
            } else {
                throw new Exception("Departamento no encontrado");
            }
            return $departments;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public function update($name_department, $id_department)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("UPDATE departments SET name_department = ? WHERE id_department = ?");
            $stmt->bind_param("si", $name_department, $id_department);
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
    public static function delete($id_department)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("DELETE FROM departments WHERE id_department = ?");
            $stmt->bind_param("i", $id_department);
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
