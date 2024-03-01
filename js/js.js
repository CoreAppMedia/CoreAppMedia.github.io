
//inician funciones para el metodo de pago por Paypal
paypal.Buttons({
    style: {
        color: 'blue',
        shape: 'pill',
        label: 'pay'
    },
    
    createOrder: function(data,actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: 100
                }
            }]
        });
    },

onApprove: function(data, actions) {
    actions.order.capture().then(function(detalles){
           // console.log(detalles)   ---> este comando es para verificar que los datos se mandaron correctamente
        window.location.href= "Completado.php"
        });
    },

    onCancel: function(data){
        alert("Pago cancelado Master");
        console.log(data)
    }
}).render('#paypal-button-container');

//terminan funciones para el metodo de pago por Paypal

