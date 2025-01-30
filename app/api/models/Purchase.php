<?php
require_once dirname(__DIR__) . '../../core/Database.php';

class Purchase
{

    function create($id_provider, $date_purchase_order, $total_purchase_order, $id_payment_method, $products)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO purchase (id_provider,date_purchase_order,total_purchase_order,id_payment_method) VALUES(? , ? , ? ,?);");
            $stmt->bind_param("isdi", $id_provider, $date_purchase_order, $total_purchase_order, $id_payment_method,);
            if ($stmt->execute()) {
                $id_purchase_order = $stmt->insert_id;
                foreach ($products as $product) {
                    $stmt = $conn->prepare("INSERT INTO order_products_purchases (id_purchase_order, id_product, quantity_order_product_purchase, unit_price_order_product_purchase, total_order_product_purchase) VALUES(? , ? , ? , ? , ?);");

                    $id_product = $product['product_id'];
                    $quantity = $product['quantity'];
                    $unit_price = $product['unit_price'];
                    $total_order = $quantity * $unit_price;

                    $stmt->bind_param("iiidd", $id_purchase_order, $id_product, $quantity, $unit_price, $total_order);
                    if ($stmt->execute()) {

                        if ($stmt->affected_rows > 0) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            } else {
                throw new Exception("Error al agregar la compra: " . $stmt->error);
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
            $stmt = $conn->prepare("SELECT * FROM purchase;");
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $purchase = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener las compras: " . $stmt->error);
            }
            return $purchase;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    function getById($id_purchase_order)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM purchase WHERE id_purchase_order = ?;");
            $stmt->bind_param("i", $id_purchase_order);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $purchase = $result->fetch_assoc();
            } else {
                throw new Exception("Error al obtener la compra: " . $stmt->error);
            }

            return $purchase;
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    function update($id_purchase_order, $id_provider, $date_purchase_order, $total_purchase_order, $id_payment_method)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("UPDATE purchase SET id_provaider='?',date_purchase_order='?', total_purchase_order='?', payment_method='?' WHERE id_purchase_order=?;");
            $stmt->bind_param("isdii", $id_provider, $date_purchase_order, $total_purchase_order, $id_payment_method, $id_purchase_order);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                throw new Exception("Error al actualizar la compra: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    function delete($id_purchase_order)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("DELETE FROM purchase WHERE id_purchase_order = ?;");
            $stmt->bind_param("i", $id_purchase_order);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al eliminar la compra: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}
