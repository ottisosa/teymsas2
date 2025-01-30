<?php
$function = $_GET['function'];

switch ($function) {

    case "create":

        createPurchase();

        break;

    case "getAll":

        getAllPurchase();

        break;

    case "getById":

        getByIdPurchase();

        break;

    case "update":

        updatePurchase();

        break;

    case "delete":

        deletePurchase();

        break;
}

function createPurchase()
{

    try {

        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_provider']) && isset($_POST['date_purchase_order']) && isset($_POST['total_purchase_order']) && isset($_POST['id_payment_method']) && !empty($_POST['id_provider']) && !empty($_POST['date_purchase_order']) && !empty($_POST['total_purchase_order']) && !empty($_POST['id_payment_method'])) {



            // valida que sea una array y no este vacia
            if (isset($_POST['list_products']) && !empty($_POST['list_products']) && is_array($_POST['list_products'])) {

                $id_provider = $_POST['id_provider'];
                $date_purchase_order = $_POST['date_purchase_order'];
                $total_purchase_order = $_POST['total_purchase_order'];
                $id_payment_method = $_POST['id_payment_method'];
                $products = $_POST['list_products'];


                $purchase = (new Purchase())->create($id_provider, $date_purchase_order, $total_purchase_order, $id_payment_method, $products);
                if ($purchase == true) {


                    // Responder de la orden de compra 
                    $response->setStatusCode(200);
                    $response->setBody([
                        'success' => true,
                        'message' => 'se agrego correctamente la orden de compra.',
                    ]);
                } else {
                    $response->setStatusCode(400);
                    $response->setBody([
                        'success' => true,
                        'message' => 'no se pudo registrar la orden de compra.',
                    ]);
                }
            }
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
function getAllPurchase()
{

    try {

        $response = new Response;

        $Purchases = (new Purchase())->getAll();


        // Responder con los productos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Compras obtenidas exitosamente.',
            'Compras:' => $Purchases
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

function getByIdPurchase()
{
    try {
        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_GET['purchaseOrderId']) && !empty($_GET['purchaseOrderId'])) {

            $purchase = [
                "purchaseOrderId" => $_GET['purchaseOrderId']
            ];

            $purchaseById = (new Purchase())->getById($purchase['purchaseOrderId']);


            if ($purchaseById) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Compra encontrada',
                    'Compra:' => $purchaseById
                ]);
            } else {

                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Compra no encontrada"
                ]);
            }
        } else {

            // Responder con un error
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

function updatePurchase()
{
    try {
        $response = new Response;


        // para evitar enviar datos vacios a la base de datos


        if (isset($_POST['id_purchase_order']) && isset($_POST['id_provider']) && isset($_POST['date_purchase_order']) && isset($_POST['total_purchase_order']) && isset($_POST['id_payment_method']) && !empty($_POST['id_purchase_order']) && !empty($_POST['id_provider']) && !empty($_POST['date_purchase_order']) && !empty($_POST['total_purchase_order']) && !empty($_POST['id_payment_method'])) {

            $purchase = [
                "id_purchase_order" => $_POST['id_purchase_order'],
                "id_provider" => $_POST['id_provider'],
                "date_purchase_order" => $_POST['date_purchase_order'],
                "total_purchase_order" => $_POST['total_purchase_order'],
                "id_payment_method" => $_POST['id_payment_method']
            ];

            $purchaseUpdated = (new Purchase())->update($purchase['id_purchase_order'], $purchase['id_provider'], $purchase['date_purchase_order'], $purchase['total_purchase_order'], $purchase['id_payment_method']);


            if ($purchaseUpdated == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'compra actualizada exitosamente'
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Compra no encontrada"
                ]);
            }
        } else {

            // Responder con un error
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

function deletePurchase()
{
    try {
        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_purchase_order']) && !empty($_POST['id_purchase_order'])) {


            $purchase = [
                "id_purchase_order" => $_POST['id_purchase_order']
            ];

            $purchaseDeleted = (new Purchase())->delete($purchase['id_purchase_order']);


            if ($purchaseDeleted == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Compra eliminada exitosamente.'
                ]);
            } else {

                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Compra no encontrada"
                ]);
            }
        } else {
            // Responder con un error
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
