<?php
require '../Config/config.php';
require '../Config/database.php';

$datos = array(); // Inicializamos el arreglo de datos

if(isset($_POST['action'])){
    $action = $_POST['action'];

    if($action == 'agregar'){
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;

        if($id > 0 && $cantidad > 0 && is_numeric($cantidad)){
            // Verificamos que el producto exista en el carrito
            if(isset($_SESSION['carrito']['productos'][$id])){
                // Actualizamos la cantidad del producto en el carrito
                $_SESSION['carrito']['productos'][$id] = $cantidad;

                // Consultamos el precio y descuento del producto
                $db = new Database();
                $con = $db->conectar();
                $sql = $con->prepare("SELECT precio_producto, descuento_producto FROM productos WHERE id_producto = ? AND activo_producto = 1");
                $sql->bind_param("i", $id);
                $sql->execute();
                $resultado = $sql->get_result();

                if($resultado->num_rows > 0){
                    $producto = $resultado->fetch_assoc();
                    $precio_desc = $producto['precio_producto'] - (($producto['precio_producto'] * $producto['descuento_producto']) / 100);
                    $subtotal = $cantidad * $precio_desc;
                    $datos['ok'] = true;
                    $datos['sub'] = MONEDA . number_format($subtotal, 2, '.', ',');
                } else {
                    $datos['ok'] = false;
                }

                $sql->close();
                $con->close();
            } else {
                $datos['ok'] = false;
            }
        } else {
            $datos['ok'] = false;
        }
    } else if($action == 'eliminar') { // Si la acción es eliminar
        $id = isset($_POST['id']) ? $_POST['id'] : 0;

        // Verificamos que el producto exista en el carrito
        if(isset($_SESSION['carrito']['productos'][$id])){
            // Eliminamos el producto del carrito
            unset($_SESSION['carrito']['productos'][$id]);
            $datos['ok'] = true;
        } else {
            $datos['ok'] = false;
        }
    } else {
        $datos['ok'] = false;
    }
} else {
    $datos['ok'] = false;
}

echo json_encode($datos);
?>
