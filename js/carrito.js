//inicias funcion para agregar articulos al carrito de compras

function addProducto(id, token) {
    let url = 'clases/carrito.php';
    let formData = new FormData();
    formData.append('id', id);
    formData.append('token', token);
  
    fetch(url, {
      method: 'POST',
      body: formData,
      mode: 'cors'
    })
    .then(response => response.json())
    .then(data => {
      console.log(data);  // Agrega esta línea para ver detalles en la consola
      if (data.ok) {
        let elemto = document.getElementById("num_cart");
        elemto.innerHTML = data.numero;
        alert('Producto agregado al carrito.');
      } else {
        alert('Error al agregar el producto al carrito.');
      }
    })
    .catch(error => {
      console.error('Error en la solicitud:', error);
      alert('Error en la solicitud al servidor.');
    });
  }
//Terminan funcion para agregar articulos al carrito de compras

//inicia funcion para actualizar cantidad de articulos en el administrador

function actualizaCantidad(cantidad,id) {
  let url = 'clases/actualizar_carrito.php';
  let formData = new FormData();
  formData.append('action', 'agregar');
  formData.append('id', id);
  formData.append('cantidad', cantidad);

  fetch(url, {
    method: 'POST',
    body: formData,
    mode: 'cors'
  })
  .then(response => response.json())
  .then(data => {
    console.log(data);  // Agrega esta línea para ver detalles en la consola
    if (data.ok) {

      let divsubtotal = document.getElementById("subtotal_" + id);
      divsubtotal.innerHTML = data.sub

      let total = 0.00
      let list = document.getElementsByName('subtotal[]')

      for(let i = 0; i < list.length; i++){
        total += parseFloat(list[i].innerHTML.replace(/[$,]/g,''))
      }

      total = new Intl.NumberFormat('en-us',{
        minimumFractionDigits: 2
      }).format(total)
      document.getElementById('total').innerHTML = '$' + total


    } 
  })
  .catch(error => {
    console.error('Error en la solicitud:', error);
    alert('Error en la solicitud al servidor.');
  });
}
//Termina funcion para actualizar cantidad de articulos en el administrador

//inicia funcion Eliminar articulos en el administrador

function eliminar() {
  let botonElimina = document.getElementById('btn-elimina')
  let id = botonElimina.value
  let url = 'clases/actualizar_carrito.php';
  let formData = new FormData();
  formData.append('action', 'eliminar');
  formData.append('id', id);

  fetch(url, {
    method: 'POST',
    body: formData,
    mode: 'cors'
  })
  .then(response => response.json())
  .then(data => {
    console.log(data);  // Agrega esta línea para ver detalles en la consola
    if (data.ok) {
      location.reload()
    } 
  })
  .catch(error => {
    console.error('Error en la solicitud:', error);
    alert('Error en la solicitud al servidor.');
  });
}
//Termina funcion para aEliminar articulos en el administrador

