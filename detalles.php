<?php
include ("header.php"); 

// Verificar si se proporcionó un id_producto en la URL
if (isset($_GET['id']) && isset($_GET['token'])) {
    $idProducto = $_GET['id'];
    $token = $_GET['token'];

    // Verificar la validez del token (puedes implementar tu lógica de seguridad aquí)

    // Llamada a la función para obtener un solo producto por su ID
    $producto = obtenerProducto($idProducto);
} else {
    // Si no se proporciona un id_producto, redirigir o mostrar un mensaje de error
    header("Location: index.php"); // Puedes redirigir a la página de catálogo u otra
    exit();
}

// Algoritmo para aplicar descuentos
$Precio_desc = $producto['precio_producto'] - (($producto['precio_producto'] * $producto['descuento_producto']) / 100);
$dir_images = 'Imagenes/Productos/' . $producto['id_producto'] . '/';
$rutamg = $dir_images . 'Principal.jpg';

if (!file_exists($rutamg)) {
    $rutamg = 'Imagenes/Productos/error.jpg';
}

// Algoritmo para el carrusel de fotos del producto y foto principal
$imagenes = array();
if (file_exists($dir_images)) {
    $dir = dir($dir_images);
    while (($archivo = $dir->read()) != false) {
        if ($archivo != 'Principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
            $imagenes[] = $dir_images . $archivo;
        }
    }
    $dir->close();
}
?>
        <h1>Detalle del Producto</h1>

        <?php if (isset($producto)) { ?>
        <div class="row">
            <div class="col-md-6 order-md-1">
                <!-- Muestra la imagen del producto -->

                <div id="carouselImages" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $rutamg; ?>" class="d-block w-100">
                        </div>
                        <?php foreach ($imagenes as $img) { ?>
                        <div class="carousel-item">
                            <img src="<?php echo $img; ?>" class="d-block w-100">
                        </div>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselImages"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
            <div class="col-md-6 order-md-2">
                <h2><?php echo $producto['nombre_producto']; ?></h2>
                <!-- Mostrar precio/ofertas del producto -->
                <?php if ($producto['descuento_producto'] > 0) { ?>
                <p><del><?php echo MONEDA . number_format($producto['precio_producto'], 2, '.', ','); ?></del></p>

                <h2><?php echo MONEDA . number_format($Precio_desc, 2, '.', ','); ?>
                    <small class="text-success"> <?php echo $producto['descuento_producto'] ?>% de descuento</small>
                </h2>
                <?php } else { ?>

                <h2><?php echo MONEDA . number_format($producto['precio_producto'], 2, '.', ','); ?></h2>
                <?php } ?>


                <!-- Agrega más detalles según sea necesario -->
                <p class="lead">
                    <?php echo $producto['descripcion_producto']; ?>
                </p>

                <div class="d-grid gap-3 col-10 mx-auto">
                    <button class="btn btn-primary" type="button">Comprar ahora</button>
                    <button class="btn btn-outline-primary" type="button"
                        onclick="addProducto(<?php echo $idProducto;?>, '<?php echo $token?>')">Agregar al carrito</button>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <p>El producto no se encontró o no se proporcionó un ID válido.</p>
        <?php } ?>

        <a href="index.php">Volver al Catálogo</a>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php 
include ("footer.php"); 
?>

