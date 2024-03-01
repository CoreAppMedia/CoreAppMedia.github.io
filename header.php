<?php
require 'Config/productos.php';
// Llamada a la función para obtener productos activos
$resultado = obtenerProductosActivos();

//session_destroy();
//print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<!--   <link href="css/estilos.css" rel="stylesheet"> -->
  <script src="js/carrito.js"></script>
</head>
<body>
  <!-- Barra de navegacion/encabezado -->
  <header>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a href="index.php" class="navbar-brand">
          <strong>Tienda CoreAppMedia</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a href="#" class="nav-link active">Catálogo</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Contacto</a>
            </li>
          </ul>
          <a href="checkout.php" class="btn btn-primary">
            Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart;?></span>
          </a>
        </div>
      </div>
    </div>
  </header>
  <!-- Finaliza Barra de navegacion/encabezado -->

  <main>
    <div class="container">


  
