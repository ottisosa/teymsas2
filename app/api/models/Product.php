<?php

require_once dirname(__DIR__) . '../../core/Database.php';
require_once "User.php";


class Product
{



    // Funcion para agregar un producto 

    function create($description_product, $details_product, $price_product, $thumbnail_product, $stock_product, $measures_product, $id_category)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $updated_by_product = $_SESSION['id_user'];


            $stmt = $conn->prepare("INSERT INTO products (description_product, details_product, price_product, thumbnail_product, stock_product, measures_product, id_category, updated_by_product) VALUES(?,?,?,?,?,?,?,?);");
            $stmt->bind_param("ssisisii", $description_product, $details_product, $price_product, $thumbnail_product, $stock_product, $measures_product, $id_category, $updated_by_product);


            if ($stmt->execute()) {

                return $stmt->insert_id;

                if ($stmt->affected_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                throw new Exception("Error al agregar el prducto: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    //  Función para que devuelva todos los productos
    function getAll()
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();


            $stmt = $conn->prepare("SELECT c.id_category, c.description_category, p.id_product, p.description_product,p.details_product,p.price_product,p.stock_product, p.measures_product, p.thumbnail_product FROM products AS p 
            INNER JOIN  categories AS c 
            ON p.id_category = c.id_category;");

            if ($stmt->execute()) {


                $result = $stmt->get_result();
                $users = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener los productos: " . $stmt->error);
            }

            return $users;
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }



    //  Función para que devuelva producto por ID

    function getById($id_product)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("SELECT c.id_category, c.description_category, p.id_product, p.description_product,p.details_product,p.price_product,p.stock_product, p.measures_product, p.thumbnail_product FROM products AS p 
             INNER JOIN  categories AS c 
             ON p.id_category = c.id_category
             WHERE p.id_product = ?;");
            $stmt->bind_param("i", $id_product);

            if ($stmt->execute()) {


                $result = $stmt->get_result();
                $products = $result->fetch_assoc();
                return $products;
            } else {
                throw new Exception("Error al obtener el producto: " . $stmt->error);
            }
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }



    //  Función para actualizar los producto

    function update($description_product, $details_product, $price_product, $thumbnail_product, $stock_product, $measures_product, $id_category, $id_product)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $updated_by_product = $_SESSION['id_user'];


            $stmt = $conn->prepare("UPDATE products SET description_product = ?, details_product = ?, price_product = ?, thumbnail_product = ?, stock_product = ?, measures_product = ?, id_category = ? , updated_by_product = ? WHERE id_product = ? ;");
            $stmt->bind_param("ssisisiii", $description_product, $details_product, $price_product, $thumbnail_product, $stock_product, $measures_product, $id_category, $updated_by_product, $id_product);


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

    // funcion para eliminar un producto

    function delete($id_product)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("DELETE FROM products WHERE id_product = ?;");
            $stmt->bind_param("i", $id_product);

            if ($stmt->execute()) {

                if ($stmt->affected_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                throw new Exception("Error al eliminar producto: " . $stmt->error);
            }
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}
