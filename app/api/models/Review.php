<?php
require_once dirname(__DIR__) . '../../core/Database.php';

class Review
{

    function create($id_customer_order, $id_product, $rating_review, $comment_review, $created_at_review)
    {
        try {

            $connection = new conn;
            $conn = $connection->connect();

            $id_customer = $_SESSION['id_user'];

            $stmt = $conn->prepare("INSERT INTO product_reviews ($id_customer_order,$id_product,$id_customer,$rating_review,$comment_review,$created_at_review) VALUES( ? , ? , ? , ? , ?, ?, ?);");
            $stmt->bind_param("sssis",  $id_customer_order, $id_product, $id_customer, $rating_review, $comment_review, $created_at_review);
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al agregar el comentario: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    function getAll()
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM product_reviews;");
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $review = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener el comentario: " . $stmt->error);
            }
            return $review;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    function getById($id_review)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM product_reviews WHERE id_review = ?;");
            $stmt->bind_param("i", $id_review);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $review = $result->fetch_assoc();
            } else {
                throw new Exception("Error al obtener el comentario: " . $stmt->error);
            }
            return $review;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    function update($rating_review, $comment_review, $id_review)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("UPDATE product_reviews SET rating_review, comment_review = ?, ? WHERE id_review = ? ;");
            $stmt->bind_param("isi", $rating_review, $comment_review, $id_review);
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al actualizar el comentario: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    function delete($id_review)
    {

        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("DELETE FROM product_reviews WHERE id_review = ?;");
            $stmt->bind_param("i", $id_review);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al eliminar el comentario: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}
