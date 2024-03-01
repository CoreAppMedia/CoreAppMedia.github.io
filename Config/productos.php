<?php
require 'Config/config.php';
require 'Config/database.php';

function obtenerProductosActivos() {
    // Crear una instancia de la clase Database
    $db = new Database();
    // Obtener la conexión
    $con = $db->conectar();
    // Verificar si la conexión es exitosa
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
    // Preparar la consulta
    $sql = $con->prepare("SELECT id_producto, nombre_producto, precio_producto FROM productos WHERE activo_producto = 1");
    // Verificar si la preparación de la consulta fue exitosa
    if ($sql === false) {
        die("Error en la preparación de la consulta: " . $con->error);
    }
    // Ejecutar la consulta
    $sql->execute();
    // Verificar si la ejecución de la consulta fue exitosa
    if ($sql === false) {
        die("Error al ejecutar la consulta: " . $con->error);
    }

    // Obtener resultados
    $resultado = $sql->get_result();

    // Cerrar la conexión y liberar recursos
    $sql->close();
    $con->close();

    // Devolver el resultado
    return $resultado;
}

function obtenerProducto($idProducto) {
    $db = new Database();
    $con = $db->conectar();
    if ($con->connect_error) {
         die("Conexión fallida: " . $con->connect_error);
    }
    //Generacionde token para validar datos y tener seguridad de los mismos
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $token = isset($_GET['token']) ? $_GET['token'] : '';

    if($id == '' || $token == ''){

        echo 'Error al procesar la peticion';
        exit;
    }else{

        $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN );
        if($token == $token_tmp){

            // Preparar la consulta
            $sql = $con->prepare("SELECT id_producto, nombre_producto, precio_producto, descripcion_producto, descuento_producto FROM productos WHERE id_producto = ? AND activo_producto = 1");

            // Verificar si la preparación de la consulta fue exitosa
            if ($sql === false) {
                die("Error en la preparación de la consulta: " . $con->error);
            }

            // Vincular el parámetro de id_producto
            $sql->bind_param("i", $idProducto);

            // Ejecutar la consulta
            $sql->execute();

            // Verificar si la ejecución de la consulta fue exitosa
            if ($sql === false) {
                die("Error al ejecutar la consulta: " . $con->error);
            }

            // Obtener resultados
            $resultado = $sql->get_result();

            // Obtener la única fila de resultados
            $producto = $resultado->fetch_assoc();

            // Cerrar la conexión y liberar recursos
            $sql->close();
            $con->close();

            // Devolver el producto encontrado (puede ser null si no se encuentra)
            return $producto;

        }else{
            echo "Error al Procesar el token";
            exit;
        }
    }
}

function obtenerProductos() {
    // Crear una instancia de la clase Database
    $db = new Database();

    // Obtener la conexión
    $con = $db->conectar();

    // Verificar si la conexión es exitosa
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    $productos = isset($_SESSION['carrito']['productos']) ?  $_SESSION['carrito']['productos'] : null;
    print_r($_SESSION);
    if($productos != null){
        foreach($productos as $clave =>$cantidad){

                // Preparar la consulta
                $sql = $con->prepare("SELECT id_producto, nombre_producto, precio_producto, descuento_producto, $cantidad AS cantidad FROM productos WHERE id_producto = ? AND activo_producto = 1");

                // Verificar si la preparación de la consulta fue exitosa
                if ($sql === false) {
                    die("Error en la preparación de la consulta: " . $con->error);
                }

                // Ejecutar la consulta
                $sql->execute([$clave]);

                // Verificar si la ejecución de la consulta fue exitosa
                if ($sql === false) {
                    die("Error al ejecutar la consulta: " . $con->error);
                }

                // Obtener resultados
                $resultado = $sql->get_result();

                // Cerrar la conexión y liberar recursos
                $sql->close();
                $con->close();

                // Devolver el resultado
                return $resultado;

            }

        }
    }

    function obtenerProductos1() {
        // Crear una instancia de la clase Database
        $db = new Database();
    
        // Obtener la conexión
        $con = $db->conectar();
    
        // Verificar si la conexión es exitosa
        if ($con->connect_error) {
            die("Conexión fallida: " . $con->connect_error);
        }
    
        // Arreglo para almacenar los productos
        $lista_carrito = array();
    
        // Verificar si existen productos en el carrito
        $productosEnCarrito = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
    
        // Verificar si hay productos en el carrito
        if ($productosEnCarrito != null) {
            foreach ($productosEnCarrito as $clave => $cantidad) {
                // Preparar la consulta
                $sql = $con->prepare("SELECT id_producto, nombre_producto, precio_producto, descuento_producto, $cantidad AS cantidad FROM productos WHERE id_producto = ? AND activo_producto = 1");
    
                // Verificar si la preparación de la consulta fue exitosa
                if ($sql === false) {
                    die("Error en la preparación de la consulta: " . $con->error);
                }
    
                $sql->execute([$clave]);
    
                // Verificar si la ejecución de la consulta fue exitosa
                if ($sql === false) {
                    die("Error al ejecutar la consulta: " . $con->error);
                }
    
                // Obtener resultados
                $resultado = $sql->get_result();
    
                // Verificar si se encontraron resultados
                if ($resultado->num_rows > 0) {
                    // Obtener el primer resultado y agregarlo al arreglo de productos
                    $producto = $resultado->fetch_assoc();
                    $lista_carrito[] = $producto;
                }
    
                // Cerrar la consulta
                $sql->close();
            }
        }
    
        // Cerrar la conexión
        $con->close();
    
        // Devolver el arreglo de productos
        return $lista_carrito;
    }

    

?>
