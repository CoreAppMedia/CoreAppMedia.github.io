<?php 
include ("header.php"); 
// Llamada a la función para obtener productos activos
$Lista_carrito = obtenerProductos1();

//print_r($_SESSION);
?>
        <div class="table-response">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($Lista_carrito == null){
                        echo '<tr><tdcolspan = "5" class = "text center"><b>Lista vacia</b></td></tr>';
                    }else{
                        $total = 0;
                        foreach($Lista_carrito as $producto){
                            $cantidad = $producto['cantidad'];
                            $_id = $producto['id_producto'];
                            $_nombre = $producto['nombre_producto'];
                            $_precio = $producto['precio_producto'];
                            $_descuento = $producto['descuento_producto']; 
                            $precio_descuento = $_precio - ($_precio * $_descuento)/100;
                            $subtotal = $cantidad * $precio_descuento;
                            $total += $subtotal
                    
                    ?>
                    <tr>
                    <td><?php echo $_nombre?></td>

                    <td><?php echo MONEDA . number_format($precio_descuento, 2, '.', ','); ?></td>
                    <td>
                        <input type= "number" min= "1" max= "10" step= "1" value ="<?php echo $cantidad ?>" size= "5" id="cantidad_<?php echo $_id;?>" onchange="actualizaCantidad(this.value, <?php echo $_id ?>)"></input>
                    </td>
                    <td>
                        <div id= "subtotal_<?php echo $_id;?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ',');  ?></div>
                    </td>
                    <td>
                        <a href="#" id="Eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                    </td>
                    </tr>
                    <?php }?>

                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2">
                            <p class="h3" id= "total"><?php echo MONEDA . number_format($total, 2, '.', ',');?> </p>
                        </td>
                    </tr>
                </tbody>
            <?php }?>
            </table>
        </div>
        <div class="row">
            <div class="col-md-5 offset-md-7 d-grid gap-2">
                <button class="btn btn-primary btn-lg">Realizar pago</button>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn-elimina"type="button" class="btn btn-danger" onclick="eliminar()"> Eliminar </button>

      </div>
    </div>
  </div>
</div>

<script>
    let eliminaModal = document.getElementById('eliminaModal')
eliminaModal.addEventListener('show.bs.modal',function(event){
  let button = event.relatedTarget
  let id = button.getAttribute('data-bs-id')
  let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
  buttonElimina.value = id
})
</script>
<?php 
include ("footer.php"); 
?>
