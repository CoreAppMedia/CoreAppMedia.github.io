<?php 
include ("header.php"); 
?>
<br>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach ($resultado as $row) { ?>
          <div class="col">
            <div class="card shadow-sm">

              <?php
              $id = $row["id_producto"];
              $imagen = "Imagenes/Productos/$id/principal.jpg";

              if (!file_exists($imagen)) {
                $imagen = "Imagenes/Productos/error.jpg";
              }
              ?>
              <img src="<?php echo $imagen; ?>">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['nombre_producto']; ?></h5>
                <p class="card-text">$<?php echo number_format($row['precio_producto'], 2, '.', ','); ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <!-- Enlace al detalle del producto -->
                    <a href="detalles.php?id=<?php echo $row['id_producto']; ?>&token=<?php echo hash_hmac('sha1', $row['id_producto'], KEY_TOKEN); ?>" class="btn btn-primary">Detalles</a>
                  </div>
                  <button class= "btn btn-outline-success" type="button" onclick= "addProducto(<?php echo $row['id_producto'];?>, '<?php echo hash_hmac('sha1', $row['id_producto'], KEY_TOKEN); ?>')">Agregar al carrito</button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <?php 
include ("footer.php"); 
?>
