<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class Category
{
    // Funcion para crear una categoria
    public function create($description_category)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("INSERT INTO categories (description_category) VALUES (?)");
            $stmt->bind_param("s", $description_category);
            
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

    public function getById($idCategory)
    {
        try {

            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM categories WHERE id_category = ?");

            $stmt->bind_param("i", $idCategory);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $category = $result->fetch_assoc();
            }
            return $category;
        } catch (Exception $e) {
            throw new Exception("Hubo un error en la solicitud: " . $e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM categories");
            if ($stmt->execute()) {

                $result = $stmt->get_result();
                $categories = $result->fetch_all(MYSQLI_ASSOC);
            }
            return $categories;
        } catch (Exception $e) {
            throw new Exception("Hubo un error en la solicitud: " . $e->getMessage());
        }
    }
    public function update($description_category, $id_category)
    {
        try {

            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("UPDATE categories SET description_category = ? WHERE id_category = ?");
            $stmt->bind_param("si", $description_category, $id_category);
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

    public function delete($id_category)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("DELETE FROM categories WHERE id_category = ?");
            $stmt->bind_param("i", $id_category);
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
