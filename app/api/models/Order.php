<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class Order
{

    public function create($date_order, $total_order, $id_payment_method, $id_order_status, $products)
    {

        session_start();
        
        $date_order = date("Y-m-d H:i:s");
        $id_payment_method = 1;
        $id_order_status = 1;

        $id_customer = $_SESSION['id_user'];
        $updated_by_order = $_SESSION['id_user'];

        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO customer_orders (id_customer, date_order, total_order, id_payment_method, id_order_status, updated_by_order) VALUES (?,?,?,?,?,?);");
            $stmt->bind_param("isiiii", $id_customer, $date_order, $total_order, $id_payment_method, $id_order_status, $updated_by_order);
            if ($stmt->execute()) {

                $id_customer_order = $stmt->insert_id;
                foreach ($products as $product) {
                    $stmt = $conn->prepare("INSERT INTO order_products_customers(id_customer_order, id_product, quantity_order_product_customer, unit_price_order_product_customer, total_order_product_customer) VALUES(? , ? , ? , ? , ?);");

                    $id_product = $product['id'];
                    $quantity = $product['cant'];
                    $unit_price = $product['precioUnitario'];
                    $total_order = $quantity * $unit_price;

                    $stmt->bind_param("iiidd", $id_customer_order, $id_product, $quantity, $unit_price, $total_order);

                    if (!$stmt->execute()) {
                        return false;
                    }
                }
                
                return true;
                
            } else {
                throw new Exception("Error al agregar la orden: " . $stmt->error);
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


            $stmt = $conn->prepare("SELECT co.id_customer_order, co.id_customer, co.date_order, co.total_order, co.id_payment_method, co.id_order_status, co.updated_at_order, co.updated_by_order, u.complete_name_user FROM customer_orders AS co INNER JOIN users AS u ON co.id_customer = u.id_user;");

            if ($stmt->execute()) {

                $result = $stmt->get_result();
                $users = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener las ordenes: " . $stmt->error);
            }

            return $users;
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function getProductsOrder()
    {

        try {
            $connection = new conn;
            $conn = $connection->connect();


            $stmt = $conn->prepare("SELECT opc.id_order_product_customer, opc.id_customer_order, opc.id_product, opc.quantity_order_product_customer, opc.unit_price_order_product_customer, opc.total_order_product_customer, p.description_product, p.id_product 
            FROM order_products_customers AS opc 
            INNER JOIN products AS p ON opc.id_product = p.id_product 
            WHERE opc.id_customer_order = ?;");

            if ($stmt->execute()) {

                $result = $stmt->get_result();
                $users = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener el detalle de la orden: " . $stmt->error);
            }

            return $users;
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function getById($id_customer_order)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM customer_orders WHERE id_customer_orders = ?");
            $stmt->bind_param("i", $id_customer_order);
            if ($stmt->execute()) {

                $result = $stmt->get_result();
                $order_status = $result->fetch_assoc();
                return $order_status;
            } else {
                throw new Exception("Orden no encontrada " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function getByCustomer()
    {
        try {
            session_start();
            $id_customer = $_SESSION['id_user'];
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM customer_orders WHERE id_customer = ?");
            $stmt->bind_param("i", $id_customer);
            if ($stmt->execute()) {

                $result = $stmt->get_result();
                $order_status = $result->fetch_all(MYSQLI_ASSOC);
                return $order_status;
            } else {
                throw new Exception("No se encontraron ordenes " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    public function update($date_order, $total_order, $id_payment_method, $id_order_status, $id_customer_order)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $id_customer = $_SESSION['id_user'];

            $stmt = $conn->prepare("UPDATE customer_orders SET  id_customer = ?, date_order = ?, total_order = ?, id_payment_method = ?, id_order_status = ?  WHERE id_customer_order = ?");
            $stmt->bind_param("isiiii", $id_customer, $date_order, $total_order, $id_payment_method, $id_order_status, $id_customer_order);
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

    public static function delete($id_customer_order)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("DELETE FROM customer_orders WHERE id_customer_order = ?");
            $stmt->bind_param("i", $id_customer_order);
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
